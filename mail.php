<?php
//index.php

$error = '';
$name = '';
$email = '';
$empresa = '';
$telefone = '';

function clean_text($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);

    return $string;
}

if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
    } else {
        $name = clean_text($_POST['name']);
        if (!preg_match('/^[a-zA-Z ]*$/', $name)) {
            $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
        }
    }
    if (empty($_POST['email'])) {
        $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
    } else {
        $email = clean_text($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= '<p><label class="text-danger">Invalid email format</label></p>';
        }
    }
    if (empty($_POST['empresa'])) {
        $error .= '<p><label class="text-danger">empresa is required</label></p>';
    } else {
        $empresa = clean_text($_POST['empresa']);
    }
    if (empty($_POST['telefone'])) {
        $error .= '<p><label class="text-danger">telefone is required</label></p>';
    } else {
        $telefone = clean_text($_POST['telefone']);
    }
    if ($error == '') {
        require 'class/class.phpmailer.php';
        $mail = new PHPMailer();
        $mail->IsSMTP();                                //Sets Mailer to send telefone using SMTP
        $mail->Host = 'mail.poplanding.com.br';        //Sets the SMTP hosts of your Email hosting, this for Godaddy
        $mail->Port = '465';                                //Sets the default SMTP server port
        $mail->SMTPAuth = true;                            //Sets SMTP authentication. Utilizes the Username and Password variables
        $mail->Username = 'poplanding@poplanding.com.br';                    //Sets SMTP username
        $mail->Password = '12345';                    //Sets SMTP password
        $mail->SMTPSecure = 'ssl';                            //Sets connection prefix. Options are "", "ssl" or "tls"
        $mail->From = $_POST['email'];                    //Sets the From email address for the telefone
        $mail->FromName = $_POST['name'];                //Sets the From name of the telefone
        $mail->AddAddress('poplanding@poplanding.com.br', 'Antilhas Stretch Hood');        //Adds a "To" address
        //$mail->AddCC($_POST['email'], $_POST['name']);	//Adds a "Cc" address
        $mail->WordWrap = 50;                            //Sets word wrapping on the body of the telefone to a given number of characters
        $mail->IsHTML(true);                            //Sets telefone type to HTML
        $mail->Subject = $_POST['empresa'];                //Sets the empresa of the telefone
        $mail->Body = $_POST['telefone'] . PHP_EOL . $_POST['name'] . PHP_EOL . $_POST['empresa'] . PHP_EOL . $_POST['email'];            //An HTML or plain text telefone body
        if ($mail->Send()) {                                //Send an Email. Return true on success or false on error
            $error = '<label class="text-success">Obrigado pelo seu contato, em breve retornaremos</label>';
        } else {
            $error = '<label class="text-danger">Ocorreu um erro ao enviar o e-mail</label>';
        }
        $name = '';
        $email = '';
        $empresa = '';
        $telefone = '';
    }
}
