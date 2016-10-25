<?php
/**
 * Created by PhpStorm.
 * User: Serg
 * Date: 24.10.2016
 * Time: 20:04
 */

namespace framework;


use models\User;

class AuthManager extends Component {
    /** @var  Model */
    protected $model;

    public function init($params = []) {
        if(!isset($params['model'])){
            throw new AppException('User model must be defined');
        }

        $this->model = new $params['model'];
    }

    public function authenticate($login, $passw){
        $user = User::find()
            ->where('login=:l AND password=:p', [':l'=>$login, ':p'=>$passw])
            ->one();

        if($user){
            School::$app->user->initialize($user);
            $cfs = $this->_generateToken();
            School::$app->session->set('user'.$user->id, $cfs);
            School::$app->session->setCookie('cfs', $cfs);
            School::$app->session->setCookie('uid', $user->id);
            return true;
        }

        return false;
    }

    public function autologin(){
        $uid = School::$app->session->getCookie('uid');
        if(!$uid){
            return;
        }

        $cfs = School::$app->session->getCookie('cfs');
        $cfsS = School::$app->session->get('user'.$uid);

        if($cfs != $cfsS){
            return;
        }

        $user = User::find()
            ->where('id=:id', [':id'=>$uid])
            ->one();

        if($user){
            School::$app->user->initialize($user);
        }
    }

    public function logout(){
        $user = School::$app->user;
        School::$app->session->delete('user'.$user->id);
        School::$app->session->deleteCookie('uid');
        School::$app->session->deleteCookie('cfs');
        $user->logout();
    }

    private function _generateToken(){
        $b = openssl_random_pseudo_bytes(30);
        return bin2hex($b);
    }
}