<!--Begin admin.php -->
<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>
<CENTER>
<TABLE BGCOLOR="#FFFFFF"><TR><TD><CENTER>


<TABLE BGCOLOR="#FFFFFF" WIDTH="100%"><TR><TD WIDTH="45">
<img src="../images/preferences.jpg" border=0 height=45 width=70>
</TD><TD>
	<CENTER><B>Administrator Tools &amp; Settings</B></CENTER></TD><TD WIDTH="45">
<img src="../images/preferences.jpg" border=0 height=45 width=70>
</TD></TR></TABLE>

<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:10px;background-color:<?php echo $pagebgcolor;?>;border:1px solid black;padding:15px;margin:10px;width:600px;">

<ul>


<TABLE><TR><TD><IMG SRC="../images/manageagents.gif"></TD><TD><B>MANAGE AGENT ACCOUNTS &amp; LISTINGS</B></TD></TR></TABLE><P>

<li><a href="<?php echo "$PHP_SELF?op=manageUsers";?>">Manage Agents</a> | <a href="<?php echo "$PHP_SELF?op=createUser";?>">Create New Agent</A></li>

<li><a href="<?php echo "$PHP_SELF?op=managelistings";?>">Aging &amp; Management of Agent & Office Ads/Listings</a> &nbsp; <I>(Load time varies by # of agents & listings)</I></li>

<li><a href="<?php echo "$PHP_SELF?op=reports_clients";?>">Client Reporting</a> 

<!--

<li><a href="<?php echo "$PHP_SELF?op=manageclientsreport";?>">.</A><BR>
<li><a href="<?php echo "$PHP_SELF?op=manageclientsreport";?>">Aging &amp; Management of Agent & Clients</a> &nbsp; <I>(Load time varies by # of agents & clients)</I></li>
-->
<li><a href="<?php echo "$PHP_SELF?op=mail_all_agents";?>">Email All Agents</a></li>

<BR><P>

<TABLE><TR><TD><IMG SRC="../images/icons/html.gif"></TD><TD><NOBR><B>AD | LISTING OUTPUT TEMPLATE CUSTOMIZATION</B></NOBR></TD></TR></TABLE>
<P>
<li><a href="<?php echo "$PHP_SELF?op=watermarkprefs";?>">Watermark &amp; Photo Settings</a></li>

<li><a href="<?php echo "$PHP_SELF?op=headfoot_settings_nowysiwyg";?>">BostonApartments.com Templates</a></li>

<li><a href="<?php echo "$PHP_SELF?op=agent_sig_settings";?>">Agent Personal Signature Settings</a></li>

<li><a href="<?php echo "$PHP_SELF?op=cobroke_nowysiwyg";?>">Co-Broke Preferences</a></li>

<li><a href="<?php echo "$PHP_SELF?op=settings_fb_show";?>">Show Facebook Like &amp; Tweet on Listing Details</a></li>

<li><a href="<?php echo "$PHP_SELF?op=cl_settings_nowysiwyg";?>">Craigslist, Ebay Classifieds &amp; BackPage Preferences &amp; Templates</a></li>

<li><a href="http://bostonapartments.com/developer/searchonyoursite.htm" target="_howput">How to put your BostonApartments.com listings on your website</a></li>
<BR><P>


<TABLE><TR><TD><IMG SRC="../images/backup.gif"></TD><TD><B>AGENCY DATABASE BACKUP &amp; MAIL MERGE FILES</B></TD></TR></TABLE>
<P>
Backup your data for use in any spreadsheet or database program. You can use the landlord and client backup files as a mail merge file in a word processor to make address lables and personalized letters for mass mailings.<BR>
<P>
<I>Comma (,) delimited .CSV file:</I><BR>
<P>
<li><a href="backup_output.csv">Download <B>Listings</B> Backup</A><br>
<li><a href="backup_landlord_output.csv">Download <B>Landlords</B> Backup</A><br>
<li><a href="backup_landlords_output-bylistingstown.csv">Download <B>Landlords sorted by Listing Areas</B></A><BR>
<li><a href="backup_clients_output.csv">Download <B>Clients</B> Backup</A><BR>
<li><a href="backup_pictures_output.csv">Download <B>Pictures</B> Backup</A><BR>

<P>
<li><a href="mailmerge_clients_subscribed.csv">Mail Merge - Subscribed Clients Only</A><BR>
<li><a href="mailmerge_landlords_subscribed.csv">Mail Merge - Subscribed Landlords Only</A><BR>
<P>
<I>Pipe (|) delimited .CSV file:</I><BR>
<li><a href="backup_output-pipe.csv">Download <B>Listings</B> Backup</A><br>
<li><a href="backup_landlord_output-pipe.csv">Download <B>Landlords</B> Backup</A><br>
<li><a href="backup_clients_output-pipe.csv">Download <B>Clients</B> Backup</A><br>

</li>
<P>

<TABLE><TR><TD><IMG SRC="../images/backup.gif"></TD><TD><B>XML DUMP TO BOSTONAPARTMENTS.COM</B></TD></TR></TABLE>
<P>
<li>

<a href="http://bostonapartments.com/lacms/imports/" target="_NEW">.xml upload to BostonApartments.com</a><BR>

<P>
<TABLE><TR><TD><IMG SRC="../images/backup.gif"></TD><TD><B>IMPORT LISTINGS FROM EXTERNAL PROVIDER</B></TD></TR></TABLE>
<P>
If you have an account on one of the following sites you can import your listing to show them on BostonApartments.com.
Please provide your account information below.
<P>
<form id="external_import" action="<?php echo "$PHP_SELF?op=editExternalImportsDo"; ?>" method="post">

<li><input type="checkbox" name="gotRentJuice" value="Yes" <?php if ($rowGetGroup->RENTJUICE==1) {echo "checked ";} ?>/><b>I have an Zillow account and I would like to import to BostonApartments.com</b><br />
<li><input type="checkbox" name="RentJuice_MLS" value="1" <?php if ($rowGetGroup->RENTJUICE_MLS==1) {echo "checked ";} ?>/><b>I want the MLS feed from Zillow</b><br /><BR>
<br>
Enter your Zillow APIKeyCode:<br>
<input type="text" name="user" value="<?php if ($rowGetGroup->RENTJUICE==1) {echo $rowGetGroup->RENTJUICE_KEY;} ?>" style="width:250px;"/><input type="submit" value="Save Zillow Account" style="margin-left: 20px;"><br><br>
At this time, Zillow-imports are: <b>
<?php 
if ($rowGetGroup->RENTJUICE==0) 
{
	echo "<label style=\"color:red;\">Disabled</label>";
} 
else 
{
	echo "<label style=\"color:green;\">Enabled</label>";
} 


if ($rowGetGroup->RENTJUICE==1 && $rowGetGroup->RENTJUICE_KEY=="") 
{
	echo "<br><br><label style=\"color:red;\">Imports won't work until you provide a valid KeyCode!</label>";
} 
?>
</b><br>
<?php

	$quInfoFromKey = mysqli_query($dbh, "SELECT COUNT(ID) AS ANTAL FROM `IMPORT_REQUESTS` WHERE GRID=$grid AND DONE=0");
	$rowGroupFromQuerystring = mysqli_fetch_object($quInfoFromKey);
	
	$antal = $rowGroupFromQuerystring->ANTAL;
	
	if ($antal == 0)
	{
		if ($rowGetGroup->RENTJUICE==1 && $rowGetGroup->RENTJUICE_KEY!="") 
		{
			echo "<br><label style=\"color:blue;\"><b><a href=\"pages/updateImportRequest.php?grid=$grid\">Click here to import listings from Zillow now!</a></b></label>";
		}		
	}
	else
	{
		echo "<br><label style=\"color:blue;\"><b>Import in progress, this may take up to five minutes!</b></label>";
	}
?>
<br><br>
</form>
<P>



<!-- YGL Begin-->



<form id="external_import" action="<?php echo "$PHP_SELF?op=editExternalImportsYGLDo"; ?>" method="post">
<li><input type="checkbox" name="gotYGL" value="Yes" <?php if ($rowGetGroup->YGL==1) {echo "checked ";} ?>/><b>I have a YGL-account and I would like to import to BostonApartments.com</b><br /><br>
Enter your YGL APIKeyCode:<br>
<input type="text" name="user" value="<?php if ($rowGetGroup->YGL==1) {echo $rowGetGroup->YGL_KEY;} ?>" style="width:250px;"/><input type="submit" value="Save YGL Account" style="margin-left: 20px;"><br><br>
At this time, YGL-imports are: <b>
<?php 
if ($rowGetGroup->YGL==0) 
{
	echo "<label style=\"color:red;\">Disabled</label>";
} 
else 
{
	echo "<label style=\"color:green;\">Enabled</label>";
} 


if ($rowGetGroup->YGL==1 && $rowGetGroup->YGL_KEY=="") 
{
	echo "<br><br><label style=\"color:red;\">Imports won't work until you provide a valid API KeyCode!</label>";
} 
?>
</b><br>
<?php

	$quInfoFromKey = mysqli_query($dbh, "SELECT COUNT(ID) AS ANTAL FROM `IMPORT_REQUESTS` WHERE GRID=$grid AND DONE=0");
	$rowGroupFromQuerystring = mysqli_fetch_object($quInfoFromKey);
	
	$antal = $rowGroupFromQuerystring->ANTAL;
	
	if ($antal == 0)
	{
		if ($rowGetGroup->YGL==1 && $rowGetGroup->YGL_KEY!="") 
		{
			echo "<br><label style=\"color:blue;\"><b><a href=\"pages/updateImportRequestYGL.php?grid=$grid\">Click here to import listings from YGL now!</a></b></label>";
		}		
	}
	else
	{
		echo "<br><label style=\"color:blue;\"><b>Import in progress, this may take up to five minutes!</b></label>";
	}
?>
<br><br>
</form>
<P>


<!-- end YGL -->





<P><P><P><P>
For those with an external database who want to sync it with BostonApartments.com. Go to <A HREF="http://www.bostonapartments.com/developer" target="_NEW">http://www.bostonapartments.com/developer</A> for more details.<BR>
<P>


</li>

</ul>

</TD></TR></TABLE>


</div>

<!--End admin.php -->