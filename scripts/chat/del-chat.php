<?
require "../connect.php";
$chat_id = $_COOKIE['chat'];
$mysql->query("DELETE FROM `message` WHERE `chat_id`=$chat_id");
$mysql->query("DELETE FROM `user_chat` WHERE `chat_id`=$chat_id");
$mysql->query("DELETE FROM `chat` WHERE `chat_id`=$chat_id");
header('Location: /messenger.php');
