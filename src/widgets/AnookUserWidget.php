<?php namespace surdaft\anook\widgets;

use surdaft\anook\traits\Widget;
use surdaft\anook\traits\Templates;
use surdaft\anook\exceptions\WidgetException;
use sardaft\anook\controllers\WidgetsController;

class AnookUserWidget extends BaseWidget
{
    use Widget;
    use Templates;
    
    const WIDGET_NAME = "Anook User Widget";
    
    const TEMPLATE_NAME = "widgets.user";
    const OPTIONS_TEMPLATE_NAME = "widget_options.user";
    
    public function __construct()
    {
        $widget_options = [
            'classname' => get_class(),
            'description' => "Show your anook profile in the sidebar."
        ];
        
        if (empty(self::WIDGET_NAME)) {
            throw new WidgetException("Static constant WIDGET_NAME is required.");
        }
        
        parent::__construct(get_class(), self::WIDGET_NAME, $widget_options);
    }
    
    public function widget($args, $widget_data)
    {
        echo $args['before_widget'];
        echo $this->render(self::TEMPLATE_NAME, $widget_data);
        echo $args['after_widget'];
    }
    
    public function form($widget_data)
    {
        echo $this->render(self::OPTIONS_TEMPLATE_NAME, $widget_data);
    }
    
    public function update($new_data, $old_data)
    {
        WidgetsController::update($new_data, $old_data);
    }
}