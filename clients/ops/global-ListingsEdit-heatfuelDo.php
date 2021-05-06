<?php
//BEGIN global-ListingsEdit-parkingcost.php //


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];

$HEATING_TYPE = $_POST['HEATING_TYPE'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `HEATING_TYPE` = '$HEATING_TYPE' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with the new heating fuel type by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit-parkingcost.php //
?>
