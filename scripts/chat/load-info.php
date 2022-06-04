<?php
session_start();
$chat_id = $_GET['chat_id'];
setcookie('chat', '', time() - 3600 * 12, "/");
setcookie('chat', $chat_id, time() + 3600 * 12, "/");
$user_id = $_SESSION['user'];
require "../connect.php";
$result = $mysql->query("SELECT `chat`.`chat_id`,`chat`.`name`
FROM `chat` WHERE `chat`.`chat_id`='$chat_id'");
$chat = $result->fetch_assoc();
if ($chat['name'] != '') {
    $result = $mysql->query("SELECT count(*)
    FROM `user_chat` 
    JOIN `user` ON `user_chat`.`user_id`=`user`.`user_id`
    JOIN `chat` ON `user_chat`.`chat_id`=`chat`.`chat_id`
    WHERE `chat`.`chat_id`='$chat_id'");
    $count_user = $result->fetch_assoc();
    $result = $mysql->query("SELECT `user`.`login`,`user`.`avatar_id`
    FROM `user_chat` 
    JOIN `user` ON `user_chat`.`user_id`=`user`.`user_id`
    JOIN `chat` ON `user_chat`.`chat_id`=`chat`.`chat_id`
    WHERE `chat`.`chat_id`='$chat_id'");
?>
    <div class="rm-r">
        <img src="icons/chats.png" class="rm-icon">
        <div class="rm-r1">
            <span class="chat-name"><? echo $chat['name'] ?></span>
        </div>
    </div>
    <div class="rm-r">
        <div class="rm-people">
            <span>Участники: <? echo $count_user['count(*)'] ?></span>
            <div class="rm-r2">
                <?
                while ($i = $result->fetch_assoc()) {
                ?>
                    <div class="rm-part">
                        <img src="img/<? echo $i['avatar_id'] ?>.png" class="part-icon">
                        <span class="part-text"><? echo $i['login'] ?></span>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
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
    <div class="rm-r">
        <img src="img/<? echo $user_chat['avatar_id'] ?>.png" class="rm-icon">
        <div class="rm-r1">
            <span class="chat-name"><? echo $user_chat['login'] ?></span>
        </div>
    </div>
<?
}
?>
<button onclick="window.location.href='scripts/chat/del-chat.php'" class="lm-button1" id="rm-b">Удалить чат</button>
<?
