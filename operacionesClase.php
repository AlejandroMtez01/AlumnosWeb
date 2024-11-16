<?php
include "php/baseDeDatos.php";

if (isset($_POST["crearClase"])) {

    $sql = "INSERT INTO clases (
        idAlumno,
        fecha,
        horaDesde,
        horaHasta,
        contenidoExplicado,
        ejerciciosRealizados,
        observacionesProximaClase,
        dificultad,
        evolucion
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";

    // Preparar la consulta
    
    $stmt = $conn->prepare($sql);

    echo $sql;
    print_r($_POST);
    echo "<br>";





    $stmt->bind_param(
        "issssssss",

        $_POST['id'],
        $_POST['fecha'],
        $_POST['horaInicio'],
        $_POST['horaFin'],
        $_POST['contenidoExplicado'],
        $_POST['ejerciciosRealizados'],
        $_POST['observacionesProximaClase'],
        $_POST['dificultad'],
        $_POST['evolucion']
    );


    $resultadoTexto = "";
    // Ejecutar la consulta
    if ($stmt->execute()) {
        $resultadoTexto =  "Clase creada correctamente.";
    } else {
        $resultadoTexto= "Error al insertar el registro: " . $stmt->error. "<br> Consulta: ".$sql;
    }

    
    header("Location: clases.php?exito=".$resultadoTexto);
    $stmt->close();
}