<?php

namespace app;

use app\products\Product;
use app\products\Disc;
use app\products\Book;
use app\products\Furniture;
use app\controllers\DeleteProductsController;
use app\controllers\ShowErrorPageController;
use app\controllers\ShowProductsController;
use app\controllers\ShowProductFormController;
use app\controllers\CheckSKUController;
use app\controllers\AddProductsController;

class FrontController extends Controller
{
    private $url;
    private $httpRequestMethod;

    public function __construct()
    {
        $this->urlInit();
        $this->requestMethodInit();
    }

    protected function urlInit()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $this->url = $_SERVER['REQUEST_URI'];
        } else {
            $this->url = '/';
        }
    }

    public function requestMethodInit()
    {
        if (!empty($_SERVER['REQUEST_METHOD'])) {
            $this->httpRequestMethod = $_SERVER['REQUEST_METHOD'];
        } else {
            $this->httpRequestMethod = 'GET';
        }
    }

    public function getURL()
    {
        return $this->url;
    }

    public function getHTTPRequestMethod()
    {
        return $this->httpRequestMethod;
    }

    public function route()
    {
        if (($this->getURL() === '/') && ($this->getHTTPRequestMethod() === 'GET')) {
            $showproducts = new ShowProductsController();
            $showproducts->action();
        } elseif ($this->getURL() === '/' && $this->getHTTPRequestMethod() === 'POST' && !count($_POST)) {
            $showproducts = new ShowProductsController();
            $showproducts->action();
        } elseif (($this->getURL() === '/addProduct') && ($this->getHTTPRequestMethod() === 'GET')) {
            $showproductform = new ShowProductFormController();
            $showproductform->action();
        } elseif (($this->getURL() === '/') && (isset($_POST['sku'], $_POST['name'], $_POST['price']))) {
            $addproduct = new AddProductsController();
            $addproduct->action();
        } elseif (($this->getURL() === '/db') && (isset ($_POST['sku']))) {
            $checkSKU = new CheckSKUController();
            $checkSKU->action();
        } elseif (($this->getURL() === '/') && (isset($_POST['sku']))) {
            $deleteproduct = new DeleteProductsController();
            $deleteproduct->action();

        } else {
            $errorpage = new ShowErrorPageController();
            $errorpage->action();
        }
    }
}

