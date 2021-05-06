<?php
//BEGIN global-Landlord-Do//

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$AD_TITLE = $_POST['AD_TITLE'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET AD_TITLE = '$AD_TITLE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new Ad Title of \"$AD_TITLE\" by $handle on $now";

$page="editLandlord";

//END global-Landlord-Do //
?>
