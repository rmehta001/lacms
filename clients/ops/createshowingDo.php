<?php
//BEGIN createshowingDo //
	if ($_SESSION["level"]>4) {
		$cid = isset($_POST['cid'])? $_POST['cid'] : "";
		
		$lid = isset($_POST['lid']);
		$home_phone = isset($_POST['home_phone']);
		$clid = isset($_POST['clid']);
		$showing_date = isset($_POST['showing_date']);		
		$show_time = isset($_POST['show_time']);
		$rating = isset($_POST['rating']);
		$showcomment = isset($_POST['showcomment']);
		$showing_date = isset($_POST['showing_date']);

//		$showing_date = $_POST['sd_year'] ."-". $_POST['sd_month'] ."-". $_POST['sd_day'];//


		
		$quStrAddClient = "INSERT INTO SHOWINGS (CLI, UID, CID, LID, CLID, SHOWING_DATE, SHOW_TIME, RATING, SHOWCOMMENT) VALUES ('$grid', '$uid', '$cid', '$lid', '$clid', '$showing_date', '$show_time', '$rating', '$showcomment')";
		$quAddClient = mysqli_query($dbh, $quStrAddClient) or die ($quStrAddClient);
		$page = "home";
		$msg = "New Showing Created.";
		$title = "Home";

		$sec_op = "listings";
		

		
	}else {		
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END createshowingDo //
?>