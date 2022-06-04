<?php
session_start();
$message = htmlspecialchars($_POST['message']);
$chat_id = $_COOKIE['chat'];
$user_id = $_SESSION['user'];
require "../connect.php";
$mysql->query("INSERT INTO `message` (`text`,`chat_id`,`user_id`) VALUES ('$message','$chat_id','$user_id')");
