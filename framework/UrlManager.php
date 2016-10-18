<?php
namespace framework;


class UrlManager extends Component {
    protected $controller;
    protected $action;
    protected $_lang;
    protected $_params = [];

    public function init($params = []){
        parent::init($params);
        $this->controller = ucfirst($this->controller).'Controller';
        $this->action = 'action'.ucfirst($this->action);
    }

    public function parse(){
        $this->_lang = School::$app->defaultLang;
        $request = $_SERVER['REQUEST_URI'];
        list($request) = explode('?', $request);
        $request = trim($request, '/');
        $parts = explode('/', $request);

        $elem = array_shift($parts);
        if(in_array($elem, School::$app->allowLanguages)){
            $this->_lang = $elem;
            $elem = array_shift($parts);
        }
        if($elem){
            $this->controller = ucfirst($elem).'Controller';
            $elem = array_shift($parts);
        }
        if($elem){
            $this->action = 'action'.ucfirst($elem);
        }

        if($parts){
            $key = null;
            foreach($parts as $k=>$v){
                if($k % 2 == 0){
                    $key = $v;
                    $this->_params[$key] = null;
                    continue;
                }
                $this->_params[$key] = $v;
            }
        }
    }

    public function controllerId(){
        return $this->controller;
    }

    public function actionId(){
        return $this->action;
    }
}