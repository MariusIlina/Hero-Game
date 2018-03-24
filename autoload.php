<?php

/**
 * Class AutoLoader
 *
 * Thanks to http://docs.php.net/manual/da/language.oop5.autoload.php#120258
 */
class AutoLoader
{
    /**
     * Loads all classes from project.
     *
     * @return mixed
     */
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
            if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });
    }
}

AutoLoader::register();