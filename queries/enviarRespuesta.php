<div style="display: none;">


<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$nombres = $_POST['nombres'];
$correo = $_POST['correo'];
$asunto = $_POST['asunto'];
$detalles = $_POST['detalles'];

//Load Composer's autoloader
// require 'vendor/autoload.php';
require "../assets/lib/PHPMailer/src/PHPMailer.php";
require "../assets/lib/PHPMailer/src/SMTP.php";
require "../assets/lib/PHPMailer/src/Exception.php";



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'gruposcoutlb662@gmail.com';                     //SMTP username
    $mail->Password   = 'gghugsxcxdvwedzo';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('gruposcoutlb662@gmail.com', utf8_decode('Grupo Scout 662 León Blanco'));
    $mail->addAddress(''.$correo.'', ''.$nombres.'');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = ''.utf8_decode($asunto).'';
    $mail->Body    = ''.$detalles.'';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
</div>

<!-- <?php  

header("Location: /proyectoGrupoScout/views/admin/listPqrs.php");


?> -->