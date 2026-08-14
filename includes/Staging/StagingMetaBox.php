<?php
namespace AnotherStep\Staging;

class StagingMetaBox {
    public function init(): void {
        add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
    }

    public function add_meta_boxes(): void {
        if ( current_user_can( 'approve_content_merge' ) ) {
            add_meta_box(
                'as_merge_request',
                'Content Approval (Merge)',
                [ $this, 'render' ],
                [ 'post', 'page', 'services', 'values', 'promos' ],
                'side',
                'high'
            );
        }
    }

    public function render( \WP_Post $post ): void {
        $staged_data = get_post_meta( $post->ID, '_as_pending_approval_data', true );

        if ( $staged_data ) {
            $user_info   = get_userdata( $staged_data['submitted_by'] );
            $author_name = $user_info ? $user_info->display_name : 'An editor';

            $approve_url = wp_nonce_url(
                admin_url( 'admin-post.php?action=as_approve_content_merge&post_id=' . $post->ID ),
                'as_approve_action_' . $post->ID
            );

            echo '<div style="background: #fff8e5; border-left: 4px solid #dba617; padding: 10px; margin-bottom: 12px;">';
            echo '  <strong style="color: #b26200;">⚠️ Staged Edits Waiting</strong>';
            echo '  <p style="font-size: 12px; color: #50575e; margin: 4px 0 0 0;">Submitted by ' . esc_html( $author_name ) . '<br>on ' . esc_html( $staged_data['submitted_at'] ) . '</p>';
            echo '</div>';
            echo '<a href="' . esc_url( $approve_url ) . '" class="button button-primary button-large" style="width:100%; text-align:center; display:block;">Approve & Merge to Live</a>';
        } else {
            echo '<p style="color: #46b450; font-weight: bold; margin: 0;">✅ Live content matches current revision.</p>';
        }
    }
}