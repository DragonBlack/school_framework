<?php
namespace models;


class LoginForm {
    public $login;
    public $password;

    public function validate(){
        return true;
    }
}