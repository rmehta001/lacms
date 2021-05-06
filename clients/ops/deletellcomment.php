<?php
//BEGIN deletellcomment //
	if ($user_level>9) {
		$page = "deletellcomment";
		$title = "Delete A Landlord Comment";
		$llid = $HTTP_GET_VARS['llid'];
		$llcomment_id = $HTTP_GET_VARS['llcomment_id'];
		$needOptions = true;
	}else {
		$page = "manageLandlord";
		$msg = "Sorry, that functionality isn't available   &nbsp;&nbsp;
		
		<a href=\"$PHP_SELF?op=editLandlord&lid=$llid\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Edit Landlord\"></a> 
		&nbsp;&nbsp;
		
		<a href=\"$PHP_SELF?op=llcomments&llid=$llid\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Landlord's Comments\"></a>";
		$msg_error = true;
	}
//END deletellcomment //
?>