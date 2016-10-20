<?php
namespace framework;


class Request extends Component {
    private $_post;
    private $_get;

    public function __construct() {
        $this->_post = $_POST;
        $this->_get = $_GET;
    }

    public function post($name=null, $default=null){
        if($name===null){
            return $this->_post;
        }

        return isset($this->_post[$name]) ? $this->_post[$name] : $default;
    }

    public function get($name=null, $default=null){
        if($name===null){
            return $this->_get;
        }

        return isset($this->_get[$name]) ? $this->_get[$name] : $default;
    }
}