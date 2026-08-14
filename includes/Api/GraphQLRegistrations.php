<?php
namespace AnotherStep\Api;

class GraphQLRegistrations
{
    public function init(): void
    {
        add_action( 'graphql_register_types', [ $this, 'register_graphql_types'] );
    }

    public function register_graphql_types(): void
    {
        $types_to_register_on = [ 'Value', 'Service' ];

        foreach ( $types_to_register_on as $type_name ) {
            register_graphql_field( $type_name, 'cardIcon', [
                'type'        => 'String',
                'description' => __( 'The visual icon defined for this card layout', 'anotherstep' ),
                'resolve'     => function( \WPGraphQL\Model\Post $post ) {
                    return get_post_meta( $post->databaseId, '_as_icon', true );
                }
            ] );

            register_graphql_field( $type_name, 'cardTheme', [
                'type'        => 'String',
                'description' => __( 'The background style theme mapping class', 'anotherstep' ),
                'resolve'     => function( \WPGraphQL\Model\Post $post ) {
                    return get_post_meta( $post->databaseId, '_as_theme', true );
                }
            ] );
        }
    }
}