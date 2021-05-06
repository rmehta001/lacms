<?php
//BEGIN global-ListingsEdit //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$USE_USER_SIG = $_POST['USE_USER_SIG'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `USE_USER_SIG` = '$USE_USER_SIG' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change \"display a personal signature\" on ads by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
