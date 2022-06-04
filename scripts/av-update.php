<?php
require "connect.php";
session_start();
$user_id = $_SESSION['user'];
$avatar_id = $_GET['avatar'];
$mysql->query("UPDATE `user` SET `avatar_id`='$avatar_id' WHERE `user_id`='$user_id'");
header('Location: /messenger.php');
