<?
session_start();
require "../connect.php";
$name = $_POST['name'];
$this_user0 = $_SESSION['user'];
$result = $mysql->query("SELECT `login` FROM `user` WHERE `user_id`=$this_user0")->fetch_assoc();
$this_user = $result['login'];
$users0 = explode("\n", str_replace("\r", "", $_POST['users']));
array_unshift($users0, $this_user);
$users = array_unique($users0);
if (count($users) > 2 && $name == '') {
    echo "<script>alert(\"Введите название чата\");
    location.href='/messenger.php';</script>";
    exit;
}
$mysql->query("INSERT INTO `chat` (`name`) VALUES ('$name')");
$chat_id = $mysql->insert_id;
foreach ($users as $i => $value) {
    $str = str_replace('\n', '', $value);
    $result = $mysql->query("SELECT `user_id` FROM `user` WHERE `login`='$value'")->fetch_assoc();
    $user_id = $result['user_id'];
    $mysql->query("INSERT INTO `user_chat`(`chat_id`, `user_id`) VALUES ($chat_id,$user_id)");
}
header('Location: /messenger.php');
