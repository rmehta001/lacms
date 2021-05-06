<!--BEGIN createUser -->

<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
?>
	
	<b>CREATE A NEW AGENT</B>
	<br>
	<form action="<?php echo "$PHP_SELF?op=createUserDo";?>" method="POST">
	<table border="0" cellspacing="0" cellpadding="0" width="70%" BGCOLOR="<?php echo $pagebgcolor;?>">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">
		<table>
			<tr>
			<td height="30" width="90%" align="center" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Agent login names should be at least 5 characters long, but a maximum of <B>15</B>.<BR>
<P>
Passwords should be a minimum of <B>4</B> characters, maximum of <B>10</B>.<br>
<P>
Usernames and passwords can only contain alphanumeric characters;<BR>all letters, upper and lower case (a-z, A-Z) and digits 0-9 and <font color=red>no spaces</FONT>.<br>
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
			<td height="30"><div class="controltext">User name:</div><input type="text" name="new_handle" value="<?php echo $new_handle;?>"></td>
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
			<td height="30"><div class="controltext">Password:</div><input type="password" name="new_passwd"></td>
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
			<td height="30"><div class="controltext">Retype Password:</div><input type="password" name="conf_new_passwd"></td>
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
			<td height="30"><div class="controltext">First Name:</div><input type="text" name="fname" value="<?php echo $new_fname;?>"></td>
			</tr>

			<tr>
			<td height="30"><div class="controltext">Last Name:</div><input type="text" name="lname" value="<?php echo $new_lname;?>"></td>
			</tr>




			<tr>
			<td height="30"><div class="controltext">Email:</div><input type="text" name="email" value="<?php echo $new_email;?>"></td>
			</tr>



			<tr>
			<td height="30"><div class="controltext">Cell Phone:</div><input type="text" name="cellphone" value="<?php echo $new_cellphone;?>"></td>
			</tr>



			<tr>
			<td height="30"><div class="controltext">Direct line:</div><input type="text" name="directline" value="<?php echo $new_directline;?>"></td>
			</tr>

			<tr>
			<td height="30"><div class="controltext">Personal Website:</DIV>
<input type="text" name="personal_website" value="<?php echo $new_website;?>"><BR>
<font size=-2 color=red>(e.g. https://www.BostonApartments.com)</FONT></td>
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
			<td height="30" align="center"><div class="controltext">User Signature:</div><textarea name="user_sig" cols="40" rows="5"><?php echo $user_sig;?></textarea></td>
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

Display Order of Agent in "Meet The Agents"?: <input type="text" name="meetorder" value="<?php echo $new_meetorder ;?>" SIZE=2></DIV>
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
<option value=""><?php echo $group;?></option>

	<?php while($rowAgency = mysqli_fetch_object($quGetAgencies)) { ?>


		<option value="<?php echo $rowAgency->AGENCY_ID;?>">
					<?php echo $rowAgency->AGENCY_NAME;?></option>
				<?php } ?>
			</select>
				<?php } ?>
</TD></TR></TABLE>











		<table>
			<tr>
			<td align="center" height="30"><div class="controltext">Access Level:</div><div class="controltext">0<input type="radio" name="level" value="0"> 1<input type="radio" name="level" value="1" checked> 2<input type="radio" name="level" value="2"> 3<input type="radio" name="level" value="3"></div></td>
			</tr>
			<tr>
			<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext">See below for explanation</div></td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	
	<?php if ($ip_restrict) { ?>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">
		<table>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Restrict Login:</div><input type="hidden" name="restrict_ip" value="0"> <input type="checkbox" name="restrict_ip" value="1"></td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>	
	<?php } ?>
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
      			<td height="30"><div class="ad">Has no Access to Landlords, Can only view listings and not save them, Cannot access photo manipulations or printouts, Can use the Clients and Hot List functions. This level cannot create or delete anything except personal hotlists and clients.</div></td>
      			</tr>
      			<tr>
      			<td height="30"><div class="ad">1</div></td>
      			<td height="30"><div class="ad">Can compose, edit, activate and deactivate ads, Landlords, Listings Clients and Hot List functions. Can not delete anything except personal hotlists and clients.</div></td>
      			</tr>
      			<tr>
      			<td height="30"><div class="ad">2</div></td>
      			<td height="30"><div class="ad">Can compose, edit, activate, deactivate and delete ads, landlords and listings one at a time. Can use the Clients and Hot List functions.</div></td>
    			</tr>
    			<tr>
    			<td height="30"><div class="ad">3</div></td>
    			<td height="30"><div class="ad">Can compose, edit, activate, deactivate and delete ads, landlords and listings one at a time, or in groups. Can use the Clients and Hot List functions.</div></td>
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
	</tr>
	</table>
	</form>
	<br>
	<br>
	
	

<!--END createUser -->	