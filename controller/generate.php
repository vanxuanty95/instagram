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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_URL,"https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=" . $this->createTargetURL($username, $description));
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
        $googlePagespeedData = curl_exec($ch);
        curl_close($ch);
        $googlePagespeedData = json_decode($googlePagespeedData, true);

        var_dump($googlePagespeedData);

        $data = array('error' => true);
        if ($googlePagespeedData) {
            $screenshot = $googlePagespeedData['lighthouseResult'];

            $data = array('screenshot' => $screenshot, 'error' => false);
        }
        return $data;
    }

    function createTargetURL($username, $description)
    {
        $target = str_replace(["__username", "__description"], [$username, $description], $this->generationApi);
        return $this->hostApi . urlencode($target);
    }
}
