<?php
/**
 * Created by PhpStorm.
 * User: Serg
 * Date: 24.10.2016
 * Time: 20:27
 */

namespace framework;


class Session extends Component {
    public function __construct() {
        session_start();
    }

    public function get($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function set($key, $val){
        $_SESSION[$key] = $val;
    }

    public function delete($key){
        unset($_SESSION[$key]);
    }

    public function setCookie($name, $value, $duration=0){
        $exp = null;
        if($duration){
            $exp = time()+(int)$duration;
        }
        setcookie($name, $value, $exp, '/');
    }

    public function getCookie($name){
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    public function deleteCookie($name){
        setcookie($name);
    }
}