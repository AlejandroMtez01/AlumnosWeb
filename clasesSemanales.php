<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewdivort" content="width=device-width, initial-scale=1.0">
    <title>diversonas y Talento</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">

    <script src="js/Nav.js"></script>
    <script src="js/Formularios.js"></script>
    <script src="js/Eventos.js"></script>


</head>






<body class="inicio">

    <?php
    include "php/baseDeDatos.php";
    include "php/Funciones.php";
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    $_SESSION["pagina"] = basename(__FILE__, '.php');


    $hoy = new DateTime();
    //$hoy->modify('-' . 7 . ' days'); //Prueba para, la siguiente semana.


    //Realizar la comprobación para comprobar si coinciden registros
    $query = "SELECT * FROM HORARIOALUMNOS";
    //echo $query;
    $resultado = $conn->query($query);
    while ($filaHorario = $resultado->fetch_assoc()) {
        $query = "SELECT * FROM HORARIOALUMNOS where diaSem='" . $filaHorario["diaSem"] . "' and (horaInicio>='" . $filaHorario["horaInicio"] . "' and horaFin<='" . $filaHorario["horaFin"] . "')";
        //$_GET["exito"] = $query;

        $resultado2 = $conn->query($query);
        if ($resultado2->num_rows > 1) {
            $_GET["error"] = "El horario realizado no se ha desarrollado correctamente. (Existen duplicidades en días y fechas concretas)";
            //$_GET["exito"] = $query;
        }
    }
    $diaSem = ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"];
    ?>


    <div class="sidebar">
        <div class="logo">
            <img src="https://api.factorialhr.com/rails/active_storage/representations/redirect/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBCSzI1U3dFPSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--811eea947ac2e646c0fc36dd5662315aa60f0039/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdDem9MWm05eWJXRjBTU0lJY0c1bkJqb0dSVlE2QzNKbGMybDZaVWtpQ3pJMk1IZzRNQVk3QmxRNkQySmhZMnRuY205MWJtUkpJaHB5WjJKaEtESTFOU3d5TlRVc01qVTFMREF1TUNrR093WlVPZ3huY21GMmFYUjVTU0lMUTJWdWRHVnlCanNHVkRvTFpYaDBaVzUwU1NJTE1qWXdlRGd3QmpzR1ZEb1FZWFYwYjE5dmNtbGxiblJVIiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--6d510dd820fde4c9524c03b626d8f13f11017e40/Logo_BolloNaturalFruit_magenta%20Factorial.png" alt="">
        </div>
        <div class="navGeneral">




            <?php
            include "php/baseDeDatos.php";

            include "php/Nav.php"; ?>


        </div>
    </div>

    <script>
        //Añadir evento a las flechas hacia abajo
        var botones = document.querySelectorAll('button');

        for (var i = 0; i < botones.length; i++) {
            botones[i].addEventListener('click', mostar_nomostrar_subMenu);
        }
    </script>

    <div class="main empleados">
        <?php if (isset($_GET["exito"])) { ?>
            <div class="exito"><?php echo $_GET["exito"]; ?></div><?php
                                                                } ?>

<?php if (isset($_GET["error"])) { ?>
            <div class="error"><?php echo "<span>Error! </span>". $_GET["error"]. ". (Cod. L1)"; ?></div><?php
                                                                } ?>


        <div class="areaFlex">
            <div class="titulo">
                <h3>CLASES SEMANALES (PENDIENTES)</h3>
            </div>

            <div class="clases noWrap color1">
                <?php


                //Creación de algoritmo para mostrar todas las clases pendientes de la semana.
                //Comprueba por alumno, [cuantas clases a la semana tiene] y [cuantas clases han dado]

                $query = 'SELECT * FROM alumnos ORDER BY id';
                $resultado = $conn->query($query);
                if ($resultado->num_rows > 0) {
                    // Iterar sobre cada alumno
                    while ($filaAlumno = $resultado->fetch_assoc()) {
                        $query = 'SELECT diaSem, TIME_FORMAT(horaInicio, "%H:%i") as horaInicio,TIME_FORMAT(horaFin, "%H:%i") as horaFin FROM horarioAlumnos WHERE idAlumno = ' . $filaAlumno["id"] . " ORDER BY diaSem ASC";
                        $resultadoClasesHorario = $conn->query($query);
                        //echo "Alumno: " . $filaAlumno["nombre"] . "- Número de filas " . $resultadoClasesHorario->num_rows;

                        $numFilasClasesHorario = $resultadoClasesHorario->num_rows;

                        if ($resultadoClasesHorario->num_rows > 0) { //En caso de que no tenga horario fijado, no mostrará sugerencias.
                            //$hoy = new DateTime();
                            //$hoy->modify('-' . 7 . ' days'); //Prueba para, la siguiente semana.


                            $diaDeLaSemana = $hoy->format('N');

                            // Calcular la fecha del lunes (inicio de la semana)
                            $lunes = clone $hoy;
                            $lunes->modify('-' . ($diaDeLaSemana - 1) . ' days');
                            //echo "Lunes: " . $lunes->format("d/m/Y");

                            // Calcular la fecha del domingo (último día de la semana)
                            $domingo = clone $hoy;
                            $domingo->modify('+' . (7 - $diaDeLaSemana) . ' days');
                            //echo "Domingo: " . $domingo->format("d/m/Y");

                            //Consulta para saber cuantas clases se han creado esta semana.
                            $query = "SELECT * FROM clases WHERE fecha between '" . $lunes->format("Y-m-d") . "' and '" . $domingo->format("Y-m-d") . "' and idAlumno=" . $filaAlumno["id"];
                            $resultadoClasesRealizadas = $conn->query($query);

                            //Consulta para saber el número de la última clase
                            $query = "SELECT * FROM clases WHERE idAlumno = '" . $filaAlumno["id"] . "'";
                            $resultadoNumeroClasesRealizadas = $conn->query($query);
                            $numeroClasesRealizadas = $resultadoNumeroClasesRealizadas->num_rows;



                            //echo $query;
                            $numFilasClasesRealizadas = $resultadoClasesRealizadas->num_rows;

                            //Cálculo de clases pendientes (Clases Horario - Clases Realizadas)
                            if ($numFilasClasesHorario > $numFilasClasesRealizadas) {
                                //Añadir filas de [filasClasesHorarios], descontando el número de filas que se han dado, por orden de fecha.

                                $contadorFilasPendientes = 0;
                                while ($filaClasesPendientes = $resultadoClasesHorario->fetch_assoc()) { //Filas de clases de horario pendiente por usuario.

                                    $contadorFilasPendientes++; //Se incrementa  contadorFilasPendientes
                                    if ($contadorFilasPendientes > $numFilasClasesRealizadas) { //Se muestran las clases pendiente, donde el contador de filas es mayor que el numero de filas totales de clases realizadas, no me interesa la información si es igual o menor, puesto que eso no lo tiene que mostrar.
                ?>
                                        <div class="bloqueCard">
                                            <form action="gestionClases.php" method="post">

                                                <div class="tituloEmpl"><?php echo "<b>(" . ++$numeroClasesRealizadas . ")</b> - " .
                                                                            $filaAlumno["nombre"] . " " . substr($filaAlumno["apellido1"], 0, 1) . "." //. substr($filaAlumno["apellido2"],0,1)."." 
                                                                        ?></div>
                                                <div class="grid">
                                                    <input type="text" name="id" value="<?php echo $filaAlumno["id"];
                                                                                        ?>" hidden>
                                                    <span class="subtitulo">Fecha</span>
                                                    <span class="informacion">
                                                        <input type="date" name="fecha" value="<?php
                                                                                                //Cálculo de fecha en función del día de la semana
                                                                                                $diaDeLaSemana = $hoy->format('N');


                                                                                                // Calcular la fecha del lunes (inicio de la semana)
                                                                                                $lunes = clone $hoy;

                                                                                                $diaConvertido = clone $hoy;
                                                                                                $diaConvertido->modify('-' . ($diaDeLaSemana - $filaClasesPendientes["diaSem"]) . ' days');
                                                                                                echo $diaConvertido->format("Y-m-d");
                                                                                                ?>"> (<?php echo $diaSem[$filaClasesPendientes["diaSem"]-1];?>)</span>
                                                </div>
                                                <div class="grid">
                                                    <span class="subtitulo">Horario</span>
                                                    <span class="informacion">
                                                        <div class="grid-3">
                                                            <div class="div_centrado"><input type="time" name="horaInicio" value="<?php echo $filaClasesPendientes["horaInicio"] ?>"></div>
                                                            <div class="div_centrado">-</div>
                                                            <div class="div_centrado"><input type="time" name="horaFin" value="<?php echo $filaClasesPendientes["horaFin"] ?>"> </div>

                                                        </div>
                                                    </span>
                                                </div>



                                                <!-- <div class="grid division">
                                                    <div class="subtitulo2">
                                                        <h3>INFORMACIÓN ADICIONAL</h3>
                                                    </div>


                                                    <span class="subtituloSin"><?php //echo $diasSemana[$fila2["diaSem"] - 1] 
                                                                                ?></span>
                                                    <span class="informacion"><?php //echo $fila2["horaInicio"] . " - " . $fila2["horaFin"]; 
                                                                                ?></span>


                                                    
                                                </div> -->
                                                <div class="grid-botones">
                                                    <!-- <input type="submit" name="informacion" class="boton editar" value="Ver Información" /> -->

                                                    <input type="submit" name="crearClase" class="boton editar" value="Finalizada" />
                                                </div>
                                            </form>
                                        </div>
                        <?php
                                    }
                                }
                            }
                        }






                        ?>




                <?php
                    }
                }
                ?>
                <div class="bloqueNuevo">
                    <a class="boton-especial" href="formularioClase.php">+ Clase</a>
                </div>


            </div>

        </div>
        <br>
        <br>
        <div class="titulo">
            <h3>CLASES FINALIZADAS</h3>
        </div>
        <div class="areaFlex">
            <div class="clases wrap  center color2">

                <?php
                //$hoy = new DateTime();

                $diaDeLaSemana = $hoy->format('N');

                // Calcular la fecha del lunes (inicio de la semana)
                $lunes = clone $hoy;
                $lunes->modify('-' . ($diaDeLaSemana - 1) . ' days');
                //echo "Lunes: " . $lunes->format("d/m/Y");

                // Calcular la fecha del domingo (último día de la semana)
                $domingo = clone $hoy;
                $domingo->modify('+' . (7 - $diaDeLaSemana) . ' days');
                //echo "Domingo: " . $domingo->format("d/m/Y");
                $query = "SELECT clases.id, alumnos.id as idAlumno, contenidoExplicado,nombre,apellido1,apellido2,fecha,horaDesde,horaHasta,ejerciciosRealizados FROM clases INNER JOIN alumnos on clases.idAlumno = alumnos.id  WHERE fecha between '" . $lunes->format("Y-m-d") . "' and '" . $domingo->format("Y-m-d") . "' ORDER BY idAlumno,fecha asc";
                //$query = "SELECT clases.id, alumnos.id as idAlumno, contenidoExplicado,nombre,apellido1,apellido2,fecha,DATE_FORMAT(horaDesde,'%H:%i') as horaDesde,horaHasta,ejerciciosRealizados FROM clases INNER JOIN alumnos on clases.idAlumno = alumnos.id  WHERE fecha between '" . $lunes->format("Y-m-d") . "' and '" . $domingo->format("Y-m-d") . "' ORDER BY idAlumno,fecha asc";

                //echo $query;
                $resultado = $conn->query($query);
                while ($filaClasesRealizadas = $resultado->fetch_assoc()) {
                ?>


                    <div class="bloqueCard amplio">
                        <form action="gestionClases.php" method="post">

                            <div class="tituloEmpl"><b>(<?php echo "Clase" ?>)</b> - <?php echo $filaClasesRealizadas["nombre"] . " " . substr($filaClasesRealizadas["apellido1"], 0, 1) . "." ?></div>

                            <div class="bloqueSeccion">
                                <p class="tituloSeccion"><span>CONTENIDO VISTO</span></p>

                                <div class="bloqueSubseccion">
                                    <span class="posibleEnlace"><?php echo str_replace("\n", "<br>", $filaClasesRealizadas["contenidoExplicado"]) ?></span>
                                </div>
                            </div>

                            <div class="bloqueSeccion">
                                <p class="tituloSeccion"><span>EJERCICIOS REALIZADOS</span></p>

                                <div class="bloqueSubseccion">
                                    <span class="posibleEnlace"><?php echo str_replace("\n", "<br>", $filaClasesRealizadas["ejerciciosRealizados"]) ?></span>
                                </div>
                            </div>


                            <!-- <div class="grid division">
                                                    <div class="subtitulo2">
                                                        <h3>INFORMACIÓN ADICIONAL</h3>
                                                    </div>


                                                    <span class="subtituloSin"></span>
                                                    <span class="informacion"></span>


                                                    
                                                </div> -->
                            <div class="grid-botones">
                                <input type="text" name="id" value="<?php echo $filaClasesRealizadas["idAlumno"] ?>" hidden>

                                <input type="text" name="fecha" value="<?php echo $filaClasesRealizadas["fecha"] ?>" hidden>
                                <input type="text" name="horaInicio" value="<?php echo $filaClasesRealizadas["horaDesde"] ?>" hidden>
                                <input type="text" name="horaFin" value="<?php echo $filaClasesRealizadas["horaHasta"] ?>" hidden>
                                <input type="text" name="idClase" value="<?php echo $filaClasesRealizadas["id"] ?>" hidden>
                                <input type="submit" name="editarClase" class="boton editar" value="Editar">
                                <input type="submit" name="verClase" class="boton editar" value="Ver Completa">
                                <input type="submit" name="enviarTG" class="boton editar" value="Enviar Telegram">
                            </div>
                        </form>
                    </div>

                <?php } ?>



                </form>
            </div>




            <script>
                cargarEventos();

                var elementos = document.querySelectorAll(".posibleEnlace");
                elementos.forEach(e => {

                    //Declaración de array
                    var palabras = e.innerHTML.split(" ");


                    //console.log("Cantidad de palabras: "+e.innerHTML.split(" ").length);
                    //Construccción innherHTML
                    finalTexto = "";
                    for (var i = 0; i < palabras.length; i++) {

                        if (palabras[i].startsWith("https://") || palabras[i].startsWith("http://") || palabras[i].startsWith("www://")) {

                            //Dividir enlace en parte del enlace (y siguiente) (Si está  junto un intro)
                            palabra0 = "";
                            palabra1 = "";
                            const cortar = palabras[i].indexOf('<'); //Inicio de br
                            if (cortar != -1) {
                                palabra0 = palabras[i].substring(0, cortar);
                                palabra1 = palabras[i].substring(cortar, palabras[i].length);
                                console.log("Palabra0: " + palabra0);
                                console.log("Palabra1: " + palabra1);

                            }

                            if (palabra0 != "") {
                                finalTexto += "<a href='" +
                                    palabra0 +
                                    "'>" + "(Enlace)" + "</a>" + palabra1;
                            } else {
                                console.log("enlace");
                                finalTexto += "<a href='" +
                                    palabras[i] +
                                    "'>" + "enlace" + "</a>";
                            }

                        } else {

                            if (i == palabras.length - 1) {
                                finalTexto += palabras[i];
                            } else {

                                finalTexto += (palabras[i] + " ");
                            }

                        }
                        e.innerHTML = finalTexto;


                    }

                    console.log("funciona");
                });
                

           </script>
        </div>
    </div>
    </div>

</body>

</html>