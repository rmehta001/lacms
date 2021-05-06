<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_EAT_IN_KITCHEN = $_POST['FEATURES_EAT_IN_KITCHEN'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_EAT_IN_KITCHEN` = '$FEATURES_EAT_IN_KITCHEN' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Eat-in Kitchen setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>