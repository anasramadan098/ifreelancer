// Range 
const priceRange = document.querySelector('input.priceRange');
const minInput = document.querySelector('.prices input.min')
const maxInput = document.querySelector('.prices input.max')

priceRange.addEventListener('input',() => {
    // Max Span
    document.querySelector('label .max').textContent = priceRange.value;
    // Max Input
    maxInput.value = priceRange.value;
})
minInput.addEventListener('input',() => {
    document.querySelector('label .min').textContent = minInput.value;
})
maxInput.addEventListener('input',() => {
    document.querySelector('label .max').textContent = maxInput.value;
})