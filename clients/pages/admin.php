<!--Begin admin.php -->
<?php

  $PHP_SELF = $_SERVER['PHP_SELF']; 
if ($_SESSION['pref_pagebg']=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor=$_SESSION['pref_pagebg'];
}
$pagebgcolor="#e2effa";
?>
<CENTER>
<TABLE BGCOLOR="#FFFFFF" style="width:100%;"><TR><TD><CENTER>


<TABLE BGCOLOR="#FFFFFF" WIDTH="1200"><TR>
<TD WIDTH="45">
<img src="../images/configure.png" border=0 height=60 width=60>
</TD>
<TD><CENTER><B style="color:#1296db;font-size:25px;">Administrator Tools &amp; Settings</B></CENTER></TD>
<TD WIDTH="45">
<img src="../images/configure.png" border=0 height=60 width=60>
</TD></TR></TABLE>

<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;border:1px solid #ddd;padding:15px;margin:10px;width:1200px;border-radius:15px;height:1700px;">
<ul>
<style type="text/css">
li{margin:15px 0;}
</style>
<TABLE><TR>
<TD><IMG SRC="../images/admin.png" style="width:30px;height:30px;"></TD>
<TD><B style="color:#1296db;">MANAGE AGENT ACCOUNTS &amp; LISTINGS</B></TD>
</TR></TABLE><P>
 <li><a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=small&vid=9";?>">Manage Agency</a></li>

<li><a href="<?php echo "$PHP_SELF?op=manageUsers";?>">Manage Agents</a> | <a href="<?php echo "$PHP_SELF?op=createUser";?>">Create New Agent</A></li>

<li><a href="<?php echo "$PHP_SELF?op=managelistings";?>">Aging &amp; Management of Agent & Office Ads/Listings</a> &nbsp; <I>(Load time varies by # of agents & listings)</I></li>

<li><a href="<?php echo "$PHP_SELF?op=reports_clients";?>">Client Reporting</a> 

<!--
<li><a href="<?php echo "$PHP_SELF?op=manageclientsreport";?>">.</A><BR>
<li><a href="<?php echo "$PHP_SELF?op=manageclientsreport";?>">Aging &amp; Management of Agent & Clients</a> &nbsp; <I>(Load time varies by # of agents & clients)</I></li>
-->
<li><a href="<?php echo "$PHP_SELF?op=mail_all_agents";?>">Email All Agents</a></li>
<li><a href="<?php echo "$PHP_SELF?op=intellirent";?>">Manage Rental Application &amp; Additional Syndication Sites</a></li>
<BR><P>

<TABLE><TR><TD><IMG SRC="../images/template.png" style="width:30px;height:30px;"></TD><TD><NOBR><B style="color:#1296db;">AD | LISTING OUTPUT TEMPLATE CUSTOMIZATION</B></NOBR></TD></TR></TABLE>
<P>
<li><a href="<?php echo "$PHP_SELF?op=watermarkprefs";?>">Watermark &amp; Photo Settings</a></li>

<li><a href="<?php echo "$PHP_SELF?op=headfoot_settings_nowysiwyg";?>">BostonApartments.com Templates</a></li>

<li><a href="<?php echo "$PHP_SELF?op=agent_sig_settings";?>">Agent Personal Signature Settings</a></li>

<li><a href="<?php echo "$PHP_SELF?op=cobroke_nowysiwyg";?>">BA Network (Co-broke) Preferences</a></li>

<li><a href="<?php echo "$PHP_SELF?op=settings_fb_show";?>">Show Facebook Like &amp; Tweet on Listing Details</a></li>

<!-- <li><a href="<?php echo "$PHP_SELF?op=cl_settings_nowysiwyg";?>">Craigslist, Ebay Classifieds &amp; BackPage Preferences &amp; Templates</a></li> -->

<li><a href="<?php echo "$PHP_SELF?op=email_daily_settings";?>">Daily Emails to Clients Settings</a></li>

<li><a href="https://bostonapartments.com/developer/searchonyoursite.htm" target="_howput">How to put your BostonApartments.com listings on your website</a></li>
<BR><P>


<TABLE><TR><TD><IMG SRC="../images/backup.png" style="width:30px;height:30px;"></TD><TD><B style="color:#1296db;">AGENCY DATABASE BACKUP &amp; MAIL MERGE FILES</B></TD></TR></TABLE>
<P style="line-height:20px;">
Backup your data for use in any spreadsheet or database program. You can use the landlord and client backup files as a mail merge file in a word processor to make address lables and personalized letters for mass mailings.<BR>
<P>
<I>Comma (,) delimited .CSV file:</I><BR>
<P>
<li><a href="backup_output.csv">Download <B>Listings</B> Backup</A><br>
<li><a href="backup_landlord_output.csv">Download <B>Landlords</B> Backup</A><br>
<li><a href="backup_landlords_output-bylistingstown.csv">Download <B>Landlords sorted by Listing Areas</B></A><BR>

<li><a href="backup_landlords_exclusive_output.csv">Download <B>Landlords marked EXCLUSIVE</B></A><BR>


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

<TABLE><TR><TD><IMG SRC="../images/xml.png" style="width:30px;height:30px;"></TD><TD><B style="color:#1296db;">XML DUMP TO BOSTONAPARTMENTS.COM</B></TD></TR></TABLE>
<P>
<li>

<a href="https://bostonapartments.com/lacms/imports/" target="_NEW">.xml upload to BostonApartments.com</a><BR>

<P>
<TABLE><TR><TD><IMG SRC="../images/import.png" style="width:30px;height:30px;"></TD><TD><B style="color:#1296db;">IMPORT LISTINGS FROM EXTERNAL PROVIDER</B></TD></TR></TABLE>
<P style="line-height:20px;">
If you have an account on one of the following sites you can import your listing to show them on BostonApartments.com.
Please provide your account information below.
<P>

<!-- YGL Begin-->



<form id="external_import" action="<?php echo "$PHP_SELF?op=editExternalImportsYGLDo"; ?>" method="post">
<li><input type="checkbox" name="gotYGL" value="Yes" <?php if(isset($rowGetGroup)) if ($rowGetGroup->YGL==1) {echo "checked ";} ?>/><b>I have a YGL-account and I would like to import to BostonApartments.com</b><br /><br>
Enter your YGL APIKeyCode:<br>
<input type="text" name="user" value="<?php if(isset($rowGetGroup)) echo $rowGetGroup->YGL_KEY; ?>" style="margin:8px 0;padding:0 5px;width:350px;height:30px;line-height:30px;border-radius:10px;border:1px solid #ddd;"/><BR>
Enter YGL Feed if no API<BR>
<input type="text" name="ygl_feed" value="<?php if(isset($rowGetGroup)) echo $rowGetGroup->YGL_FEED; ?>" style="margin:8px 0;padding:0 5px;width:350px;height:30px;line-height:30px;border-radius:10px;border:1px solid #ddd;"/><BR>


<input type="submit" value="Save YGL Account" style="padding:0 5px;width:350px;height:30px;line-height:30px;border-radius:10px;border:1px solid #bbb;"><br><br>
At this time, YGL-imports are: <b>
<?php 
if(isset($rowGetGroup))
if ($rowGetGroup->YGL==0) 
{
	echo "<label style=\"color:red;\">Disabled</label>";
} 
else 
{
	echo "<label style=\"color:green;\">Enabled</label>";
} 

if(isset($rowGetGroup))
if ($rowGetGroup->YGL==1 && $rowGetGroup->YGL_KEY=="") 
{
	echo "<br><br><label style=\"color:red;\">Imports won't work until you provide a valid API KeyCode!</label>";
} 
?>
</b><br>
<?php

	$quInfoFromKey = mysqli_query($dbh, "SELECT COUNT(ID) AS ANTAL FROM `IMPORT_REQUESTS` WHERE GRID=$grid AND DONE=0");
	if(isset($quInfoFromKey)){
        $rowGroupFromQuerystring = mysqli_fetch_object($quInfoFromKey);
        }
        if(isset($rowGroupFromQuerystring))
	$antal = $rowGroupFromQuerystring->ANTAL;
        if(!isset($antal))
//	if ($antal == 0)
	{   
            if(isset($rowGetGroup))
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





<P><P><P><P style="line-height:20px;">
For those with an external database who want to sync it with BostonApartments.com. Go to <A HREF="https://www.bostonapartments.com/developer" target="_NEW">http://www.bostonapartments.com/developer</A> for more details.<BR>
<P>


</li>

</ul>

</TD></TR></TABLE>


</div>

<!--End admin.php -->