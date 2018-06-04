<?php 

$nuberofDEFAIJAJK =mysql_fetch_assoc(mysql_query("select  `system_name`, `pass_len_min`, `pass_len_max`, `mobile_len_min`, `mobile_len_max`, `support_email`, `no_reply_email`, `support_phone`, `logo`, `facebook_url`, `twitter_url`, `gplus_url`, `linkdin_url` from `system_configs`"));

$system_name = $nuberofDEFAIJAJK['system_name'];
$pass_len_min = $nuberofDEFAIJAJK['pass_len_min'];
$pass_len_max = $nuberofDEFAIJAJK['pass_len_max'];
$mobile_len_min = $nuberofDEFAIJAJK['mobile_len_min'];
$mobile_len_max = $nuberofDEFAIJAJK['mobile_len_max'];

$school_mail = $nuberofDEFAIJAJK['support_email'];
$no_reply_email = $nuberofDEFAIJAJK['no_reply_email'];
$support_phone = $nuberofDEFAIJAJK['support_phone'];
$logo_master = $nuberofDEFAIJAJK['logo'];


$facebook_url = $nuberofDEFAIJAJK['facebook_url'];
$twitter_url = $nuberofDEFAIJAJK['twitter_url'];
$gplus_url = $nuberofDEFAIJAJK['gplus_url'];
$linkdin_url = $nuberofDEFAIJAJK['linkdin_url'];


define("SYSTEM_IMG_PATH",ROOTPATH."img/");
define("SYSTEM_LOGO_UPLOAD_DIR_PATH","../img/");
define("WEB_UPLOAD_PATH",ROOTPATH."images/upload/");
define("SYSTEM_LOGO",$system_logo);
define("SYSTEM_FULL_PATH_LOGO",return_imgFULLpath(SYSTEM_LOGO));


function return_imgFULLpath($img){ 
	if(trim($img)!='')
    $system_logo	= SYSTEM_LOGO_UPLOAD_DIR_PATH.$img;
	return $system_logo;	
}


define("SECUREKEY",'JHKJDHHQHQHHBHJVJA48744545'); 
define("ROOTPATH","http://xyz.com/");
define("USER_UPLOAD_PATH","../images/upload/");
define("CLIENT_SITEURL",ROOTPATH."client/index.php");
define("ADMIN_SITEURL",ROOTPATH."/admin/index.php");
define("COPYRIGHT","Copyrights 2018 &copy; All rights reserved at ".$system_name);
define("MAIL_TEMPLATE",ROOTPATH."etemp/myEmailTemplate.html");
define("TITLE",$system_name);
define("SITETITLE",$system_name);


$SmtpServer="mail.".$domain;
$SmtpPort="26"; 
//$SmtpUser="no-reply@".$domain;
$SmtpUser=$no_reply_email;
$SmtpPass="welcome@1223";


			$domain = remove_http($_SERVER['HTTP_HOST']);
				$temp = mysql_fetch_array(mysql_query("SELECT `email_subject`,`email_body`  FROM `email_templates` where `code`='REG' and `status`='1'"));
			
				
				$arr=array(
				"{NAME}" =>$name,
				"{BY}" =>$enteredbyname,
				"{ROOTPATH_USERS}" =>ROOTPATH_USERS,
				"{SITETITLE}" =>SITETITLE,
				"{USERNAME}" =>$username,
				"{PASSWORD}" =>$password,
				);
				$go = '';
				if($rank['type']=='ADMIN'){
					$go = 'qualification';
				}
				$MAINCONTENT = Replace_msgVar($arr,$temp['email_body']);
				
				if($logo_master!=''){$logo="<img src='".$logo_master."' width='300' alt='".$system_name."'  alt='Logo'/>"; }
				
				$COPYRIGHT = "copyright 2013 &copy; All rights reserved at ".$system_name;
				$contents=mailcreator(MAIL_TEMPLATE,array("{LOGO}" , "{FOOTER}" , "{MAINCONTENT}"),array($logo, $COPYRIGHT, $MAINCONTENT));				
				if($email!=''){
				///////////////////////////////////////////
						$mail = new PHPMailer;
						$mail->isSMTP();                                      
						$mail->Host = $SmtpServer;  
						$mail->SMTPAuth = true;                               
						$mail->Username = $SmtpUser;                            
						$mail->Password = $SmtpPass;                          
						$mail->SMTPSecure = 'tls';                           
						$mail->From = $SmtpUser;
						$mail->FromName = $system_name;
						$mail->addAddress($email);  
						$mail->addReplyTo($school_mail, $system_name);
						$mail->WordWrap = 50;                                 
						$mail->isHTML(true);                                  
						$mail->Subject = $temp['email_subject'];
						$mail->Body    = $contents;
						if(!$mail->send()) {
						   $Mes = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
						}
					///////////////////////////////////////////
					}
					
					
?>					