$(function(){
    // Ocultar las etiquetas span encargadas de mostrar el mensaje de error en el foemulario
    $("#eventName_error_message").hide();
    $("#eventDate_error_message").hide();
    $("#eventShedule1_error_message").hide();
    $("#eventShedule2_error_message").hide();
    $("#eventProyect_error_message").hide();
    $("#eventNotification_error_message").hide();
    $("#eventAsisstant_error_message").hide();
    $("#eventPlace_error_message").hide();
    $("#eventBusiness_error_message").hide();
    $("#eventMenssage_error_message").hide();

    // variables de control para permitir el envio cuando este diligenciado el formulario en su totalidad
    let error_eventName = true, 
    error_eventDate = true,
    error_eventShedule1 = true,
    error_eventShedule2 = true,
    error_eventProyect = true,
    error_eventNotification = true,
    error_eventAsisstant = true,
    error_eventPlace = true,
    error_eventBusiness = true,
    error_eventMessage = false;

    let eventName = $("#eventName").val();
    if(eventName != ''){    // Funciones que se ejecutan cuando ya existe contenido en el id del input del formulario para las modificaciones
        check_eventName();  
        checkButton();
    } 
    $("#eventName").focusout(function(){ // Funciones que se ejecutan cuando haya un focusout en el id del input del formulario de creación
        check_eventName();
        checkButton();
    });
    
    let eventDate = $("#eventDate").val();
    if(eventDate != ''){
        check_eventDate();
        checkButton();
    } 
    $("#eventDate").focusout(function(){
        check_eventDate();
        checkButton();
    });
    
    let eventShedule1 = $("#eventShedule1").val(); 
    if(eventShedule1 != ''){
        check_eventShedule1();
        checkButton();
    } 
    $("#eventShedule1").focusout(function(){
        check_eventShedule1();
        checkButton();
    });
    
    let eventShedule2 = $("#eventShedule2").val();
    if(eventShedule2 != ''){
        check_eventShedule2();
        checkButton();
    }
    $("#eventShedule2").focusout(function(){
        check_eventShedule2();
        checkButton();
    });
    
    let eventProyect = $("#eventProyect").val();
    if(eventProyect != ''){
        check_eventProyect();
        checkButton();
    } 
    $("#eventProyect").focusout(function(){
        check_eventProyect();
        checkButton();
    });
    
    let eventNotification = $("#eventNotification").val();
    if(eventNotification != ''){
        check_eventNotification();
        checkButton();
    }
    $("#eventNotification").focusout(function(){
        check_eventNotification();
        checkButton();
    });

    let eventAsisstant = $("#eventAsisstant").val();
    if(eventAsisstant != ''){
        check_eventAsisstant();
        checkButton();
    }
    $("#eventAsisstant").focusout(function(){
        check_eventAsisstant();
        checkButton();
    });

    let eventPlace = $("#eventPlace").val();
    if(eventPlace != ''){
        check_eventPlace();
        checkButton();
    }
    $("#eventPlace").focusout(function(){
        check_eventPlace();
        checkButton();
    });

    let eventBusiness = $("#eventBusiness").val();
    if(eventBusiness != ''){
        check_eventBusiness();
        checkButton();
    }
    $("#eventBusiness").focusout(function(){
        check_eventBusiness();
        checkButton();
    });

    // Funciones para validar los campos de cada input select o textarea
    function check_eventName(){
        let pattern = /^[a-zA-ZñáéíóúüÑÁÉÍÓÚ ]*$/;
        let eventName = $("#eventName").val();
        
        if(pattern.test(eventName) && eventName !== ''){
            $("#eventName_error_message").hide()
            $("#eventName").css("border", "2px solid green");
            error_eventName = false;
        } else {
            $("#eventName_error_message").html("El nombre del evento solo puede contener letras")
            $("#eventName_error_message").show()
            $("#eventName").css("border", "2px solid red");
            error_eventName = true;
        }
    }

    function check_eventDate(){
        let pattern = /^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
        let eventDate = $("#eventDate").val();

        if(pattern.test(eventDate) && eventDate !== ''){
            $("#eventDate_error_message").hide()
            $("#eventDate").css("border", "2px solid green");
            error_eventDate = false;
        } else {
            $("#eventDate_error_message").html("El formato de la fecha ingresada no es correcto")
            $("#eventDate_error_message").show()
            $("#eventDate").css("border", "2px solid red");
            error_eventDate = true;
        }
    }

    function check_eventShedule1(){
        let pattern = /^([0-1][0-9]|2[0-3]):([0-5][0-9])$/;
        let eventShedule1 = $("#eventShedule1").val(); 

        if(pattern.test(eventShedule1) && eventShedule1 !== ''){
            $("#eventShedule1_error_message").hide()
            $("#eventShedule1").css("border", "2px solid green");
            error_eventShedule1 = false;
        } else {
            $("#eventShedule1_error_message").html("El formato de la hora ingresada no es correcto")
            $("#eventShedule1_error_message").show()
            $("#eventShedule1").css("border", "2px solid red");
            error_eventShedule1 = true;
        }
    }

    function check_eventShedule2(){
        let pattern = /^([0-1][0-9]|2[0-3]):([0-5][0-9])$/;
        let eventShedule2 = $("#eventShedule2").val();
        let eventShedule1 = $("#eventShedule1").val();
        // verificar que la hora final del evento sea mayor que la inicial
        let timeOne = eventShedule1.split(":");
        let timeTwo = eventShedule2.split(":");
        let tHoraOne = Number(timeOne[0]),
        tMinuteOne = Number(timeOne[1]),
        tHoraTwo = Number(timeTwo[0]),
        tMinutetwo = Number(timeTwo[1]);

        if(tHoraOne >= tHoraTwo && tMinuteOne > tMinutetwo){
            $("#eventShedule2_error_message").html("La fecha final debe ser mayor a la inicial")
            $("#eventShedule2_error_message").show()
            $("#eventShedule2").css("border", "2px solid red");
            error_eventShedule2 = true;
        }else if(pattern.test(eventShedule2) && eventShedule2 !== ''){
            $("#eventShedule2_error_message").hide()
            $("#eventShedule2").css("border", "2px solid green");
            error_eventShedule2 = false;
        } else {
            $("#eventShedule2_error_message").html("El formato de la hora ingresada no es correcto")
            $("#eventShedule2_error_message").show()
            $("#eventShedule2").css("border", "2px solid red");
            error_eventShedule2 = true;
        }
    }

    function check_eventProyect(){
        let eventProyect = $("#eventProyect").val();
        if (eventProyect == null) {
            $("#eventProyect_error_message").html("Seleccione un proyecto al cual petenece el evento")
            $("#eventProyect_error_message").show()
            $("#eventProyect").css("border", "2px solid red");
            error_eventProyect = true;
        } else {
            $("#eventProyect_error_message").hide()
            $("#eventProyect").css("border", "2px solid green");
            error_eventProyect = false;
        }
    }

    function check_eventNotification(){
        let eventNotification = $("#eventNotification").val();
        if (eventNotification == null) {
            $("#eventNotification_error_message").html("Seleccione una notificación para el evento")
            $("#eventNotification_error_message").show()
            $("#eventNotification").css("border", "2px solid red");
            error_eventNotification = true;
        } else {
            $("#eventNotification_error_message").hide()
            $("#eventNotification").css("border", "2px solid green");
            error_eventNotification = false;
        }
    }

    function check_eventAsisstant(){
        let pattern = /^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})|\,\ {1,}$/;
        let eventAsisstant = $("#eventAsisstant").val();
        
        if(pattern.test(eventAsisstant) && eventAsisstant !== ''){
            $("#eventAsisstant_error_message").hide()
            $("#eventAsisstant").css("border", "2px solid green");
            error_eventAsisstant = false;
        } else {
            $("#eventAsisstant_error_message").html("El tipo de correo electronico ingresado no es correcto")
            $("#eventAsisstant_error_message").show()
            $("#eventAsisstant").css("border", "2px solid red");
            error_eventAsisstant = true;
        }
    }

    function check_eventPlace(){
        let pattern = /^[a-zA-Z0-9\# \- ]*$/;
        let eventPlace = $("#eventPlace").val();

        if(pattern.test(eventPlace) && eventPlace !== ''){
            $("#eventPlace_error_message").hide()
            $("#eventPlace").css("border", "2px solid green");
            error_eventPlace = false;
        } else {
            $("#eventPlace_error_message").html("Ingrese el lugar donde se desarrollara el evento")
            $("#eventPlace_error_message").show()
            $("#eventPlace").css("border", "2px solid red");
            error_eventPlace = true;
        }
    }

    function check_eventBusiness(){
        let pattern = /^[a-zA-ZZñáéíóúüÑÁÉÍÓÚ0-9 ]*$/;
        let eventBusiness = $("#eventBusiness").val();

        if(pattern.test(eventBusiness) && eventBusiness !== ''){
            $("#eventBusiness_error_message").hide();
            $("#eventBusiness").css("border", "2px solid green");
            error_eventBusiness = false;
        } else {
            $("#eventBusiness_error_message").html("Ingrese el asunto del evento")
            $("#eventBusiness_error_message").show()
            $("#eventBusiness").css("border", "2px solid red");
            error_eventBusiness = true;
        }
    }

    // Funcion para habilitar el boton para enviar los datos una vez esten diligenciados correctamente
    function checkButton(){
        if(error_eventName == false && error_eventDate == false && error_eventShedule1 == false &&
            error_eventShedule2 == false && error_eventProyect == false && error_eventNotification == false &&
            error_eventAsisstant == false && error_eventPlace == false && error_eventBusiness == false &&
            error_eventMessage == false){
            $("#submit").prop("disabled", false);
        }
    }

});