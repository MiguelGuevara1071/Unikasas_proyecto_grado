const modalLayout = document.querySelectorAll('.modalLayout')
const logout = document.querySelector('.logout')
const notifications = document.querySelector('.notifications')
const calendar = document.querySelector('.calendar')
const help = document.querySelector('.help')

let statusModal = false;
function calcModal(status, n)
{
    closeModals(status)
    if (status === false) {
        showModal(n)
        statusModal = true;
    } else if (status === true) {
        hideModal(n)
        statusModal = false;
    }

    return status;

    function closeModals(status) {
        if (status == true) {
            for (let x = 0; x < modalLayout.length; x++) {
                hideModal(x)
            }
        }
    }

    function hideModal(n) {
        modalLayout[n].classList.remove('visibleLayout')
        modalLayout[n].classList.add('hidden')
    }

    function showModal(n) {
        modalLayout[n].classList.remove('hidden')
        modalLayout[n].classList.add('visibleLayout')
    }
}

logout.addEventListener('click', () => {
    calcModal(statusModal, 0)
})

notifications.addEventListener('click', () => {
    calcModal(statusModal, 1)
})

calendar.addEventListener('click', () => {
    calcModal(statusModal, 2)
})

help.addEventListener('click', () => {
    calcModal(statusModal, 3)
})
