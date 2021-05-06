<?php
//BEGIN deleteLandlordDo //	
if ($_SESSION['user_level']>2) {
	$lid = $_POST['lid'];
	$conf = $_POST['conf'];
	$deletelistings = $_POST['deletelistings'];

	
	if ($conf=="y" || $conf=="Y") {

	if ($deletelistings=="2") {

	$quStrUpdateClass = "DELETE FROM CLASS WHERE LANDLORD=$lid";
		$quUpdateClass = mysqli_query($dbh, $quStrUpdateClass);
		$quStrDeleteLandlord = "DELETE FROM LANDLORD WHERE LID=$lid";
		$quDeleteLandlord = mysqli_query($dbh, $quStrDeleteLandlord);
		$disData = "landlords";
		$page = "manageLandlord";
		$needOptions = true;
		$msg = "Landlord and associated listings were deleted.";
		$sec_op = "manageLandlord";

	}

	if ($deletelistings=="1") {

	$quStrUpdateClass = "UPDATE CLASS SET LANDLORD=0 WHERE LANDLORD=$lid";
		$quUpdateClass = mysqli_query($dbh, $quStrUpdateClass);
		$quStrDeleteLandlord = "DELETE FROM LANDLORD WHERE LID=$lid";
		$quDeleteLandlord = mysqli_query($dbh, $quStrDeleteLandlord);
		$disData = "landlords";
		$page = "manageLandlord";
		$needOptions = true;
		$msg = "Just the Landlord and NOT the associated listings were deleted.";
		$sec_op = "manageLandlord";

	}


		}else {
		$page = "deleteLandlord";
		$msg = "Please type 'y' to confirm,  no action taken.";
		$msg_error = true;
	}
}else {
	$page = "home";
	$msg = "You are not authorized to delete landlords.";
}
//END deleteLandlordDo //
?>