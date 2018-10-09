<?php

namespace App;

use Fizzmod\DB\Model;

class Product extends Model {

    protected $table = 'products';
    
    protected $columns = [
        'id' => 'i', 
        'name' => 's', 
        'price' => 'd'
    ];

}

?>