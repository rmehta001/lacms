BEGIN createLandlord -->


<?php
if (!isset($_SESSION['pref_pagebg'])) {
    $pagebgcolor = "#F5F5DC";
} else {
    $pagebgcolor = $_SESSION['pref_pagebg'];
}
?>

	<B>CREATE A NEW LANDLORD</B><br>
	<form method="POST" action="<?php echo "$PHP_SELF?op=createLandlordDo"; ?>" onSubmit="checkshortname()">
	<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor; ?>">






<table width="100%" border="0"><tr>

                        <td width="33%" align="left" bgcolor="<?php echo $pagebgcolor; ?>"><div class="controltext">Short Name: <FONT SIZE=-1 COLOR=RED>(<I>Required</I>)</FONT></div><input class="form-control" type="text" name="short_name" size="20" value="
                            <?php if (isset($rowGetLandlord->SHORT_NAME)) {
    echo $rowGetLandlord->SHORT_NAME;
}
?>" required></td>



<td>

			<?php
$lc_year = date("Y");
$lc_month = date("n");
$lc_day = date("j");
?>

			<?php
$nc_year = date("Y");
$nc_month = date("n");
$nc_day = date("j");
?>

<div class="controltext">Last Contacted:</div><nobr>
	<div class="input-group">
	<select class="form-control" name="lc_month" STYLE="Background-Color : #FFFFFF">
						<option value="1" <?php if ($lc_month == 1) {echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($lc_month == 2) {echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($lc_month == 3) {echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($lc_month == 4) {echo "selected";}?>>April</option>
						<option value="5" <?php if ($lc_month == 5) {echo "selected";}?>>May</option>
						<option value="6" <?php if ($lc_month == 6) {echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($lc_month == 7) {echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($lc_month == 8) {echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($lc_month == 9) {echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($lc_month == 10) {echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($lc_month == 11) {echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($lc_month == 12) {echo "selected";}?>>Dec</option>
						</select>
			<select class="form-control" name="lc_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i = 1; $i <= 31; $i++) {?>
						<option value="<?php echo $i; ?>" <?php if ($lc_day == $i) {echo "selected";}?>><?php echo $i; ?></option>
						<?php }?>
						</select>
			<select class="form-control" name="lc_year" STYLE="Background-Color : #FFFFFF">
						<?php for ($i = (date("Y") - 4); $i <= date("Y"); $i++) {?>
						<option value="<?php echo $i; ?>" <?php if ($lc_year == $i) {echo "selected";}?>><?php echo $i; ?></option>
						<?php }?>
						</select>
					</div>
</nobr>
</td>

<td align="left" align="center" bgcolor="<?php echo $pagebgcolor; ?>">

<div class="controltext"><NOBR>Last Contact Action: &nbsp;</NOBR></DIV>
	<select class="form-control" id="last_contact_action" name="last_contact_action" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['LAST_CONTACT_ACTION'] as $blca => $lcaValue) {
    //$selected = ($rowGetLandlord->LAST_CONTACT_ACTION==$blca) ? " selected " : "";?>
	<option value="<?php echo $blca; ?>" <?php //echo $selected;?>><?php echo $lcaValue; ?></option>
	<?php }?>
</select>

</td>



<td>

<div class="controltext"><NOBR>Next Contact Date:</NOBR></div><nobr>
	<div class="input-group">
	<select class="form-control" name="nc_month" STYLE="Background-Color : #FFFFFF">
						<option value="1" <?php if ($nc_month == 1) {echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($nc_month == 2) {echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($nc_month == 3) {echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($nc_month == 4) {echo "selected";}?>>April</option>
						<option value="5" <?php if ($nc_month == 5) {echo "selected";}?>>May</option>
						<option value="6" <?php if ($nc_month == 6) {echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($nc_month == 7) {echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($nc_month == 8) {echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($nc_month == 9) {echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($nc_month == 10) {echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($nc_month == 11) {echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($nc_month == 12) {echo "selected";}?>>Dec</option>
						</select>
			<select class="form-control" name="nc_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i = 1; $i <= 31; $i++) {?>
						<option value="<?php echo $i; ?>" <?php if ($nc_day == $i) {echo "selected";}?>><?php echo $i; ?></option>
						<?php }?>
						</select>



			<select class="form-control" name="nc_year" STYLE="Background-Color : #FFFFFF">

<?php for ($i = (date("Y") - 0); $i <= date("Y"); $i++) {?>

<option value="<?php echo $i + 1; ?>" <?php if ($nc_year == $i) {echo "selected";}?>>
<?php echo $i + 1; ?>
</option>

<option value="<?php echo $i; ?>" <?php if ($nc_year == $i) {echo "selected";}?>>
<?php echo $i; ?>
</option>

						<?php }?>
						</select>
						<button class="btn btn-success" type="submit">SAVE</button>
					</div>
</nobr>
			</td>

<td align="center" align="right" bgcolor="<?php echo $pagebgcolor; ?>">
<!-- <input type="image" src="../assets/images/save.gif" alt="SAVE"></td> -->


</tr>
		</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor; ?>">
			<table width="100%">
			<tr>
                        <td align="left" valign="top" bgcolor="<?php echo $pagebgcolor; ?>">
				<table width = "100%">
				<tr>
                                <td colspan="2" height="30" align="center" width="20" bgcolor="<?php echo $pagebgcolor; ?>"><div class="controltext"><NOBR><B>Personal / Home</B></NOBR></td>
				</tr>
				<tr>
				<td height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>First Name:</NOBR><BR><input class="form-control" type="text" name="home_name_first" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->HOME_NAME_FIRST;
}
?>"></td>
				<td height="30" width="20" bgcolor="<?php if (isset($pagebgcolor)) {
    echo $pagebgcolor;
}
?>" style="font-size:15px;"><NOBR>Last Name:</NOBR><BR><input class="form-control" type="text" name="home_name_last" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->HOME_NAME_LAST;
}
?>"></td>
				</tr>

<tr>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Care Of:</NOBR><BR><input class="form-control" type="text" name="careof" size="25" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->CAREOF;
}
?>"></td></TR><TR>


				<tr>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Street 1:</NOBR><BR><input class="form-control" type="text" name="home_street" size="25" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->HOME_STREET;
}
?>"></td></TR><TR>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Street 2:</NOBR><BR><input class="form-control" type="text" name="home_street2" size="25" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->HOME_STREET2;
}
?>"></td>
				</TR><TR>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;">

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" width="100%" style="font-size:15px;"><TR><TD>
City:<BR><input class="form-control" type="text" name="home_city" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->HOME_CITY;
}
?>">
</TD><TD>&nbsp;</TD><TD>
State:<BR><input type="text" class="form-control" name="home_state" size="3" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->HOME_STATE;
}
?>">
</TD><TD>&nbsp;</TD><TD>
ZIP:<BR><input type="text" class="form-control" name="home_zip" size="10" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->HOME_ZIP;
}
?>"></TD></TR></TABLE>

</td>
</tr>
				<tr>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;">

<TABLE CELLPADDING="0" CELLSPACING="0" width="100%" BORDER="0" style="font-size:15px;"><TR><TD>
Phone:<BR><input class="form-control" type="text" name="home_phone" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->HOME_PHONE;
}
?>"></TD><TD>&nbsp;</TD><TD>Fax:<BR><input class="form-control" type="text" name="home_fax" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->HOME_FAX;
}
?>">
				</TD></TR></TABLE>
</td>
</tr>
				<tr>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;">

<TABLE CELLPADDING="0" width="100%" CELLSPACING="0" BORDER="0" style="font-size:15px;"><TR><TD><NOBR>Cell Phone:</NOBR><BR><input class="form-control" type="text" name="mobile_phone" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->MOBILE_PHONE;
}
?>"></TD><TD>&nbsp;</TD><TD>Email:<BR><input class="form-control" type="text" name="ll_email" size="20" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->LL_EMAIL;
}
?>">
</TD></TR></TABLE>


<TABLE CELLPADDING="0" width="100%" CELLSPACING="0" BORDER="0" style="font-size:15px;"><tr>
				<td height="30"   bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Spouse First Name:</NOBR><BR><input class="form-control" type="text" name="home_spouse_first" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->HOME_SPOUSE_FIRST;
}
?>"></td><TD>&nbsp;</TD><td height="30" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Spouse Last Name:</NOBR><BR><input class="form-control" type="text" name="home_spouse_last" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->HOME_SPOUSE_LAST;
}
?>"></td>
				</tr></TABLE>

<TABLE CELLPADDING="0" width="100%" CELLSPACING="0" BORDER="0" style="font-size:15px;"><tr>
				<td height="30"  bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Spouse Cell Phone:</NOBR><BR><input class="form-control" type="text" name="spouse_office" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->SPOUSE_CELL;
}
?>"></td><TD>&nbsp;</TD><td height="30"  bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Spouse Office/Work Phone:</NOBR><BR><input class="form-control" type="text" name="spouse_office" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->SPOUSE_OFFICE;
}
?>"></td>
				</tr></TABLE>


<TABLE CELLPADDING="0" CELLSPACING="0" width="100%" BORDER="0" style="font-size:15px;"><tr>
				<td height="30" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Spouse Email:</NOBR><BR><input class="form-control" type="text" name="spouse_email" size="20" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->SPOUSE_EMAIL;
}
?>"></td><TD>&nbsp;</TD><td height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;">&nbsp;</td>
				</tr></TABLE>






<P><BR>
<NOBR>Subscribed to Newsletter: <input type="checkbox" name="newsletter_subscribe" value="2"></NOBR>
<BR><P><NOBR>
LL is Exclusive to Office <select class="form-control" name="EXCLUSIVE">

	<option value="0">No</option>
	<option value="1">Yes</option>
	</select>
</NOBR>
<BR><P><NOBR>
    LL Ranking <select class="form-control" name="LLRANK" required>
<option value=""> Select</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
	</select>

</td>
				</tr>
				</table>

			</td>
			<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
			<td align="right" valign="top">

<table width="100%">
				<tr>
				<td colspan="2" height="30" align="center" width="20" bgcolor="<?php echo $pagebgcolor; ?>"><div class="controltext"><NOBR><B>Business / Office</B></NOBR></td>
				</tr>
				<tr>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Office Name:</NOBR><BR><input class="form-control" type="text" name="off_name" size="30" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->OFF_NAME;
}
?>"></td>
				</tr>
				<tr>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Street 1:</NOBR><BR><input class="form-control" type="text" name="off_street" size="25" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->OFF_STREET;
}
?>"></td></TR><TR>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Street 2:</NOBR><BR><input class="form-control" type="text" name="off_street2" size="25" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->OFF_STREET2;
}
?>"></td></TR><TR>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;">

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" width = "100%" style="font-size:15px;"><TR><TD>
				City:<BR><input class="form-control" type="text" name="off_city" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->OFF_CITY;
}
?>"></TD><TD>&nbsp;</TD><TD>State:<BR><input class="form-control" type="text" name="off_state" size="3" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->OFF_STATE;
}
?>"></TD><TD>&nbsp;</TD><TD>ZIP:<BR><input class="form-control" type="text" name="off_zip" size="10" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->OFF_ZIP;
}
?>"></TD></TR></TABLE>
				</td>
				</tr>
				<tr>
				<td colspan="2" height="30" width="100%" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;">
				<TABLE width="100%" CELLPADDING="0" CELLSPACING="0" BORDER="0" style="font-size:15px;"><TR><TD>
Phone:<BR><input class="form-control"  type="text" name="off_phone" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->OFF_PHONE;
}
?>"></TD><TD>&nbsp;</TD><TD>Fax: <input class="form-control"  type="text" name="off_fax" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->OFF_FAX;
}
?>">
			</TD></TR></TABLE>

			</td></tr>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;">Office Email:<BR><input class="form-control"  type="text" name="off_email" size="20" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->OFF_EMAIL;
}
?>">
				</TD></TR>

				</tr>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;">Website:<BR><input type="text" class="form-control"  name="off_website" size="20" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->OFF_WEBSITE;
}
?>">
				</TD></TR>
				<TR>

				</tr>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>On-line Listings:</NOBR><BR><input class="form-control"  type="text" name="off_weblistings" size="20" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->OFF_WEBLISTINGS;
}
?>">
				</TD></TR>
				<TR>

				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Super Name:</NOBR><BR><input type="text" class="form-control"  name="super_name" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->SUPER_NAME;
}
?>">
				</TD></TR>
				<TR>
				<td colspan="2" height="30" width="20" bgcolor="<?php echo $pagebgcolor; ?>" style="font-size:15px;"><NOBR>Super Phone:</NOBR><BR><input type="text" class="form-control"  name="super_phone" size="15" value="<?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->SUPER_PHONE;
}
?>">
				</TD></TR>
				</table>
</td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor; ?>">
		<table width="100%">
			<tr>
			<td align="left" bgcolor="<?php echo $pagebgcolor; ?>">


&nbsp;

</td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor; ?>">&nbsp;</td>
			</tr>
		</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor; ?>" VALIGN="TOP">
		<table width="100%">
			<tr>
                        <td align="left" bgcolor="<?php echo $pagebgcolor; ?>"><div class="controltext">Addendum Notes:</div><textarea class="form-control"  cols="40" rows="10" name="addendum"><?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->ADDENDUM;
}
?></textarea><BR>
			<font size="3" COLOR="red"><B>Additional Addenda may be uploaded After saving</font></td>
			<td  VALIGN="TOP" align="left" bgcolor="<?php echo $pagebgcolor; ?>"><div class="controltext"><nobr>Landlord Notes: <font size="-2">(shows in Listing View)</font></nobr></div><textarea class="form-control"  cols="40" rows="10" name="llnotes"><?php if (isset($rowGetLandlord)) {
    echo $rowGetLandlord->LLNOTES;
}
?></textarea></td>
			</tr>
		</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="<?php echo $pagebgcolor; ?>">
		<table width="100%">
			<tr>
			<td align="center" align="left" bgcolor="<?php echo $pagebgcolor; ?>">
				<!-- <input type="image" src="../assets/images/save.gif" alt="SAVE"> -->
				<button type="submit" class="btn btn-success">SAVE</button>
			</td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor; ?>">&nbsp;</td>
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

<!--END createLandlord