<?php
//BEGIN editReminderDo //

		$remind_time = $_POST['REMIND_TIME'];
		$remind_date = $_POST['REMIND_DATE'];
		$remind_length = $_POST['REMIND_LENGTH'];
		$remind = $_POST['REMIND'];
		$rid = $_POST['RID'];
		
		
		
		
		
if ($level>4) {

		$quStrUpdateReminder = "UPDATE REMINDERS SET `REMIND_TIME`='$remind_time', `REMIND_DATE`='$remind_date', `REMIND_LENGTH`='$remind_length', `REMIND`='$remind'  WHERE `RID` = \"$rid\" AND `CLI`=\"$grid\" AND `UID`=\"$uid\"";
		$quUpdateReminder = mysqli_query($dbh, $quStrUpdateReminder) or die ($quStrUpdateReminder);
		
		$page = "hotlist";
		$msg = "Reminder Edits Saved by $handle." ;
		$title = "Hot List";
//		$sec_op = "manageClients";
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editReminderDo //
?>