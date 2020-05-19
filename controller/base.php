<?php
class BaseController
{
    protected $file;

    function render($data = array())
    {
        if (!empty($data["error"]) && strlen($data["error"]) > 0) {
            header('Content-type: application/json');
            echo json_encode($data);
            http_response_code(500);
        } else {
            $view_file = 'view/' .  $this->file . '.php';
            extract($data);
            ob_start();
            require_once($view_file);
            $content = ob_get_clean();
            require_once('view/layout/application.php');
        }
    }
}
