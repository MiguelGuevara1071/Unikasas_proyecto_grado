var fecha = new Date();
document.getElementById("eventDate").value = fecha.toJSON().slice(0,10);
hora = fecha.getHours();
minutos = fecha.getMinutes();
if(minutos <= 9){
    minutos = "0"+minutos
}

horario = hora+':'+minutos;
// console.log(horario);
document.getElementById("eventShedule1").value = horario;
