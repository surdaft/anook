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
        
        parent::__construct(get_class(), self::WIDGET_NAME, $widget_options);
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