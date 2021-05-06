<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_ELECTRICITY = $_POST['FEATURES_ELECTRICITY'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_ELECTRICITY` = '$FEATURES_ELECTRICITY' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the All Utilities setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>