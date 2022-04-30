const addCourierBtn = document.querySelector(".add-courier");
addCourierBtn.addEventListener("click", (e) =>{
    modalShow(e);
});

const closeBtns = document.querySelectorAll(".close-btn");
closeBtns.forEach(button => {
    button.addEventListener("click", () => {
        window.location.href = "../admin/users.php";
    });
});

const form = document.querySelector("#add-courier-modal .modal-form");
const submitBtn = document.querySelector("#add-courier-submit");

form.onsubmit = (e) =>{
    e.preventDefault();
}

const addErrMsg = document.querySelector("#add-courier-modal .err-msg");
const addSuccMsg = document.querySelector("#add-courier-modal .succ-msg");

submitBtn.addEventListener("click", () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/create-courier-account.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "Courier Account Successfully Created") {
                    clearField();
                    addSuccMsg.style.display = "block";
                    addSuccMsg.innerHTML = `<p><i class='bx bx-check-circle'></i> ${data}</p>`;
                    setTimeout(()=>{addSuccMsg.style.display = "none";}, 2000);
                } else{
                    addErrMsg.style.display = "block";
                    addErrMsg.innerHTML = `<p><i class="bx bx-error-circle"></i> ${data} </p>`;
                    setTimeout(()=>{addErrMsg.style.display = "none";}, 2000);
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
});

deleteUser();

const searchInput = document.querySelector(".user-search");
const userList = document.querySelector(".user-list");

searchInput.onkeyup = () => {
    filter(searchInput.value);
}

const userTypes = document.querySelectorAll(".role");
userTypes.forEach(userType => {
    userType.addEventListener("click", () =>{
        removeActive();
        userType.classList.add("active");
        let role = userType.innerHTML;
        filter(role);
    });
});

const all = document.querySelector(".all");
all.addEventListener("click", ()=>{
    removeActive();
    all.classList.add("active");
    filter("");
});

const confirmBtn = document.querySelector("#delete-user-dialog .confirm-btn");

confirmBtn.addEventListener("click", () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/delete-user.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200){
                let data = xhr.response;
                if (data === "User successfully deleted") {
                    popupIcon.innerHTML = "<i class='bx bx-check-circle bx-tada'></i>";
                    popupBody.innerHTML = `<p>Success</p>
                    <p>${data}</p>`;
                    popup.classList.add("show");
                    setTimeout(()=>{
                        popup.classList.remove("show");
                        window.location.href = "../admin/users.php";
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
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("user_id="+userId.value);
});

function deleteUser(){
    const deleteUserBtns = document.querySelectorAll(".delete-user");
    const userFnames = document.querySelectorAll(".user-fname");
    const userLnames = document.querySelectorAll(".user-lname");
    const userId = document.querySelector("#delete-user-dialog .user-id");
    const msg = document.querySelector("#delete-user-dialog .dialog-msg");

    for (let index = 0; index < deleteUserBtns.length; index++) {
        deleteUserBtns[index].addEventListener("click", () => {
            userId.value = deleteUserBtns[index].value;
            let firstname = userFnames[index].innerHTML;
            let lastname = userLnames[index].innerHTML;
            msg.innerHTML = `Do you want to delete the <b>${firstname} ${lastname}</b>'s account?`;
            let getObj = deleteUserBtns[index].getAttribute("data-target");
            const modal = document.querySelector("#"+getObj);
            modal.style.display ="block";
        });
    }
}

function removeActive(){
    for (let index = 0; index < userTypes.length; index++) {
        userTypes[index].classList.remove("active");
        all.classList.remove("active");
    }
}

function filter(filterData){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/user-search.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                userList.innerHTML = data;
                deleteUser();
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("search_string="+filterData);
}

function clearField(){
    const inputs = document.querySelectorAll("#add-courier-modal input");
    inputs.forEach(input => {
        input.value = "";
    });
}