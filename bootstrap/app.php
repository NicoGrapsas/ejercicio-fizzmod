<?php

require('../vendor/autoload.php');

use flight\Engine;

class App extends Engine {

    static function listFiles($dir, $withExtension=false) {
        $files = array_diff(scandir($dir), array('..', '.'));
        
        if (!$withExtension) {
            $files = array_map(function($filename) {
                return pathinfo($filename, PATHINFO_FILENAME);
            }, $files);
        }
        
        return $files;
    }
    
    static function loadConfig($file) {
        return include("../config/$file.php");
    }

    function loadControllers($dir) {
        $controllers = App::listFiles($dir);
        foreach ($controllers as $controller) {
            $this->register($controller, "App\controllers\\$controller", array($this));
        }
    }

    function route($path, $callback) {
        if (gettype($callback) == 'string') {
            [$controller, $function] = explode('@', $callback);
            parent::route($path, array($this->$controller(), $function));
        } else {
            parent::route($path, $callback);
        }
    }

}

$app = new App();

$app->register('DB', 'Fizzmod\DB\Connection', array(App::loadConfig('database')));
$app->loadControllers('../app/controllers');

?>