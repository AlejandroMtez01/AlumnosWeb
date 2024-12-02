<?php
include "php/baseDeDatos.php";
include "php/Funciones.php";

if (isset($_GET["eliminarAlumno"])) {
    $nombreYapellidos= obtenerNombreyApellidosUsuario($_GET["id"],$conn);



    $query = "DELETE FROM cursosAlumnos WHERE idAlumno= " . $_GET["id"];
    $resultado7 = $conn->query($query);
    echo $query."<br>";

    $query = "DELETE FROM horarioAlumnos WHERE idAlumno= " . $_GET["id"];
    $resultado7 = $conn->query($query);
    echo $query."<br>";

    $query = "DELETE FROM ALUMNOS WHERE ID= " . $_GET["id"];
    $resultado7 = $conn->query($query);
    echo $query."<br>";

    header("Location: alumnos.php?exito=El alumno $nombreYapellidos ha sido eliminado correctamente.");


}

if (isset($_POST["submitEditar"])) {
    //Actualizacion tabla 'alumno'
    $query = 'UPDATE alumnos SET nombre="' . $_POST["nombre"] . '", apellido1="' . $_POST["apellido1"] . '", apellido2="' . $_POST["apellido2"] . '", localidad="' . $_POST["localidad"] . '", provincia="' . $_POST["provincia"] . '", telefono="' . $_POST["telefono"]   . '", fechaNacimiento="' . $_POST["fechaNacimiento"] . '" WHERE ID=' . $_POST["id"].";";
    $resultado2 = $conn->query($query);
    echo $query;

    //Actualización tabla ''

    $query = 'UPDATE cursosalumnos SET idCurso="' . $_POST["idCurso"] . '", promocion="' . $_POST["promocion"] . '", año="' . $_POST["yearCurso"] . '" WHERE idAlumno=' . $_POST["id"];
    $resultado2 = $conn->query($query);
    echo $query;

    header("Location: alumnos.php?exito=El alumno ".obtenerNombreyApellidosUsuario($_POST["id"],$conn). " ha sido editado correctamente.");

}

if (isset($_POST["submitCrear"])) {
    $query = "INSERT INTO ALUMNOS (nombre,apellido1,apellido2,email,telefono,fechaNacimiento,provincia,localidad) 
    VALUES ('" . $_POST["nombre"] . "','" . $_POST["apellido1"] . "', '" . $_POST["apellido2"] . "', '" . $_POST["email"] . "', '" . $_POST["telefono"] . "', '" .
        $_POST["fechaNacimiento"] . "', '" . $_POST["provincia"] . "', ' " . $_POST["localidad"] . "')";
    $resultado6 = $conn->query($query);

    echo $query."<br>";


    $query = "SELECT * FROM ALUMNOS WHERE nombre='". $_POST["nombre"]  . "' and apellido1='".$_POST["apellido1"] ."'"." and apellido2='".$_POST["apellido2"] ."'".";";
    $resultado = $conn->query($query);
    $fila = $resultado->fetch_assoc();
    echo $query." e".$fila["id"]."<br>";



    $query = "INSERT INTO CURSOSALUMNOS (idAlumno,idCurso,promocion,año) 
    VALUES ('" . $fila["id"] . "'," . $_POST["idCurso"] . ", '" . $_POST["promocion"] . "', '". $_POST["yearCurso"] . "');";
    $resultado6 = $conn->query($query);

    header("Location: alumnos.php?exito=El alumno ".obtenerNombreyApellidosUsuario($fila["id"],$conn). " ha sido creado correctamente.");


}


if (isset($_POST["submitEditarHorarioAlumno"])) {

    //Comprobar cuantos valores existen en base de datos
    $query = 'SELECT * FROM horarioalumnos where idAlumno = ' . $_POST["idAlumno"];
    $resultado = $conn->query($query);

    $valoresBBDD = $resultado->num_rows;

    $valoresPOST = 0;

    $valoresParaMostrar = 0;


    //Comprobar cuantos valores existen en POST
    for ($i = 1; $i <= 10; $i++) {



        if (isset($_POST["diaSem$i"])) {
            $valoresPOST++;
        }
    }
    


    echo "Los valores de BBDD son: $valoresBBDD 
    <br> Los valores de POST son: $valoresPOST.";

    //En caso de que sean los mismos valores en BBDD que POST
    if ($valoresBBDD == $valoresPOST) {
        for ($i = 1; $i <= $valoresPOST; $i++) {
            $query = "UPDATE  horarioalumnos set horaInicio= '" . $_POST["horaInicio$i"] . "', horaFin='" . $_POST["horaFin$i"] . "',diaSem=" . $_POST["diaSem$i"] . " where id = " . $_POST["id" . $i] . ";";
            $resultado6 = $conn->query($query);
            $valoresParaMostrar = $valoresBBDD;
        }
        header("Location: alumnos.php?exito=El horario de ".obtenerNombreyApellidosUsuario($_POST["idAlumno"],$conn). " ha sido actualizado correctamente.");

    } else 
    if ($valoresBBDD > $valoresPOST) { //Se han eliminado valores
        $valoresParaMostrar = $valoresBBDD;
        $variableIn = "(";
        for ($i=1; $i <= $valoresParaMostrar ; $i++) { 
            
            if (isset($_POST["id$i"])){
                $variableIn= $variableIn.$_POST["id$i"].",";
                //echo $_POST["id$i"];
            }
        }
        $variableIn = substr($variableIn,0,strlen($variableIn)-1);
        $variableIn = $variableIn .")";

        $query = 'DELETE FROM horarioalumnos where idAlumno = ' . $_POST["idAlumno"] . " and id not in ".$variableIn. ";";
        echo $query;
        $resultado = $conn->query($query);
        

        $filasEliminadas = $conn->affected_rows;;
        header("Location: alumnos.php?exito=El horario de ".obtenerNombreyApellidosUsuario($_POST["idAlumno"],$conn). " ha sido eliminado correctamente. ($filasEliminadas registros)");

        


    } else if ($valoresBBDD < $valoresPOST) { //Se han agregado valores
        for ($i = 1; $i <= $valoresPOST; $i++) {
            if ($_POST["id$i"] == " ") {
                $query = "INSERT INTO horarioalumnos (idAlumno,diaSem,horaInicio,horaFin) 
                VALUES ('" . $_POST["idAlumno"] . "','" . $_POST["diaSem$i"] . "', '" . $_POST["horaInicio$i"] . "', '" . $_POST["horaFin$i"] . "')";
                echo $query;
                $resultado6 = $conn->query($query);
            } else {
                $query = "UPDATE  horarioalumnos set horaInicio= '" . $_POST["horaInicio$i"] . "', horaFin='" . $_POST["horaFin$i"] . "',diaSem=" . $_POST["diaSem$i"] . " where id = " . $_POST["id" . $i] . ";";
                $resultado6 = $conn->query($query);
            }
            //$resultado6 = $conn->query($query);
            $valoresParaMostrar = $valoresBBDD;
        }


        $valoresParaMostrar = $valoresPOST;
        header("Location: alumnos.php?exito=El horario de ".obtenerNombreyApellidosUsuario($_POST["idAlumno"],$conn). " ha sido actualizado correctamente. ($valoresParaMostrar registros actualizados)");

    }



}
if (isset($_POST["submitCrearHorarioAlumno"])) {
    $numRegistros = 0;

    //Máximo valor 10
    for ($i = 0; $i < 10; $i++) {


        if (isset($_POST["diaSem$i"])) {
            $query = "INSERT INTO horarioalumnos (idAlumno,diaSem,horaInicio,horaFin) 
        VALUES ('" . $_POST["id"] . "','" . $_POST["diaSem$i"] . "', '" . $_POST["horaInicio$i"] . "', '" . $_POST["horaFin$i"] . "')";
            $resultado6 = $conn->query($query);
            $numRegistros = $i;
        }
    }
    header("Location: alumnos.php?exito=El horario de " . obtenerNombreyApellidosUsuario($_POST["id"], $conn) . " Ha sido creado correctamente. ($numRegistros registros insertados)");
}
