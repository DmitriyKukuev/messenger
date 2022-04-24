<?php
$chat_id = $_GET['chat_id'];
$user_id = $_COOKIE['user'];
require "../connect.php";
$result = $mysql->query("SELECT `chat`.`name`
FROM `chat` WHERE `chat`.`chat_id`='$chat_id'");
$chat = $result->fetch_assoc();
if ($chat['name'] != '') {
?>
    <img class="chat-logo1" src="icons/chats.png">
    <span class="chat-name"><? echo $chat['name'] ?></span>
    <button onclick="dropRightMenu()" class="icons-button"><img src="icons/menu.png" class="icons-menu"></button>
<?
} else {
    $result = $mysql->query("SELECT `user`.`login`,`user`.`avatar_id`
    FROM `user_chat` 
    JOIN `user` ON `user_chat`.`user_id`=`user`.`user_id`
    JOIN `chat` ON `user_chat`.`chat_id`=`chat`.`chat_id`
    WHERE `chat`.`chat_id`='$chat_id'
    AND `user`.`user_id`!='$user_id'");
    $user_chat = $result->fetch_assoc();
?>
    <img class="chat-logo1" src="img/<? echo $user_chat['avatar_id'] ?>.png">
    <span class="chat-name"><? echo $user_chat['login'] ?></span>
    <button onclick="dropRightMenu()" class="icons-button"><img src="icons/menu.png" class="icons-menu"></button>
<?
}
