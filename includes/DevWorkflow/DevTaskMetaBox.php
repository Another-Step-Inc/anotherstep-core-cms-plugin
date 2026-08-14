<?php
namespace AnotherStep\DevWorkflow;

class DevTaskMetaBox
{
    public function init(): void 
    {
        add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
        add_action('save_post_dev_task', [$this, 'save_meta_box']);
    }

    public function add_meta_boxes(): void 
    {
        add_meta_box(
            'dev_task_meta_box',
            __( 'Development Task Details' ),
            [ $this, 'render' ],
            'dev_task',
            'normal',
            'default'
        );
    }

    public function render($post): void 
    {
        wp_nonce_field('save_dev_task_details', 'dev_task_details_nonce');
        $scope       = get_post_meta($post->ID, '_dev_scope_type', true) ?: 'plugin';
        $github_pr   = get_post_meta($post->ID, '_dev_github_pr', true);
        $staging_url = get_post_meta($post->ID, '_dev_staging_url', true);
        $rollback    = get_post_meta($post->ID, '_dev_rollback_plan', true);
?>
        <p><label><strong>Component Scope:</strong></label>
        <select name="dev_scope_type" style="width:100%;">
            <option value="plugin" <?php selected($scope, 'plugin'); ?>>Custom Plugin</option>
            <option value="theme" <?php selected($scope, 'theme'); ?>>Custom Theme</option>
            <option value="api_headless" <?php selected($scope, 'api_headless'); ?>>REST / GraphQL API (Headless)</option>
            <option value="combined" <?php selected($scope, 'combined'); ?>>Combined</option>
        </select></p>
        <p><label><strong>GitHub Pull Request:</strong></label><input type="text" name="dev_github_pr" value="<?php echo esc_attr($github_pr); ?>" style="width:100%;" /></p>
        <p><label><strong>Staging Preview URL:</strong></label><input type="text" name="dev_staging_url" value="<?php echo esc_attr($staging_url); ?>" style="width:100%;" /></p>
        <p><label><strong>Rollback Instructions:</strong></label><textarea name="dev_rollback_plan" rows="3" style="width:100%;"><?php echo esc_textarea($rollback); ?></textarea></p>
<?php
    }

    public function save_meta_box($post_id) {
        if (!isset($_POST['dev_task_details_nonce']) || !wp_verify_nonce($_POST['dev_task_details_nonce'], 'save_dev_task_details')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST['dev_scope_type'])) update_post_meta($post_id, '_dev_scope_type', sanitize_text_field($_POST['dev_scope_type']));
        if (isset($_POST['dev_github_pr'])) update_post_meta($post_id, '_dev_github_pr', esc_url_raw($_POST['dev_github_pr']));
        if (isset($_POST['dev_staging_url'])) update_post_meta($post_id, '_dev_staging_url', esc_url_raw($_POST['dev_staging_url']));
        if (isset($_POST['dev_rollback_plan'])) update_post_meta($post_id, '_dev_rollback_plan', sanitize_textarea_field($_POST['dev_rollback_plan']));
    }
}