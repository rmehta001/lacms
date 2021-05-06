<?php
$id = preg_replace("/'\/<>\"/","",$_GET['ID']);
if (empty($id) || !is_numeric($id))
die("Invalid ID");
$query = "DELETE FROM OPENHOUSE WHERE ID='$id' AND CLI=$grid";
$res = mysqli_query($dbh, $query) or die(mysqli_error($dbh));


?>

<?php

$page="openhouse-list";

if ($res) {
$msg="Open House $id successfully deleted";
} else {
$msg="No such Open House $id or you're trying to delete someone else's Open House Listing";
}
?>
