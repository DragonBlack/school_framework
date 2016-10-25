<?php
namespace framework;


use framework\db\Query;

class Model {
    protected $tableName;
    public $id;
    protected static $query;
    private $_errors=[];

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

    public function load(array $data, $formName=null){
        if($formName === null){
            $formName = $this->getFormName();
        }

        if(!empty($formName)){
            $data = isset($data[$formName]) ? $data[$formName] : [];
        }

        if(empty($data)){
            return false;
        }

        foreach($data as $prop=>$val){
            $this->$prop = $val;
        }

        return true;
    }

    public function getFormName(){
        $reflector = new \ReflectionClass($this);
        return $reflector->getShortName();
    }

    public function getAllErrors(){
        return $this->_errors;
    }

    public function getError($attribute){
        return isset($this->_errors[$attribute]) ? $this->_errors[$attribute] : false;
    }

    public function hasError(){
        return !empty($this->_errors);
    }

    public function addError($attribute, $message){
        $this->_errors[$attribute] = $message;
    }
}