<?php
//BEGIN global-ListingsEdit //


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];

$HOT_WATER_TYPE = $_POST['HOT_WATER_TYPE'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `HOT_WATER_TYPE` = '$HOT_WATER_TYPE' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with the hot water type setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
