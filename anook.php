<?php namespace surdaft\anook;
/*
Plugin Name: Anook New
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Anook.
Author: SurDaft
Version: 0.1
Author URI: http://surdaft.com/
*/

spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'surdaft\\anook\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/src/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

use surdaft\anook\widgets\AnookUserWidget;

class Anook
{
    public function __construct()
    {

        define('SURDAFT_ANOOK_DIRECTORY_PATH', __DIR__);
        
        return $this;
    }
    
    public function initialiseHooks()
    {
        add_action('widgets_init', 'surdaft\anook\widgets\AnookUserWidget::register');
        
        return $this;
    }
}

$anook = (new Anook())->initialiseHooks();