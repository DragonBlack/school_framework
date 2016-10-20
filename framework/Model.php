<?php
namespace framework;


use framework\db\Query;

class Model {
    protected $tableName;
    public $id;
    protected static $query;

    public function __get($name){
        $fname = 'get'.ucfirst($name);
        if(method_exists($this, $fname)){
            return $this->$fname();
        }

        throw new AppException('Property "'.$name. '" not found');
    }

    public function getTableName(){
        return $this->tableName;
    }

    public function getId(){
        return $this->id;
    }

    public static function find(){
        return new Query(get_called_class());
    }

    public static function className(){
        return get_called_class();
    }
}