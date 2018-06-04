<?php
$HEAD = 'NEWSLETTERS';
$TITLE = 'School Communicator :: NEWSLETTERS';
include("header.php");
include("../fnc/upload.class.php"); 
include("../fnc/imgup.fnc.php");
if($UsrSessionId != $SchoolId && $UsrRankType != 'SYSADMIN'){
	jump("404.php");
	exit;
}
if(!in_array("NEWS_LETTERS",$allowed_modules_arr)){
	jump("404.php");
}

if($UsrRankType == 'SYSADMIN' && !in_array("NEWS_LETTERS",$Usrallowed_modules_arr)){
	jump("404.php");
}
$pagetbl ="newsletters";
$Pname = "Newsletters";
$Pdesc ="Newsletters";
$id=(isset($_GET['id']) && $_GET['id']!='')?custom_decrypt($_GET['id']):"0";
 
$Mes=$msg ='';
$heading = '';
$content = '';
$idd= ''; 
$Mes=$msg =$newsletter=''; 
	 
if($UsrSessionId==$SchoolId || $UsrRankType == 'SYSADMIN'){   	
	
if(isset($id) && $id>0)
{   
	$sql = mysql_query("select * from `$pagetbl` where `id` = '".$id."'") ;
	$idnrcount = mysql_num_rows($sql);
    if($idnrcount>0) 
	{
		$DataArray = mysql_fetch_assoc($sql) ;
		$id=$DataArray['id'];
		$school_id= $DataArray['schoolid'];
		$heading = $DataArray['heading'];
		$content = $DataArray['content'];
		$newsletter=$DataArray['newsletter'];
		$datetime = date("Y-m-d",$DataArray['datetime']);
		
	}
	else {
		 jump("newsletters.php?err=4"); 
		 exit;
	 }
}

if (!file_exists(NEWSLETTERS_UPLOAD_PATH.$SchoolId."/")) { 
		mkdir(NEWSLETTERS_UPLOAD_PATH.$SchoolId."/");
}
$dirs = scandir(NEWSLETTERS_UPLOAD_PATH.$SchoolId."/");
if($UsrSessionId == $SchoolId){
	$maxnr = 101;
}
$dir = NEWSLETTERS_UPLOAD_PATH.$SchoolId."/"; $i=0;
if ($handle = opendir($dir)) {
	while (($file = readdir($handle)) !== false){
		if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
			$i++;
	}
}

if(isset($_POST['Submit']))
{
if(isset($_FILES['newsletter']['name'])&& $_FILES['newsletter']['name']!=""){
if($i>$maxnr){
		$Mes = 'You can not upload more then '.($maxnr-1).' files. Please delete some files then upload new files.';
	} }
	 
	$heading= sql_safe(trim($_POST['heading']));
	$content= trim($_POST['content']);
    $datetime= time();
	if(trim($heading)=='')
		$Mes= "Heading is required.";
	
	if(isset($_FILES['newsletter']['name'])&& $_FILES['newsletter']['name']!="" && $Mes==""){
$img = $_FILES['newsletter']['name'];
	$arr = explode('.', $img);
	 $img = substr($arr[0],0,10);
	 $img = $img.".".$arr[1];
	 $_FILES['newsletter']['name'] = $img;
		$path = NEWSLETTERS_UPLOAD_PATH.$SchoolId."/";
			  $arrimg=uploadiwtfiles($_FILES['newsletter'],$path,'','',0,array('image/pjpeg','image/gif','image/jpeg','image/jpg','image/png','text/richtext','application/excel','application/msword','application/mspowerpoint','application/pdf','application/powerpoint','application/plain','application/rtf','application/vnd.ms-excel','application/wordperfect','application/x-bzip','application/x-compressed','application/x-excel','application/x-gzip','application/x-msexcel','application/x-rtf','application/x-zip-compressed','application/xml','application/zip','text/richtext','text/plain','text/xml','application/octet-stream'),'500');
				if($arrimg[0])						
				 $newsletter =$arrimg[1];						
				else
				$Mes.=$arrimg[1];
					
	}
		
	if($Mes=='')
	{ 	
	  $updated_time= time();	
		if($id>0){
		
	$sel=mysql_query("select `newsletter` from `$pagetbl` where id='".$id."'");
    $r=mysql_fetch_array($sel);
	if($r['newsletter']!=''){
	$path = NEWSLETTERS_UPLOAD_PATH.$SchoolId."/".$r['newsletter'];
    if(file_exists($path)){unlink($path);}	
	}
			
		$inssql= "UPDATE `$pagetbl` SET `schoolid`='$SchoolId',
		`heading`='$heading',
		`content`='$content',
		`newsletter`='$newsletter',
		`datetime`='$datetime'
		 WHERE `id`='".$id."'";
		$msg =2;
		
	}
	else
	{ 
			$inssql= "insert into `$pagetbl` (`schoolid`,`heading`,`content`,`newsletter`,`datetime`) 
		values('".$SchoolId."','".$heading."','".$content."','".$newsletter."','".$datetime."')";
		$msg =1;
	}
$ret=mysql_query($inssql);
if($ret==true){jump("newsletters.php?msg=".$msg); }
}
}
?>
<link rel="stylesheet" href="../common_js/live_validation.css" type="text/css" />
<script type="text/javascript" src="../common_js/live_validation.js"></script>

<div class="centercontent">
<div class="pageheader notab">
   <h1 class="pagetitle"><?php if($id > 0){ ?><?php $translate->__('Edit'); ?><?php } else{?><?php $translate->__('Add'); ?><?php }?> <?php echo $translate->__($Pname);?></h1>
            <span class="pagedesc"><?php $translate->__('Ginger'); ?> <?php $translate->__($Pdesc); ?></span></div><!--pageheader-->
        

<div id="contentwrapper" class="contentwrapper">
<ul class="breadcrumbs">
<li><a href="home.php"><?php $translate->__('Dashboard'); ?></a></li>
<li><a href="newsletters.php"><?php $translate->__($Pname);?></a></li>
<li><b><?php if($id > 0){ ?><?php $translate->__('Edit'); ?><?php } else{?><?php $translate->__('Add'); ?><?php }?></b></li>
</ul>
        
        <br/>
      <div class="subcontent"> 
        <?php if($Mes!=''){?>
         <div class="notibar msgerror">
                        <a class="close"></a>
                        <p><?php echo $Mes;?></p>
                    </div>
         <?php }?>
 
<script type="text/javascript" src="../js/plugins/colorpicker.js"></script>
 <script type="text/javascript" src="../js/plugins/ui.spinner.min.js"></script>
 
 
<script type="text/javascript" src="../js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="../js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="../js/plugins/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="../js/plugins/charCount.js"></script>

<script type="text/javascript" src="../js/plugins/chosen.jquery.min.js"></script>

  <script type="text/javascript" src="../js/custom/forms.js"></script>

 <script type="text/javascript" src="../js/custom/elements.js"></script>
 <!-- DC ToolTips CSS -->
<link type="text/css" rel="stylesheet" href="http://cdn.dcodes.net/2/tooltips/css/dc_tooltips.css" />
<!-- DC ToolTips JS -->
<script type="text/javascript" src="http://cdn.dcodes.net/2/tooltips/js/dc_tooltips.js"></script>
         <form class="stdform stdform2" id="form11" method="post" action="" enctype="multipart/form-data">
		 <hr />
					  <table width="100%" border="1" cellpadding="0" cellspacing="0" class="stdtable" >
                 		<colgroup><col class="con1"></col><col class="con0"><col class="con1"></col></col><col class="con0"></col></colgroup>
       <tr><td width="163"><strong><? $translate->__('Heading') ?></strong></td>
       <td colspan="3"><input onKeyUp="loaddt(this.id)" type="text" required="required" value="<?php echo $heading?>" name="heading" id="heading" class="longinput" />
                            <script type="text/javascript">
								var heading = new LiveValidation('heading');
								heading.add(Validate.Presence);
							</script>
                            </td>
                          </tr>
						  
<tr><td width="163"><strong><? $translate->__('Newsletter') ?></strong></td><td colspan="3"><input type="file" name="newsletter" />
	 <? if($newsletter!=''){?>&nbsp;&nbsp;&nbsp; <a  href="<?=NEWSLETTERS_UPLOAD_PATH.$SchoolId."/".$newsletter?>" target="_blank" title="View Newsletter"><font color=#00CC00>Download</font></a><? } ?></td></tr>
						  
						  
                          <tr>
                            <td width="163"><strong><? $translate->__('Content') ?></strong></td>
                            
                            <td colspan="3"><textarea onKeyUp="loaddt(this.id)" cols="80" rows="5" name="content" id="content" class="longinput"><?php echo $content;?></textarea>
                            </td>
                            </tr>
                            
                          
                              <tr>
                            <td colspan="4"><center><p class="stdformbutton">
                        	<input class="submit radius2" type="submit" name="Submit" value="Submit" id="Submit"/>
                            <a href="newsletters.php"><input type="button" class="stdbtn btn_blue" value="Cancel" ></a>
                        </p></center>
                            </td>
                           </tr>
    
</table>
                    </form>
       </div> 
       </div>
	</div>

<?php
include("footer.php");
}else{jump("404.php"); exit;}	 
?>