<?php
//bot framework by @UzBestMaster

error_reporting(E_ALL);
ini_set('display_errors', 1);

$token = "XXXXX"; // bot tokeni
define('API_KEY',$token); 

$admin = "XXXXX"; // admin IDsi
$bot_us = "XXXXX"; // bot usernamesi @ siz

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$nick = $message->from->first_name;
$fnick = $message->from->last_name;
$user_id = $message->from->id;

if ($text == "/start" or $text == "/start@$bot_us"){
    bot('sendMessage',[
    'chat_id' => $chat_id,
    'text' => "*Salom* [$nick $fnick](tg://user?id=$user_id) botimizga xush kelibsiz!",
    'parse_mode'=>'markdown'
    ]);
}
