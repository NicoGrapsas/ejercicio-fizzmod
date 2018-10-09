<?php 

namespace App\Controllers;

use App\Product;

class ProductController {

    function __construct($app) {
        $this->app = $app;
    }

    function find($id) {
        $product = new Product($this->app->DB());
        $this->app->json($product->findById($id));
    }

    function enable($id) {
        $product = new Product($this->app->DB());
        return $product->enable($id);
    }

    function disable($id) {
        $product = new Product($this->app->DB());
        return $product->disable($id);
    }
}



?>