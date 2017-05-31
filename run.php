<?php
require_once 'vendor/autoload.php';
require 'GitHub.php';
require 'Twitter.php';


define('CONSUMER_KEY', 'XXX');
define('CONSUMER_SECRET', 'XXX');
define('ACCESS_TOKEN', 'XXX');
define('ACCESS_TOKEN_SECRET', 'XXX');
define('GITHUB_ACCESS_TOKEN','XXX');

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





