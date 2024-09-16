const readMoreBtn = document.querySelector('.info .text a');
const readMoreText = document.querySelector('.info .text > p');
const theFullContent = readMoreText.textContent;
const length = 400;
readMoreText.textContent = readMoreText.textContent.slice(0,length);

if (readMoreBtn !== null) {
    readMoreBtn.addEventListener('click',() => {
        if (readMoreBtn.textContent != 'Less') {
            readMoreText.textContent = theFullContent;
            readMoreBtn.textContent = "Less";
        } else {
            readMoreText.textContent = readMoreText.textContent.slice(0,length);
            readMoreBtn.textContent = "Read More";
        }
    })
}