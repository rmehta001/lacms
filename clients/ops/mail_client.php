<?php
//BEGIN mailClient //
	$clid = $_GET['clid'];
	$quStrGetClient = "SELECT * FROM CLIENTS WHERE CLID=$clid";
	$quGetClient = mysqli_query($dbh, $quStrGetClient) or die(dieNice("Sorry,  couldn't find that client", "C-8000"));
	$rowGetClient = mysqli_fetch_object($quGetClient);
	$page = "mail_client";
$disData = "user";	
	$title = "Email A Client";
//END editClient //
?>