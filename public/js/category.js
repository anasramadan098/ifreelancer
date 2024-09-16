// Hide And Show
const filtersBtn = document.querySelectorAll('.filter h3 i')
filtersBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        btn.parentElement.parentElement.lastElementChild.hidden = !btn.parentElement.parentElement.lastElementChild.hidden;
        btn.classList.toggle('active');
        btn.classList.toggle('active');
        btn.parentElement.classList.toggle('active')
    })
})


// Count The Selected Checkboxes
const allcheckBoxes = document.querySelectorAll('.inputs input[type="checkbox"]');

allcheckBoxes.forEach(checkBox => {

    checkBox.addEventListener('input',() => {
        const span = checkBox.parentElement.parentElement.parentElement.firstElementChild.firstElementChild.firstElementChild.firstElementChild;    
        span.innerHTML = 0;
        document.querySelectorAll(`input[name="${checkBox.name}"]`).forEach(e => {
            if (e.checked) {
                span.innerHTML++;
            }
        })
    })

})







// Filter The Input On Categories
document.querySelectorAll('.searchInput').forEach(input => {
    input.addEventListener('input',() => {
        Array.from(input.parentElement.parentElement.lastElementChild.children).forEach(e => e.style.display = 'none')
        // Get The Value 
        const searchTerm = input.value.toLowerCase();

        // Choose The Correct Input

        // Categories
        if (input.name == 'search-category') {
            FilterAndCreateOf(Array.from(document.querySelectorAll('.category-result .input label')),searchTerm);
        } else if (input.name == 'search-skills') {
            FilterAndCreateOf(Array.from(document.querySelectorAll('.skills-result .input label')),searchTerm); 
        } else if (input.name == 'search-specialization') {
            FilterAndCreateOf(Array.from(document.querySelectorAll('.specialization-result .input label')),searchTerm); 
        } else if (input.name == 'search-industrial') {
            FilterAndCreateOf(Array.from(document.querySelectorAll('.industrial-result .input label')),searchTerm); 
        }
    })
})


document.querySelectorAll('.category-result input , .skills-result input').forEach(input => {
    // Event
    input.addEventListener('input',() => {
        const span = input.parentElement.parentElement.parentElement.parentElement.firstElementChild.firstElementChild.firstElementChild.firstElementChild;
        span.innerHTML = 0;
        document.querySelectorAll(`input[name="${input.name}"]`).forEach(e => {
            if (e.checked) {
                span.innerHTML++;
            }
        })
    })
}) 


// Create Function To Create Div
function createCheckBoxAbout(categorie,location,name) {
        // Create Div
        const div = document.createElement('div');
        div.className = 'input'
        // Create Input
        const input = document.createElement('input');
        input.type = 'checkbox';
        input.id = categorie;
        input.value = categorie;

        input.name = name


        // Event
        input.addEventListener('input',() => {
            const span = input.parentElement.parentElement.parentElement.parentElement.firstElementChild.firstElementChild.firstElementChild.firstElementChild;
            span.innerHTML = 0;
            document.querySelectorAll(`input[name="${input.name}"]`).forEach(e => {
                if (e.checked) {
                    span.innerHTML++;
                }
            })
        })

        // Create Label
        const label = document.createElement('label');
        label.setAttribute('for',categorie);
        label.textContent = categorie;

        // Append Input And Label To Div
        div.appendChild(input);
        div.appendChild(label);

        // Append Div To Inputs
        location.appendChild(div);
}


function FilterAndCreateOf(elements,searchTerm) {
    // Filter the categories array based on the search term
    const filteredCategories = elements.filter(element => {
        // Check if the category name includes the search term
        return element.textContent.toLowerCase().includes(searchTerm);
    });
    // Loop On Categories
    filteredCategories.forEach(element => element.parentElement.style.display = 'flex');
}
