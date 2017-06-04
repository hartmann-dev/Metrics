<?php
require_once 'vendor/autoload.php';
require 'GitHub.php';
require 'Twitter.php';

$config = include('config/config.php');

$twitter = new Twitter($config['api']['twitter']);
$github = new GitHub($config['api']['github']);

$readFileHandle =  fopen($config['files']['in'], "r");
$writeFileHandle = fopen($config['files']['out'], "w");

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





