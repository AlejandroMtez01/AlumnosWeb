<?php

session_start();
//Variable de seesión utilizada para indicar el nombre de la página en la que se navega.

include($_SESSION["pagina"] . ".php");
$cambiarPagina = false;

//Variables importantes que serán utilizadas varias veces en el documetno

$idInicializado = isset($_GET["id"]);


$edicion = isset($_GET["idClase"]);

$bloqueado = isset($_GET["bloqueado"]);

$filaClase = "";

if ($edicion) {
    $query = "SELECT * FROM clases WHERE id=" . $_GET["idClase"];
    //echo $query;
    $resultado = $conn->query($query);
    $filaClase = $resultado->fetch_assoc();
}



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


                    <?php
                    //var_dump($_GET);

                    //echo count($filaClase);

                    if ($bloqueado) { ?>
                        <h2>Ver Clase</h2>
                        <p>Clase Nº <b><?php echo obtenerNumeroClase($_GET["id"], $_GET["idClase"], $conn) ?></b> de <b><?php echo obtenerNombreyApellidosUsuario($_GET["id"], $conn) ?></b></p>
                    <?php
                    } else if ($edicion) {
                    ?>
                        <h2>Editar Clase</h2>
                        <p>Clase Nº <b><?php echo obtenerNumeroClase($_GET["id"], $_GET["idClase"], $conn) ?></b> de <b><?php echo obtenerNombreyApellidosUsuario($_GET["id"], $conn) ?></b></p>

                    <?php
                    } else if ($idInicializado) {


                    ?>
                        <h2>Nueva Clase</h2>
                        <p>Clase Nº <b><?php echo obtenerNumeroClaseSiguiente($_GET["id"], $conn) ?></b> de <b><?php echo obtenerNombreyApellidosUsuario($_GET["id"], $conn) ?></b></p>
                    <?php
                    } else { ?>
                        <h2>Nueva Clase</h2>
                        <p>Seleccione el <b>alumno</b></p>

                    <?php } ?>

                    </p>
                    <div class="contenedor">
                        <div class="subtitulo">
                            <h3>HORARIO</h3>
                        </div>
                        <div class="subContenido">
                            <div><span>Fecha</span></div>
                            <div class="grid">
                                <input type="date" name="fecha" value="<?php if (isset($_GET["fecha"])) echo $_GET["fecha"] ?>" <?php if ($bloqueado) echo "disabled" ?> required>


                                <?php if ($idInicializado) {
                                ?>
                                    <input type="text" name="id" hidden value="<?php echo $_GET["id"] ?>">
                                    <input type="text" name="idClase" hidden value="<?php echo $filaClase["id"] ?>">
                            </div>
                        <?php } else {
                        ?>
                            <div class="subContenido">
                                <div><span>Alumno</span></div>
                                <div class="grid">
                                    <select name="id">
                                        <?php

                                        $query = "SELECT * FROM alumnos ORDER BY id asc";
                                        //echo $query;
                                        $resultado = $conn->query($query);
                                        $idAlumnos = [''];
                                        $nombreCompletoAlumnos = [''];
                                        while ($filaAlumnos = $resultado->fetch_assoc()) {
                                            array_push($idAlumnos, $filaAlumnos["id"]);
                                            array_push($nombreCompletoAlumnos, $filaAlumnos["nombre"] . " " . $filaAlumnos["apellido1"] . " " . $filaAlumnos["apellido2"]);
                                        }


                                        ?>

                                        <?php for ($i = 0; $i < count($idAlumnos); $i++) {
                                        ?>
                                            <option value="<?php echo $idAlumnos[$i] ?>"><?php echo $nombreCompletoAlumnos[$i] ?></option>
                                        <?php
                                        } ?>

                                    </select>


                                <?php
                                }

                                ?>


                                </div>
                                <div class="grid-dual">
                                    <div class="subContenido">
                                        <div><span>Hora Inicio</span></div>
                                        <div class="grid">
                                            <input type="time" name="horaInicio" value="<?php if (isset($_GET["horaInicio"])) echo $_GET["horaInicio"] ?>" <?php if ($bloqueado) echo "disabled" ?> required>

                                        </div>
                                    </div>
                                    <div class="subContenido">
                                        <div><span>Hora Final</span></div>
                                        <div class="grid">
                                            <input type="time" name="horaFin" value="<?php if (isset($_GET["horaInicio"])) echo $_GET["horaFin"] ?>" <?php if ($bloqueado) echo "disabled" ?> required>

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
                                        <textarea rows="5" name="contenidoExplicado" <?php if ($bloqueado) echo "disabled" ?>><?php if ($edicion) echo $filaClase["contenidoExplicado"]; ?></textarea>

                                    </div>
                                </div>
                                <div class="subContenido">
                                    <div><span>Ejercicios Realizados</span></div>
                                    <div class="grid">
                                        <textarea rows="5" name="ejerciciosRealizados" <?php if ($bloqueado) echo "disabled" ?>><?php if ($edicion) echo $filaClase["ejerciciosRealizados"]; ?></textarea>
                                    </div>
                                </div>
                                <div class="subContenido">
                                    <div><span>Observaciones (Próxima Clase)</span></div>
                                    <div class="grid">
                                        <textarea rows="5" name="observacionesProximaClase" <?php if ($bloqueado) echo "disabled" ?>><?php if ($edicion) echo $filaClase["observacionesProximaClase"]; ?></textarea>
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
                                        <textarea rows="5" name="dificultad" <?php if ($bloqueado) echo "disabled" ?>><?php if ($edicion) echo $filaClase["dificultad"]; ?></textarea>

                                    </div>
                                </div>
                                <div class="subContenido">
                                    <div><span>Evolución</span></div>
                                    <div class="grid">
                                        <textarea rows="5" name="evolucion" <?php if ($bloqueado) echo "disabled" ?>><?php if ($edicion) echo $filaClase["evolucion"]; ?></textarea>

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
                            <?php if ($bloqueado) { ?>
                                <input type="submit" name="cerrar" value="Cerrar">
                            <?php

                            } else if ($edicion) {
                            ?>
                                <input type="submit" name="editarClase" value="Editar Clase">
                                <input type="submit" name="cancelarClase" value="Cancelar">

                            <?php } else {
                            ?>
                                <input type="submit" name="crearClase" value="Crear Clase">
                                <input type="submit" name="cancelarClase" value="Cancelar">
                            <?php
                            } ?>


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
            window.location.href = pagina;
        } else {}
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