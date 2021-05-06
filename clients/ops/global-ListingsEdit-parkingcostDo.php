<?php
//BEGIN global-ListingsEdit-parkingcost.php //


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];

$parking_cost = $_POST['parking_cost'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `PARKING_COST` = '$parking_cost' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with the new price per parking space of $$parking_cost by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit-parkingcost.php //
?>
