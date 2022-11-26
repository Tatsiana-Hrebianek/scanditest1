<?php
namespace app\controllers;
    class ShowProductFormController {
        public function action()
        {
            $template = new TemplateController(); 

            echo $template->render('../app/templates/addProductForm.php', ['title' => 'Product Add']);
        }    
    }
