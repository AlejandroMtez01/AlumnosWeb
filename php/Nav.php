
<script>
    crearNav("<?php echo $_SESSION["nombre"] . " " . $_SESSION["apellido1"] ?>", <?php echo obtenerEstilo($_SESSION["idEmpleado"]); ?>,
        <?php if ($_SESSION["idPermiso"] <= 2) {
            echo true;
        } else {
            echo false;
        }  ?>);
    //Detectar página activa e implementar active a elemento

    var nombrePagina = "<?php echo basename(__FILE__, '.php'); ?>"
    activarElemento(nombrePagina);
</script>