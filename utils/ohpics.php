<html>
<body>
<?php

include("../inc/global.php");
include("../inc/local_info.php");

mysqli_select_db($dbh,  "LACMS" );

$do=$HTTP_GET_VARS['do'];

//$file=fopen("/home/augustin/durr","r");
$cid_str=file_get_contents("/home/augustin/durr");
$cids=split("\n", $cid_str);

foreach ($cids as $cid)
{
   $sqlStr="SELECT * FROM PICTURE_OLD WHERE CID=$cid";
   echo "ad $cid<br>\n";
   $sqlQ=mysqli_query($dbh, $sqlStr);
   if(($num_rows=mysqli_num_rows($sqlQ)) < 1)
   {
      echo "$num_rows entries found<br>"; 
   } else {
      while($entry=mysqli_fetch_object($sqlQ))
      {
         $sql="INSERT INTO PICTURE (PID,CID,EXT,DESCRIPT,UID) VALUES('".$entry->PID."','".$entry->CID."','".$entry->EXT."','".$entry->DESCRIPT."','".$entry->UID."');";
         $sql_test="INSERT INTO PICTURE_TEST (PID,CID,EXT,DESCRIPT,UID) VALUES ('".$entry->PID."','".$entry->CID."','".$entry->EXT."','".$entry->DESCRIPT."','".$entry->UID."');";
         $cmd="cp /nobackup/save_pics/$entry->PID.$entry->EXT /www/pics/";
         $cmd_test="cp /nobackup/save_pics/$entry->PID.$entry->EXT /tmp/crap/";
         if($do=="yes")
         {
            $sqlDO=mysqli_query($dbh, $sql);
 	    $outp=exec($cmd);
	 }  else {
            $sqlDO=mysqli_query($dbh, $sql_test);
            $outp=exec($cmd_test);
         }
         echo "$sql_test<br>$sql<br>$cmd<br>$outp<br>";
//         echo "$entry->PID.$entry->EXT";
      }
   }
}

if(0)

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
		print "$sql<br>$cmd<br>$outp<hr>";
}

?>
</body>
</html>
