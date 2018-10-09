<?php

namespace Fizzmod\DB;

abstract class Model {

    protected $row;

    /**
     * JSON representation of the model.
     * 
     * @var object
     */
    protected $json;

    /**
     * Table name.
     * 
     * @var string
     */
    protected $table;

    /**
     * Table columns.
     * Associative array [col_name] => [bind_param_type]
     * 
     * @var array
     */
    protected $columns = [];

    function __construct($conn) {
        $this->conn = $conn;
    }

    // function __get() {}

    // function __set() {}

    function all() {
        $result = $this->conn->query("SELECT * FROM $this->table");
        return $result->fetch_assoc();
    }

    function findById($id) {
        $result = $this->conn->query("SELECT * FROM $this->table WHERE id=$id");
        return $result->fetch_assoc();
    }

    function fromJson($data) {
        $this->json = json_decode($data);
        return $this;
    }

    function buildColumns() {
        $columns = array_keys($this->columns);
        return '(' . implode(', ', $columns) . ')'; 
    }

    function buildReplaces() {
        $replaces = array_fill(0, count($this->columns), '?');
        return '(' . implode(', ', $replaces) . ')';
    }

    function buildTypes() {
        $types = array_values($this->columns);
        return implode('', $types);
    }

    function buildValues() {
        $values = array_map(function($var) {
            if (isset($this->$var)) { return $this->$var; }
        }, array_keys($this->columns));
        return $values;
    }
    
    final function save() {
        $columns = $this->buildColumns();
        $replaces = $this->buildReplaces();
        $query = $this->conn->prepare("INSERT INTO $this->table $columns VALUES $replaces");
        
        $types = $this->buildTypes();
        $values = $this->buildValues();
        $query->bind_param($types, ...$values);

        $query->execute();
    }

}


?>