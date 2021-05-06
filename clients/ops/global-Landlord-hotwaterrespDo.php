<?php
//BEGIN global-ListingsEdit //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$HOT_WATER_RESP = $_POST['HOT_WATER_RESP'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `HOT_WATER_RESP` = '$HOT_WATER_RESP' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new hot water responsibility by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
