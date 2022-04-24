<?php
require "../connect.php";
$dacookie = $_COOKIE['user'];
$avatar_id = 2;
$mysql->query("UPDATE `user` SET `avatar_id`='$avatar_id' WHERE `user_id`='$dacookie'");
header('Location: /messenger.php');
