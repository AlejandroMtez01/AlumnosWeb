function cargarEventos() {


    var elemento = document.querySelectorAll("*[data-tooltip]");
    elemento.forEach(element => {
        console.log("Mostrando data-tooltip");
        console.log(element);
        console.log("ee");
        element.addEventListener("mouseover", mostrarTooltip);
        element.addEventListener("mouseout", desmostrarTooltip);
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