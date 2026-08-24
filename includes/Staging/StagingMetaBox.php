<?php
namespace AnotherStep\Staging;

class StagingMetaBox {
    public function init(): void {
        add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
    }

    public function add_meta_boxes(): void {
        add_meta_box(
            'as_merge_request',
            'Content Staging & Approval Status',
            [ $this, 'render' ],
            [ 'post', 'page', 'services', 'values', 'promos' ],
            'side',
            'high'
        );
    }

    public function render( \WP_Post $post ): void {
        $staged_data     = get_post_meta( $post->ID, '_as_pending_approval_data', true );
        $current_user_id = get_current_user_id();
        $can_approve     = current_user_can( 'approve_content_merge' );

        // 1. STATE: LIVE / NO STAGED EDITS
        if ( empty( $staged_data ) || ! is_array( $staged_data ) ) {
            $last_approved_by = (int) get_post_meta( $post->ID, '_as_last_approved_by', true );
            $last_approved_at = get_post_meta( $post->ID, '_as_last_approved_at', true );

            echo '<div style="background: #e7f4e4; border-left: 4px solid #46b450; padding: 10px; margin-bottom: 8px;">';
            echo '  <strong style="color: #2e602f;">✅ Live & Up-to-Date</strong>';
            echo '  <p style="font-size: 11px; color: #4b634c; margin: 4px 0 0 0;">The current live site matches this revision.</p>';
            echo '</div>';

            if ( $last_approved_by && $last_approved_at ) {
                $user          = get_userdata( $last_approved_by );
                $approver_name = $user ? $user->display_name : 'Reviewer';
                echo '<p style="font-size: 11px; color: #646970; margin: 0;">Last merged by <strong>' . esc_html( $approver_name ) . '</strong> on ' . esc_html( $last_approved_at ) . '</p>';
            }

            return;
        }

        // 2. STATE: STAGED EDITS PENDING REVIEW
        $submitted_by_id    = (int) ( $staged_data['submitted_by'] ?? 0 );
        $user_info          = get_userdata( $submitted_by_id );
        $author_name        = $user_info ? $user_info->display_name : 'An editor';
        $is_self_submission = ( $submitted_by_id === $current_user_id );
        $rev_count          = (int) ( $staged_data['revision_cnt'] ?? 1 );

        echo '<div style="background: #fff8e5; border-left: 4px solid #dba617; padding: 10px; margin-bottom: 12px;">';
        echo '  <strong style="color: #b26200;">⚠️ Staged Edits Pending Review</strong>';
        echo '  <p style="font-size: 12px; color: #50575e; margin: 4px 0 0 0;">Last updated by ' . esc_html( $author_name ) . '<br>on ' . esc_html( $staged_data['submitted_at'] ) . '</p>';
        
        if ( $rev_count > 1 ) {
            echo '  <span style="display:inline-block; margin-top: 4px; background: #ed8936; color: #fff; padding: 1px 6px; border-radius: 3px; font-size: 10px; font-weight: bold;">Updated ' . $rev_count . 'x in staging</span>';
        }
        
        echo '</div>';

        // Show staged content summary
        $staged_title   = $staged_data['post_title'] ?? '';
        $staged_content = $staged_data['post_content'] ?? '';

        echo '<details style="margin-bottom: 12px; font-size: 11px; background: #f6f7f7; padding: 8px; border-radius: 4px;">';
        echo '  <summary style="cursor: pointer; font-weight: 600;">🔍 View Staged Content Payload</summary>';
        echo '  <p style="margin: 6px 0 2px 0;"><strong>Staged Title:</strong> ' . esc_html( $staged_title ) . '</p>';
        echo '  <div style="max-height: 100px; overflow-y: auto; background: #fff; padding: 6px; border: 1px solid #dcdcde; margin-top: 4px;">';
        echo      esc_html( wp_strip_all_tags( $staged_content ) );
        echo '  </div>';
        echo '</details>';

        // 3. ACTIONS & FEEDBACK
        if ( $can_approve && ! $is_self_submission ) {
            $approve_url = wp_nonce_url(
                admin_url( 'admin-post.php?action=as_approve_content_merge&post_id=' . $post->ID ),
                'as_approve_action_' . $post->ID
            );

            echo '<a href="' . esc_url( $approve_url ) . '" class="button button-primary button-large" style="width:100%; text-align:center; display:block;">Approve & Merge to Live</a>';
        } elseif ( $can_approve && $is_self_submission ) {
            echo '<div style="background: #e5f5fa; border-left: 4px solid #00a0d2; padding: 8px; font-size: 12px; color: #0073aa;">';
            echo '  ℹ️ <strong>Checks & Balances:</strong> You staged these changes. A second reviewer must sign off to merge them to live.';
            echo '</div>';
        } else {
            echo '<div style="background: #f0f0f1; border-left: 4px solid #72777c; padding: 8px; font-size: 12px; color: #2c3338;">';
            echo '  🔒 <strong>Awaiting Editorial Review:</strong> Your staged changes are saved in revision draft. Live content will update once approved.';
            echo '</div>';
        }
    }
}