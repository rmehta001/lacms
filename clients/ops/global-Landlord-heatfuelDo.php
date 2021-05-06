<?php
//BEGIN global-Landlord-parkingcost.php //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$HEATING_TYPE = $_POST['HEATING_TYPE'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `HEATING_TYPE` = '$HEATING_TYPE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new heating fuel type by $handle on $now";

$page="editLandlord";

//END global-Landlord-parkingcost.php //
?>
