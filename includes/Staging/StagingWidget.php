<?php
namespace AnotherStep\Staging;

class StagingWidget {
    public function init(): void {
        add_action( 'wp_dashboard_setup', [ $this, 'add_dashboard_widget' ] );
    }

    public function add_dashboard_widget(): void {
        if ( current_user_can( 'approve_content_merge' ) ) {
            wp_add_dashboard_widget(
                'as_pending_approvals_widget',
                '📋 Content Pending Approval',
                [ $this, 'render' ]
            );
        }
    }

    public function render(): void {
        $query = new \WP_Query([
            'post_type'      => [ 'post', 'page', 'services', 'values', 'promos' ],
            'post_status'    => [ 'publish', 'draft', 'pending' ],
            'meta_key'       => '_as_pending_approval_data',
            'posts_per_page' => 10,
        ]);

        if ( ! $query->have_posts() ) {
            echo '<p style="color: #46b450; font-weight: bold; margin: 0;">✅ All clear! No pending edits awaiting review.</p>';
            return;
        }

        echo '<p style="margin-top:0; color: #50575e;">The following posts have staged edits waiting for merge:</p>';
        echo '<ul style="margin: 0; padding-left: 0; list-style: none;">';

        while ( $query->have_posts() ) {
            $query->the_post();
            $post_id       = get_the_ID();
            $title         = get_the_title() ?: '(Untitled)';
            $post_type_obj = get_post_type_object( get_post_type() );
            $post_type     = $post_type_obj ? $post_type_obj->labels->singular_name : 'Post';
            $edit_link     = get_edit_post_link( $post_id );
            $staged        = get_post_meta( $post_id, '_as_pending_approval_data', true );
            $author        = ! empty( $staged['submitted_by'] ) ? get_userdata( $staged['submitted_by'] )->display_name : 'Editor';

            echo '<li style="padding: 10px 0; border-bottom: 1px solid #f0f0f1; display: flex; align-items: center; justify-content: space-between;">';
            echo '  <div style="max-width: 70%;">';
            echo '      <strong style="display: block; font-size: 14px;"><a href="' . esc_url( $edit_link ) . '">' . esc_html( $title ) . '</a></strong>';
            echo '      <span style="font-size: 12px; color: #646970;">' . esc_html( $post_type ) . ' • Staged by ' . esc_html( $author ) . '</span>';
            echo '  </div>';
            echo '  <div style="text-align: right;">';
            echo '      <a href="' . esc_url( $edit_link ) . '" class="button button-small button-primary">Review Edits</a>';
            echo '  </div>';
            echo '</li>';
        }

        echo '</ul>';
        wp_reset_postdata();
    }
}