<?php 
//BEGIN editCLDo //
	
	$cl_phoneu =isset ($_POST['cl_phoneu']);
	$cl_emailu = isset ($_POST['cl_emailu']);
	$cl_headeru = mysqli_real_escape_string($dbh, isset ($_POST['cl_headeru']));
	$cl_footeru = mysqli_real_escape_string($dbh, isset ($_POST['cl_footeru']));
	
	$quStrCLUPrefs = "UPDATE `USERS` SET CL_EMAILU='$cl_emailu', CL_PHONEU='$cl_phoneu', CL_HEADERU='$cl_headeru', CL_FOOTERU='$cl_footeru' WHERE UID=$uid";
	$quCLUPrefs = mysqli_query($dbh, $quStrCLUPrefs);
	$page = "editPrefs";
	$msg = "Craigslist Agent settings saved.";
	$title = "Edit Preferences";

	$disData = "user";
	$disData2 = "group";
//END editCLDo //
?>