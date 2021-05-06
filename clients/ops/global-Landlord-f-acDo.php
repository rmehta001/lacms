<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_AC = $_POST['FEATURES_AC'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_AC` = '$FEATURES_AC' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the A/C to setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>