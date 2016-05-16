<?php namespace surdaft\anook\interfaces;

interface WidgetInterface
{
    /**
	 * Outputs the content of the widget
	 * @param array $args
	 * @param array $instance
	 */
    public function widget($args, $instance);
    
    /**
	 * Outputs the options form on admin
	 * @param array $instance The widget options
	 */
	 public function form($instance);
	 
	 /**
	 * Processing widget options on save
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	 public function update($new_instance, $old_instance);
	 
	 /**
	  * Get the widgets data from the api
	  * @param array $widget_data The data related to the widget
	  * @return array
	  */
	 public function getData(array $widget_data);
}