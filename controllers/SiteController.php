<?php
namespace controllers;

use framework\App;
use framework\BaseController;
use framework\School;
use models\LoginForm;

class SiteController extends BaseController {
    public function actionIndex(){
        //var_dump(School::$app->authManager);
        $this->render('index');
    }

    public function actionLogin(){
        if(!School::$app->user->isGuest){
            $this->redirect(['site/index']);
        }
        $model = new LoginForm();

        if($model->load(School::$app->request->post()) && $model->auth()){
            $this->redirect(['site/index']);
        }

        $this->render('login', [
            'form' => $model
        ]);
    }

    public function actionLogout(){
        if(!School::$app->user->isGuest){
            School::$app->authManager->logout();
        }

        $this->redirect(['site/index']);
    }
}