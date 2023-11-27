/*
    Archivo que se encarga de validar los campos del formulario despues de que el usuario haya perdido el foco
    en un campo.
    Para que puedan realizar esto en sus formularios deben añadir este script en el <head></head> del HTML: <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    Ademas, tienen que vincular el archivo .js que contiene las funciones para validar, aconsejo que lo vinculen al final del <body></body>

    Algunas validaciones requieren expresiones regulares para evitar ataques de SQL Injection. Si requieren alguna expresión regular busquenla en google que
    siempre hay alguna que nos sirve.


*/

$(
    function() {

        $("#projectName_error_message").hide();     // Esta linea es para esconder la etiqueta <span></span> que contiene
        $("#projectDirector_error_message").hide(); // el mensaje a mostar en caso de que un campo tenga un error
        $("#projectCost_error_message").hide();
        $("#projectCity_error_message").hide();
        $("#projectAddress_error_message").hide();
        $("#projectDate_error_message").hide();
        $("#projectProduct_error_message").hide();
        $("#projectClient_error_message").hide();


        // Estas variables que inicializo en true es para al final poder validar si el formulario está llenado correctamente
        // Es necesario crear una variable para cada campo para hacer mas controlable el formulario

        let error_projectName = true;
        let error_projectDirector = true;
        let error_projectCost = true;
        let error_projectCity = true;
        let error_projectAddress = true;
        let error_projectDate = true;
        let error_projectProduct = true;
        let error_projectClient = true;


        // En estas funciones lo que hago es: llamo a cada uno de los inputs que quiero verificar mediante su id
        // y cuando el usuario selecciona otro lugar de la pantalla, es decir, retira la atención del campo
        // llamo a una función que internamente llama a dos funciones que se encargaran de verificar el campo
        // y el estado global del formulario

        $("#projectName").focusout(function() { // Llamado del input mediante su id e indico que ejecute mis funciones cuando haya un focusout()
            check_projectName();                // Llamo a la función que me verifica el campo
            checkButton();                      // Llamo a la función que me verifica el formulario
        })

        $("#projectDirector").focusout(function() {
            check_projectDirector();
            checkButton();
        })

        $("#projectCost").focusout(function() {
            check_projectCost();
            checkButton();
        })

        $("#projectCity").focusout(function() {
            check_projectCity();
            checkButton();
        })

        $("#projectAddress").focusout(function() {
            check_projectAddress();
            checkButton();
        })

        $("#finalDate").focusout(function() {
            check_projectDate();
            checkButton();
        })

        $("#projectProduct").focusout(function() {
            check_projectProduct();
            checkButton();
        })

        $("#projectClient").focusout(function() {
            check_projectClient();
            checkButton();
        })


        // Creación de las funciones que validaran los campos

        function check_projectName(){                                                           // Declaración de la función que me validara un campo
            let pattern = /^[a-zA-Z0-9 ]*$/;                                                       // Guardo una RegEx en una variable para validar lo que ingresa el usuario en el input
            let projectName = $("#projectName").val();                                          // Obtengo lo que ingreso el usuario

            if (pattern.test(projectName) && projectName !== '') {                              // Evaluo que los datos ingresados cumplan lo necesario
                                                                                                // En caso de que sea verdadero
                $("#projectName_error_message").hide()                                          // Oculto el mensaje de error
                $("#projectName").css("border", "2px solid green");                             // El borde del input cambia a color verde
                error_projectName = false;                                                      // Cambio el estado de mi variable a false porque el campo cumple con lo requerido
            } else {                                                                            // En caso de que sea falso
                $("#projectName_error_message").html("El nombre solo debe contener letras")     // Muestro el mensaje de error. El mensaje lo paso como parametros desde JS
                $("#projectName_error_message").show()                                          // Hago visible la etiqueta <span></span>
                $("#projectName").css("border", "2px solid red");                               // El borde del input cambia a color rojo
                error_projectName = true;                                                       // Mantengo el estado en true, porque el campo no cumple lo solicitado
            }
        }

        function check_projectDirector() {
            let valueDirector = $("#projectDirector").val();
            if (valueDirector == null) {
                $("#projectDirector_error_message").html("Seleccione un encargado")
                $("#projectDirector_error_message").show()
                $("#projectDirector").css("border", "2px solid red");
                error_projectDirector = true;
            }else{
                $("#projectDirector_error_message").hide()
                $("#projectDirector").css("border", "2px solid green");
                error_projectDirector = false;
            }
        }

        function check_projectCost() {
            let pattern = /^[0-9]{2,10}$/;
            let valueCost = $("#projectCost").val();
            if (pattern.test(valueCost)) {
                $("#projectCost_error_message").hide()
                $("#projectCost").css("border", "2px solid green");
                error_projectCost = false;
            }else{
                $("#projectCost_error_message").html("El valor ingresado no cumple los requisitos")
                $("#projectCost_error_message").show()
                $("#projectCost").css("border", "2px solid red");
                error_projectCost = true;
            }
        }

        function check_projectCity() {
            let pattern = /^[a-zA-Z]{3,25}$/;
            let valueCity = $("#projectCity").val();

            if (pattern.test(valueCity)) {
                $("#projectCity_error_message").hide()
                $("#projectCity").css("border", "2px solid green");
                error_projectCity = false;
            } else {
                $("#projectCity_error_message").html("Ingrese el nombre de una ciudad")
                $("#projectCity_error_message").show()
                $("#projectCity").css("border", "2px solid red");
                error_projectCity = true;
            }
        }

        function check_projectAddress() {
            let pattern = /^[a-zA-Z0-9#/-_() ]{3,50}$/;
            let valueAddress = $("#projectAddress").val();

            if (pattern.test(valueAddress)) {
                $("#projectAddress_error_message").hide()
                $("#projectAddress").css("border", "2px solid green");
                error_projectAddress = false;
            } else {
                $("#projectAddress_error_message").html("Ingrese la dirección")
                $("#projectAddress_error_message").show()
                $("#projectAddress").css("border", "2px solid red");
                error_projectAddress = true;
            }
        }

        function check_projectDate() {
            let pattern = /^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
            let valueDateStartProject = $("#startDate").val();
            let valueDateFinalProject = $("#finalDate").val();
            if (pattern.test(valueDateStartProject) && pattern.test(valueDateFinalProject) && valueDateStartProject < valueDateFinalProject) {
                $(".projectDate_error_message").hide()
                $("#startDate").css("border", "2px solid green");
                $("#finalDate").css("border", "2px solid green");
                error_projectDate = false;
            }else{
                $(".projectDate_error_message").html("Ingrese la dirección")
                $(".projectDate_error_message").show()
                $("#finalDate").css("border", "2px solid red");
                $("#startDate").css("border", "2px solid red");
                error_projectDate = true;
            }
        }

        function check_projectProduct() {
            let valueProduct = $("#projectProduct").val();
            if (valueProduct == null) {
                $("#projectProduct_error_message").html("Seleccione un producto")
                $("#projectProduct_error_message").show()
                $("#projectProduct").css("border", "2px solid red");
                error_projectProduct = true;
            }else{
                $("#projectProduct_error_message").hide()
                $("#projectProduct").css("border", "2px solid green");
                error_projectProduct = false;
            }
        }

        function check_projectClient() {
            let valueClient = $("input[name=projectClient]").val();
            let pattern = /^[A-Za-z0-9]+$/;
            if (!pattern.test(valueClient)) {
                $("#projectClient_error_message").html("Seleccione un cliente")
                $("#projectClient_error_message").show()
                $("#projectClient").css("border", "2px solid red");
                error_projectClient = true;
            }else{
                $("#projectClient_error_message").hide()
                $("#projectClient").css("border", "2px solid green");
                error_projectClient = false;
            }
        }


        // Función para evaluar el formulario total
        // En esta función basicamente compruebo mediante un if, que todos los campos no tenga error.
        // Si estan todos bien rellenados, es decir, todas las variables en false. Voy a habilitar
        // el boton de submit del formulario.

        // Para que esto funcione bien, dentro de la etiqueta input de tipo submit mediante el cual
        // van a enviar el formulario, debe tener una propiedad llamada disabled, asi:
        // <input type="submit" value="ENVIAR" id="submit" disabled>

        function checkButton() {
            if (error_projectName == false && error_projectDirector == false && error_projectCost == false
                && error_projectAddress == false && error_projectCity == false && error_projectDate == false
                && error_projectProduct == false && error_projectClient == false) {
                    $("#submit").prop('disabled', false);
            }
        }
    }
)
