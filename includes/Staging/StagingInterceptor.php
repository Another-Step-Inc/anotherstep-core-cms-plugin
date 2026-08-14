<?php
namespace AnotherStep\Staging;

class StagingInterceptor 
{
    public function init(): void {
        $post_types = ['post', 'page', 'services', 'values', 'promos'];
        foreach ( $post_types as $type ) {
            add_filter( "rest_pre_insert_{$type}", [$this, 'intercept_staged_edits'], 10, 2 );
        }
    }

    public function intercept_staged_edits( $prepared_post, $request ) {
        if ( empty( $prepared_post->ID ) ) return $prepared_post;

        $post_id    = $prepared_post->ID;
        $old_status = get_post_status( $post_id );

        if ( ! current_user_can( 'approve_content_merge' ) ) {
            $staged_data = [
                'post_title'   => ! empty( $prepared_post->post_title ) ? $prepared_post->post_title : get_the_title( $post_id ),
                'post_content' => ! empty( $prepared_post->post_content ) ? $prepared_post->post_content : get_post_field( 'post_content', $post_id ),
                'submitted_by' => get_current_user_id(),
                'submitted_at' => current_time( 'mysql' ),
            ];

            update_post_meta( $post_id, '_as_pending_approval_data', $staged_data );

            if ( $old_status === 'publish' ) {
                $prepared_post->post_status = 'publish';
                $live_post = get_post( $post_id );
                $prepared_post->post_title   = $live_post->post_title;
                $prepared_post->post_content = $live_post->post_content;
            }
        }

        return $prepared_post;
    }
}