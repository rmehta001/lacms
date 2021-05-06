<?php

$RentJuice_MLS = $_POST["RentJuice_MLS"];
$RentJuiceAPIKey = $_POST["user"];
$got = $_POST["gotRentJuice"];

if ($got == "Yes") 
{
	$got = "1";
}
else 
{
	$got = "0";
}

$quStrEditExtImp = "UPDATE `GROUP` SET RENTJUICE=$got, RENTJUICE_KEY='$RentJuiceAPIKey', RENTJUICE_MLS='$RentJuice_MLS' WHERE GRID=$grid";
$quEditExtImp = mysqli_query($dbh, $quStrEditExtImp);

//$page = "admin";

header( 'Location: https://www.bostonapartments.com/lacms/clients/AgencyArea2.php?op=admin');

?>