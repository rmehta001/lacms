<?php
//BEGIN global-ListingsEdit-Do//


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];

$VIRT_TOUR = $_POST['VIRT_TOUR'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET VIRT_TOUR = '$VIRT_TOUR' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with the global change to virtual tour address by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit-Do //
?>
