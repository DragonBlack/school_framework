<?php
/**
 * Created by PhpStorm.
 * User: PHPAcademy
 * Date: 18.10.2016
 * Time: 20:39
 */

namespace framework;


class View extends Component {
    public $viewPath = 'views';
    public $layout = 'layouts/main';

    public function render($view, $params=[]){
        ob_start();
        $fileName = ROOT.DIRECTORY_SEPARATOR.$this->viewPath.DIRECTORY_SEPARATOR.$view.'.php';
        extract($params);
        require $fileName;
        $content = ob_get_clean();
        $this->renderLayout($content);
    }

    protected function renderLayout($content){
        ob_start();
        $fileName = ROOT.DIRECTORY_SEPARATOR.$this->viewPath
            .DIRECTORY_SEPARATOR.$this->layout.'.php';
        require $fileName;
        ob_end_flush();
    }
}