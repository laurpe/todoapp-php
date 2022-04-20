const editButtons = document.querySelectorAll(".editBtn");
const editForms = document.querySelectorAll(".edit-form");
console.log(editForms);
editButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
        editForms.forEach((form) => {
            form.classList.remove("active");
        });
        e.currentTarget.nextElementSibling.classList.add("active");
    });
});
