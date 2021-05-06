<!--BEGIN editLandlord -->

	<br>
	<br>
	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="landlord" value="<?php echo $rowGetLandlord->LID;?>">
	<input type="submit" value="View Landlord's listings">
	</form>
	<form action="<?php echo "$PHP_SELF?op=editLandlordDo";?>" method="POST">
	<input type="hidden" name="lid" value="<?php echo $lid; ?>">	
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
		<table width="100%">
		<?php 
		$lc_year = substr ($rowGetLandlord->LAST_CONTACTED, 0, 4);
		$lc_month = substr ($rowGetLandlord->LAST_CONTACTED, 5,2);
		$lc_day = substr ($rowGetLandlord->LAST_CONTACTED, 8,2);
		?>
		
			<tr>
			<td align="left" bgcolor="#FFFF99"><div class="controltext">Last Contacted:</div><select name="lc_month">
						<option value="1" <?php if ($lc_month=='01') { echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($lc_month=='02') { echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($lc_month=='03') { echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($lc_month=='04') { echo "selected";}?>>April</option>
						<option value="5" <?php if ($lc_month=='05') { echo "selected";}?>>May</option>
						<option value="6" <?php if ($lc_month=='06') { echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($lc_month=='07') { echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($lc_month=='08') { echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($lc_month=='09') { echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($lc_month=='10') { echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($lc_month=='11') { echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($lc_month=='12') { echo "selected";}?>>Dec</option>
						</select> 
			<select name="lc_day">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($lc_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>
			<select name="lc_year">
						<?php for ($i=(date("Y")-4);$i<=date("Y");$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($lc_year==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>

</TD><TD>

		<?php 
		$nc_year = substr ($rowGetLandlord->NEXT_CONTACT, 0, 4);
		$nc_month = substr ($rowGetLandlord->NEXT_CONTACT, 5,2);
		$nc_day = substr ($rowGetLandlord->NEXT_CONTACT, 8,2);
		?>
		
<div class="controltext">Next Contact:</div><select name="nc_month">
						<option value="1" <?php if ($nc_month=='01') { echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($nc_month=='02') { echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($nc_month=='03') { echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($nc_month=='04') { echo "selected";}?>>April</option>
						<option value="5" <?php if ($nc_month=='05') { echo "selected";}?>>May</option>
						<option value="6" <?php if ($nc_month=='06') { echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($nc_month=='07') { echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($nc_month=='08') { echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($nc_month=='09') { echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($nc_month=='10') { echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($nc_month=='11') { echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($nc_month=='12') { echo "selected";}?>>Dec</option>
						</select> 
			<select name="nc_day">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($nc_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>
			<select name="nc_year">

<?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>

<option value="<?php echo $i+1;?>" <?php if ($nc_year==$i) { echo "selected";}?>>
<?php echo $i+1;?>
</option>

<option value="<?php echo $i;?>" <?php if ($nc_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

						<?php } ?>
						</select>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
<input type="submit" value="Save">

			</td>
			</tr>
			<tr>
			<td colspan="4" align="left" bgcolor="#FFFF99"><div class="controltext">Short Name:</div><input type="text" name="short_name" size="20" value="<?php echo $rowGetLandlord->SHORT_NAME;?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			</tr>
		</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
			<table width="100%">
			<tr>
			<td align="left" valign="top" bgcolor="#FFFF99">
				<table>
				<tr>
				<td colspan="20" height="30" align="center" width="20" bgcolor="#FFFF99"><div class="controltext">Personal</td>
				</tr>
				<tr>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">First Name:</div><input type="text" name="home_name_first" size="15" value="<?php echo $rowGetLandlord->HOME_NAME_FIRST;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Last Name:</div><input type="text" name="home_name_last" size="15" value="<?php echo $rowGetLandlord->HOME_NAME_LAST;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				</tr>
				<tr>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Street:</div><input type="text" name="home_street" size="25" value="<?php echo $rowGetLandlord->HOME_STREET;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">City:</div><input type="text" name="home_city" size="15" value="<?php echo $rowGetLandlord->HOME_CITY;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				</tr>
				<tr>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">State:</div><input type="text" name="home_state" size="3" value="<?php echo $rowGetLandlord->HOME_STATE;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">ZIP:</div><input type="text" name="home_zip" size="10" value="<?php echo $rowGetLandlord->HOME_ZIP;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				</tr>
				<tr>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Phone:</div><input type="text" name="home_phone" size="15" value="<?php echo $rowGetLandlord->HOME_PHONE;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Fax:</div><input type="text" name="home_fax" size="15" value="<?php echo $rowGetLandlord->HOME_FAX;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				</tr>
				<tr>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Mobile Phone:</div><input type="text" name="mobile_phone" size="15" value="<?php echo $rowGetLandlord->MOBILE_PHONE;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				</tr>
				</table>
				
			</td>
			<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
			<td align="right" valign="top"><table>
				<tr>
				<td colspan="20" height="30" align="center" width="20" bgcolor="#FFFF99"><div class="controltext">Business</td>
				</tr>
				<tr>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Office Name:</div><input type="text" name="off_name" size="35" value="<?php echo $rowGetLandlord->OFF_NAME;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				</tr>
				<tr>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Street:</div><input type="text" name="off_street" size="25" value="<?php echo $rowGetLandlord->OFF_STREET;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">City:</div><input type="text" name="off_city" size="15" value="<?php echo $rowGetLandlord->OFF_CITY;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				</tr>
				<tr>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">State:</div><input type="text" name="off_state" size="3" value="<?php echo $rowGetLandlord->OFF_STATE;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">ZIP:</div><input type="text" name="off_zip" size="10" value="<?php echo $rowGetLandlord->OFF_ZIP;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				</tr>
				<tr>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Phone:</div><input type="text" name="off_phone" size="15" value="<?php echo $rowGetLandlord->OFF_PHONE;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				<td colspan="20" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Fax:</div><input type="text" name="off_fax" size="15" value="<?php echo $rowGetLandlord->OFF_FAX;?>"></td>
				<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
				</tr>
				</table></td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
		<table width="100%">
			<tr>
			<td align="left" bgcolor="#FFFF99"><div class="controltext">Email:</div><input type="text" name="ll_email" size="20" value="<?php echo $rowGetLandlord->LL_EMAIL;?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			</tr>
		</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
		<table width="100%">
			<tr>
			<td align="left" bgcolor="#FFFF99"><div class="controltext">Addendum:</div><textarea cols="30" rows="10" name="addendum"><?php echo $rowGetLandlord->ADDENDUM;?></textarea></td>
			<td align="left" bgcolor="#FFFF99"><div class="controltext">Additional Comments:</div><textarea cols="30" rows="10" name="llnotes"><?php echo $rowGetLandlord->LLNOTES;?></textarea></td>
			</tr>
		</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">
		<table width="100%">
			<tr>
			<td align="center" align="left" bgcolor="#FFFF99"><input type="submit" value="Save"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			</tr>
		</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	</form>
	<br>
	<br>		
	

<!--END editLandlord -->