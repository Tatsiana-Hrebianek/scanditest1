<?php

namespace App\Component;

/**
 *
 */
class TemplateComponent
{
    /**
     * @var string
     */
    public string $template;

    /**
     * @param $template
     * @param $data
     * @return false|string
     */
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
