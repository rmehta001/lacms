<!--BEGIN Intellirent settings -->
<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
?>
	<CENTER><B>Edit Intellirent Settings for <?php echo $group;?></B><br>

	<form action="<?php echo "$PHP_SELF?op=intellirentDo"; ?>" method="POST">
	<div class="controltext" style="background-color:<?php echo $pagebgcolor;?>;border:1px solid black;width:700px;">

	<table cellspacing="5" cellpadding="3">

<TR>
<TD  align="center">


		<table WIDTH="350">
<tr>
			<td height="30"><div class="controltext">Use the Intellirent System for Applications/Credit Checks:</DIV>
</TD><TD BGCOLOR="#FFFFFF">

<select style="background-color:white" name="INTELLIRENT">
<OPTION VALUE="0" <?php if ($rowGetGroup->INTELLIRENT=="0") { echo " selected "; }?>>No</OPTION>
<OPTION VALUE="1" <?php if ($rowGetGroup->INTELLIRENT=="1") { echo " selected "; }?>>Yes</OPTION>
</select></NOBR></div>

</td>
</tr>
</table>

</TD></TR>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>

	<tr>
	<td colspan="2" align="center"><input type="submit" value="Save Intellirent Settings" STYLE="Background-Color : #E0FFFF"><BR>
<P>
</td>
	</tr>
	</table>
</form>

<TABLE WIDTH="550"><TR><TD>
<FONT SIZE="-1">If this is set to "No", then the "Apply Now Button" will not show on any Listings/Ads.<BR>
<P><BR>
</TD></TR></TABLE>
	</div>
	</center>
<P><BR>
<!--END edit Intellirent Settings -->