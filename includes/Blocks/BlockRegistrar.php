<?php
namespace AnotherStep\Blocks;

class BlockRegistrar
{
    public function init(): void {
        add_action( 'init', [ $this, 'register_blocks' ] );
        add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_styles' ] );
    }

    public function register_blocks(): void {
        $build_dir = AS_CORE_PATH . 'blocks/build';
        if ( file_exists( $build_dir . '/blocks-manifest.php' ) ) {
            wp_register_block_types_from_metadata_collection(
                $build_dir,
                $build_dir . '/blocks-manifest.php'
            );
        }
    }

    public function enqueue_block_styles(): void {
        $script_path = AS_CORE_PATH . 'assets/js/block-styles.js';
        $script_url  = AS_CORE_URL . 'assets/js/block-styles.js';

        if ( file_exists( $script_path ) ) {
            wp_enqueue_script(
                'anotherstep-block-styles',
                $script_url,
                [ 'wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-element' ],
                filemtime( $script_path ),
                true
            );
        }
    }
}