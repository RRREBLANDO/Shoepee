const productBtn = document.querySelector(".add-product");
const submitBtn = document.querySelector("#add-product");
const closeBtns = document.querySelectorAll(".close-btn");

productBtn.addEventListener("click", (e) => {
    modalShow(e);
});

closeBtns.forEach(button => {
    button.addEventListener("click", () => {
        window.location.href = "../admin/products.php";
    });
});

const form = document.querySelector("#add-product-modal .modal-form");
const addErrMsg = document.querySelector("#add-product-modal .err-msg");
const addSuccMsg = document.querySelector("#add-product-modal .succ-msg");


form.onsubmit = (e) => {
    e.preventDefault();
}

submitBtn.addEventListener("click", () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/insert-product.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "Success") {
                    clearField();
                    addSuccMsg.style.display = "block";
                    addSuccMsg.innerHTML = "<p><i class='bx bx-check-circle'></i> Product successfully added</p>";
                    setTimeout(() => {addSuccMsg.style.display = "none"}, 2000);
                } else{
                    addErrMsg.style.display = "block";
                    addErrMsg.innerHTML = `<p><i class="bx bx-error-circle"></i> ${data}</p>`;
                    setTimeout(() => {addErrMsg.style.display = "none"}, 2000);
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
})

updateProduct();

const updateSubmitBtn = document.querySelector("#update-product-modal #update-product");
const updateForm = document.querySelector("#update-product-modal .modal-form");

updateForm.onsubmit = (e) =>{
    e.preventDefault();
}

const updateErrMsg = document.querySelector("#update-product-modal .err-msg");
const updateSuccMsg = document.querySelector("#update-product-modal .succ-msg");

updateSubmitBtn.addEventListener("click", ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/update-product-details.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "Product Successfully Updated" || data === "Product Details and Image Successfully Updated") {
                    updateSuccMsg.style.display = "block";
                    updateSuccMsg.innerHTML = `<p><i class='bx bx-check-circle'></i> ${data} </p>`;
                    setTimeout(()=>{updateSuccMsg.style.display = "none"}, 2000);
                } else{
                    updateErrMsg.style.display = "block";
                    updateErrMsg.innerHTML = `<p><i class="bx bx-error-circle"></i> ${data} </p>`;
                    setTimeout(()=>{updateErrMsg.style.display = "none"}, 2000);
                }
            }
        }
    }
    let formData = new FormData(updateForm);
    xhr.send(formData);
});

deleteProduct();

function confirmDeletion(id){
    const confirmBtn = document.querySelector("#delete-product-dialog .confirm-btn");
    confirmBtn.addEventListener("click", () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../data/delete-product.php", true);
        xhr.onload = () =>{
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "Product Deleted Successfully") {
                        window.location.href = "../admin/products.php";
                    } else{
                        console.log(data);
                    }
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("product_id="+id);
    });
}

const productContainer = document.querySelector(".product-list");
const searchBtn = document.querySelector(".search-btn");
const searchInput = document.querySelector(".search-input");

searchInput.onkeyup = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/search-product.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                productContainer.innerHTML = data;

                updateProduct();
                deleteProduct();
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("search_string="+searchInput.value);
}

function updateProduct(){
    const updateProdBtns = document.querySelectorAll(".product-update");
    const productId = document.querySelector("#update-product-modal .product-id-input");
    const productName = document.querySelector("#update-product-modal .product-name-input");
    const productPrice = document.querySelector("#update-product-modal .product-price-input");
    const productBrand = document.querySelector("#update-product-modal #brands-select");

    updateProdBtns.forEach(updateProdBtn => {
        updateProdBtn.addEventListener("click", () =>{
            let obj = updateProdBtn.getAttribute("data-target");
            const modal = document.querySelector("#"+obj);
            modal.style.display = "block";
            let prodId = updateProdBtn.value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../data/get-product-details.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        if(data !== "No record found"){
                            let dataObj = JSON.parse(data);
                            productId.value = dataObj.ID;
                            productName.value = dataObj.PRODUCT_NAME;
                            productPrice.value = dataObj.PRICE;
                            productBrand.value = dataObj.BRAND_ID;
                        } else{
                            updateErrMsg.style.display = "block";
                            updateErrMsg.innerHTML = `<p><i class="bx bx-error-circle"></i> ${data} </p>`
                            setTimeout(()=>{updateErrMsg.style.display = "none"}, 2000);
                        }
                    }
                }
            }
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("product_id="+prodId);
        });
    });
}

function deleteProduct(){
    const deleteProdBtns = document.querySelectorAll("#product-delete");
    const deleteProdDialog = document.querySelector("#delete-product-dialog");
    const deleteProdDialogMsg = document.querySelector("#delete-product-dialog .dialog-msg");

    deleteProdBtns.forEach(deleteProdBtn => {
        deleteProdBtn.addEventListener("click", () =>{
            let prodId = deleteProdBtn.value;
            let prodName = deleteProdBtn.getAttribute("data-name");
            deleteProdDialogMsg.innerHTML = `Do you want to delete the <b>${prodName}</b>?`;
            let obj = deleteProdBtn.getAttribute("data-target");
            const dialog = document.querySelector("#"+obj);
            dialog.style.display = "block";
            confirmDeletion(prodId);
        });
    });
}

function clearField(){
    const nameInput = document.querySelector("#add-product-modal .product-name-input");
    const priceInput = document.querySelector("#add-product-modal .product-price-input");
    const keyInput = document.querySelector("#add-product-modal .product-searchkey-input");
    const brandSelect = document.querySelector("#add-product-modal #brands-select");
    const fileInput = document.querySelector("#add-product-modal #product-file-input");

    nameInput.value = "";
    priceInput.value = "";
    keyInput.value = "";
    brandSelect.value = "";
    fileInput.value = "";
}
