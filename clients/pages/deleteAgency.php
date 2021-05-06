<?php
if ($isAdmin || $handle=="chinkle")
{
	$quStrAgency="select * from AGENCIES WHERE GID=$grid";
	$quAgency=mysqli_query($dbh, $quStrAgency);
	while($agency_object=mysqli_fetch_object($quAgency))
	{
		if($agency_object->AGENCY_ID==($agency_id+0))
		{	$agency=$agency_object;	}
		else
		{ $arrayAgency[$agency_object->AGENCY_ID]=$agency_object->AGENCY_NAME; }
	}
	if ($agency)
	{
		if($agency->AGENCY_NAME)
		{ $agency_name=$agency->AGENCY_NAME; }
		else
		{ $agency_name=$agency_id; } ?>
Delete Agency: <?php echo "$agency_name."; ?><br>
Assign all it's listings to:<br>
<form action=<?php echo "$PHP_SELF?op=deleteAgencyDo"; ?> method=POST>
<input type=hidden name=agency_id value="<?php echo $agency_id;?> ">
<input type=hidden name=return_page value="<?php echo $return_page; ?> ">
<input type=hidden name=return_page_div value="<?php echo $return_page_div;?>">
<select name=agency_reassign>
<option value=0 default>Main Agency</option>
<?php foreach($arrayAgency as $key => $value)
{ ?>
<option value=<?php echo $key; ?> ><?php echo $value ?></option>
<?php } ?>
</select><br>
Please type 'y' to confirm: <input type="text" size="3" name="conf"><br>
<input type=submit value="Delete">
<a href=<?php echo "$PHP_SELF?op=return_page_op"; ?>>Cancel</a>
</form>
<?php 
	} else
	{  echo "Sorry, No such group."; }
} else
{ echo "Sorry, you do not have the privildedges to delete"; }
?>
