<!--BEGIN editPrefs -->
<CENTER>

<TABLE BGCOLOR="#FFFFFF" WIDTH="800"><TR><TD WIDTH="45">
<img src="../images/preferences.jpg" border=0 height=45 width=70>
</TD><TD>
	<CENTER><B>Edit Preferences for <?php echo $handle;?> from <?php echo $group;?></B></CENTER></TD><TD WIDTH="45">
<img src="../images/preferences.jpg" border=0 height=45 width=70>
</TD></TR></TABLE>

	<form action="<?php echo "$PHP_SELF?op=editPrefsDo"; ?>" method="POST">
	<input type="hidden" name="use_version" value="2">
<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} ?>
	<div class="controltext" style="background-color:<?php echo $pagebgcolor;?>;border:1px solid black;width:800px;">
	<table cellspacing="5" cellpadding="3" border=0>

<TR><TD ALIGN=CENTER>
<BR>
<B><a href="<?php echo "$PHP_SELF?op=changePassword";?>" TITLE="Click here to change your password"><FONT COLOR="GREEN" SIZE="+1">Change Password</FONT></a></B><BR><BR>
<input type="submit" value=" Save Agent Preferences " STYLE="Background-Color : #adffad ;">
</TD><TD>
<FONT SIZE="-1" color=red><I>(You have to log out an log back in for some of the changes to your preferences to take place after you save. In some cases you may have to close your browser,)</I></FONT> 

</TD></TR>


	<tr>
	<td align="right" valign="top"><span class="controltext"><NOBR>Default number of ads/listings</NOBR><BR>to display on page:</span></td>
	<td valign="top"><input type="text" size="3" name="num_ads" value="<?php echo $rowGetUser->NUM_ADS;?>"></td>
	</tr>
	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="top"><span class="controltext">Personal Signature<BR><P>(to be displayed optionally<BR>in the body of each ad.<BR>e.g. Call Pat: (617) 123-4567.)</span></td>
	<td valign="top"><textarea name="user_sig" rows="4" cols="45"><?php echo $rowGetUser->USER_SIG;?></textarea><br>(No HTML accepted.)</td>
	</tr>
	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>



<TR>
<TD COLSPAN="2" align="center">
		<table WIDTH="400">
			<tr>
			<td height="30"><div class="controltext">First Name:

</TD><TD>
<input type="text" name="fname" value="<?php echo $rowGetUser->FNAME;?>"></td>
			</tr>

			<tr>
			<td height="30"><div class="controltext">Last Name:</DIV>
</TD><TD>
<input type="text" name="lname" value="<?php echo $rowGetUser->LNAME;?>"></td>
			</tr>


			<tr>
			<td height="30"><div class="controltext">Position:</DIV>
</TD><TD>
<input type="text" name="position" value="<?php echo $rowGetUser->POSITION;?>"></td>
			</tr>


			<tr>
			<td height="30"><div class="controltext">Cell Phone:</DIV>
</TD><TD>
<input type="text" name="cellphone" value="<?php echo $rowGetUser->CELLPHONE;?>"></td>
			</tr>

			<tr>
			<td height="30"><div class="controltext">Direct Line:</DIV>
</TD><TD>
<input type="text" name="directline" value="<?php echo $rowGetUser->DIRECTLINE;?>"></td>
			</tr>


			<tr>
			<td height="30"><div class="controltext">Email:</div>
</TD><TD>
<input type="text" name="email" value="<?php echo htmlspecialchars($rowGetUser->EMAIL);?>">
</TD></TR>

			<tr>
			<td height="30"><div class="controltext">Personal Website:</div>
</TD><TD>
<input type="text" name="personal_website" value="<?php echo htmlspecialchars($rowGetUser->PERSONAL_WEBSITE);?>"><BR>
<NOBR><FONT SIZE="-1">(e.g. https://www.BostonApartments.com)</FONT></NOBR>
</TD></TR>


			</table>


</TD></TR>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	
<!--	<tr>
	<td align="right" valign="top"><span class="controltext">Use software Version</span></td>
	<td valign="top">1.0<input type="radio" name="use_version" value="1" <?php if ($rowGetUser->USE_VERSION==1) { echo " checked "; }?> > 2.0<input type="radio" name="use_version" value="2" <?php if ($rowGetUser->USE_VERSION==2) { echo " checked "; }?>></td>
	</tr>
	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr> -->

	<tr>
	<td align="right" valign="top"><span class="controltext"><B>Default View for Listings:</B></span></td>
	<td valign="top">



<select style="background-color:white" name="listview">
<OPTION VALUE="">--</OPTION>

			<?php 

$quStrGetViews = "SELECT * FROM VIEWS WHERE GRID=$grid OR PUBLIC=1 ORDER BY NAME";
$quGetViews = mysqli_query($dbh, $quStrGetViews) or die ($quStrGetViews);
$quStrGetView = "SELECT * FROM VIEWS WHERE ID=$vid AND (GRID='$grid' OR PUBLIC=1)";
$quGetView = mysqli_query($dbh, $quStrGetView);
$rowGetView = mysqli_fetch_array($quGetView);


			mysqli_data_seek ($quGetViews, 0);
			while ($rowGetViews = mysqli_fetch_object($quGetViews)) {?>
			<?php if ($rowGetViews->ID!=9 || $agcy>0) { ?>
				<option value="<?php echo $rowGetViews->ID;?>" <?php if ($rowGetUser->LISTVIEW==$rowGetViews->ID) { echo " selected "; }?>><?php echo $rowGetViews->NAME;?></option>
			<?php } ?>
			<?php } ?>
			</select></NOBR></div>
			

</td>
	</tr>



	<tr>
	<td align="right" valign="top"><span class="controltext"><B>Default Search For Listings:</B></span></td>
	<td valign="top">

<select style="background-color:white" name="listsearch">
<OPTION VALUE="small" <?php if ($rowGetUser->LISTSEARCH=="small") { echo " selected "; }?>>Simple</OPTION>
<OPTION VALUE="big" <?php if ($rowGetUser->LISTSEARCH=="big") { echo " selected "; }?>>Full</OPTION>
<OPTION VALUE="mobile" <?php if ($rowGetUser->LISTSEARCH=="mobile") { echo " selected "; }?>>Mobile</OPTION>
<OPTION VALUE="none" <?php if ($rowGetUser->LISTSEARCH=="none") { echo " selected "; }?>>none</OPTION>
</select></NOBR></div>

</td>
	</tr>

	<tr>
	<td align="right" valign="top"><span class="controltext"><B>Show Search form on results:</B></span></td>
	<td valign="top">
<select style="background-color:white" name="listsearchshow">
<OPTION VALUE="n" <?php if ($rowGetUser->LISTSEARCHSHOW=="n") { echo " selected "; }?>>No</OPTION>
<OPTION VALUE="y" <?php if ($rowGetUser->LISTSEARCHSHOW=="y") { echo " selected "; }?>>Yes</OPTION>
</select></NOBR></div>
</td>
	</tr>

	<tr>
	<td align="right" valign="top"><span class="controltext"><B>Default Only Available <img src="../assets/images/icons/a.jpg" border=0 height=14 width=14>
 Listings:</B></span></td>
<td valign="top">
<select style="background-color:white" name="listactive">
<OPTION VALUE="y" <?php if ($rowGetUser->LISTACTIVE=="y") { echo " selected "; }?>>Yes</OPTION>
<OPTION VALUE="n" <?php if ($rowGetUser->LISTACTIVE=="n") { echo " selected "; }?>>No</OPTION>
</select></NOBR>
</td>
	</tr>



	<td align="right" valign="top"><span class="controltext"><B>Show shared clients in the Hot List:</B></span></td>
<td valign="top">
<select style="background-color:white" name="listsharedc">
<OPTION VALUE="y" <?php if ($rowGetUser->LISTSHAREDC=="y") { echo " selected "; }?>>Yes</OPTION>
<OPTION VALUE="n" <?php if ($rowGetUser->LISTSHAREDC=="n") { echo " selected "; }?>>No</OPTION>
</select></NOBR>
</td>
	</tr>


	<td align="right" valign="top"><span class="controltext"><B>Show shared listings in the Hot List:</B></span></td>
<td valign="top">
<select style="background-color:white" name="listsharedl">
<OPTION VALUE="y" <?php if ($rowGetUser->LISTSHAREDL=="y") { echo " selected "; }?>>Yes</OPTION>
<OPTION VALUE="n" <?php if ($rowGetUser->LISTSHAREDL=="n") { echo " selected "; }?>>No</OPTION>
</select></NOBR>
</td>
	</tr>


	<tr>
	<td align="right" valign="top"><span class="controltext"><B>Get a CC of emails you send:</B></span></td>
	<td valign="top">
<select style="background-color:white" name="emailbcc">
<OPTION VALUE="n" <?php if ($rowGetUser->EMAILBCC=="n") { echo " selected "; }?>>No</OPTION>
<OPTION VALUE="y" <?php if ($rowGetUser->EMAILBCC=="y") { echo " selected "; }?>>Yes</OPTION>
</select></NOBR>
</td>
	</tr>



	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>



	<tr>
	<td align="right" valign="top"><span class="controltext"><NOBR><B>Default View for editing and composing Listings/Ads:</B></NOBR></span></td>
	<td valign="top">Simple<input type="radio" name="pref_adl_view" value="1" <?php if ($rowGetUser->PREF_ADL_VIEW==1) { echo " checked "; }?> > Full<input type="radio" name="pref_adl_view" value="2" <?php if ($rowGetUser->PREF_ADL_VIEW==2) { echo " checked "; }?>></td>
	</tr>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="top"><span class="controltext"><B>Auto Update Landlord when linked listing is updated:</B></span></td>
	<td valign="top">No<input type="radio" name="pref_auto_update_landlord" value="0" <?php if ($rowGetUser->PREF_AUTO_UPDATE_LANDLORD==0) { echo " checked "; }?> > Yes<input type="radio" name="pref_auto_update_landlord" value="1" <?php if ($rowGetUser->PREF_AUTO_UPDATE_LANDLORD==1) { echo " checked "; }?>></td>
	</tr>

	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="top"><span class="controltext"><B>Default View for Manage Clients:</B></span></td>
	<td valign="top">All Clients<input type="radio" name="pref_all_clients" value="0" <?php if ($rowGetUser->PREF_ALL_CLIENTS==0) { echo " checked "; }?> > Only Active Clients<input type="radio" name="pref_all_clients" value="1" <?php if ($rowGetUser->PREF_ALL_CLIENTS==1) { echo " checked "; }?>></td>
	</tr>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>

<tr>
	<td align="right" valign="top"><span class="controltext"><NOBR><LI><B><A HREF="<?php echo "$PHP_SELF?op=editColors";?>" TITLE="Click to Change the System Colors">Color Preferences - Click to Change</A></B></NOBR></span></td>
	<td valign="top">
<span class="controltext">
&nbsp;
</SPAN></td>
	</tr>



	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>


<?php if ($rowGetGroup->CL_AGENTS != 0) {?>
	<tr>
	<td colspan="2">
<li><B><a href="<?php echo "$PHP_SELF?op=cl_settings_nowysiwyg_agent";?>">Craigslist & Agent Templates &amp; Settings - Click to Change</a></B></li>

&nbsp;</td>
	</tr>
	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
<?php }?>



	<tr>
	<td align="right" width="50%" valign="top"><span class="controltext">Agent Biography<BR><P>(to be displayed optionally on the Meet The Agents Page)<BR>
<P><FONT SIZE="-2">
<A HREF="<?php echo "$PHP_SELF?op=editPrefs-wysiwyg"; ?>">If you want to use a WYSIWYG HTML editor to control the bio, Click Here</A></FONT>
</span>



</td>
	<td valign="top"><textarea name="bio" rows="15" cols="45"><?php echo htmlspecialchars($rowGetUser->BIO);?></textarea><br></td>
	</tr>
	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>





	<tr>
	<td colspan="2" align="center">

<FONT SIZE="-1" color=red><I>(You have to log out an log back in for some of the changes<BR>to your preferences to take place after you save.)</I></FONT><BR>
<input type="submit" value=" Save Agent Preferences " STYLE="Background-Color : #adffad ;"></td>
	</tr>
	</table>
	</form>

<P>


<!--BEGIN upload agent pic-->
		<table border="0" cellspacing="0" cellpadding="0" align="center" width="200">
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td align="center" bgcolor="#FFFFFF" width="50%">
				<table>
				<tr>
				
				<td align="center" height="30"><div class="controltext">Upload Agent Picture for <?php echo $handle;?></div></td>
				</tr>
				</table>
		</td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<form enctype="multipart/form-data" action="<?php echo "$PHP_SELF?op=uploadagentPreview";?>" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="10750000">
		<input type="hidden" name="uid" value="<?php echo $uid; ?>">
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td width="50%" bgcolor="#FFFF99" align="center">
			<table align="center" border="0">
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Send this file: <input name="userfile" type="file" STYLE="Background-Color : #E0FFFF" ></div></td>
			</tr>
			<tr>
			<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext"><input type="submit" value="Upload / Update Agent Picture" STYLE="Background-Color : #E0FFFF;">
</FORM>
<P><BR><P>


<?php if ($rowGetUser->PICEXT != "") {?>

		<form action="<?php echo "$PHP_SELF?op=deleteagentPicDo"; ?>" method="POST">
		<input type="hidden" name="handle" value="<?php echo $handle;?>">
		<input type="hidden" name="uid" value="<?php echo $uid;?>">
		<input type="hidden" name="ext" value="<?php echo $rowGetUser->PICEXT;?>">
		<input type="submit" value="Delete Agent Picture" STYLE="Background-Color : #F5A9A9;">
		</FORM>

<?php }?>

</TD><TD>


<?php if ($rowGetUser->PICEXT != "") {?>
<IMG SRC="https://www.BostonApartments.com/pics/<?php echo $rowGetUser->HANDLE;?>.<?php echo $rowGetUser->PICEXT;?>">
<?php }?>

</div></td>
			</tr>
			</table></td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		</form>
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		</table>
		<br>
<!-- END upload agent pic -->




	</div>
	</center>
	<br>
<!--END editPrefs -->