<?php
/**
 * Plugin Name: Another Step Core CMS
 * Description: The core infrastructure for a headless Astro integration. This plugin registers essential Custom Post Types (Services, Promos), extends the WP-REST API with custom artist metadata, and implements a high-level content approval system for leadership roles. It also enforces a streamlined, role-based dashboard UI and handles automated Gutenberg block registration.
 * Version: 1.0
 * Author: IT Department
 */

if ( ! defined('ABSPATH') ) wxit;

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

// 6. Feature: Website content approvals system; add meta boxes to posts, services, and promos
function as_render_merge_box($post) {
    if ($post->post_status === 'publish') {
        echo '<p style="color: green; font-weight: bold;">✅ This content is Live (Merged).</p>';
    } else {
        echo '<p>Review the content and waiver status below.</p>';
        echo '<input type="submit" name="as_approve_merge" class="button button-primary button-large" value="Approve & Merge to Live" style="width:100%;">';
    }
}
function as_add_meta_boxes() {
    $authorized_roles = ['operations_manager', 'administration_management', 'executive_director'];
    $current_user = wp_get_current_user();

    // Only show this box if the user has one of the authorized roles
    if (array_intersect($authorized_roles, $current_user->roles)) {
        add_meta_box(
            'as_merge_request', 
            'Content Approval (Merge)', 
            'as_render_merge_box', 
            ['post', 'services', 'promos'], 
            'side', 
            'high'
        );
    }    
}
add_action('add_meta_boxes', 'as_add_meta_boxes');

// 7. Feature: Saving a post with approvals from one of three roles
function as_save_post($post_id) {
    // Basic security checks
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['as_approve_merge'])) return;

    // Capability Check: Ensure only leadership can "Merge"
    $authorized_roles = ['operations_manager', 'administration_management', 'executive_director'];
    $current_user = wp_get_current_user();

    if (array_intersect($authorized_roles, $current_user->roles)) {
        // Unhook to prevent infinite loop
        remove_action('save_post', 'as_save_approval_data'); 
        
        wp_update_post([
            'ID'          => $post_id,
            'post_status' => 'publish'
        ]);
    }
}
add_action('save_post', 'as_save_post', 20);

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