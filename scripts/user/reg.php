<?php
session_start();
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

require "../connect.php";
$result = $mysql->query("SELECT `login` FROM `user` WHERE `login`='$login'");
$exist_user = $result->fetch_assoc();
if (count($exist_user) > 0) {
?>
    <script>
        alert("Такой пользователь уже существует");
        location.href = '/index.html';
    </script>
<?
    exit;
} else if (mb_strlen($login) < 4 || mb_strlen($login) > 50) {
?>
    <script>
        alert("Недопустимая длина логина");
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
$mysql->query("INSERT INTO `user` (`login`,`password`,`avatar_id`) VALUES('$login','$password',7)");
$result = $mysql->query("SELECT `user_id`  FROM `user` WHERE `login`='$login' AND `password`='$password'");
$user = $result->fetch_assoc();
$_SESSION['user'] = $user['user_id'];
header('Location: /messenger.php');
