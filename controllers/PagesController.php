<?php
/**
 * Created by PhpStorm.
 * User: PHPAcademy
 * Date: 27.10.2016
 * Time: 19:30
 */

namespace controllers;


use framework\BaseController;
use framework\School;

class PagesController extends BaseController {

    public function actionAbout(){
        $this->render('about');
    }

    public function actionContacts(){
        if(School::$app->user->isGuest){
            $this->redirect(['site/login']);
        }

        $this->render('contacts');
    }
}