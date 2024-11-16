<?php if (isset($_POST["crearClase"])) {
    echo "Location: crearClase.php?id=" . $_POST["id"]."&fecha=". $_POST["fecha"]."&horaInicio=". $_POST["horaInicio"]."&horaFin=".$_POST["horaFin"] ;
    header("Location: crearClase.php?id=" . $_POST["id"]."&fecha=". $_POST["fecha"]."&horaInicio=". $_POST["horaInicio"]."&horaFin=".$_POST["horaFin"] );
}
?>