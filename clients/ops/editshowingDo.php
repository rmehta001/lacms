<?php 
//BEGIN editPrefsDo //
	
		if ($_SESSION["level"]>4) {
			
		$cid = $_POST['cid'];
		$showid = $_POST['showid'];
		$lid = $_POST['lid'];
		$home_phone = $_POST['home_phone'];
		$clid = $_POST['clid'];
		$showing_date = $_POST['showing_date'];
		$show_time = $_POST['show_time'];
		$rating = $_POST['rating'];
		$showcomment = $_POST['showcomment'];



	$quStrEditshowings = "UPDATE `SHOWINGS` SET UID='$uid', CID='$cid', LID='$lid', CLID='$clid', SHOWING_DATE='$showing_date', SHOW_TIME='$show_time', RATING='$rating', SHOWCOMMENT='$showcomment' WHERE SHOWID='$showid' AND CLI='$grid'";
	$Editshowings = mysqli_query($GLOBALS['dbh'], $quStrEditshowings);
	$page = "showingsAgent";
	$msg = "Showing Changes Made.";
	$title = "Showings";

} else {

	$page = "home";
	$msg = "<font color=red>Changes not saved.</font>";
	$title = "Home";

	}
	
//END editPrefsDo //
?>