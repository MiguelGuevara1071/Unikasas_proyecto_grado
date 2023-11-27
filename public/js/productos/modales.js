const publicarButton = document.querySelectorAll('#publicar-button');
const despublicarButton = document.querySelectorAll('#despublicar-button');
const modal = document.querySelectorAll('.modal');
const publicarContent = document.querySelector('.publicar');
const closeModal = document.querySelectorAll('.close');
const formPublicar = document.querySelector('#publicarForm');
const formDespublicar = document.querySelector('#despublicarForm');

for (let i = 0; i < publicarButton.length; i++) {
    publicarButton[i].addEventListener('click', () => {
        modal[0].classList.remove('hidden');
        modal[0].classList.add('visible');
        let id = publicarButton[i].getAttribute("value");
        formPublicar.setAttribute("action", `productos/${id}`);
    })
}

for (let i = 0; i < despublicarButton.length; i++) {
    despublicarButton[i].addEventListener('click', () => {
        modal[1].classList.remove('hidden');
        modal[1].classList.add('visible');
        let id = despublicarButton[i].getAttribute("value");
        formDespublicar.setAttribute("action", `productos/${id}`);
    })
}

for (let i = 0; i < closeModal.length; i++) {
    closeModal[i].addEventListener('click', () => {
        modal[0].classList.remove('visible');
        modal[0].classList.add('hidden');
        modal[1].classList.remove('visible');
        modal[1].classList.add('hidden');
    })
}


