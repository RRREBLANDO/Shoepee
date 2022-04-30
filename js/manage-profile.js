const updateProfBtn = document.querySelector(".updateprof-btn");
const changePassBtn = document.querySelector(".changepass-btn");
const inputs = document.querySelectorAll("input");
const actionContainer = document.querySelector(".profile-actions");
const profileContainer = document.querySelector(".profile-input");
const formRowContainer = document.querySelector(".form-row");
const profileForm = document.querySelector("form");
const popup = document.querySelector(".popup-message");
const popupIcon = document.querySelector(".popup-icon");
const popupBody = document.querySelector(".popup-body");

profileForm.onsubmit = (e) => {
    e.preventDefault();
}

updateProfBtn.addEventListener("click", () => {
    undisable();
    actionContainer.innerHTML = '<div class="form-action-btn"><button type="submit" class="btn btn-sm update-btn">Update</button>  <button type="submit" class="btn btn-sm close-btn" style="background:#FF4365">Close</button></div>';
    goBack();
    updateProfile();
});

changePassBtn.addEventListener("click", () => {
    profileContainer.style.display = "none";
    formRowContainer.style.gridTemplateColumns = "1fr";
    formRowContainer.style.padding = "0 5rem";
    formRowContainer.innerHTML = '<div class="form-col"><div class="form-group"><label class="form-label">Old Password</label><input type="password" class="form-control" name="old_password" required></div><div class="form-group mt-3"><label class="form-label">New Password</label><input type="password" class="form-control" name="new_password" required></div><div class="form-group mt-3"><label class="form-label">Confirm Password</label><input type="password" class="form-control" name="confirm_password" required></div></div>';
    actionContainer.innerHTML = '<div class="form-action-btn"><button type="submit" class="btn btn-sm change-btn">Submit</button>  <button type="submit" class="btn btn-sm close-btn" style="background:#FF4365">Close</button></div>';
    goBack();
    changePassword();
});

function goBack(){
    const closeBtn = document.querySelector(".close-btn");
    closeBtn.addEventListener("click", () => {
        window.location.href = "../main/manageProfile.php";
    });
}

function changePassword(){
    const submitBtn = document.querySelector(".change-btn");
    submitBtn.addEventListener("click", () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../data/change-pass.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "Password successfully changed") {
                        popupIcon.innerHTML = "<i class='bx bx-check-circle bx-tada'></i>";
                        popupBody.innerHTML = `<p>Success</p>
                        <p>${data}</p>`;
                        popup.classList.add("show");
                        setTimeout(()=>{
                            popup.classList.remove("show");
                            window.location.href = "../main/manageProfile.php";
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
        let formData = new FormData(profileForm);
        xhr.send(formData);
    });
}

function updateProfile(){
    const updateBtn = document.querySelector(".update-btn");
    updateBtn.addEventListener("click", () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../data/update-profile.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "Profile Successfully Updated" || data === "Profile picture successfully updated") {
                        popupIcon.innerHTML = "<i class='bx bx-check-circle bx-tada'></i>";
                        popupBody.innerHTML = `<p>Success</p>
                        <p>${data}</p>`;
                        popup.classList.add("show");
                        setTimeout(()=>{
                            popup.classList.remove("show");
                            window.location.href = "../main/manageProfile.php";
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
        let formData = new FormData(profileForm);
        xhr.send(formData);
    });
}

function undisable(){
    inputs.forEach(input => {
        input.disabled = false;
    });
}