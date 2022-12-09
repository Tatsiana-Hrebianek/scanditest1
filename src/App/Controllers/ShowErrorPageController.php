<?php

namespace App\Controllers;

use App\Component\TemplateComponent;


/**
 *
 */
class ShowErrorPageController
{
    /**
     * @return void
     */
    public function action()
    {
        $template = new TemplateComponent();
        echo $template->render($_SERVER['DOCUMENT_ROOT'] . '/../App/templates/404.php', ['title' => '404 page']);

    }
}
