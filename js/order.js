statusIndicator();

const orderedItemsBtns = document.querySelectorAll(".ordered-items");

orderedItemsBtns.forEach(orderedItemsBtn =>{
    orderedItemsBtn.addEventListener("click", () =>{
        let getObj = orderedItemsBtn.getAttribute("data-target");
        const modal = document.querySelector("#"+getObj);
        modal.style.display ="block";
        showPurchaseItems(orderedItemsBtn.value);
    });
})

const closeBtns = document.querySelectorAll(".close-btn");

closeBtns.forEach(closeBtn =>{
    closeBtn.addEventListener("click", () =>{
        window.location.href = "../admin/orders.php";
    });
});

const itemList = document.querySelector(".item-list");

function showPurchaseItems(purchaseVal){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/get-purchase-items.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                itemList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("order_id="+purchaseVal);
}

const all = document.querySelector(".all");
const statusTypes = document.querySelectorAll(".orders-status");
const orderList = document.querySelector(".order-list");

statusTypes.forEach(statusType => {
    statusType.addEventListener("click", () =>{
        removeActive();
        statusType.classList.add("active");
        let status = statusType.innerHTML;
        filter(status);
    });
});

if(all !== null){
    all.addEventListener("click", ()=>{
        removeActive();
        all.classList.add("active");
        filter("");
    });
}

const orderSearchbar = document.querySelector(".order-searchbar");

if(orderSearchbar !== null){
    orderSearchbar.onkeyup = () =>{
        filter(orderSearchbar.value);
    }
}

function statusIndicator(){
    const orderStatuses = document.querySelectorAll(".order-status");

    orderStatuses.forEach(orderStatus =>{
        if(orderStatus.innerHTML === "Pending"){
            orderStatus.style.background = "#FCA311";
        } else if(orderStatus.innerHTML === "To Ship" || orderStatus.innerHTML === "To Receive"){
            orderStatus.style.background = "#FFC914";
        } else if(orderStatus.innerHTML === "Delivered"){
            orderStatus.style.background = "#18A999";
        } else{
            orderStatus.style.background = "#FF4365";
        }
    });
}

function removeActive(){
    for (let index = 0; index < statusTypes.length; index++) {
        statusTypes[index].classList.remove("active");
        all.classList.remove("active");
    }
}

function filter(filterData){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/order-search.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                orderList.innerHTML = data;
                statusIndicator();
                deleteOperation();
                updateOperation();
                addDeliveryDetails();
                viewDeliveryDetails();
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("search_string="+filterData);
}

deleteOperation();

function deleteOperation(){
    const deleteOrderBtns = document.querySelectorAll(".ordered-delete");
    const orderIdInput = document.querySelector(".order-id");

    deleteOrderBtns.forEach(deleteOrderBtn => {
        deleteOrderBtn.addEventListener("click", () =>{
            let getObj = deleteOrderBtn.getAttribute("data-target");
            const modal = document.querySelector("#"+getObj);
            modal.style.display ="block";
            orderIdInput.value = deleteOrderBtn.value;
        });
    });

    const confirmBtn = document.querySelector("#delete-order-dialog .confirm-btn");

    confirmBtn.addEventListener("click", () =>{
        deleteOrder(orderIdInput.value);
    });
}

function deleteOrder(orderId){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/delete-order.php", true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "Order successfully deleted") {
                    popupIcon.innerHTML = "<i class='bx bx-check-circle bx-tada'></i>";
                    popupBody.innerHTML = `<p>Success</p>
                    <p>${data}</p>`;
                    popup.classList.add("show");
                    setTimeout(()=>{
                        popup.classList.remove("show");
                        window.location.href = "../admin/orders.php";
                    }, 2000);
                } else{
                    popupIcon.innerHTML = "<i class='bx bx-error-circle bx-tada' style='color:#ff4365' ></i>";
                    popupBody.innerHTML = `<p style='color:#ff4365'>Error</p>
                    <p>${data}</p>`;
                    popup.classList.add("show");
                    setTimeout(()=>{
                        popup.classList.remove("show");
                        window.location.href = "../admin/orders.php";
                    }, 2000);
                }
                
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("order_id="+orderId);
}

const orderForm = document.querySelector("#update-order-modal form");

orderForm.onsubmit = (e) =>{
    e.preventDefault();
}

updateOperation();

function updateOperation(){
    const orderStatuses = document.querySelectorAll(".order-status");
    const updateOrderBtns = document.querySelectorAll(".ordered-update");
    const statusDropdown = document.querySelector("#update-order-modal select");
    const orderId = document.querySelector("#update-order-modal input");

    if(updateOrderBtns.length > 0){
        for (let index = 0; index < orderStatuses.length; index++) {
            updateOrderBtns[index].addEventListener("click", () => {
                statusDropdown.value = orderStatuses[index].textContent;
                orderId.value = updateOrderBtns[index].value;
                let getObj = updateOrderBtns[index].getAttribute("data-target");
                const modal = document.querySelector("#"+getObj);
                modal.style.display ="block";
            });
        }
    }
    

    const submitBtn = document.querySelector("#update-order-modal .submit-btn");
    submitBtn.addEventListener("click", () =>{
        updateStatus();
    });
}

function updateStatus(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/update-order-status.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "Order status successfully updated") {
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
    let formData = new FormData(orderForm);
    xhr.send(formData);
}

const deliveryForm = document.querySelector("#delivery-details-modal form");

deliveryForm.onsubmit = (e) =>{
    e.preventDefault();
}

addDeliveryDetails();

function addDeliveryDetails(){
    const deliveryBtns = document.querySelectorAll(".delivery-details");
    const orderId = document.querySelector("#delivery-details-modal .order-id-input");
    deliveryBtns.forEach(deliveryBtn =>{
        deliveryBtn.addEventListener("click", () =>{
            let getObj = deliveryBtn.getAttribute("data-target");
            const modal = document.querySelector("#"+getObj);
            modal.style.display ="block";
            orderId.value = deliveryBtn.value;
        });
    });

    const submitBtn = document.querySelector("#delivery-details-modal .submit-btn");
    submitBtn.addEventListener("click", () => {
        deliveryDetailsOperation();
    });
}

function deliveryDetailsOperation(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/set-delivery-details.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "Delivery details successfully set") {
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
    let formData = new FormData(deliveryForm);
    xhr.send(formData);
}

function clearDeliveryForm(){
    const orderId = document.querySelector("#delivery-details-modal .order-id-input");
    const courier = document.querySelector("#delivery-details-modal .courier");
    orderId.value = "";
    courier.value = "";
}

viewDeliveryDetails();

function viewDeliveryDetails(){
    const viewDeliveryBtns = document.querySelectorAll(".view-delivery-details");
    viewDeliveryBtns.forEach(viewDeliveryBtn => {
        viewDeliveryBtn.addEventListener("click", () =>{
            let getObj = viewDeliveryBtn.getAttribute("data-target");
            const modal = document.querySelector("#"+getObj);
            modal.style.display ="block";
            getDeliveryDetails(viewDeliveryBtn.value);
        });
    });
}

const delivery = document.querySelector(".delivery");

function getDeliveryDetails(orderId){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/get-courier-details.php", true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if (xhr.status === 200) {
                let data = xhr.response;
                delivery.innerHTML = data
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("order_id="+orderId);
}

showReceipt();

function showReceipt(){
    const orderReceiptBtns = document.querySelectorAll(".ordered-receipt");
    orderReceiptBtns.forEach(orderReceiptBtn => {
        orderReceiptBtn.addEventListener("click", () => {
            let getObj = orderReceiptBtn.getAttribute("data-target");
            const modal = document.querySelector("#"+getObj);
            modal.style.display ="block";
            showReceiptDetails(orderReceiptBtn.value);
        });
    });
}

function showReceiptDetails(receiptDet){
    const itemList = document.querySelector("#receipt-modal .item-list");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/get-receipt-details.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                itemList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("order_id="+receiptDet);
}



