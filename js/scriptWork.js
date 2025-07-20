function media(){
    function responsive(x){
        const menuContainer = document.getElementsByClassName("dropdown")[0];
        const menuButton = menuContainer.getElementsByTagName("button")[0];
        const menu = document.getElementById("menu");

        if (x.matches){
            menuContainer.insertAdjacentElement("beforebegin", menu);
        }else {
            menuButton.insertAdjacentElement("afterend", menu);
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
    const body = document.body;
    body.style.transition = "all 1s";
    const container = document.getElementsByClassName("container");
    const hireMe = document.getElementsByClassName("promote")[0];

    if (body.style.backgroundColor === "white"){
        //Dark mode
        body.style.backgroundColor = "#2D2F31";
        body.style.color = "white";
        document.getElementById("email").style.color = "white";
        document.getElementById("mode").style.transition = "all 1s";
        document.getElementById("sun_moon").src = "./img/moon.svg";
        document.getElementById("sun_moon").alt = "dark";
        document.getElementById("sun_moon").style.transition = "all 1s";
        document.getElementById("facebook_foot").src = "./img/facebook_white_icon.png";
        document.getElementById("instagram_foot").src = "./img/instagram_white_icon.png";
        for(let i=0; i<container.length; i++){
            container[i].style.backgroundColor = "#2D2F31";
            container[i].style.color = "white";
        }
        hireMe.style.backgroundColor = "#2D2F31";
        hireMe.style.color = "white";
    } else {
        //Light mode
        body.style.backgroundColor = "white";
        body.style.color = "#2D2F31";
        document.getElementById("email").style.color = "black";
        document.getElementById("sun_moon").src = "./img/sun.svg";
        document.getElementById("sun_moon").alt = "light";
        document.getElementById("facebook_foot").src = "./img/facebook_icon.png";
        document.getElementById("instagram_foot").src = "./img/instagram_icon.png";
        for(let i=0; i<container.length; i++){
            container[i].style.backgroundColor = "white";
            container[i].style.color = "#2D2F31";
        }
        hireMe.style.backgroundColor = "white";
        hireMe.style.color = "#2D2F31";
    }
}