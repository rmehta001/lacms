<!--BEGIN editUser -->
<?php

if(isset($_SESSION['pref_pagebg'])){
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor= $_SESSION['pref_pagebg'];
}
?>
	<br>

	<table border="0" cellspacing="0" cellpadding="0" width="80%" BGCOLOR="<?php echo $pagebgcolor;?>">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">
		<table>
			<tr>
			<td height="30" width="500" align="center"><CENTER>


<B>EDIT AGENT</B><BR>

Username: <?php if(isset($rowGetUser)) echo $rowGetUser->HANDLE;?> - Agent ID# <?php if(isset($rowGetUser)) echo $rowGetUser->UID;?><BR>

<?php
if (isset ($rowGetUser))
{
$quStrGetLLogin = "SELECT * FROM `SESSIONS` WHERE `UID`=$rowGetUser->UID ORDER BY `TIMEIN` DESC LIMIT 0,1";
	$quGetLLogin = mysqli_query($dbh, $quStrGetLLogin) or die ($quStrGetLLogin);
	$rowGetLLogin=mysqli_fetch_object($quGetLLogin);
}

?>

<FONT SIZE="-1">Last Login:  <?php
if (isset ($rowGetLLogin))
{
if ($rowGetLLogin->TIMEIN) {

echo  substr ($rowGetLLogin->TIMEIN, 0, 10) ." at ". substr ($rowGetLLogin->TIMEIN, 11, 8) ."<BR>" ;
}
} else {
echo "This Agent has never logged in!<BR>" ;
}
?>
<BR></FONT>

<TABLE border=0><TR><TD valign="top">

	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">
        
	<input type="hidden" name="user" value="<?php if (isset ($rowGetUser)) echo $rowGetUser->UID;?>">
	<input type="submit" value="View <?php if (isset ($rowGetUser)) echo $rowGetUser->HANDLE;?>'s listings" STYLE="Background-Color : #E0FFFF">
	
</TD></form><TD valign="top">


	<form action="<?php echo "$PHP_SELF?op=editUserDo";?>" method="POST">
	<input type="hidden" name="uid" value="<?php echo $euid;?>">
	<input type="hidden" name="agenthandle" value="<?php if (isset ($rowGetUser)) echo $rowGetUser->HANDLE;?>"><input type="submit" value=" Save Agent <?php if (isset ($rowGetUser)) echo $rowGetUser->HANDLE;?>'s Settings " STYLE="Background-Color : #adffad"><BR><BR>
	</TD></TR></TABLE>
	
	
<?php
	$quStrGetAgencies = "SELECT * FROM AGENCIES WHERE GID=$grid";
	$quGetAgencies = mysqli_query($dbh, $quStrGetAgencies) or die ($quStrGetAgencies);
	$num_agencies=mysqli_num_rows($quGetAgencies);
	if($num_agencies>0)
	{

echo "Agent Assigned to Agency: ";?>

<select name="eagency" STYLE="Background-Color : #FFFFFF">
<option value=""><?php if (isset ($group)) echo $group;?></option>

	<?php while($rowAgency = mysqli_fetch_object($quGetAgencies)) { ?>


		<option value="<?php if (isset ($rowAgency)) echo $rowAgency->AGENCY_ID;?>"<?php if (isset ($rowGetUser)) if (isset ($rowAgency)) if ($rowAgency->AGENCY_ID=="$rowGetUser->AGENCY") { echo " selected"; } ?> >
					<?php if (isset ($rowAgency)) echo $rowAgency->AGENCY_NAME;?></option>
				<?php } ?>
			</select>
				<?php } ?>


</CENTER>
</td>
			</tr>
			</table>

	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">




		<table WIDTH="500">
			<tr>
			<td height="30" VALIGN="TOP"><div class="controltext">Password: <FONT SIZE=-2 color=red>(20 chars Max)</FONT></div><input type="text" name="password" value="<?php if (isset ($rowGetUser)) echo $rowGetUser->PASS;?>">

<BR>
<div class="controltext">Email:</div><input type="text" name="email" value="<?php if (isset ($rowGetUser)) echo htmlspecialchars($rowGetUser->EMAIL);?>">

<BR>
<div class="controltext">
Agent Type:<br><select id="agent_type" name="agent_type" STYLE="Background-Color : #FFFFFF">
	<option value="" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE=="") { echo " selected"; }?> >No Preference</option>
	<option value="1" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE==1) { echo " selected"; }?> >Rentals</option>
	<option value="2" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE==2) { echo " selected"; }?> >Sales
	<option value="3" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE==3) { echo " selected"; }?> >Commercial Sales
	<option value="4" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE==4) { echo " selected"; }?> >Commercial Rentals
	<option value="5" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE==5) { echo " selected"; }?> >Parking Spaces
	<option value="8" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE==8) { echo " selected"; }?> >Vacations
	<option value="9" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE==9) { echo " selected"; }?> >Rent To Own		
	<option value="10" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE==10) { echo " selected"; }?> >Business Opportunities
	<option value="11" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE==13) { echo " selected"; }?> >Senior Rentals
	<option value="12" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE==12) { echo " selected"; }?> >Senior Sales
	<option value="13" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE==13) { echo " selected"; }?> >Bank Owned
</div>




</td>

<td height="30" align="center" VALIGN="TOP"><div class="controltext">User Signature:</div><textarea name="user_sig" cols="25" rows="6"><?php if (isset ($rowGetUser)) echo $rowGetUser->USER_SIG;?></textarea></td>

			</tr>
			</table>

			<table>
			<tr>
			<td align="center" height="30"><div class="controltext">Agent Access Level:</div><div class="controltext"><NOBR>0<input type="radio" name="level" value="0.0" <?php if (isset ($rowGetUser)) if ($rowGetUser->USER_LEVEL==0) { echo " checked "; }?>> 0.25<input type="radio" name="level" value="0.25" <?php if (isset ($rowGetUser)) if ($rowGetUser->USER_LEVEL=="0.25") { echo " checked "; }?>> 0.5<input type="radio" name="level" value="0.5" <?php if (isset ($rowGetUser)) if ($rowGetUser->USER_LEVEL=="0.5") { echo " checked "; }?>> 1<input type="radio" name="level" value="1" <?php if (isset ($rowGetUser)) if ($rowGetUser->USER_LEVEL==1) { echo " checked "; }?>> 2<input type="radio" name="level" value="2" <?php if (isset ($rowGetUser)) if ($rowGetUser->USER_LEVEL==2) { echo " checked "; } ?>> 3<input type="radio" name="level" value="3" <?php if (isset ($rowGetUser)) if ($rowGetUser->USER_LEVEL==3) { echo " checked "; }?>> 4<input type="radio" name="level" value="4" <?php if (isset ($rowGetUser)) if ($rowGetUser->USER_LEVEL==4) { echo " checked "; }?>> 10<input type="radio" name="level" value="10" <?php if (isset ($rowGetUser)) if ($rowGetUser->USER_LEVEL==10) { echo " checked "; }?>></NOBR><BR><font size=-2 color=red>See below for explanation</font></div></td>
			</tr></TABLE>
			
			
			<CENTER><table><tr><td VALIGN="BOTTOM">
<div class="controltext"><NOBR>IP Restricted: <input type="checkbox" name="user_restrict_ip" value="1" <?php if (isset ($rowGetUser)) if ($rowGetUser->USER_RESTRICT_IP==1) { echo " checked "; }?></NOBR><BR><NOBR><FONT SIZE=-3>(Check For Yes)</FONT></NOBR></DIV></TD><TD VALIGN="BOTTOM"><div class="controltext"><NOBR>IP Address: <input type="text" name="user_restrict_ip_address" value="<?php if (isset ($rowGetUser)) echo $rowGetUser->USER_RESTRICT_IP_ADDRESS;?>"></NOBR><BR><NOBR><FONT SIZE=-3>(detected IP is: <?php echo $_SERVER['REMOTE_ADDR'];?>)</FONT></NOBR></DIV>
</td></tr></table>
</CENTER>

<FONT SIZE="-3"><BR></FONT>

<div class="controltext">
    Display Agent in "Meet The Agents"?: &nbsp;Yes<input type="radio" name="meetagents" value="1" <?php if (isset ($rowGetUser)) if ($rowGetUser->MEETAGENTS) {echo " checked "; } ?>> No<input type="radio" name="meetagents" value="0" checked > 
<FONT SIZE="-3"><BR></FONT>

Display Order of Agent in "Meet The Agents"?: <input type="text" name="meetorder" value="<?php if (isset ($rowGetUser)) echo $rowGetUser->MEETORDER ;?>" SIZE=2></DIV>
<FONT SIZE="-3"><BR></FONT>

			

	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">


		<table BORDER=0>
			<tr>

			<td height="30"><div class="controltext">First Name:</DIV>

</TD><TD>
<input type="text" name="fname" value="<?php if (isset ($rowGetUser)) echo $rowGetUser->FNAME;?>"></td>
			</tr>

			<tr>
			<td height="30"><div class="controltext">Last Name:</DIV>
</TD><TD>
<input type="text" name="lname" value="<?php if (isset ($rowGetUser)) echo $rowGetUser->LNAME;?>"></td>
			</tr>

			<tr>
			<td height="30"><div class="controltext">Position:</DIV>
</TD><TD>
<input type="text" name="position" value="<?php if (isset ($rowGetUser)) echo $rowGetUser->POSITION;?>"></td>
			</tr>
                        

			<tr>
			<td height="30"><div class="controltext">Cell Phone:</DIV>
</TD><TD>
<input type="text" name="cellphone" value="<?php if (isset ($rowGetUser))  echo $rowGetUser->CELLPHONE;?>"></td>
			</tr>

			<tr>
			<td height="30"><div class="controltext">Direct Line:</DIV>
</TD><TD>
<input type="text" name="directline" value="<?php if (isset ($rowGetUser)) echo $rowGetUser->DIRECTLINE;?>"></td>
			</tr>

			<tr>
			<td height="30"><div class="controltext">Personal Website:</DIV>
</TD><TD>
<input type="text" name="personal_website" value="<?php if (isset ($rowGetUser)) echo htmlspecialchars($rowGetUser->PERSONAL_WEBSITE);?>"><BR>
<font size=-2 color=red>(e.g. https://www.BostonApartments.com)</FONT></td>
			</tr>




			<tr>
			<td height="30"><div class="controltext">Facebook:</DIV>
</TD><TD>
<input type="text" name="facebook" value="<?php if (isset ($rowGetUser)) echo htmlspecialchars($rowGetUser->FACEBOOK);?>"><BR>
<font size=-2 color=red>(e.g. http://www.facebook.com/pagename)</FONT></td>
			</tr>
			<tr>
			<td height="30"><div class="controltext">Twitter:</DIV>
</TD><TD>
<input type="text" name="twitter" value="<?php if (isset ($rowGetUser)) echo htmlspecialchars($rowGetUser->TWITTER);?>"><BR>
<font size=-2 color=red>(e.g. http://www.Twitter.com/feedname)</FONT></td>
			</tr>
			<tr>
			<td height="30"><div class="controltext">MySpace:</DIV>
</TD><TD>
<input type="text" name="myspace" value="<?php if (isset ($rowGetUser)) echo htmlspecialchars($rowGetUser->MYSPACE);?>"><BR>
<font size=-2 color=red>(e.g. http://www.myspace.com/pagename)</FONT></td>
			</tr>


			<tr>
			<td height="30"><div class="controltext">LinkedIn:</DIV>
</TD><TD>
<input type="text" name="linkedin" value="<?php if (isset ($rowGetUser)) echo htmlspecialchars($rowGetUser->LINKEDIN);?>"><BR>
<font size=-2 color=red>(e.g. http://www.linkedin.com/pagename)</FONT></td>
			</tr>
                        
                         <tr>
			<td height="30"><div class="controltext">Service Location:</DIV>
</TD><TD>
&nbsp; Yes &nbsp;<input type="radio" name="ser_location" value="0" checked > &nbsp;&nbsp; No &nbsp;<input type="radio" name="ser_location" value="1"></td>
			</tr>

			</table>




<TABLE><TR>

	<td align="right" width="125" valign="top"><span class="controltext">Agent Biography:<BR><FONT SIZE="-1" COLOR="RED">(to be displayed optionally on the "Meet The Agents" Page. HTML is OK)</FONT>
<P><FONT SIZE="-2">
<A HREF="<?php if (isset ($rowGetUser)) echo "$PHP_SELF?op=editUser-wysiwyg&uid=" . $rowGetUser->UID; ?>">If you want to use a WYSIWYG HTML editor to control the bio, Click Here</A></FONT></span>
</TD><TD>
<textarea name="bio" rows="15" cols="50"><?php if (isset ($rowGetUser)) echo htmlspecialchars($rowGetUser->BIO);?></textarea><br>
</TD></TR></TABLE>



<TABLE><TR>
	<td align="right" width="125" valign="top"><span class="controltext">Craigslist, Kijiji &amp; Dig Agent Header:<BR><FONT SIZE="-1" COLOR="RED">(to be displayed optionally Agent posted ads. HTML is OK)</FONT>
<P><FONT SIZE="-2">
<A HREF="<?php if (isset ($rowGetUser)) echo "$PHP_SELF?op=editUser-wysiwyg&uid=" . $rowGetUser->UID; ?>">If you want to use a WYSIWYG HTML editor to control the header, Click Here</A></FONT></span>
</TD><TD>
<textarea name="CL_HEADERU" rows="15" cols="50"><?php if (isset ($rowGetUser)) echo htmlspecialchars($rowGetUser->CL_HEADERU);?></textarea><br>
</TD></TR></TABLE>


<TABLE><TR>
	<td align="right" width="125" valign="top"><span class="controltext">Craigslist, Kijiji &amp; Dig Agent Footer:<BR><FONT SIZE="-1" COLOR="RED">(to be displayed optionally Agent posted ads. HTML is OK)</FONT>
<P><FONT SIZE="-2">
<A HREF="<?php if (isset ($rowGetUser)) echo "$PHP_SELF?op=editUser-wysiwyg&uid=" . $rowGetUser->UID; ?>">If you want to use a WYSIWYG HTML editor to control the header, Click Here</A></FONT></span>
</TD><TD>
<textarea name="CL_FOOTERU" rows="15" cols="50"><?php if (isset ($rowGetUser)) echo htmlspecialchars($rowGetUser->CL_FOOTERU);?></textarea><br>
</TD></TR></TABLE>


	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">

&nbsp;

	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">
		<table>
			<tr>
			<td height="30"  ALIGN=CENTER>
<P>
<input type="submit" value=" Save Agent <?php if (isset ($rowGetUser)) echo $rowGetUser->HANDLE;?>'s Settings " STYLE="Background-Color : #adffad">
</form>
<P>



</td>
			</tr>
<TR><TD>


<?php if (isset ($rowGetUser)) 
    if ($rowGetUser->PICEXT != "") {?>

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
				
				<td align="center" height="30"><div class="controltext">Agent Picture for <?php echo $_SESSION['handle'];?></div></td>
				</tr>
				</table>
		</td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
<!--		<form enctype="multipart/form-data" action="<?php echo "$PHP_SELF?op=uploadagentPreview";?>" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="10750000">
		<input type="hidden" name="uid" value="<?php echo $uid; ?>">
		<input type="hidden" name="returnpage" value="editUser"> -->
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td width="50%" align="center">
			<table align="center" border="0">
<!--			<tr>
			<td height="30"><div class="controltext">Send this file: <input name="userfile" type="file" STYLE="Background-Color : #E0FFFF" ></div></td>
			</tr> -->
			<tr>
			<td align="center" height="30"><div class="controltext">
<!--
<input type="submit" value="Upload / Update Agent Picture" STYLE="Background-Color : #E0FFFF;">
</FORM> -->
<P><BR><P>


<?php if (isset ($rowGetUser))  if ($rowGetUser->PICEXT != "") {?>

		<form action="<?php echo "$PHP_SELF?op=deleteagentPicDo"; ?>" method="POST">
		<input type="hidden" name="handle" value="<?php echo $handle;?>">
		<input type="hidden" name="uid" value="<?php echo $uid;?>">
		<input type="hidden" name="ext" value="<?php echo $rowGetUser->PICEXT;?>">
		<input type="submit" value="Delete Agent Picture" STYLE="Background-Color : #F5A9A9;">
		</FORM>

<?php }?>

</TD><TD>


<?php if (isset ($rowGetUser)) 
    if ($rowGetUser->PICEXT != "") {?>
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


<?php } else {echo "&nbsp;";}?>



</TD></TR>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>	

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">


		<table BGCOLOR="#FFFFFF">
			<tr>
			<td height="30"  bgcolor="#FFFFFF"><div class="ad">Access</div></td>
      			<td height="30"  bgcolor="#FFFFFF"><div class="ad">Level Rights:</div></td>
      			</tr>
      			<tr>
      			<td height="30"  bgcolor="#FFFFFF"><div class="ad"> &nbsp; <B>0</B></div></td>
      			<td height="30"  bgcolor="#FFFFFF"><div class="ad">Has no Access to Landlords and cannot edit them, Can only view listings and not save them, Cannot access photo manipulations or printouts. May Post to Craigslist, Facebook, Twitter.</div></td>
      			</tr>
				
				<tr>
      			<td height="30"  bgcolor="#FFFFFF"><div class="ad"> &nbsp; <B>0.25</B></div></td>
      			<td height="30"  bgcolor="#FFFFFF"><div class="ad">
      			<td height="30"><div class="ad">Has Access to view Landlords (no edit), Can only view listings and not save them, Cannot access photo manipulations or printouts, Can use the Clients and Hot List functions. This level cannot create or delete anything except personal hotlists. May Post to Craigslist, Facebook, Twitter.</div></td>
      			</tr>
      			
      			<tr>
      			<td height="30"  bgcolor="#FFFFFF"><div class="ad"> &nbsp; <B>0.5</B></div></td>
      			<td height="30"  bgcolor="#FFFFFF"><div class="ad">Has Access to Landlords but can not edit them (Can add landlords to the system), Can only view listings and not save them, Cannot access photo manipulations or printouts, Can use the Clients and Hot List functions. This level cannot create or delete anything except personal hotlists. May Post to Craigslist, Facebook, Twitter.</div></td>
      			</tr>
      			

      			<tr>
      			<td height="30"  bgcolor="#FFFFFF"><div class="ad"> &nbsp; <B>1</B></div></td>
      			<td height="30"  bgcolor="#FFFFFF"><div class="ad">Can compose, edit, activate and deactivate ads, Landlords, Listings Clients and Hot List functions. Can not delete anything except personal hotlists and clients. May Post to Craigslist, Facebook, Twitter.</div></td>
      			</tr>
      			<tr>
      			<td height="30"  bgcolor="#FFFFFF"><div class="ad"> &nbsp; <B>2</B></div></td>
      			<td height="30"  bgcolor="#FFFFFF"><div class="ad">Can compose, edit, activate, deactivate and delete ads, landlords and listings one at a time.</div></td>
    			</tr>
    			<tr>
    			<td height="30"  bgcolor="#FFFFFF"><div class="ad"> &nbsp; <B>3</B></div></td>
    			<td height="30"  bgcolor="#FFFFFF"><div class="ad">Can compose, edit, activate, deactivate and delete ads, landlords and listings one at a time, or in groups.</div></td>
    			</tr>
				
    			<tr>
    			<td height="30"  bgcolor="#FFFFFF"><div class="ad"> &nbsp; <B>4</B></div></td>
    			<td height="30"  bgcolor="#FFFFFF"><div class="ad">Can compose, edit, activate, deactivate and delete ads, landlords and listings one at a time, or in groups. Can use the Clients and Hot List functions. Also is allowed to assign a listing to a different agent in the simple view of Ads/Listings and as a global change. Can change the Agency/Office in a multi-agency office account.</div></td>
    			</tr>

    			<tr>
    			<td height="30"  bgcolor="#FFFFFF"><div class="ad"> &nbsp; <B>10</B></div></td>
    			<td height="30"  bgcolor="#FFFFFF"><div class="ad"><B>CAN DO EVERYTHING THE ADMIN CAN DO,</B> except back-up/download Listings, Clients &amp; Landlords.</div></td>
    			</tr>
				
  			</table>
  	</td>
  	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>	
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	
	<br>
	<br>
<!--END editUser -->
