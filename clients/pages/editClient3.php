<!--BEGIN editClient -->
	<?php
	//Preferences reverse//
	$type_pref = string_to_array($rowGetClient->TYPE_PREF, ",");
	$loc_pref = string_to_array($rowGetClient->LOC_PREF, ",");
	$rooms_pref = string_to_array($rowGetClient->ROOMS_PREF, ",");
	$bath_pref = string_to_array($rowGetClient->BATH_PREF, ",");
	$pets_pref = string_to_array($rowGetClient->PETS_PREF, ",");
	?>
	<br>
	<br>
	
	
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="7" valign="top" width="100%" height="10" bgcolor="#FFFFFF"><a href="<?php echo "$PHP_SELF?op=hot_list_add&item_type=3&item_id=$clid&return_page=$op&return_page_rid=$clid";?>"><img border="0" hspace="0" vspace="0" width="96" height="23" src="../assets/images/addToHotList.jpg"></a></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<form action="<?php echo "$PHP_SELF?op=editClientDo";?>" method="POST">
	<input type="hidden" name="clid" value="<?php echo $rowGetClient->CLID;?>">
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">



<table>
<tr>

<TD COLSPAN=6>
<NOBR><FONT SIZE="+1">Client Information:</FONT></NOBR>
<TABLE><TR><TD>




		<?php 
		$mi_year = substr ($rowGetClient->DATE_MOVEIN, 0, 4);
		$mi_month = substr ($rowGetClient->DATE_MOVEIN, 5,2);
		$mi_day = substr ($rowGetClient->DATE_MOVEIN, 8,2);
		?>
		
<NOBR>
<div class="controltext">Move In Date:</div>
</NOBR>
<NOBR>
<select name="mi_month">
						<option value="1" <?php if ($mi_month=='01') { echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($mi_month=='02') { echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($mi_month=='03') { echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($mi_month=='04') { echo "selected";}?>>April</option>
						<option value="5" <?php if ($mi_month=='05') { echo "selected";}?>>May</option>
						<option value="6" <?php if ($mi_month=='06') { echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($mi_month=='07') { echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($mi_month=='08') { echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($mi_month=='09') { echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($mi_month=='10') { echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($mi_month=='11') { echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($mi_month=='12') { echo "selected";}?>>Dec</option>
						</select> 
			<select name="mi_day">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($mi_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>
			<select name="mi_year">

<?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>

<option value="<?php echo $i+1;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
<?php echo $i+1;?>
</option>

<option value="<?php echo $i;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

						<?php } ?>
						</select>

</NOBR>


</DIV>



</TD><TD>
 &nbsp; 
</TD><TD> 
<NOBR><div class="controltext">Date Created: 
<?php echo $rowGetClient->DATE_CREATED;?></DIV></NOBR>
<NOBR><div class="controltext">By Agent: <?php 
if($rowGetClient->HANDLE)
{ echo $rowGetClient->HANDLE; }
else
{ echo $rowGetClient->UID; }

?></DIV></NOBR>




</TD><TD>
 &nbsp; 
</TD><TD>



		<?php 
		$nc_year = substr ($rowGetClient->DATE_NEXT_CONTACT, 0, 4);
		$nc_month = substr ($rowGetClient->DATE_NEXT_CONTACT, 5,2);
		$nc_day = substr ($rowGetClient->DATE_NEXT_CONTACT, 8,2);
		?>
		
<NOBR>
<div class="controltext">Next Contact Date:</div>
</NOBR>
<NOBR>
<select name="nc_month">
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

</NOBR>








</DIV>
</TD></TR></TABLE>




</TD>
</TR><TR>

			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext"><NOBR>First Name:</NOBR></div><input type="text" name="name_first" size="20" value="<?php echo $rowGetClient->NAME_FIRST;?>"></td>

			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>

			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext"><NOBR>Last Name:</NOBR></div><input type="text" name="name_last" size="20" value="<?php echo $rowGetClient->NAME_LAST;?>"></td>

			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>

			<td valign="bottom" height="30" width="20" bgcolor="#FFFF99"><div class="controltext"><NOBR>Interested in:</NOBR></div><select name="type_pref">
			<?php while ($rowTypes = mysqli_fetch_object($quTypes)) {?>
			<option value="<?php echo $rowTypes->TYPE;?>"><?php echo $rowTypes->TYPENAME;?>s</option>
			<?php }?>
			</select></td><td><a href="" onClick="clientSearch()" >Search</a>  </td>
			<script>
			function clientSearch()
			{
			   var filter_string;
			   filter_string=document.forms[1].loc_pref.value;
//			   filter_string+=document.forms[1].name_first.value;
			   //alert(document.forms[1].name_first.value+" "+filter_string);
			   alert(filter_string);
			}
			</script>	
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>

</tr>
</table>



	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	<tr>


	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>

			<td height="30" width="28" bgcolor="#FFFF99">

			<table>
			<tr>
			
			<td valign="bottom" height="30" width="20" bgcolor="#FFFF99"><div class="controltext"><NOBR>Home Phone:</NOBR></div><input type="text" name="home_phone" size="15" value="<?php echo $rowGetClient->HOME_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td valign="bottom" height="30" width="20" bgcolor="#FFFF99"><div class="controltext"><NOBR>Work Phone:</NOBR></div><input type="text" name="work_phone" size="15" value="<?php echo $rowGetClient->WORK_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td valign="bottom" height="30" width="20" bgcolor="#FFFF99"><div class="controltext"><NOBR>Mobile Phone:</NOBR></div><input type="text" name="mobile_phone" size="15" value="<?php echo $rowGetClient->MOBILE_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td valign="bottom" height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Email:</div><input type="text" name="client_email" size="20" value="<?php echo $rowGetClient->CLIENT_EMAIL;?>"></td>
			<td valign="bottom" height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td valign="bottom" height="30" width="1" bgcolor="#FFFF99"><A HREF="mailto:<?php echo $rowGetClient->CLIENT_EMAIL;?>"><IMG src="../assets/images/mailto.gif" BORDER="0"></A></td>
			<td valign="bottom" height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			</tr>
			</table>

</td>

	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
</TR><TR>

	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>




	<td bgcolor="#FFFF99">


<table><tr><td>

<div class="controltext">Address:</div><input type="text" name="curaddress" size="28" value="<?php echo $rowGetClient->CURADDRESS;?>"></td>

			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>

			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">City:</div><input type="text" name="curcity" size="28" value="<?php echo $rowGetClient->CURCITY;?>"></td>

			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>


			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">State:</div><input type="text" name="curstate" size="2" value="<?php echo $rowGetClient->CURSTATE;?>"></td>

			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>


			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Zip:</div><input type="text" name="curzip" size="10" value="<?php echo $rowGetClient->CURZIP;?>"></td>

			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>


</tr>
</table>


	</td>





	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>

<TR>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">

<TABLE><TR><TD>
<div class="controltext"><NOBR># of people:</NOBR></div><input type="text" SIZE="2" name="num_people" value="<?php echo $rowGetClient->NUM_PEOPLE;?>">
</td>

			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>

			<td height="30" width="2" bgcolor="#FFFF99">
<div class="menu">Client Type:</div><select name="client_type">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['CLIENT_TYPE'] as $ctkey => $ctValue) { 
						$selected = ($rowGetClient->CLIENT_TYPE==$ctkey) ? " selected " : "";?>
					<option value="<?php echo $ctkey;?>" <?php echo $selected;?>><?php echo $ctValue;?></option>
					<?php } ?>
				</select><br>
			</TD>
<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="2" bgcolor="#FFFF99">
<div class="menu">Employment:</div><select name="client_employment">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['CLIENT_EMPLOYMENT'] as $cekey => $ceValue) { 
						$selected = ($rowGetClient->CLIENT_EMPLOYMENT==$cekey) ? " selected " : "";?>
					<option value="<?php echo $cekey;?>" <?php echo $selected;?>><?php echo $ceValue;?></option>
					<?php } ?>
				</select><br>
			</TD>



</TR>
</TABLE>



</TD>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>


</TR>

	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">

			<table>
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99">

<div class="controltext"><NOBR>Price Minimum:</div><NOBR><NOBR>$<input type="text" name="pricemin" value="<?php echo $rowGetClient->PRICEMIN;?>">
</NOBR>
</td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99">
<div class="controltext"><NOBR>Price Maximum:</NOBR></div><NOBR>$<input type="text" name="pricemax" value="<?php echo $rowGetClient->PRICEMAX;?>">
</NOBR>
</td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>


			<td height="30" width="20" bgcolor="#FFFF99">
<NOBR><div class="menu">Furnished</DIV></NOBR>
<input type="checkbox" name="client_furnished" value="1" <?php if ($rowGetClient->CLIENT_FURNISHED) { echo " checked "; } ?>><br>
</TD>

			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>

			<td height="30" width="20" bgcolor="#FFFF99">
<NOBR><div class="menu">Short-Term</DIV></NOBR>
<input type="checkbox" name="client_shortterm" value="1" <?php if ($rowGetClient->CLIENT_SHORTTERM) { echo " checked "; } ?>><br>
</TD>

			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>

			</tr>
			</table>

	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
			<table>
			<tr>
			
			<td valign="bottom" height="30" width="20" bgcolor="#FFFF99">



<div class="controltext">Location preference(s):</div><select name="loc_pref[]" multiple SIZE=23 >
				<?php while ($rowLocs = mysqli_fetch_object($quLocs)) { ?>
				<option value="<?php echo $rowLocs->LOCID;?>" <?php if (in_array($rowLocs->LOCID, $loc_pref)) { echo " selected "; }?>><?php echo $rowLocs->LOCNAME;?></option>
				<?php } ?>
				</select>




</td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td valign="bottom" height="30" width="20" bgcolor="#FFFF99">




<div class="controltext"># of Bedrooms:</div><select name="rooms_pref[]" multiple SIZE=23> 


				<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $roomkey => $roomval) { ?>
				<option value="<?php echo $roomkey;?>" <?php if (in_array($roomkey, $rooms_pref)) { echo " selected "; }?>><?php echo $roomval;?></option>
				<?php }?>

				</select>

</td>


			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td valign="bottom" height="30" width="20" bgcolor="#FFFF99">



<div class="controltext"># of Baths:</div><select name="bath_pref[]" multiple  SIZE=11> 
				<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bathkey => $bathval) { ?>
				<option value="<?php echo $bathkey;?>" <?php if (in_array($bathkey, $bath_pref)) { echo " selected "; }?>><?php echo $bathval;?></option>
				<?php }?>

				</select>


<BR>
<P>
<div class="controltext">Pets preference:</div><select name="pets_pref[]" multiple  SIZE=9> 



				<?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petskey => $petsval) { ?>
				<option value="<?php echo $petskey;?>" <?php if (in_array($petskey, $pets_pref)) { echo " selected "; }?>><?php echo $petsval;?></option>
				<?php }?>

				</select>



</TD>


			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>


			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
			<table>
			<tr>
			
			<td valign="bottom" height="30" width="20" bgcolor="#FFFF99">



			<table>
			<tr>
			
			<td height="40" width="100" bgcolor="#FFFF99" COLSPAN="5">

<div class="controltext">Additional Comments:</div><textarea name="client_notes" rows="5" cols="75"><?php echo $rowGetClient->CLIENT_NOTES;?></textarea></td>
			</tr>
			</table>




</td>
			
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">

			<table>
			<tr>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Accounting:</div></td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000">
<img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td width="400" bgcolor="#FFFF99">


<TABLE><TR><TD bgcolor="#FFFF99">

			<table width="100%">
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Tenant fee paid:</div>$<input type="text" name="tenant_fee_paid" size="5" value="<?php echo $rowGetClient->TENANT_FEE_PAID;?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">First month paid:</div>$<input type="text" name="payment_first_paid"  size="5" value="<?php echo $rowGetClient->PAYMENT_FIRST_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Last month paid:</div>$<input type="text" name="payment_last_paid" size="5" value="<?php echo $rowGetClient->PAYMENT_LAST_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Security deposit paid:</div>$<input type="text" name="payment_sec_paid" size="5" value="<?php echo $rowGetClient->PAYMENT_SEC_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Key deposit paid:</div>$<input type="text" name="key_dep_paid" size="5" value="<?php echo $rowGetClient->KEY_DEP_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Cleaning deposit paid:</div>$<input type="text" name="clean_dep_paid" size="5" value="<?php echo $rowGetClient->CLEAN_DEP_PAID;?>"></td>
			</tr>
			</table>


</TD><TD bgcolor="#FFFF99">
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</TD><TD VALIGN="TOP" bgcolor="#FFFF99" align="left">



<NOBR><div class="menu">Fee Disclosure Given? &nbsp; <input type="checkbox" name="fee_disclosure" value="1" <?php if ($rowGetClient->FEE_DISCLOSURE) { echo " checked "; } ?>></NOBR></DIV>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/rentips-fee-disclosure.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Fee Disclosure</A></NOBR></DIV><BR>

<BR>
<NOBR><div class="menu">Agency Disclosure Given? &nbsp; <input type="checkbox" name="agency_disclosure" value="1" <?php if ($rowGetClient->AGENCY_DISCLOSURE) { echo " checked "; } ?>></NOBR></DIV>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/agencydisclosure.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Agency Disclosure</A></NOBR></DIV><BR>

<NOBR><div class="menu">Credit Check Completed? &nbsp; <input type="checkbox" name="client_credit_check" value="1" <?php if ($rowGetClient->CLIENT_CREDIT_CHECK) { echo " checked "; } ?>></DIV><br>


<div class="menu">Application status:</div><select name="client_app_status">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['CLIENT_APP_STATUS'] as $askey => $asValue) { 
						$selected = ($rowGetClient->CLIENT_APP_STATUS==$askey) ? " selected " : "";?>
					<option value="<?php echo $askey;?>" <?php echo $selected;?>><?php echo $asValue;?></option>
					<?php } ?>
				</select><br>

<P>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/leadlaw.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Lead law Notice - Rentals</A></NOBR></DIV>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/rentips-leadlaw-notification-sale.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Lead law Notice - Sales</A></NOBR></DIV><BR>







</TD></TR></TABLE>



	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
			<table>
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99">


<!-- placeholder -->

</td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td  align="center" bgcolor="#FFFF99">
			<table width="100%">
			<tr>
			
			<td height="30" align="center" bgcolor="#FFFF99"><div class="controltext"><input type="submit" value="Save"></td>
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






<!--END editClient -->