<?php
namespace framework;


class BaseController extends Component {
    protected $layout;

    protected function render($view, $params=[]){
        if(!empty($this->layout)){
            School::$app->view->layout = $this->layout;
        }
        School::$app->view->render($view, $params);
    }

    /**
     * @param $url string|array
     */
    protected function redirect($url){
        if(is_array($url) && $url !== []){
            $route = $url[0];
            $params = isset($url[1]) ? $url[1] : [];
            $url = School::$app->urlManager->to($route, $params);
        }
        elseif ($url === []){
            throw new AppException('Route can\'t be empty');
        }

        header('Location: '.$url);
        exit(0);
    }
}