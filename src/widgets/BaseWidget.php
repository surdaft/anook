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
        
        parent::__construct($classname, $widget_name, $widget_options);
    }
    
    
    /**
     * Render the frontend widget
     * @param $args         array   The arguments related to extra widget data, like before and after widget
     * @param $widget_data  array   The data contained in the widget, eg the widgets name
     */
    public function widget($args, $widget_data)
    {
        // Get the data we need for the frontend via the api
        $variables = $this->getData($widget_data);
        
        echo $args['before_widget'];
        echo $this->render($this->template_name, $variables);
        echo $args['after_widget'];
    }
    
    /**
     * Render the backend widget form
     * @param $widget_data  array   The data contained in the widget, eg the widgets name
     */
    public function form($widget_data)
    {
        echo $this->render($this->options_template_name, $widget_data);
    }
    
    /**
     * Update
     * Pass this off to the controller
     * @param $new_data     array
     * @param $old_data     array
     */
    public function update($new_data, $old_data)
    {
        WidgetsController::update($new_data, $old_data);
    }
}