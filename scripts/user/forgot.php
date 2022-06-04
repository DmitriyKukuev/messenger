<?php
session_start();
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

require "../connect.php";
$result = $mysql->query("SELECT `login` FROM `user` WHERE `login`='$login'");
$user = $result->fetch_assoc();
if (count($user) == 0) {
?>
    <script>
        alert("Пользователь не найден");
        location.href = '/index.html';
    </script>
<?
    exit;
} else if (mb_strlen($password) < 4 || mb_strlen($password) > 90) {
?>
    <script>
        alert("Недопустимая длина пароля");
        location.href = '/index.html';
    </script>
<?
    exit;
}
$password = md5($password . "34vn328vn5"); //хеширование пароля
$mysql->query("UPDATE `user` SET `password`='$password' WHERE `login`='$login'");
$result = $mysql->query("SELECT `user_id`  FROM `user` WHERE `login`='$login' AND `password`='$password'");
$user = $result->fetch_assoc();
$_SESSION['user'] = $user['user_id'];
header('Location: /messenger.php');
