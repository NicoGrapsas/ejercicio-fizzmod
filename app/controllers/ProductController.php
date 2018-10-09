<?php 

namespace App\Controllers;

use App\Product;

class ProductController {

    function __construct($app) {
        $this->app = $app;
    }

    function find(int $id) {
        $product = new Product($this->app->DB());
        $this->app->json($product->findById($id));
    }

    function enable(int $id) {
        $product = new Product($this->app->DB());
        return $product->enable($id);
    }

    function disable(int $id) {
        $product = new Product($this->app->DB());
        return $product->disable($id);
    }

    function seed() {
        $products = json_decode(file_get_contents('./products.json'), true);
        foreach ($products as $_product) {
            $product = new Product($this->app->DB());
            array_map(function($prop) use ($product, $_product) {
                $product->$prop = $_product[$prop];
            }, array_keys($_product));
            $product->save();
        }
    }

    function truncate() {
        $product = new Product($this->app->DB());
        return $product->truncate();
    }
}



?>