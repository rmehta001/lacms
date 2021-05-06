<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_DINNING_ROOM = $_POST['FEATURES_DINNING_ROOM'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_DINNING_ROOM` = '$FEATURES_DINNING_ROOM' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Dining Room setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>