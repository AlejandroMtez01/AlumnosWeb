<?php
include "php/baseDeDatos.php";
session_start();


if (isset($_POST["editarAlumno"])) {
    header("Location: editarAlumnos.php?id=" . $_POST["id"]);
}
if (isset($_POST["eliminarAlumno"])) {
    //Para elimina un alumno es necesario: 
    //1. Que no está activo. (baja)

    /*$query = "SELECT * FROM empleados_departamento WHERE idEmpleado= '" . $_POST["id"] . "'";
    $resultado = $conn->query($query);
    $fila = $resultado->fetch_assoc();

    $query = "SELECT * FROM EMPLEADO WHERE id= " . $_POST["id"];
    $resultado2 = $conn->query($query);
    $fila2 = $resultado2->fetch_assoc();

    if (!isset($fila["id"])) {
        $query = "DELETE FROM usuarios WHERE idEmpleado= " . $_POST["id"] . "";
        $resultado = $conn->query($query);
        $query = "DELETE FROM EMPLEADO WHERE id= " . $_POST["id"] . "";
        $resultado = $conn->query($query);

        header("Location: empleados.php?informacionFinal=" . "<b>Éxito</b> Empleado <span>" . $fila2["nombre"] . " " . $fila2["apellido1"] . " " . $fila2["apellido2"] .  "</span> eliminado correctamente.");
    } else {
        header("Location: empleados.php?informacionFinal=" . "<b>Error</b> El empleado no se puede eliminar porque es o ha sido dado de alta en la empresa.");
    }*/
    $query = "DELETE FROM alumnos WHERE id= " . $_POST["id"] . "";
        $resultado = $conn->query($query);
        echo $query;
        header("Location: operacionesAlumnos.php?id=".$_POST["id"]."&eliminarAlumno= ");
}


if (isset($_POST["establecerHorario"])) {
    header("Location: establecerHorarioAlumno.php?id=" . $_POST["id"]);


    //header("Location: establecerHorarioAlumno.php?id=" . $_POST["id"]);
}
if (isset($_POST["editarHorario"])) {
    header("Location: editarHorarioAlumno.php?id=" . $_POST["id"]);


    //header("Location: establecerHorarioAlumno.php?id=" . $_POST["id"]);
}
if (isset($_POST["darAlta"])) {
    header("Location: dar_alta.php?id=" . $_POST["id"]);
}
if (isset($_POST["darBaja"])) {
    header("Location: dar_baja.php?id=" . $_POST["id"]);
}

if (isset($_POST["clases"])){
    header("Location: clases.php?idAlumno=". $_POST["id"]);

}
