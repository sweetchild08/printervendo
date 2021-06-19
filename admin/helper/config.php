<?php

define("APP_NAME","TriBook");


session_start();

include 'db.php';
include 'helper.php';
// make a connection to mysql here
$options = [
    //required
    'username' => 'root',
    'database' => 'tribook',
    //optional
    'password' => '',
    'type' => 'mysql',
    'charset' => 'utf8',
    'host' => 'localhost',
    'port' => '3306'
];

$db = new Database($options);