// Get All FAQS
const quesions = document.querySelectorAll('.faq .question');

// Add Click Event
quesions.forEach(question => {
    question.addEventListener('click', () => {
        question.parentElement.lastElementChild.classList.toggle('open');
    })
})