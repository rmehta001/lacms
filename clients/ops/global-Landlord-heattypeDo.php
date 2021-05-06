<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];

$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$HEATING_TYPE2 = $_POST['HEATING_TYPE2'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `HEATING_TYPE2` = '$HEATING_TYPE2' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new heating type by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
