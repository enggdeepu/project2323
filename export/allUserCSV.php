<?php
$EPLANCODE = "54";
$PAGENAME = " Users";
include("../Query.Inc.php"); 
include("LoginCheck_inc.php");
include("checkuserpermissions.php");$required_action_permission=1;
include("check_action_permission.php");
$PAGETNAME = "".MYSQL_TABLE_PRFIX."_admin_users";
$dynaquery='';

$name =(isset($_POST['name'])&&$_POST['name']!="")?$_POST['name']:''; 
if($name!='') 
	$dynaquery.=" and `$PAGETNAME`.`admin_name` like '%".mysql_real_escape_string($name)."%' ";
	
	
$tp =(isset($_POST['tp'])&&$_POST['tp']!="")?$_POST['tp']:'';
if($tp!='') 
	$dynaquery.=" and `$PAGETNAME`.`type` = '".mysql_real_escape_string($tp)."' ";
	
	

$email =(isset($_POST['email'])&&$_POST['email']!="")?$_POST['email']:''; 
if($email!='') 
	$dynaquery.=" and `$PAGETNAME`.`admin_email`='".mysql_real_escape_string($email)."' ";


$mobile =(isset($_POST['mobile'])&&$_POST['mobile']!="")?$_POST['mobile']:''; 
if($mobile!='') 
	$dynaquery.=" and `$PAGETNAME`.`admin_mobile` like '%".mysql_real_escape_string($mobile)."%' ";




$st =(isset($_POST['st'])&&$_POST['st']!="")?$_POST['st']:'';
if($st!='') 
	$dynaquery.=" and `$PAGETNAME`.`state_id` = '".mysql_real_escape_string($st)."' ";



$ci =(isset($_POST['ci'])&&$_POST['ci']!="")?$_POST['ci']:''; 
if($ci!='') 
	$dynaquery.=" and `$PAGETNAME`.`city_id` = '".mysql_real_escape_string($ci)."' ";
	
$dynaquery.=" order by `$PAGETNAME`.`id` DESC ";



 $qury="SELECT `$PAGETNAME`.`id` ,
`$PAGETNAME`.`admin_name` ,
`$PAGETNAME`.`type` ,
`$PAGETNAME`.`admin_email`,
`$PAGETNAME`.`admin_mobile`,
`$PAGETNAME`.`profile_photo`,
`$PAGETNAME`.`admin_address`,
`$PAGETNAME`.`about_self`,
`$PAGETNAME`.`status`,
`$PAGETNAME`.`inserted_datetime`,
`$PAGETNAME`.`updated_datetime`,
`".MYSQL_TABLE_PRFIX."_states`.`name` as statename,
`".MYSQL_TABLE_PRFIX."_cities`.`name` as cityname
FROM `$PAGETNAME` 
LEFT JOIN `".MYSQL_TABLE_PRFIX."_states` ON `".MYSQL_TABLE_PRFIX."_states`.`id` = `$PAGETNAME`.`state_id`
LEFT JOIN `".MYSQL_TABLE_PRFIX."_cities` ON `".MYSQL_TABLE_PRFIX."_cities`.`id` = `$PAGETNAME`.`city_id`
where `$PAGETNAME`.`id`>'0' and (`$PAGETNAME`.`type`='User' or `$PAGETNAME`.`type`='Retail')  $dynaquery "; 


$rowcount = mysql_num_rows(mysql_query($qury)); 

if($rowcount>0){
	$record = "";
  	$record .= "\n";
	$record .= "S.ID, ";
	$record .= "Name, ";
	$record .= "Type, ";
	$record .= "Email, ";
	$record .= "Mobile, ";
	$record .= "Profile photo, ";
	$record .= "Address, ";
	$record .= "City Name, ";
	$record .= "State Name, ";
	$record .= "About Self, ";
	$record .= "Status, ";
	$record .= "Created DateTime, ";
	$record .= "Updated DateTime, ";
	$record .= "\n\n";
 
$sncounter =1;
$rowsql = mysql_query($qury); 
while($rows = mysql_fetch_assoc($rowsql)){ 

$row=array(); 
foreach($rows as $key=>$value){
 $value=str_replace(',',';',$value);
 $row[$key]=$value;
}



$profile_photo = $row['profile_photo'];
$image= $pphoto =isset($profile_photo) && $profile_photo!=''?WEB_UPLOAD_PATHTHUMB.$profile_photo:NO_IMG_URL_WEB;

$status = "";
if($row['status']=='1')
$status = "Active";
elseif($row['status']=='0')
$status = "In-Active";

$type_name='Retailer';
if($row['type']=='User')
$type_name='User';


		$record .= $sncounter . ", ";
		$record .= $row['admin_name'] . ", ";
		$record .= $type_name . ", ";
		$record .= $row['admin_email']. ", ";
		$record .= $row['admin_mobile']. ", ";
		$record .= $image . ", ";
		$record .= $row['admin_address']. ", ";
		$record .= $row['cityname']. ", ";
		$record .= $row['statename']. ", ";
		$record .= $row['about_self']. ", ";
		$record .= $status. ", ";
		$record .= timestamp_to_date($row['inserted_datetime']). ", ";
		$record .= timestamp_to_date($row['updated_datetime']). ", ";
	    $record .= "\n";
$sncounter++;
}
// Open file export.csv.
$f = fopen ('bankup.csv','w');
// Put all values from $out to export.csv.
fputs($f, $record);
fclose($f);	
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="'.$system_name.'_user_'.time().'.csv"');
readfile('bankup.csv');
 
} 
else {
echo "<script language=\"javascript\">
		alert(\"No Record found.\");
		history.back();		
		</script>";		
} 


?> 