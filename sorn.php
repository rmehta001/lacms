<?php
include ("./inc/local_info.php");
include ("./inc/global.php");
mysqli_select_db($dbh, $DBNAME);

$quStrGetTrans = "select * from TRANSLOG where ID=247";
$quGetTrans = mysqli_query($dbh, $quStrGetTrans);

$rowTrans = mysqli_fetch_object($quGetTrans);

$trun = $rowTrans->STATUS;

$counTrun = strlen($trun);
header ("text/plain");
echo $trun;

?>