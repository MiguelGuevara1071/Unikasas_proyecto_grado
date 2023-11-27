let aceptar=document.getElementById("aceptar");
let cancelar=document.getElementById("cancelar");
let abrir=document.getElementById("save");
let modalC=document.querySelector(".modal-container");
let segunda=document.querySelector(".segunda-modal");
let irse=document.getElementById("irse");
let confirmar=document.getElementById("confirmar")



confirmar.addEventListener("click",function(e){
    e.preventDefault();
    segunda.style.visibility="hidden";
})

irse.addEventListener("click",function(e){
    e.preventDefault();
    segunda.style.visibility="hidden";
})

abrir.addEventListener("click",function(e){
    e.preventDefault();
    modalC.style.visibility="visible";
});

aceptar.addEventListener("click",function(e){
    e.preventDefault();
    segunda.style.visibility="visible";
    modalC.style.visibility="hidden";
})


cancelar.addEventListener("click",function(e){
e.preventDefault();
modalC.style.visibility="hidden";
})



