const form = document.querySelector('.welcome form');
const input = document.querySelector('.welcome form .serchValue');
const selectForm = document.querySelector('.welcome form select');
const btn = document.querySelector('.welcome form a');

form.addEventListener('submit',(e) => {
    e.preventDefault();
})

btn.addEventListener('click', () => {
    if (selectForm.value == '') {
        selectForm.style.borderColor = 'red';
    } else {
        const selectedOption = selectForm.value;
        if (selectedOption == 'jobs') {
            btn.href = `/jobs?keyword=${input.value}`
        } else if (selectedOption == 'freelancers') {
            btn.href = `/freelancers?keyword=${input.value}`
        } else {
            btn.href = `/${selectedOption}`
        }
    }
})