<?php
namespace framework;


class BaseController extends Component {
    protected $layout;

    protected function render($view, $params=[]){
        if(!empty($this->layout)){
            School::$app->view->layout = $this->layout;
        }
        School::$app->view->render($view, $params=[]);
    }
}