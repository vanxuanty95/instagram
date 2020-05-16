<?php
class BaseController
{
    protected $file;

    function render($data = array())
    {
        $view_file = 'view/' .  $this->file . '.php';
        extract($data);
        ob_start();
        require_once($view_file);
        $content = ob_get_clean();
        require_once('view/layout/application.php');
    }
}
