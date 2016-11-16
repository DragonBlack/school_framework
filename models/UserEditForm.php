<?php
/**
 * Created by PhpStorm.
 * User: PHPAcademy
 * Date: 27.10.2016
 * Time: 20:40
 */

namespace models;


use framework\Model;

class UserEditForm extends Model {
    public $id;
    public $email;
    public $login;
    public $password;
    public $confirm;
    protected $userModel;
    public $text_color;
    public $bgd_color;

    public function init($userId){
        $this->userModel = User::find()
            ->where('id=:id', [':id'=>$userId])
            ->one();

        if($this->userModel){
            $this->id = $this->userModel->id;
            $this->email = $this->userModel->email;
            $this->login = $this->userModel->login;
            $this->text_color = $this->userModel->text_color;
            $this->bgd_color = $this->userModel->bgd_color;
        }
    }

    public function save(){
        if((!empty($this->password) || !empty($this->confirm)) && $this->password != $this->confirm){
            $this->addError('password', 'The password and confirm password must match');
        }

        if(empty($this->login)){
            $this->addError('login', 'Login can\'t be empty');
        }

        if(!$this->hasError()){
            $this->userModel->login = $this->login;
            $this->userModel->email = $this->email;
            if(!empty($this->password)) {
                $this->userModel->password = $this->password;
            }
            $this->userModel->text_color = $this->text_color;
            $this->userModel->bgd_color = $this->bgd_color;
            return $this->userModel->save();
        }
        return false;
    }
}