<?php namespace surdaft\anook\traits;

use surdaft\anook\exceptions\TemplateException;

trait Templates
{
    public $templates_path;
    public $template_name;
    public $template_extension;
    
    public function render($template_name, array $variables = [], array $options = [])
    {
        $this->template_name = $template_name;
        $this->template_path = SURDAFT_ANOOK_DIRECTORY_PATH . "/views/" . str_replace(".", "/");
        
        if (!empty($options['extension'])) {
            $this->template_extension = $options['extension'];
        } else {
            $this->template_extension = ".html.php";
        }
        
        if (!file_exists($this->templates_path . $this->template_extension)) {
            throw new TemplatesException("Template file not found. {$this->templates_path}.{$this->template_extension}");
        }
        
        ob_start();
        
        extract($variables);
        include($this->templates_path . $this->template_extension);
        
        $template_html = ob_get_contents();
        ob_clean_flush();
        
        return $template_html;
    }
}