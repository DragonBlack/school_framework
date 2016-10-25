<?php
namespace framework;

class School {
    /** @var  App   Application instance */
    public static $app;
    private static $_instance;

    public static function getInstance(){
        if(self::$_instance === null){
            self::$_instance = new self;
            self::$app = App::instance();
        }
        return self::$_instance;
    }

    private function __construct(){}
    private function __sleep(){}
    private function __wakeup(){}
    private function __clone(){}
}