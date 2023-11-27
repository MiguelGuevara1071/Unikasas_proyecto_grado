const createActivity = document.querySelectorAll('.add')
const suspenderProject = document.querySelector('.SuspenderProject')
const finishProject = document.querySelector('.FinishProject')
const activateProject = document.querySelector('.activate')
const modal = document.querySelectorAll('.modal')
const iconClose = document.querySelectorAll('.save')
const saveButton = document.querySelectorAll('.save')
const viewSuspension = document.querySelector('.suspension')

for (let l = 0; l < saveButton.length; l++) {
    saveButton[l].addEventListener('click', () => {
        for (let t = 0; t < modal.length; t++) {
            modal[t].classList.remove('visible')
            modal[t].classList.add('hidden')
        }
    })

}

for (let y = 0; y < createActivity.length; y++) {
    createActivity[y].addEventListener('click', () =>{
        console.log("Abrir modal crear actividad")
        modal[1].classList.remove('hidden')
        modal[1].classList.add('visible')
        document.querySelector('#etapaId').value = createActivity[y].getAttribute("value");
    })
}

suspenderProject.addEventListener('click', () => {
    modal[0].classList.remove('hidden')
    modal[0].classList.add('visible')
})

finishProject.addEventListener('click', () => {
    modal[2].classList.remove('hidden')
    modal[2].classList.add('visible')
})

viewSuspension.addEventListener('click', () =>{
    modal[3].classList.remove('hidden')
    modal[3].classList.add('visible')
})

for (let x = 0; x < modal.length; x++){
    for (let j = 0; j < iconClose.length; j++) {
        iconClose[j].addEventListener('click', () => {
            modal[x].classList.remove('visible')
            modal[x].classList.add('hidden')
        })
    }
}

activateProject.addEventListener('click', () =>{
    modal[4].classList.remove('hidden')
    modal[4].classList.add('visible')
})




