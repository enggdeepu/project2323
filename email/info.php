<?php 
define("CONF_SMTP_SERVER",'mail.krishikalyan.com');
define("CONF_SMTP_USER",'noreply@krishikalyan.com');
define("CONF_SMTP_PORT",'26');
define("CONF_SMTP_PASS",'n3w3@GPc7C@8');
define("CONF_NO_REPLY_EMAIL",$no_reply_email);


require_once("../etemp/PHPMailer/PHPMailerAutoload.php");
require_once("../etemp/mail.fnc.php");




if($status=='1' && !empty($variable))
					{
					    						
						$email_body=placeholder_replacement($email_body,$arrsource_array,$value_array);
						
						  $contents=mailcreator(MAIL_TEMPLATE,array("{LOGO}" , "{FOOTER}" ,"{MAINCONTENT}"),array(WEB_LOGO_FULL_PATH.SYSTEM_LOGO, CONF_COPYRIGHT_TEXT, $email_body));
					    //print_r($contents); die;
						$mail = new PHPMailer;
						$mail->isSMTP();                                      
						$mail->Host = CONF_SMTP_SERVER; 
						$mail->SMTPAuth = true;                              
						$mail->Username = CONF_SMTP_USER;                          
						$mail->Password = CONF_SMTP_PASS;                         
						$mail->SMTPSecure = 'tls';                            
						$mail->From = CONF_SMTP_USER;
						$mail->FromName = SYSTEM_NAME;
						$mail->addAddress($variable); 
						$mail->addReplyTo(CONF_NO_REPLY_EMAIL, SYSTEM_NAME);
						$mail->WordWrap = 50;                                 
						$mail->isHTML(true);                                 
						$mail->Subject = $email_subject;
						$mail->Body    = $contents;
						if(!$mail->send()) {
						}
						
						// $Mes = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
						
									      			
					}