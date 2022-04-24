function load_chat() {
    $("#chats").load("scripts/chat/load-chat.php");
}

$(load_chat());

var chatInterval = setInterval(load_chat, 5000);

var messageInterval;

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

$("#search").on("click", function () {
    var req = $("#search-input").val();
    if (req == '') {
        return;
    }
    $.get("scripts/chat/load-users.php", { 'user': req }, function (data) {
        $("#chats").html(data);
    });
    clearInterval(chatInterval);
    document.getElementById("search").classList.toggle("hide");
    document.getElementById("x1").classList.toggle("hide");
    $("#search-input").prop("disabled", true);
});

$("#x1").on("click", function () {
    load_chat();
    chatInterval = setInterval(load_chat, 5000);
    document.getElementById("search-input").value = "";
    document.getElementById("search").classList.toggle("hide");
    document.getElementById("x1").classList.toggle("hide");
    $("#search-input").prop("disabled", false);
});

function loadInfo(req) {
    var chat_id = req;
    $.get("scripts/chat/load-info.php", { 'chat_id': chat_id }, function (res) {
        $("#chat-info").html(res);
    });

    $.get("scripts/chat/load-info-up.php", { 'chat_id': chat_id }, function (res) {
        $("#center-up").html(res);
    });

    $.get("scripts/chat/load.php", { 'chat_id': chat_id }, function (res) {
        $("#messages").html(res);
    });

    setTimeout(function () {
        messageInterval = setInterval(load_messages, 2000);
    }, 2000)
}

function load_messages() {
    var chat_id = getCookie('chat');
    $.get("scripts/chat/load.php", { 'chat_id': chat_id }, function (data) {
        $("#messages").html(data);
    });
}

function sendMessage() {
    var message = $("#message").val();
    if (message == '' || !getCookie('chat')) {
        return;
    }

    $.ajax({
        url: 'scripts/chat/post.php',
        type: 'POST',
        data: { 'message': message },
        dataType: 'text',
        beforeSend: function () {
            $("#sendMessage").prop("disabled", true);
            $("#sendForm").trigger("reset");
        },
        success: function () {
            $("#sendMessage").prop("disabled", false);
            load_messages();
        }
    });
}

$("#sendMessage").on("click", function () {
    sendMessage();
});

$("#message").on('keydown', function (e) {
    if (e.code == 'Enter') {
        sendMessage();
    }
});