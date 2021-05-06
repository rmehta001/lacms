<!-- BEGIN compose -->

	<br>
		
	<form action="<?php echo "$PHP_SELF?op=add";?>" method="POST">
	<input type="hidden" name="nofee" value="0">
		
		
	<table border="0" cellspacing="0" cellpadding="0">
	
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
	<!--top row -->
			<table>
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltextimp"><font color="#993300">Type:</font></div><select name="type"><?php while ($rowTypes=mysqli_fetch_object($quTypes)) {	?>
				<option value="<?php echo $rowTypes->TYPE;?>" <?php if ($rowGetAd->TYPE==$rowTypes->TYPE) {
					echo " selected"; }?> >
				<?php echo $rowTypes->TYPENAME; ?></option>
			<?php }	?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltextimp"><font color="#993300">Location:</font></div><select name='loc'>
			<option value="--">Please Choose a Location</option>
			<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>
				<option value="<?php echo $rowLocs->LOCID; ?>" <?php if ($rowGetAd->LOC==$rowLocs->LOCID) {echo " selected"; }?> >
				<?php echo $rowLocs->LOCNAME; ?></option>
			<?php }	?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Bedrooms</div><select name="rooms">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) {  
					$selected = ($rowGetAd->ROOMS==$key) ? " selected " : ""; ?>
					<option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $roomsValue;?></option>
				<?php } ?>	
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Bathrooms:</div><select name="bath">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bkey => $bathValue) { 
					$selected = ($rowGetAd->BATH==$bkey) ? " selected " : "";?>
				<option value="<?php echo $bkey;?>" <?php echo $selected;?>><?php echo $bathValue;?></option>
				<?php } ?>	
			</select></td>
			
			
			</tr>
			</table>
	<!--end top row -->
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">
	<!--ad body row -->
			<table>
			<tr>
			<td valign="top" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td> 
			<td colspan="9" bgcolor="#FFFF99" align="center" valign="middle"><br><textarea name="body" cols=50 rows=6 ><?php echo $_POST['body'];?></textarea><br></td>
			<td valign="top" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td> 
			</tr>
			</table>
	<!--end ad body row -->
	</td>		
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">
	<!--avail & price row -->
			<table>
			<tr>
			<td colspan="11" bgcolor="#FFFF99" align="center" valign="middle"><div class="controltext">Availability & Price:</div></td>
			</tr>
			<?php 
			$getMon = subStr ($rowGetAd->AVAIL, 5, 2);
			$getDay = subStr ($rowGetAd->AVAIL, 8, 2);
			$getYear = subStr ($rowGetAd->AVAIL, 0, 4);
			?>
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Month:</div><select name="aMonth">
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
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Day</div><select name="aDay"> 
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
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Year</div><select name="aYear">
				<option value="--">--</option>
				<?php 
				$thisYear = date ("Y") - 1;
				for ($i=0;$i<=4;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Price:<b>$</b></div><input type="text" name="price" size="8" value="<?php echo $rowGetAd->PRICE;?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<?php if ($rowGetAd->TYPE==2) { ?>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Flag:</div><select name="status_sale">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['STATUS_SALE'] as $sskey => $ssValue) { 
						$selected = ($rowGetAd->STATUS_SALE==$sskey) ? " selected " : "";?>
						<option value="<?php echo $sskey;?>" <?php echo $selected;?>><?php echo $ssValue;?></option>
					<?php } ?>
			</select></td> 
			<?php }else { ?>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Fee:</div><select name="nofee">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['NOFEE'] as $fkey => $fValue) { 
						$selected = ($rowGetAd->NOFEE==$fkey) ? " selected " : "";?>
						<option value="<?php echo $fkey;?>" <?php echo $selected;?>><?php echo $fValue;?></option>
					<?php } ?>
			</select></td>
			<?php }?>
			</tr>
			</table>
	<!--end avail & price row -->
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">
	<!--pers sig -->
		<table>
			<tr>
			<td colspan="11" bgcolor="#FFFF99" align="center" valign="middle"><div class="controltext">Display Personal Signature? <br>No<input type="radio" name="use_user_sig" value="0" checked > Yes<input type="radio" name="use_user_sig" value="1" <?php if ($rowGetAd->USE_USER_SIG) {echo " checked "; } ?>></div></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td colspan="11" bgcolor="#FFFF99" align="center" valign="middle"><div class="controltext">Pets:</div><select name="PETSA">
			<option value="--">--</option>
			<?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petkey => $petVal) { ?>
			<option value="<?php echo $petkey;?>" <?php if ($rowGetAd->PETSA==$petkey) { echo " selected "; }?>><?php echo $petVal;?></option>
			<?php }?>
			</select></td>
			</tr>
			</table>
	<!--end pers sig -->
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">
	<!--landlord & address row-->
			<table>
			<tr>
			<td colspan="11" bgcolor="#FFFF99" align="center" valign="middle"><div class="controltext">Information not displayed in ad:</div></td>
			</tr>
			<tr>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Landlord:<select name="landlord">
				<option value="--">--</option>
				<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
				<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if ($rowGetAd->LANDLORD==$rowGetLandlord->LID) { echo " selected "; } ?>><?php echo $rowGetLandlord->SHORT_NAME;?></option>
				<?php } ?>
			</select></td>
			<td height="30" align="right" width="110" bgcolor="#FFFF99"><div class="controltext">Street Number:</div><input type="text" name="street_num" size="4" value="<?php echo $rowGetAd->STREET_NUM;?>"></td>
			<td height="30" width="110" bgcolor="#FFFF99"><div class="controltext">Street Address:</div><input type="text" name="street" size="24" value="<?php echo $rowGetAd->STREET;?>"></td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Apt:</div><input type="text" name="apt" size="4" value="<?php echo $rowGetAd->APT;?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Floor:</div><input type="text" name="floor" size="4" value="<?php echo $rowGetAd->FLOOR;?>"></td>
			<?php if ($isAdmin) { ?>
			<td height="30" width="110" bgcolor="#FFFF99"><div class="controltext">Change Agent:<select name="own_uid">
				<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) { ?>
				<option value="<?php echo $rowGetUsers->UID;?>" <?php if ($rowGetAd->UID==$rowGetUsers->UID) { echo "selected "; }?>><?php echo $rowGetUsers->HANDLE; ?></option>
				<?php } ?> 
				</select></td>
			<?php } ?>
			</tr>
			</table>
			<!--end landlord & address row-->
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">
			<!--save row-->
			<table>
			<tr>
			<td align="center" height="30" width="110" bgcolor="#FFFF99"><?php if ($user_level>0) {?><input type="submit" value="Save"><<?php }?></td>
			</tr>
			</table>
	<!--end save row-->
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	</form>
		
		
	<br>
<!--END compose -->