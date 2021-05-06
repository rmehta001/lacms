<!--BEGIN cl_settings -->
<?php
$pref_pagebg = $_SESSION["pref_pagebg"];
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
?>
	<CENTER><B>Edit Email Template for <?php echo $_SESSION["handle"];?></B><br>
<P>

	<form action="<?php echo "$PHP_SELF?op=editemailhfaDo"; ?>" method="POST">
	<div class="controltext" style="background-color:<?php echo $pagebgcolor;?>;border:1px solid black;width:700px;">

	<table cellspacing="5" cellpadding="3">

<TR>
<TD COLSPAN="2" align="center">


		<table WIDTH="650">
			<tr>


			<td height="30"><div class="controltext">Header for Email Template:


</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="email_header" name="email_header" rows="5" cols="50"><?php echo htmlspecialchars($rowGetUser->AGENT_EMAIL_HEADER);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Footer for Email Template:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="email_footer" name="email_footer" rows="5" cols="50"><?php echo htmlspecialchars($rowGetUser->AGENT_EMAIL_FOOTER);?></TEXTAREA>
</td>
</tr>

</table>



</TD></TR>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>

	<tr>
	<td colspan="2" align="center"><input type="submit" value="Save Agent Email Templates " STYLE="Background-Color : #E0FFFF"><BR>
<P></td>
	</tr>
	</table>
</form>

<TABLE WIDTH="550"><TR><TD>
<FONT SIZE="-1">
If you want a blank header, please use a comment tag or some hidden tag or a space. If the header and footer are completely blank then the template will not be recognized and the company template will display.
<P>
</FONT>
</TD></TR></TABLE>
	</div>
	</center>
<P><BR>
<!--END edit CL Settings -->