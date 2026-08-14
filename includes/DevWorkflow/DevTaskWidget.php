<?php
namespace AnotherStep\DevWorkflow;

use WP_Query;

class DevTaskWidget
{
    public function init(): void 
    {
        add_action( 'wp_dashboard_setup', [ $this, 'register' ] );
    }

    public function register(): void 
    {
        if (current_user_can('edit_dev_tasks')) {
            wp_add_dashboard_widget(
                'as_dev_approvals',
                '🛡️ Dev Change Requests Pipeline',
                [$this, 'render']
            );
        }
    }

    public function render()
    {
        $query = new WP_Query([
            'post_type'      => 'dev_task',
            'post_status'    => ['pending', 'draft'],
            'posts_per_page' => 10,
        ]);

        if (!$query->have_posts()) {
            echo '<p style="color:green;">✅ No active dev requests awaiting sign-off.</p>';
            return;
        }

        echo '<ul>';
        while ($query->have_posts()) {
            $query->the_post();
            $stage = (int) get_post_meta(get_the_ID(), '_dev_approval_status', true) ?: 0;
            echo '<li style="margin-bottom:8px;"><strong>' . esc_html(get_the_title()) . '</strong> (Stage ' . ($stage + 1) . '/4) - <a href="' . esc_url(get_edit_post_link()) . '" class="button button-small">Gate Sign-off</a></li>';
        }
        echo '</ul>';
        wp_reset_postdata();
    }
}