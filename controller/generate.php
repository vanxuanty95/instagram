<?php
require_once('model/profile.php');

class GenerateController
{
    protected $generationApi = "http://instagram.nakamadressup.com/index.php?controller=profile&action=profile&username=__username&description=__description";

    function __construct()
    {
        $this->file = 'profile';
    }

    public function generate()
    {
        $profile = ProfileModel::set($_GET['username'], $_GET['description']);
        return $this->getImageFromGoogleApi($profile->username, $profile->description);
    }

    function getImageFromGoogleApi($username, $description)
    {

        $googlePagespeedData = file_get_contents("https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=" . $this->createTargetURL($username, $description) . "&screenshot=true");

        //decode json data
        $googlePagespeedData = json_decode($googlePagespeedData, true);

        //screenshot data
        $screenshot = $googlePagespeedData['screenshot']['data'];
        $screenshot = str_replace(array('_', '-'), array('/', '+'), $screenshot);

        //display screenshot image
        return "<img src=\"data:image/jpeg;base64," . $screenshot . "\" />";
    }

    function createTargetURL($username, $description)
    {
        $target = str_replace(["__username", "__description"], [$username, $description], $this->generationApi);
        return $target;
    }
}
