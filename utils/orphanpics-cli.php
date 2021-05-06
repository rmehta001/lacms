<?php
include("../inc/global.php");
include("../inc/local_info.php");

mysqli_select_db($dbh,  "LACMS" );

#$do=$HTTP_GET_VARS['do'];
$do="yes";


$sqlSTR="SELECT * FROM PICTURE";
$sqlQ=mysqli_query($dbh, $sqlSTR);

while($row = mysqli_fetch_object($sqlQ))
{
	$strClass="SELECT CID FROM CLASS WHERE CID=$row->CID";
	$qClass=mysqli_query($dbh, $strClass);
	$numrows=mysqli_num_rows($qClass);
	if($numrows<=0)
	{
		$sql="DELETE FROM PICTURE WHERE PID=$row->PID";
		$cmd="mv /www/pics/$row->PID.$row->EXT /save_pics/";
		$cmd_test="ls -l /www/pics/$row->PID.$row->EXT";
		if($do=="yes")
		{
			$outp=exec($cmd);
			$sqlDO=mysqli_query($dbh, $sql);
		} else {
			$outp=exec($cmd_test);
		}
#		print "$sql<br>$cmd<br>$outp<hr>";
		print "$sql\n$cmd\n$outp\n";
		print "DELETED '".$row->PID."' '".$row->CID."' '".$row->EXT."' '".$row->DESCRIPT."' '".$row->UID."' '".$row->PICORDER."'\n";
	} else {
#		echo "FOUND: $row->PID $row->CID<br>\n";
	}
}

?>
