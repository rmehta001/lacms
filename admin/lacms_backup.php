<?php 

include ("../inc/local_info_ii.php");
mysqli_select_db($dbh, $DBNAME) or die("can't select $DBNAME");

$today = date ("Ymd");

$time = date ("H_i");
$str_dir = "/usr/home/eboyer/lacmsBACKUP/$today/$time";

//make dir
exec ("mkdir '$str_dir'");
exec ("chmod 777 '$str_dir'");

$quStrLockTables = "LOCK TABLES CLASS READ, `GROUP` READ, USERS READ, PICTURE READ, LANDLORD READ, TYPES READ";
$quLockTables = mysqli_query ($dbh,$quStrLockTables) or die ("Can't Lock Tables");

$quStrBackupTables = "BACKUP TABLE CLASS, `GROUP`, USERS, PICTURE, LANDLORD, TYPES, CLIENTS, VALUE_DEFINE TO '$str_dir'";
$quBackupTables = mysqli_query($dbh,$quStrBackupTables) or die ($quStrBackupTables);

mysqli_query("UNLOCK TABLES");

?>