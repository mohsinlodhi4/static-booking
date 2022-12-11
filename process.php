<?php

// AJAX request will hit here
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$sqm = $_POST['sqm'];
$form_message = $_POST['message'];

$message = "
    <div>
        <span style='font-weight:bold'>Name: </span> $name
    </div>
    <div>
        <span style='font-weight:bold'>Email: </span> $email
    </div>
    <div>
        <span style='font-weight:bold'>Phone: </span> $phone
    </div>
    <div>
        <span style='font-weight:bold'>Sqm: </span> $sqm
    </div>
    <div>
        <span style='font-weight:bold'>Message: </span> $form_message
    </div>

";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions
try {

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '0eb64a4ababe84';                     //SMTP username
    $mail->Password   = 'a8d0ab8dcb60d8';                               //SMTP password
    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 2525;   
    
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    // $mail->Port       = 465;   
    
    // $mail->SMTPSecure = "tls"; //If SMTP requires TLS encryption then set it                      
    // $mail->Port = 2525;  //Set TCP port to connect to

    //From email address and name
    // $mail->From = "from@yourdomain.com";
    // $mail->FromName = "Full Name";

    //To address and name
    $mail->addAddress("hammadahmad159357@gmail.com", "Muhammad Hammad");


    //Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = "Lead Request";
    $mail->Body = $message;
    $mail->AltBody = strip_tags($message);

    $mail->send();
    echo json_encode(["success"=>true, 'message'=> "Message has been sent successfully"]); 
} catch (Exception $e) {
    echo json_encode(["success"=>false, 'message'=> "Mailer Error: " . $mail->ErrorInfo]); 
}