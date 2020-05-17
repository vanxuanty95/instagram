<?php
require_once('model/profile.php');
require_once('service/generate.php');

class GenerateController
{
    function __construct()
    {
        $this->file = 'profile';
    }

    public function generate()
    {
        $profile = ProfileModel::set($_GET['username'], $_GET['description']);
        return getImageFromGoogleApi($profile->username, $profile->description);
    }
}
