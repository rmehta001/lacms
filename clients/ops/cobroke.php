<?php
//Begin admin.php //
if (isset($isAdmin) OR ($user_level >="10")) {
	$page = "cobroke";
	$disData = "user";
	$disData2 = "group";
$title = "Co-Broke";

}else {
	$page = "home";
	$msg = "Your are not entitled to this function.";
	$msg_err = true;
}
//End admin.php //
?>