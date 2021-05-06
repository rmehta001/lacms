<?php

        include ("./inc/global.php");
        include ("./inc/local_info.php");
        mysqli_select_db($dbh, $DBNAME);

$str1="SELECT * FROM CLASS";
// ORDER BY CID LIMIT 10000";
$q1=mysqli_query($dbh, $str1);

while($bad_class=mysqli_fetch_object($q1))
{
	$str="SELECT * FROM CLASS_FIX WHERE CID=".$bad_class->CID;
	$q=mysqli_query($dbh, $str);
	$r=NULL;
	if($r=mysqli_fetch_object($q))
	{ 
//	   echo "Change from: ".$bad_class->STREET." to ".$r->STREET."<br>"; 
	$u_str="UPDATE CLASS SET STREET=\"".$r->STREET."\" WHERE CID=".$r->CID.";\n";
	echo $u_str;
	}
	else 
	{ 
//	  echo "NOT FOUND: ".$bad_class->CID." ".$bad_class->STREET."<br>"; 
	  if(preg_match('/\d\d\d\d/', $bad_class->STREET))
	  {
	    echo "preg_match UPDATE CLASS SET STREET='' WHERE CID=".$bad_class->CID.";\n";
	  }
	}
}

?>
