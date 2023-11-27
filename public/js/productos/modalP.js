let aceptar=document.getElementById("aceptar");
let cancelar=document.getElementById("cancelar");
let abrir=document.querySelectorAll(".bot1");
let modal=document.querySelector(".modal");
let modalC=document.querySelector(".modal-container");
let segunda=document.querySelector(".segunda-modal");
let irse=document.getElementById("irse");
let confirmar=document.getElementById("confirmar");
let carrito=document.querySelectorAll(".carShop");
let carritoM=document.querySelector(".containerOne")
let Daceptar=document.querySelector(".aceptar")
let Dcancelar=document.querySelector(".cancelar")

let Mtwo=document.querySelector(".containertwo")
let twoC=document.querySelector(".aceptartwo")
//let despublicar=document.querySelector("mCar");

for (let l = 0; l < abrir.length; l++) {
    abrir[l].addEventListener('click', () => {
        modalC.style.visibility="visible"
    })

}
for (let l = 0; l < carrito.length; l++) {
    carrito[l].addEventListener('click',function(){
        carritoM.style.visibility="visible"
    })

}
Daceptar.addEventListener('click',function(){
    Mtwo.style.visibility="visible";
})

twoC.addEventListener('click',function(){
    Mtwo.style.visibility="hidden";
    carritoM.style.visibility="hidden";
})

Dcancelar.addEventListener('click',function(){
    carritoM.style.visibility="hidden";
})





cancelar.addEventListener('click',function(){

    modalC.style.visibility="hidden";

 })



confirmar.addEventListener("click",function(){

    segunda.style.visibility="hidden";
})

irse.addEventListener("click",function(){

    segunda.style.visibility="hidden";
})

// abrir.addEventListener("click",function(e){
//     e.preventDefault();
//     modalC.style.visibility="visible";
// });

aceptar.addEventListener("click",function(){

    segunda.style.visibility="visible";
    modalC.style.visibility="hidden";
})










