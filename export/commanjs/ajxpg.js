var ajxpg = function(ajx_page,div,effect,margin_top){
		var div = '#' + div;
		if(typeof margin_top === 'undefined')
			margin_top = 0;
		
		jQuery(div).html('<img src="../img/loading.gif" align="middle"   border="0" align="center"  style="margin-top:'+margin_top+'" />');
		
		jQuery.ajax({
					   type: "POST", 
					   url: ajx_page,
					   cache: false,
					   success: function(data){ 
						jQuery(div).css('display','none');
						if (effect == 'fade'){
							jQuery(div).html(data).fadeIn('slow');
						}
						else if (effect == 'slide'){
							jQuery(div).html(data).slideDown('slow');
						}
						else if (effect == 'show'){
							jQuery(div).html(data).show('slow');
						}
						else if (effect == 'none'){
							jQuery(div).html(data);
							jQuery(div).css('display','block');
						}
				   } ,
				   error: function (){
					 //alert("Sorry!\n\nAn Error Occured! While fatching data from server.\nDetails: \n\nURL: "+ajx_page+"\nDIV: "+div+"\nEFFECT: "+effect);
				   }
				   
		 });
	
};