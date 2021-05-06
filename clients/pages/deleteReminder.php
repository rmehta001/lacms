<?php
//BEGIN hot_list_remove //
//	$return_page = $HTTP_GET_VARS['return_page']; //

//	$return_page = $HTTP_GET_VARS['return_page']; //



	$rid = $_POST['RID'];





	$quStrRemoveReminder = "DELETE FROM REMINDERS WHERE RID='$rid' AND CLI='$grid' AND UID='$uid'";
	$quRemoveReminder = mysqli_query($dbh, $quStrRemoveReminder);

$msg = "Reminder Deleted.";


$title = "Hot List";
$page = "hotlist";
//	$return_page_go = true;
//END hot_list_remove //
?>