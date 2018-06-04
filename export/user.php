<?php 
$EPLANCODE = "54";
$PAGENAME = " Users & Retailers";
include("page_start_inc.php");
include("LoginCheck_inc.php");
include("checkuserpermissions.php");
$required_action_permission=1;
include("check_action_permission.php");

$limit = 50; 
$PAGETNAME = "".MYSQL_TABLE_PRFIX."_admin_users";
include("../paging_header.php");

$dynaquery=''; 



$name =(isset($_GET['name'])&&$_GET['name']!="")?$_GET['name']:''; 
if($name!='') 
	$dynaquery.=" and `$PAGETNAME`.`admin_name` like '%".mysql_real_escape_string($name)."%' ";
	

$tp =(isset($_GET['tp'])&&$_GET['tp']!="")?$_GET['tp']:'';
if($tp!='') 
	$dynaquery.=" and `$PAGETNAME`.`type` = '".mysql_real_escape_string($tp)."' ";


$email =(isset($_GET['email'])&&$_GET['email']!="")?$_GET['email']:''; 
if($email!='') 
	$dynaquery.=" and `$PAGETNAME`.`admin_email`='".mysql_real_escape_string($email)."' ";


$mobile =(isset($_GET['mobile'])&&$_GET['mobile']!="")?$_GET['mobile']:''; 
if($mobile!='') 
	$dynaquery.=" and `$PAGETNAME`.`admin_mobile` like '%".mysql_real_escape_string($mobile)."%' ";




$st =(isset($_GET['st'])&&$_GET['st']!="")?$_GET['st']:'';
if($st!='') 
	$dynaquery.=" and `$PAGETNAME`.`state_id` = '".mysql_real_escape_string($st)."' ";



$ci =(isset($_GET['ci'])&&$_GET['ci']!="")?$_GET['ci']:''; 
if($ci!='') 
	$dynaquery.=" and `$PAGETNAME`.`city_id` = '".mysql_real_escape_string($ci)."' ";




$display='none';
if( !empty($name) || !empty($email) || !empty($mobile) || !empty($st)|| !empty($ci))
{
   $display='block';
}
 
$dynaquery.=" order by `$PAGETNAME`.`id` DESC ";
$thispageis = "user.php?name=".$name."&tp=".$tp."&email=".$email."&mobile=".$mobile."&st=".$st."&ci=".$ci."&";
$cncurl =   $actthispageis = "user.php?";
?>
<script language="javascript">
 function checkexportOrFilter(fvalue)
{
     
	if(fvalue=="Seacrh"){  
    document.formsearch.action="";
    document.formsearch.method="get";
    document.formsearch.submit();
    }
	else if(fvalue=="Export"){  
    document.formsearch.action="allUserCSV.php";
    document.formsearch.method="post";
    document.formsearch.submit();
    }

}
</script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="../admassets/global/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../admassets/global/plugins/select2/select2.css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="../admassets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="../admassets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="../admassets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="../admassets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
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
				
    <div class="portlet box yellow">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-search"></i>Filter <?php echo $PAGENAME;?>
								
							</div>	
							<div class="tools">
									<a href="javascript:;" class="expand"></a>
									<a href="javascript:;" class="remove"></a>
								</div>					 
						</div>
				 	<div class="portlet-body form" style="display: <?php echo $display; ?>;">
										<!-- BEGIN FORM-->
										<form action="" name="formsearch" class="horizontal-form" method="get"> 
											<div class="form-body">
											 <div class="row">
											     
														<div class="col-md-3">
														<div class="form-group">
															<label class="control-label">Name</label>
																														<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-user"></i>
</span>
															<input class="form-control" name="name" id="name"  value="<?php echo $name;?>"  placeholder="Name" type="text"> </div>
														</div>
													</div>
													<!--/span-->
													
													
													<div class="col-md-3">
<div class="form-group">
<label class="control-label">Type </label>
<div class="controls">
 <select class="select2_category form-control" name="tp"  id="tp">        
 <option value="">All</option>
<option <?php if($tp=='User'){ ?> selected="selected" <?php } ?> value="User">User</option>
<option <?php if($tp=='Retail'){ ?> selected="selected" <?php } ?> value="Retail">Retailer</option>
 </select></div>
</div>
</div>
                                                <!--/span-->
													
													  <div class="col-md-3">
														<div class="form-group">
															<label class="control-label">Email Address</label>
															<div class="input-group">
<span class="input-group-addon">
<i class="icon-envelope"></i>
</span>	
															<input   name="email" id="email" value="<?php echo $email;?>"  placeholder="email"  class="form-control" type="text"> </div>
														</div>
													</div>
													<!--/span-->
													
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label">Mobile Number</label>
															<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-mobile"></i>
</span>	
															<input  name="mobile" id="mobile" value="<?php echo $mobile;?>" placeholder="Mobile"  class="form-control" type="text"> </div>
														</div>
													</div>
													<!--/span-->
													
													 
                                                    
													
											</div>
											
											<div class="row">
												
											
											        <div class="col-md-3">
<div class="form-group">
<label class="control-label">State </label>
<div class="controls">
 <select class="select2_category form-control" name="st"  id="st" onClick="ajxpg('new_list.php?tbl=<?php echo "".MYSQL_TABLE_PRFIX."_cities" ?>&id='+this.value+'&first_opt=All','ci','fade');">        
   <option value="">All</option>
<?php 

$select = mysql_query("select `id`,`name` from `".MYSQL_TABLE_PRFIX."_states` where `status`= '1' order by `name` ASC");
if(mysql_num_rows($select)>0){
while($row = mysql_fetch_assoc($select)){ 
?>     
<option <? if($st==$row['id']){ ?> selected="selected" <?php } ?> value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
<?php } 

} ?>
 </select></div>
</div>
</div>
									   
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label">City </label>
<div class="input-group col-md-12"> 
<select class="select2_category form-control" name="ci" id="ci"  onClick="ajxpg('new_list.php?tbl=<?php echo "".MYSQL_TABLE_PRFIX."_locality" ?>&id='+this.value+'&first_opt=All','ly','fade');">        
   <option value="">All</option>
<?php 
$dynaquery_state='';
if($st!='') 
$dynaquery_state.=" and `$PAGETNAME`.`state_id` = '".$st."' ";

$select = mysql_query("select `id`,`name` from `".MYSQL_TABLE_PRFIX."_cities` where `status`= '1' $dynaquery_state order by `name` ASC");
if(mysql_num_rows($select)>0){
while($row = mysql_fetch_assoc($select)){ 
?>     
<option <? if($ci==$row['id']){ ?> selected="selected" <?php } ?> value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
<?php } 

} ?>
 </select>
</div>
														</div>
													</div>
													<!--/span-->
													
													<div class="col-md-3"></div>
													<!--/span--> 
													
													<div class="col-md-3"></div>
													<!--/span--> 
													
													
													
											 </div>		
											 
											
											
											
											<div class="form-actions right">
												<button type="button" onClick="window.location='<?php echo $actthispageis;?>'"  class="btn default">Cancel</button>
												<button type="submit" onClick="checkexportOrFilter('Seacrh')" class="btn blue"><i class="fa fa-filter"></i> Filter</button>
												<button onClick="checkexportOrFilter('Export')"  data-original-title="Click for Export in CSV" rel="tooltips" class="btn btn-success tooltips"><i class="fa fa-file-excel-o"></i> Export</button>
												</div>
											
									    </div>		
										</form>
										<!-- END FORM-->
									
						</div>
				</div> 
  
   <div class="row">             
            <div class="col-md-12">
<div class="btn-group pull-right">
<button id="sample_editable_1_new" class="btn green"  onClick="window.location='add<?php echo $actthispageis;?>'" >
Add New
<i class="fa fa-plus"></i>
</button>
 
</div>
</div> 
</div>

<div class="row">
   <div class="col-md-12">

					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					 <div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-book"></i> List <?php echo $PAGENAME;?>
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
						<div class="portlet-body">
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
							<div class="table-responsive">
<?php 
$qury="SELECT `$PAGETNAME`.`id` ,
`$PAGETNAME`.`type` ,
`$PAGETNAME`.`admin_name` ,
`$PAGETNAME`.`admin_email`,
`$PAGETNAME`.`admin_mobile`,
`$PAGETNAME`.`profile_photo`,
`$PAGETNAME`.`admin_address`,
`$PAGETNAME`.`status`,
`$PAGETNAME`.`inserted_datetime`,
`$PAGETNAME`.`updated_datetime`,
`".MYSQL_TABLE_PRFIX."_states`.`name` as statename,
`".MYSQL_TABLE_PRFIX."_cities`.`name` as cityname
FROM `$PAGETNAME` 
LEFT JOIN `".MYSQL_TABLE_PRFIX."_states` ON `".MYSQL_TABLE_PRFIX."_states`.`id` = `$PAGETNAME`.`state_id`
LEFT JOIN `".MYSQL_TABLE_PRFIX."_cities` ON `".MYSQL_TABLE_PRFIX."_cities`.`id` = `$PAGETNAME`.`city_id`
where `$PAGETNAME`.`id`>'0' and (`$PAGETNAME`.`type`='User' or `$PAGETNAME`.`type`='Retail') $dynaquery ";

$rowcount = mysql_num_rows(mysql_query($qury)); 
if($rowcount>0){
?>
								<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>
									Sno.
									</th>									
									<th>
										Name
									</th>
									
									 <th>User Type</th>
									
									<th>
									  Email / Mobile
									</th>
									<th>
									 Address
									</th>
									<th>
										<span class="tooltips" data-original-title="Created/Updated DateTime" rel="tooltips">DateTime</span>
									</th>
                                   
								  
                                
                                    <th>
										Status
									</th>
                                    <th>
										Actions
       								</th>
                                                
								 
								</tr>
								</thead>
								<tbody>
<?php 
$sncounter =1+$eu;
$rowsql = mysql_query("$qury limit $eu, $limit "); 
while($rowsqlrow = mysql_fetch_assoc($rowsql)){ 
$photo = $rowsqlrow['profile_photo'];
?>                             
								<tr>
								 <td><?php echo $sncounter;?>.</td>
                                          <td >
          <?php if($photo!='') { ?>                                
                                          <img style="height:50px;" src="<?php echo ADMIN_UPLOAD_PATH.$pphoto =isset($photo) && $photo!=''?$photo:NO_IMG_URL;?>" alt="">  <br/> 
		 <?php } ?>								  
										  <?php echo $rowsqlrow['admin_name'];?></td>
										  
										  
										   <td>
										  <select class="select2_category form-control"  id="usertype" onChange="ajxpg('ajax.php?tbl=<?php echo "".MYSQL_TABLE_PRFIX."_models" ?>&type=usertype&id=<?php echo $rowsqlrow['id'];?>&usertype='+this.value,'usertype','fade');">        
 <option value="">Select</option>
<option <?php if($rowsqlrow['type']=='User'){ ?> selected="selected" <?php } ?> value="User">User</option>
<option <?php if($rowsqlrow['type']=='Retail'){ ?> selected="selected" <?php } ?> value="Retail">Retailer</option>
 </select>
                                          </td>
								  
								   
                                     <td>
								  <?php if($rowsqlrow['admin_email']!=''){ ?><a href="mailto:<?php echo $rowsqlrow['admin_email'];?>">(<?php echo $rowsqlrow['admin_email'];?> )</a> <br/><?php } ?>
                                
								 <?php echo $rowsqlrow['admin_mobile'];?>     
                                     </td>
                                      <td ><?php echo $rowsqlrow['admin_address'];?> <br><?php echo $rowsqlrow['cityname'];?> , <br><?php echo $rowsqlrow['statename'];?> </td>
                         
                           
                                      <td>
									  <?php echo timestamp_to_date($rowsqlrow['inserted_datetime']);?>
									  <br>
									  <?php echo timestamp_to_date($rowsqlrow['updated_datetime']);?></td>
                  
                <td>  
                   <?php
								if($rowsqlrow['id']!=$Session_user_ID){	
								?>         
                     <a title="Active"  href="javascript:void();" onClick="ajxpg('newchange_status.php?tbl=<?php echo $PAGETNAME ?>&id=<?php echo $rowsqlrow['id'];?>','status<?php echo $rowsqlrow['id'];?>','fade');">   <div id="status<?php echo $rowsqlrow['id'];?>" >                 
                         
								<?php
			if($rowsqlrow['status']==1){?>
	                               
     <span class="btn green" >    <i class="fa fa-check"></i> </span>
 
           											
			<?php }else{ ?>
 
   <span class="btn red" >  <i class="fa fa-times"></i> </span>
 
           									
			<?php } ?>	
   
  </div> </a>
   
		<?php
								}
								else {
								echo "Logged In";	
								}?>	 
		</td>
        
        
                                     <td align="right">   	
    <a href="adduser.php?eid=<?php echo custom_encrypt($rowsqlrow['id'])?>" class="btn btn-warning tooltips" data-original-title="Go to Update (<?php echo $rowsqlrow['admin_name'];?>)" rel="tooltips"><i class="icon-pencil"></i></a>
	
	 <a href="edituserpass.php?eid=<?php echo custom_encrypt($rowsqlrow['id'])?>&EPLANCODE=<?php echo $EPLANCODE; ?>" class="btn red tooltips" data-original-title="Go to Change Password for (<?php echo $rowsqlrow['admin_name'];?>)" rel="tooltips"><i class="icon-lock"></i></a>
 		
	</td>
 							
							
											
                             
								</tr>
                                <?php 
$sncounter++;
}

?>    
								</tbody>
								</table>
                                
<?php 
 include("../paging_footer.php");
} else { ?>
 
<div class="alert alert-success alert-dismissable">
<strong>Warning !</strong>
No record data found
</div> 
	
<?php } ?>  
							</div>
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