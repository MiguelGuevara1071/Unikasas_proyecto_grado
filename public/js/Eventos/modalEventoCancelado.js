let abrir = document.querySelectorAll("#cancelar");
let modal = document.querySelector(".modalEvento");
let cerrar = document.querySelector(".aceptar");
let cerrarIcono = document.querySelector(".iconoCerrar");

for (let y = 0; y < abrir.length; y++) {
    abrir[y].addEventListener('click', () =>{
        // console.log("Abrir modal evento cancelado")
        modal.classList.remove('hidden')
        modal.classList.add('visible')
    })
}

cerrar.addEventListener('click', () => {
        // console.log("Cerrar modal evento cancelado")
        modal.classList.remove('visible')
        modal.classList.add('hidden')
})

cerrarIcono.addEventListener('click', () => {
    // console.log("Cerrar modal evento cancelado con icono")
    modal.classList.remove('visible')
    modal.classList.add('hidden')
})
