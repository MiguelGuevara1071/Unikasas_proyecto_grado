$(function(){
    // Ocultar las etiquetas span encargadas de mostrar el mensaje de error en el foemulario
    $("#nombreCotizante_error_message").hide();
    $("#apellidosCotizante_error_message").hide();
    $("#emailCotizante_error_message").hide();
    $("#telefonoCotizante_error_message").hide();
    $("#ciudadCotizante_error_message").hide();
    $("#productoCotizante_error_message").hide();
    $("#ubicacionCotizante_error_message").hide();
    $("#fechaCotizacion_error_message").hide();
    $("#comentariosCotizacion_error_message").hide();

    // variables de control para permitir el envio cuando este diligenciado el formulario en su totalidad
    let error_nombreCotizante = true,
        error_apellidosCotizante = true,
        error_emailCotizante = true,
        error_telefonoCotizante = true,
        error_ciudadCotizante = true,
        error_productoCotizante = true,
        error_ubicacionCotizante = true,
        error_fechaCotizacion = true;
        error_comentariosCotizacion = false;

    $("#nombreCotizante").focusout(function(){ // Funciones que se ejecutan cuando haya un focusout en el id del input del formulario de creación
        check_nombreCotizante();
        checkButton();
    });

    $("#apellidosCotizante").focusout(function(){
        check_apellidosCotizante();
        checkButton();
    });

    $("#emailCotizante").focusout(function(){
        check_emailCotizante();
        checkButton();
    });

    $("#telefonoCotizante").focusout(function(){
        check_telefonoCotizante();
        checkButton();
    });

    $("#ciudadCotizante").focusout(function(){
        check_ciudadCotizante();
        checkButton();
    });

    $("#productoCotizante").focusout(function(){
        check_productoCotizante();
        checkButton();
    });

    $("#ubicacionCotizante").focusout(function(){
        check_ubicacionCotizante();
        checkButton();
    });

    let fechaCotizacion = $("#fecha").val();
    if(fechaCotizacion != ''){
        check_fechaCotizacion();
        checkButton();
    }
    $("#fecha").focusout(function(){
        check_fechaCotizacion();
        checkButton();
    });

    // Funciones para validar los campos de cada input select o textarea
    function check_nombreCotizante(){
        let pattern = /^[a-zA-ZñáéíóúüÑÁÉÍÓÚ ]*$/;
        let nombreCotizante = $("#nombreCotizante").val();

        if(pattern.test(nombreCotizante) && nombreCotizante !== ''){
            $("#nombreCotizante_error_message").hide()
            $("#nombreCotizante").css("border", "2px solid green");
            error_nombreCotizante = false;
        } else {
            $("#nombreCotizante_error_message").html("El nombre solo puede contener letras")
            $("#nombreCotizante_error_message").show()
            $("#nombreCotizante").css("border", "2px solid red");
            error_nombreCotizante = true;
        }
    }

    function check_apellidosCotizante(){
        let pattern = /^[a-zA-ZñáéíóúüÑÁÉÍÓÚ ]*$/;
        let apellidosCotizante = $("#apellidosCotizante").val();

        if(pattern.test(apellidosCotizante) && apellidosCotizante !== ''){
            $("#apellidosCotizante_error_message").hide()
            $("#apellidosCotizante").css("border", "2px solid green");
            error_apellidosCotizante = false;
        } else {
            $("#apellidosCotizante_error_message").html("El apellido solo puede contener letras")
            $("#apellidosCotizante_error_message").show()
            $("#apellidosCotizante").css("border", "2px solid red");
            error_apellidosCotizante = true;
        }
    }

    function check_emailCotizante(){
        let pattern = /^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/;
        let emailCotizante = $("#emailCotizante").val();

        if(pattern.test(emailCotizante) && emailCotizante !== ''){
            $("#emailCotizante_error_message").hide()
            $("#emailCotizante").css("border", "2px solid green");
            error_emailCotizante = false;
        } else {
            $("#emailCotizante_error_message").html("El tipo de correo electronico ingresado no es correcto")
            $("#emailCotizante_error_message").show()
            $("#emailCotizante").css("border", "2px solid red");
            error_emailCotizante = true;
        }
    }

    function check_telefonoCotizante(){
        let pattern = /^[0-9]{10,10}$/;
        let telefonoCotizante = $("#telefonoCotizante").val();

        if(pattern.test(telefonoCotizante) && telefonoCotizante !== ''){
            $("#telefonoCotizante_error_message").hide()
            $("#telefonoCotizante").css("border", "2px solid green");
            error_telefonoCotizante = false;
        } else {
            $("#telefonoCotizante_error_message").html("El numero de telefono no es valido")
            $("#telefonoCotizante_error_message").show()
            $("#telefonoCotizante").css("border", "2px solid red");
            error_telefonoCotizante = true;
        }
    }

    function check_ciudadCotizante(){
        let ciudadCotizante= $("#ciudadCotizante").val();
        if (ciudadCotizante == null) {
            $("#ciudadCotizante_error_message").html("Seleccione una ciudad")
            $("#ciudadCotizante_error_message").show()
            $("#ciudadCotizante").css("border", "2px solid red");
            error_ciudadCotizante= true;
        } else {
            $("#ciudadCotizante_error_message").hide()
            $("#ciudadCotizante").css("border", "2px solid green");
            error_ciudadCotizante = false;
        }
    }

    function check_productoCotizante(){
        let productoCotizante = $("#productoCotizante").val();
        if (productoCotizante == null) {
            $("#productoCotizante_error_message").html("Seleccione el producto al cual petenece la cotización")
            $("#productoCotizante_error_message").show()
            $("#productoCotizante").css("border", "2px solid red");
            error_productoCotizante = true;
        } else {
            $("#productoCotizante_error_message").hide()
            $("#productoCotizante").css("border", "2px solid green");
            error_productoCotizante = false;
        }
    }

    function check_ubicacionCotizante(){
        let pattern = /^[a-zA-Z0-9\# \- ]*$/;
        let ubicacionCotizante = $("#ubicacionCotizante").val();

        if(pattern.test(ubicacionCotizante) && ubicacionCotizante !== ''){
            $("#ubicacionCotizante_error_message").hide()
            $("#ubicacionCotizante").css("border", "2px solid green");
            error_ubicacionCotizante = false;
        } else {
            $("#ubicacionCotizante_error_message").html("Ingrese su ubicación")
            $("#ubicacionCotizante_error_message").show()
            $("#ubicacionCotizante").css("border", "2px solid red");
            error_ubicacionCotizante = true;
        }
    }

    function check_fechaCotizacion(){
        let pattern = /^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
        let fechaCotizacion = $("#fecha").val();

        if(pattern.test(fechaCotizacion) && fechaCotizacion !== ''){
            $("#fechaCotizacion_error_message").hide()
            $("#fecha").css("border", "2px solid green");
            error_fechaCotizacion = false;
        } else {
            $("#fechaCotizacion_error_message").html("El formato de la fecha ingresada no es correcto")
            $("#fechaCotizacion_error_message").show()
            $("#fecha").css("border", "2px solid red");
            error_fechaCotizacion = true;
        }
    }

    // Funcion para habilitar el boton para enviar los datos una vez esten diligenciados correctamente
    function checkButton(){
        if(error_nombreCotizante == false && error_apellidosCotizante == false && error_emailCotizante == false && error_telefonoCotizante == false &&
            error_ciudadCotizante == false && error_productoCotizante == false && error_ubicacionCotizante == false && error_fechaCotizacion == false &&
             error_comentariosCotizacion == false){
            $("#submit").prop("disabled", false);
        }
    }

});
