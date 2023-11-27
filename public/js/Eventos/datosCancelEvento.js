var fecha = new Date();
document.getElementById("eventDate").value = fecha.toJSON().slice(0,10);
hora = fecha.getHours();
minutos = fecha.getMinutes();
if(minutos <= 9){
    minutos = "0"+minutos
}

horario = hora+':'+minutos;
document.getElementById("eventTime").value = horario;
