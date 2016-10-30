<?php
namespace framework\db;

use framework\Model;
use framework\School;

class Query {
    protected $_select = [];
    protected $_from;
    protected $_where;
    protected $_params = [];
    protected $_sql;

    /** @var  PDO */
    private $_conn;

    /** @var  Model */
    private $calledClass;

    public function __construct($class=null){
        if($class){
            $this->calledClass = new $class;
        }
        $this->_select = $this->_params = [];
        $this->_from = $this->_where = $this->_sql = null;
        $this->_conn = School::$app->db->getConnection();
    }

    public function select($fields){
        if(is_string($fields)){
            $fields = explode(',', $fields);
            $fields = array_filter($fields);
        }
        $this->_select = $fields;
        return $this;
    }

    public function from($tableName){
        $this->_from = (string)$tableName;
        return $this;
    }

    public function where($condition, $params=[]){
        $this->_where = (string)$condition;
        $this->_params = $params;
        return $this;
    }

    public function one(){
        if($this->calledClass instanceof Model){
            $class = $this->calledClass;
            return $this->_execute()->fetchObject($class::className());
        }
        return $this->_execute()->fetch(\PDO::FETCH_ASSOC);
    }

    public function all(){
        if($this->calledClass instanceof Model){
            $class = $this->calledClass;
            return $this->_execute()->fetchAll(\PDO::FETCH_CLASS, $class::className());
        }
        return $this->_execute()->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($table, $data, $where=[]){
        $this->_sql = 'UPDATE `'.$table.'` SET ';
        foreach($data as $field=>$val){
            $this->_sql .= $field.' = :'.$field.', ';
            $this->_params[':'.$field] = $val;
        }

        $this->_sql = substr($this->_sql, 0, -2);

        if($where !== []){
            $this->_sql .= ' WHERE '.$where[0];
            unset($where[0]);
            $this->_params = array_merge($this->_params, reset($where));
        }

        $stmt = $this->_conn->prepare($this->_sql);
        $this->_buildValues($stmt);
        return $stmt->execute();
    }

    protected function _execute(){
        $this->_build();
        $stmt = $this->_conn->prepare($this->_sql);
        $this->_buildValues($stmt);
        $stmt->execute();

        return $stmt;
    }

    protected function _build(){
        if(empty($this->_select) && $this->calledClass instanceof Model){
            $this->_select = $this->calledClass->attributes();
        }

        $this->_sql = 'SELECT '.implode(', ', $this->_select).' ';
        if(empty($this->_from) && $this->calledClass instanceof Model){
            $this->_from = $this->calledClass->tableName;
        }
        $this->_sql .= 'FROM '.$this->_from.' ';
        if(!empty($this->_where)){
            $this->_sql .= ' WHERE '.$this->_where.' ';
        }
    }

    protected  function _buildValues(\PDOStatement &$stmt){
        foreach ($this->_params as $key=>$val){
            $stmt->bindValue($key, $val);
        }
    }
}