<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$LAUNDRY_ROOM = $_POST['LAUNDRY_ROOM'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `LAUNDRY_ROOM` = '$LAUNDRY_ROOM' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Laundry setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>