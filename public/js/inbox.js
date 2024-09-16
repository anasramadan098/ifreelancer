// Filter Box P
const allBoxesP = document.querySelectorAll('.box p');
const myLength = 70;
allBoxesP.forEach(p => {
    if (p.textContent.length > myLength) {
        p.textContent = p.textContent.slice(0, myLength) + '...';
    }
})

// Set Active Class
const allBoxes = document.querySelectorAll('.btns .btn');
allBoxes.forEach(btn => {
    btn.addEventListener('click', () => {
        allBoxes.forEach(btn => btn.classList.remove('active'));
        btn.classList.add('active');

        // Handle Butons
        const boxes = document.querySelectorAll('.box')
        if (btn.classList.contains('unreadedBtn')) {
            if (document.querySelectorAll('.number-of-msgs').length == 0) {
                boxes.forEach(box => box.style.display = 'none');
                if (document.querySelector('.msgs .select') == null) {
                    const p = document.createElement('p');
                    p.className = 'select';
                    p.textContent = 'All Chats Have Readed '  
                    document.querySelector('.msgs').appendChild(p);  
                }
            } else {
                document.querySelectorAll('.number-of-msgs').forEach(numberMsg => {
                    numberMsg.parentElement.style.display = 'flex';
                })
            }
        } else {
            boxes.forEach(box => box.style.display = 'flex');
            if (document.querySelector('.msgs .select') != null) {
                document.querySelector('.msgs .select').remove();
            }
        }

    })
})
document.querySelector('.unreadedBtn').addEventListener('click' , () => {


})


console.log();