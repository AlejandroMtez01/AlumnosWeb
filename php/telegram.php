<?php
function enviarMensajeTelegram(){
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

?>