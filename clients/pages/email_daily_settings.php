<!--BEGIN Email Daily settings -->
<?php
$pref_pagebg = $_SESSION["pref_pagebg"]; 
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
?>
	<CENTER><B>Edit Daily Emails of Matching Listings to Clients Setting for <?php echo $_SESSION["group"];?></B><br>

	<form action="<?php echo "$PHP_SELF?op=email_daily_settingsDo"; ?>" method="POST">
	<div class="controltext" style="background-color:<?php echo $pagebgcolor;?>;border:1px solid black;width:700px;">

	<table cellspacing="5" cellpadding="3">

<TR>
<TD  align="center">


		<table WIDTH="350">
<tr>
			<td height="30"><div class="controltext">Allow Daily Automated Emails to Clients with Matching Listings:</DIV>
</TD><TD BGCOLOR="#FFFFFF">

<select style="background-color:white" name="EMAIL_DAILY">
<OPTION VALUE="0" <?php if(isset($rowGetGroup)) if ($rowGetGroup->EMAIL_LISTINGS=="0") { echo " selected "; }?>>No</OPTION>
<OPTION VALUE="1" <?php if(isset($rowGetGroup)) if ($rowGetGroup->EMAIL_LISTINGS=="1") { echo " selected "; }?>>Yes</OPTION>
</select></NOBR></div>

</td>
</tr>
</table>

</TD></TR>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>

	<tr>
	<td colspan="2" align="center"><input type="submit" value="Save Daily Email to Clients Setting" STYLE="Background-Color : #E0FFFF"><BR>
<P>
</td>
	</tr>
	</table>
</form>

<TABLE WIDTH="550"><TR><TD>
<FONT SIZE="-1">If this is set to "No", then any Listings/Ads will not be automatically emailed to Clients.<BR>
<P><BR>
</TD></TR></TABLE>
	</div>
	</center>
<P><BR>
<!--END edit Agent Sigs Settings -->