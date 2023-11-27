$(function(){
    // Ocultar las etiquetas span encargadas de mostrar el mensaje de error en el foemulario
    $("#estadoCotizacion_error_message").hide();
    $("#respuestaCotizacion_error_message").hide();

    // variables de control para permitir el envio cuando este diligenciado el formulario en su totalidad
    let error_estadoCotizacion = true,
        error_respuestaCotizacion = true;

    let estadoCotizacion = $("#estadoCotizacion").val();
    if(estadoCotizacion != ''){
        check_estadoCotizacion();
        checkButton();
    }
    $("#estadoCotizacion").focusout(function(){
        check_estadoCotizacion();
        checkButton();
    });

    $("#respuestaCotizacion").focusout(function(){
        check_respuestaCotizacion();
        checkButton();
    });

    // Funciones para validar los campos de cada input select o textarea

    function check_estadoCotizacion(){
        let estadoCotizacion = $("#estadoCotizacion").val();
        if (estadoCotizacion == null) {
            $("estadoCotizacion_error_message").html("Seleccione el producto al cual petenece la cotización")
            $("estadoCotizacion_error_message").show()
            $("#estadoCotizacion").css("border", "2px solid red");
            error_estadoCotizacion = true;
        } else {
            $("estadoCotizacion_error_message").hide()
            $("#estadoCotizacion").css("border", "2px solid green");
            error_estadoCotizacion = false;
        }
    }

    function check_respuestaCotizacion(){
        let pattern = /^[a-zA-ZñáéíóúüÑÁÉÍÓÚ ]*$/;
        let respuestaCotizacion = $("#respuestaCotizacion").val();

        if(pattern.test(respuestaCotizacion) && respuestaCotizacion !== ''){
            $("#respuestaCotizacion_error_message").hide()
            $("#respuestaCotizacion").css("border", "2px solid green");
            error_respuestaCotizacion = false;
        } else {
            $("#respuestaCotizacion_error_message").html("Ingrese la respuesta de la cotización para el cliente")
            $("#respuestaCotizacion_error_message").show()
            $("#respuestaCotizacion").css("border", "2px solid red");
            error_respuestaCotizacion = true;
        }
    }


    // Funcion para habilitar el boton para enviar los datos una vez esten diligenciados correctamente
    function checkButton(){
        if( error_estadoCotizacion == false && error_respuestaCotizacion == false){
            $("#submit").prop("disabled", false);
        }
    }

});
