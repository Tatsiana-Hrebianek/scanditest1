<?php
    namespace app\controllers;
    class ShowErrorPageController {
        public function action()
        {
            $template = new TemplateController();
            echo $template->render('app/templates/404.php', ['title'=>'404 page']);
                        
        }    
    }
