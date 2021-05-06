<?php
//BEGIN global-Landlord-parkingcost.php //
$handle = $_SESSION['handle'];

$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$ZIP = $_POST['ZIP'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET ZIP = '$ZIP' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new zipcode of $ZIP by $handle on $now";

$page="editLandlord";

//END global-Landlord-parkingcost.php //
?>
