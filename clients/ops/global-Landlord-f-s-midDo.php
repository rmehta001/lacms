<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$MIDDLE_SCHOOL = $_POST['MIDDLE_SCHOOL'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `MIDDLE_SCHOOL` = '$MIDDLE_SCHOOL' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Middle School setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>