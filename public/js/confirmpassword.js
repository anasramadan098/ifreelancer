const btn = document.querySelector('form button');
const form = document.querySelector('form');
const password = document.querySelector('form input[name="password"]');
const confirmPassword = document.querySelector('form input[name="confirm_password"]');

form.addEventListener('submit' , e => {
    e.preventDefault();
    if (password.value != '') {
        if (password.value.length >= 8) {
            password.style.borderColor = '';
            if (password.value != confirmPassword.value) {
                confirmPassword.style.borderColor = 'red';
            } else {
                confirmPassword.style.borderColor = '';
                form.submit();
            }
        } else {
            password.style.borderColor = 'red';
        }
    }
})