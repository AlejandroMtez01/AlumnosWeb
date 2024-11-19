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


                    <?php
                    $query = 'SELECT id,diaSem, TIME_FORMAT(horaInicio, "%H:%i") as horaInicio,TIME_FORMAT(horaFin, "%H:%i") as horaFin FROM horarioAlumnos WHERE idAlumno= ' . $_GET["id"];

                    $resultado = $conn->query($query);
                    $contador = 0;
                    while ($fila = $resultado->fetch_assoc()) {
                        ++$contador;

                    ?>
                        <div class="contenidoHorario">
                            <span class="delete-icon">X</span>

                            <div class="subtitulo">

                                <h3>HORARIO <?php echo $contador ?></h3>
                            </div>
                            <div class="subContenido">
                                <div><span>Día de la semana</span></div>
                                <div class="grid">
                                    <select name="diaSem<?php echo $contador; ?>" id="dia-semana">
                                        <option value=""></option>
                                        <option value="1" <?php if ($fila["diaSem"] == 1) echo "selected" ?>>Lunes</option>
                                        <option value="2" <?php if ($fila["diaSem"] == 2) echo "selected" ?>>Martes</option>
                                        <option value="3" <?php if ($fila["diaSem"] == 3) echo "selected" ?>>Miércoles</option>
                                        <option value="4" <?php if ($fila["diaSem"] == 4) echo "selected" ?>>Jueves</option>
                                        <option value="5" <?php if ($fila["diaSem"] == 5) echo "selected" ?>>Viernes</option>
                                        <option value="6" <?php if ($fila["diaSem"] == 6) echo "selected" ?>>Sábado</option>
                                        <option value="7" <?php if ($fila["diaSem"] == 7) echo "selected" ?>>Domingo</option>
                                    </select>
                                    <input type="text" name="id<?php echo $contador; ?>" hidden value="<?php echo $fila["id"] ?>">
                                    <input type="text" name="idAlumno" hidden value="<?php echo $_GET["id"] ?>">

                                </div>
                            </div>
                            <div class="grid-dual">
                                <div class="subContenido">
                                    <div><span>Hora Inicio</span></div>
                                    <div class="grid">
                                        <input type="time" name="horaInicio<?php echo $contador; ?>" required value="<?php echo $fila["horaInicio"] ?>">

                                    </div>
                                </div>
                                <div class="subContenido">
                                    <div><span>Hora Fin</span></div>
                                    <div class="grid">
                                        <input type="time" name="horaFin<?php echo $contador; ?>" required value="<?php echo $fila["horaFin"] ?>">

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="subContenido">
                        <input type="button" value="Añadir Mas Días" onclick="addHorario(<?php echo $contador ?>)">
                    </div>




                    <div class="panelInformacion">
                        <span class="error"></span>


                    </div>
                </div>


            </div>
            <div class="contenidoFinal">
                <input type="submit" name="submitEditarHorarioAlumno" value="Crear Horario">
            </div>
    </div>
    </form>
</div>

</div>

<script>
    var horario = <?php echo $contador; ?>;
    var form = document.getElementById("form1");
    form.addEventListener("submit", funcionSubmit);

    var contenidoHorario = document.querySelectorAll(".contenidoHorario");
    var deleteIcon = document.querySelectorAll(".delete-icon");

    deleteIcon.forEach((e) => {
        e.style = "    position: relative;" +
            "top: 5px;" +
            "left: 95%;" +
            "padding: 10px;" +
            "font-size: 14px;" +
            "color: white;" +
            "background-color: darkred;" +
            "border-radius: 5%;" +
            "cursor: pointer;";



        e.addEventListener("click", () => {
        e.parentElement.remove();
    });


    });

    contenidoHorario.forEach((e) => {
        e.style = "padding: 1% 2%;" +
            "margin: 1% 0%;" + "border: 2px solid transparent;" +
            "border-radius: 10px;"+
            "border: 2px solid white;";


        e.addEventListener("mouseenter", () => {
            e.style = //"background: darkred;"+

                "border: 2px solid darkred;" +
                "border-radius: 10px;" +
                "padding: 1% 2%;" +
                "margin: 1% 0%;";
        });
        e.addEventListener("mouseleave", () => {
            e.style = //"background: darkred;"+
                "border: 2px solid white;" +
                "border-radius: 10px;" +
                "padding: 1% 2%;" +
                "margin: 1% 0%;";
                console.log("salgo")
        });




    })



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

        divContenido = document.createElement("div");
        divContenido.classList.add("contenidoHorario");

        h3.innerHTML = "HORARIO " + ++horario;
        tituloGeneral.appendChild(h3);
        divContenido.append(tituloGeneral);

        var subContenido = document.createElement("div");

        //SUBCONTENIDO
        subContenido.classList.add("subContenido");

        //GRID
        var grid = document.createElement("div");
        grid.classList.add("grid");

        //SELECT
        var select = document.createElement("select");
        select.classList.add("diaSem");
        select.name = "diaSem" + horario;
        select.id = "diaSem";

        //ID (ID Horario)
        var idHorario = document.createElement("input");
        idHorario.name = "id" + horario;
        idHorario.hidden = true;
        idHorario.setAttribute("value", " ")


        //OPTION
        var diasSem = ["", "Lunes", "Martes", "Miércoles", "Jueves", "Viérnes", "Sábado", "Domingo"];

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

        elementoParaAppend.append(divContenido);

        divContenido.append(subContenido);


        //-----

        subContenido.append(div)

        subContenido.append(grid);

        //-----

        div.append(span);

        grid.append(select);

        grid.append(idHorario);


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
        input.name = "horaInicio" + horario;
        input.setAttribute("required", "")

        divContenido.append(div2Columnas);

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
        input.name = "horaFin" + horario;
        input.setAttribute("required", "")

        divContenido.append(div2Columnas);

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