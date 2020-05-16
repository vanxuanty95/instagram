<?php
require_once('controller/base.php');
require_once('model/profile.php');

class ProfileController extends BaseController
{
    function __construct()
    {
        $this->file = 'profile';
    }

    public function profile()
    {
        $profile = ProfileModel::set($_GET['username'], $_GET['description']);
        $data = array('profile' => $profile);
        $this->render($data);
    }
}
