<?php
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
function createdir($V954eef6d)
{	if(!is_dir($V954eef6d))
	$V099dafc6=mkdir($V954eef6d);
}
function csptous($V6958569d)
{
	return str_replace(" ","_",$V6958569d);
}
function common_replace($Vbc484de3)
{
	$Vbc484de3=str_replace("{SITE_NAME}",SITENAME,$Vbc484de3);
$Vbc484de3=str_replace("{GOOGLE_ADWORDS}","GOOGLE ADWORDS HERE",$Vbc484de3);
$Vbc484de3=str_replace("{YAHOO_ADS}","YAHOO ADVERTISEMENT HERE",$Vbc484de3);
return $Vbc484de3;
}
function converlimited($V132b0927,$Vaa9f73ee)
{
	$Vf5a8e923=strlen($V132b0927);
if($Vf5a8e923 <= $Vaa9f73ee)
 return $V132b0927;
else
 {
 $V07003ece=substr($V132b0927,0,$Vaa9f73ee);
return str_replace(strrchr($V07003ece," ")," ",$V07003ece)."....";
}
}
function mailgo($Vd98a07f8,$V01b6e203,$Vb5e3374e,$V78e73102,$Vb922da09="")
{	$V4340fd73="";
$V4340fd73 .= "Content-type: text/html; charset=iso-8859-1\r\n";
$V4340fd73 .= "From: ".$Vd98a07f8."\r\n";  
 return $V7916cb93 = mail($V01b6e203, $Vb5e3374e, $V78e73102, $V4340fd73); 
	}
function mail_c($Vd98a07f8,$V01b6e203, $Vb5e3374e,$V78e73102, $Vb922da09="")
{
	$V4340fd73="";
$V4340fd73 .= "Content-type: text/html; charset=iso-8859-1\r\n";
$V4340fd73 .= "From: ".$Vd98a07f8."\r\n";
$V344336af="Subject".$Vb5e3374e."<br><br>";
$V344336af.="Message".$V78e73102."<br><br>";
$V344336af.="Headers".$V4340fd73."<br><br>";
//var_to_template($V344336af,"testmails/Mail To ".$V01b6e203.date("Y-m-d H-i-s").".html");
}
function mail_live($Vd98a07f8,$V01b6e203, $Vb5e3374e,$V78e73102, $Vb922da09="")
{
	$V4340fd73="";
$V4340fd73 .= "Content-type: text/html; charset=iso-8859-1\r\n";
$V4340fd73 .= "From: ".$Vd98a07f8."\r\n";
$V344336af="Subject".$Vb5e3374e."<br><br>";
$V344336af.="Message".$V78e73102."<br><br>";
$V344336af.="Headers".$V4340fd73."<br><br>";
$extvar=mailgo($Vd98a07f8,$V01b6e203,$Vb5e3374e,$V78e73102,$Vb922da09);
//var_to_template($V344336af,"etemp/Mail To ".$V01b6e203.date("Y-m-d H-i-s")."_".$extvar.".html");
}
?>