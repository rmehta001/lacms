<?php
//BEGIN restrict_ip_do //
	if ($isAdmin) {
		$restrict_ip = $_POST['restrict_ip'];
		$ip_address = $_POST['ip_address'];
		$quStrUpdateGroup = "UPDATE `GROUP` SET RESTRICT_IP='$restrict_ip', IP_ADDRESS='$ip_address' WHERE GRID='$grid'";
		$quUpdateGroup = mysqli_query($dbh, $quStrUpdateGroup);
		$page = "manageUsers";
		$msg = "Restricted login enabled.";
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END restrict_ip_do //
?>