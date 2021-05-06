<?php
//BEGIN global-Landlord-parkingcost.php //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$PETS = $_POST['PETS'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `PETSA` = '$PETS' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new pet setting by $handle on $now";

$page="editLandlord";

//END global-Landlord-parkingcost.php //
?>
