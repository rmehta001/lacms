<?php 
include("../inc/local_info.php");



$quStrMoveSessions = "INSERT INTO SESSIONS_OLD (UID, GRID, TIMEIN, TIMEOUT) SELECT SESSIONS.UID, SESSIONS.GRID, SESSIONS.TIMEIN, SESSIONS.TIMEOUT FROM SESSIONS";
$quMoveSessions = mysqli_query($dbh,$quStrMoveSessions);

$quStrPurgeSessions = "DELETE FROM SESSIONS";
$quPurgeSessions = mysqli_query($dbh,$quStrPurgeSessions);

?>
