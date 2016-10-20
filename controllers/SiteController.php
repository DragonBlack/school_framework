<?php
namespace controllers;

use framework\App;
use framework\BaseController;
use framework\School;
use models\LoginForm;
use models\User;

class SiteController extends BaseController {
    public function actionIndex(){
        $res = User::find()
            ->one();

        $this->render('index', ['user'=>$res]);
    }

    public function actionLogin(){
        $model = new LoginForm();

        if($model->load(School::$app->request->post()) !== []){

        }

        $this->render('login', [
            'form' => $model
        ]);
    }
}