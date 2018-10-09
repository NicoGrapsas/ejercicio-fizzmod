<?php

namespace Fizzmod\DB;

class DBConnection {

    private $conn;

    function __construct($dbconfig) {
        $this->conn = new \mysqli(
            $dbconfig['host'], 
            $dbconfig['username'], 
            $dbconfig['password'], 
            $dbconfig['database']
        );
    }



}

?>