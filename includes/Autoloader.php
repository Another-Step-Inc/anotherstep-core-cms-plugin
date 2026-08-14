<?php
namespace AnotherStep;

class Autoloader
{
    public static function register(): void {
        spl_autoload_register(function ( $class) {
            $prefix = 'AnotherStep\\';
            $base_dir = AS_CORE_PATH . 'includes/';

            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                return;
            }

            $relative_class = substr($class, $len);
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
            if (file_exists($file)) {
                require $file;
            }
        });
    }
}