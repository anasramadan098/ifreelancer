

// Select Element
const allSelectedElements = document.querySelectorAll('select');
allSelectedElements.forEach((element) => {

        //  Get User Value
        const selectedValue = element.dataset.value;
        Array.from(element.options).forEach(option => {
            if (option.value === selectedValue) {
                option.selected = true;
            }
        })
});


// Radio
document.querySelectorAll('input[type="radio"]').forEach(radio => {
    const selectedValue = document.querySelector('.radio-data').dataset.value;
    if (radio.value.toLowerCase() === selectedValue) {
        radio.checked = true;
    }
})