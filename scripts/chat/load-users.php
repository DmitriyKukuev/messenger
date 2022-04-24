<?php
require "../connect.php";
$req = $_GET['user'];
$this_user = $_COOKIE['user'];
$result = $mysql->query("SELECT `user`.`login`,`user`.`avatar_id` 
FROM `user` WHERE `user`.`login` RLIKE '$req'");
while ($i = $result->fetch_assoc()) {
?>
    <div class="chat-button">
        <div class="chat">
            <img class="chat-logo" src="img/<? echo $i['avatar_id'] ?>.png" alt="img">
            <span class="chat-name"><? echo $i['login'] ?></span>
        </div>
    </div>
<?
}
$result = $mysql->query("SELECT `chat`.`name`
FROM `user_chat`
JOIN `user` ON `user`.`user_id`=`user_chat`.`user_id`
JOIN `chat` ON `chat`.`chat_id`=`user_chat`.`chat_id`
WHERE `chat`.`name` RLIKE '$req'
AND `user`.`user_id`= $this_user");
while ($i = $result->fetch_assoc()) {
?>
    <div class="chat-button">
        <div class="chat">
            <img class="chat-logo" src="icons/chats.png" alt="img">
            <span class="chat-name"><? echo $i['name'] ?></span>
        </div>
    </div>
<?
}
