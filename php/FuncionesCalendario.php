<meta charset="UTF-8">

<?php


function generarCalendario($fecha, $arrayCompleto, $arrayBirthday, $arrayAniversario)
{

    //Variable que recoge la fecha actual
    $fechaActual = (new DateTime())->format("d/m/Y");

    //Variable que el último día del mes, en referencia a la variable $fecha (Obtenida o bien de variables GET o bien del mes y año actual)


    //Variable que contiene el primer día del mes en base a la varable $fecha
    $primerDia = (new DateTime())
        ->createFromFormat('d/m/Y', '01/' . $fecha->format("m") . "/" . $fecha->format("Y"));

    //Variable que contiene el último día del mes en base a la varable $fecha
    $ultimoDia = (new DateTime())
        ->createFromFormat('d/m/Y', $fecha->format("t") . '/' . $fecha->format("m") . "/" . $fecha->format("Y"));

    $primerDiaMes = $primerDia->format("d/m/Y");
    $ultimoDiaMes = $ultimoDia->format("t/m/Y");


    //Se resta 1, porque empieza por 0, siendo 0 Domingo
    $diaSemanaPrimerDia = $primerDia->format("w") - 1;
    //Para no obviar el domingo asignamos el valor 6.
    //En caso de domingo tendrá que generar 6 días anteriores, puesto que tendremos de Lunes a Sábado (6 días) + el día del mes Domingo
    //Sustituimos el valor -1, que es domingo, por 6, que son los días que tendrá que generar
    if ($diaSemanaPrimerDia == -1) $diaSemanaPrimerDia = 6;

    //Días totales que tiene el mes
    $totalDias = $primerDia->format("t");
    //Último día de la semana
    $diaSemanaUltimoDia = $ultimoDia->format("w");
    //Si es domingo se le asigna un 7, puesto que empezaría la semana por Lunes 0
    if ($diaSemanaUltimoDia == 0) $diaSemanaUltimoDia = 7;

    //Los días totales del mes a mostrar = 
    //(Los primeros días de la semana desde el Lunes hasta que empieza el mes) + (El número total de día del mes) + (La diferencia entre el día de la semana que termina el mes y la semana completa) 
    $totalDiasMes = $diaSemanaPrimerDia + $totalDias + (7 - $diaSemanaUltimoDia);



    for ($i = 0; $i < $totalDiasMes; $i++) {
        $sumaDias = $diaSemanaPrimerDia - $i;
        $excesoMes = $diaSemanaPrimerDia + $totalDias;
        $signo = $i - $diaSemanaPrimerDia;
        $generalClaseEspecial = "";
        $textoClaseEspecial = "";
        // echo "<div>".$sumaDias."</div>";

        $dia = (new DateTime())
            ->createFromFormat('d/m/Y', '01/' . $fecha->format("m") . "/" . $fecha->format("Y"));
        $diaCopia = $dia;
        if (($signo) < 0) {
            // echo "<div>Restando " . abs($sumaDias) . " <br>[Información] $diaSemanaPrimerDia - $i<br></div>";
            $textoClaseEspecial = "fueraMes";

            $diaCopia->sub(new DateInterval('P' . abs($sumaDias) . 'D'));
        } else if (($signo) == 0) {
            //echo "<div>Igualando " . abs($sumaDias) . " <br>[Información] $diaSemanaPrimerDia - $i</div>";
        } else if (($signo) > 0) {
            // echo "<div>Sumando " . abs($sumaDias) . " <br>[Información] $diaSemanaPrimerDia - $i</div>";

            $diaCopia->add(new DateInterval('P' . abs($sumaDias) . 'D'));
        }

        //Añadir exceso de días
        if ($i - $excesoMes >= 0) {
            $textoClaseEspecial = $textoClaseEspecial . " fueraMes";
        }

        //Añadir clase "actual" a div contenedor  
        if ($diaCopia->format("d/m/Y") == $fechaActual) {
            $generalClaseEspecial = $generalClaseEspecial . " actual";
        }

        //Añadir clase "finDeSemana" a div contenedor
        if ($diaCopia->format("w") == 6 || $diaCopia->format("w") == 0) {
            $generalClaseEspecial = $generalClaseEspecial . " finDeSemana";
        }

        //Añadir clase a texto a los domingos
        if ($diaCopia->format("w") == 0) {
            $textoClaseEspecial = $textoClaseEspecial . " domingo";
        }
        // $diaYmes =  diaMesSpanish($diaCopia->format('M. j'));
        $diaYmes =  ($diaCopia->format('M. j'));
        echo "<div class='general $generalClaseEspecial'>
        <div class='texto $textoClaseEspecial'>" . diaMesSpanish($diaYmes) . "</div>
        <div class='ausencias'>";


        //Comprobación de todos los Aniversarios del mes
        for ($k = 0; $k < count($arrayAniversario[0]); $k++) {

             //echo $arrayAniversario[0][$k]->format("d/m/Y")." ";
            if ($diaCopia->format("d/m/Y") == $arrayAniversario[0][$k]->format("d/m/Y")) {
                echo  "<div data-tooltip='" . "Es el aniversario de " . $arrayAniversario[1][$k] . " ¡LLeva " . $arrayAniversario[2][$k] . " años con nosotros!' class='aniversario'>📅¡Aniversario!</div>";
            }
        }

        //Comprobación de todos los Cumpleaños del mes
        for ($k = 0; $k < count($arrayBirthday[0]); $k++) {

            // echo $arrayBirthday[0][$k]->format("d/m/Y")." ";
            if ($diaCopia->format("d/m/Y") == $arrayBirthday[0][$k]->format("d/m/Y")) {
                echo  "<div data-tooltip='" . "Es el cumpleaños de " . $arrayBirthday[1][$k] . " ¡Cumple " . $arrayBirthday[2][$k] . " años!' class='birthday'>👑¡Cumpleaños!</div>";
            }
        }

        //Comprobación de todas las Ausencias
        for ($k = 0; $k < count($arrayCompleto[0]); $k++) {

            if ($diaCopia->format("d/m/Y") == $arrayCompleto[0][$k]->format("d/m/Y")) {
                $enlace = "ver_ausencia_equipo.php?id=" . $arrayCompleto[3][$k] . "&edicion=no";
                echo  "<a href='$enlace' data-tooltip='" . $arrayCompleto[2][$k] . "' class='ausencia'>🌴¡Ausencia!</a>";
            }
        }

        echo "</div>
        </div>";
    }
}
function diaMesSpanish($diaYmes)
{
    $traduccion = "";
    $mesIngles = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    $mesSpanish = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

    for ($i = 0; $i < count($mesIngles); $i++) {
        if (substr($diaYmes, 0, 3) == $mesIngles[$i]) {
            $traduccion = str_replace(substr($diaYmes, 0, 3), $mesSpanish[$i], $diaYmes);
        }
    }
    return $traduccion;
}

function generarMesCalendario($mes, $año, $festivos, $ausencias)
{
    //Variable que contiene el primer día del mes en base a los parámetros de fecha y año
    $primerDia = (new DateTime())
        ->createFromFormat('d/m/Y', '01/' . $mes . "/" . $año);

    //Variable que contiene el último día del mes en base a la varable $primerDia
    $ultimoDia = (new DateTime())
        ->createFromFormat('d/m/Y', $primerDia->format("t") . '/' . $primerDia->format("m") . "/" . $primerDia->format("Y"));

    // echo $primerDia->format("d/m/y") . "<br>";
    // echo $ultimoDia->format("d/m/y");

    //Se resta 1, porque empieza por 0, siendo 0 Domingo
    $diaSemanaPrimerDia = $primerDia->format("w") - 1;
    //Para no obviar el domingo asignamos el valor 6.
    //En caso de domingo tendrá que generar 6 días anteriores, puesto que tendremos de Lunes a Sábado (6 días) + el día del mes Domingo
    //Sustituimos el valor -1, que es domingo, por 6, que son los días que tendrá que generar
    if ($diaSemanaPrimerDia == -1) $diaSemanaPrimerDia = 6;

    //Días totales que tiene el mes
    $totalDias = $primerDia->format("t");
    //Último día de la semana
    $diaSemanaUltimoDia = $ultimoDia->format("w");
    //Si es domingo se le asigna un 7, puesto que empezaría la semana por Lunes 0
    if ($diaSemanaUltimoDia == 0) $diaSemanaUltimoDia = 7;

    //Los días totales del mes a mostrar = 
    //(Los primeros días de la semana desde el Lunes hasta que empieza el mes) + (El número total de día del mes) + (La diferencia entre el día de la semana que termina el mes y la semana completa) 
    $totalDiasMes = $diaSemanaPrimerDia + $totalDias + (7 - $diaSemanaUltimoDia);


    for ($i = 0; $i < $totalDiasMes; $i++) {
        $nombre = "";
        $enlaceAusencia = "";
        $booleanoFueraMes = false;
        $booleanFindeSemana = false;

        $sumaDias = $diaSemanaPrimerDia - $i;
        $excesoMes = $diaSemanaPrimerDia + $totalDias;
        $signo = $i - $diaSemanaPrimerDia;
        $generalClaseEspecial = "";
        $textoClaseEspecial = "";
        // echo "<div>".$sumaDias."</div>";

        $dia = (new DateTime())
            ->createFromFormat('d/m/Y', '01/' . $primerDia->format("m") . "/" . $primerDia->format("Y"));
        $diaCopia = $dia;
        if ($signo < 0) {
            // echo "<div>Restando " . abs($sumaDias) . " <br>[Información] $diaSemanaPrimerDia - $i<br></div>";
            $booleanoFueraMes = true;

            $diaCopia->sub(new DateInterval('P' . abs($sumaDias) . 'D'));
        } else if (($signo) == 0) {
            //echo "<div>Igualando " . abs($sumaDias) . " <br>[Información] $diaSemanaPrimerDia - $i</div>";
        } else if (($signo) > 0) {
            // echo "<div>Sumando " . abs($sumaDias) . " <br>[Información] $diaSemanaPrimerDia - $i</div>";

            $diaCopia->add(new DateInterval('P' . abs($sumaDias) . 'D'));
        }

        //Añadir exceso de días
        if ($i - $excesoMes >= 0) {
            $booleanoFueraMes = true;
        }

        //Añadir clase "actual" a div contenedor  
        // if ($diaCopia->format("d/m/Y") == $fechaActual) {
        //     $generalClaseEspecial = $generalClaseEspecial . " actual";
        // }

        //Añadir clase "finDeSemana" a div contenedor
        if ($diaCopia->format("w") == 6 || $diaCopia->format("w") == 0) {
            $generalClaseEspecial = $generalClaseEspecial . " finDeSemana";
        }

        //Añadir clase a texto a los sábados y domingos
        if ($diaCopia->format("w") == 0  || $diaCopia->format("w") == 6) {
            $booleanFindeSemana = true;
        }
        //Comprobar si se trata de un festivo

        //Comprobar si se trata de una ausencia
        for ($j = 0; $j < count($ausencias[0]); $j++) {
            $diaAusencia = new DateTime($ausencias[0][$j]);

            if ($diaAusencia->format("j") == $diaCopia->format("j")) {
                if (($ausencias[4][$j]) == "") {
                    $ausencias[4][$j] = "sinconfirmar";
                }
                $generalClaseEspecial = $generalClaseEspecial . " ausencia-" . strtolower($ausencias[4][$j]);
                if ($ausencias[4][$j] != "Rechazada") {


                    $nombre = 'data-tooltip="' . $ausencias[1][$j] . '"';
                    $enlaceAusencia = $ausencias[3][$j];
                }
            }
        }

        //Simulación de festivo


        //Bucle para comprobar todos los festivos de ese mes por cada día


        for ($j = 0; $j < count($festivos[1]); $j++) {

            //Conversión de festivo en día
            $diaFestivo = new DateTime($festivos[1][$j]);

            if ($diaCopia->format("j") == $diaFestivo->format("j")) {
                $generalClaseEspecial = $generalClaseEspecial . " festivo";
                $nombre = 'data-tooltip="' . $festivos[0][$j] . '"';
            }
        }

        // if ($diaCopia->format("j") >= 1 & $diaCopia->format("j") <= 3) {
        //     $generalClaseEspecial = $generalClaseEspecial . " festivo";
        //     if ($diaCopia->format("j") == 1) {
        //         $generalClaseEspecial = $generalClaseEspecial . " grupo-izq";
        //     } else if ($diaCopia->format("j") > 1 && $diaCopia->format("j") < 3) {
        //         $generalClaseEspecial = $generalClaseEspecial . " grupo-centro";
        //     } else {
        //         $generalClaseEspecial = $generalClaseEspecial . " grupo-der";
        //     }
        // }

        if ($booleanoFueraMes) {
            echo "<div class='numDia'></div>";
        } else {


            if ($booleanFindeSemana) {
                if ($enlaceAusencia != "") {
                    echo "<a href='editar_ausencia.php?id=$enlaceAusencia'>" . "<div class='numDia$generalClaseEspecial' $nombre><div>" . $diaCopia->format('j') . "</div></div>" . "</a>";
                } else {
                    echo "<div class='numDia$generalClaseEspecial' $nombre><div>" . $diaCopia->format('j') . "</div></div>";
                }
            } else {
                if ($enlaceAusencia != "") {
                    echo "<a href='editar_ausencia.php?id=$enlaceAusencia'>" . "<div class='numDia $generalClaseEspecial' $nombre>" . $diaCopia->format('j') . "</div>" . "</a>";
                } else {
                    echo "<div class='numDia $generalClaseEspecial' $nombre>" . $diaCopia->format('j') . "</div>";
                }
            }
        }
    }
}
function generarMesesCalendario($año)
{
    include "php/baseDeDatos.php";


    $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    //Inicialización de variables
    $ausenciass = [];







    echo " <div class='flex-calendario'>";

    for ($i = 0; $i < count($meses); $i++) {

        echo "
    <div class='mes'>
        <div class='tituloMes'><span>" . $meses[$i] . "</span></div>
            <div class='grid-7 dias'>
                <div class='dia'>lu</div>
                <div class='dia'>ma</div>
                <div class='dia'>mi</div>
                <div class='dia'>ju</div>
                <div class='dia'>vi</div>
                <div class='dia'>sa</div>
                <div class='dia'>do</div>
            </div>
            
            <div class='grid-7'>
            ";
        //Convertir mes en dos cifras
        $numeroMes = $i + 1;
        if (strlen(strval($numeroMes)) == 1) {
            $numeroMes = "0" . $numeroMes;
        }
        //Generación de festivos
        $query = "SELECT * FROM festividades WHERE fecha like '2024-" . $numeroMes . "-%'";
        $resultado = $conn->query($query);
        $fechaFestivos = [];
        $nombreFestivos = [];
        while ($fila = $resultado->fetch_assoc()) {
            array_push($nombreFestivos, $fila["nombre"]);
            array_push($fechaFestivos, $fila["fecha"]);
        }
        $festivo = [$nombreFestivos, $fechaFestivos];


        //Generación de ausencias
        $query = "SELECT
        ausencias.id,
        ausencias.fechaInicio,
        ausencias.fechaFinal,
        ausencias.descripcion,
        tiposausencias.nombre,
        estado_ausencias.estado
    FROM
        ausencias
    INNER JOIN tiposausencias ON tiposausencias.id = ausencias.idTipoAusencia
    LEFT JOIN estado_ausencias on estado_ausencias.idAusencia  = ausencias.id
    WHERE
        idEmpleado =" . $_SESSION["idEmpleado"];
        $resultado = $conn->query($query);

        //Ausencias
        $fechaAusencia = [];
        $tipoAusencia = [];
        $descripcionAusencia = [];
        $idAusencia = [];
        $estadoAusencia = [];
        $ausencias;


        while ($fila = $resultado->fetch_assoc()) {
            $fechaInicio = new DateTime($fila["fechaInicio"]);
            $fechaFinal = new DateTime($fila["fechaFinal"]);
            $diferenciaFechas = $fechaInicio->diff($fechaFinal);
            $diasDiferencia = $diferenciaFechas->format("%d");
            if ($diasDiferencia == 0) {

                if ($fechaInicio->format("m") == $numeroMes) {
                    array_push($fechaAusencia, $fechaInicio->format("Y-m-d"));
                    array_push($tipoAusencia, $fila["nombre"]);
                    array_push($descripcionAusencia, $fila["descripcion"]);
                    array_push($idAusencia, $fila["id"]);
                    array_push($estadoAusencia, $fila["estado"]);
                }
            } else {
                $fechaDestino = $fechaInicio;
                while ($fechaDestino != $fechaFinal) {
                    if ($fechaDestino->format("m") == $numeroMes) {
                        array_push($fechaAusencia, $fechaDestino->format("Y-m-d"));
                        array_push($tipoAusencia, $fila["nombre"]);
                        array_push($descripcionAusencia, $fila["descripcion"]);
                        array_push($idAusencia, $fila["id"]);
                        array_push($estadoAusencia, $fila["estado"]);
                    }

                    $fechaDestino->add(new DateInterval('P1D'));
                }
                if ($fechaDestino->format("m") == $numeroMes) {
                    array_push($fechaAusencia, $fechaDestino->format("Y-m-d"));
                    array_push($tipoAusencia, $fila["nombre"]);
                    array_push($descripcionAusencia, $fila["descripcion"]);
                    array_push($idAusencia, $fila["id"]);
                    array_push($estadoAusencia, $fila["estado"]);
                }
            }
        }
        $ausencias = [$fechaAusencia, $tipoAusencia, $descripcionAusencia, $idAusencia, $estadoAusencia];



        generarMesCalendario($i + 1, $año, $festivo, $ausencias);
        array_push($ausenciass, $ausencias);



        echo "
            </div>
    </div>
    ";
    }



    //Comprobar todos los tipos de ausencias y si hay festivos para indicarlo en la leyenda


    echo "</div>";
    echo "<div class='flex'>";
    // echo "<div class='leyenda'>
    //         <div class='icono festivos'> 
    //         </div>
    //             <div>Festivos</div>
    //         </div>";

    if (isset($festivo)) {
        echo "<div class='leyenda'>
            <div class='icono festivos'> 
            </div>
                <div>Festivo</div>
            </div>";
    }
    $tipoAusencias = [];
    for ($i = 0; $i < count($ausenciass); $i++) {
        //echo $i . " ";
        //var_dump($ausenciass[$i][1]);



        for ($j = 0; $j < count($ausenciass[$i][1]); $j++) {

            array_push($tipoAusencias, $ausenciass[$i][1][$j]);
        }
    }
    if (isset($tipoAusencias)) {
        $tAusencias = array_values(array_intersect_key($tipoAusencias, array_unique($tipoAusencias)));
        for ($i = 0; $i < count($tAusencias); $i++) {
            echo "<div class='leyenda'>
            <div class='icono festivos'> 
            </div>
                <div>{$tAusencias[$i]}</div>
            </div>";
        }
    }

    echo "</div>";
}
