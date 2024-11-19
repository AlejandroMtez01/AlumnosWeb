<?php
function enviarMensajeTelegram()
{
    // Token del bot
    $botToken = "7716754545:AAFI4kQzEdPNixotR9zffxsZ14JXC5jyPhE";
    $chatId = "-1002271031637"; // ID del chat o canal
    $mensaje = "Hola, este es un mensaje desde PHP! Personalizado¿?";
    $thread = 4;

    // URL de la API
    $url = "https://api.telegram.org/bot$botToken/sendMessage";

    // Datos a enviar
    $data = [
        'chat_id' => $chatId,
        'text'    => $mensaje,
        'message_thread_id' => 4
    ];

    // Enviar solicitud
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Mostrar respuesta
    echo $response;
}

function lineaValor($titulo,$descripcion){
    //Lista de carácteres a quitar
    $caracteres = array("-",".","(",")");
    

    for ($i=0; $i < count($caracteres); $i++) { 
        $descripcion = str_replace($caracteres[$i],"\\".$caracteres[$i],$descripcion);
    }
    return "*".$titulo."* : ".$descripcion."\n\n";
}
function lineaDescripcion($titulo,$descripcion){
    //Lista de carácteres a quitar
    $caracteres = array("-",".","(",")");
    

    for ($i=0; $i < count($caracteres); $i++) { 
        $descripcion = str_replace($caracteres[$i],"\\".$caracteres[$i],$descripcion);
    }
    return "*".$titulo."*\n".$descripcion."\n\n";
}

function clasesMensajeTelegram($idClase,$conn)
{
    $query = 'SELECT clases.id as idClase, idAlumno, observacionesProximaClase,contenidoExplicado,ejerciciosRealizados,fecha,horaDesde,horaHasta,dificultad,evolucion,nombre,apellido1,apellido2 FROM clases INNER JOIN alumnos on clases.idAlumno=alumnos.id WHERE clases.id = ' . $idClase . ' ORDER BY clases.id  ';
    $resultado = $conn->query($query);
    //echo $query;
    $filaClasesRealizadas = $resultado->fetch_assoc();


    $mensaje = "";
    $mensaje  = $mensaje.lineaValor("Alumno",$filaClasesRealizadas["nombre"]. " ".$filaClasesRealizadas["apellido1"]. " ".$filaClasesRealizadas["apellido2"]);
    $mensaje  = $mensaje.lineaValor("Clase",$filaClasesRealizadas["fecha"]. " ".$filaClasesRealizadas["horaDesde"]. " - ".$filaClasesRealizadas["horaHasta"]);
    $mensaje  = $mensaje.lineaDescripcion("Contenidos Explicados",$filaClasesRealizadas["contenidoExplicado"]);
    $mensaje  = $mensaje.lineaDescripcion("Ejercicios Realizados",$filaClasesRealizadas["ejerciciosRealizados"]);
    $mensaje  = $mensaje.lineaDescripcion("Ejercicios Próxima Clase",$filaClasesRealizadas["observacionesProximaClase"]);

    echo $mensaje;
     // Token del bot
     $botToken = "7716754545:AAFI4kQzEdPNixotR9zffxsZ14JXC5jyPhE";
     $chatId = "-1002271031637"; // ID del chat o canal
     //$mensaje = "Hola, este es un mensaje desde PHP! Personalizado¿?";
     $thread = 4;
 
     // URL de la API
     $url = "https://api.telegram.org/bot$botToken/sendMessage";
 
     // Datos a enviar
     $data = [
         'chat_id' => $chatId,
         'text'    => $mensaje,
         'message_thread_id' => 4,
         'parse_mode' => 'MarkdownV2'
     ];
 
     // Enviar solicitud
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
     $response = curl_exec($ch);
     curl_close($ch);
 
     // Mostrar respuesta
     echo $response;
    
}
