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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"> <html lang=="en" xml:lang="en">
<head>
<meta charset="utf-8" />
<meta name="x-apple-disable-message-reformatting"> 
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="https://fonts.googleapis.com/css?family=Helvetica:400,700" rel="stylesheet">
<title>Aghosh Grammar School</title> 
<style type="text/css"> body { background-color: #F2F2F2; color: #001E00; font-family: Helvetica, Arial, sans-serif !important; margin: 0; } table { line-height: inherit; font-size: inherit; } img { border-style: none; } .p-0-top { padding-top: 0 !important; } .p-30-left { padding-left: 30px !important; } .p-30-right { padding-right: 30px !important; } .p-10-left { padding-left: 10px !important; } .p-10-right { padding-right: 10px !important; } .card-box.next { margin-top: 40px; } .paragraph { margin-top: 20px; } .paragraph.is-small { margin-top: 10px; } .full-width-divider { margin-left: -20px; margin-right: -20px; } .parent-full-width { margin: 0 -20px; } a { text-decoration: none; color: inherit; } a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; } .row { overflow: hidden; } .address-link a { color: #65735B !important; text-decoration: none !important; } .mso-hidden { display: block; } @media (min-width: 600px) { .p-30-left-md { padding-left: 30px !important; } .p-30-right-md { padding-right: 30px !important; } .p-20-left-md { padding-left: 20px !important; } .p-20-right-md { padding-right: 20px !important; } .p-10-left-md { padding-left: 10px !important; } .p-10-right-md { padding-right: 10px !important; } .p-0-top-md { padding-top: 0 !important; } .card-box.first { margin-top: 30px; } .card-row { padding-left: 30px !important; padding-right: 30px !important; } .card-row-banner { padding-left: 50px !important; padding-right: 50px !important; } .split-details-row > span:last-child { float: right; } .banner { padding: 55px 58px 66px 50px !important; } .full-width-divider { margin-left: -30px; margin-right: -30px; } .p-xl-left-md { padding-left: 80px; } .m-0-top-md { margin-top: 0 !important; } .d-md-none { display: block !important; } .d-md-inline-bl { display: inline-block !important; } .parent-full-width { margin: 0 !important; } .button-holder { max-width: 280px !important; } .col-md-9 { width: 66%; float: left; } .col-md-6 { width: 50%; float: left; } .col-md-3 { width: 34%; float: left; } .align-right-desktop { text-align: right; } .desktop-hidden { display: none; } .desktop-visible { display: block; } } @media (max-width: 599px) { .m--xs-left-sm { margin-left: -5px; } .m--xs-right-sm { margin-right: -5px; } .d-md-none { display: none !important; } .p-0-left-md { padding-left: 0 !important; } .p-0-right-md { padding-right: 0 !important; } .w100percent { width: 100% !important; min-width: 100% !important; height: auto !important; } .mobile-display { display: block !important; width: auto !important; height: auto !important; overflow: visible !important; visibility: visible !important; float: none !important; max-height: inherit !important; line-height: normal !important; } .mobile-hidden { display: none; } .mobile-visible { display: block; } .ac { text-align: center !important; } .dn { display: none !important; } .db { display: block !important; } .plr0 { padding-left: 0px !important; padding-right: 0px !important; } .plr20{ padding-left: 20px !important; padding-right: 20px !important; } .pt0{ padding-top: 0px !important; } .pt10{ padding-top:10px !important; } .pt20{ padding-top:20px !important; } .pt30{ padding-top: 30px !important; } .pb0{ padding-bottom: 0px !important; } .pb10{ padding-bottom: 10px !important; } .pb20{ padding-bottom: 10px !important; } .pb30{ padding-bottom: 10px !important; } .split-details-row > span:first-child:after { content: "\a"; white-space: pre; } } 
</style>
<!--[if (mso)|(IE)]> <xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v" /> <style>v\: * { behavior: url(#default#VML); display: inline-block }</style> <!<![endif]--> <!--[if (gte mso 9)|(IE)]> <style> .mso-hidden { display: none; } .parent-full-width { margin: 0 !important; } .d-md-none { display: block !important; float: right; margin-left: 10px; } </style> <![endif]-->
</head>
<body> <!--[if mso]> <style type="text/css"> body, table, td, strong, h1, h2, h3, h4, h5, b {font-family: Arial, Helvetica, sans-serif !important;} </style> <![endif]--> 
<div style="display: none;">Aghosh Grammar School</div>
	<table bgcolor="#F2F2F2" border="0" cellpadding="0" cellspacing="0" width="100%"> 
		<tbody> 
			<tr> <!--[if (gte mso 9)|(IE)]> <td><table cellspacing="0" cellpadding="0" width="600" border="0" align="center"><tr> <![endif]--> 
				<td> 
					<div style="max-width: 600px; margin: 0 auto; font-size: 16px; line-height: 24px;"> 
						<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
							<tbody> 
								<tr> 
									<td> 
										<table border="0" cellpadding="0" cellspacing="0" class="card-box first" width="100%"> 
											<tbody> 
												<tr> 
													<td> 
														<table border="0" cellpadding="0" cellspacing="0" class="card-box" width="100%"> 
															<tbody> 
																<tr> 
																	<td style="background-color: white; padding-top: 30px; padding-bottom: 30px;" class="card"> 
																		<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
																			<tbody> 
																				<tr> 
																					<td align="left" style="padding-top: 0; padding-bottom: 20px; padding-left:30px"> 
																						<a href="https://aghosh.gptech.pk/" style="font-size: 25px; color:#a81417;"> 
																							<img src="https://aghosh.gptech.pk/uploads/logo.png" alt="Aghosh Grammar School" height="50" style=" vertical-align: middle; "> Aghosh Grammar School
																						</a> 
																					</td> 
																				</tr> 
																				<tr> 
																					<td class="card-row" style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; word-break: break-word; padding-left: 20px; padding-right: 20px; padding-top: 15px; padding-bottom: 15px; margin-left: px; margin-right: px; "> 
																						<h3 style="margin-top: 0; margin-bottom: 0; font-family: Helvetica, sans-serif; font-weight:normal; font-size: 20px; line-height: 26px; color: #001E00;">
																							Dear Ali Mohiudeen,
																						</h3> 
																					</td> 
																				</tr> 
																				
																				<tr> 
																					<td class="card-row" style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; word-break: break-word; padding-left: 20px; padding-right: 20px; padding-top: 15px; margin-left: px; margin-right: px; "> 
																						Kindly ensure to submit your child school fee payment for the month of March-2024 before due date to avoid any inconvenience In case of non payment of school fee by due date <b>15-03-2024</b> fine <b>Rs 300</b> will be imposed with monthly fee. 
																					</td> 
																				</tr> 
																				<tr> 
																					<td class="card-row" style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; word-break: break-word; padding-left: 20px; padding-right: 20px; font-weight: 600; padding-top: 30px; margin-left: px; margin-right: px; "> 
																						All Mobile Banking Payments 1 Bill Invoice ID: <span style="color:#00f">10000140002499358</span> 
																					</td> 
																				</tr> 
																				<tr> 
																					<td class="card-row" style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; word-break: break-word; padding-left: 20px; padding-right: 20px; padding-top: 10px; margin-left: px; margin-right: px; "> 
																						<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
																							<tr>
																								<td style="font-size: 0; line-height: 0;">&nbsp;</td>
																							</tr>
																						</table> 
																					</td> 
																				</tr> 
																				<tr> 
																					<td class="card-row" style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; word-break: break-word; padding-left: 20px; padding-right: 20px; padding-top: 30px; margin-left: px; margin-right: px; "> 
																						<table style="text-align: center;" width="100%" border="0" cellspacing="0" cellpadding="0"> 
																							<tr> 
																								<td> 
																									<div class="button-holder" style="text-align: center; margin: 0 auto;"> <!--[if mso]> <v:roundrect xmlns:v = "urn:schemas-microsoft-com:vml" xmlns:w= "urn:schemas-microsoft-com:office:word" href = "https://www.upwork.com/nx/find-work/?frkscc=n5upfFF5Ezog" style=" white-space: nowrap; height: 40px; v-text-anchor: middle; width: 230px;" arcsize = "5%" strokecolor = "#14A800" fillcolor =#14A800"> <w:anchorlock/> <center style="color: #FFFFFF; font-family: Helvetica, Arial,sans-serif; font-size: 16px; font-weight: normal;">Find Work</center> </v:roundrect> <![endif]--> 
																										<a target="_blank" style=" background-color: #14A800; border: 2px solid #14A800; border-radius: 70px; min-width: 200px; color: #FFFFFF; white-space: nowrap; font-weight: normal; display: block; font-family: Helvetica, Arial, sans-serif; font-size: 18px; line-height: 40px; text-align: center; font-weight:600;  text-decoration: none; -webkit-text-size-adjust: none; mso-hide: all; " href="#">Download Challan</a> 
																									</div> 
																								</td> 
																							</tr>
																						</table> 
																					</td> 
																				</tr> 
																				<tr> 
																					<td class="card-row" style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; word-break: break-word; padding-left: 20px; padding-right: 20px; padding-top: 30px; margin-left: px; margin-right: px; "> 
																						<div style="padding-top: 10px;">Regards:<br>Accounts Department<br>Aghosh Grammar School</div> 
																					</td> 
																				</tr> 
																			</tbody> 
																		</table> 
																	</td> 
																</tr> 
															</tbody> 
														</table> 
													</td> 
												</tr> 
											</tbody> 
										</table> 
									</td> 
								</tr> 
							</tbody> 
						</table> 
						<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
							<tbody> 
								<tr> 
									<td align="center" width="100%" style="color: #65735B; font-size: 12px; line-height: 24px; padding-bottom: 30px; padding-top: 30px;"> 
										<a href="https://aghosh.gptech.pk/" style="color: #65735B; text-decoration: underline;">Web Portal</a> &nbsp; | &nbsp; 
										<a href="https://aghosh.edu.pk/" style="color: #65735B; text-decoration: underline;">Website</a> &nbsp; | &nbsp; 
										<a href="https://www.aghosh.edu.pk/english/tid/16478/Contact-Us.html" style="color: #65735B; text-decoration: underline;">Contact Us</a> 
										<div style="font-family: Helvetica, Arial, sans-serif; word-break: normal;" class="address-link">
											Shah-e-Jilani Road, Baghdad Town, Township Lahore
										</div> 
										<div style="font-family: Helvetica, Arial, sans-serif; word-break: normal;" >&copy; 2024 Aghosh Grammar School.</div> 
									</td> 
								</tr> 
							</tbody> 
						</table> 
					</div> 
				</td> <!--[if (gte mso 9)|(IE)]> </tr></table></td> <![endif]--> 
			</tr> 
		</tbody> 
	</table>
</body>
</html>';
	
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