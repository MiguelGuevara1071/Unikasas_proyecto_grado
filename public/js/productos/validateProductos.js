$(function(){

    console.log("xd")
    $("#errorNombreProducto").hide();
    $("#errorDescripcionProducto").hide();
    $("$errorPrecioProducto").hide();


    let errorName=true;
    let errorDescripcion=true;
    let errorPrecio=true;

    $("#inputNombreProducto").focusout( function(){
        checkNombreProducto();
        checkButton();
    })

    $("#inputDescripcionProducto").focusout( function(){
        checkDescripcionProducto();
        checkButton();
    })

    $("#inputPrecioProducto").focusout( function(){
        checkPrecioProducto();
        checkButton();
    })
    function checkNombreProducto(){
        let nombreProductoValidacion=/^[a-zA-Z ]*$/;
        let name=$("#inputNombreProducto").val();

        if(nombreProductoValidacion.test(name) && name !==''){
            $("#errorNombreProducto").hide()
            $("#inputNombreProducto").css("border", "2px solid green")
             errorName=false;
        }else{
            $("#errorNombreProducto").html("El nombre solo debe contener letras")
            $("#errorNombreProducto").show();
            $("#inputNombreProducto").css("border", "2px solid red")
            errorName=true;
        }
    }


    function checkDescripcionProducto(){
        let descripcionProductoValidacion=/^[a-zA-Z ]*$/;
        let descripcion=$("#inputDescripcionProducto").val();

        if(descripcionProductoValidacion.test(descripcion) && descripcion !==''){
            $("#errorDescripcionProducto").hide()
            $("#inputDescripcionProducto").css("border", "2px solid green")
             errorDescripcion=false;
        }else{
            $("#errorDescripcionProducto").html("El nombre solo debe contener letras")
            $("#errorDescripcionProducto").show();
            $("#inputDescripcionProducto").css("border", "2px solid red")
            errorDescripcion=true;
        }
    }

    function checkPrecioProducto(){
        let descripcionProductoValidacion=/^([0-9])*$/;
        let precio=$("#inputPrecioProducto").val();

        if(descripcionProductoValidacion.test(precio) && precio !==''){
            $("#errorPrecioProducto").hide()
            $("#inputPrecioProducto").css("border", "2px solid green")
             errorPrecio=false;
        }else{
            $("#errorPrecioProducto").html("El nombre solo debe contener letras")
            $("#errorPrecioProducto").show();
            $("#inputPrecioProducto").css("border", "2px solid red")
            errorPrecio=true;
        }
    }


})
