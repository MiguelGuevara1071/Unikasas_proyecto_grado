function imprimirCliente() {
    let cliente = document.getElementById("projectClient");
    let primer_nombre = document.getElementById("primer_nombre");
    let segundo_nombre = document.getElementById("segundo_nombre");
    let primer_apellido = document.getElementById("primer_apellido");
    let segundo_apellido = document.getElementById("segundo_apellido");

    if (cliente.value == "") {
        primer_nombre.setAttribute("value", "");
        segundo_nombre.setAttribute("value", "");
        primer_apellido.setAttribute("value", "");
        segundo_apellido.setAttribute("value", "");
    } else {

        cliente = cliente.value;
        cliente = cliente.split(" ");

        primer_nombre.setAttribute("value", cliente[1]);
        segundo_nombre.setAttribute("value", cliente[2]);
        primer_apellido.setAttribute("value", cliente[3]);
        segundo_apellido.setAttribute("value", cliente[4]);
    }
}
