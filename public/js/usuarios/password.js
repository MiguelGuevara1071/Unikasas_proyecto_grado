const modal = document.querySelector('.modal');
const close = document.querySelectorAll('.close');
const button = document.getElementById('button');

const paswword = document.getElementById('password-one');
const password2 = document.getElementById('password-two');

button.addEventListener('click', () => {
    console.log('click');
    modal.classList.remove('hidden');
    modal.classList.add('visible');
    }
);

function validatePassword() {
    if (paswword.value == password2.value && paswword.value != '') {
        close[0].style.display = 'block';
        console.log('ok')
    } else {
        close[0].style.display = 'none';
    }
}
