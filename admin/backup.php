<?php
include("../inc/global.php");
set_time_limit(0);

$now = date("D M j G:i:s T Y");
$nowYYYYMMDD = date("Ymd");

//Backup Class table//
/*
$mkdir = exec ("mkdir /usr/home/eboyer/lacmsBACKUP/$nowYYYYMMDD") or die("can't mkdir /usr/home/eboyer/lacmsBACKUP/$nowYYYYMMDD");
$chmod = exec ("chmod 777 /usr/home/eboyer/lacmsBACKUP/$nowYYYYMMDD") or die ("chmod 777 /usr/home/eboyer/lacmsBACKUP/$nowYYYYMMDD");
*/
mysqli_query($dbh,"LOCK TABLE CLASS READ") or die ("LOCK TABLE CLASS READ");
mysqli_query($dbh,"BACKUP TABLE CLASS TO '/usr/home/eboyer/lacmsBACKUP/$nowYYYYMMDD/'") or die ("BACKUP TABLE CLASS TO '/usr/home/eboyer/lacmsBACKUP/$nowYYYYMMDD/'");
mysqli_query($dbh,"UNLOCK TABLES") or die ("UNLOCK TABLES");

?>