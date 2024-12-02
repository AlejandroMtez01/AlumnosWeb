<?php

session_start();
//Variable de seesión utilizada para indicar el nombre de la página en la que se navega.

include($_SESSION["pagina"] . ".php");
$cambiarPagina = false;





?>
<script>


</script>
<!-- The Modal -->
<div id="modal" class="modal">

    <!-- Modal content -->
    <div class="contenidoModal">
        <form method="post" action="operacionesAlumnos.php" id="form1" class="formularioEdicion">


            <div class="logo">
                <img src="./resources/icons/password-use.svg" alt="Logo de Contraseña">
            </div>

            <div class="contenidoGlobal">

                <div class="contenidoM">
                    <h2>Datos de Usuario</h2>
                    <!-- Comprobar si se trata de EDICIÓN o CREACIÓN -->
                    <p>Horario del Alumno
                    </p>

                    <div class="subtitulo">
                        <h3>HORARIO 1</h3>
                    </div>
                    <div class="subContenido">
                        <div><span>Día de la semana</span></div>
                        <div class="grid">
                            <select name="diaSem1" id="dia-semana">
                                <option value=""></option>
                                <option value="1">Lunes</option>
                                <option value="2">Martes</option>
                                <option value="3">Miércoles</option>
                                <option value="4">Jueves</option>
                                <option value="5">Viernes</option>
                                <option value="6">Sábado</option>
                                <option value="7">Domingo</option>
                            </select>
                            <input type="text" name="id" hidden value="<?php echo $_GET["id"]?>">

                        </div>
                    </div>
                    <div class="grid-dual">
                        <div class="subContenido">
                            <div><span>Hora Inicio</span></div>
                            <div class="grid">
                                <input type="time" name="horaInicio1" required value="">

                            </div>
                        </div>
                        <div class="subContenido">
                            <div><span>Hora Fin</span></div>
                            <div class="grid">
                                <input type="time" name="horaFin1" required value=>

                            </div>
                        </div>
                        <div class="subContenido">
                            <input type="button" value="Añadir Mas Días" onclick="addHorario()">
                        </div>

                    </div>


                    <div class="panelInformacion">
                        <span class="error"></span>


                    </div>
                </div>


            </div>
            <div class="contenidoFinal">
                <input type="submit" name="submitCrearHorarioAlumno" value="Crear Horario">
            </div>
    </div>
    </form>
</div>

</div>

<script>

var horario = 1;
    var form = document.getElementById("form1");
    form.addEventListener("submit", funcionSubmit);

    function funcionSubmit() {
        //console.log("submit");
        //event.preventDefault();

/*
        revisarInput = ["horaInicio","horaFin"];
        var cumpleMinimos = true;
        for (let i = 0; i < revisar.length; i++) {
            for (let j = 0; j < horario-1; j++) {

                
               
            
            var elemento = document.querySelector("input[name=" + revisarInput[i] + j +"]");
            console.log(elemento)

            console.log("Elemento comprobando: "+elemento);
            console.log(elemento)
            if (elemento.value == "") {

                cumpleMinimos = false;
                var error = document.querySelector(".error");
                error.innerHTML = "<b>Error</b>: Los campos imprescindibles no están rellenos.";

            }
        }
    }
        if (!cumpleMinimos) {
            event.preventDefault();
            console.log("Paso por aquí");

        }else{
            event.preventDefault();

        }
*/
    }

  

    function addHorario() {



        var elementoParaAppend = document.querySelector(".contenidoM");
        var tituloGeneral = document.createElement("div");
        tituloGeneral.classList.add("subtitulo");
        var h3 = document.createElement("h3");

        h3.innerHTML="HORARIO "+ ++horario;
        tituloGeneral.appendChild(h3);
        elementoParaAppend.append(tituloGeneral);

        var subContenido = document.createElement("div");

        //SUBCONTENIDO
        subContenido.classList.add("subContenido");

        //GRID
        var grid = document.createElement("div");
        grid.classList.add("grid");

        //SELECT
        var select = document.createElement("select");
        select.classList.add("diaSem");
        select.name = "diaSem"+horario;
        select.id = "diaSem";

        //OPTION
        var diasSem = ["","Lunes", "Martes", "Miércoles", "Jueves", "Viérnes", "Sábado", "Domingo"];

        var i = 1;
        for (let i = 0; i < diasSem.length; i++) {
            j = i;
            j++;
            var option = document.createElement("option");
            option.value = j;
            option.innerHTML = diasSem[i];
            //Append de las option a select
            select.append(option);

        }


        //DIV Titulo
        var div = document.createElement("div");

        //SPAN Titulo
        var span = document.createElement("span");
        span.innerHTML = "Día de la semana";



        //APPEND (Nivel general a Nivel Específico)

        elementoParaAppend.append(subContenido);

        //-----

        subContenido.append(div)

        subContenido.append(grid);

        //-----

        div.append(span);

        grid.append(select);


        div2Columnas = document.createElement("div");
        div2Columnas.classList = "grid-dual";

        //SUBCONTENIDO
        subContenido = document.createElement("div");

        subContenido.classList.add("subContenido");

        //DIV Titulo
        var div = document.createElement("div");

        //SPAN Titulo
        var span = document.createElement("span");
        span.innerHTML = "Hora Inicio";

        //GRID
        var grid = document.createElement("div");
        grid.classList.add("grid");

        //INPUT
        var input = document.createElement("input");
        input.type = "time";
        input.name = "horaInicio"+horario;
        input.setAttribute("required","")

        elementoParaAppend.append(div2Columnas);

        div2Columnas.append(subContenido);

        subContenido.append(div);

        div.append(span);

        subContenido.append(grid);

        grid.append(input)

        //SUBCONTENIDO
        subContenido = document.createElement("div");

        subContenido.classList.add("subContenido");

        //DIV Titulo
        var div = document.createElement("div");

        //SPAN Titulo
        var span = document.createElement("span");
        span.innerHTML = "Hora Fin";

        //GRID
        var grid = document.createElement("div");
        grid.classList.add("grid");

        //INPUT
        var input = document.createElement("input");
        input.type = "time";
        input.name = "horaFin"+horario;
        input.setAttribute("required","")

        elementoParaAppend.append(div2Columnas);

        div2Columnas.append(subContenido);

        subContenido.append(div);

        div.append(span);

        subContenido.append(grid);

        grid.append(input)







        //Bajar botón Añadir más días

        boton = document.querySelector("input[value='Añadir Mas Días']").parentElement;
        elementoParaAppend.appendChild(boton);

    }
</script>



<script>
    // Get the modal
    var modal = document.getElementById("modal");


    // Get the <span> element that closes the modal




    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            window.location.href = "<?php echo $_SESSION["pagina"] . ".php" ?>";
        }
    }
</script>
<?php
// if ($cambiarPagina) {
//     header("Location: " . "index" . ".php");
// } 
?>