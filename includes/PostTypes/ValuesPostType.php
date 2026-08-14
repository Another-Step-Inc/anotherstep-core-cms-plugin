<?php
namespace AnotherStep\PostTypes;

class ValuesPostType extends AbstractPostType 
{
    protected function get_slug(): string { return 'values'; }
    protected function get_singular_name(): string { return 'Value'; }
    protected function get_plural_name(): string { return 'Values'; }
    protected function get_icon(): string { return 'dashicons-heart'; }
}