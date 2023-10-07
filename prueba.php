<?php
require 'vendor/autoload.php'; // Asegúrate de cargar la biblioteca necesaria

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Inicializa la clase de PHPMailer
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'sandbox.smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Username = '8a5bf4bd4adadd';  // Tu nombre de usuario de Mailtrap
$mail->Password = '38734d442f9a54';  // Tu contraseña de Mailtrap
$mail->SMTPSecure = 'tls'; // Puedes usar 'tls' o 'ssl'
$mail->Port = 587;  // El puerto que prefieras (25, 465, 587, o 2525)

// Configura el remitente y destinatario
$mail->setFrom('henry4621.com@gmail.com', 'Henry');
$mail->addAddress('henry4621.com@gmail.com', 'Rigoberto Destinatario');

// Configura el contenido del correo
$mail->isHTML(true);
$mail->Subject = 'Asunto de prueba';
$mail->Body = '<p>Hola, este es un correo de prueba enviado desde tu aplicación PHP utilizando Mailtrap.</p>';

// Envía el correo
if ($mail->send()) {
    echo 'Correo enviado con éxito';
} else {
    echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
}
?>