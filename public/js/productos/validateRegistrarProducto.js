$(function(){
    $("#errorNombreProducto").hide();
    $("#errorDescripcionProducto").hide();
    $("#errorPrecioProducto").hide();

  


    let errorNombreProducto=true;
    let errorDescripcionProducto=true;
    let errorPrecioProducto=true;

    $("#inputNombreProducto").focusout(function(){
        checkNombreProducto();
    })

    $("#inputDescripcionProducto").focusout(function(){
        checkDescripcionProducto();
    })

    $("#inputPrecioProducto").focusout(function(){
        checkPrecioProducto();
    })

    //Funciones que evaluaran 
    function checkNombreProducto(){
        let validacionNombre= /^[a-zA-Z-0-9 ]*$/;
        let nombre=$("#inputNombreProducto").val();
        
        if (validacionNombre.test(nombre) && nombre!=='') {
           $("#errorNombreProducto").hide();
           $("#inputNombreProducto").css("border", "2px solid green")
        }else{
            $("#errorNombreProducto").html("El nombre ingresado no cumple con los requisitos");
            $("#errorNombreProducto").show();
            $("#inputNombreProducto").css("border", "2px solid red");
        }
    }
    

    function checkDescripcionProducto(){
        let descripcionProducto=$("#inputDescripcionProducto").val();
        let validacionDescripcion=/^[a-zA-Z-0-9 ]*$/;
        if (validacionDescripcion.test(descripcionProducto) && descripcionProducto!=='') {
            $("#errorDescripcionProducto").hide();
            $("#inputDescripcionProducto").css("border", "2px solid green");
            errorDescripcionProducto=false;
        }else{
            $("#errorDescripcionProducto").html("Ingrese la descripción del producto");
            $("#errorDescripcionProducto").show();
            $("#inputDescripcionProducto").css("border","2px solid red");
            errorDescripcionProducto=true;
        }
    }

    function checkPrecioProducto(){
        let validacionPrecio= /^[0-9]{2,10}$/;
        let precio=$("#inputPrecioProducto").val();
        
        if (validacionPrecio.test(precio)) {
           $("#errorPrecioProducto").hide();
           $("#inputPrecioProducto").css("border", "2px solid green")
        }else{
            $("#errorPrecioProducto").html("El precio ingresado no cumple con los requisitos");
            $("#errorPrecioProducto").show();
            $("#inputPrecioProducto").css("border", "2px solid red");
        }
    }

})