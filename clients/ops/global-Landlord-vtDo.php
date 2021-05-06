<?php
//BEGIN global-Landlord-Do//

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$VIRT_TOUR = $_POST['VIRT_TOUR'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET VIRT_TOUR = '$VIRT_TOUR' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the global change to virtual tour address by $handle on $now";

$page="editLandlord";

//END global-Landlord-Do //
?>
