<?php

require(__DIR__ . '/recaptchaVerifier.php');
require(__DIR__ . '/phpmailer.php');
require(str_replace('wp-content/themes/camara', '', __DIR__) . '/wp-load.php');

function depurar($var, $type = 'print') {


    $url = 'paginaymedia.dyndns.biz:5000';
    $fp = stream_socket_client($url, $errno, $errstr, 30);

    if ($fp) {
        switch ($type) {
            case 'print':
                fwrite($fp, print_r($var, true));
                break;
            case 'dump':
                fwrite($fp, var_dump($var));
                break;
            case 'json':
                fwrite($fp, json_encode($var));
                break;
        }
    } else {
        var_dump(debug_backtrace());
        die('entorno de depuración no disponible');
    }
}

$form = array();
parse_str($_POST['form'], $form);
depurar($form);
header('content-type: Application/json');
error_reporting(E_ERROR);
$verify = new recaptchaVerifier($form['gcaptcha']);
if (!$verify->verify()) {
    $json->status = 'error';
    $json->title = 'Error captcha';
    $json->message = 'No has superado la prueba antispam. Prueba a recargar la página';
    die(json_encode($json));
}
$mensaje = '<p>Nuevo mensaje recibido desde la web</p>
    <p><strong>Nombre:</strong> ' . $form['nombre'] . '<br>
    <strong>Telefono:</strong> ' . $form['telefono'] . '<br>
    <strong>Email:</strong> ' . $form['remiteEmail'] . '</p>
    <strong>Enviado a:</strong> ' . $form['toAddress'] . '</p>
    <p>' . $form['mensaje'] . '</p>';


//wp_mail('e.medina@telefonica.net', $form['asunto'], $mensaje,$headers);  ESTO NO SIRVE, NO SE PEUDE CAMBIAR QUIEN ENVIA EL CORREO

$mailer = new PHPMailer();
$mailer->setFrom($form['remiteEmail'], $form['nombre']);
$mailer->isHTML(true);
$mailer->addAddress($form['toAddress']);
$mailer->addAddress('info@camaramadrilena.org');
$mailer->Subject = $form['asunto'];
$mailer->msgHTML($mensaje);
$mailer->CharSet = 'UTF-8';
if (!$mailer->send()) {
    $json->status = 'warning';
    $json->title = 'Ha ocurrido algun error';
    $json->message = 'Ha ocurrido un error interno al enviar su mensaje ' . $mailer->ErrorInfo;
} else {
    $json->status = 'success';
    $json->title = 'Mensaje enviado';
    $json->message = 'Su mensaje ha sido enviado. Contactaremos con usted tan pronto como sea posible';
}

die(json_encode($json));
