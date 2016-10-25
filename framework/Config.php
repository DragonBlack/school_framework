<?php
/**
 * Created by PhpStorm.
 * User: Serg
 * Date: 17.10.2016
 * Time: 19:56
 */

namespace framework;


final class Config {
    private $_config;

    public function __construct(){
        $this->_config = require_once CONFIG;
    }

    public function __get($name){
        $method = 'get'.ucfirst($name);
        if(method_exists($this, $method)){
            return $this->$method();
        }

        if(isset($this->_config[$name])){
            return $this->_config[$name];
        }
        throw new ConfigExeption("Section '$name' not found");
    }

    private function getAllowLanguages(){
        return isset($this->_config['allowLanguages']) ? $this->_config['allowLanguages'] : [];
    }

    private function getDefaultLang(){
        return isset($this->_config['defaultLang']) ? $this->_config['defaultLang'] : 'ru';
    }
}