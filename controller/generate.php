<?php
require_once('controller/base.php');
require_once('model/profile.php');

class GenerateController extends BaseController
{
    protected $hostApi = "http://instagram.nakamadressup.com/";
    protected $generationApi = "index.php?controller=profile&action=profile&username=__username&description=__description";

    function __construct()
    {
        $this->file = 'generate';
    }

    public function generate()
    {
        $profile = ProfileModel::set($_GET['username'], $_GET['description']);
        return $this->getImageFromGoogleApi($profile->username, $profile->description);
    }

    function getImageFromGoogleApi($username, $description)
    {

        $googlePagespeedData = file_get_contents("https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=" . $this->createTargetURL($username, $description));

        $googlePagespeedData = json_decode($googlePagespeedData, true);

        var_dump($googlePagespeedData);
        $screenshot = "test";

        $data = array('screenshot' => $screenshot);
        return  $this->render($data);
    }

    function createTargetURL($username, $description)
    {
        $target = str_replace(["__username", "__description"], [$username, $description], $this->generationApi);
        return $this->hostApi . urlencode($target);
    }
}
