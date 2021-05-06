<!--BEGIN editLandlord -->

<?php
include ("../assets/buttons.php");

if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 

	$quStrGetBuildings = "SELECT DISTINCT `STREET_NUM` , `STREET` FROM CLASS WHERE `CLI` =$grid AND `CLASS`.`LANDLORD`=$lid ORDER BY `CLASS`.`STREET` ASC, `CLASS`.`STREET_NUM`";
	$quGetBuildings = mysqli_query($dbh, $quStrGetBuildings) or die ($quStrGetBuildings);
	$num_Buildings=mysqli_num_rows($quGetBuildings);

	
$quStrGetBuildings2 = "SELECT `STREET_NUM` , `STREET` FROM CLASS WHERE `CLI` =$grid AND `CLASS`.`LANDLORD`=$lid";
$quGetBuildings2 = mysqli_query($dbh, $quStrGetBuildings2) or die ($quStrGetBuildings2);
$num_Units=mysqli_num_rows($quGetBuildings2);

	
	?>

	<TABLE BORDER=0><TR><TD VALIGN=TOP><B>EDIT / VIEW LANDLORD INFORMATION</B><BR>
	
	<TABLE BORDER=0><TR><TD>
<?php if ($user_level>="2") {?>
	<a href="<?php echo "$PHP_SELF?op=deleteLandlord&lid=$rowGetLandlord->LID";?>"><img border='0' vspace='0' hspace='0' src='../images/icons/delete.gif' TITLE="Delete <?php echo $rowGetLandlord->SHORT_NAME;?>"><FONT COLOR="#FF0000" SIZE="-2">Delete Landlord</FONT></a><?php } else { echo "&nbsp;"; }?>
	</TD><TD>&nbsp;&nbsp;&nbsp;<TD><FONT SIZE="-2">Date Created: <?php echo $rowGetLandlord->DATE_CREATED;?><BR>Last Modified: <?php echo $rowGetLandlord->LAST_MOD;?> by <?php echo $rowGetLandlord->LAST_MOD_BY;?></FONT></TD></TR></TABLE>
	
</TD>
<TD> &nbsp; </TD>

<TD VALIGN=TOP>
	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none&availFilter=n&vid=7&sortD=ASC&sort=STREET,%20STREET_NUM,%20APT";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="landlord" value="<?php echo $rowGetLandlord->LID;?>">
	
	<button class="button-blue pure-button">View All Listings For This Landlord</button>
	
	<!--<input type="submit" value="   View All This Landlord's Listings   " STYLE="Background-Color : #E0FFFF">-->
	</form>

	</TD>
<TD VALIGN=TOP>

<TABLE BORDER="0" CELLPADDING=0 CELLSPACING=0><TR><TD BGCOLOR="#000000"><CENTER>

<FONT SIZE="-2"><NOBR><a href="<?php echo $PHP_SELF;?>?op=changeLLListingsdo&amp;lid=<?php echo $rowGetLandlord->LID;?>&amp;grid=<?php echo $grid;?>&amp;next_contact=<?php echo $rowGetLandlord->NEXT_CONTACT;?>"><button class="button-green pure-button">Set All This Landlord's Listings to Updated Today <img border=0 src=https://www.BostonApartments.com/images/newIcon.gif></button></A></NOBR>

<TABLE BORDER="1" BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0 WIDTH="100%"><TR>
<TD BGCOLOR=FFFFFF VALIGN="TOP"><FONT SIZE="-2"><A HREF="<?php echo "$PHP_SELF?op=adlEdit&LLID=$lid";?>"><IMG SRC="../images/edit-new-listing-ll.gif" border="0" TITLE="Create a New Listing for this landlord">Create a New Listing for this landlord</A></FONT></TD><TD BGCOLOR=FFFFFF VALIGN="TOP" ALIGN="CENTER"><NOBR> <?php
	echo "<NOBR>$num_Buildings <A HREF=$PHP_SELF?op=buildings&lid=$rowGetLandlord->LID&llname=$rowGetLandlord->SHORT_NAME><IMG src=../assets/images/buildings.jpg BORDER=0 TITLE=\"Edit Landlord's Units By Building Globally/Individually\"></A> | <A HREF=$PHP_SELF?op=global-Landlord&lid=$rowGetLandlord->LID&llname=$rowGetLandlord->SHORT_NAME>$num_Units <IMG src=../assets/images/global.jpeg BORDER=0 TITLE=\"Make Global changes to ALL Listings for $rowGetLandlord->SHORT_NAME\"></A></NOBR>";
; ?></NOBR></TD></TR></TABLE>

</CENTER></TD></TR></TABLE>

</TD></TR></TABLE>

	<form action="<?php echo "$PHP_SELF?op=editLandlordDo";?>" method="POST">
	<input type="hidden" name="lid" value="<?php echo $lid; ?>">	
	<table border="0" cellspacing="0" cellpadding="0" BGCOLOR="<?php echo $pagebgcolor;?>">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td>
		<table width="100%" BORDER="0">
		<?php 
		$lc_year = substr ($rowGetLandlord->LAST_CONTACTED, 0, 4);
		$lc_month = substr ($rowGetLandlord->LAST_CONTACTED, 5,2);
		$lc_day = substr ($rowGetLandlord->LAST_CONTACTED, 8,2);
		?>
		
			<tr>
			<td align="left">



<div class="controltext">Short Name:</DIV><input type="text" name="short_name" size="20" value="<?php echo $rowGetLandlord->SHORT_NAME;?>"> 

</TD><TD>

<div class="controltext">Last Contacted: 

<a href="<?php echo $PHP_SELF;?>?op=changeLLLCdo&amp;lid=<?php echo $rowGetLandlord->LID;?>&amp;grid=<?php echo $grid;?>&amp;next_contact=<?php echo $rowGetLandlord->NEXT_CONTACT;?>"><FONT SIZE="-3" COLOR="green">Make Today</FONT></A>
</div>
						<select name="lc_month" STYLE="Background-Color : #FFFFFF">
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
			<select name="lc_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($lc_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>
			<select name="lc_year" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=(date("Y")-4);$i<=date("Y");$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($lc_year==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>



</TD><TD>

<div class="controltext">Last Contact Action:</DIV>
	<select id="last_contact_action" name="last_contact_action" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['LAST_CONTACT_ACTION'] as $blca => $lcaValue) { 
	$selected = ($rowGetLandlord->LAST_CONTACT_ACTION==$blca) ? " selected " : "";?>
	<option value="<?php echo $blca;?>" <?php echo $selected;?>><?php echo $lcaValue;?></option>
	<?php } ?>	
</select>


</TD><TD>

		<?php 
		$nc_year = substr ($rowGetLandlord->NEXT_CONTACT, 0, 4);
		$nc_month = substr ($rowGetLandlord->NEXT_CONTACT, 5,2);
		$nc_day = substr ($rowGetLandlord->NEXT_CONTACT, 8,2);
		?>
		
<div class="controltext">Next Contact Date:</div>
						<select name="nc_month" STYLE="Background-Color : #FFFFFF">
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
			<select name="nc_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($nc_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>
			<select name="nc_year" STYLE="Background-Color : #FFFFFF">

<?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>



<option value="<?php echo $i+7;?>" <?php if ($nc_year==$i+7) { echo "selected";}?>>
<?php echo $i+7;?>
</option>
<option value="<?php echo $i+6;?>" <?php if ($nc_year==$i+6) { echo "selected";}?>>
<?php echo $i+6;?>
</option>
<option value="<?php echo $i+5;?>" <?php if ($nc_year==$i+5) { echo "selected";}?>>
<?php echo $i+5;?>
</option>
<option value="<?php echo $i+4;?>" <?php if ($nc_year==$i+4) { echo "selected";}?>>
<?php echo $i+4;?>
</option>
<option value="<?php echo $i+3;?>" <?php if ($nc_year==$i+3) { echo "selected";}?>>
<?php echo $i+3;?>
</option>
<option value="<?php echo $i+2;?>" <?php if ($nc_year==$i+2) { echo "selected";}?>>
<?php echo $i+2;?>
</option>
<option value="<?php echo $i+1;?>" <?php if ($nc_year==$i+1) { echo "selected";}?>>
<?php echo $i+1;?>
</option>
<option value="<?php echo $i;?>" <?php if ($nc_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

						<?php } ?>
						</select>
</TD><TD>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			

			
<!-- <input type="image" src="../assets/images/save.gif" alt="SAVE"> -->
<?php if ($user_level>"0.5") {?>
	<button class="button-green pure-button">Save</button>
<?php } ?>

			</td>
			</tr>
		</table>


	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td style="font-size:10px;">
	
	
	<center>	
<B><A HREF="<?php echo "$PHP_SELF?op=llcomments&llid=$lid";?>" TITLE="View Landlord Comments">View Landlord Comments</A> &nbsp; | &nbsp; <A HREF="<?php echo "$PHP_SELF?op=createllcomments&llid=$lid";?>" TITLE="Add Landlord Comment">Create Landlord Comment</A> &nbsp; | &nbsp; <A HREF="<?php echo "$PHP_SELF?op=showingsLandlord&llid=$lid";?>" TITLE="View Landlord Showing History">View Landlord Showing History</A><BR>
</B>
</center>
	<BR>
	
	
			<table width="100%" BORDER="0">
			<tr>
			<td align="left" valign="top">
				<table BORDER="0">
				<tr>
				<td colspan="2" height="30" align="center" width="20"><div class="controltext"><B>Personal/Home</B></td>
				</tr>
				<tr>
				<td height="30" width="20" style="font-size:10px;"><NOBR>First Name:</NOBR><BR><input type="text" name="home_name_first" size="22" value="<?php echo $rowGetLandlord->HOME_NAME_FIRST;?>"></td>
				<td height="30" width="20" style="font-size:10px;"><NOBR>Last Name:</NOBR><BR><input type="text" name="home_name_last" size="22" value="<?php echo $rowGetLandlord->HOME_NAME_LAST;?>"></td>
				</tr>

				<tr>
				<td colspan="2" height="30" width="20" style="font-size:10px;"><NOBR>Care of:</NOBR><BR><input type="text" name="careof" size="25" value="<?php echo $rowGetLandlord->CAREOF;?>"></td>
				</tr>

				<tr>
				<td colspan="2" height="30" width="20" style="font-size:10px;"><NOBR>Street 1:</NOBR><BR><input type="text" name="home_street" size="25" value="<?php echo $rowGetLandlord->HOME_STREET;?>"></td>
				</tr>
				<tr>
				<td colspan="2" height="30" width="20" style="font-size:10px;"><NOBR>Street 2:</NOBR><BR><input type="text" name="home_street2" size="25" value="<?php echo $rowGetLandlord->HOME_STREET2;?>"></td>
				</tr>
				<tr>
				<td colspan="2" height="30" width="20" style="font-size:10px;">
				
				<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" style="font-size:10px;"><TR><TD>
				City:<BR><input type="text" name="home_city" size="15" value="<?php echo $rowGetLandlord->HOME_CITY;?>">
				</TD><TD>
				&nbsp;
				</TD><TD>
				State:<BR><input type="text" name="home_state" size="3" value="<?php echo $rowGetLandlord->HOME_STATE;?>">
				</TD><TD>
				&nbsp;
				</TD><TD>
				ZIP:<BR><input type="text" name="home_zip" size="10" value="<?php echo $rowGetLandlord->HOME_ZIP;?>">
				</TD></TR></TABLE>
				
				</td>
				</tr>
				<tr>
				<td colspan="2" height="30" width="20" style="font-size:10px;">
				
				<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" style="font-size:10px;"><TR><TD>
				Phone:<BR><input type="text" name="home_phone" size="15" value="<?php echo $rowGetLandlord->HOME_PHONE;?>">
				</TD><TD>
				&nbsp;
				</TD><TD>
				Mobile Phone:<BR><input type="text" name="mobile_phone" size="15" value="<?php echo $rowGetLandlord->MOBILE_PHONE;?>">
				</TD></TR></TABLE>
				
				</td>
				</tr>
				<tr>
				<td colspan="2" height="30" width="20" style="font-size:10px;">
				
<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" style="font-size:10px;"><TR><TD>
Fax:<BR><input type="text" name="home_fax" size="15" value="<?php echo $rowGetLandlord->HOME_FAX;?>">
</TD><TD>
&nbsp;
</TD><TD>
Email:<BR><input type="text" name="ll_email" size="20" value="<?php echo htmlspecialchars($rowGetLandlord->LL_EMAIL);?>">
</TD><TD>
&nbsp;
</TD><TD>
<?php
if ( $rowGetLandlord->LL_EMAIL != "" ) {

echo "<A HREF=$PHP_SELF?op=mail_landlord&lid=$lid&e=1><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";

} else {
	echo " &nbsp; ";
}; ?>
</TD></TR></TABLE>




<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" style="font-size:10px;"><tr>
				<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" style="font-size:10px;"><NOBR>Spouse First Name:</NOBR><BR><input type="text" name="home_spouse_first" size="15" value="<?php echo $rowGetLandlord->HOME_SPOUSE_FIRST;?>"></td><TD>&nbsp;</TD><td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" style="font-size:10px;"><NOBR>Spouse Last Name:</NOBR><BR><input type="text" name="home_spouse_last" size="15" value="<?php echo $rowGetLandlord->HOME_SPOUSE_LAST;?>"></td>
				</tr></TABLE>

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" style="font-size:10px;"><tr>
				<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" style="font-size:10px;"><NOBR>Spouse Cell Phone:</NOBR><BR><input type="text" name="spouse_cell" size="15" value="<?php echo $rowGetLandlord->SPOUSE_CELL;?>"></td><TD>&nbsp;</TD><td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" style="font-size:10px;"><NOBR>Spouse Office/Work Phone:</NOBR><BR><input type="text" name="spouse_office" size="15" value="<?php echo $rowGetLandlord->SPOUSE_OFFICE;?>"></td>
				</tr></TABLE>

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" style="font-size:10px;"><tr>
<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" style="font-size:10px;">Spouse Email:<BR><input type="text" name="spouse_email" size="20" value="<?php echo htmlspecialchars($rowGetLandlord->SPOUSE_EMAIL);?>">
</TD><TD>
&nbsp;
</TD><TD>
<?php
if ( $rowGetLandlord->SPOUSE_EMAIL != "" ) {

echo "<A HREF=$PHP_SELF?op=mail_landlord&lid=$lid&e=4><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";

} else {
	echo " &nbsp; ";
}; ?>
</TD></TR></TABLE>





<P><BR>
<NOBR>Subscribed to Newsletter: <input type="checkbox" name="newsletter_subscribe" <?php if ($rowGetLandlord->NEWSLETTER_SUBSCRIBE=='2') { echo checked;} ?> value="2">
</NOBR>

<BR><P><NOBR>
LL is Exclusive to Office <select name="EXCLUSIVE">

	<option value="1" <?php if ($rowGetLandlord->EXCLUSIVE=="1") {echo " selected";} ?> >Yes</option>
	<option value="0" <?php if ($rowGetLandlord->EXCLUSIVE=="0") {echo " selected";} ?>>No</option>
	</select>
</NOBR>
<BR>
<BR><P><NOBR>
LL Ranking <select name="LLRANK">
<option value=""> Select</option>
	<option value="1" <?php if ($rowGetLandlord->LLRANK=="1") {echo " selected";} ?> >1</option>
	<option value="2" <?php if ($rowGetLandlord->LLRANK=="2") {echo " selected";} ?>>2</option>
	<option value="3" <?php if ($rowGetLandlord->LLRANK=="3") {echo " selected";} ?>>3</option>
	<option value="4" <?php if ($rowGetLandlord->LLRANK=="4") {echo " selected";} ?>>4</option>
	<option value="5" <?php if ($rowGetLandlord->LLRANK=="5") {echo " selected";} ?>>5</option>
	<option value="6" <?php if ($rowGetLandlord->LLRANK=="6") {echo " selected";} ?>>6</option>
	<option value="7" <?php if ($rowGetLandlord->LLRANK=="7") {echo " selected";} ?>>7</option>
	<option value="8" <?php if ($rowGetLandlord->LLRANK=="8") {echo " selected";} ?>>8</option>
	<option value="9" <?php if ($rowGetLandlord->LLRANK=="9") {echo " selected";} ?>>9</option>
	<option value="10" <?php if ($rowGetLandlord->LLRANK=="10") {echo " selected";} ?>>10</option>
	</select>
	
	
</NOBR>

	</td>
				</tr>
				</table>
				


			</td>
			<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
			<td align="right" valign="top">

<table BORDER="0">
				<tr>
				<td height="30" align="center" width="20"><div class="controltext"><B>Business/Office</B></td>
				</tr>
				<tr>
				<td height="30" width="20" style="font-size:10px;"><NOBR>Office Name:</NOBR><BR><input type="text" name="off_name" size="35" value="<?php echo $rowGetLandlord->OFF_NAME;?>"></td>
				</tr>
				<tr>
				<td height="30" width="20" style="font-size:10px;">Street 1:<BR><input type="text" name="off_street" size="25" value="<?php echo $rowGetLandlord->OFF_STREET;?>"></td>
				</tr>
				<tr>
				<td height="30" width="20" style="font-size:10px;"><NOBR>Street 2:</NOBR><BR><input type="text" name="off_street2" size="25" value="<?php echo $rowGetLandlord->OFF_STREET2;?>"></td>
				</tr>
				<tr>
				<td height="30" width="20" style="font-size:10px;">

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" style="font-size:10px;"><TR><TD>
City:<BR><input type="text" name="off_city" size="15" value="<?php echo $rowGetLandlord->OFF_CITY;?>">
</TD><TD>
&nbsp;
</TD><TD>
State:<BR><input type="text" name="off_state" size="3" value="<?php echo $rowGetLandlord->OFF_STATE;?>">
</TD><TD>
&nbsp;
</TD><TD>
ZIP:<BR><input type="text" name="off_zip" size="10" value="<?php echo $rowGetLandlord->OFF_ZIP;?>">
</TD></TR></TABLE>

			</td></tr>
				<tr>
				<td height="30" width="20" style="font-size:10px;">
<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" style="font-size:10px;"><TR><TD>
	Phone:<BR><input type="text" name="off_phone" size="15" value="<?php echo $rowGetLandlord->OFF_PHONE;?>">
</TD><TD>
&nbsp;
</TD><TD>
Fax:<BR><input type="text" name="off_fax" size="15" value="<?php echo $rowGetLandlord->OFF_FAX;?>">
</td></tr></table>
	
	      </td></tr>

		<td height="30" width="20" style="font-size:10px;">

  Office Email:<BR><input type="text" name="off_email" size="20" value="<?php echo $rowGetLandlord->OFF_EMAIL;?>"> <?php
if ( $rowGetLandlord->OFF_EMAIL != "" ) {
	echo "<A HREF=$PHP_SELF?op=mail_landlord&lid=$lid&e=2><IMG src=../images/icons/email.gif BORDER=0></A>";
} else {
	echo " &nbsp; ";
}
; ?>

</TD>

</tr>
<td height="30" width="20" style="font-size:10px;">
<NOBR>Website: &nbsp; <FONT SIZE=-2><I>(e.g. http://www.somedomain.com)</I></FONT></NOBR><BR><NOBR><input type="text" name="off_website" size="30" value="<?php echo htmlspecialchars($rowGetLandlord->OFF_WEBSITE);?>"> <?php
if ( $rowGetLandlord->OFF_WEBSITE != "" ) {
	echo "<A HREF=$rowGetLandlord->OFF_WEBSITE target=_NEW>Visit Site</A>";
} else {
	echo " &nbsp; ";
}
; ?></NOBR>

</td>
</TR>

</tr>
<td height="30" width="20" style="font-size:10px;"><NOBR>LL's Web Listings: &nbsp; <FONT SIZE=-2><I>(e.g. http://www.somedomain.com/listings.htm)</I></FONT></NOBR><BR><NOBR><input type="text" name="off_weblistings" size="30" value="<?php echo $rowGetLandlord->OFF_WEBLISTINGS;?>"> <?php
if ( $rowGetLandlord->OFF_WEBLISTINGS != "" ) {
	echo "<A HREF=$rowGetLandlord->OFF_WEBLISTINGS target=_NEW>See Listings</A>";
} else {
	echo " &nbsp; ";
}
; ?></NOBR>


</td>
</TR>

<tr>
<td height="30" width="20" style="font-size:10px;">Super Name:<BR><input type="text" name="super_name" size="20" value="<?php echo $rowGetLandlord->SUPER_NAME;?>"></td>
</TR>
				<tr>
				<td height="30" width="20" style="font-size:10px;">Super Phone:<BR><input type="text" name="super_phone" size="20" value="<?php echo $rowGetLandlord->SUPER_PHONE;?>"></td>
</TR>


				</table>
</td>
	</tr>
		</table>

	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td>
		<table width="100%">
			<tr>
			<td align="left">

&nbsp;

</td>
			<td height="30" width="1">&nbsp;</td>
			</tr>
		</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td>

	
	
		<table width="100%">
			<tr>
			<td align="left" valign="top">
			
			<A HREF="<?php echo "$PHP_SELF?op=addendums&lid=$lid";?>"  TITLE="Click to Manage Documents for this landlord"><img src="../assets/images/full.gif" width="15" height="15" BORDER="0"  TITLE="Click to Manage Documents for this landlord"><NOBR><B>
			
 <i class="fa fa-file-word-o"></i><i class="fa fa-file-pdf-o"></i> Addenda &amp; Forms Storage</B></A></NOBR><BR>
			
			
			<div class="controltext" style="font-size:10px;">Addendum Notes:</div><textarea cols="30" rows="9" name="addendum"><?php echo $rowGetLandlord->ADDENDUM;?></textarea><BR>

</td>



			<td align="left" valign="top"><div class="controltext" style="font-size:10px;">Landlord Notes:  <FONT SIZE=-3>(shows in Listing View)</FONT>:</div><textarea cols="30" rows="10" name="llnotes"><?php echo $rowGetLandlord->LLNOTES;?></textarea></td>

</form>

</FONT></TD>
</div></td>



			</tr>
		</table>


	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">
		<table width="100%">
			<tr>
			<td align="center" align="left"><!-- <input type="image" src="../assets/images/save.gif" alt="SAVE"> -->

<?php if ($user_level>"0.5") {?>
	<button class="button-green pure-button">Save</button>
<?php } ?>

<?php if ($user_level>="2") {?>
			&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo "$PHP_SELF?op=deleteLandlord&lid=$rowGetLandlord->LID";?>"><img border='0' vspace='0' hspace='0' src='../images/icons/delete.gif' TITLE="Delete <?php echo $rowGetLandlord->SHORT_NAME;?>"><FONT COLOR="#FF0000" SIZE="-2">Delete Landlord <?php echo $rowGetLandlord->SHORT_NAME;?></FONT></a> <?php } ?> </td>
			<td height="30" width="1">&nbsp;</td>
			</tr>
		</table>
	
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	<br>
	<br>


	

<!--END editLandlord -->