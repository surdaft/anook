<?php namespace surdaft\anook\traits;

trait Widget
{
    public static function register()
    {
        register_widget(get_class());
    }
}