<?php
use Telegram\Bot\FileUpload\InputFile;
$url = $_ENV["incomingUrl"];

$execOutput = "";
$fileName = preg_filter("/http(s?):\/\/(www.)?/", "", $url);
$fileName = preg_filter("/\.[A-z]{1,6}\/.{1,800}/", "", $fileName);
$fileName = time()."-".$fileName;


exec("cd ./downloaded && wget -O $fileName $url && cd ..", $execOutput);


$telegram->sendDocument([
    "chat_id" => $chatId,
    "document" => InputFile::create("downloaded/$fileName")
    ]);

if (!$_ENV["SAVE_DOWNLOADED_FILES"]) {
    unlink("downloaded/$fileName");
}