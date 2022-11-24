<?php
namespace app\controllers;

class TemplateController
{
    public $template;

    public function render($template, $data)
    {
        extract($data);
        ob_start();
        require_once($template);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
