<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$pass = 'vkdupqygfawszuzy';



$mail = new PHPMailer(true);


$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Username = 'enviopruebasjavamail@gmail.com';
$mail->Password = $pass;
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('enviopruebasjavamail@gmail.com');
$mail->CharSet = "UTF-8";

$GLOBALS['mail'] = $mail;

function enviarMail($address, $subject, $body)
{
    $mail = $GLOBALS['mail'];
    $mail->addAddress($address);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->send();
}
function mailNuevaEmpresa($address, $nombreEmpresa)
{
    $mail = $GLOBALS['mail'];
    $mail->addAddress($address);
    $mail->isHTML(true);
    $mail->Subject = '¡Nueva Empresa dada de Alta!';

    $mensaje = "
        <div class='general' style='
            padding: 5px 15px;
            background-color: #eb3464;
            opacity: 0.6;'
        >


        <div class='titulo' style='
            letter-spacing: 2px;
            text-align: center;
            font-weight: 800;
            font-size: 25px;
            padding: 10px 10px;
            color: black;'
        >¡NUEVA EMPRESA DADA DE ALTA!
        </div>

        <div class='subtitulo' style='
        letter-spacing: .75px;
        text-align: center;
        font-weight: 800;
        font-size: 20px;
        padding: 10px 10px;
        color: black;'>Bienvenido <span class='señal1' style='            color: darkred;
        background-color: white;'>XXXXXX S.L.</span> al ecosistema <span
                class='señal2' style='            color: white;
                background-color: black;'>HR</span></div>

    </div>
    <div class='subgeneral' style='
    padding: 30px; background-color: #ffffff;
    opacity: 0.8;
    background: repeating-linear-gradient(-45deg, #eb3464, #eb3464 20px, #ffffff 20px, #ffffff 100px);'>
    <div class='grid-superhijo' style='display:block;'>

    <div style='
    letter-spacing: .5px;
        text-align: center;
        font-weight: 700;
        font-size: 25px;
        padding: 15px 0px;
        
        color: #eb3464;
        '><span style='background: white;padding: 10px 10px;
        border: 1px solid #F4F4F5;
        border-radius: 15px;'>¿QUÉ OFRECEMOS?</span></div>


</div>
<div contenedor>
    <div class='i'>
        <div class='grid' style='display: flex;
        gap: 15px;
        width: 45%;
        margin: 10px auto;
        flex-wrap: wrap;'>
                   

            <div class='grid-hijo' style='
            margin: 10px 25px;
            padding: 15px 10px;
            border: 2.5px solid #eb3464;
            text-align: center;
            border-radius: 15px;
            position: relative;
            background: white;
            width: 45vh;
            height: 15vh;'>
                    <div class='block'>
                    <div class='abs' style=' 
                    padding: 1% 3%;
                    background: #eb3464;
                    color: white;
                    border-radius: 10px;
                    width: 10%;
                    margin: auto auto;
                    border: 2px solid darkred;'>1</div>
                    <div style=' 
                    letter-spacing: .75px;
                    text-align: center;
                    font-weight: 700;
                    font-size: 17px;
                    color: black;
                    padding: 10px 10px;'>
                    ?Titulo1</div>
                    <span style='color: black;'>?Texto1</span>

                </div>
            </div>

            <div class='grid-hijo' style='
            margin: 10px 25px;
            padding: 15px 10px;
            border: 2.5px solid #eb3464;
            text-align: center;
            border-radius: 15px;
            position: relative;
            background: white;
            width: 45vh;
            height: 15vh;'>
                    <div class='block'>
                    <div class='abs' style=' 
                    padding: 1% 3%;
                    background: #eb3464;
                    color: white;
                    border-radius: 10px;
                    width: 10%;
                    margin: auto auto;
                    border: 2px solid darkred;'>2</div>
                    <div style=' 
                    letter-spacing: .75px;
                    text-align: center;
                    font-weight: 700;
                    font-size: 17px;
                    color: black;
                    padding: 10px 10px;'>
                    ?Titulo2</div>
                    <span style='color: black;'>?Texto2</span>

                </div>
            </div>
            </div>
            <div class='i'>
        <div class='grid' style='display: flex;
        gap: 15px;
        width: 45%;
        margin: 10px auto;
        flex-wrap: wrap;'>

        <div class='grid-hijo' style='
        margin: 10px 25px;
        padding: 15px 10px;
        border: 2.5px solid #eb3464;
        text-align: center;
        border-radius: 15px;
        position: relative;
        background: white;
        width: 40vh;
        height: 15vh;'>
                <div class='block'>
                <div class='abs' style=' 
                padding: 1% 3%;
                background: #eb3464;
                color: white;
                border-radius: 10px;
                width: 10%;
                margin: auto auto;
                border: 2px solid darkred;'>3</div>
                <div style=' 
                letter-spacing: .75px;
                text-align: center;
                font-weight: 700;
                font-size: 17px;
                color: black;
                padding: 10px 10px;'>
                ?Titulo3</div>
                <span style='color: black;'>?Texto3</span>

            </div>
        </div>
        <div class='grid-hijo' style='
        margin: 10px 25px;
        padding: 15px 10px;
        border: 2.5px solid #eb3464;
        text-align: center;
        border-radius: 15px;
        position: relative;
        background: white;
        width: 40vh;
        height: 15vh;'>
                <div class='block'>
                <div class='abs' style=' 
                padding: 1% 3%;
                background: #eb3464;
                color: white;
                border-radius: 10px;
                width: 10%;
                margin: auto auto;
                border: 2px solid darkred;'>4</div>
                <div style=' 
                letter-spacing: .75px;
                text-align: center;
                font-weight: 700;
                font-size: 17px;
                color: black;
                padding: 10px 10px;'>
                ?Titulo4</div>
                <span style='color: black;'>?Texto4</span>

            </div>
        </div>
        </div>
        </div>
    </div>
    ";

    $busquedas = array("?Titulo1","?Titulo2","?Titulo3","?Titulo4","?Texto1","?Texto2","?Texto3","?Texto4");
    $reemplazos = array("VISIÓN GLOBAL","GESTIÓN DE AUSENCIAS","ACCESO A INFORMES","CONOCE LOS EQUIPOS","Un mismo espacio con todas nuestras aplicaciones y datos de empleados/as interconectados.
    ","Vacaciones permisos y otrso tipos de ausencias gestionadas de manera ágil y sencilla.
    ","Tus contratos, nóminas, diplomas, documentos importantes y todo tipo de documentos en un mismo lugar.
    ","Conoce todos los equipos y/o departamentos de la empresa junto a sus miembros correspondientes.");

    for ($i=0; $i <count($busquedas) ; $i++) { 
        $mensaje = str_replace($busquedas[$i],$reemplazos[$i],$mensaje);
    }

    $mensaje = str_replace("XXXXXX S.L.",$nombreEmpresa,$mensaje);


    $mail->Body = $mensaje;

    $mail->send();
}
