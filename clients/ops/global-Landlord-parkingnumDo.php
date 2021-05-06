<?php
//BEGIN global-ListingsEdit //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$PARKING_NUM = $_POST['PARKING_NUM'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `PARKING_NUM` = '$PARKING_NUM' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the # of spaces per unit set to $PARKING_NUM by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
