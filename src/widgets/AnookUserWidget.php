<?php namespace surdaft\anook\widgets;

use surdaft\anook\traits\Widget;
use surdaft\anook\traits\Templates;
use surdaft\anook\exceptions\WidgetException;
use sardaft\anook\controllers\WidgetsController;

/**
 * Anook User Widget
 * This widget shows an anook users profile in the sidebar.
 */
class AnookUserWidget extends BaseWidget implements WidgetInterface
{
    // use the traits of a widget
    use Widget;
    // allow us to render template files
    use Templates;
    
    // the name of the widget
    const WIDGET_NAME = "Anook User Widget";
    
    // name of the widgets frontend template file
    const TEMPLATE_NAME = "widgets.user";
    // name of the backend template file for the widgets menu
    const OPTIONS_TEMPLATE_NAME = "widget_options.user";
    
    /**
     * Defines the info to pass to wordpress about the widgets name
     * location and description.
     */
    public function __construct()
    {
        $widget_options = [
            'classname' => get_class(),
            'description' => "Show your anook profile in the sidebar."
        ];
        
        /**
         * We require these static constants
         */
        if (empty(self::WIDGET_NAME)) {
            throw new WidgetException("Static constant WIDGET_NAME is required.");
        }
        
        if (empty(self::TEMPLATE_NAME)) {
            throw new WidgetException("Static constant TEMPLATE_NAME is required.");
        }
        
        if (empty(self::TEMPLATE_NAME)) {
            throw new WidgetException("Static constant OPTIONS_TEMPLATE_NAME is required.");
        }
        
        parent::__construct(get_class(), self::WIDGET_NAME, $widget_options);
    }
    
    /**
     * Render the frontend widget
     * @param $args         array   The arguments related to extra widget data, like before and after widget
     * @param $widget_data  array   The data contained in the widget, eg the widgets name
     */
    public function widget(array $args, array $widget_data)
    {
        echo $args['before_widget'];
        echo $this->render(self::TEMPLATE_NAME, $widget_data);
        echo $args['after_widget'];
    }
    
    /**
     * Render the backend widget form
     * @param $widget_data  array   The data contained in the widget, eg the widgets name
     */
    public function form(array $widget_data)
    {
        echo $this->render(self::OPTIONS_TEMPLATE_NAME, $widget_data);
    }
    
    /**
     * Update
     * Pass this off to the controller
     * @param $new_data     array
     * @param $old_data     array
     */
    public function update(array $new_data, array $old_data)
    {
        WidgetsController::update($new_data, $old_data);
    }
}