const addFaqBtn = document.querySelector(".add-faq");

addFaqBtn.addEventListener("click", (e) =>{
    modalShow(e);
});

const closeBtns = document.querySelectorAll(".close-btn");

closeBtns.forEach(button => {
    button.addEventListener("click", () =>{
        window.location.href = "../admin/faq.php";
    });
});

const form = document.querySelector("#add-faq-modal .modal-form");

form.onsubmit = (e) =>{
    e.preventDefault();
}

const submitFaq = document.querySelector("#faq-submit");
const addErrMsg = document.querySelector("#add-faq-modal .err-msg");
const addSuccMsg = document.querySelector("#add-faq-modal .succ-msg");

submitFaq.addEventListener("click", () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/insert-faq.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "FAQ Successfully Added") {
                    clearField();
                    addSuccMsg.style.display = "block";
                    addSuccMsg.innerHTML = `<p><i class="bx bx-check-circle"></i> ${data}</p>`;
                    setTimeout(()=>{addSuccMsg.style.display = "none"}, 2000);
                } else{
                    addErrMsg.style.display = "block";
                    addErrMsg.innerHTML = `<p><i class="bx bx-error-circle"></i> ${data}</p>`;
                    setTimeout(()=>{addErrMsg.style.display = "none"}, 2000);
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
});

const updateFaqBtns = document.querySelectorAll(".update-faq");
const faqQuestions = document.querySelectorAll(".faq-question");
const faqAnswers = document.querySelectorAll(".faq-answer");
const faqIdInput = document.querySelector(".faq-id-input");
const faqQuestionInput = document.querySelector("#update-faq-modal .question-input");
const faqAnswerInput = document.querySelector("#update-faq-modal .answer-input");

// updateFaqBtns.forEach(updateFaqBtn => {
//     updateFaqBtn.addEventListener("click", () => {
//         let getObj = updateFaqBtn.getAttribute("data-target");
//         const modal = document.querySelector("#"+getObj);
//         modal.style.display ="block";
//     });
// });

for (let index = 0; index < updateFaqBtns.length; index++) {
    const updateFaqBtn = updateFaqBtns[index];
    const faqQuestion = faqQuestions[index].innerHTML;
    const faqAnswer = faqAnswers[index].innerHTML;
    updateFaqBtn.addEventListener("click", () =>{
        faqIdInput.value = updateFaqBtn.value;
        faqQuestionInput.value = faqQuestion;
        faqAnswerInput.value = faqAnswer;
        let getObj = updateFaqBtn.getAttribute("data-target");
        const modal = document.querySelector("#"+getObj);
        modal.style.display ="block";
    })
}

const updateForm = document.querySelector("#update-faq-modal .modal-form");

updateForm.onsubmit = (e) =>{
    e.preventDefault();
}

const faqUpdateBtn = document.querySelector("#faq-update");
const updateErrMsg = document.querySelector("#update-faq-modal .err-msg");
const updateSuccMsg = document.querySelector("#update-faq-modal .succ-msg");

faqUpdateBtn.addEventListener("click", () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../data/update-faq.php", true);
    xhr.onload = () =>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "FAQ Successfully Updated") {
                    updateSuccMsg.style.display = "block";
                    updateSuccMsg.innerHTML = `<p><i class="bx bx-check-circle"></i> ${data}</p>`;
                    setTimeout(()=>{updateSuccMsg.style.display = "none"}, 2000);
                } else{
                    updateErrMsg.style.display = "block";
                    updateErrMsg.innerHTML = `<p><i class="bx bx-error-circle"></i> ${data}</p>`;
                    setTimeout(()=>{updateErrMsg.style.display = "none"}, 2000);
                }
            }
        }
    }
    let formData = new FormData(updateForm);
    xhr.send(formData);
});

const deleteFaqBtns = document.querySelectorAll(".delete-faq");
const faqId = document.querySelector("#delete-faq-dialog .delete-id");

deleteFaqBtns.forEach(deleteFaqBtn => {
    deleteFaqBtn.addEventListener("click", () =>{
        faqId.value = deleteFaqBtn.value;
        let getObj = deleteFaqBtn.getAttribute("data-target");
        const modal = document.querySelector("#"+getObj);
        modal.style.display ="block";
    }); 
});

const confirmBtn = document.querySelector("#delete-faq-dialog .confirm-btn");

confirmBtn.addEventListener("click", ()=>{
    let xhr = new XMLHttpRequest();
        xhr.open("POST", "../data/delete-faq.php", true);
        xhr.onload = () =>{
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "FAQ Successfully Deleted") {
                        window.location.href = "../admin/faq.php";
                    }
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("faq_id="+faqId.value);
});

function clearField(){
    const questionInput = document.querySelector("#add-faq-modal .question-input");
    const answerInput = document.querySelector("#add-faq-modal .answer-input");

    questionInput.value = "";
    answerInput.value = "";
}