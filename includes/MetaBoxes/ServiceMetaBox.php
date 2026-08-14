<?php
namespace AnotherStep\MetaBoxes;

class ServiceMetaBox
{
    public function init() : void
    {
        add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
        add_action( 'save_post_services', [ $this, 'save_meta' ] );
    }

    public function add_meta_box(): void
    {
        add_meta_box(
            'service_info',
            'Service Details',
            [ $this, 'render' ],
            'services',
            'normal',
            'high'
        );
    }

    public function render( \WP_POST $post ): void
    {
        $artist = get_post_meta ( $post->ID, '_as_artist_name', true );
        $icon   = get_post_meta( $post->ID, '_as_icon', true );
        $theme  = get_post_meta( $post->ID, '_as_theme', true );
?>
        <p>
            <label for="as_artist_name"><strong>Artist Name (for Drawings):</strong></label><br />
            <input type="text" name="as_artist_name" value="<?php echo esc_attr( $artist ); ?>" style="width:100%;" />
        </p>
        <p>
            <label for="as_icon"><strong>Card Icon:</strong></label><br />
            <input type="text" name="as_icon" value="<?php echo esc_attr( $icon ); ?>" style="width:100%;" />
        </p>
        <p>
            <label for="as_theme"><strong>Card Theme:</strong></label><br />
            <input type="text" name="as_theme" value="<?php echo esc_attr( $theme ); ?>" style="width:100%;" />
        </p>
<?php
    }

    public function save_meta( int $post_id ): void 
    {
        if ( array_key_exists( 'as_artist_name', $_POST ) ) { update_post_meta( $post_id, '_as_artist_name', $_POST['as_artist_name'] ); }
        if ( array_key_exists( 'as_icon', $_POST ) ) { update_post_meta( $post_id, '_as_icon', $_POST['as_icon'] ); }
        if ( array_key_exists( 'as_theme', $_POST ) ) { update_post_meta( $post_id, '_as_theme', $_POST['as_theme'] ); }
    }
}