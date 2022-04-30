//Most used
const customModal = document.querySelector(".custom-modal");
const closeBtns = document.querySelectorAll(".close-btn");

//add-brand-modal
const brandBtn = document.querySelector(".add-brand");
const brandModal = document.querySelector("#brand-modal");

brandBtn.addEventListener("click", ()=>{
  brandModal.style.display ="block";
});

closeBtns.forEach((closeBtn) => {
  closeBtn.addEventListener("click", ()=>{
    window.location.href = "../admin/brands.php";
  });
});

const statusLbls = document.querySelectorAll(".status-label");

statusLbls.forEach((statusLbl) => {
  if (statusLbl.innerText === "UNAVAILABLE") {
    statusLbl.style.color = "#EC4067";
  } else{
    statusLbl.style.color = "#18A999";
  }
});


const form = document.querySelector("#brand-modal .custom-modal-body form");
const submitBtn = document.querySelector("#add-brand-submit");
const addErrMsg = document.querySelector("#brand-modal .err-msg");
const addSuccMsg = document.querySelector("#brand-modal .succ-msg");

form.onsubmit = (e) =>{
  e.preventDefault();
}

submitBtn.addEventListener("click", () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../data/insert-brand.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
            let data = xhr.response;
            if(data === "Success"){
              clearField();
              addSuccMsg.style.display = "block";
              addSuccMsg.innerHTML = `<p><i class='bx bx-check-circle'></i> ${data}</p>`;
              setTimeout(()=>{addSuccMsg.style.display = "none";}, 2000);
            }else{
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


//update brand objects
const updateBrandBtns = document.querySelectorAll("#brand-update");
const updateBrandModal = document.querySelector("#update-brand-modal");
const updateBrandForm = document.querySelector("#update-brand-modal .custom-modal-body form");
const updateInputId = document.querySelector("#update-brand-id");
const updateInputName = document.querySelector("#update-brand-name");
const updateSelect = document.querySelector("#update-brand-modal form select");
const updateBrandSubmit = document.querySelector("#update-brand-submit");
const updateErrMsg = document.querySelector("#update-brand-modal .err-msg");
const updateSuccMsg = document.querySelector("#update-brand-modal .succ-msg");


//Preventing Defaults
updateBrandForm.onsubmit = (e) => {
  e.preventDefault();
}

//Get brand details
updateBrandBtns.forEach((updateBrandBtn) => {
  updateBrandBtn.addEventListener("click", () =>{
    updateBrandModal.style.display = "block";
    let id = updateBrandBtn.value;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/get-brand-details.php", true);
    xhr.onload = () => {
      if(xhr.readyState === XMLHttpRequest.DONE){
        if (xhr.status === 200) {
          let data = xhr.response;
          let parseData = JSON.parse(data);
          updateInputId.value = parseData.ID;
          updateInputName.value = parseData.BRAND_NAME;
          updateSelect.value = parseData.STATUS;
        }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("BRAND_ID="+id);
  });
});


//update brand status
updateBrandSubmit.addEventListener("click", () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../data/update-brand-status.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
       if (xhr.status === 200) {
         let data = xhr.response;
         if (data === "Brand Successfully Updated") {
            updateSuccMsg.style.display = "block";
            updateSuccMsg.innerHTML = `<p><i class='bx bx-check-circle'></i> ${data}</p>`;
            setTimeout(()=>{updateSuccMsg.style.display = "none";}, 2000);
         } else {
            updateErrMsg.style.display = "block";
            updateErrMsg.innerHTML = `<p><i class="bx bx-error-circle"></i> ${data} </p>`;
            setTimeout(() => {updateErrMsg.style.display = "none";}, 2000);
         }
       }
    }
  }
  let updatedBrandForm = new FormData(updateBrandForm);
  xhr.send(updatedBrandForm);
});


//delete brand dialog
const deleteBrandBtns = document.querySelectorAll("#brand-delete");
const deleteDialog = document.querySelector("#delete-brand-dialog");
const deleteId = document.querySelector(".delete-id");

deleteBrandBtns.forEach((deleteBrandBtn) => {
  deleteBrandBtn.addEventListener("click", () => {
    let brandId = deleteBrandBtn.value;
    deleteId.value = brandId;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/get-brand-name.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            let data = xhr.response;
            let parseData = JSON.parse(data);
            const dialogMsg = document.querySelector(".dialog-msg");
            dialogMsg.innerHTML = `Do you want to delete the <b>${parseData.BRAND_NAME}</b> Brand?`;
            deleteDialog.style.display = "block";
        }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("brand_id="+brandId);
  });
});

const confirmBtn = document.querySelector(".confirm-btn");

confirmBtn.addEventListener("click", () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../data/delete-brand.php", true);
  xhr.onload = ()=>{
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data === "Deleted") {
          window.location.href = "../admin/brands.php";
        }
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("brand_id="+deleteId.value);
});

function clearField(){
  const name = document.querySelector("#brand-modal .brand-name-input");
  const status = document.querySelector("#brand-modal .brand-status");
  const logo = document.querySelector("#brand-modal #brand-logo");

  name.value = "";
  status.value = "";
  logo.value = "";
}