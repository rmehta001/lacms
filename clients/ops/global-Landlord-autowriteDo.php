<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AUTO_WRITE = $_POST['AUTO_WRITE'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AUTO_WRITE` = '$AUTO_WRITE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Auto-Write Features &amp; Amenities in Ads setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>