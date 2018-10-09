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

    function setStatus($id, $status) {
        $query = $this->conn->prepare("UPDATE $this->table SET status=$status where id=?");
        $query->bind_param('i', $id);
        $query->execute();
    }
    function enable($id) { $this->setStatus($id, 1); }
    function disable($id) { $this->setStatus($id, -1); }
}

?>