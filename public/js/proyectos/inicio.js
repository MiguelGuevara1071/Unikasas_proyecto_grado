function calculateURL() {
    const button = document.querySelector('.buttonArchived');
    let url = window.location.href;
    
    if (url == "http://127.0.0.1:8000/proyectos/search/inactivo") {
        button.setAttribute("href", "http://127.0.0.1:8000/proyectos/search/activo")
        button.innerHTML = "PROYECTOS"
    }else{
        button.setAttribute("href", "http://127.0.0.1:8000/proyectos/search/inactivo")
        button.innerHTML = "ARCHIVADOS"
    }
}