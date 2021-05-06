<?php
//BEGIN createClientDo //
	if ($_SESSION["level"]>4) {


$remind = $_POST['REMIND'];
$remind_date = $_POST['REMIND_DATE'];
$remind_time = $_POST['REMIND_TIME'];
$remind_length = $_POST['REMIND_LENGTH'];





		$quStrAddRemind = "INSERT INTO `LACMS`.`REMINDERS` (`RID` , `CLI` , `UID` , `REMIND` , `REMIND_DATE` , `REMIND_TIME` , `REMIND_LENGTH`)
VALUES (NULL , '$grid', '$uid', '$remind', '$remind_date', '$remind_time', '$remind_length')";
		$quAddRemind = mysqli_query($GLOBALS['dbh'], $quStrAddRemind) or die ($quStrAddRemind);
		$page = "hotlist";
		$msg = "New Reminder created.";
		$title = "Hot List";



	}else {		
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END createClientDo //
?>