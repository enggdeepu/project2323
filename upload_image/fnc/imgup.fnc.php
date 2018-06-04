<?php
if(!isset($imageupfnc))  
{ 
function uploadiwtfiles($touploadfile,$touploadfolder,$w=10,$h=100,$en=0,$otherallowed=0,$max_size=0)
{
//usage storeimage($_FILES['file'],IMAGE_UPLOAD_FOLDER,200,200,0,'image/pjpeg','700');
	$handle = new Upload($touploadfile);
	if ($handle->uploaded) 
	{									
		
		if($otherallowed)
					$handle->allowed			= $otherallowed;
		else
					$handle->allowed			= array('image/pjpeg','image/gif','image/jpeg','image/jpg','image/png');
		
		$handle->file_overwrite		= false;
		$handle->file_auto_rename	= true;
		
		if($max_size)
			$handle->file_max_size		= $max_size*1024;
		else
			$handle->file_max_size		= 1500*1024;	
			
			
		if(!$otherallowed)
			{	if($w!=0)
					{
						$tempsize=getimagesize($touploadfile['tmp_name']);
						if(!$en)$handle->image_x			= ($tempsize[0]<$w)?$tempsize[0]:$w;
						else	$handle->image_x			= $w; 											
						$handle->image_resize		= true;
						$handle->image_ratio_y		= true;
					}	
								
				$handle->Process($touploadfolder);
				$handle->clean();
				if($handle->processed)
					return array(1,$handle->file_dst_name,$handle->image_dst_x,$handle->image_dst_y);																						
				else																	
					return array(0,$handle->error);			

			}	
			
		else
			{
				$handle->Process($touploadfolder);
				$handle->clean();
				if($handle->processed)
					return array(1,$handle->file_dst_name);																						
				else																	
					return array(0,$handle->error);
			}
		
	}
	else 
				return array(0,$handle->error);
}
function uploadAllfiles($touploadfile,$touploadfolder,$w=10,$h=100,$en=0,$otherallowed=0,$max_size=0)
{
	$otherallowed = array("application/arj",
								   "application/excel",
								   "application/gnutar",
								   "application/msword",
								   "application/mspowerpoint",
								   "application/octet-stream",
								   "application/pdf",
								   "application/powerpoint",
								   "application/postscript",
								   "application/plain",
								   "application/rtf",
                                                                   "text/csv",
"application/vnd.openxmlformats-officedocument.presentationml.presentation",
"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
								   "application/vnd.ms-excel",
								   "application/vocaltec-media-file",
								   "application/wordperfect",
								   "application/x-compressed",
								   "application/x-excel",
								   
								   "application/x-midi",
								   "application/x-msexcel",
								   "application/x-rtf",
								   "application/x-sit",
                                                                   "application/xls",
								   "application/x-stuffit",
								   "application/x-shockwave-flash",
								   "application/x-troff-msvideo",
								   "application/xml",
								   "audio/aiff",
								   "audio/basic",
								   "audio/midi",
								   "audio/mod",
								   "audio/mpeg",
								   "audio/mpeg3",
								   "audio/wav",
								   "audio/x-aiff",
								   "audio/x-au",
								   "audio/x-mid",
								   "audio/x-midi",
								   "audio/x-mod",
								   "audio/x-mpeg-3",
								   "audio/x-wav",
								   "audio/xm",
								   "image/bmp",
								   "image/gif",
								   "image/jpeg",
								   "image/pjpeg",
								   "image/png",
								   "image/ico",
								   "image/tiff",
								   "image/x-tiff",
								   "image/x-windows-bmp",
								   "music/crescendo",
								   "text/richtext",
								   "text/plain",
								   "text/xml",
								   "video/avi",
								   "video/mpeg",
								   "video/msvideo",
								   "video/quicktime",
								   "video/quicktime",
								   "video/x-mpeg",
								   "video/x-ms-asf",
								   "video/x-ms-asf-plugin",
								   "video/x-msvideo",
								   "x-music/x-midi");
	$handle = new Upload($touploadfile);
	if ($handle->uploaded) 
	{									
		
		if($otherallowed)
					$handle->allowed			= $otherallowed;
		else
					$handle->allowed			= array('image/pjpeg','image/gif','image/jpeg','image/jpg','image/png');
		
		$handle->file_overwrite		= false;
		$handle->file_auto_rename	= true;
		
		if($max_size)
			$handle->file_max_size		= $max_size*1024;
		else
			$handle->file_max_size		= 1500*1024;	
			
			
		if(!$otherallowed)
			{	if($w!=0)
					{
						$tempsize=getimagesize($touploadfile['tmp_name']);
						if(!$en)$handle->image_x			= ($tempsize[0]<$w)?$tempsize[0]:$w;
						else	$handle->image_x			= $w; 											
						$handle->image_resize		= true;
						$handle->image_ratio_y		= true;
					}	
								
				$handle->Process($touploadfolder);
				$handle->clean();
				if($handle->processed)
					return array(1,$handle->file_dst_name,$handle->image_dst_x,$handle->image_dst_y);																						
				else																	
					return array(0,$handle->error);			

			}	
			
		else
			{
				$handle->Process($touploadfolder);
				$handle->clean();
				if($handle->processed)
					return array(1,$handle->file_dst_name);																						
				else																	
					return array(0,$handle->error);
			}
		
	}
	else 
				return array(0,$handle->error);
}
$imageupfnc=1;
}

function deleteimages($path)
	{
		if($path){				
					if(file_exists($path))
						unlink($path);			 
			}			
	}
?>