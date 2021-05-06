<?php
$id = preg_replace("/'\/<>\"/","",$_GET['NL_ID']);
if (empty($id) || !is_numeric($id))
die("Invalid ID");
$query = "DELETE FROM NEWSLETTERS WHERE NL_ID='$id' AND GRID='$grid'";
$res = mysqli_query($dbh, $query) or die(mysqli_error($dbh));

?>
<!--
if ($res)
die("Newsletter Succesfully Deleted.<BR><P><a href=\"#\" onClick=\"history.go(-1)\">Back to Form</a><BR><P><BR>");
-->
<?php

$page="newsletters-show";
$msg="Newsletter Succesfully Deleted"

?>	
