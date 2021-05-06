<?php
//BEGIN global-ListingsEdit //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$PARKING_TYPE = $_POST['PARKING_TYPE'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `PARKING_TYPE` = '$PARKING_TYPE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the parking type by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
