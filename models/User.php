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

    public function attributes(){
        return [
            'id',
            'login',
            'password',
            'email',
            'role',
            'is_active',
        ];
    }

    public function statusText(){
        return $this->is_active ? 'Active' : 'Blocked';
    }
}