<?php
/**
 * Created by PhpStorm.
 * User: Serg
 * Date: 17.10.2016
 * Time: 19:56
 */

namespace framework;


class Config {
    private $_config;

    public function __construct(){
        $this->_config = require_once CONFIG;
    }

    public function __get($name){
        if(isset($this->_config[$name])){
            return $this->_config[$name];
        }
        throw new ConfigExeption("Section '$name' not found");
    }
}