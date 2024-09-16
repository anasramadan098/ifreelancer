// Add Scrolled Class
window.addEventListener('scroll',() => {
    if (scrollY >= 28) {
        document.querySelector('header').classList.add('scrolled');
    } else {
        document.querySelector('header').classList.remove('scrolled');
    }
})

const overlay = document.querySelector('.overlay');
const joinDiv = document.querySelector('.join');
const closeBtn = document.querySelector('.join .close');
const logDiv = document.querySelector('.log');
const closeLogBtn = document.querySelector('.log .close');

closeBtn.addEventListener('click',() => {
    overlay.classList.remove('active');
    document.body.style.overflow = 'auto';
    joinDiv.classList.remove('active');
})

function showJoinDiv() {
    closeLogBtn.click();
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    joinDiv.classList.add('active');
}
closeLogBtn.addEventListener('click',() => {
    overlay.classList.remove('active');
    document.body.style.overflow = 'auto';
    logDiv.classList.remove('active');
})

function showLogDiv() {
    closeBtn.click();
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    logDiv.classList.add('active');
}

const alertsDiv = document.querySelector('.join .alerts');

document.querySelector('.signInShowBtn').addEventListener('click' , () => {
    showLogDiv();
})

document.querySelector('.signUpShowBtn').addEventListener('click' , () => {
    showJoinDiv();
})

// document.querySelectorAll('.join a').forEach(a => {
//     document.querySelector('.join form button').addEventListener('click',() => {
//         document.querySelector('.step-1').style.display = 'flex';
//     })
//     if (a.classList.contains('next')) {
//         a.addEventListener('click' , () => {
//             // Hide The Last Step
//             document.querySelector(`.step-1`).style.display = 'none';

//             // Active The Steps
//             steps[2].classList.remove('active');

//             // Show The Next Step
//             document.querySelector(`.step-2`).style.display = 'flex';

//             alertsDiv.innerHTML = '';
//         })
//     } else {
//         a.addEventListener('click' , () => {
//             // Hide The Last Step
//             document.querySelector(`.step-2`).style.display = 'none';

//             // Active The Steps
//             steps[2].classList.remove('active');

//             // Show The Next Step
//             document.querySelector(`.step-1`).style.display = 'flex';
//             alertsDiv.innerHTML = '';
//         })
//     }
// })

function createAlertFrom(text) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert';
    alertDiv.textContent = text;
    alertsDiv.appendChild(alertDiv);
}


// Get The Burger Menu
const burgerMenu = document.querySelector('div.burger');

// Toggle The Menu

burgerMenu.addEventListener('click', (e) => {
    burgerMenu.classList.toggle('active');
    document.querySelector('header .my_links').classList.toggle('active');
})



// notificationBtn
document.querySelector('.notificationBtn').addEventListener('click' , () => {
    document.querySelector('.all-notification').classList.toggle('active');
})