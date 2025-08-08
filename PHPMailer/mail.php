<?php
/**
 * This example shows sending a message using PHP's mail() function.
 */

require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Set who the message is to be sent from
$mail->setFrom('support.cms@mul.edu.pk', 'CMS Support (Minhaj University Lahore)');
//Set an alternative reply-to address
//$mail->addReplyTo('director.gp@mul.edu.pk', 'First Last');
//Set who the message is to be sent to
//$mail->addAddress('director.academics@mul.edu.pk', 'Director Academics');
//$mail->addAddress('ibrar.hussain@mul.edu.pk', 'Ibrar Hussain');
$mail->addAddress('director.gf@mul.edu.pk', 'Shahzad Ahmad');
//$mail->addCC("rahia307@gmail.com");
$mail->addBCC("rahia307@gmail.com");
//Set the subject line
$mail->Subject = 'Minhaj University Lahore - Email address verification';
$mail->isHTML(true);
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$htmlcontents = '
<div style="font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee; margin: auto; width:80%;">
<div style="text-align:center;">
	<a href="https://www.mul.edu.pk/" target="_blank">
		<img src="https://www.mul.edu.pk/images/logo-mul.png" alt="Minhaj University Lahore" style="margin-top:30px; width:180px; height:60px;" >
	</a>
	
	<p style="color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0; margin-top:20px; margin-bottom:20px;text-align:left;margin-left:30px;">
		Hi Shahzad Ahmad,<br>
		We need a little more information to complete your email address verification. 
	</p>

	<p style="color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0;margin-bottom:20px;text-align:left;margin-left:30px;">
		Click below to confirm your email addresss: <br>
		https://cms.mul.edu.pk/emailverify.php?token=1452Uyhg145kljhjg
	</p>

	<p style="color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0;margin-top:30px;text-align:left; margin-bottom:20px;margin-left:30px;">
		If you have problems, please paste the above URL into your web browser.
	</p>
                                                    

	<p style="color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0;margin-top:30px;text-align:left;margin-left:30px;">
		Thanks<br>
		CMS Support<br>
		Directorate of Academics<br>
	</p>
	
	<p style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0;margin-top:30px;">
		&copy; '.date("Y").' Minhaj Univertsity Lahore. All rights reserved.
	</p>

	<span style="line-height:20px;font-size:10px">
		<a href="https://www.facebook.com/MinhajUniversityLahore/" target="_blank">
			<img src="http://i.imgbox.com/BggPYqAh.png" alt="fb">
		</a>&nbsp;
	</span>
	<span style="line-height:20px;font-size:10px">
		<a href="https://twitter.com/OfficialMUL" target="_blank">
			<img src="http://i.imgbox.com/j3NsGLak.png" alt="twit">
		</a>&nbsp;
	</span>
	<span style="line-height:20px;font-size:10px">
		<a href="https://plus.google.com/u/0/115904260228534002568" target="_blank">
			<img src="http://i.imgbox.com/wFyxXQyf.png" alt="g">
		</a>&nbsp;
	</span>

</div>  
</div>';

$mail->Body     = $htmlcontents;
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('examples/images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
