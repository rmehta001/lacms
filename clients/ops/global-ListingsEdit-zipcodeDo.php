<?php
//BEGIN global-ListingsEdit-parkingcost.php //


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];

$ZIP = $_POST['ZIP'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET ZIP = '$ZIP' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with the new zipcode of $ZIP by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit-parkingcost.php //
?>
