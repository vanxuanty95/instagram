<?php
require_once('controller/base.php');
require_once('model/profile.php');

class GenerateController extends BaseController
{
    protected $hostApi = "http://instagram.nakamadressup.com/";
    protected $generationApi = "index.php?controller=profile&action=profile&username=__username&description=__description";
    protected $keyapi = "AIzaSyBWV5zDYDRuX1clPEcadJIdriT62ejesiI";

    public function generate()
    {
        $profile = ProfileModel::set($_GET['username'], $_GET['description']);
        return $this->getImageFromGoogleApi($profile->username, $profile->description);
    }

    function getImageFromGoogleApi($username, $description)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=" . $this->createTargetURL($username, $description) . "&key=" . $this->keyapi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $googlePagespeedData = curl_exec($ch);
        curl_close($ch);
        $googlePagespeedData = json_decode($googlePagespeedData, true);

        if ($googlePagespeedData["error"] == null) {
            $screenshot = $googlePagespeedData['lighthouseResult']['audits']['final-screenshot']['details']['data'];
            $screenshot = str_replace(array('_','-'), array('/','+'), $screenshot);
            $data = array($screenshot);
        } else {
            $data = array('error' => $googlePagespeedData["error"]);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        return $data;
    }

    function createTargetURL($username, $description)
    {
        $target = str_replace(["__username", "__description"], [$username, $description], $this->generationApi);
        return $this->hostApi . urlencode($target);
    }
}
