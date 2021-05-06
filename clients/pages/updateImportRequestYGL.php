<?php
	include ("../../inc/local_info.php");
	mysqli_select_db($dbh, $DBNAME);
	
	if (isset($_GET['grid']) && trim($_GET['grid']) != "")
	{
		$GRID = $_GET['grid'];
		if ($GRID != "")
		{
			mysqli_query($dbh, "INSERT INTO `IMPORT_REQUESTS` (GRID, CSOURCE) VALUES ($GRID, 2)");

			header( 'Location: https://www.bostonapartments.com/lacms/clients/AgencyArea2.php?op=admin');
		}
		else
		{
			header( 'Location: https://www.bostonapartments.com/lacms/clients/AgencyArea2.php?op=admin');
		}
	} 
?>