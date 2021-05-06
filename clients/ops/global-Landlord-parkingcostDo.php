<?php
//BEGIN global-Landlord-parkingcost.php //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$parking_cost = $_POST['parking_cost'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `PARKING_COST` = '$parking_cost' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new price per parking space of $$parking_cost by $handle on $now";

$page="editLandlord";

//END global-Landlord-parkingcost.php //
?>
