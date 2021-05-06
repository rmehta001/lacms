
<?php 
//BEGIN editllnoteDo //
	
		if ($level>4) {
			
		$llid = $_POST['llid'];
		$llnote = $_POST['llnote'];



	$quStrEditllnote = "UPDATE `LANDLORD` SET LLNOTES='$llnote' WHERE LID='$llid' AND GRID='$grid'";



	$Editllnote = mysqli_query($dbh, $quStrEditllnote);

	$page= "blank";
			$sec_op = "manageLandlord";
	
	$msg = "Landlord Notes Change Made.  &nbsp;&nbsp; <a href=\"$PHP_SELF?op=editLandlord&lid=$llid\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Edit Landlord\"></a> ";
		
	$title = "Manage Landlords";
	
} else {

	$page= "blank";
			$sec_op = "manageLandlord";

	$msg = "<font color=red>Changes not saved.</font>";
	$title = "Manage Landlords";

	}
	
//END editllnoteDo//
?>
