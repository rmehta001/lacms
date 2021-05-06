<?php
//BEGIN global-Landlord-Do//

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$YOUTUBEURL = $_POST['YOUTUBEURL'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET YOUTUBEURL = '$YOUTUBEURL' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the global change to the YouTube URL by $handle on $now";

$page="editLandlord";

//END global-Landlord-Do //
?>
