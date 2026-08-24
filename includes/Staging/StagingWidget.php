<?php
namespace AnotherStep\Staging;

class StagingWidget {
    public function init(): void {
        add_action( 'wp_dashboard_setup', [ $this, 'add_dashboard_widget' ] );
    }

    public function add_dashboard_widget(): void {
        wp_add_dashboard_widget(
            'as_pending_approvals_widget',
            '📋 Content Staging & Approval Status',
            [ $this, 'render' ]
        );
    }

    public function render(): void {
        global $wpdb;
        $current_user_id = get_current_user_id();

        // 1. Optimized direct SQL query for pending staging entries
        $pending_posts = $wpdb->get_results( "
            SELECT p.ID, p.post_title, pm.meta_value 
            FROM {$wpdb->posts} p
            INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
            WHERE pm.meta_key = '_as_pending_approval_data'
            LIMIT 10
        " );

        // 2. Optimized direct SQL query for recent approvals
        $approved_posts = $wpdb->get_results( "
            SELECT p.ID, p.post_title, pm.meta_value 
            FROM {$wpdb->posts} p
            INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
            WHERE pm.meta_key = '_as_last_approved_at'
            ORDER BY pm.meta_value DESC
            LIMIT 5
        " );

        if ( empty( $pending_posts ) && empty( $approved_posts ) ) {
            echo '<p style="color: #46b450; font-weight: bold; margin: 0;">✅ All clear! No pending edits or recent merge activity.</p>';
            return;
        }

        // --- SECTION 1: PENDING APPROVALS ---
        echo '<h4 style="margin: 0 0 8px 0; color: #1d2327;">⏳ Pending Approval / Peer Review</h4>';
        
        if ( ! empty( $pending_posts ) ) {
            echo '<ul style="margin: 0 0 16px 0; padding-left: 0; list-style: none;">';

            foreach ( $pending_posts as $item ) {
                $post_id      = $item->ID;
                $title        = $item->post_title ?: '(Untitled)';
                $edit_link    = get_edit_post_link( $post_id );
                $staged       = maybe_unserialize( $item->meta_value );
                $submitter_id = ! empty( $staged['submitted_by'] ) ? (int) $staged['submitted_by'] : 0;
                $user         = $submitter_id ? get_userdata( $submitter_id ) : false;
                $author_name  = $user ? $user->display_name : 'Editor';

                $status_badge = ( $submitter_id === $current_user_id )
                    ? '<span style="background: #e5f5fa; color: #0073aa; padding: 2px 6px; border-radius: 3px; font-size: 11px;">Your Edits</span>'
                    : '<span style="background: #fff8e5; color: #b26200; padding: 2px 6px; border-radius: 3px; font-size: 11px;">Awaiting Review</span>';

                echo '<li style="padding: 8px 0; border-bottom: 1px solid #f0f0f1; display: flex; align-items: center; justify-content: space-between;">';
                echo '  <div style="max-width: 70%;">';
                echo '      <strong style="display: block; font-size: 13px;"><a href="' . esc_url( $edit_link ) . '">' . esc_html( $title ) . '</a></strong>';
                echo '      <span style="font-size: 11px; color: #646970;">Staged by ' . esc_html( $author_name ) . '</span>';
                echo '  </div>';
                echo '  <div>' . $status_badge . '</div>';
                echo '</li>';
            }

            echo '</ul>';
        } else {
            echo '<p style="color: #646970; font-size: 12px; margin-bottom: 16px;">No content edits currently waiting for approval.</p>';
        }

        // --- SECTION 2: RECENTLY APPROVED & MERGED ---
        if ( ! empty( $approved_posts ) ) {
            echo '<h4 style="margin: 0 0 8px 0; color: #1d2327;">✔ Recently Approved & Merged Live</h4>';
            echo '<ul style="margin: 0; padding-left: 0; list-style: none;">';

            foreach ( $approved_posts as $item ) {
                $post_id     = $item->ID;
                $title       = $item->post_title ?: '(Untitled)';
                $edit_link   = get_edit_post_link( $post_id );
                $approved_at = $item->meta_value;
                $approver_id = (int) get_post_meta( $post_id, '_as_last_approved_by', true );
                $user        = $approver_id ? get_userdata( $approver_id ) : false;
                $approver    = $user ? $user->display_name : 'Reviewer';

                echo '<li style="padding: 6px 0; border-bottom: 1px solid #f0f0f1; display: flex; align-items: center; justify-content: space-between;">';
                echo '  <div style="max-width: 70%;">';
                echo '      <a href="' . esc_url( $edit_link ) . '" style="font-size: 13px; font-weight: 600;">' . esc_html( $title ) . '</a>';
                echo '      <span style="display:block; font-size: 11px; color: #646970;">Merged by ' . esc_html( $approver ) . ' on ' . esc_html( $approved_at ) . '</span>';
                echo '  </div>';
                echo '  <div><span style="background: #d4edda; color: #155724; padding: 2px 6px; border-radius: 3px; font-size: 11px; font-weight:bold;">LIVE</span></div>';
                echo '</li>';
            }

            echo '</ul>';
        }
    }
}