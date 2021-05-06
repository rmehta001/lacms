<?php
include("../inc/global.php");
include("../inc/local_info.php");

function sortByField($multArray,$sortField,$desc=true){
           $tmpKey='';
           $ResArray=array();

           $maIndex=array_keys($multArray);
           $maSize=count($multArray)-1;

           for($i=0; $i < $maSize ; $i++) {

               $minElement=$i;
               $tempMin=$multArray[$maIndex[$i]][$sortField];
               $tmpKey=$maIndex[$i];

               for($j=$i+1; $j <= $maSize; $j++)
                 if($multArray[$maIndex[$j]][$sortField] < $tempMin ) {
                     $minElement=$j;
                     $tmpKey=$maIndex[$j];
                     $tempMin=$multArray[$maIndex[$j]][$sortField];

                 }
                 $maIndex[$minElement]=$maIndex[$i];
                 $maIndex[$i]=$tmpKey;
           }

           if($desc)
               for($j=0;$j<=$maSize;$j++)
                 $ResArray[$maIndex[$j]]=$multArray[$maIndex[$j]];
           else
             for($j=$maSize;$j>=0;$j--)
                 $ResArray[$maIndex[$j]]=$multArray[$maIndex[$j]];

           return $ResArray;
       }


$quStr="SELECT * FROM SESSIONS INNER JOIN `GROUP` USING (GRID) ORDER BY TIMEIN ASC";

// INNER JOIN GROUP ON `SESSIONS`.GRID = GROUP.GRID";
$quSessions=mysqli_query($dbh,$quStr) or die (mysqli_error());
while ($row = mysqli_fetch_object($quSessions)) {
    $logins[$row->GRID]['lastlogin'] = 0;
    if ($logins[$row->GRID]['lastlogin'] < $row->TIMEIN) {
        $logins[$row->GRID]['name'] = $row->NAME;
        $logins[$row->GRID]['lastlogin'] = $row->TIMEIN;
        $logins[$row->GRID]['id'] = $row->GRID;

//   }
    }
}
$log=sortByField($logins, "lastlogin", true);
//sort($logins[lastlogin]);
foreach ($log as $key => $row)
{
	echo "$row[id] : $row[name] : $row[lastlogin] <BR>";
}
?>
