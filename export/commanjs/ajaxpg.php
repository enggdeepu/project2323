<?php 
$pcode = !empty($_GET['pcode'])?custom_decrypt($_GET['pcode']):'';

//echo $tablename.$unicode;

if(strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {

}
else{
	echo "Invalid Request.";	 
}
?>