<?php namespace surdaft\anook;
/*
Plugin Name: Anook
Plugin URI: http://wordpress.org/plugins/anook
Description: Anook.
Author: SurDaft
Version: 0.0.2
Author URI: http://surdaft.com/
*/

require(__DIR__ . '/autoloader.php');

/**
 * The base initialisation class, we use this to define
 * all the variables we require at startup.
 */
class Anook
{
    public function __construct()
    {
        // This allows us to implement feature flags in the future.
        define('SURDAFT_ANOOK_VERSION', '0.0.2');
        // Anook's api version
        define('SURDAFT_ANOOK_API_VERSION', 'v1');
        // So we know what the plugin's base directory is
        define('SURDAFT_ANOOK_DIRECTORY_PATH', __DIR__);
        
        return $this;
    }
    
    /**
     * Initialise all the hooks we need here, with a path
     * to the class and everything, to allow wordpress to
     * run the correct function.
     */
    public function initialiseHooks()
    {
        add_action('widgets_init', function() {
            register_widget('\surdaft\anook\widgets\AnookUserWidget');
        });
        
        return $this;
    }
}

// Init
$anook = (new Anook())->initialiseHooks();