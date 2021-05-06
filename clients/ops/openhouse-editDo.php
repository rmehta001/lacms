<?php
//BEGIN openhouse-editDo //
	
	$oh_date = $_POST['oh_year'] ."-". $_POST['oh_month'] ."-". $_POST['oh_day'];
	$oh_start_hour = htmlentities($_POST['START_HOUR']);
	$oh_start_mins = htmlentities($_POST['START_MINS']);
	$oh_start_mer = htmlentities($_POST['START_MER']);
	$oh_end_hour = htmlentities($_POST['END_HOUR']);
	$oh_end_mins = htmlentities($_POST['END_MINS']);
	$oh_end_mer = htmlentities($_POST['END_MER']);

	$oh_comments = htmlentities($_POST['COMMENTS']);
	$oh_comments = mysqli_real_escape_string($dbh, $oh_comments);	
	
	$id = htmlentities($_POST['ID']);

	
	if (empty($oh_date))
	die("<BR><P><BR><FONT COLOR=red>Please fill out the date section.</FONT><BR><P><a href=\"#\" onClick=\"history.go(-1)\">Back to Form</a><BR><P><BR>");


	if (empty($oh_start_hour))
	die("<BR><P><BR><FONT COLOR=red>Please pick a start time.</FONT><BR><P><a href=\"#\" onClick=\"history.go(-1)\">Back to Form</a><BR><P><BR>");



	if (empty($oh_end_hour))
	die("<BR><P><BR><FONT COLOR=red>Please pick an end time.</FONT><BR><P><a href=\"#\" onClick=\"history.go(-1)\">Back to Form</a><BR><P><BR>");


$quStrUpdateOpenhouse = "UPDATE OPENHOUSE SET DATE='$oh_date', START_HOUR='$oh_start_hour', START_MINS='$oh_start_mins', START_MER='$oh_start_mer', END_HOUR='$oh_end_hour', END_MINS='$oh_end_mins', END_MER='$oh_end_mer', COMMENTS='$oh_comments' WHERE ID=$id AND CLI=$grid";
	$quUpdateOpenhouse = mysqli_query($dbh, $quStrUpdateOpenhouse) or die (dieNice("Sorry,  couldn't update that Open House Listing", "E-8001"));


$page= "openhouse-list";
$msg = "Open House Listing Updated";

//END openhouse-editDo //
?>
