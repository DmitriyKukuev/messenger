<?php
if (isset($_COOKIE['chat'])) {
    setcookie('chat', '', time() - 3600 * 12, "/");
}
session_start();
if(!isset($_SESSION['user'])||$_SESSION['user']==''){
    header('Location: /index.html');
}
require "scripts/connect.php";
$user_id = $_SESSION['user'];
$result = $mysql->query("SELECT * FROM `user` WHERE `user_id`= '$user_id'");
$user = $result->fetch_assoc();
$av = $user['avatar_id'];
$mysql->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="logos/logo.png">
    <link rel="stylesheet" href="css/messenger-style.css" />
    <title>KDA message</title>
</head>

<body>
    <!-- левая часть -->
    <div class="left" id="left1">
        <!-- левое меню -->
        <div class="left-menu" id="leftMenu">
            <button onclick="dropLeftMenu()" class="lm-button1">Свернуть</button>

            <div class="lm-l">
                <img src="img/<? echo $av; ?>.png" class="icon">
                <span class="lm-l1"><?= $user['login'] ?></span>
            </div>

            <button onclick="dropMakeChat()" class="lm-button">
                <div class="lm-l">
                    <img src="icons/chat.png" class="lm-icons">
                    <span class="lm-text">Создать чат</span>
                </div>
            </button>
            <button onclick="dropAvatar()" class="lm-button">
                <div class="lm-l">
                    <img src="icons/profile.png" class="lm-icons">
                    <span class="lm-text">Выбрать аватар</a></span>
                </div>
            </button>
            <button onclick="window.location.href='scripts/user/exit.php';" class="lm-button">
                <div class="lm-l">
                    <img src="icons/logout.png" class="lm-icons">
                    <span class="lm-text">Выход из аккаунта</a></span>
                </div>
            </button>

        </div>
        <!-- левый верх: поиск и конпка левого меню -->
        <div class="left-up">
            <button onclick="dropLeftMenu()" class="icons-button">
                <img src="icons/menu.png" class="icons-menu">
            </button>
            <input autocomplete="off" type="text" placeholder="Поиск" id="search-input">
            <button class="icons-button" id="search">
                <img class="icons" src="icons/search.png">
            </button>
            <button class="icons-button hide" id="x1">
                <img class="icons" src="icons/x.png">
            </button>
        </div>
        <!-- левая середина: чаты -->
        <div class="left-chats" id="chats">
            <!-- чаты -->
        </div>
    </div>
    <!-- центр -->
    <div class="center" id="center1">
        <!-- центральный верх -->
        <div class="center-up" id="center-up">
        </div>
        <!-- центр: поле сообщений -->
        <div class="center-chat" id="">
            <div class="messages" id="messages">
                <!-- сообщения -->
            </div>
        </div>
        <!-- центральный низ: ввод и отправка сообщения -->
        <div class="center-send">
            <form id="sendForm" class="cs-form" onsubmit="return false">
                <!-- <button class="icons-button"> -->
                <img src="icons/smile.png" class="icons-button icons">
                <!-- </button> -->
                <input type="text" id="message" name="message" class="cs-input" autocomplete="off" placeholder="Введите сообщение...">
                <button type="button" id="sendMessage" class="icons-button">
                    <img src="icons/send.png" class="icons">
                </button>
            </form>
        </div>
    </div>
    <!-- правое меню -->
    <div class="right-menu" id="rightMenu">
        <button onclick="dropRightMenu()" class="lm-button1">Свернуть</button>
        <div id="chat-info">
        </div>
    </div>

    <!-- левое меню: выбор аватара -->
    <div class="avatar" id="avatar">
        <button onclick="dropAvatar()" class="av-x"><img src="icons/x.png" class="icons"></button>
        <span class="av-text">Выберите аватар</span>
        <div class="av-avatars">
            <?
            for ($i = 1; $i < 7; $i++) {
            ?>
                <button onclick="window.location.href='scripts/av-update.php?avatar=<? echo $i ?>'" class="av-ab">
                    <img class="av-icon" src="img/<? echo $i ?>.png">
                </button>
            <? } ?>
        </div>
        <button onclick="window.location.href='scripts/av-update.php?avatar=7'" class="av-del">Удалить аватар</button>
    </div>

    <!-- левое меню: создание чата -->
    <div class="make-chat" id="makeChat">
        <button onclick="dropMakeChat()" class="mc-x"><img src="icons/x.png" class="icons"></button>
        <form action="scripts/chat/make-chat.php" method="post">
            <input autocomplete="off" type="text" name="name" placeholder="Название чата">
            <textarea name="users" cols="30" rows="6" placeholder="Введите каждого участника с новой строки"></textarea>
            <button class="mc-button" type="submit">Создать</button>
        </form>
    </div>
    <script src="js/drop-menu.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/cookielib/src/cookie.js"></script>
    <script src="scripts/chat/chat.js"></script>
</body>

</html>