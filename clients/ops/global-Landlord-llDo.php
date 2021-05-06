<?php
//BEGIN global-ListingsEdit //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$LANDLORD = $_POST['LANDLORD'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `LANDLORD` = '$LANDLORD' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Landlord / Owner by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
