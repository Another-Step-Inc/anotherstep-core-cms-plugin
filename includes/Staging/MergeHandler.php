<?php
namespace AnotherStep\Staging;

class MergeHandler {
    public function init(): void {
        add_action( 'admin_post_as_approve_content_merge', [ $this, 'handle_merge' ] );
    }

    public function handle_merge(): void {
        $post_id = isset( $_GET['post_id'] ) ? intval( $_GET['post_id'] ) : 0;

        if ( ! $post_id ) {
            wp_die( 'Invalid post ID.' );
        }

        check_admin_referer( 'as_approve_action_' . $post_id );

        if ( ! current_user_can( 'approve_content_merge' ) ) {
            wp_die( 'You do not have permission to approve content merges.' );
        }

        $staged_data = get_post_meta( $post_id, '_as_pending_approval_data', true );

        if ( $staged_data ) {
            // Momentarily detach filters to perform the direct merge
            wp_update_post([
                'ID'           => $post_id,
                'post_title'   => $staged_data['post_title'],
                'post_content' => $staged_data['post_content'],
                'post_status'  => 'publish'
            ]);

            delete_post_meta( $post_id, '_as_pending_approval_data' );
            update_post_meta( $post_id, '_as_last_approved_by', get_current_user_id() );
            update_post_meta( $post_id, '_as_last_approved_at', current_time( 'mysql' ) );
        }

        wp_redirect( get_edit_post_link( $post_id, 'url' ) );
        exit;
    }
}