function dropLeftMenu() {
    document.getElementById("leftMenu").classList.toggle("show");
    var div1 = document.getElementById("avatar");
    if (div1.classList.contains("show")) {
        div1.classList.remove("show");
    }
    var div2 = document.getElementById("makeChat");
    if (div2.classList.contains("show")) {
        div2.classList.remove("show");
    }
}

function dropRightMenu() {
    document.getElementById("rightMenu").classList.toggle("show");
    document.getElementById("center1").classList.toggle("w1");
    document.getElementById("left1").classList.toggle("w2");
}

function dropSettings() {
    document.getElementById("st").classList.toggle("show");
    var av1 = document.getElementById("av");
    if (av1.classList.contains("show")) {
        av1.classList.remove("show");
    }
}

function dropAvatar() {
    document.getElementById("avatar").classList.toggle("show");
    var div = document.getElementById("makeChat");
    if (div.classList.contains("show")) {
        div.classList.remove("show");
    }
}

function dropMakeChat(){
    document.getElementById("makeChat").classList.toggle("show");
    var div = document.getElementById("avatar");
    if (div.classList.contains("show")) {
        div.classList.remove("show");
    }
}