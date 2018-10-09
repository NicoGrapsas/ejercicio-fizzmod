<?php

require('../bootstrap/app.php');

use App\Product;

$DB = $app->DB();

$product = new Product($DB);

$product->fromJson(file_get_contents('../public/products.json'));
$product->save();
// var_dump($product->findById(0));
// var_dump($product->all(0));






?>