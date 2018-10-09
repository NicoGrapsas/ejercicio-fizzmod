<?php

require('../vendor/autoload.php');

use flight\Engine;

class App extends Engine {
    
    public static function loadConfig($file) {
        return include("../config/$file.php");
    }

}

$dbconfig = App::loadConfig('database');

$app = new App();

$app->register('DB', 'Fizzmod\DB\DBConnection', array($dbconfig));


?>