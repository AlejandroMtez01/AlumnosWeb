function cargarEventos() {


    var elemento = document.querySelectorAll("*[data-tooltip]");
    elemento.forEach(element => {
        //console.log("Mostrando data-tooltip");
        //console.log(element);

        element.addEventListener("mouseover", mostrarTooltip);
        element.addEventListener("mouseout", desmostrarTooltip);
    });
}

function confirmarDesecharCambiosFormularios(formulario){
    
    formulario.forEach(e => {
        e.addEventListener('input', () => {
            tieneCambios = true
        });
        console.log(e);
    });
    window.addEventListener('beforeunload', (event) => {
        if (tieneCambios) {
            event.preventDefault();
            event.returnValue = ''; // Necesario para que algunos navegadores muestren el cuadro de diálogo
        }
    });
    formulario.forEach(e => {
        e.addEventListener('submit', (event) => {
            tieneCambios = false; // Reseteamos la bandera al enviar
        });
    });
}



var tooltipElement;



function mostrarTooltip(event) {
    //var target = this.target
    //Obtenemos los datos del atributo tooltip
    var tooltip = this.dataset.tooltip;

    //Creamos el elemento tooltip
    tooltipElement = document.createElement("div");
    tooltipElement.className = "tooltip";
    tooltipElement.innerHTML = tooltip;

    //Lo añadimos al body en el caso de que no tenga modal
    var modal = document.querySelector(".contenidoModal");
    console.log("EE");
    console.log(modal);
    if(modal == null){
    document.body.append(tooltipElement);
    }else{
        modal.append(tooltipElement);
    }


    let coordinadas = this.getBoundingClientRect()
    tooltipElement.style.left = (coordinadas.left - tooltipElement.offsetWidth / 2 + this.offsetWidth / 2) + "px";
    tooltipElement.style.top = (coordinadas.top - 35) + "px";
}


function desmostrarTooltip(event) {
    if (tooltipElement) {
        tooltipElement.remove();
        tooltipElement = null;
    }
}
function confirmarSalida(pagina) {
    const respuesta = confirm("¿Estás seguro de que desea salir?");
    if (respuesta) {
        window.location.href = pagina;
    } else {}
}
function confirmarBorradoAlumno(pagina) {
    const respuesta = confirm("¿Estás seguro de que deseas eliminar el ALUMNO?");
    if (respuesta) {
        window.location.href = pagina;
    } else {}
}