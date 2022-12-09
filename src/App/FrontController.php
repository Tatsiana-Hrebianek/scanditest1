<?php

namespace App;

use App\Controllers\DeleteProductsController;
use App\Controllers\ShowErrorPageController;
use App\Controllers\ShowProductsController;
use App\Controllers\ShowProductFormController;
use App\Controllers\CheckSKUController;
use App\Controllers\AddProductsController;
use Exception;

/**
 *
 */
class FrontController extends Controller
{
    /**
     * @var string
     */
    private string $url;
    /**
     * @var string
     */
    private string $httpRequestMethod;

    public function __construct()
    {
        $this->urlInit();
        $this->requestMethodInit();
    }

    /**
     * @return void
     */
    protected function urlInit()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $this->url = $_SERVER['REQUEST_URI'];
        } else {
            $this->url = '/';
        }
    }

    /**
     * @return void
     */
    public function requestMethodInit()
    {
        if (!empty($_SERVER['REQUEST_METHOD'])) {
            $this->httpRequestMethod = $_SERVER['REQUEST_METHOD'];
        } else {
            $this->httpRequestMethod = 'GET';
        }
    }

    /**
     * @return string
     */
    public function getURL(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getHTTPRequestMethod(): string
    {
        return $this->httpRequestMethod;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function route($ProductsModelInstance)
    {

        if (($this->getURL() === '/') && ($this->getHTTPRequestMethod() === 'GET')) {
            $showproducts = new ShowProductsController();
            $showproducts->action($ProductsModelInstance);
        } elseif ($this->getURL() === '/' && $this->getHTTPRequestMethod() === 'POST' && !count($_POST)) {
            $showproducts = new ShowProductsController();
            $showproducts->action($ProductsModelInstance);
        } elseif (($this->getURL() === '/addProduct') && ($this->getHTTPRequestMethod() === 'GET')) {
            $showproductform = new ShowProductFormController();
            $showproductform->action();
        } elseif (($this->getURL() === '/') && (isset($_POST['sku'], $_POST['name'], $_POST['price']))) {
            $addproduct = new AddProductsController();
            $addproduct->action($ProductsModelInstance);
        } elseif (($this->getURL() === '/db') && (isset ($_POST['sku']))) {
            $checkSKU = new CheckSKUController();
            $checkSKU->action($ProductsModelInstance);
        } elseif (($this->getURL() === '/') && (isset($_POST['sku']))) {
            $deleteproduct = new DeleteProductsController();
            $deleteproduct->action($ProductsModelInstance);

        } else {
            $errorpage = new ShowErrorPageController();
            $errorpage->action();
            throw new Exception("This address doesn't exists!    " . date('Y-m-d H:i:s'));
        }
    }
}

