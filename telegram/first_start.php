<?php
# Сохраняет айди чата с пользователем в файл userdata.json
use Telegram\Bot\Api;

$token = $_ENV["TG_BOT_TOKEN"];
$telegram = new Api($token);
$checkNumber = rand(1000, 5000);

echo "Пришлите боту в личные сообщения следующую комбинацию цифр ".$checkNumber."\n";

while (true) {
    $updates = $telegram->getUpdates([
        "offset" => -1,
        "allowed_updates" => "message"
    ]);
    $message = $updates[0]->getMessage();


    if ("".$message["text"] !== "$checkNumber") {
        continue;
    }

    $_ENV["userData"]["chatId"] = $message["chat"]["id"];
    file_put_contents("userdata.json", json_encode($_ENV["userData"]));
    break;
}