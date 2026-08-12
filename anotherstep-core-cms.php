<?php
/**
 * Plugin Name: Another Step Core CMS
 * Description: The core infrastructure for a headless Astro integration. This plugin registers essential Custom Post Types (Services, Promos), extends the WP-REST API with custom artist metadata, and implements a high-level content approval system for leadership roles. It also enforces a streamlined, role-based dashboard UI and handles automated Gutenberg block registration.
 * Version: 1.0
 * Author: IT Department
 */

if ( ! defined('ABSPATH') ) exit;

// Automatically grant capability to target roles on plugin activation
function as_add_approval_capabilities() {
    $roles = ['operations_manager', 'administration_management', 'executive_director'];

    foreach ($roles as $role_name) {
        $role = get_role($role_name);
        if ($role && !$role->has_cap('approve_content_merge')) {
            $role->add_cap('approve_content_merge');
        }
    }
}
register_activation_hook(__FILE__, 'as_add_approval_capabilities');

// 1. Feature: Register Custom Post Type - Services
function as_register_services_cpt() {
    $labels = [
        'name' => 'Services',
        'singular_name' => 'Service',
        'menu_name' => 'Organization Services'
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-money-alt',
        'show_in_graphql'     => true,
        'graphql_single_name' => 'service',
        'graphql_plural_name' => 'services',
    ];

    register_post_type('services', $args);
}
add_action('init', 'as_register_services_cpt');

function as_register_values_cpt() {
    $labels = [
        'name' => 'Values',
        'singular_name' => 'Value',
        'menu_name' => 'Organization Values',
    ];

    $args =[
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-heart',
        'show_in_graphql'     => true,
        'graphql_single_name' => 'value',
        'graphql_plural_name' => 'values',
    ];

    register_post_type('values', $args);
}
add_action('init', 'as_register_values_cpt');

// 2. Feature: Add Custom Fields for the Services Post Type
function as_register_rest_fields() {
    // Adding an "Artist Name field to the Services API response
    register_rest_field( 'services', 'artist_details', [
        'get_callback' => function( $post ) {
            return [
                'name' => get_post_meta( $post['id'], '_as_artist_name', true ),
                'service_type' => get_post_meta( $post['id'], '_as_service_type', true ),
            ];
        },
        'update_callback' => null,
        'schema' => null,
    ]);

    // Adding an "Icon field to the Values and Services API response
    register_rest_field( [ 'values', 'services' ], 'cardIcon', [
        'get_callback' => function( $post ) {
            return get_post_meta( $post['id'], '_as_icon', true );
        },
        'update_callback' => null,
        'schema' => null,
    ]);

    // Adding an "Theme field to the Values and Services API response
    register_rest_field( [ 'values', 'services' ], 'cardTheme', [
        'get_callback' => function( $post ) {
            return get_post_meta( $post['id'], '_as_theme', true );
        },
        'update_callback' => null,
        'schema' => null,
    ]);
}
add_action('rest_api_init', 'as_register_rest_fields');

/**
 * Register Custom Fields to WPGraphQL Schema
 */
add_action( 'graphql_register_types', function() {
    
    // 1. Register 'cardIcon' on both CPT Types
    // Note: The Type name in WPGraphQL for 'values' is usually 'Value' (based on graphql_single_name)
    // and for 'services' it is 'Service'
    $types_to_register_on = [ 'Value', 'Service' ];

    foreach ( $types_to_register_on as $type_name ) {
        
        // Register cardIcon
        register_graphql_field( $type_name, 'cardIcon', [
            'type' => 'String',
            'description' => __( 'The visual icon defined for this card layout', 'anotherstep' ),
            'resolve' => function( \WPGraphQL\Model\Post $post ) {
                // Fetch the same underlying database meta key as your REST field
                return get_post_meta( $post->databaseId, '_as_icon', true );
            }
        ] );

        // Register cardTheme
        register_graphql_field( $type_name, 'cardTheme', [
            'type' => 'String',
            'description' => __( 'The background style theme mapping class', 'anotherstep' ),
            'resolve' => function( \WPGraphQL\Model\Post $post ) {
                // Fetch the same underlying database meta key as your REST field
                return get_post_meta( $post->databaseId, '_as_theme', true );
            }
        ] );
    }
} );

// 3. Feature: Add the Meta Box to the Service Post Type Edit Screen
function as_render_service_metabox( $post ) {
    $artist = get_post_meta( $post->ID, '_as_artist_name', true );
    $icon = get_post_meta( $post->ID, '_as_icon', true );
    $theme = get_post_meta( $post->ID, '_as_theme', true );
    ?>
    <p>
        <label for="as_artist_name"><strong>Artist Name (for Drawings):</strong></label><br />
        <input type="text" name="as_artist_name" value="<?php echo esc_attr($artist); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="as_icon"><strong>Card Icon:</strong></label><br />
        <input type="text" name="as_icon" value="<?php echo esc_attr($icon); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="as_theme"><strong>Card Theme:</strong></label><br />
        <input type="text" name="as_theme" value="<?php echo esc_attr($theme); ?>" style="width:100%;" />
    </p>
    <?php
}
function as_add_service_metabox() {
    add_meta_box('service_info', 'Service Details', 'as_render_service_metabox', 'services', 'normal', 'high');
}
add_action('add_meta_boxes', 'as_add_service_metabox');

function as_render_values_metabox( $post ) {
    $icon = get_post_meta( $post->ID, '_as_icon', true );
    $theme = get_post_meta( $post->ID, '_as_theme', true );
    ?>
    <p>
        <label for="as_icon"><strong>Card Icon:</strong></label><br />
        <input type="text" name="as_icon" value="<?php echo esc_attr($icon); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="as_theme"><strong>Card Theme:</strong></label><br />
        <input type="text" name="as_theme" value="<?php echo esc_attr($theme); ?>" style="width:100%;" />
    </p>
    <?php
}
function as_add_values_metabox() {
    add_meta_box('values_info', 'Values Details', 'as_render_values_metabox', 'values', 'normal', 'high');
}
add_action('add_meta_boxes', 'as_add_values_metabox');


// 4. Feature: Save the Data for the Artist Name
function as_save_service_meta($post_id) {
    if (array_key_exists('as_artist_name', $_POST)) {
        update_post_meta( $post_id, '_as_artist_name', $_POST['as_artist_name'] );
    }
}
add_action('save_post', 'as_save_service_meta');

function as_save_values_meta($post_id) {
    if (array_key_exists('as_icon', $_POST)) {
        update_post_meta( $post_id, '_as_icon', $_POST['as_icon'] );
    }
    if (array_key_exists('as_theme', $_POST)) {
        update_post_meta( $post_id, '_as_theme', $_POST['as_theme'] );
    }
}
add_action('save_post', 'as_save_values_meta');

// 5. Feature: Simplify the Dashboard Sidebar based on Roles
function as_admin_menu() {
    if (!current_user_can('access_developer_tools')) {
        remove_menu_page('plugins.php');
        remove_menu_page('themes.php');
        remove_menu_page('options-general.php');
        remove_menu_page('tools.php');
        remove_menu_page('edit.php?post_type=acf-field-group');
    }   
}
add_action('admin_menu', 'as_admin_menu', 999);

// 6. Feature: Staging System for Headless Astro Frontend

/**
 * Intercept REST API updates (Gutenberg) before post status changes.
 * Handles both published posts AND brand new draft/pending submissions.
 */
function as_intercept_gutenberg_staged_edits($prepared_post, $request) {
    if (empty($prepared_post->ID)) return $prepared_post;

    $post_id    = $prepared_post->ID;
    $old_status = get_post_status($post_id);

    // Run staging for ANY post update made by non-approvers
    if (!current_user_can('approve_content_merge')) {
        
        $staged_data = [
            'post_title'   => !empty($prepared_post->post_title) ? $prepared_post->post_title : get_the_title($post_id),
            'post_content' => !empty($prepared_post->post_content) ? $prepared_post->post_content : get_post_field('post_content', $post_id),
            'submitted_by' => get_current_user_id(),
            'submitted_at' => current_time('mysql'),
        ];

        // Store staged data in post meta so it shows on the Dashboard Widget
        update_post_meta($post_id, '_as_pending_approval_data', $staged_data);

        // If it was ALREADY published, keep it published live for Astro
        if ($old_status === 'publish') {
            $prepared_post->post_status = 'publish';

            // Revert live title/content so unapproved edits don't bleed onto the site
            $live_post = get_post($post_id);
            $prepared_post->post_title   = $live_post->post_title;
            $prepared_post->post_content = $live_post->post_content;
        }
    }

    return $prepared_post;
}
// Hook across ALL post types you use
add_filter('rest_pre_insert_post', 'as_intercept_gutenberg_staged_edits', 10, 2);
add_filter('rest_pre_insert_page', 'as_intercept_gutenberg_staged_edits', 10, 2);
add_filter('rest_pre_insert_services', 'as_intercept_gutenberg_staged_edits', 10, 2);
add_filter('rest_pre_insert_values', 'as_intercept_gutenberg_staged_edits', 10, 2);
add_filter('rest_pre_insert_promos', 'as_intercept_gutenberg_staged_edits', 10, 2);


/**
 * Render Meta Box with Staging Info for Approvers
 */
function as_render_merge_box($post) {
    $staged_data = get_post_meta($post->ID, '_as_pending_approval_data', true);

    if ($staged_data) {
        $user_info   = get_userdata($staged_data['submitted_by']);
        $author_name = $user_info ? $user_info->display_name : 'An editor';
        
        // Build a secure direct action URL
        $approve_url = wp_nonce_url(
            admin_url('admin-post.php?action=as_approve_content_merge&post_id=' . $post->ID),
            'as_approve_action_' . $post->ID
        );

        echo '<div style="background: #fff8e5; border-left: 4px solid #dba617; padding: 10px; margin-bottom: 12px;">';
        echo '  <strong style="color: #b26200;">⚠️ Staged Edits Waiting</strong>';
        echo '  <p style="font-size: 12px; color: #50575e; margin: 4px 0 0 0;">Submitted by ' . esc_html($author_name) . '<br>on ' . esc_html($staged_data['submitted_at']) . '</p>';
        echo '</div>';
        echo '<a href="' . esc_url($approve_url) . '" class="button button-primary button-large" style="width:100%; text-align:center; display:block;">Approve & Merge to Live</a>';
    } else {
        echo '<p style="color: #46b450; font-weight: bold; margin: 0;">✅ Live content matches current revision.</p>';
    }
}

function as_add_meta_boxes() {
    if (current_user_can('approve_content_merge')) {
        add_meta_box(
            'as_merge_request', 
            'Content Approval (Merge)', 
            'as_render_merge_box', 
            ['post', 'page', 'services', 'values', 'promos'], 
            'side', 
            'high'
        );
    }   
}
add_action('add_meta_boxes', 'as_add_meta_boxes');


/**
 * Render Dashboard Widget Content for Staged Edits
 */
function as_render_pending_approvals_widget() {
    $query = new WP_Query([
        'post_type'      => ['post', 'page', 'services', 'values', 'promos'],
        'post_status'    => ['publish', 'draft', 'pending'],
        'meta_key'       => '_as_pending_approval_data',
        'posts_per_page' => 10,
    ]);

    if (!$query->have_posts()) {
        echo '<p style="color: #46b450; font-weight: bold; margin: 0;">✅ All clear! No pending edits awaiting review.</p>';
        return;
    }

    echo '<p style="margin-top:0; color: #50575e;">The following posts have staged edits waiting for merge:</p>';
    echo '<ul style="margin: 0; padding-left: 0; list-style: none;">';

    while ($query->have_posts()) {
        $query->the_post();
        $post_id    = get_the_ID();
        $title      = get_the_title() ?: '(Untitled)';
        $post_type_obj = get_post_type_object(get_post_type());
        $post_type  = $post_type_obj ? $post_type_obj->labels->singular_name : 'Post';
        $edit_link  = get_edit_post_link($post_id);
        $staged     = get_post_meta($post_id, '_as_pending_approval_data', true);
        $author     = !empty($staged['submitted_by']) ? get_userdata($staged['submitted_by'])->display_name : 'Editor';

        echo '<li style="padding: 10px 0; border-bottom: 1px solid #f0f0f1; display: flex; align-items: center; justify-content: space-between;">';
        echo '  <div style="max-width: 70%;">';
        echo '      <strong style="display: block; font-size: 14px;"><a href="' . esc_url($edit_link) . '">' . esc_html($title) . '</a></strong>';
        echo '      <span style="font-size: 12px; color: #646970;">' . esc_html($post_type) . ' • Staged by ' . esc_html($author) . '</span>';
        echo '  </div>';
        echo '  <div style="text-align: right;">';
        echo '      <a href="' . esc_url($edit_link) . '" class="button button-small button-primary">Review Edits</a>';
        echo '  </div>';
        echo '</li>';
    }

    echo '</ul>';
    wp_reset_postdata();
}

function as_add_pending_approvals_dashboard_widget() {
    if (current_user_can('approve_content_merge')) {
        wp_add_dashboard_widget(
            'as_pending_approvals_widget',
            '📋 Content Pending Approval',
            'as_render_pending_approvals_widget'
        );
    }
}
add_action('wp_dashboard_setup', 'as_add_pending_approvals_dashboard_widget');

// 7. Feature: Merge Staged Changes into Live Post
function as_handle_merge_approval_action() {
    $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

    if (!$post_id) {
        wp_die('Invalid post ID.');
    }

    // Verify Nonce & Permissions
    check_admin_referer('as_approve_action_' . $post_id);

    if (!current_user_can('approve_content_merge')) {
        wp_die('You do not have permission to approve content merges.');
    }

    $staged_data = get_post_meta($post_id, '_as_pending_approval_data', true);

    if ($staged_data) {
        // Temporarily unhook the REST staging filter so wp_update_post writes directly
        remove_filter('rest_pre_insert_post', 'as_intercept_gutenberg_staged_edits', 10);
        remove_filter('rest_pre_insert_page', 'as_intercept_gutenberg_staged_edits', 10);
        remove_filter('rest_pre_insert_services', 'as_intercept_gutenberg_staged_edits', 10);
        remove_filter('rest_pre_insert_values', 'as_intercept_gutenberg_staged_edits', 10);
        remove_filter('rest_pre_insert_promos', 'as_intercept_gutenberg_staged_edits', 10);

        // Apply staged edits to live post
        wp_update_post([
            'ID'           => $post_id,
            'post_title'   => $staged_data['post_title'],
            'post_content' => $staged_data['post_content'],
            'post_status'  => 'publish'
        ]);

        // Delete staged meta
        delete_post_meta($post_id, '_as_pending_approval_data');
        
        // Log approval metadata
        update_post_meta($post_id, '_as_last_approved_by', get_current_user_id());
        update_post_meta($post_id, '_as_last_approved_at', current_time('mysql'));
    }

    // Redirect back to edit screen with success notice
    wp_redirect(get_edit_post_link($post_id, 'url'));
    exit;
}
add_action('admin_post_as_approve_content_merge', 'as_handle_merge_approval_action');

// 8. Feature: Registering all blocks to be used in posts and pages.
function as_register_blocks() {
    $build_dir = __DIR__ . '/blocks/build';

    // Check if the directory exists to prevent errors
    // Check if the manifest exists before trying to register
    if ( file_exists( $build_dir . '/blocks-manifest.php' ) ) {
        wp_register_block_types_from_metadata_collection(
            $build_dir,
            $build_dir . '/blocks-manifest.php'
        );
    }    
}
add_action('init', 'as_register_blocks');

function as_enqueue_block_styles() {
    $script_path = plugin_dir_path( __FILE__ ) . 'assets/js/block-styles.js';
    $script_url  = plugin_dir_url( __FILE__ ) . 'assets/js/block-styles.js';

    if ( file_exists( $script_path ) ) {
        wp_enqueue_script(
            'anotherstep-block-styles',
            $script_url,
            array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-element' ),
            filemtime( $script_path ),
            true
        );
    }
}
add_action( 'enqueue_block_editor_assets', 'as_enqueue_block_styles' );

// 9. Feature: Store roles for shop managers and order processing
function as_restrict_woocommerce_menus() {
    // Check if the current user has specific roles
    if (current_user_can('order_fulfillment_processor')) {
        // 1. Remove the woocommerce menu pages
        remove_menu_page('woocommerce-marketing');

        // 2. Remove the woocommerce submenu pages
        remove_submenu_page('woocommerce', 'wc-admin');
        remove_submenu_page('woocommerce', 'wc-status');
        remove_submenu_page('woocommerce', 'wc-addons');
    }
}

add_action('admin_init', 'as_restrict_woocommerce_menus');

// 10. Feature: Register Footer Settings and Nav Menus
/**
 * 1. Register Navigation Menus
 */
function register_footer_menu_locations() {
    register_nav_menus(array(
        'quick-links' => __('Quick Links Menu', 'textdomain'),
        'our-services' => __('Our Services Menu', 'textdomain'),
        'legal-links' => __('Legal Links Menu', 'textdomain'),
    ));
}
add_action('init', 'register_footer_menu_locations');


/**
 * 2. Register ACF Options Page & Fields for WPGraphQL
 * Requires ACF Pro and WPGraphQL for ACF.
 */
function register_footer_acf_options() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title'    => 'Footer Settings',
            'menu_title'    => 'Footer Settings',
            'menu_slug'     => 'footer-settings',
            'capability'    => 'manage_options',
            'show_in_graphql' => true, // Exposes the page to GraphQL
            'graphql_field_name' => 'footerSettings',
        ));
    }
}
add_action('acf/init', 'register_footer_acf_options');

function register_footer_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key'                 => 'group_footer_settings',
            'title'               => 'Footer Settings',
            'show_in_graphql'     => true,
            'graphql_field_name'  => 'officeDetails',
            'fields' => array(
                // Brand Information Fields
                array(
                    'key'                => 'field_footer_logo',
                    'label'              => 'Footer Logo',
                    'name'               => 'logo',
                    'type'               => 'image',
                    'return_format'      => 'array',
                    'show_in_graphql'    => true,
                    'graphql_field_name' => 'logo',
                ),
                array(
                    'key'                => 'field_company_name',
                    'label'              => 'Company Name',
                    'name'               => 'company_name',
                    'type'               => 'text',
                    'default_value'      => 'Another Step',
                    'show_in_graphql'    => true,
                    'graphql_field_name' => 'companyName',
                ),
                array(
                    'key'                => 'field_footer_description',
                    'label'              => 'Footer Description',
                    'name'               => 'description',
                    'type'               => 'textarea',
                    'default_value'      => 'Supporting independent living with clarity, care, and community for everyone.',
                    'show_in_graphql'    => true,
                    'graphql_field_name' => 'description',
                ),
                array(
                    'key'                => 'field_copyright_text',
                    'label'              => 'Copyright Text',
                    'name'               => 'copyright_text',
                    'type'               => 'text',
                    'instructions'       => 'Use {year} as a placeholder for the current year.',
                    'default_value'      => '© {year} Another Step. All rights reserved.',
                    'show_in_graphql'    => true,
                    'graphql_field_name' => 'copyrightText',
                ),
                // Repeater for Offices
                array(
                    'key'                => 'field_footer_offices',
                    'label'              => 'Offices',
                    'name'               => 'offices',
                    'type'               => 'repeater',
                    'show_in_graphql'    => true,
                    'graphql_field_name' => 'offices',
                    'layout'             => 'block',
                    'sub_fields' => array(
                        array(
                            'key'                => 'field_office_name',
                            'label'              => 'Office Name',
                            'name'               => 'name',
                            'type'               => 'text',
                            'show_in_graphql'    => true,
                        ),
                        array(
                            'key'                => 'field_office_address',
                            'label'              => 'Address',
                            'name'               => 'address',
                            'type'               => 'textarea',
                            'show_in_graphql'    => true,
                        ),
                        array(
                            'key'                => 'field_office_phone',
                            'label'              => 'Phone Number',
                            'name'               => 'phone',
                            'type'               => 'text',
                            'show_in_graphql'    => true,
                        ),
                        array(
                            'key'                => 'field_office_email',
                            'label'              => 'Email Address',
                            'name'               => 'email',
                            'type'               => 'email',
                            'show_in_graphql'    => true,
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'options_page',
                        'operator' => '==',
                        'value'    => 'footer-settings',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'register_footer_acf_fields');