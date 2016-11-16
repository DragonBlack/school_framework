<?php
namespace models;


use framework\Model;

class User extends Model {
    protected $tableName = 'users';

    public $login;
    public $password;
    public $email;
    public $role;
    public $is_active;
    public $text_color;
    public $bgd_color;

    public function attributes(){
        return [
            'id',
            'login',
            'password',
            'email',
            'role',
            'is_active',
            'text_color',
            'bgd_color',
        ];
    }

    public function statusText(){
        return $this->is_active ? 'Active' : 'Blocked';
    }
}