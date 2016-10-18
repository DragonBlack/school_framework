<?php
namespace controllers;

use framework\BaseController;

class SiteController extends BaseController {
    public function actionIndex(){
        $this->render('index');
    }
}