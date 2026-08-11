<?php

require '../../PHPMailer/PHPMailerAutoload.php';

ini_set('memory_limit', '-1');

require_once("api/db_functions.php");

$api 	    = new main();

$myorders   = $api->get_newsletters();
$subject    = $myorders['emailsubject'];
$message    = $myorders['emailmessage'];
echo $myorders['message'];
if(empty($myorders['data'])) {
    $update = $api->update_newsletter($myorders['id_newsletter']);

} else {

    foreach ($myorders['data'] as $rowbills):

        $email = filter_var($rowbills['email'], FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            echo '<br>' . $email;

//Create a new PHPMailer instance
            $mail = new PHPMailer;

//Set who the message is to be sent from
            $mail->setFrom('updates@sldsystem.com', 'SLD System');
// to address

            $mail->addAddress($email, $rowbills['name']);
//$mail->addCC("rahia307@gmail.com");
// add bcc
//            $mail->addBCC("info@sldsystem.com");
//$mail->addBCC("admission@mul.edu.pk");
//Set the subject line
            $mail->Subject = $subject;

            $mail->isHTML(true);

//Read an HTML message body from an external file, convert referenced images to embedded,

            $htmlcontents = $message;

            $mail->Body = $htmlcontents;
            $mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('examples/images/phpmailer_mini.png');

//send the message, check for errors
            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
                $statussent = 2;
            } else {
                echo "Message sent!";
                $statussent = 1;

            }
            $update = $api->update_newsuser($rowbills['id'], $statussent);

        } else {
            $update = $api->update_newsuser($rowbills['id'], 2);
        }
    endforeach;
}