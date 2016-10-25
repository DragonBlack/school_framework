<?php
/**
 * Class App
 * @package framework
 */

namespace framework;

/**
 * Base class of web application
 *
 * @property    View            $view           View instance
 * @property    UrlManager      $urlManager     URL manager instance
 * @property    array           $allowLanguages
 * @property    string          $defaultLang
 * @property    AuthManager     $authManager    Auth manager instance
 * @property    User            $user           User component
 * @property    Session         $session        Session component
 *
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
        $this->_components['request'] = new Request();
    }
    private function __sleep(){}
    private function __wakeup(){}
    private function __clone(){}

    private function _init(){
        $config = new Config();
        foreach($config->components as $name=>$conf){
            if(!isset($conf['class'])){
                $className = 'framework\\'.ucfirst($name);
            }
            else{
                $className = $conf['class'];
            }
            $this->_components[$name] = new $className();
            $this->_components[$name]->init($conf);
        }

        if(!isset($this->_components['view'])){
            $this->_components['view'] = new View();
        }

        if(!isset($this->_components['urlManager'])){
            $this->_components['urlManager'] = new UrlManager();
            $this->_components['urlManager']->init([
                'controller' => 'site',
                'action' => 'index',
            ]);
        }
        $this->_parameters['allowLanguages'] = $config->allowLanguages ? : [];
        $this->_parameters['defaultLang'] = $config->defaultLang ? : 'ru';

        if(!isset($this->_components['user'])){
            $this->_components['user'] = new User();
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

        $this->authManager->autologin();

        if(method_exists($controller, $action)){
            $controller->$action();
        }
        else{
            throw new AppException('Action "'.$action.'" not found in class '.$controllerClass);
        }
    }

    public static function t($langKey){
        $lang = School::$app->urlManager->langId();
        $fileName = dirname(FRAMEWORK).DS.'messages'.DS.$lang.DS.'app.php';
        if(is_file($fileName)){
            $data = require $fileName;
            return isset($data[$langKey]) ? $data[$langKey] : $langKey;
        }

        return $langKey;
    }
}