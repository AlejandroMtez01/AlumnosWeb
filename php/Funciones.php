<?php
function obtenerEstilo2($num)
{
    for ($i = 7; $i > 0; $i--) {
        if ($num % $i == 0) {
            return $i;
        }
    }
}
function obtenerEstilo($num)
{
    $copiaNum = $num;

    //Los id de colores tienen un total de 7 estilos diferentes, por ende, vamos a obtener un número negativo y le vamos a sumar 7 para que veamos de que id se trata
    while ($copiaNum > 0) {
        $copiaNum = $copiaNum - 7;
    }
    return $copiaNum + 7;
}
function obtenerMesAbreviado($fecha)
{
    $meses = ["ENE.", "FEB.", "MAR.", "ABR.", "MAY.", "JUN.", "JUL.", "AGO.", "SEP.", "OCT.", "NOV.", "DIC."];
    return $meses[$fecha->format("n") - 1];
}
function obtenerDiasDiferenciaFechas($fecha1, $fecha2)
{
    $diferenciaFechas = $fecha1->diff($fecha2);
    return $diferenciaFechas->format("%a");
}
function obtenerArrayFechasAusencia1($fecha1, $fecha2)
{
    $fechaObjetivo = $fecha1;
    $arrayFechas = [new DateTime($fechaObjetivo->format("Y-m-d"))];
    while ($fechaObjetivo != $fecha2) {
        $fechaObjetivo->add(new DateInterval('P1D'));
        array_push($arrayFechas, new DateTime($fechaObjetivo->format("Y-m-d")));
    }


    return $arrayFechas;
}
/**
 * @param array $fechas Es el array que contiene todas las fechas.
 * @param DateTime $fecha1 Es la primera fecha que incluye la función. 
 * @param DateTime $fecha2 Es la última fecha que incluye la función.
 * @return array Devuelve el array $fechas incrementado en más fechas.
 */
function obtenerArrayFechasAusencia($fechas, $fecha1, $fecha2)

{
    $fechaInicial = new DateTime($fecha1->format("Y-m-d"));

    //La fechaFinal se incrementará un día por encima de la fechaFinal, de forma que cuando fechaObjetivo sea igual que la fechaFinal no entre en el While
    $fechaFinal = (new DateTime($fecha2->format("Y-m-d")))->add(new DateInterval('P0D'));
    $fechaObjetivo = new DateTime($fecha1->format("Y-m-d"));

    //Se incluye la fechaInicial
    array_push($fechas, new DateTime($fechaInicial->format("Y-m-d")));
    //echo "Añadido ".$fechaInicial->format("Y-m-d");



    while ($fechaObjetivo != $fechaFinal) {
        $fechaObjetivo->add(new DateInterval('P1D'));
        array_push($fechas, new DateTime($fechaObjetivo->format("Y-m-d")));
    }



    return $fechas;
}

function obtenerArrayValorAusencia($arrayFechas, $valor)


{
    $nuevoArray = [];

    for ($i = 0; $i < count($arrayFechas); $i++) {
        array_push($nuevoArray, $valor);
    }


    return $nuevoArray;
}
function obtenerArrayEstadoAusencias($fecha1, $fecha2, $estado)
{
    $fechaObjetivo = $fecha1;
    $arrayEstados = [$estado];
    while ($fechaObjetivo != $fecha2) {
        $fechaObjetivo->add(new DateInterval('P1D'));
        array_push($arrayEstados, $estado);
    }
    return $arrayEstados;
}
function obtenerArrayidAusencias($fecha1, $fecha2, $id)
{
    $fechaObjetivo = $fecha1;
    $arrarEstados = [$id];
    while ($fechaObjetivo != $fecha2) {
        $fechaObjetivo->add(new DateInterval('P1D'));
        array_push($arrarEstados, $id);
    }

    return $arrarEstados;
}

function crearArrayBirthday($fechaMes,$conn){
    $arrayNuevo = [];

    $fechaMes->format("m");

    $query = "SELECT * FROM empleado WHERE fechaNacimiento Like '%-".$fechaMes->format("m")."-%'";


    $resultado = $conn->query($query);


    $fechasDestacadas = [];
    $nombreEmpleados = [];
    $numeroAños = [];
    $hoy = new DateTime();



    //Generación de días de ausencia
    while ($empleado = $resultado->fetch_assoc()) {
        
        $fecha = new DateTime($empleado["fechaNacimiento"]);
        

        if  (strlen((strval($fecha->format("m")))==1)){
            $mes = "0".strval($fecha->format("m"));

        }else{
            $mes = strval($fecha->format("m"));
        }
        
        $fechaEdad = new DateTime($hoy->format("Y") ."-".$mes . $fecha->format("-d"));
        //echo (new DateTime($hoy->format("Y").$mes . $fecha->format("-d")))->format("d/m/Y");
        $edad = intval($hoy->format("Y"))-intval($fecha->format("Y"));

        array_push($fechasDestacadas,$fechaEdad);
        array_push($nombreEmpleados,$empleado["nombre"] . " " . $empleado["apellido1"] . " " . $empleado["apellido2"]) ;
        array_push($numeroAños,$edad);

    }
    $arrayNuevo=[$fechasDestacadas,$nombreEmpleados,$numeroAños];

    return $arrayNuevo;
}

function crearArrayAniversario($fechaMes,$conn){
    $arrayNuevo = [];

    $fechaMes->format("m");

    $query = "SELECT nombre,apellido1,apellido2,fechaAlta FROM empleados_departamento INNER JOIN empleado on empleado.id = empleados_departamento.idEmpleado WHERE fechaAlta Like '%-".$fechaMes->format("m")."-%' and fechaBaja is null order by fechaAlta asc" ;
    //echo $query;


    $resultado = $conn->query($query);


    $fechasDestacadas = [];
    $nombreEmpleados = [];
    $numeroAños = [];
    $hoy = new DateTime();



    //Generación de días de ausencia
    while ($empleado = $resultado->fetch_assoc()) {
        
        $fecha = new DateTime($empleado["fechaAlta"]);
        

        /*if  (strlen((strval($fecha->format("m")))==1)){
            $mes = strval($fecha->format("m"));

        }else{*/
            $mes = strval($fecha->format("m"));
        //}
        
        $fechaEdad = new DateTime($hoy->format("Y") ."-".$mes . $fecha->format("-d"));
        //echo (new DateTime($hoy->format("Y").$mes . $fecha->format("-d")))->format("d/m/Y");
        $edad = intval($hoy->format("Y"))-intval($fecha->format("Y"));

        array_push($fechasDestacadas,$fechaEdad);
        array_push($nombreEmpleados,$empleado["nombre"] . " " . $empleado["apellido1"] . " " . $empleado["apellido2"]) ;
        array_push($numeroAños,$edad);

    }
    $arrayNuevo=[$fechasDestacadas,$nombreEmpleados,$numeroAños];

    return $arrayNuevo;
}
function obtenerNombreyApellidosUsuario($idAlumno, $conn)
{
    $query = 'SELECT * FROM alumnos where id = ' . $idAlumno;
    $resultado = $conn->query($query);
    $fila = $resultado->fetch_assoc();


    return $fila["nombre"] . " " . $fila["apellido1"] . " " . $fila["apellido2"];
}
function obtenerNumeroClaseSiguiente($idAlumno, $conn)
{
    $query = 'SELECT * FROM clases  where idAlumno = ' . $idAlumno;
    $resultado = $conn->query($query);
    $numFilas = $resultado->num_rows;


    return ++$numFilas; //Lo incremento, puesto que necesitamos el número siguiente de clase
}
function obtenerNumeroClase($idAlumno,$idClase, $conn)
{
    $query = 'SELECT * FROM clases  where idAlumno = ' . $idAlumno.' and id <='.$idClase;
    $resultado = $conn->query($query);
    //echo $query;
    $numFilas = $resultado->num_rows;


    return $numFilas; //Lo incremento, puesto que necesitamos el número siguiente de clase
}