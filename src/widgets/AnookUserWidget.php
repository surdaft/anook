<?php namespace surdaft\anook\widgets;

use surdaft\anook\traits\Widget;
use surdaft\anook\traits\Templates;
use surdaft\anook\exceptions\WidgetException;
use sardaft\anook\controllers\WidgetsController;

/**
 * Anook User Widget
 * This widget shows an anook users profile in the sidebar.
 */
class AnookUserWidget extends BaseWidget
{
    // use the traits of a widget
    use Widget;
    // allow us to render template files
    use Templates;
    
    public $widget_name = "Anook User Widget";
    public $template_name = "widgets.user";
    public $options_template_name = "widget_options.user";
    
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
        
        parent::__construct(get_class(), $this->widget_name, $widget_options);
    }
    
    public function getData(array $widget_data)
    {
        if (empty($widget_data['username'])) {
            throw new WidgetException("Username required for Anook user widget.");
        }
        
        $anook_user = Api::getUser($widget_data['username']);
        
        return compact('anook_user');
    }
}