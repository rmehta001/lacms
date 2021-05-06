<?php


$YGLAPIKey = $_POST["user"];
$YGL_FEED = $_POST["ygl_feed"];

$got = $_POST["gotYGL"];

if ($got == "Yes") 
{
	$got = "1";
}
else 
{
	$got = "0";
}

$quStrEditExtImp = "UPDATE `GROUP` SET YGL=$got, YGl_KEY='$YGLAPIKey', YGL_FEED='$YGL_FEED' WHERE GRID=$grid";
$quEditExtImp = mysqli_query($dbh, $quStrEditExtImp);

$page = "admin";

header( 'Location: https://www.bostonapartments.com/lacms/clients/AgencyArea2.php?op=admin');

?>