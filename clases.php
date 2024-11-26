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

    //if (!isset($_SESSION["id"])) {
    //    header("Location: login.php");
    //}
    $hoy = new DateTime();
    //$hoy->modify('-' . 7 . ' days'); //Prueba para, la siguiente semana.

    ?>

    <?php

    $alumnoInicializado = isset($_GET["idAlumno"]);

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
        <div class="exito"><?php if (isset($_GET["exito"])) {
                                echo $_GET["exito"];
                            } ?></div>


        <div class="areaFlex">
            <div class="titulo">

                <h3>CLASES <select name="alumno">
                        <option value="">Todos </option>
                        <?php

                        $query = "SELECT * FROM alumnos ORDER BY id asc";

                        $resultado = $conn->query($query);
                        while ($filasAlumnos = $resultado->fetch_assoc()) {
                            echo $query;
                        ?>
                            <option <?php if ($alumnoInicializado && $filasAlumnos["id"] == $_GET["idAlumno"]) {
                                        echo "selected";
                                    } ?> value="<?php echo $filasAlumnos["id"] ?>"><?php echo $filasAlumnos["nombre"] . " " . $filasAlumnos["apellido1"] . " " . $filasAlumnos["apellido2"]; ?></option>
                        <?php
                        }
                        ?>

                    </select> </h3>
            </div>


            <?php


            if ($alumnoInicializado) {
                $query = "SELECT * FROM alumnos WHERE id= " . $_GET["idAlumno"] . " ORDER BY id asc";
            } else {
                $query = "SELECT * FROM alumnos ORDER BY id asc";
            }
            $resultado = $conn->query($query);
            while ($filasAlumnos = $resultado->fetch_assoc()) {

            ?>

                <div class="clasesPadre colorFondo1">
                    <h4><span><?php echo $filasAlumnos["nombre"] . " " . $filasAlumnos["apellido1"] . " " . $filasAlumnos["apellido2"] ?></span></h4>

                    <div class="clases wrap center">

                        <?php

                        $query = 'SELECT clases.id as idClase, idAlumno, observacionesProximaClase,contenidoExplicado,ejerciciosRealizados,fecha,horaDesde,horaHasta,dificultad,evolucion,nombre,apellido1,apellido2 FROM clases INNER JOIN alumnos on clases.idAlumno=alumnos.id WHERE idAlumno = ' . $filasAlumnos["id"] . ' ORDER BY clases.id  ';
                        $resultado1 = $conn->query($query);
                        $contadorClasePorAlumno = 0;
                        while ($filaClasesRealizadas = $resultado1->fetch_assoc()) {

                        ?>


                            <div class="bloqueCard-Completo color1">
                                <form action="gestionClases.php" method="post">



                                    <div class="tituloEmpl"><b>(<?php echo "Clase" ?> <?php echo ++$contadorClasePorAlumno; ?>)</b></div>
                                    <div class="grid-2">

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
                                    </div>

                                    <div class="grid-2">

                                        <div class="bloqueSeccion">
                                            <p class="tituloSeccion"><span>EVOLUCIÓN</span></p>

                                            <div class="bloqueSubseccion">
                                                <span class="posibleEnlace"><?php echo str_replace("\n", "<br>", $filaClasesRealizadas["evolucion"]) ?></span>
                                            </div>
                                        </div>
                                        <div class="bloqueSeccion">
                                            <p class="tituloSeccion"><span>DIFICULTAD</span></p>

                                            <div class="bloqueSubseccion">
                                                <span class="posibleEnlace"><?php echo str_replace("\n", "<br>", $filaClasesRealizadas["dificultad"]) ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid-botones">
                                        <input type="text" name="id" value="<?php echo $filaClasesRealizadas["idAlumno"] ?>" hidden>

                                        <input type="text" name="fecha" value="<?php echo $filaClasesRealizadas["fecha"] ?>" hidden>
                                        <input type="text" name="horaInicio" value="<?php echo $filaClasesRealizadas["horaDesde"] ?>" hidden>
                                        <input type="text" name="horaFin" value="<?php echo $filaClasesRealizadas["horaHasta"] ?>" hidden>
                                        <input type="text" name="idClase" value="<?php echo $filaClasesRealizadas["idClase"] ?>" hidden>
                                        <input type="submit" name="editarClase" class="boton azulClaro" value="Editar">
                                        <input type="submit" name="verClase" class="boton azulClaro" value="Ver Completa">
                                        <input type="submit" name="enviarTG" class="boton azulClaro" value="Enviar Telegram">
                                    </div>
                                </form>
                            </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
                <br>
            <?php
            } ?>





        </div>

    </div>

    </div>
    <script>
        //Obtenemos el SELECT.
        select = document.querySelectorAll("select[name='alumno']")[0];

        select.addEventListener('change', function () {
        const valorSeleccionado = this.value; // Obtiene el valor del select
        const url = new URL(window.location.href); // Obtiene la URL actual
        if (valorSeleccionado) {
            url.searchParams.set('idAlumno', valorSeleccionado); // Agrega/modifica el parámetro "alumno"
        } else {
            url.searchParams.delete('idAlumno'); // Elimina el parámetro si se selecciona "Todos"
        }
        window.location.href = url.toString(); // Recarga la página con la nueva URL
    });

    </script>
</body>

</html>