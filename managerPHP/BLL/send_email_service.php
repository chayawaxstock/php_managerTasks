<?php

require 'PHPMailerAutoload.php';

class send_email_service {

    var $mail;

    function __construct() {
        $this->mail == new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'c0556777462@gmail.com';                 // SMTP username
        $mail->Password = '207322868';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;
        
    }

    static function send_email($to, $subject, $message) {
        $mail->From = 'from@example.com';
        $mail->FromName = 'Mailer';
        $mail->addAddress($to);               // Name is optional
        $mail->addReplyTo($to, 'Information');

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $message;
// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

}

// TCP port to connect to

