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


<TABLE><TR><TD><IMG SRC="../images/manageagents.gif"></TD><TD><B>MANAGE AGENT ACCOUNTS</B></TD></TR></TABLE><P>

<li><a href="<?php echo "$PHP_SELF?op=manageUsers";?>">Manage Agents</a></li>
<BR>

<li><a href="<?php echo "$PHP_SELF?op=managelistings";?>">Manage Agent & Office Ads/Listings</a></li>

<BR>

<li><a href="<?php echo "$PHP_SELF?op=mail_all_agents";?>">Email All Agents</a></li>

<BR><P>

<TABLE><TR><TD><IMG SRC="../images/icons/html.gif"></TD><TD><NOBR><B>AD | LISTING OUTPUT TEMPLATE CUSTOMIZATION</B></NOBR></TD></TR></TABLE>
<P>
<li><a href="<?php echo "$PHP_SELF?op=watermarkprefs";?>">Watermark Settings for Photos</a></li>

<li><a href="<?php echo "$PHP_SELF?op=headfoot_settings_nowysiwyg";?>">BostonApartments.com Templates</a></li>

<li><a href="<?php echo "$PHP_SELF?op=cobroke_nowysiwyg";?>">Co-Broke Preferences</a></li>

<li><a href="<?php echo "$PHP_SELF?op=cl_settings_nowysiwyg";?>">Craigslist, Kijiji &amp; The Dig Preferences &amp; Templates</a></li>

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
<li><a href="backup_clients_output.csv">Download <B>Clients</B> Backup</A><BR>
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
For those with an external database who want to sync it with BostonApartments.com. Go to <A HREF="http://www.bostonapartments.com/developer" target="_NEW">http://www.bostonapartments.com/developer</A> for more details.<BR>
<P>


</li>

</ul>

</TD></TR></TABLE>


</div>
<!--End admin.php -->