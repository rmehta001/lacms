<?php 
//BEGIN deletellcommentDo //
	
	
	
	$confirm = $_POST['confirm'];
	
	if (($confirm == "Y") or ($confirm == "y")) {
	
	
		if ($user_level>9) {
			
			
		$llid = $_POST['llid'];
		$llcomment_id = $_POST['llcomment_id'];
		$llcomment = $_POST['llcomment'];


		
		

	$quStrDeletellcomment = "DELETE * FROM `LANDLORD_COMMENTS` WHERE LLCOMMENT_ID='$llcomment_id' AND CLI='$grid'";
	$Deletellcomment = mysqli_query($dbh, $quStrDeletellcomment);
	$page= "manageLandlord";
		$sec_op = "manageLandlord";
	
	$msg = "Landlord Comment Deleted.  &nbsp;&nbsp;
		
		<a href=\"$PHP_SELF?op=editLandlord&lid=$llid\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Edit Landlord\"></a> 
		&nbsp;&nbsp;
		
		<a href=\"$PHP_SELF?op=llcomments&llid=$llid\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Landlord's Comments\"></a>";
		
	$title = "Manage Landlords";
	
}} else {

	$page= "manageLandlord";
			$sec_op = "manageLandlord";

	$msg = "<font color=red>Deletion of Landlord Comment Not Made.</font>  &nbsp;&nbsp;
		
		<a href=\"$PHP_SELF?op=editLandlord&lid=$llid\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Edit Landlord\"></a> 
		&nbsp;&nbsp;
		
		<a href=\"$PHP_SELF?op=llcomments&llid=$llid\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Landlord's Comments\"></a>";
	$title = "Manage Landlords";

	}

//END deletellcommentDo //
?>