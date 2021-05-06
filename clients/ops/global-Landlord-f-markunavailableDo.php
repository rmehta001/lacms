<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `STATUS_ACTIVE` = '0' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at for this landlord were updated and changed to Unavailable by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>