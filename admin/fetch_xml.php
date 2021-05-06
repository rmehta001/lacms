<?php

include("../inc/local_info.php");
include("../inc/global.php");

$quStrGetAds = "SELECT * FROM CLASS WHERE CLI=1";
$quGetAds = mysqli_query($dbh,$quStrGetAds);
$rowGetAds = mysqli_fetch_object($quGetAds);

$num_fields = mysqli_num_fields($quGetAds);

for ($i=0;$i<$num_fields;$i++) {
	$field_name_array[$i] = mysqli_fetch_field($quGetAds, $i);
}

mysqli_data_seek ($quGetAds, 0);
header ("Content-type: text/xml");

echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>";
?> 
<listings>
<?php while ($rowGetAds = mysqli_fetch_row($quGetAds)) { ?>
<listing>
<?php for ($i=0;$i<$num_fields;$i++) { 
$field = $field_name_array[$i];	
?>
<?php if ($rowGetAds[$i]) { ?>
<<?php echo $field->name;?>><?php echo $rowGetAds[$i];?></<?php echo $field->name;?>>
<?php }?>
<?php }?>
</listing>
<?php } ?>
</listings>

