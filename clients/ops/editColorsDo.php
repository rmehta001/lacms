<?php 
//BEGIN editColorsDo //
	
	$pref_row_color = isset ($_POST['pref_row_color']);
	$pref_pagebg_color = isset ($_POST['pref_pagebg_color']);
	$pref_coltit_color = isset ($_POST['pref_coltit_color']);
	$pref_topbar_color = isset ($_POST['pref_topbar_color']);
	$pref_topmenu_color = isset ($_POST['pref_topmenu_color']);
	$pref_pagetrim_color = isset ($_POST['pref_pagetrim_color']);

	$quStrEditPrefs = "UPDATE USERS SET PREF_ROW_COLOR='$pref_row_color', PREF_PAGEBG_COLOR='$pref_pagebg_color', PREF_COLTIT_COLOR='$pref_coltit_color', PREF_TOPBAR_COLOR='$pref_topbar_color', PREF_TOPMENU_COLOR='$pref_topmenu_color', PREF_PAGETRIM_COLOR='$pref_pagetrim_color' WHERE UID=$uid";
	$quEditPrefs = mysqli_query($dbh, $quStrEditPrefs);
	$page = "home";
	$msg = "Personal settings saved.";
	$title = "Home";
	$limitN = $_SESSION["user_num_ads"];
	
//END editColorsDo //
?>