<?php
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter
{
    /**
     * @var
     */
    private $conn;

    public function __construct($consumerKey, $consumerSecret, $oauthToken, $oauthTokenSecret)
    {
        $this->conn = new TwitterOAuth($consumerKey, $consumerSecret, $oauthToken, $oauthTokenSecret);
        $this->conn->get("account/verify_credentials");
    }

    public function getTweetCount($name)
    {
        $statuses = $this->conn->get("users/show", ["screen_name" => $name]);
        if(property_exists($statuses,'statuses_count')){
            return intval($statuses->statuses_count);
        }
        return 0;
    }

}