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

    
    /**
     * Returns all rows from table.
     * 
     * @return array
     */
    function all() {
        $result = $this->conn->query("SELECT * FROM $this->table");
        return $result->fetch_assoc();
    }

    /**
     * Return row matching id.
     * 
     * @param int
     * @return array
     */
    function findById(int $id) {
        $result = $this->conn->query("SELECT * FROM $this->table WHERE id=$id");
        return $result->fetch_assoc();
    }

    function fromJson($data) {
        $this->json = json_decode($data);
        foreach ($this->json as $row) {
            var_dump($row);
        }
        return $this;
    }

    /**
     * Return columns string. Example: '(col1, col2, col3)'.
     * 
     * @return string
     */
    function buildColumns(): string {
        $columns = array_keys($this->columns);
        return '(' . implode(', ', $columns) . ')'; 
    }

    /**
     * Return replaces string. Example: '(?, ?, ?)'.
     * 
     * @return string
     */
    function buildReplaces(): string {
        $replaces = array_fill(0, count($this->columns), '?');
        return '(' . implode(', ', $replaces) . ')';
    }

    /**
     * Return types string for binding param. Example: 'sss'.
     * 
     * @return string
     */
    function buildTypes(): string {
        $types = array_values($this->columns);
        return implode('', $types);
    }

    /**
     * Return values for binding param. Example: [value1, value2, value3]
     * 
     * @return array
     */
    function buildValues() {
        $values = array_map(function($var) {
            if (isset($this->$var)) { return $this->$var; }
        }, array_keys($this->columns));
        return $values;
    }
    
    /**
     * Saves current model data to database.
     * 
     */
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