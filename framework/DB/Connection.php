<?php

namespace Fizzmod\DB;

class Connection extends \mysqli {

    function __construct($dbconfig) {
        parent::__construct(
            $dbconfig['host'], 
            $dbconfig['username'], 
            $dbconfig['password'], 
            $dbconfig['database']
        );
    }

}

?>