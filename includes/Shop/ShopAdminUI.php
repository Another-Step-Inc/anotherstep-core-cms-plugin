<?php

namespace AnotherStep\Shop;

class ShopAdminUI
{
    public function init(): void {
        if ( ! class_exists( 'WooCommerce' ) ) {
            return;
        }

        // 1. Sidebar Menu Cleanup (Run last to override WooCommerce dynamic menus)
        add_action( 'admin_menu', [ $this, 'restrict_shop_menus' ], 999 );

        // 2. Order Processing Restrictions (Prevent fulfillment staff from editing orders after creation)
        add_filter( 'wc_order_is_editable', [ $this, 'freeze_order_editing_for_processors' ], 10, 2 );
        add_filter( 'woocommerce_admin_order_actions', [ $this, 'filter_order_actions' ], 10, 2 );

        // 3. User Delegation Restrictions for Shop Managers
        add_filter( 'editable_roles', [ $this, 'filter_editable_roles_for_shop_manager' ] );

        // 4. Role-Specific Protections
        add_action( 'admin_head', [ $this, 'hide_extensions_menu_css' ] );
        add_filter( 'woocommerce_allow_marketplace_house_call', [ $this, 'disable_marketplace_for_staff' ] );
        add_action( 'admin_init', [ $this, 'restrict_product_editing_for_csr' ] );
        add_action( 'add_meta_boxes', [ $this, 'remove_order_meta_boxes_for_inventory' ], 10, 2 );
    }

    /**
     * Restrict shop-related views for fulfillment staff.
     */
    public function restrict_shop_menus(): void {
        $user = wp_get_current_user();
        $roles = (array) $user->roles;

        // Skip restriction entirely if user is Admin or Shop Manager
        if ( current_user_can( 'administrator' ) || current_user_can( 'shop_manager' ) ) {
            return;
        }

        // Identify active roles flags across multi-role users
        $is_fulfillment_processor = in_array( 'order_fulfillment_processor', $roles, true );
        $is_csr = in_array( 'customer_service_rep', $roles, true );
        $is_inventory_manager = in_array( 'inventory_manager', $roles, true );

        // If user has none of our custom staff roles, exit early (no restrictions needed)
        if ( ! $is_fulfillment_processor && ! $is_csr && ! $is_inventory_manager ) {
            return;
        }

        // Common blocked WooCommerce menus
        $blocked_wc_pages = [
            'wc-reports', // Reports
            'wc-addons', // Extensions
            'wc-settings', // Settings
            'wc-status', // Status
            'wc-admin&path=/payments', // Payments
            'wc-admin&path=/marketing', // Marketing
            'wc-admin&path=/analytics/overview', // Analytics
            'woocommerce-marketing', // Marketing (legacy)
        ];

        // 1. Strip universal blocked submenus (preserves wc-admin foor for SPA routing)
        foreach ( $blocked_wc_pages as $page ) {
            remove_menu_page( $page );
            remove_submenu_page( 'woocommerce', $page );
        }

        // 2. Hide Products ONLY IF user has neither Inventory Manager nor CSR roles
        if ( ! $is_inventory_manager && ! $is_csr ) {
            remove_menu_page( 'edit.php?post_type=product' );
        }

        // 3. Hide Customers SPA ONLY IF user is not a CSR
        if ( ! $is_csr ) {
            remove_submenu_page( 'woocommerce', 'wc-admin&path=/customers' );
        }

        // 4. Hide WooCommerce/Orders Parent ONLY IF user cannot manage orders at all
        if ( ! $is_fulfillment_processor && ! $is_csr && ! current_user_can( 'edit_shop_orders' ) ) {
            remove_menu_page( 'woocommerce' );
            remove_menu_page( 'edit.php?post_type=shop_order' );
        }

        // 5. Block Core WP Users list for non-administrators
        if ( $is_fulfillment_processor || $is_inventory_manager || $is_csr ) {
            remove_menu_page('users.php');
        }

        // Global fallback
        global $menu;
        if ( is_array( $menu ) ) {
            foreach ( $menu as $key => $item ) {
                if ( isset( $item[2] ) && ( strpos( $item[2], 'payments' ) !== false || $item[0] === 'Payments' ) ) {
                    unset( $menu[ $key ] );
                }
            }
        }
    }

    /**
     * Prevent fulfillment staff from editing orders after they are created.
     */
    public function freeze_order_editing_for_processors( $is_editable, $order ): bool {
        if ( current_user_can( 'order_fulfillment_processor' ) && ! current_user_can( 'shop_manager' ) ) {
            return false;
        }
        return $is_editable;
    }

    /**
     * Filter available order actions for fulfillment staff.
     */
    public function filter_order_actions( $actions, $order ): array {
        if ( current_user_can( 'order_fulfillment_processor' ) && ! current_user_can( 'manage_options' ) ) {
            unset( $actions['delete'] );
        }
        return $actions;
    }

    /**
     * Limit which roles Shop Managers can edit/create.
     */
    public function filter_editable_roles_for_shop_manager( $roles ): array {
        if ( current_user_can( 'shop_manager' ) && ! current_user_can( 'administrator' ) ) {
            $allowed = [ 'order_fulfillment_processor', 'customer_service_rep', 'inventory_manager', 'customer' ];
            foreach ( $roles as $role_key => $role_data ) {
                if ( ! in_array( $role_key, $allowed, true ) ) {
                    unset( $roles[ $role_key ] );
                }
            }
        }
        return $roles;
    }

    /**
     * Prevent CSRs from saving changes to catalog products.
     */
    public function restrict_product_editing_for_csr(): void {
        global $pagenow;
        if ( current_user_can( 'customer_service_rep' ) && ! current_user_can( 'shop_manager' ) ) {
            if ( $pagenow === 'post.php' || isset( $_POST['post_type'] ) && $_POST['post_type'] === 'product' ) {
                wp_die( __( 'Customer Service Reps can view product details but cannot modify catalog data.', 'another-step' ) );
            }
        }
    }

    /**
     * Disable Extensions marketplace API calls & menu items for non-admins.
     */
    public function disable_marketplace_for_staff( bool $allow ): bool {
        if ( current_user_can( 'administrator' ) ) {
            return $allow;
        }

        $user  = wp_get_current_user();
        $roles = (array) $user->roles;
        $restricted_roles = [ 'order_fulfillment_processor', 'customer_service_rep', 'inventory_manager' ];

        if ( array_intersect( $restricted_roles, $roles ) ) {
            return false; // Strips Extensions from React nav natively
        }

        return $allow;
    }

    /**
     * Hide Extensions menu elements completely from the DOM for restricted staff.
     */
    public function hide_extensions_menu_css(): void {
        if ( current_user_can( 'administrator' ) || current_user_can( 'shop_manager' ) ) {
            return;
        }

        $user  = wp_get_current_user();
        $roles = (array) $user->roles;
        $restricted_roles = [ 'order_fulfillment_processor', 'customer_service_rep', 'inventory_manager' ];

        if ( array_intersect( $restricted_roles, $roles ) ) {
            ?>
            <style id="as-hide-wc-staff-menus">
                /* Hide Extensions */
                a[href*="page=wc-addons"],
                a[href*="path=%2Fextensions"],
                a[href*="path=/extensions"],
                
                /* Hide Sales Reports */
                a[href*="page=wc-reports"],
                li.toplevel_page_wc-reports,
                
                /* Hide WooCommerce Home Link from Sidebar without breaking SPA Routing */
                #toplevel_page_woocommerce ul li.wp-first-item,
                #toplevel_page_woocommerce ul li a[href="admin.php?page=wc-admin"],
                #toplevel_page_woocommerce ul li a[href*="path=%2Fanalytics%2Foverview"] {
                    display: none !important;
                }
            </style>
            <?php
        }

        // CSR Read-Only Product View Guard
        if ( in_array( 'customer_service_rep', $roles, true ) && ! in_array( 'inventory_manager', $roles, true ) ) {
            ?>
            <style id="as-csr-product-readonly">
                /* Hide publish/update buttons and quick-edit options for CSRs */
                .post-type-product #publishing-action,
                .post-type-product #major-publishing-actions,
                .post-type-product .inline-edit-row,
                .post-type-product span.edit a {
                    display: none !important;
                }
            </style>
            <?php
        }
    }

    /**
     * Hide order meta boxes for pure Inventory Managers (safeguarded for multi-role staff).
     */
    public function remove_order_meta_boxes_for_inventory(): void {
        if ( current_user_can( 'inventory_manager' ) && ! current_user_can( 'fulfill_orders' ) && ! current_user_can( 'shop_manager' ) ) {
            remove_meta_box( 'woocommerce-order-data', 'shop_order', 'normal' );
            remove_meta_box( 'woocommerce-order-items', 'shop_order', 'normal' );
            remove_meta_box( 'woocommerce-order-actions', 'shop_order', 'side' );
        }
    }
}