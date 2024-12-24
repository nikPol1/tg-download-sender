<?php
use Telegram\Bot\Api;
$token = $_ENV["TG_BOT_TOKEN"];
$telegram = new Api($token);

$_ENV["userData"] = json_decode(file_get_contents("userdata.json"), true);

if (is_null($_ENV["userData"] )) {
    require_once "first_start.php";
}

$chatId = $_ENV["userData"]["chatId"];

while (true) {
    $updates = $telegram->getUpdates([
        "offset" => -1,
        "allowed_updates" => "message"
    ]);
    $message = $updates[0]->getMessage();

    if ($message["chat"]["id"] !== $chatId) {
        continue;
    }

    $matchUrl = preg_match("/http(s?):\/\/(www.)?(.{1,100})\.[A-z]{1,6}\/.{1,800}/u",$message["text"]);
    if ($matchUrl) {
        $_ENV["incomingUrl"] = $message["text"];
        require "downloader.php";
    }

    var_dump($aaa);
}