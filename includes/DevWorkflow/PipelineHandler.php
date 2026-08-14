<?php
namespace AnotherStep\DevWorkflow;

class PipelineHandler
{
    public function init(): void 
    {
        add_action( 'save_post_dev_task', [ $this, 'process_approval_gate'], 10, 2 );
        add_filter( 'redirect_post_location', [ $this, 'keep_on_edit_screen' ], 10, 2 );
    }

    public function process_approval_gate($post_id, $post): void 
    {
        if ( !isset($_POST['dev_approval_gate_nonce']) || !wp_verify_nonce($_POST['dev_approval_gate_nonce'], 'process_approval_gate') ) {
            return;
        }

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
        if( !current_user_can('edit_post', $post_id) ) return;

        $current_stage = (int) get_post_meta( $post_id, '_dev_approval_status', true ) ?: 0;

        // Advance stage if checkbox was ticked
        if ( isset($_POST['advance_to_next_stage']) && $_POST['advance_to_next_stage'] == '1' ) {
            if ( $current_stage < 4 ) {
                $new_stage = $current_stage + 1;
                $user = wp_get_current_user();

                update_post_meta( $post_id, '_dev_approval_status', $new_stage );

                $audit_log = get_post_meta( $post_id, '_dev_approval_audit_log', true ) ?: [];
                $audit_log[] = [
                    'stage' => $new_stage,
                    'user_id' => $user->ID,
                    'user_name' => $user->display_name ?: $user->user_login,
                    'timestamp' => current_time('mysql'),
                ];
                update_post_meta( $post_id, '_dev_approval_audit_log', $audit_log );
                $current_stage = $new_stage;
            }
        }

        // Keep post status synced: Pending until all 4 stages are complete
        $target_status = $current_stage === 4 ? 'publish' : 'pending';
        if ( $post->post_status !== $target_status ) {
            remove_action( 'save_post_dev_task', [ $this, 'process_approval_gate' ], 10 );
            wp_update_post( [
                'ID' => $post->ID,
                'post_status' => $target_status
            ] );
            add_action( 'save_post_dev_task', [ $this, 'process_approval_gate' ], 10, 2 );
        }

        // Stage 4 triggers build webhook for Astro deployment
        if ( $current_stage === 4 ) {
            $this->trigger_deployment_webhook( $post_id );
        }
    }

    public function keep_on_edit_screen($location, $post_id): string
    {
        if ( get_post_type($post_id) === 'dev_task' ) {
            return admin_url('post.php?post=' . $post_id . '&action=edit&message=6');
        }
        return $location;
    }

    public function trigger_deployment_webhook($post_id): void
    {
        $webhook_url = get_option('dev_deployment_webhook_url');
        if ( $webhook_url ) {
            wp_remote_post( $webhook_url, [
                'body' => json_encode( [
                    'post_id' => $post_id,
                    'timestamp' => current_time('mysql')
                ] ),
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ] );
        }
    }
}