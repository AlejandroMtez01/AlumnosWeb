<?php

include "php/baseDeDatos.php";
include "php/Funciones.php";
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
$_SESSION["pagina"] = basename(__FILE__, '.php');

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
}


