<?php
namespace AnotherStep\PostTypes;

abstract class AbstractPostType {
    abstract protected function get_slug(): string;
    abstract protected function get_singular_name(): string;
    abstract protected function get_plural_name(): string;
    abstract protected function get_icon(): string;

    public function init(): void {
        add_action('init', [$this, 'register']);
    }

    public function register(): void {
        $labels = [
            'name'  => $this->get_plural_name(),
            'singular_name' => $this->get_singular_name(),
            'menu_name' => 'Organization ' . $this->get_plural_name(),
        ];

        $args = [
            'labels'              => $labels,
            'public'              => true,
            'show_in_rest'        => true,
            'supports'            => [ 'title', 'editor', 'thumbnail' ],
            'menu_icon'           => $this->get_icon(),
            'show_in_graphql'     => true,
            'graphql_single_name' => strtolower( $this->get_singular_name() ),
            'graphql_plural_name' => strtolower( $this->get_plural_name() ),
        ];

        register_post_type( $this->get_slug(), $args );
    }
}