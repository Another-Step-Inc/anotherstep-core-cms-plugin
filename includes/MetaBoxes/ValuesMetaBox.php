<?php
namespace AnotherStep\MetaBoxes;

class ValuesMetaBox
{
    public function init(): void 
    {
        add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
        add_action( 'save_post_values', [ $this, 'save_meta' ] );
    }

    public function add_meta_box(): void 
    {
        add_meta_box(
            'values_info',
            'Values Details',
            [ $this, 'render' ],
            'values',
            'normal',
            'high'
        );
    }

    public function render( \WP_POST $post ): void 
    {
        $icon  = get_post_meta( $post->ID, '_as_icon', true );
        $theme = get_post_meta( $post->ID, '_as_theme', true );
?>
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
        if ( array_key_exists( 'as_icon', $_POST ) ) { update_post_meta( $post_id, '_as_icon', $_POST['as_icon'] ); }
        if ( array_key_exists( 'as_theme', $_POST ) ) { update_post_meta( $post_id, '_as_theme', $_POST['as_theme'] ); }
    }
}