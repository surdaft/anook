<?php namespace surdaft\anook\widgets;

use surdaft\anook\exceptions\WidgetException;
use surdaft\anook\interfaces\WidgetInterface;
use surdaft\anook\controllers\WidgetsController;

use surdaft\anook\Debug;

/**
 * This base widget extends the initial Wordpress widget that
 * is required.
 */
class BaseWidget extends \WP_Widget implements WidgetInterface
{
    /**
     * Do not put any symbols other than underscores within your widget name
     * Otherwise it will cause it to be unable to save.
     */
    public function __construct($widget_id, $widget_name, $widget_options)
    {
        if (preg_match('/(\\\|\\/)/', $widget_id)) {
            throw new WidgetException("Widget ID cannot contain any slashes, this causes errors with saving due to wordpress add_slashes.");
        }
        
        parent::__construct($widget_id, $widget_name, $widget_options);
    }
    
    
    /**
     * Render the frontend widget
     * @param $args         array   The arguments related to extra widget data, like before and after widget
     * @param $widget_data  array   The data contained in the widget, eg the widgets name
     */
    public function widget($args, $widget_data)
    {
        // Get the data we need for the frontend via the api
        $variables = array_merge($widget_data, $this->getData($widget_data));
        
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
        echo $this->render($this->options_template_name, $widget_data, [
            'disable_cache' => true // we don't need caching on the admins end
        ]);
    }
    
    /**
     * Update
     * Pass this off to the controller
     * @param $new_data     array
     * @param $old_data     array
     */
    public function update($new_data, $old_data)
    {
        return WidgetsController::update($new_data, $old_data);
    }
    
    /**
     * This function is used within this BaseWidget BUT
     * it uses the widget it extends getData.
     * 
     * @TODO: How would this be better shown as required?
     * Extend the widget interface with a new one that adds it?
     */
    public function getData(array $widget_data)
    {
        return $widget_data;
    }
}