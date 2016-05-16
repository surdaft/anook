<?php namespace surdaft\anook\widgets;

use surdaft\anook\traits\Widget;
use surdaft\anook\traits\Templates;
use surdaft\anook\exceptions\WidgetException;
use surdaft\anook\controllers\WidgetsController;

use surdaft\anook\libs\api\Api;

/**
 * Anook User Widget
 * This widget shows an anook users profile in the sidebar.
 */
class AnookUserWidget extends BaseWidget
{
    // allow us to render template files
    use Templates;
    
    // the name of the widget
    public $widget_name = "Anook User Widget";
    public $template_name = "widgets.user";
    public $options_template_name = "widget_options.user";
    
    /**
     * Defines the info to pass to wordpress about the widgets name
     * location and description.
     */
    public function __construct()
    {
        parent::__construct('AnookUserWidget', $this->widget_name, [
            'description' => "Show your anook profile in the sidebar."
        ]);
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