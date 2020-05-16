<?php
class ProfileModel
{
    public $username;
    public $description;

    public function __construct($username, $description)
    {
        $this->username = $username;
        $this->description = $description;
    }

    static function set($username, $description)
    {
        return new ProfileModel($username, $description);
    }
}
