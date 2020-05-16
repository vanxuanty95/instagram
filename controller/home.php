<?php
require_once('controller/base.php');

class HomeController extends BaseController
{
    function __construct()
    {
        $this->file = 'home';
    }

    public function home()
    {
        $this->render();
    }
}
