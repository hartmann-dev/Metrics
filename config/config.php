<?php
//defaults
$files = [
    'in' => 'list.php',
    'out' => 'urlist.php',
];

if(file_exists('file.config.php')){
    $files = array_merge($files, include ('file.config.php'));
}


$config = [
    'api' => [
        'twitter' => include('twitter.config.php'),
        'github' => include('github.config.php'),
    ],
    'files' => $files,
];


return $config;