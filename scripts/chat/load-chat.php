<?php
session_start();
require "../connect.php";
$user = $_SESSION['user'];
$result = $mysql->query("SELECT `chat`.`chat_id`,`chat`.`name`
FROM `user_chat`
JOIN `user` ON `user_chat`.`user_id`=`user`.`user_id`
JOIN `chat` ON `user_chat`.`chat_id`=`chat`.`chat_id`
WHERE `user`.`user_id`='$user'");
while ($i = $result->fetch_assoc()) {
    if ($i['name'] == '') {
        $chat_id = $i['chat_id'];
        $result1 = $mysql->query("SELECT `user`.`user_id`,`user`.`login`,`user`.`avatar_id`
        FROM `user_chat`
        JOIN `user` ON `user_chat`.`user_id`=`user`.`user_id`
        JOIN `chat` ON `user_chat`.`chat_id`=`chat`.`chat_id`
        WHERE `chat`.`chat_id`='$chat_id'
        AND `user`.`user_id`!='$user'");
        $user0 = $result1->fetch_assoc();
?>
        <button class="chat-button" value="<? echo $i['chat_id'] ?>" onclick="loadInfo(value)">
            <div class="chat">
                <img class="chat-logo" src="img/<? echo $user0['avatar_id'] ?>.png" alt="img">
                <span class="chat-name"><? echo $user0['login'] ?></span>
            </div>
        </button>
    <?
    } else {
    ?>
        <button class="chat-button" value="<? echo $i['chat_id'] ?>" onclick="loadInfo(value)">
            <div class="chat">
                <img class="chat-logo" src="icons/chats.png" alt="img">
                <span class="chat-name"><? echo $i['name'] ?></span>
            </div>
        </button>
<?
    }
}
