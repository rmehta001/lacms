<?php 
//BEGIN editCLDo //
	
	$email_header = $_POST['email_header'];
	$email_footer = $_POST['email_footer'];
	
	$quStrHFAPrefs = "UPDATE `USERS` SET AGENT_EMAIL_HEADER='$email_header', AGENT_EMAIL_FOOTER='$email_footer' WHERE `UID`=$uid";
	$quHFAPrefs = mysqli_query($dbh, $quStrHFAPrefs);
	$page = "editPrefs";
	$msg = "Email Template saved.";
	$title = "Email Preferences";
	
//END editemailHFADo //
?>