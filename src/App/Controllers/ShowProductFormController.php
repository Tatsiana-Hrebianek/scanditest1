<?php

namespace App\Controllers;

use App\Component\TemplateComponent;

/**
 *
 */
class ShowProductFormController
{
    /**
     * @return void
     */
    public function action()
    {
        $template = new TemplateComponent();

        echo $template->render('../App/templates/addProductForm.php', ['title' => 'IProduct Add']);
    }
}
