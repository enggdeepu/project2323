<?php
$EPLANCODE = "54";
$PAGENAME = " User & Retailer";
include("page_start_inc.php");
include("../fncs/sendsms_fnc.php"); 
include("../SMTP_class/SMTPclass.php");
include("../fncs/upload.class.php"); 
include("../fncs/imgup.fnc.php"); 
include("../etemp/mail.fnc.php");
require '../fncs/PHPMailer/PHPMailerAutoload.php';
include("LoginCheck_inc.php");
include("checkuserpermissions.php");$required_action_permission=2;
include("check_action_permission.php");

$Eid =(isset($_GET['eid'])&&$_GET['eid']!="")?custom_decrypt($_GET['eid']):'0';
$PAGETNAME = "".MYSQL_TABLE_PRFIX."_admin_users";
$type='User'; $type_name='User';
$admin_name = '';$admin_mobile = '';
$admin_email = '';$about_self = '';
$admin_address = '';
$country_id = $system_country_id;
$state_id = "";
$city_id = '';
$status = '1';
$thispageis ="user.php?";
$icon ='';
$about_self='';
$passtype='Auto';



if($Eid > 0) {
	$idnrcount = check_record_existrow_usingID($PAGETNAME,$Eid);
    if($idnrcount>0) 
	{
		$sql = mysql_query("select * from `$PAGETNAME` where `id` = '".$Eid."' ") ;
		$DataArray = mysql_fetch_assoc($sql) ;
		$Eid=$DataArray['id'];
		$type= $DataArray['type']; 
		$passtype= $DataArray['passtype']; 
		$status= $DataArray['status']; 
		$admin_name= $DataArray['admin_name'];  
		$admin_email= $DataArray['admin_email'];
		$admin_mobile= $DataArray['admin_mobile']; 
		$about_self= $DataArray['about_self']; 
		$admin_address= $DataArray['admin_address']; 
		$country_id= $DataArray['country_id']; 
		$state_id= $DataArray['state_id']; 
		$city_id= $DataArray['city_id'];
	}	
}

if(isset($_POST['submit']) && $_POST['submit']!='')
{
	
	$emsg = $msg =''; 
	$runtimeid = check_record_existrow_usingID($PAGETNAME,$Eid);
		
		//for add only use
	if($Eid<1) {
	$passtype= sql_safe(trim($_POST['passtype']));  // Custom // Auto
	}
	
	$admin_mobile= trim(sql_safe($_POST['admin_mobile']));			
	$admin_email= sql_safe(trim($_POST['admin_email']));
	$admin_name= sql_safe(trim($_POST['admin_name']));
	$admin_address= sql_safe(trim($_POST['admin_address']));
	$country_id= sql_safe(trim($_POST['country_id']));
	$state_id= sql_safe(trim($_POST['state_id']));
	$city_id= sql_safe(trim($_POST['city_id']));
	$about_self= sql_safe(trim($_POST['about_self']));
	

	
	 /*if($city_id=='') 
		$emsg= "City selection is required."; 
		
		
	 if($state_id=='') 
		$emsg= "State selection is required."; 
		
		
		if($country_id=='') 
		$emsg= "Country selection is required."; 
		*/
		
		
		
		if($Eid<1) {	
		//for add apply validation
	
	if($passtype=='Custom') {	
 	$password= trim(sql_safe($_POST['password']));	
    $conf_password= trim(sql_safe($_POST['conf_password']));
		
	  	if(strlen($password)<PASS_MIN_LEN || strlen($password)>PASS_MAX_LEN)
		$emsg= "Password should be ".PASS_MIN_LEN." to ".PASS_MAX_LEN." character long.";	
		
		if(trim($password)!=trim($conf_password))
		$emsg= "Password and Confirm Password doesn't match.";		

	    if(trim($password)=='')
		$emsg= "Password is required.";	
	
     }
	 
    }		 
 	
 
   if(trim($passtype)=='') 
		$emsg= "Please select password generation type."; 
		
   
		if(trim($admin_name)=='') 
		$emsg= "Display Name is required.";
				
 	  
			
	$IsMobileExist = mysql_num_rows(mysql_query("select `id` from `$PAGETNAME` where  `id`!= '".$Eid."' and `admin_mobile`='".$admin_mobile."'"));	
	if($IsMobileExist>0)  
		$emsg= "Mobile number already exist.";		
		
   if(trim($admin_mobile)=='' || $admin_mobile<1 || strlen($admin_mobile)!=$system_mobile_len) 
		$emsg= "Mobile number format invalid.It's should be ".$system_mobile_len." digits";	
				
	

   $IsEmailExist = mysql_num_rows(mysql_query("select `id` from `$PAGETNAME` where  `id`!= '".$Eid."' and `admin_email`='".$admin_email."'"));	
	if($IsEmailExist>0)  
		$emsg= "Email address already exist.";
	
	if(!filter_var($admin_email, FILTER_VALIDATE_EMAIL))		
	  $emsg= "Email address is invalid."; 
	  	  
	 		
	
		
if($passtype=='Auto') {
	 $password = rand(11111111,99999999);
 }
 
	

   $profile_photo ='';
   	if(isset($_FILES['profile_photo']['name'])&& $_FILES['profile_photo']['name']!="" && $emsg=="")	{		
		              $arrimg=uploadiwtfiles($_FILES['profile_photo'],ADMIN_UPLOAD_PATH,'','',0,0,'800','N');
						if($arrimg[0]){	
						 $profile_photo =$arrimg[1];
						}
						else
						$emsg.=$arrimg[1];
	}
		
    
   
	if($emsg=='')
	{ 	
	
	$inserted_datetime= $updated_time= current_timestamp();	
     if($Eid>0 && $runtimeid >0){
	 
	 
	 		if($profile_photo==''){
				 $selectedurl= mysql_fetch_array(mysql_query("select `profile_photo` from `$PAGETNAME` where  `id`= '".$Eid."' "));
				 $profile_photo =$selectedurl['profile_photo']; 
			}
			else {
			     $selectedurl= mysql_fetch_array(mysql_query("select `profile_photo` from `$PAGETNAME` where  `id`= '".$Eid."' "));
				 $profile_photodel =$selectedurl['profile_photo'];
				 
				 if($profile_photodel!='')
				 unlink(ADMIN_UPLOAD_PATH.$profile_photodel);
	         }
	 
	
	$inssql= "UPDATE `$PAGETNAME` SET
		`admin_name`='".$admin_name."',
		`admin_mobile`='".$admin_mobile."',
		`admin_email`='".$admin_email."',
		`about_self`='".$about_self."',
		`admin_address`='".$admin_address."',
		`country_id`='".$country_id."', 
		`state_id`='".$state_id."', 
		`city_id`='".$city_id."', 
		`profile_photo`='".$profile_photo."', 
		`updated_datetime`='".$updated_time."' WHERE `id`='".$Eid."' ";
		mysql_query($inssql);
		$msg ="Record Updated successfully.";  
  }
  else
  {

   $inssql= "insert into `$PAGETNAME` (`type`,`passtype`,`status`,`admin_name`,`admin_mobile`,`admin_email`,`about_self`,`admin_password`,`admin_address`,`country_id`,`state_id`,`city_id`,`profile_photo`,`inserted_datetime`,`updated_datetime`) 
		                values('$type','$passtype','$status','".$admin_name."','".$admin_mobile."','".$admin_email."','".$about_self."','".custom_encrypt($password)."','".$admin_address."','".$country_id."','".$state_id."','".$city_id."','".$profile_photo."','".$inserted_datetime."','".$updated_time."')";   
		$msg ="Record Added successfully.";
	mysql_query($inssql);		
 
    $Etempid =0;
	$Stempid =0;

	 $EmailSQL = mysql_query("select * from   `".MYSQL_TABLE_PRFIX."_email_templates` where `status`= '1' AND `slug`='user-or-retailer-registration-email' ");	
	 $EmailSQLRows = mysql_fetch_assoc($EmailSQL);
	 $Etempid = $EmailSQLRows['id'];
	 $subject = $EmailSQLRows['subject'];
	  $content = $EmailSQLRows['content'];
	  
	 $SMSSQL = mysql_query("select * from `".MYSQL_TABLE_PRFIX."_sms_events` where `status`= '1' AND `slug`='user-or-retailer-registration-sms' ");	
	 $SMSSQLRows = mysql_fetch_assoc($SMSSQL);
	 $Stempid = $SMSSQLRows['id'];
	 $SMScontent = $SMSSQLRows['content']; 
	  
	
	$emailasusername=	$admin_email;			   
	if($emailasusername!='' && $Etempid>0) {
		
	$content = str_replace("#NAME#",$admin_name,$content);
	$content = str_replace("#RANK#",$type_name,$content);
	$content = str_replace("#MOBILE#",$admin_mobile,$content);
	$content = str_replace("#USERNAME#",$emailasusername.' / '.$admin_mobile,$content);
	$content = str_replace("#PASSWORD#",$password,$content);
	$content = str_replace("#SITENAME#",SYSTEMNAME,$content);
	$content = str_replace("#SITEURL#",ROOTPATH,$content);
		
			 
				
    $body = $content;		
	$to = $emailasusername; 
	$contents=mailcreator(MAIL_TEMPLATE,array("{LOGO}" , "{FOOTER}" ,"{MAINCONTENT}"),array(SYSTEMLOGO_COMPLETEPATH, SYSTEMCOPYRIGHT, $body));
	
	
					///////////////////////////////////////////
					
					
					    $mail = new PHPMailer;
						$mail->isSMTP();                                      
						$mail->Host = SMTP_SERVER;  
						$mail->SMTPAuth = true;                              
						$mail->Username = SMTP_USER;                          
						$mail->Password = SMTP_PASSWORD;                         
						$mail->SMTPSecure = 'tls';                       
						$mail->From = SMTP_USER;
						$mail->FromName = SYSTEMNAME;
						$mail->addAddress($to); 
						$mail->addReplyTo(NO_REPLY_EMAIL, SYSTEMNAME);
						$mail->WordWrap = 50;                                
						$mail->isHTML(true);                               
						$mail->Subject = $subject;
						$mail->Body    = $contents;
						if(!$mail->send()) { }
					
					///////////////////////////////////////////			
			   }
			   
			   
	if($admin_mobile!='' && $Stempid>0) {
		
	$SMScontent = str_replace("#NAME#",$admin_name,$SMScontent); 
	$SMScontent = str_replace("#RANK#",$type_name,$SMScontent);
	$SMScontent = str_replace("#USERNAME#",$emailasusername.' / '.$admin_mobile,$SMScontent);
	$SMScontent = str_replace("#PASSWORD#",$password,$SMScontent); 
	$SMScontent = str_replace("#SITEURL#",ROOTPATH,$SMScontent);
    FireSMS($admin_mobile,$SMScontent);
  }	
  
  
  
  }
  	   
	jump("user.php?msg=".$msg);
	exit;
    }

}
?>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="../admassets/global/plugins/select2/select2.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="../admassets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="../admassets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content">
<?php include("headermain_inc.php");?>   
 <script src="function.js"></script>	
 <div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<?php include("left_menu_inc.php");?> 	
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
 			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Manage <?php echo $PAGENAME;?>  
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
				<li>
						<i class="fa fa-home"></i>
						<a href="welcome.php">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#"> <?php echo $PAGENAME;?></a>
					</li>
				</ul>
				<div class="page-toolbar">
					<div class="btn-group pull-right">
						 
					</div>
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
	 

 <div class="row">
   <div class="col-md-12">
                       <?php if($emsg!='') { ?>  
                            
       <div class="alert alert-danger alert-dismissable">
<strong>Error!</strong>
<?php echo $emsg;?>
</div>                     
      <?php }   if($msg!='') {  ?>
      
      <div class="alert alert-success alert-dismissable">
<strong>Success!</strong>
<?php echo $msg;?>
</div> 
      <?php }  ?>
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					 <div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-book"></i> Add/Edit <?php echo $PAGENAME;?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
			<div class="portlet-body form">
 
      
      
      
										<!-- BEGIN FORM-->
		 <form action="" class="horizontal-form" method="post" enctype="multipart/form-data">
		
                         
											<div class="form-body">		
											
											<div class="row">
											       <div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Email <span class="required" aria-required="true"> <strong>* </strong></span></label>
<div class="input-group">
<span class="input-group-addon">
<i class="icon-envelope"></i>
</span>	
<input type="email" name="admin_email" id="admin_email"    placeholder="Email" value="<?php echo $admin_email;?>" class="form-control" />	</div>
													</div>
												</div>	
												
												<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Mobile Number <span class="required" aria-required="true"> <strong>* </strong></span></label>
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-mobile"></i>
</span>	
 <input  name="admin_mobile" id="admin_mobile" onKeyUp="onlynewmwric(this.id);"  placeholder="Mobile..." maxlength="<?php echo $system_mobile_len;?>"  value="<?php echo $admin_mobile;?>" class="form-control" type="text"> 
</div>															
                                                           
														</div>
													</div>
                                                                                                  
												</div>
											
											
											
											
												
                                          
											 <div class="row">
													
                                                    
													<!--/span-->
													<div class="col-md-6">
													<div class="form-group">
															<label class="control-label">Display Name <span class="required" aria-required="true"> <strong>* </strong></span></label>
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-user"></i>
</span>	
<input class="form-control" name="admin_name" id="admin_name"  onKeyUp="alphaonly(this.id);"  placeholder="Complete Name" value="<?php echo $admin_name;?>" type="text"> 
</div>
														</div>
														
													</div>
													
													
													 <div class="col-md-3">
													
														<div class="form-group">
															<label class="control-label">Profile photo</label>
															 <input type="file" name="profile_photo" class="default">
														</div>
														
															</div>
													
													
													    <div class="col-md-2">
														
														
														<div class="form-group" <?php if($Eid>0){?> style="display:none" <?php } ?>>
															<label class="control-label">Password Type <span class="required" aria-required="true"> <strong>* </strong></span></label>
 
<select class="form-control" name="passtype" id="passtype" onChange="ajxpg('askforpassword.php?ptype='+this.value,'showmepasswordfields','slide');"  >
<?php  
foreach($Conf_Pass_Type as $keyM => $valm){
?>
 <option value="<?php echo $valm;?>"  <?php if($valm==$passtype){ ?> selected <?php } ?>><?php echo $valm;?></option>
<?php 
} 
?>                           
                                        </select> 
														</div>
												</div>	
												
												
												<div class="col-md-1"></div>
														 
														
													</div>
													
												
											    <span id="showmepasswordfields" >                                               
                                                
 <?php if($Eid<1 && $passtype=='Custom') { ?>                                                 		
                             <div class="row">
                             
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Password <span class="required" aria-required="true"> <strong>* </strong></span></label>
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-lock"></i>
</span>	
<input class="form-control" type="password" name="password" id="password" placeholder="" value=""> 
</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Confirm Password <span class="required" aria-required="true"> <strong>* </strong></span></label>
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-lock"></i>
</span>	
 <input type="password" name="conf_password" id="conf_password" placeholder="Confirm Password" value="" class="form-control" > 
</div>															
                                                           
														</div>
													</div>
													<!--/span-->                                              
												</div>  
                                                
  <?php } ?>    
  </span>	
												
                                                
  <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">About Self </label>

  <textarea id="about_self" class="form-control" placeholder="About Self" name="about_self"><?php echo $about_self;?></textarea> 

														
                                                           
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Address </label>
<div class="input-group col-md-12"> 
<textarea id="admin_address" class="form-control" placeholder="Address" name="admin_address"><?php echo $admin_address;?></textarea> 
</div>
														</div>
													</div>
													<!--/span-->                                              
												</div>
  
                                                
                                        <div class="row">
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Country </label>
															<select class="select2_category form-control" name="country_id" id="country_id" onChange="ajxpg('new_list.php?tbl=<?php echo "".MYSQL_TABLE_PRFIX."_states" ?>&id='+this.value,'state_id','fade');" >        
   <option value="">Select</option>
<?php 
$select = mysql_query("select `id`,`name` from `".MYSQL_TABLE_PRFIX."_countries` where `status`= '1' order by `name` ASC");
if(mysql_num_rows($select)>0){
while($row = mysql_fetch_assoc($select)){ 
?>     
<option <? if($country_id==$row['id']){ ?> selected="selected" <?php } ?> value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
<?php } 

} ?>
 </select>
    
														</div>
													</div>
													<!--/span-->
													
													<div class="col-md-6">
<div class="form-group">
<label class="control-label">State </label>
<div class="controls">
 <select class="select2_category form-control" name="state_id"  id="state_id" onClick="ajxpg('new_list.php?tbl=<?php echo "".MYSQL_TABLE_PRFIX."_cities" ?>&id='+this.value,'city_id','fade');">        
   <option value="">Select</option>
<?php 
$dynaquery_country='';
if($country_id!='') 
$dynaquery_country.=" and `country_id` = '".$country_id."' ";

$select = mysql_query("select `id`,`name` from `".MYSQL_TABLE_PRFIX."_states` where `status`= '1' $dynaquery_country order by `name` ASC");
if(mysql_num_rows($select)>0){
while($row = mysql_fetch_assoc($select)){ 
?>     
<option <? if($state_id==$row['id']){ ?> selected="selected" <?php } ?> value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
<?php } 

} ?>
 </select></div>
</div>
</div>
													<!--/span-->                                              
												</div>                         
                                                 
                                                
                                        <div class="row">
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">City </label>
<div class="input-group col-md-12"> 
<select class="select2_category form-control" name="city_id" id="city_id">        
   <option value="">Select</option>
<?php 
$dynaquery_state='';
if($state_id!='') 
$dynaquery_state.=" and `state_id` = '".$state_id."' ";

$select = mysql_query("select `id`,`name` from `".MYSQL_TABLE_PRFIX."_cities` where `status`= '1' $dynaquery_state order by `name` ASC");
if(mysql_num_rows($select)>0){
while($row = mysql_fetch_assoc($select)){ 
?>     
<option <? if($city_id==$row['id']){ ?> selected="selected" <?php } ?> value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
<?php } 

} ?>
 </select>
</div>
														</div>
													</div>
													   

                                                        <div class="col-md-6"></div>
													<!--/span-->
                                             </div>
                                       
									   
					
									   
                                                       								 
											</div>
											<div class="form-actions right">
												<button type="button" onClick="window.location='<?php echo $thispageis;?>'"  class="btn default"><i class="fa fa-th-list"></i> Back to List</button>
												<button type="submit" name="submit" value="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
											</div>
										</form>
										<!-- END FORM-->
								 
							 
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			 
			<!-- END PAGE CONTENT-->
             
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>
  
			 
		 
			 
		 
			 
			 
			 
		</div>
	</div>
	<!-- END CONTENT -->
	 
</div>


<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		  <?php echo $system_powerby_text;?> &copy; <?php echo $system_copyright_text;?>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../admassets/global/plugins/respond.min.js"></script>
<script src="../admassets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../admassets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="../admassets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../admassets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="../admassets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../admassets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../admassets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../admassets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../admassets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../admassets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../admassets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../admassets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../admassets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../admassets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../admassets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../admassets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../admassets/admin/pages/scripts/form-samples.js"></script>
<script type="text/javascript" src="../admassets/global/plugins/ckeditor/ckeditor.js"></script>
<script src="../js/ajxpg.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {   
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   FormSamples.init();
   ComponentsFormTools.init();
   
   
   
});
</script>
<?php include("page_end_inc.php");?>   