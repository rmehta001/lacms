<!--BEGIN createUser -->

<?php
$pref_pagebg = $_SESSION["pref_pagebg"]; 
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
?>
	
	<b>CREATE A NEW AGENT</B>
	<br>
	<form action="<?php echo "$PHP_SELF?op=createUserDo";?>" method="POST">
	<table border="0" cellspacing="0" cellpadding="0" width="80%" BGCOLOR="<?php echo $pagebgcolor;?>">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">
		<table>
			<tr>
			<td height="30" width="90%" align="center" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Agent login names should be at least 5 characters long, but a maximum of <B>15</B>.</NOBR>
<P>
Passwords should be a minimum of <B>4</B> characters, maximum of <B>20</B>.<br>
<P>
<H3>Usernames and passwords can only contain alphanumeric characters;<BR>all letters, upper and lower case (a-z, A-Z) and digits 0-9 and <font color=red>no spaces</B></FONT>.</H3>
<P>
Both login names and passwords are case-sensitive.<BR>
<P>
Once the Agent is created, the account may be customized further. (e.g. biography and picture)
</div>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">
		<table>
			<tr>
			<td height="30"><div class="controltext">User name:</div><input type="text" name="new_handle" value="<?php if (isset ($new_Handle))echo $new_handle;?>"></td>
			</tr>
			<tr>
			<td height="30"><div class="controltext">Password:</div><input type="password" name="new_passwd"></td>
			</tr>
			<tr>
			<td height="30"><div class="controltext">Retype Password:</div><input type="password" name="conf_new_passwd"></td>
			</tr>
			
			<tr>
			<td height="30"><div class="controltext">First Name:</div><input type="text" name="fname" value="<?php if (isset ($new_fname)) echo $new_fname;?>"></td>
			</tr>

			<tr>
			<td height="30"><div class="controltext">Last Name:</div><input type="text" name="lname" value="<?php if (isset ($new_lname)) echo $new_lname;?>"></td>
			</tr>




			<tr>
			<td height="30"><div class="controltext">Email:</div><input type="text" name="email" value="<?php if (isset ($new_email)) echo $new_email;?>"></td>
			</tr>



			<tr>
			<td height="30"><div class="controltext">Cell Phone:</div><input type="text" name="cellphone" value="<?php if (isset ($new_cellphone)) echo $new_cellphone;?>"></td>
			</tr>



			<tr>
			<td height="30"><div class="controltext">Direct line:</div><input type="text" name="directline" value="<?php if (isset ($new_directline)) echo $new_directline;?>"></td>
			</tr>

			<tr>
			<td height="30"><div class="controltext">Personal Website:</DIV>
<input type="text" name="personal_website" value="<?php if (isset ($new_website)) echo $new_website;?>"><BR>
<font size=-2 color=red>(e.g. https://www.BostonApartments.com)</FONT></td>
			</tr>


			<tr>
			<td height="30"><div class="controltext">Facebook:</div><input type="text" name="facebook" value="<?php if (isset ($new_facebook)) echo $new_facebook;?>"><BR>
<font size=-2 color=red>(e.g. http://www.facebook.com/pagename)</FONT></td>
			</tr>


			<tr>
			<td height="30"><div class="controltext">Twitter:</div><input type="text" name="twitter" value="<?php if (isset ($new_twitter)) echo $new_twitter;?>"><BR>
<font size=-2 color=red>(e.g. http://www.Twitter.com/feedname)</FONT></td>
			</tr>


			<tr>
			<td height="30"><div class="controltext">MySpace:</div><input type="text" name="myspace" value="<?php if (isset ($new_myspace)) echo $new_myspace;?>"><BR>
<font size=-2 color=red>(e.g. http://www.myspace.com/pagename)</FONT></td>
			</tr>


			<tr>
			<td height="30"><div class="controltext">LinkedIn:</div><input type="text" name="linkedin" value="<?php if (isset ($new_linkedin)) echo $new_linkedin;?>"><BR>
<font size=-2 color=red>(e.g. http://www.linkedin.com/pagename)</FONT></td>
			</tr>


			<tr>
			<td height="30"><div class="controltext">Position:</div><input type="text" name="position" value="<?php if (isset ($new_position)) echo $new_position;?>"></td>
			</tr>

                        <tr>
                            <td height="30"><div class="controltext">Service Location:</div> Yes &nbsp;<input type="radio" name="ser_location" value="0" checked > &nbsp;&nbsp; No &nbsp;<input type="radio" name="ser_location" value="1"></td>
			</tr>


			</table>




	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">
		<table>
			<tr>
			<td height="30" align="center"><div class="controltext">User Signature:</div><textarea name="user_sig" cols="40" rows="5"><?php if (isset ($user_sig)) echo $user_sig;?></textarea></td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">








<TABLE><TR><TD>

<FONT SIZE="-3"><BR></FONT>

<div class="controltext">
Display Agent in "Meet The Agents"?: No<input type="radio" name="meetagents" value="0" checked > Yes<input type="radio" name="meetagents" value="1">
<FONT SIZE="-3"><BR></FONT>

Display Order of Agent in "Meet The Agents"?: <input type="text" name="meetorder" value="<?php if (isset ($new_meetorder)) echo $new_meetorder ;?>" SIZE=2></DIV>
<FONT SIZE="-3"><BR></FONT>
</TD></TR></TABLE>













<TABLE><TR><TD>
<?php
	$quStrGetAgencies = "SELECT * FROM AGENCIES WHERE GID=$grid";
	$quGetAgencies = mysqli_query($dbh, $quStrGetAgencies) or die ($quStrGetAgencies);
	$num_agencies=mysqli_num_rows($quGetAgencies);
	if($num_agencies>0)
	{

echo "Assign Agent to Agency: ";?>

<select name="eagency" STYLE="Background-Color : #FFFFFF">
<option value=""><?php echo $_SESSION["group"];?></option>

	<?php while($rowAgency = mysqli_fetch_object($quGetAgencies)) { ?>


		<option value="<?php echo $rowAgency->AGENCY_ID;?>">
					<?php echo $rowAgency->AGENCY_NAME;?></option>
				<?php } ?>
			</select>
				<?php } ?>
</TD></TR></TABLE>

<CENTER><TABLE><TR>

	<td align="right"><span class="controltext"><B>Agent Type for Default Listings:</B></span></td>
	<td valign="top">


<div class="controltext">
<select id="agent_type" name="agent_type" STYLE="Background-Color : #FFFFFF">
	<option value="1" <?php if (isset ($rowGetUser)) if ($rowGetUser->AGENT_TYPE==1 or $rowGetUser->AGENT_TYPE=="") { echo " selected"; }?> >Rentals</option>
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
</SELECT>
	
	</div>




</TD></TR><TR>

	<td align="right"><span class="controltext"><B>Default Source for Listings:</B></span></td>
	<td valign="top">


<div class="controltext">

	<select style="background-color:white" name="sourcepref">
<OPTION VALUE="$grid" <?php if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREF=="$grid") { echo " selected "; }?>>Our Office Only</OPTION>
<OPTION VALUE="1075" <?php if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREF=="1075") { echo " selected "; }?>>MLS + Office</OPTION>
<OPTION VALUE="1075A" <?php if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREF=="1075A") { echo " selected "; }?>>MLS Only</OPTION>
<OPTION VALUE="BA" <?php if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREF=="BA") { echo " selected "; }?>>BostonApts Only</OPTION>
<OPTION VALUE="YGL" <?php if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREF=="YGL") { echo " selected "; }?>>YGL Only</OPTION>
<OPTION VALUE="ALL" <?php if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREF=="ALL") { echo " selected "; }?>>ALL Sources
</select>
	
	
	
	
	</div>

</TD><TR>
</TABLE>


<table><tr><td VALIGN="BOTTOM">
<div class="controltext"><NOBR>Restrict IP: <input type="checkbox" name="user_restrict_ip" value="1"></NOBR><BR><NOBR><FONT SIZE=-3>(Check For Yes)</FONT></NOBR></DIV></TD><TD VALIGN="BOTTOM"><div class="controltext"><NOBR>IP Address: <input type="text" name="user_restrict_ip_address" value=""></NOBR><BR><NOBR><FONT SIZE=-3>(detected IP is: <?php echo $_SERVER['REMOTE_ADDR'];?>)</FONT></NOBR></DIV>
</td></tr></table>
</CENTER>

		<table>
			<tr>
			<td align="center" height="30"><div class="controltext">Access Level:</div><div class="controltext">0<input type="radio" name="level" value="0.0"> 0.25<input type="radio" name="level" value="0.25"> 0.5<input type="radio" name="level" value="0.5"> 1<input type="radio" name="level" value="1" checked> 2<input type="radio" name="level" value="2"> 3<input type="radio" name="level" value="3">  4<input type="radio" name="level" value="4"> 10<input type="radio" name="level" value="10"></div></td>
			</tr>
			<tr>
			<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext">See below for explanation</div></td>
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
	<td align="center" bgcolor="#FFFF99">
		<table BGCOLOR="#FFFFFF" WIDTH="100%">
			<tr>
			<td height="30"><div class="ad">Level</div></td>
      			<td height="30"><div class="ad">Access Rights:</div></td>
      			</tr>
      			<tr>
      			<td height="30"><div class="ad">0</div></td>
      			<td height="30"><div class="ad">Has no Access to Landlords, Can only view listings and not save them, Cannot access photo manipulations or printouts, Can use the Clients and Hot List functions. This level cannot create or delete anything except personal hotlists. May Post to Craigslist, Facebook, Twitter.</div></td>
      			</tr>
				
      			<tr>
      			<td height="30"><div class="ad">0.25</div></td>
      			<td height="30"><div class="ad">Has Access to view Landlords (no edit), Can only view listings and not save them, Cannot access photo manipulations or printouts, Can use the Clients and Hot List functions. This level cannot create or delete anything except personal hotlists. May Post to Craigslist, Facebook, Twitter.</div></td>
      			</tr>
				
      			<tr>
      			<td height="30"><div class="ad">0.5</div></td>
      			<td height="30"><div class="ad">
				Has Access to Landlords but can not edit them (Can add landlords to the system), Can only view listings and not save them, Cannot access photo manipulations or printouts, Can use the Clients and Hot List functions. This level cannot create or delete anything except personal hotlists. May Post to Craigslist, Facebook, Twitter.</div></td>
      			</tr>

      			<tr>
      			<td height="30"><div class="ad">1</div></td>
      			<td height="30"><div class="ad">Can compose, edit, activate and deactivate ads, Landlords, Listings Clients and Hot List functions. Can not delete anything except personal hotlists and clients. May Post to Craigslist, Facebook, Twitter.</div></td>
      			</tr>
      			<tr>
      			<td height="30"><div class="ad">2</div></td>
      			<td height="30"><div class="ad">Can compose, edit, activate, deactivate and delete ads, landlords and listings one at a time. Can use the Clients and Hot List functions.</div></td>
    			</tr>
    			<tr>
    			<td height="30"><div class="ad">3</div></td>
    			<td height="30"><div class="ad">Can compose, edit, activate, deactivate and delete ads, landlords and listings one at a time, or in groups. Can use the Clients and Hot List functions.</div></td>
    			</tr>

    			<tr>
    			<td height="30"><div class="ad">4</div></td>
    			<td height="30"><div class="ad">Can compose, edit, activate, deactivate and delete ads, landlords and listings one at a time, or in groups. Can use the Clients and Hot List functions. Also is allowed to assign a listing to a different agent in the simple view of Ads/Listings and as a global change. Can change the Agency/Office in a multi-agency office account.</div></td>
    			</tr>
				
    			<tr>
    			<td height="30"><div class="ad">10</div></td>
    			<td height="30"><div class="ad"><B>CAN DO EVERYTHING THE ADMIN CAN DO,</B> except back-up/download Listings, Clients &amp; Landlords.</div></td>
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
	<td align="center">
		<table>
			<tr>
			<td height="30"><input type="submit" value="Create Agent " STYLE="Background-Color : #E0FFFF"></td>
			</tr>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>	
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	<td valign="top" height="100%" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	
	</tr>
	</table>
	</form>
	<br>
	<br>
	
	

<!--END createUser -->	
