// JavaScript Document
function change_status(id,tbl){
	var tbl1234 = "'"+tbl+"'";	
		if(id>0) {
			if(confirm('Do you really want to change the status ?'))
			{  
				$.ajax({
					dataType: "html",
					type: "POST",					 
					url: 'change_status.php?id='+id+'&tbl='+tbl,
					data: 'id='+id+'&tbl='+tbl,
					
					success: function(data){	
					 
					 if(data==1)
					 {
						  
						$("#status"+id).html('<a href="#status'+id+'" align="center" class="btn btn-success tooltips" onclick="change_status('+id+','+tbl1234+');" data-original-title="Go for In-Active Status" rel="tooltip"><i class="icon-ok"></i></a>');
					}
					else if(data==0)
					{  
						$("#status"+id).html('<a href=""#status'+id+'" align="center" class="btn btn-danger tooltips" onclick="change_status('+id+','+tbl1234+');" data-original-title="Go for Active Status" rel="tooltip"><i class="icon-remove"></i></a>');
					}
						
					}
				});
			}
		}
		else {
			alert("Invalid record ID.");
		}
	}	
	

	
function delete_record(id,tbl){
	if(id>0) {
		if(confirm('Do you really want to delete this record ?'))
		{ 
			$.ajax({
				dataType: "html",
				type: "POST",
				url: 'delete_record.php?id='+id+'&tbl='+tbl,
				data: 'id='+id+'&tbl='+tbl,
				success: function(data){
				  $("#row"+id).html('<p></p>');
				
				}
			});
		}
	}
	else {
		alert("Invalid record ID.");
	}
}
	
	
	
function trash_record(id,tbl){
		if(id>0) {
			if(confirm('Do you really want to move trash this record ?'))
			{ 
				$.ajax({
					dataType: "html",
					type: "POST",
					url: 'trash_record.php?id='+id+'&tbl='+tbl,
					data: 'id='+id+'&tbl='+tbl,
					success: function(data){
					  $("#row"+id).html('<p></p>');
					
					}
				});
			}
		}
		else {
			alert("Invalid record ID.");
		}
	}
	
	
 	
function alphaonly(myname){
	$('#'+myname).val( $('#'+myname).val().replace(/[^a-z A-Z]/g,'') ) ;
}


function onlynewmwric(myname){
	$('#'+myname).val( $('#'+myname).val().replace(/[^\d]/ig, ''));
}


function allowflote(myname){
	$('#'+myname).val( $('#'+myname).val().replace(/[^\d.]/ig, ''));
}