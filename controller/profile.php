<?php
require_once('controller/base.php');
require_once('model/profile.php');

class ProfileController extends BaseController
{
    protected $maximumImages = 7;

    function __construct()
    {
        $this->file = 'profile';
    }

    public function profile()
    {
        if ($_GET['username'] == "") {
            $data = array("error" => "username is empty");
        } else {
            $profile = ProfileModel::set($_GET['username'], $_GET['description']);
            $result = $this->getImageFromInstagramApi($profile->username, $profile->description);
            if (!empty($result["error"])) {
                $data = array("error" => $result["error"]);
            } else {
                $data = array('profile' => $result);
            }
        }
        $this->render($data);
    }

    function getImageFromInstagramApi($username, $description)
    {
        $username = trim($username);
        $description = trim($description);

        $background_blur = "";
        $cover = "";
        $mostRecents = array();

        $instagramData = json_decode($this->curl_get_contents("https://www.instagram.com/" . $username . "/?__a=1"));
        if ($instagramData != null && !empty(get_object_vars($instagramData))) {
            $edgesArray = $instagramData->graphql->user->edge_owner_to_timeline_media->edges;
            $edgesIdx = 0;
            $maximumLoopArray = 0;
            if (count($edgesArray) === 0) {
                $this->maximumImages = 0;
                $data = array('error' => "profile doesn't have enough images");
            } else {
                if (count($edgesArray) < $this->maximumImages) {
                    $this->maximumImages = count($edgesArray);
                }
                $maximumLoopArray = $this->maximumImages - 1;
                for ($edgesIdx = 0; $edgesIdx < $maximumLoopArray; ++$edgesIdx) {
                    $most_recent = $edgesArray[$edgesIdx]->node->display_url;
                    $mostRecents[] = $most_recent;
                }

                $background_blur = $edgesArray[$maximumLoopArray]->node->display_url;
                $cover = $edgesArray[$maximumLoopArray]->node->display_url;

                $data = array(
                    "user_name" => "@" . $username,
                    "description" => "\"" . $description . "\"",
                    "author_name" => $instagramData->graphql->user->full_name,
                    "profile_image" =>  $instagramData->graphql->user->profile_pic_url_hd,
                    "post_count" => $instagramData->graphql->user->edge_owner_to_timeline_media->count,
                    "follower_count" => $instagramData->graphql->user->edge_followed_by->count,
                    "following_count" => $instagramData->graphql->user->edge_follow->count,
                    "mostRecents" => $mostRecents,
                    "background_blur" => $background_blur,
                    "cover" => $cover,
                );
            }
        } else {
            $data = array('error' => "can not get information");
        }
        return $data;
    }

    function curl_get_contents($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
