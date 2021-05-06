<!--BEGIN editpostntapp -->

<?php
$pref_pagebg = $_SESSION["pref_pagebg"];
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>
<B>CLIENT APARTMENT APPLICATION</B>
	<br>
	
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<form action="<?php echo "$PHP_SELF?op=editClientappDo";?>" method="POST">
	<input type="hidden" name="clid" value="<?php echo $rowGetClient->CLID;?>">
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">



<table>
<tr>

<TD COLSPAN=6>
<NOBR><FONT SIZE="+1">Client Application Information:</FONT> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" value="Save" STYLE="Background-Color : #adffad">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<A HREF="javascript:popUpapp('./printout_application.php?clid=<?php if(isset($rowGetClient)) echo $rowGetClient->CLID;?>');">
<img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18"> Print Application</A>

</NOBR>


		<?php 
		$mi_year = substr (isset($rowGetClient->DATE_MOVEIN), 0, 4);
		$mi_month = substr (isset ($rowGetClient->DATE_MOVEIN), 5,2);
		$mi_day = substr (isset ($rowGetClient->DATE_MOVEIN), 8,2);
		?>


		<?php 
		$mie_year = substr (isset($rowGetClient->DATE_MOVEIN_END), 0, 4);
		$mie_month = substr (isset($rowGetClient->DATE_MOVEIN_END), 5,2);
		$mie_day = substr (isset ($rowGetClient->DATE_MOVEIN_END), 8,2);
		?>




<TABLE><TR><TD>

<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0><TR><TD>

		
<NOBR>
<div class="controltext">Move In Date: <FONT SIZE=-3>(begin)</FONT></NOBR></TD><TD>

<NOBR>
<select name="mi_month" STYLE="Background-Color : #FFFFFF">
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
			<select name="mi_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($mi_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>
			<select name="mi_year" STYLE="Background-Color : #FFFFFF">

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
</TD></TR></TABLE>

</DIV>



</TD><TD>
 &nbsp; 
</TD><TD> 
<NOBR><div class="controltext">Date Created: 
<?php if (isset ($rowGetClient)) echo $rowGetClient->DATE_CREATED;?></DIV></NOBR>
<NOBR><div class="controltext">By Agent: <?php 
 
if(isset ($rowGetClient)) if ($rowGetClient->HANDLE)
{ echo $rowGetClient->HANDLE; }
else
{ if (isset ($rowGetClient)) echo $rowGetClient->UID; }

?></DIV></NOBR>
</TD></TR></TABLE>




</TD>
</TR><TR>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>First Name:</NOBR></div><input type="text" name="name_first" size="20" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->NAME_FIRST;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Last Name:</NOBR></div><input type="text" name="name_last" size="20" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->NAME_LAST;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Social Security #: <FONT SIZE="-2"><A HREF="./pages/ssn_verify_form.php" target="_SSN">SS# Checker</A></FONT></NOBR></div><INPUT TYPE="text" name="SOCIAL" VALUE="<?php if (isset ($rowGetClient)) echo $rowGetClient->SOCIAL;?>" STYLE="Background-Color : #FFFFFF"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>D.O.B.:</NOBR></div><INPUT TYPE="text" name="CLDOB" VALUE="<?php if (isset ($rowGetClient)) echo $rowGetClient->CLDOB;?>" STYLE="Background-Color : #FFFFFF" SIZE="10"></td>


			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

</tr>
</table>




	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>

			<td height="30" width="28" bgcolor="<?php echo $pagebgcolor;?>">

			<table>
			<tr>
			
			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Home Phone:</NOBR></div><input type="text" name="home_phone" size="15" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->HOME_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Work Phone:</NOBR></div><input type="text" name="work_phone" size="15" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->WORK_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Mobile Phone:</NOBR></div><input type="text" name="mobile_phone" size="15" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->MOBILE_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Email:</div><input type="text" name="client_email" size="20" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CLIENT_EMAIL;?>"></td>
			<td valign="bottom" height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td valign="bottom" height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">



<?php

if (isset ($rowGetClient)) if ( $rowGetClient->CLIENT_EMAIL != "" ) {

	echo "<A HREF=$PHP_SELF?op=mail_client&clid=$clid><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";

} else {
	echo " &nbsp; ";
}

; ?>



</td>
			<td valign="bottom" height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			</tr>
			</table>

</td>

	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
</TR><TR>

	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>




	<td bgcolor="<?php echo $pagebgcolor;?>">


<table><tr><td>

<div class="controltext">Address:</div><input type="text" name="curaddress" size="28" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURADDRESS;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">City:</div><input type="text" name="curcity" size="28" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURCITY;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>


			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">State:</div><input type="text" name="curstate" size="2" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURSTATE;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>


			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Zip:</div><input type="text" name="curzip" size="10" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURZIP;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>


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
	<td bgcolor="<?php echo $pagebgcolor;?>">

<TABLE><TR><TD>
<div class="controltext"><NOBR># of people:</NOBR></div><input type="text" SIZE="2" name="num_people" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->NUM_PEOPLE;?>">
</td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="2" bgcolor="<?php echo $pagebgcolor;?>">
&nbsp;

			</TD>
<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="2" bgcolor="<?php echo $pagebgcolor;?>">
<div class="menu">Employment:</div><select name="client_employment" STYLE="Background-Color : #FFFFFF">
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

			<td height="30" width="28" bgcolor="<?php echo $pagebgcolor;?>">


<TABLE><TR><TD>
<div class="menu">Current Employer:</div>
<input type="text" name="CURREMPLOY" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURREMPLOY;?>">

</TD><TD>

<div class="menu">Current Employer Address:</div>
<input type="text" name="CURREMPLOYADDRESS" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURREMPLOYADDRESS;?>">
</TD></TR><TR><TD>
<div class="menu">Current Employer Phone:</div>
<input type="text" name="CURREMPLOYPHONE" size="20" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURREMPLOYPHONE;?>">

</TD><TD>

<div class="menu">Current Employer Contact:</div>
<input type="text" name="CURREMPLOYCONTACT" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURREMPLOYCONTACT;?>">
</TD></TR><TR><TD>

<div class="menu">Current Position:</div>
<input type="text" name="CURREMPLOYPOS" size="20" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURREMPLOYPOS;?>">
</TD><TD>

<div class="menu">Current Salary/Income:</div>
<input type="text" name="CURREMPLOYSALARY" size="20" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURREMPLOYSALARY;?>">
</TD></TR></TABLE>

</TD>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
</TR>

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
			<td height="30" width="28" bgcolor="<?php echo $pagebgcolor;?>">


<TABLE><TR><TD>
<div class="menu">Previous Employer:</div>
<input type="text" name="PREVEMPLOY" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PREVEMPLOY;?>">

</TD><TD>

<div class="menu">Previous Employer Address:</div>
<input type="text" name="PREVEMPLOYADDRESS" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PREVEMPLOYADDRESS;?>">
</TD></TR><TR><TD>
<div class="menu">Previous Employer Phone:</div>
<input type="text" name="PREVEMPLOYPHONE" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PREVEMPLOYPHONE;?>">

</TD><TD>

<div class="menu">Previous Employer Contact:</div>
<input type="text" name="PREVEMPLOYCONTACT" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PREVEMPLOYCONTACT;?>">
</TD></TR><TR><TD>
<div class="menu">Previous Position:</div>
<input type="text" name="PREVEMPLOYPOS" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PREVEMPLOYPOS;?>">
</TD><TD>
<div class="menu">Previous Salary/Income:</div>
<input type="text" name="PREVEMPLOYSALARY" size="20" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PREVEMPLOYSALARY;?>">
</TD></TR></TABLE>


</TD>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
</TR>



	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>



	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
			<td height="30" width="28" bgcolor="<?php echo $pagebgcolor;?>">

<TABLE><TR><TD>
<div class="menu">Current Landlord:</div>
<input type="text" name="CURRLL" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURRLL;?>">
</TD><TD>
<div class="menu">Current Landlord Address:</div>
<input type="text" name="CURRLLADDRESS" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURRLLADDRESS;?>">
</TD></TR>
<TR><TD>

<div class="menu">Current Landlord Phone:</div>
<input type="text" name="CURRLLPHONE" size="20" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURRLLPHONE;?>">

</TD><TD>

<div class="menu">Current Rent:</div>
<input type="text" name="CURRLLRENT" size="20" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CURRLLRENT;?>">
</TD></TR></TABLE>



</TD>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
</TR>



	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	

	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
			<td height="30" width="28" bgcolor="<?php echo $pagebgcolor;?>">
			
			
<TABLE><TR><TD>
<div class="menu">Previous Landlord:</div>
<input type="text" name="PREVLL" size="30" value="<?php if (isset ($rowGetClient))  $rowGetClient->PREVLL;?>">
</TD><TD>
<div class="menu">Previous Landlord Address:</div>
<input type="text" name="PREVLLADDRESS" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PREVLLADDRESS;?>">
</TD></TR><TR><TD>
<div class="menu">Previous Landlord Phone:</div>
<input type="text" name="PREVLLPHONE" size="20" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PREVLLPHONE;?>">
</TD><TD>
<div class="menu">Previous Rent:</div>
<input type="text" name="PREVLLRENT" size="20" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PREVLLRENT;?>">
</TD></TR></TABLE>


</TD>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
</TR>

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>




	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
			<td height="30" width="28" bgcolor="<?php echo $pagebgcolor;?>">
			
			
<TABLE><TR><TD>
<div class="menu">Credit Reference:</div>
<input type="text" name="CREDITREF" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CREDITREF;?>">
</TD><TD>
<div class="menu">Account #:</div>
<input type="text" name="CREDITACCOUNT" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CREDITACCOUNT;?>">
</TD></TR><TR><TD>
<div class="menu">Personal Reference:</div>
<input type="text" name="PERSREF" size="30" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PERSREF;?>">
</TD><TD>
<div class="menu">Personal Reference Tel:</div>
<input type="text" name="PERSREFCONTACT" size="20" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PERSREFCONTACT;?>">
</TD></TR></TABLE>


</TD>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
</TR>





	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>



	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
			<table>
			<tr>
			
			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">



			<table>
			<tr>
			
			<td height="40" width="100" bgcolor="<?php echo $pagebgcolor;?>" COLSPAN="5">

<div class="controltext">Additional Comments:</div><textarea name="client_notes" rows="5" cols="75"><?php if (isset ($rowGetClient)) echo $rowGetClient->CLIENT_NOTES;?></textarea></td>
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
	<td bgcolor="<?php echo $pagebgcolor;?>">

			<table>
			<tr>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><B>Accounting:</B></div></td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000">
<img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td width="400" bgcolor="<?php echo $pagebgcolor;?>">


<TABLE><TR><TD bgcolor="<?php echo $pagebgcolor;?>" VALIGN="TOP">

			<table width="100%">
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Tenant fee paid:</div>$<input type="text" name="tenant_fee_paid" size="5" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->TENANT_FEE_PAID;?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">First month paid:</div>$<input type="text" name="payment_first_paid"  size="5" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PAYMENT_FIRST_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Last month paid:</div>$<input type="text" name="payment_last_paid" size="5" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PAYMENT_LAST_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Security deposit paid:</div>$<input type="text" name="payment_sec_paid" size="5" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->PAYMENT_SEC_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Key deposit paid:</div>$<input type="text" name="key_dep_paid" size="5" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->KEY_DEP_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Cleaning deposit paid:</div>$<input type="text" name="clean_dep_paid" size="5" value="<?php if (isset ($rowGetClient)) echo $rowGetClient->CLEAN_DEP_PAID;?>"></td>
			</tr>
			</table>


</TD><TD bgcolor="<?php echo $pagebgcolor;?>">
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</TD><TD VALIGN="TOP" bgcolor="<?php echo $pagebgcolor;?>" align="left">



<NOBR><div class="menu">Fee Disclosure Given? &nbsp; <input type="checkbox" name="fee_disclosure" value="1" <?php if (isset ($rowGetClient)) if ($rowGetClient->FEE_DISCLOSURE) { echo " checked "; } ?>></NOBR></DIV>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/rentips-fee-disclosure.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Fee Disclosure</A></NOBR></DIV><BR>

<BR>
<NOBR><div class="menu">Agency Disclosure Given? &nbsp; <input type="checkbox" name="agency_disclosure" value="1" <?php if (isset ($rowGetClient)) if ($rowGetClient->AGENCY_DISCLOSURE) { echo " checked "; } ?>></NOBR></DIV>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/agencydisclosure.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Agency Disclosure</A></NOBR></DIV><BR>

<NOBR><div class="menu">Credit Check Completed? &nbsp; <input type="checkbox" name="client_credit_check" value="1" <?php if (isset ($rowGetClient)) if ($rowGetClient->CLIENT_CREDIT_CHECK) { echo " checked "; } ?>></DIV><br>


<div class="menu">Application status:</div><select name="client_app_status" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['CLIENT_APP_STATUS'] as $askey => $asValue) { 
						$selected = ($rowGetClient->CLIENT_APP_STATUS==$askey) ? " selected " : "";?>
					<option value="<?php echo $askey;?>" <?php echo $selected;?>><?php echo $asValue;?></option>
					<?php } ?>
				</select><br>

<P>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/leadlaw.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Lead law Notice - Rentals</A></NOBR></DIV>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/rentips-leadlaw-notification-sale.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Lead law Notice - Sales</A></NOBR></DIV><BR>



<P>
<NOBR><div class="menu">Share Client? &nbsp; <input type="checkbox" name="public" value="1" <?php if (isset ($rowGetClient)) if ($rowGetClient->PUBLIC != "0") { echo " checked "; } ?>></NOBR>
<P>

<NOBR><div class="menu">Subscribed to Newsletter: <input type="checkbox" name="newsletter_subscribe" <?php if (isset ($rowGetClient)) if ($rowGetClient->NEWSLETTER_SUBSCRIBE=='2') { echo checked;} ?> value="2"></NOBR>
</DIV>



</TD></TR></TABLE>



	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
			<table>
			<tr>
			
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">


<!-- placeholder -->

</td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td  align="center" bgcolor="<?php echo $pagebgcolor;?>">
			<table width="100%">
			<tr>
			
			<td height="30" align="center" bgcolor="<?php echo $pagebgcolor;?>">


<div class="controltext"><input type="submit" value="Save" STYLE="Background-Color : #adffad">


</td>
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
<BR>
<!--END editClient -->
