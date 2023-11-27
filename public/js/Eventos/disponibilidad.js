let contenido = $('#text').val();
let contador = 1;
if(contador == 1){
    agregarFecha(); 
    $("#form").submit();
    contador = 'Hola';
}

function agregarFecha(){
    let fecha = new Date();
    dia = fecha.getDate(); //dia mes actual
    mes = fecha.getMonth(); //mes actual
    annio = fecha.getFullYear(); //año actual

    if(dia < 10){
        dia = '0'+dia;
    }
    if(mes < 10){
        mes = '0'+mes;
    }
    fecha = mes+'/'+dia+'/'+annio;
    $('#text').val(fecha);
    console.log(fecha);
}

$(function () {
    $("#datepicker").datepicker({
        firstDay: 1,
        monthNames: ['Enero','Febrero','Marzo','Abil','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        onSelect: function (date) {
            $('#text').val(date);
            $("#form").submit();
        }
    });

})