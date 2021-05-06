<?php
//BEGIN delete//
if ($user_level > 1) {
	$clid = $HTTP_GET_VARS['clid'];
	$page = "deleteAppointmentconf";
	$title = "Delete Appointment";
	$msg = "Are you sure you want to delete this appointment?";
}else {
	$page = "home";
	$msg = "You are not authorized to make deletes.";
}
//END delete//
?>