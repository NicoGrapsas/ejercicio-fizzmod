<?php

require('../vendor/autoload.php');

use flight\Engine;

class App extends Engine {

    /**
     * Return files in dir without '.' & '..'
     *
     * @param string
     * @param boolean
     */
    static function listFiles($dir, $withExtension=false): array {
        $files = array_diff(scandir($dir), array('..', '.'));
        
        if (!$withExtension) {
            $files = array_map(function($filename) {
                return pathinfo($filename, PATHINFO_FILENAME);
            }, $files);
        }
        
        return $files;
    }
    
    /**
     * Loads configuration file.
     * 
     * @param string
     */
    static function loadConfig($file) {
        return include("../config/$file.php");
    }

    /**
     * Loads and register configuration files.
     * 
     * @param string
     */
    function loadControllers($dir) {
        $controllers = App::listFiles($dir);
        foreach ($controllers as $controller) {
            $this->register($controller, "App\controllers\\$controller", array($this));
        }
    }

    /**
     * Override default route function.
     * Callback can be in the form of 'Controller@function'
     * 
     * @param string
     * @param string|array
     * 
     */
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
$app->set('flight.views.path', '../views');

?>