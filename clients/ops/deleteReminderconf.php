<?php
//BEGIN delete//
if ($user_level > 1) {
	$rid = $HTTP_GET_VARS['rid'];
	$page = "deleteReminderconf";
	$title = "Delete Reminder";
	$msg = "Are you sure you want to delete this reminder?";
}else {
	$page = "home";
	$msg = "You are not authorized to make deletes.";
}
//END delete//
?>