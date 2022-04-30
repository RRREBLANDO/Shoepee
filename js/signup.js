const registerBtn = document.querySelector(".register-btn");
const popup = document.querySelector(".popup-message");
const form = document.querySelector("form");

form.onsubmit = (e) =>{
    e.preventDefault();
}

const popupIcon = document.querySelector(".popup-icon");
const popupBody = document.querySelector(".popup-body");

registerBtn.addEventListener("click", () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/register.php", true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "You are now successfully registered. You may login now to your account") {
                    clearField();
                    popupIcon.innerHTML = "<i class='bx bx-check-circle bx-tada'></i>";
                    popupBody.innerHTML = `<p>Success</p>
                    <p>${data}</p>`;
                    popup.classList.add("show");
                    setTimeout(()=>{
                        popup.classList.remove("show");
                    }, 2000);
                } else{
                    popupIcon.innerHTML = "<i class='bx bx-error-circle bx-tada' style='color:#ff4365' ></i>";
                    popupBody.innerHTML = `<p style='color:#ff4365'>Error</p>
                    <p>${data}</p>`;
                    popup.classList.add("show");
                    setTimeout(()=>{
                        popup.classList.remove("show");
                    }, 2000);
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
});

function clearField(){
    const inputs = document.querySelectorAll("input");
    inputs.forEach(input => {
        input.value = "";
    });
}