<?php
namespace AnotherStep\Staging;

class StagingInterceptor 
{
    public function init(): void {
        $post_types = ['post', 'page', 'services', 'values', 'promos'];
        foreach ( $post_types as $type ) {
            add_filter( "rest_pre_insert_{$type}", [$this, 'intercept_staged_edits'], 10, 2 );
            add_filter( "rest_prepare_{$type}", [ $this, 'inject_staged_content_into_editor' ], 10, 3 );
        }

        add_filter( 'wp_check_post_lock', [ $this, 'conditionally_allow_staged_access' ], 10, 2 );
    }

    public function conditionally_allow_staged_access( $response, $post_id ) {
        $staged_data = get_post_meta( $post_id, '_as_pending_approval_data', true );

        // If staged data exists, bypass hard lock block so approvers can open the editor
        if ( ! empty( $staged_data ) ) {
            return false;
        }

        return $response;
    }

    public function inject_staged_content_into_editor( $response, $post, $request ) {
        if ( $request->get_method() === 'GET' && isset( $response->data ) ) {
            $staged_data = get_post_meta( $post->ID, '_as_pending_approval_data', true );
            if ( ! empty( $staged_data ) && is_array( $staged_data ) ) {
                if ( isset( $staged_data['post_title'] ) ) {
                    $response->data['title']['raw']    = $staged_data['post_title'];
                    $response->data['title']['rendered'] = esc_html( $staged_data['post_title'] );
                }
                if ( isset( $staged_data['post_content'] ) ) {
                    $response->data['content']['raw']      = $staged_data['post_content'];
                    $response->data['content']['rendered'] = apply_filters( 'the_content', $staged_data['post_content'] );
                }
            }
        }
        return $response;
    }

    public function intercept_staged_edits( $prepared_post, $request ) {
        // Bypass when performing an authorized merge operation
        if ( defined( 'AS_DOING_MERGE' ) && AS_DOING_MERGE ) {
            return $prepared_post;
        }

        if ( empty( $prepared_post->ID ) ) {
            return $prepared_post;
        }

        $post_id    = $prepared_post->ID;
        $old_status = get_post_status( $post_id );

        if ( ! current_user_can( 'approve_content_merge' ) ) {
            $raw_content = ! empty( $prepared_post->post_content ) 
            ? $prepared_post->post_content 
            : get_post_field( 'post_content', $post_id );

            $clean_content = preg_replace_callback(
                '/\\\\u([0-9a-fA-F]{4})/',
                function ( $match ) {
                    return mb_convert_encoding( pack( 'H*', $match[1] ), 'UTF-8', 'UCS-2BE' );
                },
                $raw_content
            );

            $clean_content = wp_unslash( $clean_content );

            $staged_data = [
                'post_title'   => ! empty( $prepared_post->post_title ) ? $prepared_post->post_title : get_the_title( $post_id ),
                'post_content' => $clean_content,
                'submitted_by' => get_current_user_id(),
                'submitted_at' => current_time( 'mysql' ),
            ];

            update_post_meta( $post_id, '_as_pending_approval_data', $staged_data );

            delete_post_meta( $post_id, '_edit_lock' );

            if ( $old_status === 'publish' ) {
                $prepared_post->post_status  = 'publish';
                $live_post                   = get_post( $post_id );
                $prepared_post->post_title   = $live_post->post_title;
                $prepared_post->post_content = $live_post->post_content;
            }
        }

        return $prepared_post;
    }
}