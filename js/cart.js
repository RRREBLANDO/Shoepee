const cartIds = document.querySelectorAll(".cart-id");
const quantityInputs = document.querySelectorAll(".item-quantity");
const minusBtns = document.querySelectorAll(".quantity-minus");
const addBtns = document.querySelectorAll(".quantity-add");

for (let i = 0; i < quantityInputs.length; i++) {
    let cart_id = cartIds[i];
    let quantity = quantityInputs[i];
    let minus = minusBtns[i];
    let add = addBtns[i];
    let count = 1;

    minus.addEventListener("click", () =>{
        count = count -  1;
        displayQuantity(count, quantity);
        updateCartItem(cart_id.getAttribute("data-value"), quantity.innerHTML);
    });

    add.addEventListener("click", () =>{
        count = count + 1;
        displayQuantity(count, quantity);
        updateCartItem(cart_id.getAttribute("data-value"), quantity.innerHTML);
    });
}

const cartAmount = document.querySelector(".cart-summary-amount");

setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/get-realtime-cart-summary.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                cartAmount.innerHTML = `${data}`;
            }
        }
    }
    xhr.send();
}, 500);

const checkoutBtn = document.querySelector(".checkout-btn");

checkoutBtn.addEventListener("click", () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/checkout-orders.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if(data === ""){
                    popupIcon.innerHTML = "<i class='bx bx-check-circle bx-tada'></i>";
                    popupBody.innerHTML = `<p>Success</p>
                    <p>Your order has been place. We are now processing your order</p>`;
                    popup.classList.add("show");
                    setTimeout(()=>{
                        popup.classList.remove("show");
                        window.location.href = "../main/viewCart.php";
                    }, 2000);
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("total_amount="+parseFloat(cartAmount.innerHTML));
});

function updateCartItem(cart_id, quantity) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/update-items.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("cart_id="+cart_id+"&quantity="+quantity);
}

function displayQuantity(count, quantity){
    if (count < 0) {
        quantity.innerHTML = "0";
    } else{
        quantity.innerHTML = count;
    }
}

