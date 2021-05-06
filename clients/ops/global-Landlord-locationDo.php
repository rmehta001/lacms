<?php
//BEGIN global-Landlord-location.php //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$LOC = $_POST['LOC'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `LOC` = '$LOC' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new location by $handle on $now";

$page="editLandlord";

//END global-Landlord-location.php //
?>
