<?php
namespace AnotherStep\DevWorkflow;

class DevTaskPostType
{
    public function init(): void 
    {
        add_action( 'init', [ $this, 'register' ] );
        add_action( 'admin_head-post.php', [ $this, 'hide_publish_button_until_stage_4' ] );
        add_action( 'admin_head-post-new.php', [ $this, 'hide_publish_button_until_stage_4' ] );
        
        // Dynamic Save Button Labels
        add_filter( 'gettext', [ $this, 'customize_save_button_labels' ], 10, 3 );
    }

    public function register(): void 
    {
        register_post_type( 'dev_task', [
            'labels' => [
                'name'               => 'Dev Tasks',
                'singular_name'      => 'Dev Task',
                'menu_name'          => 'Dev Change Requests',
                'add_new_item'       => 'Create Dev Change Request',
                'edit_item'          => 'Review Dev Task',
            ],
            'public'          => false,
            'show_ui'         => true,
            'show_in_menu'    => true,
            'menu_icon'       => 'dashicons-shield',
            'capability_type' => ['dev_task', 'dev_tasks'],
            'map_meta_cap'    => true,
            'supports'        => ['title', 'editor', 'author', 'revisions'],
        ] );
    }

    /**
     * Hide standard WP publish controls so release is strictly driven by Stage 4 sign-off.
     */
    public function hide_publish_button_until_stage_4(): void
    {
        global $post;

        if ( ! $post || $post->post_type !== 'dev_task' ) {
            return;
        }

        $current_stage = (int) get_post_meta( $post->ID, '_dev_approval_status', true ) ?: 0;

        // If Stage 4 isn't completed, hide the main Publish/Submit button
        if ( $current_stage < 4 ) {
            ?>
            <style>
                /* Hide the main publish/submit button */
                #publishing-action #publish {
                    display: none !important;
                }
                /* Hide status dropdown to prevent manual overrides */
                #misc-publishing-actions .misc-pub-post-status {
                    display: none !important;
                }
            </style>
            <?php
        }
    }

    /**
     * Customize Save button text based on user capabilities.
     */
    public function customize_save_button_labels( $translation, $text, $domain ): string
    {
        global $post;

        if ( is_admin() && isset( $post ) && $post->post_type === 'dev_task' ) {
            
            // Standard target strings used by WP Save/Draft buttons
            if ( in_array( $text, [ 'Save Draft', 'Save Pending' ], true ) ) {
                
                // If the user lacks publishing power (Developers), show explicit submission text
                if ( ! current_user_can( 'publish_dev_tasks' ) ) {
                    return 'Submit Change Request for Review';
                }
                
                // For Approvers and Admins, shorten to "Save"
                return 'Save';
            }
        }

        return $translation;
    }
}