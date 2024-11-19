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

    ?>

    <?php
    if (isset($_POST["editarAlumno"])) {
        header("Location: editarAlumno.php?id=" . $_POST["id"]);
    }


    if (isset($_GET["eliminarEmpleado"])) {
        $query = "DELETE FROM ALUMNOS WHERE ID= " . $_POST["id"];
        $resultado7 = $conn->query($query);
        //$query = "DELETE FROM USUARIOS WHERE idempleado=" . $_GET["eliminarEmpleado"];
        //$resultado8 = $conn->query($query);
    }







    //$query = "DELETE FROM USUARIOS WHERE idempleado=" . $_GET["eliminarEmpleado"];
    //$resultado8 = $conn->query($query);
    //}



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
        <div class="titulo">
            <h2>ALUMNOS</h2>
        </div>
        <div class="informacion">
            <div class="bloqueInformacionFinal">
                <span>
                    <?php
                    if (isset($_GET["informacionFinal"])) {
                        echo $_GET["informacionFinal"];
                    }
                    ?>
                </span>
            </div>
        </div>

        <div class="areaFlex">

            <div class="empleados">
                <?php


                //Creación de algoritmo para mostrar todas las clases pendientes de la semana.
                //Comprueba por alumno, [cuantas clases a la semana tiene] y [cuantas clases han dado]

                $query = 'SELECT * FROM alumnos ORDER BY id';
                $resultado = $conn->query($query);
                if ($resultado->num_rows > 0) {
                    // Iterar sobre cada alumno
                    while ($fila = $resultado->fetch_assoc()) {
                        






              

                ?>
                        <div class="bloqueCard">
                            <form action="gestionAlumnos.php" method="post">

                                <div class="tituloEmpl"><b><?php echo "(" . $fila["id"] . ")"; ?></b></div>
                                <div class="grid">
                                    <span class="subtitulo">Nombre</span>
                                    <span class="informacion"><?php echo $fila["nombre"]; ?></span>
                                    <span class="subtitulo">Apellidos</span>
                                    <span class="informacion"><?php echo $fila["apellido1"] . " " . $fila["apellido2"]; ?></span>
                                    <!-- <span class="subtitulo">Email Personal</span>
                                    <span class="informacion"><?php //echo $fila["email"]; 
                                                                ?> </span> -->
                                    <span class="subtitulo">Teléfono</span>
                                    <span class="informacion"><?php echo $fila["telefono"]; ?> </span>
                                    <span class="subtitulo">Localidad</span>
                                    <span class="informacion"><?php echo $fila["localidad"] . " (" . $fila["provincia"] . ")"; ?></span>
                                    <span class="subtitulo">Fecha Nac.</span>
                                    <span class="informacion">
                                        <?php if ($fila["fechaNacimiento"] != "0000-00-00") {
                                            echo date("d/m/Y", strtotime($fila["fechaNacimiento"]));
                                        } ?>
                                    </span>
                                    <!-- <span class="subtitulo">Estado</span>
                                    <span class="informacion">
                                        <?php
                                        // $query = 'SELECT * FROM empleados_departamento WHERE idEmpleado= ' . $fila["id"] . " and fechaBaja is null";
                                        // $resultado1 = $conn->query($query);
                                        // $fila1 = $resultado1->fetch_assoc();
                                        // if (!isset($fila1["id"])) {
                                        //     echo "Baja";
                                        // } else {
                                        //     echo "Activo";
                                        // }
                                        echo "X"
                                        ?>
                                    </span> -->
                                    <span class="subtitulo">Curso Actual</span>
                                    <?php
                                    $query = 'SELECT * FROM CURSOSALUMNOS INNER JOIN alumnos on cursosalumnos.idAlumno = alumnos.id INNER JOIN cursos ON cursos.id = cursosalumnos.idCurso WHERE idAlumno=' . $fila["id"] . ';';
                                    $resultado2 = $conn->query($query);
                                    $fila2 = $resultado2->fetch_assoc();

                                    
                                    ?>
                                    <span class="informacion" data-tooltip="<?php echo $fila2["nombreCurso"] ?>"><?php echo $fila2["abrevCurso"] . " (" . $fila2["año"] . ")"; ?> </span>
                                </div>

                                <div class="grid division">
                                    <div class="subtitulo2">
                                        <h3>CLASES SEMANALES</h3>
                                    </div>
                                    <?php
                                    $query = 'SELECT diaSem, TIME_FORMAT(horaInicio, "%H:%i") as horaInicio,TIME_FORMAT(horaFin, "%H:%i") as horaFin FROM horarioAlumnos WHERE idAlumno= ' . $fila["id"]. " ORDER BY diaSem ASC";

                                    $resultado2 = $conn->query($query);
                                    while ($fila2 = $resultado2->fetch_assoc()) {

                                        $diasSemana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];


                                    ?>

                                        <span class="subtitulo"><?php echo $diasSemana[$fila2["diaSem"] - 1] ?></span>
                                        <span class="informacion"><?php echo $fila2["horaInicio"] . " - " . $fila2["horaFin"]; ?></span>
                                    <?php }

                                    if ($resultado2->num_rows == 0) {

                                    ?>
                                        <!-- <span class="subtitulo">No día</span>
                                        <span class="informacion">00:00 - 00:00</span>
                                        <span class="subtitulo">No día</span>
                                        <span class="informacion">00:00 - 00:00</span> -->


                                    <?php } else if ($resultado2->num_rows == 1) {

                                    ?>
                                        <!-- <span class="subtitulo">No día</span>
                                                                               <span class="informacion">00:00 - 00:00</span> -->

                                    <?php }  ?>


                                    <input type="text" name="id" value="<?php echo $fila["id"]; ?>" hidden>
                                </div>
                                <div class="grid-botones">
                                    <input type="submit" name="editarAlumno" class="boton editar" value="Editar Alumno" />
                                    <!-- <input type="submit" name="editarEmpleado" class="boton editar" value="Editar Empleado" href="<?php echo "editarAlumno.php?id=" . $fila["id"]; ?>" /> -->
                                    <input type="submit" name="eliminarAlumno" class="boton eliminar" value="Eliminar Alumno" href="<?php echo "operacionesAlumnos.php?id=" . $fila["id"]; ?>" />
                                    <!-- <input type="submit" name="darAlta" class="boton alta" value="Dar Alta" href="<?php echo "dar_alta.php?id=" . $fila["id"]; ?>" <?php
                                                                                                                                                                        //  $query = 'SELECT * FROM empleados_departamento WHERE idEmpleado= ' . $fila["id"] . " and fechaBaja is null";
                                                                                                                                                                        //  $resultado3 = $conn->query($query);
                                                                                                                                                                        //  $fila3 = $resultado3->fetch_assoc();

                                                                                                                                                                        //  if (isset($fila3["id"])) {
                                                                                                                                                                        //      echo "disabled";
                                                                                                                                                                        //  }
                                                                                                                                                                        ?> />

                                    <input type="submit" name="darBaja" class="boton baja" value="Dar Baja" href="<?php echo "dar_baja.php?id=" . $fila["id"]; ?>" <?php
                                                                                                                                                                    // $query = 'SELECT * FROM empleados_departamento WHERE idEmpleado= ' . $fila["id"] . " and fechaBaja is null";
                                                                                                                                                                    // $resultado3 = $conn->query($query);
                                                                                                                                                                    // $fila3 = $resultado3->fetch_assoc();

                                                                                                                                                                    // if (!isset($fila3["id"])) {
                                                                                                                                                                    //     echo "disabled";
                                                                                                                                                                    // }
                                                                                                                                                                    ?> />

-->

                                    <?php

                                    if ($resultado2->num_rows == 0) { ?>
                                        <input type="submit" name="establecerHorario" class="boton alta" value="Establecer Horario" />

                                    <?php
                                    } else { ?>
                                        <input type="submit" name="editarHorario" class="boton alta" value="Editar Horario" />


                                    <?php } ?>
                                    <input type="submit" name="clases y progreso" class="boton baja" value="Clases y Progeso" />

                                </div>
                            </form>
                        </div>



                <?php
                    }
                }
                ?>
                <div class="bloqueNuevo">
                    <a class="boton-especial" href="crearAlumno.php">+ Nuevo Alumno</a>
                </div>


                <?php
                //}
                //}
                ?>

            </div>

        </div>




    </div>
   
        
    <script>
        cargarEventos();
    </script>

</body>

</html>