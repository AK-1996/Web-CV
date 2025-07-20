function media(){
    function responsive(x){
        const menuContainer = document.getElementsByClassName("dropdown")[0];
        const menuButton = menuContainer.getElementsByTagName("button")[0];
        const menu = document.getElementById("menu");
        const centerPanel = document.getElementById("centerPanel");
        const leftPanel = centerPanel.getElementsByTagName("div")[0];
        const modeButton = document.getElementById("mode");
        const footList = document.getElementsByClassName("foot")[1];
        const footListItems = footList.getElementsByTagName("li");

        if (x.matches){
            menuContainer.insertAdjacentElement("beforebegin", menu);
            centerPanel.insertAdjacentElement("beforebegin", modeButton);
        }else {
            menuButton.insertAdjacentElement("afterend", menu);
            leftPanel.insertAdjacentElement("afterbegin", modeButton);
        }
    }

    x = window.matchMedia("(min-width: 768px)");
    responsive(x);
    x.addEventListener("change", responsive);

    document.body.style.backgroundColor = "white";
}

function menu(){
    const menu = document.getElementById("menu");
    menu.classList.toggle("show");
}

function dark_light(){
    document.body.style.transition = "all 1s";

    if (document.body.style.backgroundColor === "white"){
        //Dark mode
        document.body.style.backgroundColor = "#2D2F31";
        document.body.style.color = "white";
        document.getElementById("email").style.color = "white";
        // document.getElementById("mode").style.backgroundColor = "white";
        document.getElementById("mode").style.transition = "all 1s";
        // document.getElementById("sun_moon").style.backgroundColor = "white";
        document.getElementById("sun_moon").src = "./img/moon.svg";
        document.getElementById("sun_moon").alt = "dark";
        document.getElementById("sun_moon").style.transition = "all 1s";
        document.getElementById("work").style.border = "solid 1px white";
        document.getElementById("work").style.transition = "all 1s";
        document.getElementById("skills").style.transition = "all 1s";
        document.getElementById("facebook_foot").src = "./img/facebook_white_icon.png";
        document.getElementById("instagram_foot").src = "./img/instagram_white_icon.png";
    } else {
        //Light mode
        document.body.style.backgroundColor = "white";
        document.body.style.color = "#2D2F31";
        document.getElementById("email").style.color = "black";
        // document.getElementById("mode").style.backgroundColor = "white";
        // document.getElementById("sun_moon").style.backgroundColor = "white";
        document.getElementById("sun_moon").src = "./img/sun.svg";
        document.getElementById("sun_moon").alt = "light";
        document.getElementById("work").style.border = "solid 1px #2D2F31";
        document.getElementById("work").style.transition = "all 1s";
        document.getElementById("skills").style.transition = "all 1s";
        document.getElementById("facebook_foot").src = "./img/facebook_icon.png";
        document.getElementById("instagram_foot").src = "./img/instagram_icon.png";
    }
}

function workHoverOn(obj){
    const workLink = obj.getElementsByTagName("a")[0];

    obj.style.border = "solid 1px blue";
    obj.style.backgroundColor = "blue";
    workLink.style.color = "white";
}

function skillsHoverOn(obj){
    const skillsLink = obj.getElementsByTagName("a")[0];

    obj.style.backgroundColor = "white";
    skillsLink.style.color = "#2D2F31"
}

function workHoverOut(obj){
    obj.style.backgroundColor = "#2D2F31";

    if (document.body.style.backgroundColor === "white"){
        obj.style.border = "solid 1px #2D2F31";
    }else{
        obj.style.border = "solid 1px white";
    }
}

function skillsHoverOut(obj){
    const skillsLink = obj.getElementsByTagName("a")[0];

    if (document.body.style.backgroundColor === "white"){
        obj.style.border = "solid 1px blue";
        obj.style.backgroundColor = "blue";
        skillsLink.style.color = "white"
    }else{
        obj.style.border = "solid 1px blue";
        obj.style.backgroundColor = "blue";
        skillsLink.style.color = "white";
    }
}