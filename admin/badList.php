<?php
include ("../inc/local_info.php");
mysqli_select_db($dbh, $DBNAME);

$quStrGetBad1 = "SELECT * FROM CLASS INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID WHERE AVAIL='2004-00-00' ORDER BY NAME";
$quGetBad1 = mysqli_query($dbh, $quStrGetBad1) or die ($quStrGetBad1);

?>
<h2>BAD AVAIL DATES LIST ONE (ADS FROM YESTERDAY AND TODAY):<br></h2>
<b>AGENCY -- RECORD NUMBER <br></b>
<hr>
 AD BODY
<hr>
<?php 
while ($rowGetAds = mysqli_fetch_object($quGetBad1)) {
	echo "<b>$rowGetAds->NAME -- $rowGetAds->CID</b> <br><hr>$rowGetAds->BODY<hr> \n";
}
?>
