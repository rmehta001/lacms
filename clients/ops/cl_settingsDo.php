<?php 
//BEGIN editCLDo //
	
	$cl_phone = $_POST['cl_phone'];
	$cl_email = $_POST['cl_email'];
	$cl_header = $_POST['cl_header'];
	$cl_footer = $_POST['cl_footer'];
	$cl_use_sig = $_POST['cl_use_sig'];	
	
	
	$quStrCLPrefs = "UPDATE `GROUP` SET CL_EMAIL='$cl_email', CL_PHONE='$cl_phone', CL_HEADER='$cl_header', CL_FOOTER='$cl_footer', CL_AGENTS='$cl_agents', CL_USE_SIG='$cl_use_sig' WHERE `GRID`=$grid";
	$quCLPrefs = mysqli_query($dbh, $quStrCLPrefs);
	$page = "admin";
	$msg = "Craigslist settings saved.";
	$title = "Admin";
	
//END editCLDo //
?>