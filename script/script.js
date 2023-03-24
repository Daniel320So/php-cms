// Declare data
const menuItems = [
    {text: "About", link: "#about"},
    {text: "Experience", link: "#experience"},
    {text: "Projects", link: "#projects"},
    {text: "Contact", link: "#contacts"},
]

let currentWork = "experience-image-frame-1";

// load page
const loadPage = () => {

    //add menu items
    menuItems.forEach(item => {
        let itemEle = `<li><a href="${item.link}">${item.text}</a></li>`
        $("#menu").append(itemEle)
    });

    //animate typing
    let sec = 0
    $("#tag-line").children().each(function() {
        let ele = $(this)
        setTimeout(function() {
            ele.show()
            ele.addClass("animate-typing1")
        }, sec)
        sec = sec + 750
        setTimeout(function() {
            ele.width("fit-content")
            ele.css("animation-play-state","paused");
            ele.removeClass("animate-typing1");
        }, sec)
    })

    let ele = $("#main").find("h1")
    setTimeout(function() {
        ele.show()
        ele.addClass("animate-typing2")
    }, sec)
    sec = sec + 1000
    setTimeout(function() {
        ele.width("fit-content")
        ele.css("animation-play-state","paused");
        ele.removeClass("animate-typing2");
    }, sec)

    setTimeout(function(){
        $("#main").find("p").show()
        $("#main").find("p").addClass("fade-in")
    }, sec)


    //add onclick to menu button
    $("#menu-button").on("click", function() {
        $("#main-navigation").toggle();
    })

    //add onhover and onclick to working experience
    $("#experience-image").children().each(function(){
        $(this).on("mouseover", function(){
            if ($(this)[0].classList.contains("experience-active")) return
            $(this).addClass("experience-image-frame-hover")
            $(`#${currentWork}`).addClass("experience-image-frame-mouseout")
        })
        $(this).on("mouseout", function(){
            if ($(this)[0].classList.contains("experience-active")) return
            $(this).removeClass("experience-image-frame-hover")
            $(`#${currentWork}`).removeClass("experience-image-frame-mouseout")
        })
        $(this).on("click", function(){
            if ($(this)[0].classList.contains("experience-active")) return
            let id = $(this)[0].id
            $(this).addClass("experience-active")
            $(this).removeClass("experience-image-frame-hover")
            $(`#${currentWork}`).removeClass("experience-active")
            $(`#${currentWork}`).removeClass("experience-image-frame-mouseout")
            let currenWorkNumber = currentWork.split("-")[3];
            $(`#experience-description-${currenWorkNumber}`).hide();
            console.log(`#experience-description-${currenWorkNumber}`);
            currentWork = id

            //Show Element
            $(`#experience-description-${id.split("-")[3]}`).show();
        })
    })

    //add view Resume in working experience
    $("#btn-resume").on("click", function() {
        window.open("https://drive.google.com/file/d/14NsTJoRy_WW747Re5xIWhsiAIOKlYfHQ/view?usp=share_link", '_blank');
    })

    //add submit to contact form
    const submitForm = () => {
        if (!$("#subject").val() || !$("#nameInput").val() || !$("#message").val()) {
            $("#form-msg").show()
            $("#form-msg").text("Please fill in all the information.")
            return false;
        }
        window.location.href = `mailto:dan320so@gmail.com?subject=${$("#subject").val()} - ${$("#nameInput").val()}&body=${$("#message").val()}`;
        $("#form-msg").hide()
        return false;
    }

    $("#contacts-form").on("submit", submitForm)
}

$(window).on("load", loadPage)