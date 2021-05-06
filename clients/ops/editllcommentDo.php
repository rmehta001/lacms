<?php 
//BEGIN editllcommentDo //
	
		if ($level>4) {
			
		$llid = $_POST['llid'];
		$llcomment_id = $_POST['llcomment_id'];
		$llcomment = $_POST['llcomment'];



	$quStrEditllcomment = "UPDATE `LANDLORD_COMMENTS` SET LLCOMMENT='$llcomment', UID='$uid', HANDLE='$handle' WHERE LLCOMMENT_ID='$llcomment_id' AND CLI='$grid'";
	$Editllcomment = mysqli_query($dbh, $quStrEditllcomment);
	$page= "blank";
			$sec_op = "manageLandlord";
	
	$msg = "Landlord Comment Change Made.  &nbsp;&nbsp;
		
		<a href=\"$PHP_SELF?op=editLandlord&lid=$llid\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Edit Landlord\"></a> 
		&nbsp;&nbsp;
		
		<a href=\"$PHP_SELF?op=llcomments&llid=$llid\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Landlord's Comments\"></a>";
		
	$title = "Manage Landlords";
	
} else {

	$page= "blank";
			$sec_op = "manageLandlord";

	$msg = "<font color=red>Changes not saved.</font>";
	$title = "Manage Landlords";

	}
	
//END editllcommentDo //
?>