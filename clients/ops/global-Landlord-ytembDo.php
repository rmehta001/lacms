<?php
//BEGIN global-Landlord-Do//

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$YOUTUBE = $_POST['YOUTUBE'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET YOUTUBE = '$YOUTUBE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the global change to the YouTube Embed URL by $handle on $now";

$page="editLandlord";

//END global-Landlord-Do //
?>
