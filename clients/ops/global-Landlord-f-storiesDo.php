<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$STORIES = $_POST['STORIES'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `STORIES` = '$STORIES' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Stories setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>