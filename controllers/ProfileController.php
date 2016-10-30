<?php
/**
 * Created by PhpStorm.
 * User: PHPAcademy
 * Date: 27.10.2016
 * Time: 20:06
 */

namespace controllers;


use framework\BaseController;
use framework\School;
use models\User;
use models\UserEditForm;

class ProfileController extends BaseController {
    public function beforeAction(){
        if(School::$app->user->isGuest){
            $this->redirect(['site/index']);
        }
        return true;
    }

    public function actionIndex(){
        $model = User::find()
            ->where('id=:id', [':id'=>School::$app->user->getId()])
            ->one();
        $this->render('index', ['user'=>$model]);
    }

    public function actionEdit(){
        $uid = School::$app->urlManager->parameter('id');

        $model = new UserEditForm();
        $model->init($uid);

        if($model->load(School::$app->request->post()) && $model->save()){
            $this->redirect(['profile/index']);
        }

        $this->render('edit', ['form'=>$model]);
    }
}