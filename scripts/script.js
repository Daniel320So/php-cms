// Declare data
const menuItems = [
    {text: "About", link: "#about"},
    {text: "Experience", link: "#experience"},
    {text: "Projects", link: "#projects"},
    {text: "Contact", link: "#contacts"},
]

const workExperienceItems = [
    {id:"experience-image-frame-1", imgUrl:"./images/experience/IJS.png", h3Text:"Associate System Analyst", pText:"@ InstaCode Software Limited",
    description: ["- Develop web application to interact with smart contracts on public blockchains (TypeScript)", 
        "- Build servers with API to interact with the databases for Blockchain data (TypeScript, SQL)", 
        "- Lead outsourced developers on front-end development (HTML, CSS)"
    ]},
    {id:"experience-image-frame-2", imgUrl:"./images/experience/DSB.png", h3Text:"Management Trainee", pText:"@ Dah Sing Bank, Limited (IT Division)",
    description: ["- Developed robotic process automation(RPA) program to streamline SME account onboarding process (UiPath)", 
        "- Performed UAT testing on Mobile Banking Revamp project", 
        "- Conducted vendors’ selection and POC testing on information security solutions"
    ]}
]

const projectItems = [
    {name: "Flappy Bird Christmas Edition", imgUrl:"./images/projects/Flappy_Bird_Christmas_Edition.png", projectUrl:"https://flappybird.danielso.dev/"
    , githubUrl:"https://github.com/Daniel320So/HTML-FlappyBird", stacks:["CSS Animations", "HTML", "JavaScript"]},
    {name: "Random Meal Picker", imgUrl:"./images/projects/Random_Meal_Picker.png", projectUrl:"https://meal-picker.glitch.me/"
    , githubUrl:"https://github.com/Daniel320So/HTTP5111-Pet-Project-Random-Dinner-Picker", stacks:["JavaScript", "HTML"]}
]


let currentWork = workExperienceItems[0].id;
let currentPage = 1;


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
            currentWork = id

            //update Text
            let item = workExperienceItems.find( v => v.id == id)
            let h3Ele = $("#experience-description").find("h3")
            h3Ele.text(item.h3Text)
            h3Ele.removeClass("animate-experience-text")
            h3Ele.width(); // trigger a DOM reflow
            h3Ele.addClass("animate-experience-text")
            let pEle = $("#experience-description").find("p")
            pEle.text(item.pText)
            pEle.removeClass("animate-experience-text")
            pEle.width(); // trigger a DOM reflow
            pEle.addClass("animate-experience-text")
            let detailsEle = $("#experience-details")
            item.description.forEach( (line, i) => {
                $(`#experience-details-${i+1}`).text(line)
            })
            detailsEle.removeClass("animate-experience-text")
            detailsEle.width(); // trigger a DOM reflow
            detailsEle.addClass("animate-experience-text")
        })
    })

    //add view Resume in working experience
    $("#btn-resume").on("click", function() {
        window.open("https://drive.google.com/file/d/14NsTJoRy_WW747Re5xIWhsiAIOKlYfHQ/view?usp=share_link", '_blank');
    })

    //add project items to project
    projectItems.forEach( (item, i) => {
        let ele = 
        `<div class="projects-item" id="project-${i+1}">
            <div class="project-image-container">
                <img src="${item.imgUrl}" alt="Image of ${item.name}">
                <div class="link-container">
                    <a href="${item.projectUrl}" target="_balnk" class="project-link"><p>Site</p></a>
                    <a href="${item.githubUrl}" target="_balnk" class="github-link"><p>Github</p></a>
                </div>
            </div>
            <div class="projects-text">
                <h3>${item.name}</h3>
            </div>
            <div class="project-stack">`
        item.stacks.forEach( stack => {
            ele = ele + `<p>${stack}</p>`
        })
        ele = ele + `</div></div>`
        $("#projects-container").append(ele)
    })

    //add Paginations to project
    const setupPaginations = () => {
        let itemPerPage = 1
        let width = $(window).width()
        if (width < 480) {
            itemPerPage = 1
        } else if ( width < 980) {
            itemPerPage = 6
        } else {
            itemPerPage = 6
        }
        let numberOfPages = Math.ceil(projectItems.length / itemPerPage);

        //function to select Page
        const selectPage = (page) => {
            //change page to active
            $("#projects-paginations").children().each(function () {
                $(this).removeClass("page-active")
            })
            $(`#page-${page}`).addClass("page-active")

            //show itemOnThePage only
            for (let i = 1; i <= projectItems.length; i++) {
                if (Math.ceil(i / itemPerPage) == page) {
                    $(`#project-${i}`).show()
                } else {
                    $(`#project-${i}`).hide()
                }
            }

            //Enable/disable arrow
            if (page == 1) {
                $("#first-page").addClass("page-disable")
                $("#last-page").removeClass("page-disable")
            } else if (page == numberOfPages) {
                $("#last-page").addClass("page-disable")
                $("#first-page").removeClass("page-disable")
            } else {
                $("#first-page").removeClass("page-disable")
                $("#last-page").removeClass("page-disable")
            }

            currentPage = page;
        }

        if (numberOfPages == 1) {
            selectPage(1)
            return;
        } 
        
        let pageEle = `<div id="projects-paginations"><p id="first-page">&laquo;</p>`

        for (let i = 1; i <= numberOfPages; i++){
            pageEle = pageEle + `<p id="page-${i}">${i}</p>`
        }
        pageEle = pageEle + `<p id="last-page">&raquo;</p></div>`
        $("#projects-container").append(pageEle)
    

        for (let i = 1; i <= numberOfPages; i++) {
            $(`#page-${i}`).on("click", function () {
                selectPage(i)
            })
        }
        $(`#first-page`).on("click", function () {
            if (currentPage !== 1) selectPage(currentPage - 1)
        })
        $(`#last-page`).on("click", function () {
            if (currentPage !== numberOfPages) selectPage(currentPage + 1)
        })
        selectPage(currentPage)
    }
    setupPaginations()

    //set interval to detect browser width change
    let currentWidth = $(window).width()
    setInterval(function(){
        let width = $(window).width()
        if (currentWidth == width) return
        $("#projects-paginations").remove()
        setupPaginations()
        currentWidth = width
    }, 1000)

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