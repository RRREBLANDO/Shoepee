const addPriceBtn = document.querySelector(".add-price");
addPriceBtn.addEventListener("click", (e) =>{
    modalShow(e);
});

const closeBtns = document.querySelectorAll(".close-btn");
closeBtns.forEach(closeBtn => {
    closeBtn.addEventListener("click", () =>{
        window.location.href = "../admin/price-change.php";
    });
});

const form = document.querySelector("#add-price-modal .modal-form");

form.onsubmit = (e) => {
    e.preventDefault();
}

const submitBtn = document.querySelector("#add-price-modal .submit-btn");
const addErrMsg = document.querySelector("#add-price-modal .err-msg");
const addSuccMsg = document.querySelector("#add-price-modal .succ-msg");

submitBtn.addEventListener("click", () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/insert-price.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "Price Successfully Added") {
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

function clearField(){
    const productSelect = document.querySelector("#add-price-modal .product-select");
    const amountInput = document.querySelector("#add-price-modal .amount-input");
    const startEff = document.querySelector("#add-price-modal .start-eff-input");
    const endEff = document.querySelector("#add-price-modal .end-eff-input");

    productSelect.value = "";
    amountInput.value = "";
    startEff.value = "";
    endEff.value = "";
}