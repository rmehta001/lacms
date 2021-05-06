<?php
//BEGIN global-ListingsEdit //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$HOT_WATER_TYPE = $_POST['HOT_WATER_TYPE'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `HOT_WATER_TYPE` = '$HOT_WATER_TYPE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the hot water type setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
