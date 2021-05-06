<?php
//BEGIN deleteClient //
$clid = $_GET['clid'];
$user_level = $_SESSION['user_level'];
if (empty($user_level) || $user_level<="2") {

$page = "deleteClientCant";
		$title = "Manage Clients";
		$page = "manageClients";
	//	$disData = "client";
		$msg = "<font color=red>You are not authorized to delete clients.</font> See your office administrator.";

} else {




	$page = "deleteClient";
	$disData = "client";
	
}
	
//END deleteClient //
?>