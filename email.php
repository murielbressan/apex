<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/PHPMailer-master/src/Exception.php';
require './PHPMailer/PHPMailer-master/src/PHPMailer.php';
require './PHPMailer/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $template= file_get_contents('./vistas/template_email.html');
                    
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'mail@mail.com';                     
    $mail->Password   = 'password';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        
    $mail->Port       = 465;                                   

     $nombre = $_POST['name'];
     $email = $_POST['email'];
     $company = $_POST['company'];
     $telefono = $_POST['telefono'];
     $message = $_POST['message'];

    $template = str_replace('%nombre%', $nombre, $template);  
    $template = str_replace('%email%', $email, $template);  
    $template = str_replace('%company%', $company, $template);  
    $template = str_replace('%telefono%', $telefono, $template);  
    $template = str_replace('%message%', $message, $template);  



    $mail->setFrom('mail@mail.com', 'Consulta cotizacion');
    $mail->addAddress('mail@mmail.com');  
    $mail->Subject = 'Consulta ' . $nombre;
    $mail->MsgHTML($template);
    $mail->isHTML(true);     
   

    $mail->send();
    
    header( 'Location: index.html' ) ;


} catch (Exception $e) {
	echo $e;
}


?>