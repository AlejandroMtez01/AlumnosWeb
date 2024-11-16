function decrementarMes_Year() {
    var elementoM = document.querySelector("input[name='mes']")
    var elementoY = document.querySelector("input[name='year']")
    mes = elementoM.value;
    year = elementoY.value;
    console.log("Mes: " + mes);
    console.log("Año: " + year);
    --mes;
    if (mes < 0) {
        elementoM.value = mes = 11;
        elementoY.value = --year;
    } else {
        elementoM.value = mes;
        elementoY.value = year;
    }
}
function incrementarMes_Year() {

    var elementoM = document.querySelector("input[name='mes']")
    var elementoY = document.querySelector("input[name='year']")
    mes = elementoM.value;
    year = elementoY.value;
    console.log("Mes: " + mes);
    console.log("Año: " + year);
    ++mes;
    if (mes > 11) {
        elementoM.value = mes = 0;
        elementoY.value = ++year;
    } else {
        elementoM.value = mes;
        elementoY.value = year;
    }

}
function decrementarMes_Year1() {
    var elementoY = document.querySelector("input[name='year']")
    year = elementoY.value;
    console.log("Año: " + year);

    elementoY.value = --year;

}
function incrementarMes_Year1() {

    var elementoY = document.querySelector("input[name='year']")
    year = elementoY.value;
    console.log("Año: " + year);

    elementoY.value = ++year;

}
function actualizarFormularioMes() {
    var elemento = document.querySelector(".mesElegido");
    var elementoM = document.querySelector("input[name='mes']")
    elementoM.value = elemento.value;
    var formulario = document.querySelector(".calendario_fecha");
    formulario.submit();
}
function actualizarFormularioYear() {
    var elemento = document.querySelector(".añoElegido");
    var elementoY = document.querySelector("input[name='year']")
    elementoY.value = elemento.value;
    var formulario = document.querySelector(".calendario_fecha");
    formulario.submit();

}
