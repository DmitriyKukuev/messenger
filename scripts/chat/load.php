<?php
require "../connect.php";
$chat_id = $_GET['chat_id'];
$result = $mysql->query("SELECT `message`.`message_id`,`user`.`avatar_id`,`user`.`login`,`message`.`text` 
FROM `user_chat`
JOIN `message` ON `user_chat`.`chat_id`=`message`.`chat_id` 
AND `user_chat`.`user_id`=`message`.`user_id`
JOIN `user` ON `user_chat`.`user_id`=`user`.`user_id`
JOIN `chat` ON `user_chat`.`chat_id`=`chat`.`chat_id`
WHERE `chat`.`chat_id`='$chat_id'
ORDER BY `message_id`");
while ($i = $result->fetch_assoc()) {
?>
    <div class="message" id="qwer">
        <img src="img/<? echo $i['avatar_id'] ?>.png" class="message-icons">
        <div class="message-text">
            <span class="message-login"><? echo $i['login'] ?></span><br>
            <span><? echo $i['text'] ?></span>
        </div>
    </div>
<?
}
