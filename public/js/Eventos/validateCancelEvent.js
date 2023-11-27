$(function(){
    $("#eventDate_error_message").hide();
    $("#eventTime_error_message").hide();
    $("eventReason_error_message").hide();

    let error_eventDate = true,
    error_eventTime = true,
    error_eventReason = true;

    let eventDate = $("#eventDate").val();
    if(eventDate != ''){
        check_eventDate();
        checkButton();
    }
    $("#eventDate").focusout(function(){
        check_eventDate();
        checkButton();
    });

    let eventTime = $("#eventTime").val(); 
    if(eventTime != ''){
        check_eventTime();
        checkButton();
    }
    $("#eventTime").focusout(function(){
        check_eventTime();
        checkButton();
    });

    let eventReason = $("#eventReason").val(); 
    if(eventReason != ''){
        check_eventReason();
        checkButton();
    }
    $("#eventReason").focusout(function(){
        check_eventReason();
        checkButton();
    });

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

    function check_eventTime(){
        let pattern = /^([0-1][0-9]|2[0-3]):([0-5][0-9])$/;
        let eventTime = $("#eventTime").val(); 

        if(pattern.test(eventTime) && eventTime !== ''){
            $("#eventTime_error_message").hide()
            $("#eventTime").css("border", "2px solid green");
            error_eventTime = false;
        } else {
            $("#eventTime_error_message").html("El formato de la hora ingresada no es correcto")
            $("#eventTime_error_message").show()
            $("#eventTime").css("border", "2px solid red");
            error_eventTime = true;
        }
    }

    function check_eventReason(){
        let pattern = /^[a-zA-ZñáéíóúüÑÁÉÍÓÚ0-9,. ]*$/;
        let eventReason = $("#eventReason").val();

        if(pattern.test(eventReason) && eventReason !== ''){
            $("#eventReason_error_message").hide()
            $("#eventReason").css("border", "2px solid green");
            error_eventReason = false;
        } else {
            $("#eventReason_error_message").html("Ingrese el motivo de la cancelacion del evento")
            $("#Ingrese el asunto del evento").show()
            $("#eventReason").css("border", "2px solid red");
            error_eventReason = true;
        }
    }

    function checkButton(){
        if(error_eventDate == false && error_eventTime == false && error_eventReason == false){
            $("#submit").prop("disabled", false);
        }
    }

});