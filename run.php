<?php
require_once 'vendor/autoload.php';
require 'GitHub.php';
require 'Twitter.php';

$config = include('config/config.php');


define('CONSUMER_KEY', $config['api']['twitter']['consumerKey']);
define('CONSUMER_SECRET', $config['api']['twitter']['consumerSecret']);
define('ACCESS_TOKEN', $config['api']['twitter']['accessToken']);
define('ACCESS_TOKEN_SECRET', $config['api']['twitter']['accessTokenSecret']);
define('GITHUB_ACCESS_TOKEN', $config['api']['github']['accessToken']);

$twitter = new Twitter(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
$github = new GitHub(GITHUB_ACCESS_TOKEN);


$readFileHandle =  fopen("list.csv", "r");
$writeFileHandle = fopen("urlist.csv", "w");

if (FALSE != $readFileHandle && FALSE != $writeFileHandle) {
    fputcsv($writeFileHandle,
        ['GitHub Repository', 'Twitter Account', 'GitHub Contributors', 'Twitter Tweets'],
    ";"
    );

    while (($data = fgetcsv($readFileHandle, 0, ";")) !== FALSE) {
        fputcsv($writeFileHandle, [
            $data[0],
            $data[1],
            $github->getContributorCount($data[0]),
            $twitter->getTweetCount($data[1])
        ], ";");
    }
    fclose($readFileHandle);
    fclose($writeFileHandle);

}

unset($github);
unset($twitter);





