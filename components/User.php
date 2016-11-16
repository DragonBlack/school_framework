<?php
/**
 * Created by PhpStorm.
 * User: PHPAcademy
 * Date: 16.11.2016
 * Time: 20:53
 */

namespace components;


class User extends \framework\User
{
    public function getCssSettings(){
        $css = '';
        if(!empty($this->_identity->text_color)){
            $css .= 'color: '.$this->_identity->text_color.";\r\n";
        }

        if(!empty($this->_identity->bgd_color)){
            $css .= 'background-color: '.$this->_identity->bgd_color.";\r\n";
        }
        return $css;
    }
}