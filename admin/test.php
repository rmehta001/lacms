<?php
include("../inc/local_info.php");
//$quStr="SELECT * FROM SESSIONS INNER JOIN `GROUP` USING (GRID) ORDER BY TIMEIN ASC";
//
//// INNER JOIN GROUP ON `SESSIONS`.GRID = GROUP.GRID";
//$quSessions=mysqli_query($dbh,$quStr) or die (mysqli_error());
//while ($row = mysqli_fetch_object($quSessions)) {
//    $logins[$row->GRID]['lastlogin']=null;
//    if($logins[$row->GRID]['lastlogin'] < $row->TIMEIN)
//    {
//        $logins[$row->GRID]['name']=$row->NAME;
//        $logins[$row->GRID]['lastlogin']=$row->TIMEIN;
//        $logins[$row->GRID]['id']=$row->GRID;
//
////   }
//    }
//
//}
//
//$maIndex=array_keys($logins);
//
//print_r($logins);
//echo count($logins);
$quStrGetAds = "SELECT  * ,  MATCH ( ALTSIG, BODY ) AGAINST (  'boston' ) AS SCORE FROM ((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID WHERE  MATCH ( ALTSIG, BODY ) AGAINST ('boston') ORDER  BY SCORE DESC LIMIT 10";
$quGetAds = mysqli_query($dbh,$quStrGetAds);
while($rowGetAds = mysqli_fetch_object($quGetAds)) {
    echo $rowGetAds->TYPEABV;
}



?>