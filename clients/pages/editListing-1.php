<!--BEGIN editListing -->
	
	<?php
	$avail = ($rowGetAd->AVAIL=="0000-00-00") ? "" : "$rowGetAd->AVAIL";
	$availb = ($rowGetAd->AVAILB) ? "Yes" : "No";
	$status = ($rowGetAd->STATUS=="ACT") ? "Active" : "Inactive";
	$price = ($rowGetAd->PRICE) ? "$" . number_format ($rowGetAd->PRICE) : "";
	?>
	
	<!--FOLDER TABS -->
	<?php include ("folderTabs.php"); ?>
	<!--END FOLDER TABS -->
	
	
	
	
	
		<div class="controltext">
		Created by : <?php echo "$rowGetAd->HANDLE";?> <br>
		Created On: <?php echo "$rowGetAd->DATEIN";?> <br>
		Last Modifed on : <?php echo "$rowGetAd->MOD";?><br>
		Status : <?php if ($rowGetAd->STATUS=="ACT") {
				echo "Active";
			}else {
				echo "Inactive";
			} ?>
			
		<br>
		<br>
	<?php if ($rowGetAd->LANDLORD) {?>
	
	<div class="ad" align="left">
	<blockquote>
	<?php echo display_landlord($rowGetAd);?>
	</blockqoute>
	</div>
	<?php }?>
	
	<br>
	<a href="<?php echo "$PHP_SELF?op=return_page_op";?>"><img border="0" width="89" height="26" hspace="0" vspace="0" src="../assets/images/return.jpg"></a>
	<br>
	<div style="width:560; text-align:left; height:10;"><a href="<?php echo "$PHP_SELF?op=hot_list_add&item_type=1&item_id=$cid&return_page=$op&return_page_rid=$cid";?>"><img border="0" hspace="0" vspace="0" width="96" height="23" src="../assets/images/addToHotList.jpg"></a></div>
	<form action="<?php echo "$PHP_SELF?op=editListingDo";?>" method="POST">
	<input type="hidden" name="cid" value="<?php echo $cid;?>">
	<div class="conArea" style="width:560;">
		<table>
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Landlord:<select name="LANDLORD">
				<option value="--">--</option>
				<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
				<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if ($rowGetAd->LANDLORD==$rowGetLandlord->LID) { echo " selected "; } ?>><?php echo $rowGetLandlord->SHORT_NAME;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltextimp"><font color="#993300">Type:</font></div><select name="TYPE"><?php while ($rowTypes=mysqli_fetch_object($quTypes)) {	?>
				<option value="<?php echo $rowTypes->TYPE;?>" <?php if ($rowGetAd->TYPE==$rowTypes->TYPE) {
					echo " selected"; }?> >
				<?php echo $rowTypes->TYPENAME; ?></option>
			<?php }	?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltextimp"><font color="#993300">Location:</font></div><select name='LOC'><?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>
				<option value="<?php echo $rowLocs->LOCID; ?>" <?php if ($rowGetAd->LOC==$rowLocs->LOCID) {echo " selected"; }?> >
				<?php echo $rowLocs->LOCNAME; ?></option>
			<?php }	?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			</tr>
			<tr>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Bedrooms</div><select name="ROOMS">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) {  
					$selected = ($rowGetAd->ROOMS==$key) ? " selected " : ""; ?>
					<option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $roomsValue;?></option>
				<?php } ?>	
			</select></td>
			<td height="30" colspan="1"width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Bathrooms:</div><select name="BATH">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bkey => $bathValue) { 
					$selected = ($rowGetAd->BATH==$bkey) ? " selected " : "";?>
				<option value="<?php echo $bkey;?>" <?php echo $selected;?>><?php echo $bathValue;?></option>
				<?php } ?>	
			</select></td>
			<td colspan="3" bgcolor="#FFFF99" align="center" valign="middle"><div class="controltext">Total Number of Rooms:<input type="text" size="5" name="TOTAL_NUM_ROOMS" value="<?php echo $rowGetAd->TOTAL_NUM_ROOMS;?>"></td>
			</tr>
			<tr>
			
			<td height="30" width="1" bgcolor="#FFFF99"><table>
				<tr>
				<td><div class="controlText">Heating:</div> <select name="HEATING_RESP">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HEATING_RESP'] as $hskey => $hsValue) { 
						$selected = ($rowGetAd->HEATING_RESP==$hskey) ? " selected " : "";?>
						<option value="<?php echo $hskey;?>" <?php echo $selected;?>><?php echo $hsValue;?></option>
					<?php } ?>
			</select></td>
				<td><div class="controlText">Type:</div><select name="HEATING_TYPE">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HEATING_TYPE'] as $htkey => $htValue) { 
						$selected = ($rowGetAd->HEATING_TYPE==$htkey) ? " selected " : "";?>
						<option value="<?php echo $htkey;?>" <?php echo $selected;?>><?php echo $htValue;?></option>
					<?php } ?>
			</select></td>
				</tr>
				<tr>
				 <td><div class="controlText">Hot Water:</div> <select name="HOT_WATER_RESP">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HOT_WATER_RESP'] as $hwkey => $hwValue) { 
						$selected = ($rowGetAd->HOT_WATER_RESP==$hwkey) ? " selected " : "";?>
						<option value="<?php echo $hwkey;?>" <?php echo $selected;?>><?php echo $hwValue;?></option>
					<?php } ?>
			</select></td>
				<td><div class="controlText">Type:</div><select name="HOT_WATER_TYPE">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HOT_WATER_TYPE'] as $hwkey => $hwValue) { 
						$selected = ($rowGetAd->HOT_WATER_TYPE==$hwkey) ? " selected " : "";?>
						<option value="<?php echo $hwkey;?>" <?php echo $selected;?>><?php echo $hwValue;?></option>
					<?php } ?>
			</select></td>
				</tr></table></td>			
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td colspan="1" bgcolor="#FFFF99" align="center" valign="middle"><div class="controltext">Colleges:</div><select name="SCHOOL">
			<option value="--">--</option>
			<?php foreach ($DEFINED_VALUE_SETS['SCHOOL'] as $schkey => $schVal) { ?>
			<option value="<?php echo $schkey;?>" <?php if ($rowGetAd->SCHOOL==$schkey) { echo " selected "; }?>><?php echo $schVal;?></option>
			<?php }?>
			</select></td>
		</tr>
		</table>
	</div>
	<div class="conArea" style="width:560;">
		<table>
		<tr>
			<td height="30" align="center" bgcolor="#FFFF99"><input type="submit" value="Save"></td>
		</tr>
		</table>
	</div>
	<div class="conArea" style="width:560;">
		<table>
			<tr>
			<td colspan="18" bgcolor="#FFFF99" align="center" valign="middle"><div class="controltext">Availability, Price & Address:</div></td>
			</tr>
			<?php 
			$getMon = subStr ($rowGetAd->AVAIL, 5, 2);
			$getDay = subStr ($rowGetAd->AVAIL, 8, 2);
			$getYear = subStr ($rowGetAd->AVAIL, 0, 4);
			?>
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Month:</div><select name="bbbMonth">
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
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Day</div><select name="bbbDay"> 
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
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Year</div><select name="bbbYear">
				<option value="--">--</option>
				<?php 
				$thisYear = date ("Y") - 1;
				for ($i=0;$i<=4;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Price:<b>$</b></div><input type="text" name="PRICE" size="8" value="<?php echo $rowGetAd->PRICE;?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30"  bgcolor="#FFFF99"><div class="controltext">Price negotiable: No <input type="radio" value="0" name="PRICE_NEG" <?php if (!$rowGetAd->PRICE_NEG) { echo "checked"; }?> > Yes <input type="radio" value="1" name="PRICE_NEG" <?php if ($rowGetAd->PRICE_NEG) { echo "checked"; }?> ></td>
			</tr>
			</table>
			<table>
			<tr>
			<td height="30" colspan="3" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" align="right" width="110" bgcolor="#FFFF99"><div class="controltext">Street Number:</div><input type="text" name="STREET_NUM" size="4" value="<?php echo $rowGetAd->STREET_NUM;?>"></td>
			<td height="30" width="110" bgcolor="#FFFF99"><div class="controltext">Street Address:</div><input type="text" name="STREET" size="24" value="<?php echo $rowGetAd->STREET;?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Apt:</div><input type="text" name="APT" size="4" value="<?php echo $rowGetAd->APT;?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Floor:</div><input type="text" name="FLOOR" size="4" value="<?php echo $rowGetAd->FLOOR;?>"></td>
			</tr>
			</table>
	</div>
	
	<div class="conArea" style="width:560;">
		<table>
			<tr>
			<td colspan="10" align="center" height="30" bgcolor="#FFFF99"><div class="controltext">Fee and Status:</div></td>
			</tr>
			<tr>
			<?php if ($rowGetAd->TYPE==2) { ?>
			<td height="30" width="20" bgcolor="#FFFF99"><select name="STATUS_SALE">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['STATUS_SALE'] as $sskey => $ssValue) { 
						$selected = ($rowGetAd->STATUS_SALE==$sskey) ? " selected " : "";?>
						<option value="<?php echo $sskey;?>" <?php echo $selected;?>><?php echo $ssValue;?></option>
					<?php } ?>
			</select></td> 
			<?php }else { ?>
			<td height="30" width="20" bgcolor="#FFFF99"><select name="NOFEE">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['NOFEE'] as $fkey => $fValue) { 
						$selected = ($rowGetAd->NOFEE==$fkey) ? " selected " : "";?>
						<option value="<?php echo $fkey;?>" <?php echo $selected;?>><?php echo $fValue;?></option>
					<?php } ?>
			</select></td>
			<?php }?>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Advertising:<input type="hidden" name="STATUS" value="STO"><input type="checkbox" value="ACT" name="STATUS" <?php if ($rowGetAd->STATUS=="ACT") { echo " checked "; } ?>> Vacancy: <input type="hidden" name="VACANT" value="0"><input type="checkbox" value="1" name="VACANT" <?php if ($rowGetAd->VACANT) { echo " checked "; } ?>> Available: <input type="hidden" name="STATUS_ACTIVE" value="0"><input type="checkbox" value="1" name="STATUS_ACTIVE" <?php if ($rowGetAd->STATUS_ACTIVE) { echo " checked "; } ?>></td>
			</tr>
			</table>
	</div>
	
	<div class="conArea" style="width:560;">
		<table>
			<tr>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Listing type:<select name="LISTING_TYPE">
						<option value="--">--</option>
						<?php foreach ($DEFINED_VALUE_SETS['LISTING_TYPE'] as $lskey => $lsVal) { ?>
						<option value="<?php echo $lskey;?>" <?php if ($rowGetAd->LISTING_TYPE==$lskey) { echo " selected "; } ?> ><?php echo $lsVal;?></option>
						<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Lease type:<select name="LEASE_TYPE">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['LEASE_TYPE'] as $lkey => $lVal) { ?>
					<option value="<?php echo $lkey;?>" <?php if ($rowGetAd->LEASE_TYPE==$lkey) { echo " selected "; }?> > <?php echo $lVal;?></option>
					<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" valign="bottom" bgcolor="#FFFF99"><div class="controltext">Terms (months):<input type="text" size="3" name="TERMS" value="<?php echo $rowGetAd->TERMS;?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30"   bgcolor="#FFFF99"><div class="controltext">Tax Clause:</div><select name="TAX_CLAUSE">
				<option value=="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['TAX_CLAUSE'] as $taxKey => $taxVal) {?>
					<option value="<?php echo $taxKey;?>" <?php if ($rowGetAd->TAX_CLAUSE==$taxKey) { echo " selected "; }?>><?php echo $taxVal;?></option>
				<?php }?>
				</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			
		</tr>
		</table>
	</div>
	
	<div class="conArea" style="width:560;">
		<table>
		<tr>
		<td valign="top">
		<table>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext"><strong>Fee:</strong></div></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Tenant Fee:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99">$<input type="text" size="5" name="TENANT_FEE" value="<?php echo $rowGetAd->TENANT_FEE;?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Landlord Fee:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99">$<input type="text" size="5" name="LANDLORD_FEE" value="<?php echo $rowGetAd->LANDLORD_FEE;?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">First:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99">$<input type="text" size="5" name="PAYMENT_FIRST" value="<?php echo $rowGetAd->PAYMENT_FIRST;?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Last:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99">$<input type="text" name="PAYMENT_LAST" size="5" value="<?php echo $rowGetAd->PAYMENT_LAST;?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Security:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99">$<input type="text" size="5" name="PAYMENT_SEC" value="<?php echo $rowGetAd->PAYMENT_SEC;?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Key Deposit:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99">$<input type="text" name="KEY_DEPOSIT" size="5" value="<?php echo $rowGetAd->KEY_DEPOSIT;?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Cleaning Deposit:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99">$<input type="text" name="CLEAN_DEPOSIT" size="5" value="<?php echo $rowGetAd->CLEAN_DEPOSIT;?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Fee Comments:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99"><input type="text" name="FEE_COMMENTS" value="<?php echo $rowGetAd->FEE_COMMENTS;?>"></td>
			</tr>
			</table>
		</td>
		<td width="10">&nbsp;</td>
		<td valign="top" height="100%" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td valign="top">
			<table>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext"><strong>Parking:</strong></div></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Number of spaces:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99"><select name="PARKING_NUM">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['PARKING_NUM'] as $pknkey => $pknValue) { 
						$selected = ($rowGetAd->PARKING_NUM==$pknkey) ? " selected " : "";?>
						<option value="<?php echo $pknkey;?>" <?php echo $selected;?>><?php echo $pknValue;?></option>
					<?php } ?>
			</select></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Type:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99"><select name="PARKING_TYPE">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['PARKING_TYPE'] as $parkkey => $parkVal) { ?>
					<option value="<?php echo $parkkey;?>" <?php if ($rowGetAd->PARKING_TYPE==$parkkey) { echo " selected "; }?> > <?php echo $parkVal;?> </option>
				<?php } ?>
			</select></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Cost per Space:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99">$<input type="text" name="PARKING_COST" size="5" value="<?php echo $rowGetAd->PARKING_COST;?>"></td>
			</tr>
			
			<tr>
			<td valign="top" height="100%" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
			</tr>
			<tr>
			<td bgcolor="#FFFF99" align="left" valign="bottom"><div class="controltext"><strong>Pets:</strong></div><select name="PETSA">
			<option value="--">--</option>
			<?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petkey => $petVal) { ?>
			<option value="<?php echo $petkey;?>" <?php if ($rowGetAd->PETSA==$petkey) { echo " selected "; }?>><?php echo $petVal;?></option>
			<?php }?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			</tr>
			</table>
		</td>
		</tr>
		</table>
	</div>
	
	<div class="conArea" style="width:560;">	
		<table>
			<tr>
			<input type="hidden" name="AUTO_WRITE" value="0">
			<td colspan="10" align="right" height="30" bgcolor="#FFFF99"><div class="controltext">Automatically List Features and Amenities in advertisement?</div></td>
			<td colspan="10" align="left" height="30" bgcolor="#FFFF99"><input type="checkbox" name="AUTO_WRITE" value="1" <?php if($rowGetAd->AUTO_WRITE) { echo " checked "; } ?>></td>
			</tr>
			<tr>
			<td colspan="10" height="30" bgcolor="#FFFF99"><div class="controltext"><strong>Features:</strong></div></td>
			</tr>
			<tr>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_DELEADED" value="0">
				<tr><td align="right" class="controltext">Deleaded</td><td align="left"><input type="checkbox" name="FEATURES_DELEADED" value="1" <?php if ($rowGetAd->FEATURES_DELEADED) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_FURNISHED" value="0">
				<tr><td align="right" class="controltext">Furnished</td><td align="left"><input type="checkbox" name="FEATURES_FURNISHED" value="1" <?php if ($rowGetAd->FEATURES_FURNISHED) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_NON_SMOKING" value="0">
				<tr><td align="right" class="controltext">Non-smoking</td><td align="left"><input type="checkbox" name="FEATURES_NON_SMOKING" value="1" <?php if ($rowGetAd->FEATURES_NON_SMOKING) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_ALARM" value="0">
				<tr><td align="right" class="controltext">Alarm</td><td align="left"><input type="checkbox" name="FEATURES_ALARM" value="1" <?php if ($rowGetAd->FEATURES_ALARM) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_HIGH_CEILINGS" value="0">
				<tr><td align="right" class="controltext">High Ceilings </td><td align="left"><input type="checkbox" name="AMENITIES_HIGH_CEILINGS" value="1" <?php if ($rowGetAd->AMENITIES_HIGH_CEILINGS ) { echo "checked"; } ?> ></td></tr>

				<input type="hidden" name="FEATURES_CENTRAL_AC" value="0">
				<tr><td align="right" class="controltext">Central AC </td><td align="left"><input type="checkbox" name="FEATURES_CENTRAL_AC" value="1" <?php if ($rowGetAd->FEATURES_CENTRAL_AC) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_AC" value="0">
				<tr><td align="right" class="controltext">AC </td><td align="left"><input type="checkbox" name="FEATURES_AC" value="1" <?php if ($rowGetAd->FEATURES_AC) { echo "checked"; } ?> ></td></tr>






				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_HOT_WATER" value="0">
				<tr><td align="right" class="controltext">Hot Water</td><td align="left"><input type="checkbox" name="FEATURES_HOT_WATER" value="1" <?php if ($rowGetAd->FEATURES_HOT_WATER) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_HT_AND_HW" value="0">
				<tr><td align="right" class="controltext">Heat & Hot Water</td><td align="left"><input type="checkbox" name="FEATURES_HT_AND_HW" value="1" <?php if ($rowGetAd->FEATURES_HT_AND_HW ) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_ALL_UTILITIES" value="0">
				<tr><td align="right" class="controltext">All Utilities</td><td align="left"><input type="checkbox" name="FEATURES_ALL_UTILITIES" value="1" <?php if ($rowGetAd->FEATURES_ALL_UTILITIES) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_INTERNET" value="0">
				<tr><td align="right" class="controltext">High Speed Internet</td><td align="left"><input type="checkbox" name="FEATURES_INTERNET" value="1" <?php if ($rowGetAd->FEATURES_INTERNET) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_WALK_IN_CLOSET" value="0">
				<tr><td align="right" class="controltext">Walk-in Closet </td><td align="left"><input type="checkbox" name="FEATURES_WALK_IN_CLOSET" value="1" <?php if ($rowGetAd->FEATURES_WALK_IN_CLOSET ) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_DINNING_ROOM" value="0">
				<tr><td align="right" class="controltext">Dining Room </td><td align="left"><input type="checkbox" name="FEATURES_DINNING_ROOM" value="1" <?if ($rowGetAd->FEATURES_DINNING_ROOM) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_MODERN_BATH" value="0">
				<tr><td align="right" class="controltext">Modern Bath </td><td align="left"><input type="checkbox" name="FEATURES_MODERN_BATH" value="1" <?if ($rowGetAd->FEATURES_MODERN_BATH) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_FIREPLACE_WORKING" value="0">
				<tr><td align="right" class="controltext">Working Fireplace</td><td align="left"><input type="checkbox" name="FEATURES_FIREPLACE_WORKING" value="1" <?php if ($rowGetAd->FEATURES_FIREPLACE_WORKING) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_FIREPLACE_DECOR" value="0">
				<tr><td align="right" class="controltext">Decorative Fireplace</td><td align="left"><input type="checkbox" name="FEATURES_FIREPLACE_DECOR" value="1" <?php if ($rowGetAd->FEATURES_FIREPLACE_DECOR) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_CARPET" value="0">
				<tr><td align="right" class="controltext">Carpet</td><td align="left"><input type="checkbox" name="FEATURES_CARPET" value="1" <?php if ($rowGetAd->FEATURES_CARPET) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name=" FEATURES_MODERN_KITCHEN" value="0">
				<tr><td align="right" class="controltext">Galley Kitchen</td><td align="left"><input type="checkbox" name=" FEATURES_MODERN_KITCHEN" value="1" <?php if ($rowGetAd-> FEATURES_MODERN_KITCHEN) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_KITCHENETTE" value="0">
				<tr><td align="right" class="controltext">Kitchenette </td><td align="left"><input type="checkbox" name="FEATURES_KITCHENETTE" value="1" <?php if ($rowGetAd->FEATURES_KITCHENETTE) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_EAT_IN_KITCHEN" value="0">
				<tr><td align="right" class="controltext">Eat-in-Kitchen </td><td align="left"><input type="checkbox" name="FEATURES_EAT_IN_KITCHEN" value="1" <?php if ($rowGetAd->FEATURES_EAT_IN_KITCHEN) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_MICROWAVE" value="0">
				<tr><td align="right" class="controltext">Microwave </td><td align="left"><input type="checkbox" name="FEATURES_MICROWAVE" value="1" <?php if ($rowGetAd->FEATURES_MICROWAVE) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_PANTRY" value="0">
				<tr><td align="right" class="controltext">Pantry</td><td align="left"><input type="checkbox" name="FEATURES_PANTRY" value="1" <?php if ($rowGetAd->FEATURES_PANTRY) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_GAS_RANGE" value="0">
				<tr><td align="right" class="controltext">Gas Range</td><td align="left"><input type="checkbox" name="FEATURES_GAS_RANGE" value="1" <?php if ($rowGetAd->FEATURES_GAS_RANGE) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_ELEC_RANGE" value="0">
				<tr><td align="right" class="controltext">Electric Range </td><td align="left"><input type="checkbox" name="FEATURES_ELEC_RANGE" value="1" <?php if ($rowGetAd->FEATURES_ELEC_RANGE) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_DISPOSAL" value="0">
				<tr><td align="right" class="controltext">Disposal </td><td align="left"><input type="checkbox" name="FEATURES_DISPOSAL" value="1" <?php if ($rowGetAd->FEATURES_DISPOSAL) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_DISHWASHER" value="0">
				<tr><td align="right" class="controltext">Dishwasher </td><td align="left"><input type="checkbox" name="FEATURES_DISHWASHER" value="1" <?php if ($rowGetAd->FEATURES_DISHWASHER) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_SKYLIGHT" value="0">
				<tr><td align="right" class="controltext">Skylight </td><td align="left"><input type="checkbox" name="FEATURES_SKYLIGHT" value="1" <?php if ($rowGetAd->FEATURES_SKYLIGHT) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_HWFI" value="0">
				<tr><td align="right" class="controltext">Hardwood Floors</td><td align="left"><input type="checkbox" name="FEATURES_HWFI" value="1" <?php if ($rowGetAd->FEATURES_HWFI) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_BALCONY" value="0">
				<tr><td align="right" class="controltext">Balcony </td><td align="left"><input type="checkbox" name="FEATURES_BALCONY" value="1" <?php if ($rowGetAd->FEATURES_BALCONY) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_PATIO" value="0">
				<tr><td align="right" class="controltext">Patio </td><td align="left"><input type="checkbox" name="FEATURES_PATIO" value="1" <?php if ($rowGetAd->FEATURES_PATIO) { echo "checked"; } ?> ></td></tr>

				<input type="hidden" name="FEATURES_PORCH" value="0">
				<tr><td align="right" class="controltext">Porch </td><td align="left"><input type="checkbox" name="FEATURES_PORCH" value="1" <?php if ($rowGetAd->FEATURES_PORCH) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_ENCLOSED_PORCH" value="0">
				<tr><td align="right" class="controltext">Enclosed Porch</td><td align="left"><input type="checkbox" name="FEATURES_ENCLOSED_PORCH" value="1" <?php if ($rowGetAd->FEATURES_ENCLOSED_PORCH) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_DECK" value="0">
				<tr><td align="right" class="controltext">Deck </td><td align="left"><input type="checkbox" name="FEATURES_DECK" value="1" <?if ($rowGetAd->FEATURES_DECK) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_DUPLEX" value="0">
				<tr><td align="right" class="controltext">Duplex </td><td align="left"><input type="checkbox" name="FEATURES_DUPLEX" value="1" <?if ($rowGetAd->FEATURES_DUPLEX) { echo "checked"; } ?> ></td></tr>
				
				</table>
			</td>
			</tr>
			</table>
	</div>
	
	<div class="conArea" style="width:560;">
		<table>
			<tr>
			<td colspan="10" height="30" bgcolor="#FFFF99"><div class="controltext"><strong>Amenities:</strong></div></td>
			</tr>
			<tr>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="AMENITIES_CONCIEARGE" value="0">
				<tr><td align="right" class="controltext">Concierge </td><td align="left"><input type="checkbox" name="AMENITIES_CONCIEARGE" value="1" <?php if ($rowGetAd->AMENITIES_CONCIEARGE) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_SECURITY" value="0">
				<tr><td align="right" class="controltext">Security </td><td align="left"><input type="checkbox" name="AMENITIES_SECURITY" value="1" <?php if ($rowGetAd->AMENITIES_SECURITY) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_SUPERINTENDANT" value="0">
				<tr><td align="right" class="controltext">Superintendent </td><td align="left"><input type="checkbox" name="AMENITIES_SUPERINTENDANT" value="1" <?php if ($rowGetAd->AMENITIES_SUPERINTENDANT) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_ON_SITE_MANAGEMENT" value="0">
				<tr><td align="right" class="controltext">On Site Management </td><td align="left"><input type="checkbox" name="AMENITIES_ON_SITE_MANAGEMENT" value="1" <?php if ($rowGetAd->AMENITIES_ON_SITE_MANAGEMENT) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="AMENITIES_ROOF_DECK" value="0">
				<tr><td align="right" class="controltext">Roof Deck </td><td align="left"><input type="checkbox" name="AMENITIES_ROOF_DECK" value="1" <?php if ($rowGetAd->AMENITIES_ROOF_DECK) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_GARDEN" value="0">
				<tr><td align="right" class="controltext">Garden </td><td align="left"><input type="checkbox" name="AMENITIES_GARDEN" value="1" <?php if ($rowGetAd->AMENITIES_GARDEN) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_YARD" value="0">
				<tr><td align="right" class="controltext">Yard </td><td align="left"><input type="checkbox" name="AMENITIES_YARD" value="1" <?php if ($rowGetAd->AMENITIES_YARD) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_ELEVATOR" value="0">
				<tr><td align="right" class="controltext">Elevator </td><td align="left"><input type="checkbox" name="AMENITIES_ELEVATOR" value="1" <?php if ($rowGetAd->AMENITIES_ELEVATOR) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="AMENITIES_HEALTH_CLUB" value="0">
				<tr><td align="right" class="controltext">Health Club </td><td align="left"><input type="checkbox" name="AMENITIES_HEALTH_CLUB" value="1" <?php if ($rowGetAd->AMENITIES_HEALTH_CLUB) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_POOL" value="0">
				<tr><td align="right" class="controltext">Pool </td><td align="left"><input type="checkbox" name="AMENITIES_POOL" value="1" <?php if ($rowGetAd->AMENITIES_POOL ) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_TENNIS" value="0">
				<tr><td align="right" class="controltext">Tennis </td><td align="left"><input type="checkbox" name="AMENITIES_TENNIS" value="1" <?php if ($rowGetAd->AMENITIES_TENNIS) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_LOUNGE" value="0">
				<tr><td align="right" class="controltext">Lounge </td><td align="left"><input type="checkbox" name="AMENITIES_LOUNGE" value="1" <?php if ($rowGetAd->AMENITIES_LOUNGE) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>
			<td  valign="top">
				<table border="0">
				<input type="hidden" name="AMENITIES_SAUNA" value="0">
				<tr><td align="right" class="controltext">Sauna </td><td align="left"><input type="checkbox" name="AMENITIES_SAUNA" value="1" <?php if ($rowGetAd->AMENITIES_SAUNA) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_ATTIC" value="0"> 
				<tr><td align="right" class="controltext">Storage in Attic</td><td align="left"> <input type="checkbox" name="AMENITIES_ATTIC" value="1" <?php if ($rowGetAd->AMENITIES_ATTIC) { echo "checked"; }?> > </td></tr>
				<input type="hidden" name="AMENITIES_BASEMENT" value="0"> 
				<tr><td align="right" class="controltext">Storage in Basement</td><td align="left"><input type="checkbox" name="AMENITIES_BASEMENT" value="1" <?php if ($rowGetAd->AMENITIES_BASEMENT) {echo "checked"; } ?> > </td></tr>
				<input type="hidden" name="AMENITIES_BIN" value="0"> 
				<tr><td align="right" class="controltext">Storage in Bin</td><td align="left"><input type="checkbox" name="AMENITIES_BIN" value="1" <?php if ($rowGetAd->AMENITIES_BIN) {echo "checked"; }?> ></td></tr>
				</table>
			</td>
			</tr>
			</table>
	</div>		
	
	<div class="conArea" style="width:560;">
		<table>
		<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Building Type:</div><select name="BUILDING_TYPE">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['BUILDING_TYPE'] as $btkey => $btVal) { ?>
					<option value="<?php echo $btkey;?>" <?php if ($rowGetAd->BUILDING_TYPE==$btkey) { echo " selected "; } ?> ><?php echo $btVal;?></option>
				<?php } ?>
			</select></td>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Building Style:</div><select name="BUILDING_STYLE">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['BUILDING_STYLE'] as $bskey => $bsVal) { ?>
					<option value="<?php echo $bskey;?>" <?php if ($rowGetAd->BUILDING_STYLE==$bskey) { echo " selected "; } ?> ><?php echo $bsVal;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30"  width="100" bgcolor="#FFFF99"><div class="controltext">Laundry</div><select name="LAUNDRY_ROOM">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['LAUNDRY_ROOM'] as $launkey => $launVal) {?>
					<option value="<?php echo $launkey; ?>" <?php if ($rowGetAd->LAUNDRY_ROOM==$launkey) { echo " selected "; }?> ><?php echo $launVal;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			</tr>
			</table>
	</div>
	
	<div class="conArea" style="width:560;">	
		<table>
		<tr>
			<td height="30"  colspan="10" align="center" bgcolor="#FFFF99"><div class="controltext"><strong>Misc:<strong></div></td>
		</tr>
		<tr>
			
			<td height="30"  bgcolor="#FFFF99"><div class="controltext">Show Instructions:</div><textarea name="SHOW_INSTRUCT" rows="3" cols="20"><?php echo $rowGetAd->SHOW_INSTRUCT;?></textarea></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30"  bgcolor="#FFFF99"><table border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td height="30" align="right" bgcolor="#FFFF99"><div class="controltext">Tenant Name:<input type="input" name="TENANT_NAME" value="<?php echo $rowGetAd->TENANT_NAME;?>"></td>
			</tr>
			<tr>
			<td height="30" align="right" bgcolor="#FFFF99"><div class="controltext">Phone:<input type="input" name="TENANT_PHONE" value="<?php echo $rowGetAd->TENANT_PHONE;?>" size="30">
			</tr>
			</table></td>
			
		</tr>
		</table>
	</div>
	
	<div class="conArea" style="width:560;">
		<table>
		<tr>
			<td height="30"  bgcolor="#FFFF99"><div class="controltext">Key Info:</div><select name="KEY_INFO">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['KEY_INFO'] as $keyKey => $keyVal) {?>
					<option value="<?php echo $keyKey;?>" <?php if ($rowGetAd->KEY_INFO==$keyKey) { echo " selected "; }?>><?php echo $keyVal;?></option>
				<?php } ?>
				</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Students:</div><select name="STUDENTS">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['STUDENTS'] as $studentKey => $studentVal) {?>
				<option value="<?php echo $studentKey;?>" <?php if ($rowGetAd->STUDENTS==$studentKey) { echo " selected ";}?>><?php echo $studentVal;?></option>
				<?php }?>
				</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Alarm Code:</div><input type="text" name="ALARM" value="<?php  echo $rowGetAd->ALARM;?>" ></td>
		</tr>
		</table>
	</div>
	
	<div class="conArea" style="width:560;">
		<table>
		<tr>
			<td height="30"  bgcolor="#FFFF99"><div class="controltext">Notes:</div><textarea name="LISTING_NOTES" rows="4" cols="40"><?php echo $rowGetAd->LISTING_NOTES;?></textarea></td>
		</tr>
		</table>
	</div>
	
	<div class="conArea" style="width:560;">
		<table>
		<?php 
			$getLEMon = subStr ($rowGetAd->LEASE_EXPIRE, 5, 2);
			$getLEDay = subStr ($rowGetAd->LEASE_EXPIRE, 8, 2);
			$getLEYear = subStr ($rowGetAd->LEASE_EXPIRE, 0, 4);
			?>
		<tr>
			<td height="30"  bgcolor="#FFFF99"><div class="controltext">Lease Expire:<br> Month:</div><select name="bbbLEMonth">
				<option value="--">--</option>                                                      
				<option value="01" <?php if ($getLEMon == "01") { echo " selected "; } ?>>Jan</option>
				<option value="02" <?php if ($getLEMon == "02") { echo " selected "; } ?>>Feb</option>
				<option value="03" <?php if ($getLEMon == "03") { echo " selected "; } ?>>Mar</option>
				<option value="04" <?php if ($getLEMon == "04") { echo " selected "; } ?>>Apr</option>
				<option value="05" <?php if ($getLEMon == "05") { echo " selected "; } ?>>May</option>
				<option value="06" <?php if ($getLEMon == "06") { echo " selected "; } ?>>Jun</option>
				<option value="07" <?php if ($getLEMon == "07") { echo " selected "; } ?>>Jul</option>
				<option value="08" <?php if ($getLEMon == "08") { echo " selected "; } ?>>Aug</option>
				<option value="09" <?php if ($getLEMon == "09") { echo " selected "; } ?>>Sep</option>
				<option value="10" <?php if ($getLEMon == "10") { echo " selected "; } ?>>Oct</option>
				<option value="11" <?php if ($getLEMon == "11") { echo " selected "; } ?>>Nov</option>
				<option value="12" <?php if ($getLEMon == "12") { echo " selected "; } ?>>Dec</option>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Day</div><select name="bbbLEDay"> 
				<option value="--">--</option>
				<?php for ($i=1;$i<=31;$i++) {
					if ($i<=9) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
				?>
				<option value="<?php echo $j;?>" <?php if ($getLEDay == $j) { echo " selected "; } ?>><?php echo $j;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Year</div><select name="bbbLEYear">
				<option value="--">--</option>
				<?php 
				$thisYear = date ("Y");
				for ($i=0;$i<=4;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($getLEYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Rented By:<select name="RENTED_BY">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['RENTED_BY'] as $rentedKey => $rentedVal) {?>
				<option value="<?php echo $rentedKey;?>" <?php if ($rowGetAd->RENTED_BY==$rentedKey) { echo " selected ";}?>><?php echo $rentedVal;?></option>
				<?php }?>
				</select></td>
			</tr>
			</table>
	</div>		
	
	<div class="conAreaBottom" style="width:560;">
		<table>
		<tr>
			<td height="30" align="center" bgcolor="#FFFF99"><input type="submit" value="Save"></td>
		</tr>
		</table>
	</div>
	
	</form>
	
	<br>
	<br>
	<br>
	<a href="<?php echo "$PHP_SELF?op=return_page_op";?>"><img border="0" width="89" height="26" hspace="0" vspace="0" src="../assets/images/return.jpg"></a>
	<br>
	<br>
	
	
	
	


<!--END editListing -->