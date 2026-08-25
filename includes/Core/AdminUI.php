<?php
namespace AnotherStep\Core;

class AdminUI
{
    public function init(): void {
        add_action( 'admin_menu', [ $this, 'simplify_dashboard_menu' ], 999 );
    }

    /**
     * Hide specific administrative settings depending on capability.
     */
    public function simplify_dashboard_menu(): void {
        if ( ! current_user_can('access_developer_tools') ) {
            remove_menu_page( 'plugins.php' );
            remove_menu_page( 'themes.php' );
            remove_menu_page( 'options-general.php' );
            remove_menu_page( 'tools.php' );
            remove_menu_page( 'edit.php?post_type=acf-field-group' );
        }
    }
}