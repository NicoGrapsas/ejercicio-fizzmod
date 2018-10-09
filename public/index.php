<?php

require('../bootstrap/app.php');

use App\Product;

$app->route('GET /products/seed', 'ProductController@seed');
$app->route('GET /products/truncate', 'ProductController@truncate');
$app->route('GET /products/@id:[0-9]+', 'ProductController@find');
$app->route('GET /products/@id:[0-9]+/enable', 'ProductController@enable');
$app->route('GET /products/@id:[0-9]+/disable', 'ProductController@disable');

$app->start();





?>