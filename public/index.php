<?php

require('../bootstrap/app.php');

use App\Product;

$app->route('GET /products/@id', 'ProductController@find');
$app->route('GET /products/@id/enable', 'ProductController@enable');
$app->route('GET /products/@id/disable', 'ProductController@disable');

$app->start();





?>