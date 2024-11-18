<?php 
include 'php/telegram.php';
if (isset($_POST["crearClase"])) {
    header("Location: formularioClase.php?id=" . $_POST["id"]."&fecha=". $_POST["fecha"]."&horaInicio=". $_POST["horaInicio"]."&horaFin=".$_POST["horaFin"] );
}
if (isset($_POST["editarClase"])) {
    header("Location: formularioClase.php?id=" . $_POST["id"]."&fecha=". $_POST["fecha"]."&horaInicio=". $_POST["horaInicio"]."&horaFin=".$_POST["horaFin"]."&idClase=".$_POST["idClase"]);
}

if (isset($_POST["verClase"])) {
    header("Location: formularioClase.php?id=" . $_POST["id"]."&fecha=". $_POST["fecha"]."&horaInicio=". $_POST["horaInicio"]."&horaFin=".$_POST["horaFin"]."&idClase=".$_POST["idClase"]."&bloqueado=Si");
}
if (isset($_POST["enviarTG"])) {
    enviarMensajeTelegram();
    header("Location: clases.php?exito=Mensaje envíado con éxito vía Telegram.");

}

?>