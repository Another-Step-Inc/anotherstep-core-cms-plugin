<?php
namespace AnotherStep\PostTypes;

class ServicePostType extends AbstractPostType 
{
    protected function get_slug(): string { return 'services'; }
    protected function get_singular_name(): string { return 'Service'; }
    protected function get_plural_name(): string { return 'Services'; }
    protected function get_icon(): string { return 'dashicons-money-alt'; }
}