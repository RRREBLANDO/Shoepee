const currentLocation = location.href;
const links = document.querySelectorAll(".nav-link");

links.forEach(link => {
    if (link.href  === currentLocation) {
        link.classList.add("active");
    }
});


const profile = document.querySelector(".user-profile");

profile.addEventListener("click", () =>{
    profile.classList.toggle("show");
});

function modalShow(e){
    let getObj = e.target.getAttribute("data-target");
    const modal = document.querySelector("#"+getObj);
    modal.style.display ="block";
}

const popup = document.querySelector(".popup-message");
const popupIcon = document.querySelector(".popup-icon");
const popupBody = document.querySelector(".popup-body");
