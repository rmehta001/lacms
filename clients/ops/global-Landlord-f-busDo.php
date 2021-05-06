<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_BUS = $_POST['AMENITIES_BUS'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_BUS` = '$AMENITIES_BUS' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at for this landlord were updated with a change to the Bus setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>