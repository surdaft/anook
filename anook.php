<?php namespace surdaft\anook;
/*
Plugin Name: Anook New
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Anook.
Author: SurDaft
Version: 0.1
Author URI: http://surdaft.com/
*/

require('./autoloader.php');

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