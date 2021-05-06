<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$BUILDING_TYPE = $_POST['BUILDING_TYPE'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `BUILDING_TYPE` = '$BUILDING_TYPE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Building Type setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>