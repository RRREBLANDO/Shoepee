const generateBtn = document.querySelector(".generate-report");
generateBtn.addEventListener("click", () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/generate-report.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "Report is been generated") {
                    popupIcon.innerHTML = "<i class='bx bx-check-circle bx-tada'></i>";
                    popupBody.innerHTML = `<p>Success</p>
                    <p>${data}</p>`;
                    popup.classList.add("show");
                    setTimeout(()=>{
                        popup.classList.remove("show");
                        window.location.href = "../admin/reports.php";
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
    xhr.send();
});

const closeBtns = document.querySelectorAll(".close-btn");
closeBtns.forEach(closeBtn => {
    closeBtn.addEventListener("click", () => {
        window.location.href = "../admin/reports.php";
    });
});

const reportDetailsBtns = document.querySelectorAll(".report-details");
const reportDialog = document.querySelector(".report-dialog");
const dialog = document.querySelector(".report-dialog")
reportDetailsBtns.forEach(reportDetailsBtn => {
    reportDetailsBtn.addEventListener("click", () => {
        getReportDetails(reportDetailsBtn.value);
        dialog.classList.remove("hide");
        dialog.classList.add("show");
    });
});

const betweenBtn = document.querySelector(".specific-report");
const reportDropdown = document.querySelector(".report-dropdown");
betweenBtn.addEventListener("click", () => {
    reportDropdown.classList.add("show");
});

const submitBtn = document.querySelector(".generate-specific-btn");
submitBtn.addEventListener("click", () => {
    generateSpecificReport();
    dialog.classList.remove("hide");
    dialog.classList.add("show");
});

const reportClose = document.querySelector(".dropdown-close-btn");
const formInputs = document.querySelectorAll(".report-dropdown form input");
reportClose.addEventListener("click", () => {
    reportDropdown.classList.remove("show");
    formInputs.forEach(formInput, () =>{
        formInput.value = "";
    })
});

function closeReport(){
    const closeReportBtn = document.querySelector(".report-close-btn");
    closeReportBtn.addEventListener("click", () => {
        dialog.classList.remove("show");
        dialog.classList.add("hide");
    });
}

function printReport(){
    const printBtn = document.querySelector(".report-print-btn");
    const reportDetails = document.querySelector(".report-dialog").innerHTML;
    printBtn.addEventListener("click", () => {
        window.print();
    });
}

const form = document.querySelector(".report-dropdown form");
form.onsubmit = (e) => {
    e.preventDefault();
}

function generateSpecificReport(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/specific-date-report.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                reportDialog.innerHTML = data;
                closeReport();
                printReport();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

function getReportDetails(reportDate){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/get-report-details.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                reportDialog.innerHTML = data;
                closeReport();
                printReport();
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("date="+reportDate);
}