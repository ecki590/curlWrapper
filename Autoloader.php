<?php
/**
 * Simple autoloader, so we don't need Composer just for this.
 */
final class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
            // echo 'File: ' . $file;
            if (file_exists($file)) {
                require $file;
                // echo ' Exists!';
                return true;
            }
            // echo ' Does not exist!';
            return false;
        });
    }
}
Autoloader::register();