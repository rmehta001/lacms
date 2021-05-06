<!--BEGIN Agent Sigs settings -->
<?php
$pref_pagebg = $_SESSION["pref_pagebg"]; 
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
?>
	<CENTER><B>Settings for <?php echo $_SESSION["group"];?> to show Facebook Like &amp; Tweet on the listing details page (homepage.php)</B><br>

	<form action="<?php echo "$PHP_SELF?op=settings_fb_showDo"; ?>" method="POST">
	<div class="controltext" style="background-color:<?php echo $pagebgcolor;?>;border:1px solid black;width:700px;">

	<table cellspacing="5" cellpadding="3">

<TR>
<TD  align="center">


		<table WIDTH="350">
<tr>
			<td height="30"><div class="controltext">Show Facebook Like &amp; Tweet on Listings/Ads detail page:</DIV>
</TD><TD BGCOLOR="#FFFFFF">

<select style="background-color:white" name="SHOW_FBLIKE">
<OPTION VALUE="0" <?php if(isset ($rowGetGroup)) if ($rowGetGroup->SHOW_FBLIKE=="0") { echo " selected "; }?>>Yes</OPTION>
<OPTION VALUE="1" <?php if(isset ($rowGetGroup)) if ($rowGetGroup->SHOW_FBLIKE=="1") { echo " selected "; }?>>No</OPTION>
</select></NOBR></div>

</td>
</tr>
</table>

</TD></TR>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>

	<tr>
	<td colspan="2" align="center"><input type="submit" value="Save Group Settings for showing Facebook and Twitter on Listing Detail Page" STYLE="Background-Color : #E0FFFF"><BR>
<P>
</td>
	</tr>
	</table>
</form>

<TABLE WIDTH="550"><TR><TD>
<FONT SIZE="-1">If this is set to "No", then the agents will not have access to click "Display Like &amp; Tweet" on any Listings/Ads.<BR>
<P><BR>
</TD></TR></TABLE>
	</div>
	</center>
<P><BR>
<!--END edit Agent Sigs Settings -->