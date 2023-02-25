<?php

declare(strict_types=1);

namespace App;

use App\Controllers\DeleteProductsController;
use App\Controllers\ShowErrorPageController;
use App\Controllers\ShowProductsController;
use App\Controllers\ShowProductFormController;
use App\Controllers\CheckSKUController;
use App\Controllers\AddProductsController;
use PDO;
use Exception;

/**
 *
 */
class FrontController
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
    public function route($container)
    {

        if (($this->getURL() === '/') && ($this->getHTTPRequestMethod() === 'GET')) {
            $showproducts = $container->get('ShowProductsController');
            $showproducts->action();
        } elseif ($this->getURL() === '/' && $this->getHTTPRequestMethod() === 'POST' && !count($_POST)) {
            $showproducts = $container->get('ShowProductsController');
            $showproducts->action();
        } elseif (($this->getURL() === '/addProduct') && ($this->getHTTPRequestMethod() === 'GET')) {
            $showproductform = $container->get('ShowProductFormController');
            $showproductform->action();
        } elseif (($this->getURL() === '/') && (isset($_POST['sku'], $_POST['name'], $_POST['price']))) {
            $addproduct = $container->get('AddProductsController');
            $addproduct->action();
        } elseif (($this->getURL() === '/checkSKU') && (isset ($_POST['sku']))) {
            $checkSKU = $container->get('CheckSKUController');
            $checkSKU->action();
        } elseif (($this->getURL() === '/deleteProducts') && (isset($_POST['sku']))) {
            $deleteproduct = $container->get('DeleteProductsController');
            $deleteproduct->action();

        } else {
            $errorpage = $container->get('ShowErrorPageController');
            $errorpage->action();
            throw new Exception("This address doesn't exists!    " . date('Y-m-d H:i:s'));
        }
    }

    //receiving data
    public function get(string $path, $class)
    {

    }

    //posting data
    public function post(string $path, $class)
    {

    }


}

