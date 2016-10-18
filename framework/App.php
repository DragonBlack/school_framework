<?php
/**
 * Created by PhpStorm.
 * User: Serg
 * Date: 17.10.2016
 * Time: 19:55
 */

namespace framework;

/**
 * Class App
 * @package framework
 *
 * @property array allowLanguages;
 */
class App {
    private static $_instance;

    private $_components = [];
    private $_parameters = [];

    public static function instance(){
        if(self::$_instance === null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct(){
        $this->_init();
    }
    private function __sleep(){}
    private function __wakeup(){}
    private function __clone(){}

    private function _init(){
        $config = new Config();
        foreach($config->components as $name=>$conf){
            if(!isset($conf['class'])){
                $className = 'framework\\'.ucfirst($name);
                $this->_components[$name] = new $className();
                $this->_components[$name]->init($conf);
            }
        }
        $this->_parameters['allowLanguages'] = $config->allowLanguages;
        $this->_parameters['defaultLang'] = $config->defaultLang;
        if(!isset($this->_components['view'])){
            $this->_components['view'] = new View();
        }
    }

    public function __get($name){
        if(isset($this->_components[$name])){
            return $this->_components[$name];
        }

        if(isset($this->_parameters[$name])){
            return $this->_parameters[$name];
        }

        throw new AppException("Property \"$name\" not found");
    }

    public function run(){
        $urlManager = $this->_components['urlManager'];
        $urlManager->parse();
        $controllerClass = 'controllers\\'.$urlManager->controllerId();
        $controller = new $controllerClass;
        $action = $urlManager->actionId();
        if(method_exists($controller, $action)){
            $controller->$action();
        }
        else{
            throw new AppException('Action "'.$action.'" not found in class '.$controllerClass);
        }
    }
}