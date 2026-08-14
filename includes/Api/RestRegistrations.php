<?php
namespace AnotherStep\Api;

class RestRegistrations 
{
    public function init(): void {
        add_action( 'rest_api_init', [$this, 'register_rest_fields'] );
    }

    public function register_rest_fields(): void {
        register_rest_field( 'services', 'artist_details', [
            'get_callback' => function( $post ) {
                return [
                    'name'         => get_post_meta( $post['id'], '_as_artist_name', true ),
                    'service_type' => get_post_meta( $post['id'], '_as_service_type', true ),
                ];
            },
        ]);

        register_rest_field( [ 'values', 'services' ], 'cardIcon', [
            'get_callback' => fn( $post ) => get_post_meta( $post['id'], '_as_icon', true ),
        ]);

        register_rest_field( [ 'values', 'services' ], 'cardTheme', [
            'get_callback' => fn( $post ) => get_post_meta( $post['id'], '_as_theme', true ),
        ]);
    }
}