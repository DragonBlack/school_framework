<?php
namespace models;


use framework\Model;
use framework\School;

class LoginForm extends Model {
    public $login;
    public $password;

    public function validate(){
        return true;
    }

    public function auth(){
        if(School::$app->authManager->authenticate($this->login, $this->password)){
            return true;
        }

        $this->addError('login', 'Incorrect login and/or password');
        return false;
    }
}