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
        <form method="post" action="operacionesClase.php" id="form1" class="formularioEdicion">


            <div class="logo">
                <img src="./resources/icons/password-use.svg" alt="Logo de Contraseña">
            </div>

            <div class="contenidoGlobal">

                <div class="contenidoM">
                    <h2>Clase Nº</h2>
                    <p>Clase número X de <b>Alejandro Martínez García</b></p>
                    </p>
                    <div class="contenedor">
                        <div class="subtitulo">
                            <h3>HORARIO</h3>
                        </div>
                        <div class="subContenido">
                            <div><span>Fecha</span></div>
                            <div class="grid">
                            <input type="date" name="fecha" value="<?php echo $_GET["fecha"] ?>"  required>
                                <input type="text" name="id" hidden value="<?php echo $_GET["id"] ?>">

                            </div>
                        </div>
                        <div class="grid-dual">
                            <div class="subContenido">
                                <div><span>Hora Inicio</span></div>
                                <div class="grid">
                                    <input type="time" name="horaInicio" value="<?php echo $_GET["horaInicio"] ?>" required>

                                </div>
                            </div>
                            <div class="subContenido">
                                <div><span>Hora Final</span></div>
                                <div class="grid">
                                    <input type="time" name="horaFin" value="<?php echo $_GET["horaFin"] ?>"  required>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="contenedor">
                        <div class="subtitulo">
                            <h3>CONTENIDO CLASE</h3>
                        </div>
                        <div class="subContenido">
                            <div><span>Contenido Explicado</span></div>
                            <div class="grid">
                                <textarea rows="5" name="contenidoExplicado"  required></textarea>

                            </div>
                        </div>
                        <div class="subContenido">
                            <div><span>Ejercicios Realizados</span></div>
                            <div class="grid">
                                <textarea rows="5" name="ejerciciosRealizados"></textarea>
                            </div>
                        </div>
                        <div class="subContenido">
                            <div><span>Observaciones (Próxima Clase)</span></div>
                            <div class="grid">
                                <textarea rows="5" name="observacionesProximaClase"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="contenedor">
                        <div class="subtitulo">
                            <h3>PROCESO ALUMNO</h3>
                        </div>
                        <div class="subContenido">
                            <div><span>Dificultad</span></div>
                            <div class="grid">
                                <textarea rows="5" name="dificultad"></textarea>

                            </div>
                        </div>
                        <div class="subContenido">
                            <div><span>Evolución</span></div>
                            <div class="grid">
                                <textarea rows="5" name="evolucion"></textarea>

                            </div>
                        </div>



                    </div>

                    <div class="panelInformacion">
                        <span class="error"></span>


                    </div>
                </div>


            </div>
            <div class="contenidoFinal1">

                <div class="botones">
                    <input type="submit" name="crearClase" value="Crear Clase">
                    <input type="submit" name="cancelarClase" value="Cancelar">
                </div>
            </div>
    </div>
    </form>
</div>

</div>

<script>
    var form = document.getElementById("form1");
    form.addEventListener("submit", funcionSubmit);

    function funcionSubmit() {

        //Nombre,Apellido1, Apellido2, CIF, Email, Contraseña deben de estar si o si
        revisar = ["nombre", "apellido1",
            // "apellido2", 
            "provincia", "localidad",
            //"email",
            "fechaNacimiento"
        ];
        var cumpleMinimos = true;
        for (let i = 0; i < revisar.length; i++) {
            var elemento = document.querySelector("input[name=" + revisar[i] + "]");
            if (elemento.value == "") {

                cumpleMinimos = false;
                var error = document.querySelector(".error");
                error.innerHTML = "<b>Error</b>: Los campos imprescindibles no están rellenos.";

            }
        }
        if (!cumpleMinimos) {
            event.preventDefault();
            console.log("Paso por aquí");

        }

    }
</script>



<script>
    // Get the modal
    var modal = document.getElementById("modal");


    // Get the <span> element that closes the modal



    function confirmarSalida(pagina) {
      const respuesta = confirm("¿Estás seguro de que desea salir?");
      if (respuesta) {
        window.location.href =pagina;
      } else {
      }
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            //window.location.href = "<?php echo $_SESSION["pagina"] . ".php" ?>";
            confirmarSalida("<?php echo $_SESSION["pagina"] . ".php" ?>");
        }
    }
</script>
<?php
// if ($cambiarPagina) {
//     header("Location: " . "index" . ".php");
// } 
?>