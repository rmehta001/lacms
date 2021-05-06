<?php
//BEGIN global-Landlord-Do//

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$PRIORITY = $_POST['PRIORITY'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET PRIORITY = '$PRIORITY' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord had Listings Priority modified by $handle on $now";

$page="editLandlord";

//END global-Landlord-Do //
?>
