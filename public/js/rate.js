// document.querySelector('header').classList.add('scrolled');

const stars = document.querySelectorAll('.stars .star')

stars.forEach(star => {
    star.addEventListener('click' , () => {
        const starNumber = star.textContent;
        stars.forEach((s , i) => {
            if (i < starNumber - 1) s.classList.add('fill')
            else s.classList.remove('fill')
        })
        star.classList.toggle('fill')
        // Add In Hidden Input
        document.querySelector('input[name="stars"]').value = starNumber;
    })
})

setTimeout(() => {
    document.querySelector('header').classList.add('scrolled');
}, 1500);