<?php

namespace AnotherStep\Shop;

class ShopAdminUI
{
    public function init(): void {
        add_action( 'admin_menu', [ $this, 'restrict_shop_menus' ], 999 );
        add_filter( 'wc_order_is_editable', [ $this, 'freeze_order_editing' ], 10, 2 );
        add_filter( 'woocommerce_admin_order_actions', [ $this, 'filter_order_actions' ], 10, 2 );
        add_filter( 'editable_roles', [ $this, 'filter_editable_roles' ] );
    }

    /**
     * Restrict shop-related views for fulfillment staff.
     */
    public function restrict_shop_menus(): void {
        $user = wp_get_current_user();

        if ( in_array( 'order_fulfillment_processor', (array) $user->roles, true ) ) {
            // Top-level Menus
            remove_menu_page( 'edit.php?post_type=product' );
            remove_menu_page( 'wc-admin' );
            remove_menu_page( 'woocommerce-marketing' );

            // WooCommerce Submenus
            remove_submenu_page( 'woocommerce', 'wc-reports' );
            remove_submenu_page( 'woocommerce', 'wc-settings' );
            remove_submenu_page( 'woocommerce', 'wc-status' );
            remove_submenu_page( 'woocommerce', 'wc-addons' );
        }
    }

    /**
     * Prevent fulfillment staff from editing orders after they are created.
     */
    public function freeze_order_editing( $is_editable, $order ): bool {
        $user = wp_get_current_user();

        if ( in_array( 'order_fulfillment_processor', (array) $user->roles, true ) ) {
            return false;
        }

        return $is_editable;
    }

    /**
     * Filter available order actions for fulfillment staff.
     */
    public function filter_order_actions( $actions, $order ): array {
        $user = wp_get_current_user();

        if ( in_array( 'order_fulfillment_processor', (array) $user->roles, true ) ) {
            return [
                'view' => $actions['view'],
            ];
        }

        return $actions;
    }

    /**
     * Prevent fulfillment staff from assigning roles they shouldn't manage.
     */
    public function filter_editable_roles( $roles ): array {
        if ( current_user_can( 'shop_manager' ) && ! current_user_can( 'administrator' ) ) {
            foreach ( $roles as $role_key => $role_data ) {
                if ( ! in_array( $role_key, [ 'order_fulfillment_processor', 'customer' ], true ) ) {
                    unset( $roles[ $role_key ] );
                }
            }
        }
        return $roles;
    }
}