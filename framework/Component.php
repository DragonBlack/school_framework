<?php

namespace framework;


abstract class Component {
    public function init($params = []){
        foreach($params as $prop=>$val){
            $this->$prop = $val;
        }
    }

    public function __get($name) {
        $getter = 'get'.ucfirst($name);
        if(method_exists($this, $getter)){
            return $this->$getter();
        }

        throw new AppException('Property "'.$name.'" not found');
    }
}