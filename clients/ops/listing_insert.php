<?php
//BEGIN listing_insert//

$editPage = $HTTP_GET_VARS['editPage'];
$returnPage = $HTTP_GET_VARS['return_page'];

$now = date ("Ymd");
$quStrInsert = "INSERT INTO CLASS (CLI, UID, DATEIN, TYPE, LOC) VALUES ('$grid', '$uid', '$now', 1, 1)";
$quInsert = mysqli_query($dbh, $quStrInsert) or die($quStrInsert);
$cid = mysqli_insert_id($dbh);

if ($editPage=="edit"){
	$return_page = $returnPage;
	$disData = "ad";
	$page = "edit";
	$msg = "New Ad created,  edit it here.";
}elseif ($editPage=="editListing") {
	$return_page = $returnPage;
	$needOptions = true;
	$disData = "listing";
	$page = "editListing";
	$msg = "New Listing created, edit it here.";
}

//END listing_insert //
?>