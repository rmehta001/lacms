<?php
//Begin admin.php //
if ($isAdmin) {
	$page = "admin2";
}else {
	$page = "home";
	$msg = "Your are not entitled to this function.";
	$msg_err = true;
}
//End admin.php //
?>