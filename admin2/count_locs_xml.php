<?php
include("./inc/admin_key.php");

$quStrGetLocCount = "select LOCNAME, count(LOCID) as count_locs from CLASS inner join LOC on CLASS.LOC=LOC.LOCID GROUP BY LOCID order by count_locs desc, LOCNAME  limit 10";
$quGetLocCount = mysqli_query($dbh,$quStrGetLocCount) or die (mysqli_error());
$num_locs = mysqli_num_rows($quGetLocCount);
echo "<?xml version=\"1.0\"?>\n";
?>
<count_locs>
<?php while($rowGetLocCount = mysqli_fetch_object($quGetLocCount)) {?>
<loc name="<?php echo $rowGetLocCount->LOCNAME;?>" count="<?php echo $rowGetLocCount->count_locs;?>"/>
<?php } ?>
</count_locs>
