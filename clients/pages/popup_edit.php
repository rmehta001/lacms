<!--BEGIN popup_edit -->
<!--DEPRECIATED-->
		<center>
		<?php if ($level> 4 ) {?>
		Listing: <a href="<?php echo "$PHP_SELF?op=editListing&cid=$cid";?>">switch to edit mode</a> |<a href="<?php echo "$PHP_SELF?op=viewListing&cid=$cid";?>">switch to view mode</a> | <a href="<?php echo "$PHP_SELF?op=viewListing&cid=$cid&dontPrintHeader=1";?>">switch to print mode</a><br><br>
		<?php } ?><font color="#000000">
		Created by : <?php echo "$rowGetAd->HANDLE";?> <br>
		Created On: <?php echo "$rowGetAd->DATEIN";?> <br>
		Last Modifed on : <?php echo "$rowGetAd->MOD";?><br>
		Status : <?php if ($rowGetAd->STATUS=="ACT") {
				echo "Active";
			}else {
				echo "Inactive";
			} ?><br>
		
		<form action="<?php echo "$PHP_SELF?op=editDo";?>" method="POST">
		<input type="hidden" name="nofee" value="0">
		<input type="hidden" name="cid" value="<?php echo $rowGetAd->CID;?>">

		<select name="type">
	<?php while ($rowTypes=mysqli_fetch_object($quTypes)) {	?>
		<option value="<?php echo $rowTypes->TYPE;?>" <?php if ($rowGetAd->TYPE==$rowTypes->TYPE) {
																echo " selected"; }?> >
																<?php echo $rowTypes->TYPENAME; ?>
																</option>
	<?php }	?>
		</select><br>
		<select name='loc'>
	<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>
		<option value="<?php echo $rowLocs->LOCID; ?>" <?php if ($rowGetAd->LOC==$rowLocs->LOCID) {echo " selected"; }?> >
															<?php echo $rowLocs->LOCNAME; ?>
															</option>

	<?php }	?>
		</select><br>



		<textarea name="body" cols=40 rows=10 ><?php echo $rowGetAd->BODY;?></textarea><br>
		<br>
		
		
	Number of Bedrooms: <select name="rooms">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) { ?>
		<?php 
		$selected = ($rowGetAd->ROOMS==$key) ? " selected " : "";
		?>
		<option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $roomsValue;?></option>
	<?php } ?>	
	</select><br>
	Number of Bathrooms: <select name="bath">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bkey => $bathValue) { ?>
		<?php 
		$selected = ($rowGetAd->BATH==$bkey) ? " selected " : "";
		?>
		<option value="<?php echo $bkey;?>" <?php echo $selected;?>><?php echo $bathValue;?></option>
	<?php } ?>	
	</select><br>
		<font face="Verdana" size="1" color="#000000">
	<?php 
	$getMon = subStr ($rowGetAd->AVAIL, 5, 2);
	$getDay = subStr ($rowGetAd->AVAIL, 8, 2);
	$getYear = subStr ($rowGetAd->AVAIL, 0, 4);
	?>
	Available: Month <select name="aMonth">
	<option value="--">--</option>
	<option value="01" <?php if ($getMon == "01") { echo " selected "; } ?>>Jan</option>
	<option value="02" <?php if ($getMon == "02") { echo " selected "; } ?>>Feb</option>
	<option value="03" <?php if ($getMon == "03") { echo " selected "; } ?>>Mar</option>
	<option value="04" <?php if ($getMon == "04") { echo " selected "; } ?>>Apr</option>
	<option value="05" <?php if ($getMon == "05") { echo " selected "; } ?>>May</option>
	<option value="06" <?php if ($getMon == "06") { echo " selected "; } ?>>Jun</option>
	<option value="07" <?php if ($getMon == "07") { echo " selected "; } ?>>Jul</option>
	<option value="08" <?php if ($getMon == "08") { echo " selected "; } ?>>Aug</option>
	<option value="09" <?php if ($getMon == "09") { echo " selected "; } ?>>Sep</option>
	<option value="10" <?php if ($getMon == "10") { echo " selected "; } ?>>Oct</option>
	<option value="11" <?php if ($getMon == "11") { echo " selected "; } ?>>Nov</option>
	<option value="12" <?php if ($getMon == "12") { echo " selected "; } ?>>Dec</option>
	</select> Day <select name="aDay"> 
	<option value="--">--</option>
	<?php for ($i=1;$i<=31;$i++) {
		if ($i<=9) {
			$j = "0".$i;
		} else {
			$j = $i;
		}
	?>
	<option value="<?php echo $j;?>" <?php if ($getDay == $j) { echo " selected "; } ?>><?php echo $j;?></option>
	<?php } ?>
	</select> Year <select name="aYear">
	<option value="--">--</option>
	<?php 
	$thisYear = date ("Y");
	for ($i=0;$i<=4;$i++) {?>
	<option value="<?php echo ($thisYear + $i);?>" <?php if ($getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
	<?php }?>
	</select> for 
	<font face="Verdana" size="1" color="#000000">Price:<b>$</b><input type="text" name="price" size="8" value="<?php echo $rowGetAd->PRICE;?>">Do <b>NOT</b> include cents.<br>	
		<b>NO FEE :</b><input type="checkbox" name="nofee" value="1" <?php if ($rowGetAd->NOFEE) { echo " checked "; } ?> ><br>
		Display Personal Signature? No<input type="radio" name="use_user_sig" value="0" checked > &nbsp;
		Yes<input type="radio" name="use_user_sig" value="1" <?php if ($rowGetAd->USE_USER_SIG) {echo " checked "; } ?>><br>

		<input type="submit" value="Save"><hr>
		<hr>
		<table>
		<tr>
		<td align="right" colspan="1">Landlord:</td>
		<td colspan="5"><select name="landlord">
		<option value="--">--</option>
		<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
		<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if ($rowGetAd->LANDLORD==$rowGetLandlord->LID) { echo " selected "; } ?>><?php echo $rowGetLandlord->SHORT_NAME;?></option>
		<?php } ?>
		</select></td>
		</tr>
		<tr>
		<td colspan="6">Address:</td>
		</tr>
		<tr>
		<td align="right">Street</td>
		<td><input type="text" name="street" size="14" value="<?php echo $rowGetAd->STREET;?>"></td>
		<td align="right">Apt</td>
		<td colspan="3"><input type="text" name="apt" size="4" value="<?php echo $rowGetAd->APT;?>"></td>
		</tr>
		<tr>
		<td align="right">City</td>
		<td><input type="text" name="city" size="12" value="<?php echo $rowGetAd->CITY;?>"></td>
		<td align="right">State</td>
		<td><input type="text" name="state" size="3" value="<?php echo $rowGetAd->STATE;?>"></td>
		<td align="right">Zip</td>
		<td><input type="text" name="zip" size="5" value="<?php echo $rowGetAd->ZIP;?>"></td>
		</tr>
		</table>
		<?php if ($isAdmin) { ?>
			<hr>
			Change Agent: <select name="own_uid">
			<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) { ?>
			<option value="<?php echo $rowGetUsers->UID;?>" <?php if ($rowGetAd->UID==$rowGetUsers->UID) { echo "selected "; }?>><?php echo $rowGetUsers->HANDLE; ?></option>
			<?php } ?> 
			</select>
		<?php } ?>
		</form>


<!--END popup_edit -->