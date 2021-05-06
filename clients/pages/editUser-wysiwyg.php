<!--BEGIN editUser -->
	<br>



	<table border="0" cellspacing="0" cellpadding="0" width="65%">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">
		<table>
			<tr>
			<td height="30" width="500" align="center" bgcolor="#FFFF99"><CENTER>


<B>EDIT AGENT</B><BR>

Username: <?php echo $rowGetUser->HANDLE;?> - Agent ID# <?php echo $rowGetUser->UID;?>

	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="user" value="<?php echo $rowGetUser->UID;?>">
	<input type="submit" value="View <?php echo $rowGetUser->HANDLE;?>'s listings" STYLE="Background-Color : #E0FFFF">
	</form>



	<form action="<?php echo "$PHP_SELF?op=editUserDo";?>" method="POST">
	<input type="hidden" name="uid" value="<?php echo $euid;?>">
	<input type="hidden" name="agenthandle" value="<?php echo $rowGetUser->HANDLE;?>">



</CENTER>
</td>
			</tr>
			</table>

	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">




		<table WIDTH="400">
			<tr>
			<td height="30" bgcolor="#FFFF99" VALIGN="TOP"><div class="controltext">Password: <FONT SIZE=-2 color=red>(10 chars Max)</FONT></div><input type="text" name="password" value="<?php echo $rowGetUser->PASS;?>">

<BR>
<div class="controltext">Email:</div><input type="text" name="email" value="<?php echo $rowGetUser->EMAIL;?>">

<BR>
<div class="controltext">
Agent Type:<br><select id="AGENT_TYPE" name="AGENT_TYPE" STYLE="Background-Color : #FFFFFF">
	<option value="" <?php if ($rowGetUser->AGENT_TYPE=="") { echo " selected"; }?> >No Preference</option>
	<option value="1" <?php if ($rowGetUser->AGENT_TYPE==1) { echo " selected"; }?> >Rentals</option>
	<option value="2" <?php if ($rowGetUser->AGENT_TYPE==2) { echo " selected"; }?> >Sales
	<option value="3" <?php if ($rowGetUser->AGENT_TYPE==3) { echo " selected"; }?> >Commercial Sales
	<option value="4" <?php if ($rowGetUser->AGENT_TYPE==4) { echo " selected"; }?> >Commercial Rentals
	<option value="5" <?php if ($rowGetUser->AGENT_TYPE==5) { echo " selected"; }?> >Parking Spaces
	<option value="8" <?php if ($rowGetUser->AGENT_TYPE==8) { echo " selected"; }?> >Vacations
	<option value="9" <?php if ($rowGetUser->AGENT_TYPE==9) { echo " selected"; }?> >Rent To Own		
	<option value="10" <?php if ($rowGetUser->AGENT_TYPE==10) { echo " selected"; }?> >Business Opportunities
	<option value="11" <?php if ($rowGetUser->AGENT_TYPE==13) { echo " selected"; }?> >Senior Rentals
	<option value="12" <?php if ($rowGetUser->AGENT_TYPE==12) { echo " selected"; }?> >Senior Sales
	<option value="13" <?php if ($rowGetUser->AGENT_TYPE==13) { echo " selected"; }?> >Bank Owned
</div>


		<table>
			<tr>
			<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext">Agent Access Level:</div><div class="controltext">0<input type="radio" name="level" value="0" <?php if ($rowGetUser->USER_LEVEL==0) { echo " checked "; }?>> 1<input type="radio" name="level" value="1" <?php if ($rowGetUser->USER_LEVEL==1) { echo " checked "; }?>> 2<input type="radio" name="level" value="2" <?php if ($rowGetUser->USER_LEVEL==2) { echo " checked "; } ?>> 3<input type="radio" name="level" value="3" <?php if ($rowGetUser->USER_LEVEL==3) { echo " checked "; }?>><BR><font size=-2 color=red>See below for explanation</font></div></td>
			</tr>
			</table>


</td>

<td height="30" align="center" bgcolor="#FFFF99" VALIGN="TOP"><div class="controltext">User Signature:</div><textarea name="user_sig" cols="25" rows="6"><?php echo $rowGetUser->USER_SIG;?></textarea></td>

			</tr>
			</table>


	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">


		<table BORDER=0>
			<tr>

			<td height="30" bgcolor="#FFFF99"><div class="controltext">First Name:</DIV>

</TD><TD>
<input type="text" name="fname" value="<?php echo $rowGetUser->FNAME;?>"></td>
			</tr>

			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Last Name:</DIV>
</TD><TD>
<input type="text" name="lname" value="<?php echo $rowGetUser->LNAME;?>"></td>
			</tr>

			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Position:</DIV>
</TD><TD>
<input type="text" name="position" value="<?php echo $rowGetUser->POSITION;?>"></td>
			</tr>


			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Cell Phone:</DIV>
</TD><TD>
<input type="text" name="cellphone" value="<?php echo $rowGetUser->CELLPHONE;?>"></td>
			</tr>

			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Direct Line:</DIV>
</TD><TD>
<input type="text" name="directline" value="<?php echo $rowGetUser->DIRECTLINE;?>"></td>
			</tr>

			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Personal Website:</DIV>
</TD><TD>
<input type="text" name="personal_website" value="<?php echo $rowGetUser->PERSONAL_WEBSITE;?>"><BR>
<font size=-2 color=red>(e.g. https://www.BostonApartments.com)</FONT></td>
			</tr>
			</table>


<FONT SIZE="-3"><BR></FONT>

<div class="controltext">
Display Agent in "Meet The Agents"?: No<input type="radio" name="MEETAGENTS" value="0" checked > Yes<input type="radio" name="meetagents" value="1" <?php if ($rowGetUser->MEETAGENTS) {echo " checked "; } ?>>
<FONT SIZE="-3"><BR></FONT>

Display Order of Agent in "Meet The Agents"?: <input type="text" name="meetorder" value="<?php echo $rowGetUser->MEETORDER ;?>" SIZE=2></DIV>
<FONT SIZE="-3"><BR></FONT>

<TABLE><TR>
	<td align="right" width="125" valign="top"><span class="controltext">Agent Biography:<BR><FONT SIZE="-1" COLOR="RED">(to be displayed optionally on the "Meet The Agents" Page. HTML is OK)</FONT></span>
</TD><TD>
<textarea name="bio" id="bio" rows="15" cols="50"><?php echo htmlspecialchars($rowGetUser->BIO);?></textarea>
<script language="JavaScript">
   generate_wysiwyg('bio');
 </script>
<br>
</TD></TR></TABLE>




<TABLE><TR>
	<td align="right" width="125" valign="top"><span class="controltext">Craigslist, Kijiji &amp; Dig Agent Header:<BR><FONT SIZE="-1" COLOR="RED">(to be displayed optionally Agent posted ads. HTML is OK)</FONT>
<P><FONT SIZE="-2">
<A HREF="<?php echo "$PHP_SELF?op=editUser&uid=" . $rowGetUser->UID; ?>">If you don't want to use a WYSIWYG HTML editor to control the header, Click Here</A></FONT></span>
</TD><TD>
<textarea name="CL_HEADERU" id="CL_HEADERU" rows="15" cols="50"><?php echo htmlspecialchars($rowGetUser->CL_HEADERU);?></textarea>
<script language="JavaScript">
   generate_wysiwyg('CL_HEADERU');
 </script><br>
</TD></TR></TABLE>


<TABLE><TR>
	<td align="right" width="125" valign="top"><span class="controltext">Craigslist, Kijiji &amp; Dig Agent Footer:<BR><FONT SIZE="-1" COLOR="RED">(to be displayed optionally Agent posted ads. HTML is OK)</FONT>
<P><FONT SIZE="-2">
<A HREF="<?php echo "$PHP_SELF?op=editUser&uid=" . $rowGetUser->UID; ?>">If you don't want to use a WYSIWYG HTML editor to control the header, Click Here</A></FONT></span>
</TD><TD>
<textarea name="CL_FOOTERU" id="CL_FOOTERU" rows="15" cols="50"><?php echo htmlspecialchars($rowGetUser->CL_FOOTERU);?></textarea>
<script language="JavaScript">
   generate_wysiwyg('CL_FOOTERU');
 </script><br>
</TD></TR></TABLE>







	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">

&nbsp;

	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	
	<?php if ($ip_restrict) { ?>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">
		<table>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Restrict Login:</div><input type="hidden" name="restrict_ip" value="0"> <input type="checkbox" name="restrict_ip" value="1" <?php if ($rowGetUser->USER_RESTRICT_IP) { echo " checked "; } ?>></td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>	
	<?php } ?>

	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">
		<table>
			<tr>
			<td height="30"  bgcolor="#FFFF99" ALIGN=CENTER>
<P>
<input type="submit" value=" Save Agent <?php echo $rowGetUser->HANDLE;?>'s Settings " STYLE="Background-Color : #adffad">
</form>
<P>



</td>
			</tr>
<TR><TD>


<?php if ($rowGetUser->PICEXT != "") {?>

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
				
				<td align="center" height="30"><div class="controltext">Agent Picture for <?php echo $handle;?></div></td>
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
		<td width="50%" bgcolor="#FFFF99" align="center">
			<table align="center" border="0">
<!--			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Send this file: <input name="userfile" type="file" STYLE="Background-Color : #E0FFFF" ></div></td>
			</tr> -->
			<tr>
			<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext">
<!--
<input type="submit" value="Upload / Update Agent Picture" STYLE="Background-Color : #E0FFFF;">
</FORM> -->
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
	<td align="center" bgcolor="#FFFF99">


		<table>
			<tr>
			<td height="30"  bgcolor="#FFFF99"><div class="ad">Access</div></td>
      			<td height="30"  bgcolor="#FFFF99"><div class="ad">Level Rights:</div></td>
      			</tr>
      			<tr>
      			<td height="30"  bgcolor="#FFFF99"><div class="ad"> &nbsp; <B>0</B></div></td>
      			<td height="30"  bgcolor="#FFFF99"><div class="ad">Has no Access to Landlords and cannot edit them, Can only view listings and not save them, Cannot access photo manipulations or printouts,</div></td>
      			</tr>
      			<tr>
      			<td height="30"  bgcolor="#FFFF99"><div class="ad"> &nbsp; <B>1</B></div></td>
      			<td height="30"  bgcolor="#FFFF99"><div class="ad">Can compose, edit, activate and deactivate ads, landlords and listings.</div></td>
      			</tr>
      			<tr>
      			<td height="30"  bgcolor="#FFFF99"><div class="ad"> &nbsp; <B>2</B></div></td>
      			<td height="30"  bgcolor="#FFFF99"><div class="ad">Can compose, edit, activate, deactivate and delete ads, landlords and listings one at a time.</div></td>
    			</tr>
    			<tr>
    			<td height="30"  bgcolor="#FFFF99"><div class="ad"> &nbsp; <B>3</B></div></td>
    			<td height="30"  bgcolor="#FFFF99"><div class="ad">Can compose, edit, activate, deactivate and delete ads, landlords and listings one at a time, or in groups.</div></td>
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