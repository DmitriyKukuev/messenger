<?php
session_start();
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

$password = md5($password . "34vn328vn5"); //хеширование пароля
require "../connect.php";
$result = $mysql->query("SELECT *  FROM `user` WHERE `login`='$login' AND `password`='$password'");
$user = $result->fetch_assoc();
if (count($user) == 0) {
?>
    <script>
        alert("Неверный логин или пароль");
        location.href = '/index.html';
    </script>
<?
    exit;
}
$_SESSION['user'] = $user['user_id'];
header('Location: /messenger.php');
