<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'Constantes.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2;
    $mail->isSMTP();

    $mail->Host = 'mail.poplanding.com.br';
    $mail->SMTPAuth = true;

    $mail->Username = 'poplanding@poplanding.com.br';
    $mail->Password = 'EMAIL_PASSWORD';

    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    //Mensagem a ser enviada

    $mail->setFrom('poplanding@poplanding.com.br');
    $mail->addAddress('poplanding@poplanding.com.br');

    $mail->isHTML(true);
    $mail->Subject = 'Está é uma prova do e-mail';
    $mail->Body = 'Olá mundo<b>PHPMailer</b>';

    $mail->send();
} catch (Exception $exception) {
    echo 'Algo está errado na configuração', $exception->getMessage();
}
