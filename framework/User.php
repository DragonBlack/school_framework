<?php
/**
 * Created by PhpStorm.
 * User: Serg
 * Date: 24.10.2016
 * Time: 20:30
 */

namespace framework;


class User extends Component {
    protected $_id;
    protected $_identity;

    public function getIsGuest(){
        return empty($this->_id);
    }

    public function initialize(Model $model){
        $this->_identity = $model;
        $this->_id = $model->id;
    }

    public function logout(){
        unset($this->_id, $this->_identity);
    }

    public function getId(){
        return $this->_id;
    }
}