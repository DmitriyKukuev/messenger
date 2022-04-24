<?php
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

$password = md5($password . "34vn328vn5"); //хеширование пароля
require "../connect.php";
$result = $mysql->query("SELECT *  FROM `user` WHERE `login`='$login' AND `password`='$password'");
$user = $result->fetch_assoc();
if (count($user) == 0) {
    echo "<script>alert(\"Неверный логин или пароль\");
    location.href='/index.php';</script>";
    exit;
}
setcookie('user', $user['user_id'], time() + 3600 * 24 * 7, "/");
header('Location: /messenger.php');