<?php

namespace AnotherStep\Core;

class ShopCapabilities
{
    public static function register_shop_roles(): void 
    {
        // 1. Order Fulfillment Processor (Order Statuses, Packing Slips, Notes)
        if ( ! get_role( 'order_fulfillment_processor' ) ) {
            add_role( 'order_fulfillment_processor', __( 'Order Fulfillment Processor', 'another-step' ), [
                'read'                      => true,
                'edit_posts'                => false,
                'delete_posts'              => false,
                'edit_shop_orders'          => true,
                'edit_others_shop_orders'   => true,
                'publish_shop_orders'       => true,
                'read_private_shop_orders'  => true,
                'fulfill_orders'            => true,
            ] );
        }

        // 2. Customer Service Representative (Orders + Refunds/Customer Communication)
        if ( ! get_role( 'customer_service_rep' ) ) {
            add_role( 'customer_service_rep', __( 'Customer Service Representative', 'another-step' ), [
                'read'                      => true,
                'edit_shop_orders'          => true,
                'edit_others_shop_orders'   => true,
                'publish_shop_orders'       => true,
                'read_private_shop_orders'  => true,
                'read_private_products'     => true, // View product details/stock
            ] );
        }

        // 3. Inventory Manager (Stock Counts, Catalog Updates, No Financials/Orders)
        if ( ! get_role( 'inventory_manager' ) ) {
            add_role( 'inventory_manager', __( 'Inventory Manager', 'another-step' ), [
                'read'                      => true,
                'edit_products'             => true,
                'edit_others_products'      => true,
                'publish_products'          => true,
                'read_private_products'     => true,
                'manage_product_terms'      => true, // Categories & attributes
                'assign_product_terms'      => true,
            ] );
        }

        // 4. Grant Shop Manager supervisory capabilities over custom roles
        $shop_manager = get_role( 'shop_manager' );
        if ( $shop_manager ) {
            $shop_manager->add_cap( 'fulfill_orders' );
            $shop_manager->add_cap( 'manage_fulfillment_processors' );
        }
    }
}