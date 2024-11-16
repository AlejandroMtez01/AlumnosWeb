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
                    <p>Edición de datos de usuario
                    </p>
                    <div class="subtitulo">
                        <h3>DATOS GENERALES</h3>
                    </div>
                    <div class="subContenido">
                        <div><span>Nombre</span></div>
                        <div class="grid">
                            <input type="text" name="nombre" value="">
                            <input type="text" name="id" hidden value="">

                        </div>
                    </div>
                    <div class="grid-dual">
                        <div class="subContenido">
                            <div><span>Apellido1</span></div>
                            <div class="grid">
                                <input type="text" name="apellido1" value="">

                            </div>
                        </div>
                        <div class="subContenido">
                            <div><span>Apellido2</span></div>
                            <div class="grid">
                                <input type="text" name="apellido2" value=>

                            </div>
                        </div>
                    </div>
                    <div class="subContenido">
                        <div><span>Correo Electrónico</span></div>
                        <div class="grid">
                            <input type="text" name="email" value="">
                        </div>
                    <div class="grid-dual">
                        <div class="subContenido">
                            <div><span>Provincia</span></div>
                            <div class="grid">
                                <input type="text" name="provincia" value="">

                            </div>
                        </div>
                        <div class="subContenido">
                            <div><span>Localidad</span></div>
                            <div class="grid">
                                <input type="text" name="localidad" value=>

                            </div>
                        </div>
                    </div>
                    <div class="subContenido">
                        <div><span>Teléfono</span></div>
                        <div class="grid">
                            <input type="text" name="telefono" value="">
                        </div>
                    </div>
                    <!-- <div class="grid-dual">

                        <div class="subContenido">
                            <div><span>Tipo CIF</span></div>
                            <div class="grid">
                                <select name="tipoCIF" id="tipoCIF">


                                    <option value=""></option>

                                    <option value="DNI">DNI</option>
                                    <option value="NIE">NIE</option>
                                    <option value="TIE">TIE</option>
                                </select>
                            </div>
                        </div>
                        <div class="subContenido">
                            <div><span>CIF</span></div>
                            <div class="grid">
                                <input type="text" name="CIF" id="" value="">

                            </div>
                        </div>
                    </div> -->
                    <div class="subContenido">
                        <div><span>Fecha Nacimiento</span></div>
                        <div class="grid">
                            <input type="date" name="fechaNacimiento" id="" value="">

                        </div>
                    </div>
                    <!-- <div class="subtitulo">
                        <h3>DATOS DE SESIÓN</h3>
                    </div>

                    <div class="subContenido">
                        <div><span>Email</span></div>
                        <div class="grid">
                            <input type="text" name="email" id="" value="">

                        </div>
                    </div>
                    <div class="subContenido">
                        <div><span>Contraseña</span></div>
                        <div class="grid">
                            <input type="password" name="password" id="" value="">

                        </div>
                    </div> -->
                    <div class="subtitulo">
                                <h3>DATOS ACADÉMICOS</h3>
                            </div>
                            <div class="subContenido">
                                <div><span>Curso</span></div>
                                <div class="grid">
                                    <!-- <input type="text" name="nombre" value="<?php echo $fila["nombre"] ?>"> -->
                                    <select name="idCurso" id="curso"  required>
                                        <option value=""></option>
                                        <option value="1" <?php ?>>DAM (Desarrollo de Aplicaciones Multiplataforma)</option>
                                        <option value="2">DAM (Desarrollo de Aplicaciones Web)</option>
                                        <option value="3">Ingeniería Informática</option>
                                    </select>

                                </div>
                            </div>
                            <div class="grid-dual">
                                <div class="subContenido">
                                    <div><span>Año</span></div>
                                    <div class="grid">
                                        <select name="yearCurso" id="curso"  required>
                                            <option value=""></option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="subContenido">
                                    <div><span>Promoción</span></div>
                                    <div class="grid">
                                        <select name="promocion" id="curso" required>

                                            <option value=""></option>
                                            <option value="2024/2025">2024/2025</option>
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
                <input type="submit" name="submitCrear" value="Crear Empleado">
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
        "provincia","localidad", 
        //"email",
        "fechaNacimiento"];
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