const modal = document.querySelectorAll('.modal')
const finish = document.querySelector('.finish')
const cancel = document.querySelector('.cancel')

finish.addEventListener('click', () => {
    modal[1].classList.remove('hidden')
    modal[1].classList.add('visible')
})

cancel.addEventListener('click', () => {
    modal[1].classList.remove('visible')
    modal[1].classList.add('hidden')
})