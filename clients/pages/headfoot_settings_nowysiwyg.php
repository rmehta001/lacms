<!--BEGIN HF_settings -->
<?php
$pref_pagebg = $_SESSION["pref_pagebg"]; 
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
?>

	<CENTER><B>Edit Header &amp; Footer Settings for <?php echo $_SESSION ["group"];?></B><br>
<P>
<A HREF="<?php echo "$PHP_SELF?op=headfoot_settings"; ?>">If you want to use a WYSIWYG HTML editor to<BR>create headers and footers Click Here</A>

	<form action="<?php echo "$PHP_SELF?op=headfoot_settingsDo"; ?>" method="POST">
	<div class="controltext" style="background-color:<?php echo $pagebgcolor;?>;border:1px solid black;width:700px;">

	<table cellspacing="5" cellpadding="3">

<TR>
<TD COLSPAN="2" align="center">


		<table WIDTH="650">
			<tr>
			<td height="30"><div class="controltext">Default Header:
</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="head" name="head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Default Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="foot" name="foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->FOOT);?></TEXTAREA>
</td>
</tr>

			<tr>
			<td height="30"><div class="controltext">Rental Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type1_head" name="type1_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE1_HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Rental Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type1_foot" name="type1_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE1_FOOT);?></TEXTAREA>
</td>
</tr>



			<tr>
			<td height="30"><div class="controltext">Sales Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type2_head" name="type2_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE2_HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Sales Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type2_foot" name="type2_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE2_FOOT);?></TEXTAREA>
</td>
</tr>

			<tr>
			<td height="30"><div class="controltext">Commercial Sales Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type3_head" name="type3_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE3_HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Commercial Sales Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type3_foot" name="type3_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE3_FOOT);?></TEXTAREA>
</td>
</tr>


			<tr>
			<td height="30"><div class="controltext">Commercial Rentals Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type4_head" name="type4_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE4_HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Commercial Rentals Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type4_foot" name="type4_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE4_FOOT);?></TEXTAREA>
</td>
</tr>

			<tr>
			<td height="30"><div class="controltext">Vacation Rental Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type8_head" name="type8_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE8_HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Vacation Rental Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type8_foot" name="type8_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE8_FOOT);?></TEXTAREA>
</td>
</tr>


			<tr>
			<td height="30"><div class="controltext">Rent To Own Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type9_head" name="type9_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE9_HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Rent To Own Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type9_foot" name="type9_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE9_FOOT);?></TEXTAREA>
</td>
</tr>


			<tr>
			<td height="30"><div class="controltext">Business Opportunities Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type10_head" name="type10_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE10_HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Business Opportunities Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type10_foot" name="type10_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE10_FOOT);?></TEXTAREA>
</td>
</tr>


			<tr>
			<td height="30"><div class="controltext">Senior Living Rental Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type11_head" name="type11_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE11_HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Senior Living Rental Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type11_foot" name="type11_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE11_FOOT);?></TEXTAREA>
</td>
</tr>


			<tr>
			<td height="30"><div class="controltext">Senior Living Sales Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type12_head" name="type12_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE12_HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Senior Living Sales Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type12_foot" name="type12_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE12_FOOT);?></TEXTAREA>
</td>
</tr>


			<tr>
			<td height="30"><div class="controltext">Bank Owned Sales Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type13_head" name="type13_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE13_HEAD);?></TEXTAREA>
</td>
</tr>

			<tr>
			<td height="30"><div class="controltext">Bank Owned Sales Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="type13_foot" name="type13_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->TYPE13_FOOT);?></TEXTAREA>
</td>
</tr>

			<tr>
			<td height="30"><div class="controltext">Meet The Agents Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="meetagents_head" name="meetagents_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->MEETAGENTS_HEAD);?></TEXTAREA>
</td>
</tr>

			<tr>
			<td height="30"><div class="controltext">Meet The Agents Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="meetagents_foot" name="meetagents_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->MEETAGENTS_FOOT);?></TEXTAREA>
</td>
</tr>


			<tr>
			<td height="30"><div class="controltext">Co-Broke Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="cobroke_head" name="cobroke_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->COBROKE_HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Co-Broke Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="cobroke_foot" name="cobroke_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->COBROKE_FOOT);?></TEXTAREA>
</td>
</tr>



			<tr>
			<td height="30"><div class="controltext">Open House Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="openhouse_head" name="openhouse_head" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->OPENHOUSE_HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Open House Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="openhouse_foot" name="openhouse_foot" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->OPENHOUSE_FOOT);?></TEXTAREA>
</td>
</tr>


			<tr>
			<td height="30"><div class="controltext">Email Header:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="email_header" name="email_header" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->EMAIL_HEADER);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Email Footer:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="email_footer" name="email_footer" rows="5" cols="60"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->EMAIL_FOOTER);?></TEXTAREA>
</td>
</tr>





</table>

</TD></TR>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>

	<tr>
	<td colspan="2" align="center"><input type="submit" value="Save BostonApartments.com Header and Footer preferences" STYLE="Background-Color : #E0FFFF"><BR>
<P>
<A HREF="<?php echo "$PHP_SELF?op=headfoot_settings"; ?>">If you want to use a WYSIWYG HTML editor to<BR>create headers and footers Click Here</A></td>
	</tr>
	</table>
</form>

<TABLE WIDTH="550"><TR><TD>
<FONT SIZE="-1">You do not have to fill out all fields. If you fill in the "Default Header and Footer" they will be used for all types of ad output. If you do not have a default template for your listings or website powered by BostonApartments.com than the generic BostonApartments.com template will be used.<BR>
<P>
</TD></TR></TABLE>
	</div>
	</center>
<P><BR>
<!--END edit HF Settings -->