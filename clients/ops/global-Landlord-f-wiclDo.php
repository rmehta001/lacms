<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_WALK_IN_CLOSET = $_POST['FEATURES_WALK_IN_CLOSET'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_WALK_IN_CLOSET` = '$FEATURES_WALK_IN_CLOSET' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Walk-in Closet setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>