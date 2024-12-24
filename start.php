<?php
require_once "vendor/autoload.php";
use Dotenv\Dotenv;


$env = Dotenv::createImmutable(__DIR__);
$env->load();


if (!file_exists("userdata.json")){
    $userDataFile = fopen("userdata.json", "w");
    fclose($userDataFile);
    require_once "telegram/first_start.php";
}

require_once "telegram/message_handler.php";