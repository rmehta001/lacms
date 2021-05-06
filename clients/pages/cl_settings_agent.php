<!--BEGIN cl_settings -->
<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
?>
	<CENTER><B>Edit Craigslist Preferences for <?php echo $handle;?> from <?php echo $group;?></B><br>
<P>
<A HREF="<?php echo "$PHP_SELF?op=cl_settings_nowysiwyg_agent"; ?>">If you do not want to use the WYSIWYG HTML Boxes above and want<BR>to do a raw paste for the header and footers Click Here</A><BR>

	<form action="<?php echo "$PHP_SELF?op=cl_settings_agentDo"; ?>" method="POST">
	<div class="controltext" style="background-color:<?php echo $pagebgcolor;?>;border:1px solid black;width:700px;">

	<table cellspacing="5" cellpadding="3">

<TR>
<TD COLSPAN="2" align="center">


		<table WIDTH="650">
			<tr>
			<td height="30" cols="40"><div class="controltext">Email for CL Ads:</DIV>
</TD><TD>

<input type="text" name="cl_emailu" value="<?php echo $rowGetUser->CL_EMAILU;?>"></div></td>
			</tr>
			<tr>

			<tr>
			<td height="30" cols="40"><div class="controltext">Phone # for CL Ads:</DIV>
</TD><TD>

<input type="text" name="cl_phoneu" value="<?php echo $rowGetUser->CL_PHONEU;?>"></div></td>
			</tr>
			<tr>




			<td height="30"><div class="controltext">Header for CL Template:
<P>
<FONT COLOR="RED" SIZE="-2">NOTE: If you are going to paste HTML (or type code) into the header and footer boxes, you must click the "HTML" Button in the toolbar of the header and footer boxes or the code will appear in your ad as code text and not saved as HTML code. You can also use the <A HREF="<?php echo "$PHP_SELF?op=cl_settings_nowysiwyg_agent"; ?>">No WYSIWYG mode</A>.</FONT>


</DIV>
</TD><TD BGCOLOR="#FFFFFF">

<textarea id="cl_headeru" name="cl_headeru" rows="5" cols="30" style="height: 200px; width: 500px;"><?php echo htmlspecialchars($rowGetUser->CL_HEADERU);?></TEXTAREA>
<script language="JavaScript">
   generate_wysiwyg('cl_headeru');
 </script>


</td>
</tr>
			<tr>
			<td height="30"><div class="controltext">Footer for CL Template:</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<textarea id="cl_footeru" name="cl_footeru" rows="5" cols="30" style="height: 200px; width: 500px;"><?php echo htmlspecialchars($rowGetUser->CL_FOOTERU);?></TEXTAREA>
<script language="JavaScript">
   generate_wysiwyg('cl_footeru');
 </script>
</td>
</tr>

</table>



</TD></TR>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>

	<tr>
	<td colspan="2" align="center"><input type="submit" value="Save CL preferences" STYLE="Background-Color : #E0FFFF">
<P>
<A HREF="<?php echo "$PHP_SELF?op=cl_settings_nowysiwyg_agent"; ?>">If you do not want to use the WYSIWYG HTML Boxes above and want<BR>to do a raw paste for the header and footers Click Here</A></td>
	</tr>
	</table>
</form>

<TABLE WIDTH="550"><TR><TD>
<FONT SIZE="-1">If you want to use a custom craigslist template, fill in the above fields. If ALL the fields are left blank or erased and saved, then the default templates for <?php echo $rowGetGroup->NAME;?> will be used for the craigslist ads. If you do not have a default template for your listings or website powered by BostonApartments.com than the generic BostonApartments.com template will be used.<BR>
<P>
If you have a Craigslist account and the email address above matches the email address in the craigslist account, any ads posted through the BostonApartments.com Autopost system will show up in your Craigslist account and no confirmation email is needed.<BR>
<P>
<P>
If you have a telephone number verified account, you should match your phone number on this page to that registered telephone number.<BR>
<P>
If you want a blank header, please use a comment tag or some hidden tag. If the header is completely blank then the template will not be recognized and the company template will display.
<P>
It is suggested that you are logged into your Craigslist account in another window or tab before using the autopost feature. Make sure you have installed the Plugin and it is running.</FONT>
</TD></TR></TABLE>
	</div>
	</center>
<P><BR>
<!--END edit CL Settings -->