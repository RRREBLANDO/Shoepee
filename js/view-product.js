const availableSize = document.querySelector(".available-sizes");
const sizes = document.querySelectorAll(".available-sizes span");

sizes.forEach(size => {
    size.addEventListener("click", () => {
        for (let index = 0; index < sizes.length; index++) {
            sizes[index].classList.remove("active");
        }
        size.classList.add("active");
    });
});

const addCartBtn = document.querySelector(".add-to-cart");
let obj = addCartBtn.getAttribute("data-ident");
const getObj = document.querySelector("."+obj);

if (obj === "not-login") {
    getObj.addEventListener("click", ()=>{
        window.location.href = "../main/login.php";
    });
} else{
    getObj.addEventListener("click", ()=>{
        const size = availableSize.querySelector(".active");
        const prodId = document.querySelector(".p_id").value;
        const popup = document.querySelector(".popup-message");
        const popupIcon = document.querySelector(".popup-icon");
        const popupBody = document.querySelector(".popup-body");
        if (size !== null) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../data/add-to-cart.php", true);
            xhr.onload = () =>{
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        if (data === "Product is been added to cart") {
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
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("product_id="+prodId+"&quantity=1&size="+size.innerHTML);
        } else{
            popupIcon.innerHTML = "<i class='bx bx-error-circle bx-tada' style='color:#ff4365' ></i>";
            popupBody.innerHTML = `<p style='color:#ff4365'>Error</p>
            <p>Please select your shoe size</p>`;
            popup.classList.add("show");
            setTimeout(()=>{
                popup.classList.remove("show");
            }, 2000);
        }
    });
}

