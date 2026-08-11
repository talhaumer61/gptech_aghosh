<?php
/**
 * This example shows sending a message using PHP's mail() function.
 */

//----------------------------------------
//if(($_SESSION['userlogininfo']['LOGINAFOR'] == 1)) { 
	
require 'PHPMailer/PHPMailerAutoload.php';

	ini_set('memory_limit', '-1');
$srno = 0;

	
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Set who the message is to be sent from
$mail->setFrom('no-reply@aghosh.edu.pk', 'Aghosh Grammar School');
// to address

$mail->addAddress("rahia307@gmail.com", "Shahzad Ahmad");
//$mail->addCC("rahia307@gmail.com");
// add bcc 
$mail->addBCC("shahzad.ahmad@mul.edu.pk");
//$mail->addBCC("admission@mul.edu.pk");
//Set the subject line
$mail->Subject = 'Fee Challan - Aghosh Grammar School';
	
$mail->isHTML(true);
	
//Read an HTML message body from an external file, convert referenced images to embedded,

$htmlcontents = '

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="description"
      content="Different form design which you can use in your any website. different layouts for your common website use like subscriber form, Email template, contact us Login, Registration, email verification, From Multi-step, Forget Password. "
    />
    <meta
      name="keywords"
      content=" bootstrap forms, chat-box, contact, forms, html forms, login form, login forms, multi-step, payment forms, quiz forms, register, registration, subscribe forms, survey form  "
    />
    <meta name="author" content="inittheme" />
    <meta property="og:type" content="initform" />
    <meta property="og:title" content="inittheme" />
    <meta property="og:site_name" content="inittheme" />
    <meta property="og:url" content="https://inittheme.com" />
    <meta property="og:image" content="https://inittheme.com/images/logo.jpg" />
    <meta
      property="og:description"
      content="contact, forms, html forms, login form, login forms, multi-step, payment forms, quiz forms,"
    />
    <meta name="twitter:title" content="inittheme" />
    <meta
      name="twitter:description"
      content="contact, forms, html forms, login form, login forms, multi-step, payment forms, quiz forms,"
    />
    <meta name="twitter:image" content="https://twitter.com/inittheme/photo" />
    <meta name="twitter:card" content="summary" />

    <meta name="google-site-verification" content="..." />
    <meta name="facebook-domain-verification" content="..." />
    <meta name="csrf-token" content="..." />
    <meta name="currency" content="$" />

    <title>E-Mail Template</title>
    <link
      rel="icon"
      type="image/x-icon"
      sizes="20x20"
      href="../assets/images/icon/favicon.png"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap"
    />

    <style>
      .page-content {
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .email-template-ui {
        font-family: "Roboto", sans-serif;
        padding: 45px 32px;
        background: white;
        border-radius: 10px;
        max-width: 551px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
          rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
      }
      p {
        margin-block: 10px !important;
      }
      .email-template-ui .template-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .email-template-ui .template-heading p {
        font-family: "Roboto", sans-serif;
        font-size: 16px;
        line-height: 24px;
        color: #6f767e;
        margin-top: 20px;
      }
      .email-template-ui .template-heading .color-black {
        color: #1a1d1f;
      }
      .email-template-ui .template-body {
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-size: 14px;
        line-height: 24px;
        color: #6f767e;
      }

      .email-template-ui .template-body .content-part {
        text-align: left;
        margin-bottom: 28px;
      }

      .email-template-ui .template-body .content-part p a {
        font-family: "Poppins", sans-serif;
        color: #087c7c;
      }

      .email-template-ui .template-body .content-part h5 {
        font-family: "Poppins", sans-serif;
        color: #1a1d1f;
        margin-top: 28px;
        padding: 0;
      }

      .email-template-ui .template-body .content-details p {
        font-family: "Poppins", sans-serif;
        padding: 0 14px;
        margin-bottom: 28px;
      }

      .email-template-ui .template-body .content-details p .link {
        color: #087c7c;
      }

      .email-template-ui .template-body .ot-primary-text {
        font-family: "Poppins", sans-serif;
        font-weight: 600;
        font-size: 16px;
        line-height: 24px;
        color: #087c7c;
        margin-top: 26px;
      }

      .email-template-ui .template-body h5 {
        font-family: "Poppins", sans-serif;
        padding: 0 14px;
      }

      .email-template-ui .template-button-group {
        display: flex;
        align-items: center;
        justify-content: center;
        padding-left: 14px;
        gap: 10px;
      }
      .email-template-ui .template-btn-container {
        display: flex;
        align-items: center;
        justify-content: flex-start;
      }
      .email-template-ui .template-footer {
        text-align: center;
        border-top: 2px solid #d4d7d9;
        margin-top: 50px;
        padding-top: 20px;
      }

      .email-template-ui .template-footer p {
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-size: 13px;
        color: #6f767e;
        margin-block: 4px;
      }

      .email-template-ui .template-footer p > a {
        color: #087c7c;
      }

      .email-template-ui .template-footer .social-media-button {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 26px;
        gap: 8px;
      }

      .email-template-ui .template-footer .social-media-button a {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 30px;
        width: 30px;
        line-height: 40px;
        border-radius: 4px;
        background: #087c7c;
        font-size: 17px;
        transition: 0.3s;
        color: #fff;
        text-decoration: none;
      }

      .email-template-ui .template-footer .template-footer-image {
        margin-top: 28px;
        margin-bottom: 8px;
      }

      @media (max-width: 576px) {
        .email-template-ui {
          padding: 26px 30px;
        }
        .email-template-ui .template-heading p {
          font-size: 16px;
          padding: 0 8px;
        }
        .email-template-ui .template-body {
          font-weight: 400;
          font-size: 14px;
          line-height: 24px;
          color: #6f767e;
        }
        .email-template-ui .template-body p {
          padding: 0;
        }
        .email-template-ui .template-body .template-content-image img {
          width: 100%;
          height: 100%;
        }

        .email-template-ui .template-body h5 {
          padding: 0;
        }

        .email-template-ui .template-button-group {
          flex-direction: column;
          padding: 0;
        }

        .email-template-ui .template-button-group button {
          width: 100%;
        }

        .email-template-ui .template-footer {
          font-size: 7px;
        }
      }
      @media (max-width: 420px) {
        .email-template-ui {
          padding: 25px 17px;
        }
        .email-template-ui .template-body {
          font-size: 12px;
        }
        .email-template-ui .template-body .ot-primary-text {
          margin-top: 26px;
        }
      }
      .title {
        color: #087c7c;
        font-size: 24px;
        font-weight: 600;
        margin-block: 20px;
      }
      .btn-primary-fill {
        padding: 7px 19px;
        color: #fff;
        text-transform: capitalize;
        border: 1px solid transparent;
        font-size: 14px;
        font-weight: 600;
        border-radius: 6px;
        text-align: center;
        cursor: pointer;
        display: inline-block;
        overflow: hidden;
        -webkit-transition: 0.3s;
        transition: 0.3s;
        background: #087c7c;
        text-decoration: none;
      }
      .mt-23 {
        margin-top: 23px;
      }
      .mb-23 {
        margin-bottom: 23px;
      }
      .mb-33 {
        margin-bottom: 33px;
      }
      .m-0 {
        margin: 0;
      }
      .mt-0 {
        margin-top: 0;
      }
      .tags {
        font-size: 14px;
        transition: 0.3s;
        color: #087c7c;
        padding: 2px 15px;
        text-transform: capitalize;
        display: flex;
        align-items: center;
        gap: 7px;
        font-weight: 600;
        border-bottom: 1px solid #e7e7e7;
        line-height: 1;
      }
      .tags img {
        max-width: 25px !important;
      }
      .template-heading img {
        max-width: 130px;
      }
      .date {
        font-size: 12px !important;
        text-align: center;
        margin: 0 !important;
      }
      .text-uppercase{
        text-transform: uppercase;
      }
    </style>
  </head>
  <body>
    <div class="page-content">
      <div class="email-template-ui">

        <!-- Header S t a r t -->
        <div class="template-heading mb-33">
          <img src="https://i.ibb.co/fXs4X2G/logo.png" alt="img" />
          <div class="div">
            <div class="tags">
              power by :
              <img
                src="https://www.freepnglogos.com/uploads/logo-home-png/download-google-home-vector-logo-2.png"
                alt=""
              />
            </div>
            <p class="date text-uppercase">17-january-2024</p>
          </div>
        </div>
        <!--/ End-of Header -->

        <h1 class="title">Reset Your Password</h1>

        <!-- Start template body  -->
        <div class="template-body">
          <div class="content-part m-0">
            <p>Hi, <span class="text-uppercase">rafsan jani</span></p>
            <p class="m-0">Welcome!</p>
            <p class="mt-0">
              Receiving this email because you have registered on our site. Click the link below to active your DashLite account. This link will expire in 15 minutes and can only be used once.
            </p>
          </div>
          <!-- template button start -->
          <div class="template-btn-container">
            <a href="#" target="_blank" class="btn-primary-fill">
              <span>Verify Email</span>
            </a>
          </div>

         
        </div>
        <!-- End template body -->

        <!-- Footer  s t a r t-->
        <div class="template-footer">
          <p>
            No longer interested ?
            <a href="#" target="_blank">Unsubscribe </a> or
            <a href="#" target="_blank"> manage your subscriptions.</a>
          </p>
          <p>
            interested in sponsoring this newsletter?
            <a href="#" target="_blank">Get in a touch</a>
          </p>
          </p>
          <p> initTheme company Ltd. </p>
          <p> 254 Yates St. USK Victorias. AC W585585 UK </p>

          <div class="social-media-button">
            <a href="#" class="social-icon-facebook">
              <i class="ri-facebook-fill"></i>
            </a>
            <a href="#" class="social-icon-twitter">
              <i class="ri-twitter-line"></i>
            </a>
            <a href="#" class="social-icon-google">
              <i class="ri-linkedin-line"></i>
            </a>
            <a href="#" class="social-icon-instagram">
              <i class="ri-instagram-line"></i>
            </a>
          </div>
        </div>
        <!--/ Footer -->
        
      </div>
    </div>
  </body>
</html>
';
	
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
	
//}

//}

//echo '</table>';
	
//}