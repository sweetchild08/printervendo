<?php
/*
* Use the lpstat command to see a list of available printers:
* `lpstat -p -d`
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

ini_set('safe_mode', 'Off');
define("PRINTER", 'EPSON_L120_Series');
define("FILES_DIR", __DIR__.'/files/');
define("THUMBNAILS_DIR", __DIR__.'/thumbnails/');


include 'db.php';
// make a connection to mysql here
$options = [
    'username' => 'admin',
    'database' => 'printervendo',
    'password' => 'paprintpo',
    'type' => 'mysql',
    'charset' => 'utf8',
    'host' => 'localhost',
    'port' => '3306'
];
// print_r($_SESSION);
$db = new Database($options);

$allowed_types = [
    'application/pdf', 
    'image/jpeg', 
    'image/png', 
    'image/gif',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/msword',
    'application/doc',
    'application/ms-doc',    
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'application/x-excel',
    'application/x-msexcel',    
    'application/vnd.ms-excel',
    'application/excel',
    'application/vnd.openxmlformats-officedocument.presentationml.presentation', 
    'application/x-mspowerpoint',    
    'application/vnd.ms-powerpoint',
    'application/mspowerpoint',
    'application/powerpoint'
];
include 'controller/getclient.php'


?>
