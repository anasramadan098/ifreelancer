const selectedSkillsUl = document.querySelector('.selected-skills');
const sklillsInput = document.querySelector('input[name="skills"]');
const searchInput = document.querySelector('.skillsSearch');
let isPer = selectedSkillsUl.classList.contains('no-per');
// Search On Skills
function FilterAndCreateOf(elements,searchTerm) {


    if (searchTerm.length > 0) {
        elements.forEach(element => {
            if (element.textContent.toLowerCase().includes(searchTerm.toLowerCase())) {
                element.style.display = 'block';
            } else {
                    element.style.display = 'none';
            }
        });
    } else {
        elements.forEach(element => {
            element.style.display = 'block';
        });
    }
}

// Apply Function On Input
searchInput.addEventListener('input', () => {
    FilterAndCreateOf(Array.from(document.querySelectorAll('.all-skills li')),searchInput.value)
} )


// Create Lis From Zero
document.querySelectorAll('.all-skills li').forEach(element => {
    // Add Click Event
    element.addEventListener('click', () => {

        let historyOfElement = element;

        createLisFrom(element,60,historyOfElement)
        
        // Remove Element
        element.remove();
    });
})

// Crete Lis From Pervious Data
let data; 
if (!isPer) {
    date = JSON.parse(JSON.parse(sklillsInput.value));
    if(data){
        data.forEach(o => createLisFrom(o.name,o.percentage))
    }
}



function createLisFrom(element,per = 60,historyOfElement = null) {

    per = Number(String(per).replace('%',''));

    // Create Li
    const li = document.createElement('li');

    let value;

    const p = document.createElement('p');
    if (element.textContent) {
        p.textContent = element.textContent;
    } else {
        p.textContent = element;
    }
    
    const icon =  document.createElement('i');
    icon.className = 'fa-solid fa-x close';




    
    
    // Append Li and Icon And Range
    li.appendChild(p);
    li.appendChild(icon);

    // Perecentage input
    if (!isPer) {

        // Create
        const percentageInput = document.createElement('input');
        percentageInput.type = 'range';
        percentageInput.min = 0;
        percentageInput.max = 100;
        percentageInput.value = per;
        
        percentageInput.className = 'percentage';

        const spanValue = document.createElement('span');
        spanValue.textContent = percentageInput.value + '%';
    


        // Event
        percentageInput.addEventListener('input',() => {
            spanValue.textContent = percentageInput.value + '%';
    
            value = Array.from(selectedSkillsUl.children).flatMap(li => {
                return { "name" : li.firstElementChild.textContent, "percentage" : li.lastElementChild.textContent}
            });
    
            sklillsInput.value = JSON.stringify(value);
    
        })

        // Append
        li.appendChild(percentageInput);
        li.appendChild(spanValue);
    }


    selectedSkillsUl.appendChild(li);

    value = Array.from(selectedSkillsUl.children).flatMap(li => {
        return { "name" : li.firstElementChild.textContent, "percentage" : li.lastElementChild.textContent}
    });
    
    // Add It To Input
    document.querySelector('input[name="skills"]').value = JSON.stringify(value);
    
    // Remove Click Event
    icon.addEventListener('click', () => {
        li.remove();
        if (historyOfElement != null) {
            document.querySelector('.all-skills').appendChild(historyOfElement);
        }
    });
}

function checkIfElementFound(element) {
    document.querySelectorAll('.all-skills li').forEach(skill => {
        if (skill.textContent == element) {
            skill.remove();
        }
    })
}