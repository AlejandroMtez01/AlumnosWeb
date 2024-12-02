<?php

session_start();
//Variable de seesión utilizada para indicar el nombre de la página en la que se navega.

include($_SESSION["pagina"] . ".php");




if (isset($_GET["id"])) {
    //Generación de consultas para autorellenar los datos del usuario
    $query = 'SELECT * FROM alumnos WHERE id= ' . $_GET["id"];
    $resultado = $conn->query($query);
    $fila = $resultado->fetch_assoc();





?>
    <script src="js/Eventos.js"></script>

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
                        <p>Edición de datos de usuario
                        </p>
                        <div class="subtitulo">
                            <h3>DATOS GENERALES</h3>
                        </div>
                        <div class="subContenido">
                            <div><span>Nombre</span></div>
                            <div class="grid">
                                <input type="text" name="nombre" value="<?php echo $fila["nombre"] ?>">
                                <input type="text" name="id" hidden value="<?php echo $fila["id"] ?>">

                            </div>
                        </div>
                        <div class="grid-dual">
                            <div class="subContenido">
                                <div><span>Apellido1</span></div>
                                <div class="grid">
                                    <input type="text" name="apellido1" value="<?php echo $fila["apellido1"] ?>">

                                </div>
                            </div>
                            <div class="subContenido">
                                <div><span>Apellido2</span></div>
                                <div class="grid">
                                    <input type="text" name="apellido2" value="<?php echo $fila["apellido2"] ?>">

                                </div>
                            </div>
                        </div>
                        <div class="subContenido">
                            <div><span>Correo Electrónico</span></div>
                            <div class="grid">
                                <input type="text" name="email" value="<?php echo $fila["email"] ?>">
                            </div>
                            <div class="grid-dual">
                                <div class="subContenido">
                                    <div><span>Provincia</span></div>
                                    <div class="grid">
                                        <input type="text" name="provincia" value="<?php echo $fila["provincia"] ?>">

                                    </div>
                                </div>
                                <div class="subContenido">
                                    <div><span>Localidad</span></div>
                                    <div class="grid">
                                        <input type="text" name="localidad" value="<?php echo $fila["localidad"] ?>">

                                    </div>
                                </div>
                            </div>
                            <div class="subContenido">
                                <div><span>Teléfono</span></div>
                                <div class="grid">
                                    <input type="text" name="telefono" value="<?php echo $fila["telefono"] ?>">
                                </div>
                            </div>

                            <div class="subContenido">
                                <div><span>Fecha Nacimiento</span></div>
                                <div class="grid">
                                    <input type="date" name="fechaNacimiento" id="" value="<?php echo $fila["fechaNacimiento"] ?>">

                                </div>
                            </div>

                            <div class="subtitulo">
                                <h3>DATOS ACADÉMICOS</h3>
                            </div>
                            <?php
                            $query = "SELECT * FROM cursosalumnos INNER JOIN alumnos on cursosalumnos.idAlumno = alumnos.id INNER JOIN cursos on cursos.id = cursosalumnos.idCurso WHERE idAlumno=" . $fila["id"];
                            //echo $query;
                            $resultado = $conn->query($query);
                            $fila1 = $resultado->fetch_assoc();
                            //echo " ".$fila1["nombreCurso"]

                            ?>
                            <div class="subContenido">
                                <div><span>Curso</span></div>
                                <div class="grid">
                                    <!-- <input type="text" name="nombre" value="<?php echo $fila["nombre"] ?>"> -->
                                    <select name="idCurso" id="curso" required>
                                        <option value=""></option>
                                        <option value="1" <?php if ($fila1["nombreCurso"] == "Desarrollo de Aplicaciones Multiplataforma") {
                                                                echo "selected";
                                                            } ?>>DAM (Desarrollo de Aplicaciones Multiplataforma)</option>
                                        <option value="2" <?php if ($fila1["nombreCurso"] == "Desarrollo de Aplicaciones Web") {
                                                                echo "selected";
                                                            } ?>>DAW (Desarrollo de Aplicaciones Web)</option>
                                        <option value="3" <?php if ($fila1["nombreCurso"] == "Ingeniería Informática") {
                                                                echo "selected";
                                                            } ?>>Ingeniería Informática</option>

                                    </select>

                                </div>
                            </div>
                            <div class="grid-dual">
                                <div class="subContenido">
                                    <div><span>Año</span></div>
                                    <div class="grid">
                                        <select name="yearCurso" id="curso" required>
                                            <option value=""></option>
                                            <option value="1" <?php if ($fila1["año"] == "1") {
                                                                    echo "selected";
                                                                } ?>>1</option>
                                            <option value="2" <?php if ($fila1["año"] == "2") {
                                                                    echo "selected";
                                                                } ?>>2</option>
                                            <option value="3" <?php if ($fila1["año"] == "3") {
                                                                    echo "selected";
                                                                } ?>>3</option>
                                            <option value="4" <?php if ($fila1["año"] == "4") {
                                                                    echo "selected";
                                                                } ?>>4</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="subContenido">
                                    <div><span>Promoción</span></div>
                                    <div class="grid">
                                        <select name="promocion" id="curso" required>

                                            <option value=""></option>
                                            <option value="2024/2025" <?php if ($fila1["promocion"] == "2024/2025") {
                                                                            echo "selected";
                                                                        } ?>>2024/2025</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panelInformacion">
                                <span class="error"></span>


                            </div>
                        </div>


                    </div>
                    <div class="contenidoFinal">
                        <input type="submit" name="submitEditar" value="Editar Empleado">
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

<?php
} else {
    header("Location: " . $_SESSION["pagina"] . ".php");
}

?>

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
    confirmarDesecharCambiosFormularios(document.querySelectorAll("form"));
</script>
<?php
if ($cambiarPagina) {
    header("Location: " . "index" . ".php");
} ?>