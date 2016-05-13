<?php namespace surdaft\anook\traits;

use surdaft\anook\exceptions\TemplateException;

/**
 * Templates gives us the ability to render templates
 * This is used inside widgets to render the widgets template, for example.
 */
trait Templates
{
    // The path of the template
    public $templates_path;
    // The initial name we were given
    public $template_name;
    // The extension if we were to ever change it or use a custom template
    public $template_extension;

    /**
     * Renders the HTML to return back and display on the page.
     *
     * @param $template_name    string  The name of the template using . for directory seperators
     * @param $variables        array   An array of all the variables to insert in the template.
     * @param $options          array   An array of extra options to be passed in externally.
     */
    public function render($template_name, array $variables = [], array $options = [])
    {
        $this->template_name = $template_name;
        // Generate the path of the template
        $this->template_path = SURDAFT_ANOOK_DIRECTORY_PATH . "/views/" . str_replace(".", "/", $this->template_name);

        // incase our template is of a different type
        if (!empty($options['extension'])) {
            $this->template_extension = $options['extension'];
        } else {
            $this->template_extension = ".html.php";
        }

        // check the file exists
        if (!file_exists($this->template_path . $this->template_extension)) {
            throw new TemplateException("Template file not found. {$this->templates_path}.{$this->template_extension}");
        }

        // open a new buffer to allow us to store the data in a variable
        ob_start();
        
        // extract the variables so they are available in the template
        extract($variables);

        // include the template file
        include($this->template_path . $this->template_extension);
        
        // put the contents of the file into a variable
        $template_html = ob_get_contents();
        
        // clear the output buffer without any output
        ob_end_clean();

        // return the html
        return $template_html;
    }
}