<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_BIN = $_POST['AMENITIES_BIN'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_BIN` = '$AMENITIES_BIN' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Storage Bin setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>