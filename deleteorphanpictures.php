<?PHP

	include ("local_info.php");
	mysqli_select_db($dbh, $DBNAME);


	$quStrGetPix = "SELECT * FROM PICTURE LEFT OUTER JOIN CLASS ON PICTURE.CID = CLASS.CID
WHERE CLASS.CID IS NULL";
	$quGetPix = mysqli_query($dbh, $quStrGetPix) or die ("$quStrGetPix");
	
while ($rowPix=mysqli_fetch_object($quGetPix)) {	
	
	echo "CID: ".$rowPix->CID . "<BR>";

	echo $rowPix->PID .".".$rowPix->EXT ."<BR>";

	
// echo "<IMG SRC=http://www.bostonapartments.com/pics/".$rowPix->PID.".".$rowPix->EXT."><BR><BR>";
	
	$pic_path = "/usr/home/eboyer/public_html/bostonapartments/pics/$rowPix->PID.$rowPix->EXT";
		unlink ($pic_path);
		$quStrDeletePic = "delete from PICTURE where PID='$rowPix->PID'";
		$quDeletePic = mysqli_query($dbh, $quStrDeletePic) or die (mysqli_error($dbh));	
	
echo "IMAGE DELETED<BR><BR>";

	
}
	
	?>