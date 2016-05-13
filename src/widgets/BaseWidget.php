<?php namespace surdaft\anook\widgets;

use surdaft\anook\exceptions\WidgetException;
use surdaft\anook\interfaces\WidgetInterface;

/**
 * This base widget extends the initial Wordpress widget that
 * is required.
 */
class BaseWidget extends \WP_Widget implements WidgetInterface
{
    public function __construct($classname, $widget_name, $widget_options)
    {
        /**
         * We require these static constants
         */
        if (empty(static::WIDGET_NAME)) {
            throw new WidgetException("Static constant WIDGET_NAME is required.");
        }
        
        if (empty(static::TEMPLATE_NAME)) {
            throw new WidgetException("Static constant TEMPLATE_NAME is required.");
        }
        
        if (empty(static::TEMPLATE_NAME)) {
            throw new WidgetException("Static constant OPTIONS_TEMPLATE_NAME is required.");
        }
        
        parent::__construct($classname, $widget_name, $widget_options);
    }
}