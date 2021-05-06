<?php

include ("../inc/global.php");
mysqli_select_db($dbh, $DBNAME);


$nowP1 = date ("Y-m-d");
$nowP2 = (date ("H") - 1);
$nowP3 = date (":i:s");


$now = $nowP1.$nowP2.$nowP3;

$realNow = date ("YmdHis");

$quStrGetSessions = "UPDATE SESSIONS SET TIMEOUT=$realNow WHERE isNull(TIMEOUT) AND TIMEIN < $now";
$quGetSessions = mysqli_query($dbh, $quStrGetSessions);


?> 
