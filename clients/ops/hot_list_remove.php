<?php
//BEGIN hot_list_remove //
//	$return_page = $_GET['return_page']; //

//	$return_page = $_GET['return_page']; //

	$hots_id = $_GET['hots_id'];

if (($_SESSION["isAdmin"]) or ($_SESSION["user_level"] ==10)) {

	$quStrRemoveHots = "DELETE FROM HOTS WHERE ID='$hots_id' AND GRID='$grid'";
	$quRemoveHots = mysqli_query($GLOBALS['dbh'], $quStrRemoveHots);

} else {

	$quStrRemoveHots = "DELETE FROM HOTS WHERE ID='$hots_id' AND GRID='$grid' AND UID='$uid'";
	$quRemoveHots = mysqli_query($GLOBALS['dbh'], $quStrRemoveHots);

}

$page = "hotlist";
//	$return_page_go = true;
//END hot_list_remove //
?>