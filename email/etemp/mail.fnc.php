<?php
function get_email_template($con, $integration_code){ 
    $emsg = array();
    $response = 'NA';
    $pagetable = "message_templates";
    $message ='';
    $status  = 0;
    
        $email_templatesQry = "select `id`,`subject`,`body` from `$pagetable` where `integration_code` = '$integration_code' and `status`='1' limit 1";
        $email_templatesQryArrayrow = runQuery($email_templatesQry);
        $email_templatesCount=  $email_templatesQryArrayrow['count'];
        if(email_templatesCount >0){
			$status  = 1;
            $message = $email_templatesQryArrayrow[0]['body']; 
            $emsg['subject'] = $email_templatesQryArrayrow[0]['subject'];             
        }
        else {
			$message = "Invalid message integration code supplied.";
        }
         
        
    $emsg['message'] = $message;
    $emsg['status'] = $status;
    return $emsg;
}

function mailcreator($temp_name,$arrsource,$arrdestination)
{
	$contents=template_to_var($temp_name);
	for($i=0,$j=0;isset($arrsource[$i]),isset($arrsource[$j]);$i++,$j++)
	$contents=str_replace($arrsource[$i],$arrdestination[$j],$contents);
	
	return $contents;
}

function Replace_msgVar($VarArray,$email_template_body) {
	
	foreach($VarArray as $key=>$val){
		$email_template_body = str_replace($key, $val, $email_template_body);
	}
	 
	return $email_template_body;
}

function template_to_var($V139c8722)
{
	$V0666f0ac=fopen($V139c8722,'r');
	$V341be97d=file_get_contents($V139c8722);
	fclose($V0666f0ac);
	return $V341be97d;
}
function var_to_template($V344336af,$Ve86de33f)
{
	if(file_exists($Ve86de33f))
	{
	 $V8fa14cdd=unlink($Ve86de33f);
	}
	$V0666f0ac=fopen($Ve86de33f,'w+'); 
	$Vefb2a684=fwrite($V0666f0ac,$V344336af);
	$V2c07ea45=fclose($V0666f0ac);
}
?>