<?php

namespace app\controllers;
//class CheckSKUController extends Controller
//{
//    public function action()
//    {
//       if ($this->getProductsModel()->isProductExists($_POST['sku']))
//       {
//           echo 'false';
//       }else{
//           echo 'true';
//       }
//    }
//}
class CheckSKUController extends \app\Controller
{
    public function action()
    {
        require_once __DIR__ . '/db.php';

    }


}



