<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$SCHOOL_DISTRICT = $_POST['SCHOOL_DISTRICT'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `SCHOOL_DISTRICT` = '$SCHOOL_DISTRICT' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the School District setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>