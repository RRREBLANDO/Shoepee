const brands = document.querySelectorAll(".filterby-brands a");
const currentLoc = location.href;

brands.forEach(brand => {
    if (brand.href === currentLoc) {
        brand.classList.add("active");
    }
});

const searchBar = document.querySelector(".product-search");
const productList = document.querySelector(".product-list");

searchBar.onkeyup = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/main-product-search.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                productList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("search_str="+searchBar.value);
}