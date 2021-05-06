<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$SCHOOL = $_POST['SCHOOL'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `SCHOOL` = '$SCHOOL' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the College setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>