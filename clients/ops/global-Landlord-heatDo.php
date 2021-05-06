<?php
//BEGIN global-Landlord-parkingcost.php //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$HEATING_RESP = $_POST['HEATING_RESP'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `HEATING_RESP` = '$HEATING_RESP' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new Heating Responsibility setting by $handle on $now";

$page="editLandlord";

//END global-Landlord-parkingcost.php //
?>
