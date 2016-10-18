<?php

namespace framework;


abstract class Component {
    public function init($params = []){
        foreach($params as $prop=>$val){
            $this->$prop = $val;
        }
    }
}