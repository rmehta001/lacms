<?php
//   removes pictures from the /pics directory that have CID of < 1 removed 34,000 bad pics from off-line to bad uploads. Ran from BA/import and removed. put in LACMS


	include ("local_info.php");
	mysqli_select_db($dbh, $DBNAME);

	$quStrGetPics = "select * from PICTURE where CID < 1";
	$quGetPics = mysqli_query($dbh, $quStrGetPics) or die (mysqli_error($dbh));
	while ($rowGetPics = mysqli_fetch_object($quGetPics)) {
		$pic_path = "/usr/home/eboyer/public_html/bostonapartments/pics/$rowGetPics->PID.$rowGetPics->EXT";
		unlink ($pic_path);
		$quStrDeletePic = "delete from PICTURE where PID='$rowGetPics->PID'";
		$quDeletePic = mysqli_query($dbh, $quStrDeletePic) or die (mysqli_error($dbh));
		
	echo "deleted picture " . $rowGetPics->PID . "<BR>";		
	}

	?>