<?php 
//BEGIN editCLDo //
	
	$cl_phone = isset ($_POST['cl_phone']);
	$cl_email = isset ($_POST['cl_email']);
	$cl_header = isset ($_POST['cl_header']);
	$cl_footer = isset ($_POST['cl_footer']);
	
	$quStrCLPrefs = "UPDATE `GROUP` SET CL_EMAIL='$cl_email', CL_PHONE='$cl_phone', CL_HEADER='$cl_header', CL_FOOTER='$cl_footer', CL_AGENTS='$cl_agents' WHERE `GRID`=$grid";
	$quCLPrefs = mysqli_query($dbh, $quStrCLPrefs);
	$page = "admin";
	$msg = "Craigslist settings saved.";
	$title = "Admin";
	
//END editCLDo //
?>