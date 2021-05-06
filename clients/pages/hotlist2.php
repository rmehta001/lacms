<!--BEGIN Hotlist -->
<FONT SIZE="-3"><BR></FONT>
<CENTER>
<TABLE BGCOLOR="#FFFFFF" WIDTH="850" BORDER="1" bordercolor="#000000"><TR><TD>
<CENTER>

<TABLE BGCOLOR="#FFFFFF" BORDER=0><TR>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/hotlist-pads.jpg" HEIGHT="54" WIDTH="120">
</TD>
<TD VALIGN="middle" ALIGN="CENTER">
<b><font size="+2">HOT LIST</font></b>
</TD>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/hotlist-pen.jpg" HEIGHT="54" WIDTH="120">
</TD></TR></TABLE>
<HR>
</CENTER>


<?php
	$quStrGetUser2 = "SELECT * FROM USERS WHERE UID=$uid";
	$quGetUser2 = mysqli_query($dbh, $quStrGetUser2);
	$rowGetUser2 = mysqli_fetch_object($quGetUser2);

if($_SESSION['show_hot_list']) {
	$_showHot = "n";
	$icon = "minus.gif";
}else {
	$_showHot = 1;
	$icon = "plus.gif";
}?>


<table width="100%" BORDER="0">
<tr>
<td style="font-size:14px;">


<TABLE WIDTH="100%"><TR><TD>

<B><a href="<?php echo  "$PHP_SELF?op=agentreport"; ?>"><IMG SRC="../assets/images/agentreport-lg.gif" TITLE="Agent  Report" ALT="Agent Report" BORDER="0"> <FONT COLOR="GREEN">Agent Activity Report</FONT> - <FONT  SIZE="-3" COLOR="#999999">Click Here</FONT></A></B><BR>


<B><a href="<?php echo "$PHP_SELF?op=showingsAgent";?>"><img border=0 src="../assets/images/showings.jpg" alt="edit" title="edit" vspace="0" hspace="0" HEIGHT="16" WIDTH="16" TITLE="Showing History"> <FONT COLOR="GREEN">Agent Showing History</FONT> - <FONT  SIZE="-3" COLOR="#999999">Click Here</FONT></A></B><BR><BR>

</TD><TD><CENTER>
<A HREF="#updates"><FONT COLOR="#FF0000">System Updates Listed Below</FONT><BR><FONT SIZE="-1">or Click Here</FONT></A>
</CENTER>
</TD></TR></TABLE>



<?php
$quStrGetappoint = "SELECT * FROM `CLIENTS` WHERE `SHOW_DATE` >= '$now' AND `GRID`=\"$grid\" AND `UID`=\"$uid\" ORDER BY `SHOW_DATE` ASC, `SHOW_TIME` ASC";
	$StrGetappoint = mysqli_query($dbh, $quStrGetappoint) or die (mysqli_error($dbh));
	$num_clientappt = mysqli_num_rows($StrGetappoint);
?>

<B>Upcoming Client Appointments</B> (<?php echo $num_clientappt ;?>) <A HREF="<?php echo "$PHP_SELF?op=manageClients\" target=\"_creater\" TITLE=\"Create A New Client Appointment\">";
?>
<FONT SIZE="-3" COLOR="GREEN">Create New Client Appointment</FONT></A>&nbsp;&nbsp;<A HREF="<?php echo "$PHP_SELF?op=pastReminder\" target=\"_past\" TITLE=\"All Past Appointments & Reminders\""?>"><FONT  SIZE="-3" COLOR="#999999">Past Appointments &amp; Reminders</FONT></A><br><div class="controltext"><br><P>

<?php
	while ($rowappointget = mysqli_fetch_object($StrGetappoint)) {

if ($rowappointget->CLIENT_EMAIL !="") { $emailremind = "<A HREF='$PHP_SELF?op=mail_reminder&clid=$rowappointget->CLID'><img border='0' src='../images/clock_email.gif' alt='Email A Reminder' title='Email A Reminder'></A>"; } else { $emailremind = ""; }

echo "<NOBR>
&nbsp;<a href=\"$PHP_SELF?op=deleteAppointmentconf&clid=$rowappointget->CLID\" TITLE=\"Cancel Appointment\"><img border=\"0\" src=\"../images/clock_delete.gif\" alt=\"Delete\" title=\"Cancel Appointment\"></A>&nbsp;

<a href=\"$PHP_SELF?op=editClient&clid=$rowappointget->CLID#appointment\" target=\"_cled$rowappointget->CLID\" TITLE=\"Edit Appointment\"><img border=0 src=\"../images/clock_edit.gif\" alt=\"edit\" TITLE=\"h: $rowappointget->HOME_PHONE w: $rowappointget->WORK_PHONE c: $rowappointget->MOBILE_PHONE\"></A>";
?>
&nbsp;

<a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowappointget->CLID";?>#appointment" TITLE="Edit/View <?php echo $rowappointget->NAME_FIRST.$rowappointget->NAME_LAST;?>" target="_sh<?php echo $rowappointget->CLID;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History for <?php echo "$rowappointget->NAME_FIRST $rowappointget->NAME_LAST";?>" ALT="Showing History for <?php echo "$rowappointget->NAME_FIRST $rowappointget->NAME_LAST";?>"></A>

<?php echo "<a href=\"$PHP_SELF?op=editClient&clid=$rowappointget->CLID\" target=\"_cled$rowappointget->CLID\" TITLE=\"h: $rowappointget->HOME_PHONE w: $rowappointget->WORK_PHONE c: $rowappointget->MOBILE_PHONE\">&nbsp;".fuzDate($rowappointget->SHOW_DATE)." <FONT COLOR=\"#0099FF\">@</FONT> ".$rowappointget->SHOW_TIME." <FONT COLOR=\"#0099FF\">for</FONT> ".$rowappointget->SHOW_LENGTH." <FONT COLOR=\"#0099FF\">minutes with</FONT> ".$rowappointget->NAME_FIRST." ".$rowappointget->NAME_LAST."</A>&nbsp;&nbsp;$emailremind</NOBR><BR>" ;

}

?>

</DIV>
<BR>
<?php
$quStrGetremind = "SELECT * FROM `REMINDERS` WHERE `REMIND_DATE` >= '$now' AND `CLI`=\"$grid\" AND `UID`=\"$uid\" ORDER BY `REMIND_DATE` ASC";
	$StrGetremind = mysqli_query($dbh, $quStrGetremind) or die (mysqli_error($dbh));
	$num_addappt = mysqli_num_rows($StrGetremind);
?>

<B>Additional Appointments &amp; Reminders</B> (<?php echo $num_addappt ;?>) <A HREF="<?php echo "$PHP_SELF?op=createReminder\" target=\"_creater\" TITLE=\"Create Reminder\">";?><FONT SIZE="-3" COLOR="GREEN">Create New Additional Reminder</FONT></A><div class="controltext"><BR><P>

<?php
	while ($rowremindget = mysqli_fetch_object($StrGetremind)) {

echo "<NOBR>&nbsp;<a href=\"$PHP_SELF?op=deleteReminderconf&rid=$rowremindget->RID\" TITLE=\"Delete This Reminder\"><img border=\"0\" src=\"../images/clock_delete.gif\" alt=\"Delete\" title=\"Delete Reminder\"></a>&nbsp;";

echo "<a href=\"$PHP_SELF?op=editReminder&rid=$rowremindget->RID\" target=\"_ored$rowremindget->RID\" TITLE=\"Edit Appointment\"><img border=0 src=\"../images/clock_edit.gif\" alt=\"edit\" TITLE=\"Edit Appointment\">&nbsp;".fuzDate($rowremindget->REMIND_DATE)." <FONT COLOR='#999999'>@</FONT> ".$rowremindget->REMIND_TIME." <FONT COLOR='#999999'>for</FONT> ".$rowremindget->REMIND_LENGTH." <FONT COLOR='#999999'>minutes</FONT></A><BR><FONT COLOR=\"#0099FF\">".$rowremindget->REMIND."</FONT><BR>" ;
	
  }

?>
</DIV>












































<?php

if (($isAdmin) or ($user_level ==10)) {

if ($rowGetUser2->PREF_SHOW_APPT_O=="0") {



$quStrGetappoint = "SELECT * FROM CLIENTS WHERE  `SHOW_DATE` >= '$now' AND `GRID`=\"$grid\" AND CLIENTS.UID !=\"$uid\" ORDER BY `SHOW_DATE` ASC, `SHOW_TIME` ASC";
	$StrGetappoint = mysqli_query($dbh, $quStrGetappoint) or die (mysqli_error($dbh));
	$num_clientappt = mysqli_num_rows($StrGetappoint);
?>

<B>Upcoming Client Appointments For Other Agents </B> (<?php echo $num_clientappt ;?>) <A HREF="<?php echo "$PHP_SELF?op=manageClients\" target=\"_creater\" TITLE=\"Create A New Client Appointment\">";
?>
<div class="controltext"><br><P>

<?php
	while ($rowappointget = mysqli_fetch_object($StrGetappoint)) {

$quStrGetagent= "SELECT HANDLE FROM USERS WHERE  $rowappointget->UID=UID LIMIT 1";
	$StrGetagent = mysqli_query($dbh, $quStrGetagent) or die (mysqli_error($dbh));
	while ($rowagent = mysqli_fetch_object($StrGetagent)) {



echo "<NOBR>
&nbsp;<a href=\"$PHP_SELF?op=deleteAppointmentconf&clid=$rowappointget->CLID\" TITLE=\"Cancel Appointment\"><img border=\"0\" src=\"../images/clock_delete.gif\" alt=\"Delete\" title=\"Cancel Appointment\"></A>&nbsp;

<a href=\"$PHP_SELF?op=editClient&clid=$rowappointget->CLID#appointment\" target=\"_cled$rowappointget->CLID\" TITLE=\"Edit Appointment\"><img border=0 src=\"../images/clock_edit.gif\" alt=\"edit\" TITLE=\"h: $rowappointget->HOME_PHONE w: $rowappointget->WORK_PHONE c: $rowappointget->MOBILE_PHONE\"></A>";
?>
&nbsp;

<a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowappointget->CLID";?>#appointment" TITLE="Edit/View <?php echo $rowappointget->NAME_FIRST.$rowappointget->NAME_LAST;?>" target="_sh<?php echo $rowappointget->CLID;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History for <?php echo "$rowappointget->NAME_FIRST $rowappointget->NAME_LAST";?>" ALT="Showing History for <?php echo "$rowappointget->NAME_FIRST $rowappointget->NAME_LAST";?>"></A>

<?php echo "<a href=\"$PHP_SELF?op=editClient&clid=$rowappointget->CLID\" target=\"_cled$rowappointget->CLID\" TITLE=\"h: $rowappointget->HOME_PHONE w: $rowappointget->WORK_PHONE c: $rowappointget->MOBILE_PHONE\">&nbsp;".fuzDate($rowappointget->SHOW_DATE)." <FONT COLOR=\"#0099FF\">@</FONT> ".$rowappointget->SHOW_TIME." <FONT COLOR=\"#0099FF\">

with </FONT>".$rowagent->HANDLE." 


<FONT COLOR=\"#0099FF\">for</FONT> ".$rowappointget->SHOW_LENGTH." <FONT COLOR=\"#0099FF\">minutes with</FONT> ".$rowappointget->NAME_FIRST." ".$rowappointget->NAME_LAST."</A>&nbsp;&nbsp;$emailremind</NOBR><BR>" ;

}}

?>

</DIV>
<BR>
<?php
$quStrGetremind = "SELECT * FROM REMINDERS WHERE `REMIND_DATE` >= '$now' AND `CLI`=\"$grid\" AND REMINDERS.UID !=\"$uid\" ORDER BY `REMIND_DATE` ASC";
	$StrGetremind = mysqli_query($dbh, $quStrGetremind) or die (mysqli_error($dbh));
	$num_addappto = mysqli_num_rows($StrGetremind);
?>

<B>Additional Appointments &amp; Reminders For Other Agents</B> (<?php echo $num_addappto ;?>)<div class="controltext"><BR><P>

<?php
	while ($rowremindget = mysqli_fetch_object($StrGetremind)) {


$quStrGetagent= "SELECT HANDLE FROM USERS WHERE  $rowremindget->UID=UID LIMIT 1";
	$StrGetagent = mysqli_query($dbh, $quStrGetagent) or die (mysqli_error($dbh));
	while ($rowagent = mysqli_fetch_object($StrGetagent)) {


echo "<NOBR>&nbsp;<a href=\"$PHP_SELF?op=deleteReminderconf&rid=$rowremindget->RID\" TITLE=\"Delete This Reminder\"><img border=\"0\" src=\"../images/clock_delete.gif\" alt=\"Delete\" title=\"Delete Reminder\"></a>&nbsp;";

echo "<a href=\"$PHP_SELF?op=editReminder&rid=$rowremindget->RID\" target=\"_ored$rowremindget->RID\" TITLE=\"Edit Appointment\"><img border=0 src=\"../images/clock_edit.gif\" alt=\"edit\" TITLE=\"Edit Appointment\">&nbsp;".fuzDate($rowremindget->REMIND_DATE)." <FONT COLOR='#999999'>@</FONT> ".$rowremindget->REMIND_TIME." <FONT COLOR='#999999'>

with </FONT>".$rowagent->HANDLE."<FONT COLOR=\"#0099FF\"> 


for</FONT> ".$rowremindget->REMIND_LENGTH." <FONT COLOR='#999999'>minutes</FONT></A><BR><FONT COLOR=\"#0099FF\">".$rowremindget->REMIND."</FONT><BR>" ;
	
  }

}}
}
?>
</DIV>


























































<table width="100%" BORDER="0">
<tr>
<td><B>New Client Leads</B><br><div class="controltext"><P>


<?php
$num_today = mysqli_query($dbh, "SELECT * FROM CLIENTS where DATE_CREATED='$now' and ((GRID='$grid' AND UID='$uid') OR (GRID='$grid' AND SHARE_WITH='$uid'))");
$num_new_clients = mysqli_num_rows($num_today);

$num_3day = mysqli_query($dbh, "SELECT * FROM CLIENTS where (DATE_CREATED BETWEEN DATE_SUB(CURDATE() ,INTERVAL 3 DAY) AND CURDATE()) and ((GRID='$grid' AND UID='$uid') OR (GRID='$grid' AND SHARE_WITH='$uid'))");
$num_3day_clients = mysqli_num_rows($num_3day);

$num_7day = mysqli_query($dbh, "SELECT * FROM CLIENTS where (DATE_CREATED BETWEEN DATE_SUB(CURDATE() ,INTERVAL 7 DAY) AND CURDATE()) and ((GRID='$grid' AND UID='$uid') OR (GRID='$grid' AND SHARE_WITH='$uid'))");
$num_7day_clients = mysqli_num_rows($num_7day);
?>




<B>TODAY'S NEW CLIENT LEADS</B> <?php echo "($num_new_clients New Clients)"; ?><BR>

<I><a href="<?php echo "$PHP_SELF?op=hotlist-3days-clients";?>">Last 3 Day's New Client Leads</I> <?php echo "($num_3day_clients New Clients 3 days)"; ?> <FONT  SIZE="-3" COLOR="#999999">Click for list</FONT></A><BR>
<I><a href="<?php echo "$PHP_SELF?op=hotlist-1week-clients";?>">Current Week's New Client Leads</I> <?php echo "($num_7day_clients New Clients 7 days)"; ?>  <FONT  SIZE="-3" COLOR="#999999">Click for list</FONT></A><BR><BR>
<BR>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">

<?php 
$quStrGetTodaysClients = "select * from CLIENTS where DATE_CREATED='$now' and ((GRID='$grid' AND UID='$uid') OR (GRID='$grid' AND SHARE_WITH='$uid')) ORDER BY NAME_LAST";
	$quGetTodaysClients = mysqli_query($dbh, $quStrGetTodaysClients) or die (mysqli_error($dbh));

if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} 


while ($rowGetTodaysClients = mysqli_fetch_object($quGetTodaysClients)) {?>

<TR bgcolor="<?php echo $rowColor;?>">
<TD WIDTH="400">

		<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetTodaysClients->CLID";?>" target="_<?php echo $rowGetTodaysClients->CLID;?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo "$rowGetTodaysClients->NAME_FIRST $rowGetTodaysClients->NAME_LAST";?></a>

</TD>



<td WIDTH="16"><CENTER>
<?php

if ($rowGetTodaysClients->CLIENT_EMAIL) {

echo "<A HREF=\"$PHP_SELF?op=mail_client&clid=$rowGetTodaysClients->CLID\" target=\"_email$rowGetTodaysClients->CLID\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";
} else {
echo "&nbsp;";
}

; ?>

</CENTER></td>

<td ALIGN=CENTER  WIDTH="16"><div class="ad">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetTodaysClients->CLID";?>#appointment" TITLE="Make Appointment with <?php echo "$rowGetTodaysClients->NAME_FIRST  $rowGetTodaysClients->NAME_LAST";?>" target="appt<?php echo $rowGetTodaysClients->CLID;?>"><img border="0" hspace="0" vspace="0" width="19" height="19" src="../images/clock.gif" TITLE="Make an Appointment" ALT="Make an Appointment"></A>
</TD>


<td ALIGN=CENTER WIDTH="16"><div class="ad">

<a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowGetTodaysClients->CLID";?>" TITLE="Showing History for <?php echo "$rowGetTodaysClients->NAME_FIRST $rowGetTodaysClients->NAME_LAST";?>" target="_sh<?php echo $rowGetTodaysClients->CLID;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History" ALT="Showing History"></A>
</TD>

<td ALIGN=CENTER WIDTH="19"><div class="ad"><a href="<?php echo "$PHP_SELF?op=listings&client_id_filter=$rowGetTodaysClients->CLID";?>" target="match<?php echo $rowGetTodaysClients->CLID;?>"><img border="0" hspace="2" vspace="0" width="19" height="19" src="../assets/images/matchlistings.gif" TITLE="Match Client to Listings" ALT="Match Client to Listings"></a></div></td>



<TD ALIGN=RIGHT WIDTH="25">

		<?php if($rowGetTodaysClients->PUBLIC != "0") { echo "<FONT COLOR='#999999'>Shared</FONT>"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?>

</TD><TD WIDTH="5">

<?php if (($rowGetTodaysClients->UID=="$uid") OR ((($isAdmin) OR ($user_level >="4")) AND ($rowGetTodaysClients->UID!="$uid"))){ ?><A HREF="<?php echo "$PHP_SELF?op=editClientReassign&clid=$rowGetTodaysClients->CLID&fname=$rowGetTodaysClients->NAME_FIRST&lname=$rowGetTodaysClients->NAME_LAST";?>"><?php }?><img border="0" hspace="0" vspace="2" width="16" height="16" src="../assets/images/client-reassign.gif" TITLE="Reassign Client" ALT="Reassign Client"><?php if (($rowGetTodaysClients->UID=="$uid") OR ((($isAdmin) OR ($user_level >="4")) AND ($rowGetTodaysClients->UID!="$uid"))){ ?></A><?php }?>

</TD><TD WIDTH="30">

<?php if (($rowGetTodaysClients->UID=="$uid") AND ($user_level >1)) {?>
<div class="ad"><a href="<?php echo "$PHP_SELF?op=deleteClient&clid=$rowGetTodaysClients->CLID&return_page=hotlist";?>"><img border='0' vspace='0' hspace='0' src='../images/icons/delete.gif'></a></div>
<?php }?>


<?php if ((($isAdmin) or ($user_level ==10)) or ($user_level <4)){?>
<?php if ($rowGetTodaysClients->UID!="$uid") {?>

<div class="ad"><a href="<?php echo "$PHP_SELF?op=deleteClient&clid=$rowGetTodaysClients->CLID&return_page=hotlist";?>"><img border='0' vspace='0' hspace='0' src='../images/icons/delete.gif'></a></div>

<?php }?>
<?php }?>


</TD></TR><TR>
		
    	<?php
 if ($rowColor=="#F5F5DC" OR $rowColor=="$pref_row_color") {
    		$rowColor="#FFFFFF";
    	}else {

if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} 
    }
    }?>


</TR></TABLE>


<?php
if ($rowGetUser2->LISTSHAREDC=="y") {
?>

<BR>


<?php
	if($_SESSION['show_hot_list']) {
	$quStrGetHotList = "select * from HOTS where ITEM_TYPE='3' and UID!='$uid' and GRID='$grid' and PUBLIC!='0'";
	$quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die (mysqli_error($dbh));
	$num_HotList = mysqli_num_rows($quGetHotList);
?>

Clients Shared From Others in the office: (<?php echo $num_HotList;?>)<BR>

<TABLE BORDER=0 WIDTH="700"><TR>

<?php
	while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {?>

<TD WIDTH="650">

		<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetHotList->ITEM_ID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME;?></a>
</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25" ALIGN="right">
<?php if($rowGetHotList->PUBLIC != "0") { echo "<FONT COLOR='#999999'>Shared</FONT>"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?>

<?php if (($isAdmin) or ($user_level ==10)) {?>
</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25">
<a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=$op&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid";?>"><img border=0 src="../assets/images/icons/hotlist-del.gif" alt="delete from hot list"></a>
<?php } else { ?>


</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25">
&nbsp;
<?php } ?>


</TD></TR><TR>
	<?php }?>
<?php } ?>
</TR></TABLE>
<BR>

<?php } ?>


<BR>


</DIV>
<?php 
	if($_SESSION['show_hot_list']) {
	$quStrGetHotList = "select * from HOTS where ITEM_TYPE='1' and UID='$uid' and GRID='$grid' ORDER BY ITEM_NAME";
	$quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die (mysqli_error($dbh));
	$num_HotAds = mysqli_num_rows($quGetHotList);
?>
<B>Listings/Ads Hot List</B> (<?php echo $num_HotAds;?>)<div class="controltext"><BR><P>


<TABLE BORDER=0 WIDTH="830"><TR>

<?php 
	while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {?>

<TD WIDTH="750">
<?php

	$quStrGetHotListAd = "select * from CLASS where CID='$rowGetHotList->ITEM_ID' and CLI='$grid'";
	$quGetHotListAd = mysqli_query($dbh, $quStrGetHotListAd) or die (mysqli_error($dbh));
	while ($rowGetHotListAd = mysqli_fetch_object($quGetHotListAd)) {?>



<?php if ($rowGetHotListAd->STATUS=="ACT") { 
echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetHotList->ITEM_ID&return_page=hotlist'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/act.gif'></a>";
} else {
echo "<a href='$PHP_SELF?op=activate&cid=$rowGetHotList->ITEM_ID&return_page=hotlist'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/inact.jpg'></a>";
} ?>


<?php if($rowGetHotListAd->STATUS_ACTIVE =="1")  { ?>

<?php if ($user_level>0) {?>

                              <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetHotList->ITEM_ID . "&turn=unavailable&return_page=hotlist&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/a.jpg" border=0 height=14 width=14>
<?php if ($user_level>0) {?>
</a>
<?php }?>

			    <?php  } else { ?>
<?php if ($user_level>0) {?>
			      <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetHotList->ITEM_ID . "&turn=available&return_page=hotlist&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/u.jpg" border=0 height=14 width=14>
<?php if ($user_level>0) {?>
</a>
<?php } ?>
			<?php } ?>

<a href="<?php echo "$PHP_SELF?op=showinghistoryunit&cid=$rowGetHotList->ITEM_ID";?>" TITLE="Showing History" target="_sh<?php echo $rowGetHotList->CID;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Unit Showing History" ALT="Showing History for Unit"></A>

		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetHotList->ITEM_ID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME;?> <FONT SIZE="-1" COLOR='#999999'><B>- mod: <?php echo $rowGetHotListAd->MODBY;?> on <?php echo $rowGetHotListAd->MOD;?></FONT></B></A>


<?php } ?>


</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD ALIGN=RIGHT WIDTH="25">

<?php if($rowGetHotList->PUBLIC != "0") { echo "<FONT COLOR='#999999'>Shared</FONT>"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?> 

</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25">

<a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=$op&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid";?>"><img border=0 src="../assets/images/icons/hotlist-del.gif" alt="delete from hot list" TITLE="Delete from Hot List"></a>

</TD><TD WIDTH="16">

<a href="<?php echo "https://www.BostonApartments.com/clpost.php?ad=$rowGetHotList->ITEM_ID&cli=$grid&uid=$uid\" target=\"_CL".$rowGetHotList->ITEM_ID."\"";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif" TITLE="Post to CL"></A>


</TD></TR><TR>

	<?php }?>
<?php } ?>

</TR></TABLE>


<?php if ($rowGetUser2->LISTSHAREDL=="y") { ?>

<BR>

<?php
	if($_SESSION['show_hot_list']) {
	$quStrGetHotList = "select * from HOTS where ITEM_TYPE='1' and UID!='$uid' and GRID='$grid' and PUBLIC!='0' ORDER BY ITEM_NAME";
	$quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die (mysqli_error($dbh));
	$num_HotAdsO = mysqli_num_rows($quGetHotList);
?>
Listings/Ads From Others in the office: (<?php echo $num_HotAdsO;?>)<BR>

<TABLE BORDER=0 WIDTH="830"><TR>

<?php
	while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {
	$quStrGetHotListAd = "select * from CLASS where CID='$rowGetHotList->ITEM_ID' and CLI='$grid'";
	$quGetHotListAd = mysqli_query($dbh, $quStrGetHotListAd) or die (mysqli_error($dbh));
	while ($rowGetHotListAd = mysqli_fetch_object($quGetHotListAd)) {?>


<TD WIDTH="740">

<?php if ($rowGetHotListAd->STATUS=="ACT") { 
echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetHotList->ITEM_ID&return_page=hotlist'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/act.gif'></a>";
} else {
echo "<a href='$PHP_SELF?op=activate&cid=$rowGetHotList->ITEM_ID&return_page=hotlist'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/inact.jpg'></a>";
}

if($rowGetHotListAd->STATUS_ACTIVE =="1")  { 
if ($user_level>0) {?>

                              <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetHotList->ITEM_ID . "&turn=unavailable&return_page=hotlist&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/a.jpg" border=0 height=14 width=14>
<?php if ($user_level>0) {?>
</a>
<?php }?>

			    <?php  } else { ?>
<?php if ($user_level>0) {?>
			      <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetHotList->ITEM_ID . "&turn=available&return_page=hotlist&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/u.jpg" border=0 height=14 width=14>
<?php if ($user_level>0) {?>
</a>
<?php } } ?>


<a href="<?php echo "$PHP_SELF?op=showinghistoryunit&cid=$rowGetHotList->ITEM_ID";?>" TITLE="Showing History" target="_sh<?php echo $rowGetHotList->ITEM_ID;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Unit Showing History" ALT="Showing History for Unit"></A>

	<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetHotList->ITEM_ID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME;?> <B><FONT SIZE="-1" COLOR='#999999'>- mod: <?php echo $rowGetHotListAd->MODBY;?> on <?php echo $rowGetHotListAd->MOD;?></FONT></B></A>
<?php } ?>
</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD ALIGN=RIGHT WIDTH="25">

<?php if($rowGetHotList->PUBLIC != "0") { echo "<FONT COLOR='#999999'>Shared</FONT>"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; }?>

<?php if (($isAdmin) or ($user_level ==10)) {?>
</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25">
<a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=$op&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid";?>"><img border=0 src="../assets/images/icons/hotlist-del.gif" alt="delete from hot list" TITLE="Delete from Hot List"></a>
<?php } ?>


</TD><TD WIDTH="16">

<a href="<?php echo "https://www.BostonApartments.com/clpost.php?ad=$rowGetHotList->ITEM_ID&cli=$grid&uid=$uid\" target=\"_CL".$rowGetHotList->ITEM_ID."\"";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif"></A>


</TD></TR><TR>
		
	<?php }?>
<?php } ?>

</TR></TABLE>

<?php } ?>

</DIV>
<P><BR>
</td>
</tr>
</table>


<?php

if ($rowGetUser2->PREF_SHOW_PENDING_HOTLIST=="0") {

	if($_SESSION['show_hot_list']) {
	$quStrGetListing = "select * from ((CLASS INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) where CLI='$grid' and STATUS_PENDING!='0'";
	$quGetListing = mysqli_query($dbh, $quStrGetListing) or die (mysqli_error($dbh));
	$num_Pending = mysqli_num_rows($quGetListing);
?>

<SPAN style="font-size:14px;"><B>Listings/Ads Marked Pending <img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - Yes" title="Pending Status = YES - Check Status"></B> (<?php echo $num_Pending;?>)</SPAN><BR><BR>
<TABLE BORDER="0" WIDTH="700">
<?php
	while ($rowGetListing = mysqli_fetch_object($quGetListing)) {?>
	<TR>
<TD WIDTH="700" style="font-size:10px;">
<NOBR>	
<?php if($rowGetListing->STATUS_PENDING=="1")
			   { ?>
<?php if ($user_level>0) {?>
	                              <a href="<?php echo "$PHP_SELF?op=mark_status_pending&cid=".$rowGetListing->CID . "&turn=pendingno&return_page=hotlist&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - Yes" TITLE="Pending Status Yes - Click to change Pending Status">
<?php if ($user_level>0) {?>
</a>
<?php }?>
			    <?php  }  ?>


<?php if ($rowGetListing->STATUS=="ACT") { 
echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetListing->CID&return_page=hotlist'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/act.gif'></a>";
} else {
echo "<a href='$PHP_SELF?op=activate&cid=$rowGetListing->CID&return_page=hotlist'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/inact.jpg'></a>";
} ?>


<?php if($rowGetListing->STATUS_ACTIVE =="1")  { ?>

<?php if ($user_level>0) {?>

                              <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetListing->CID . "&turn=unavailable&return_page=hotlist&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/a.jpg" border=0 height=14 width=14>
<?php if ($user_level>0) {?>
</a>
<?php }?>

			    <?php  } else { ?>
<?php if ($user_level>0) {?>
			      <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetListing->CID . "&turn=available&return_page=hotlist&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/u.jpg" border=0 height=14 width=14>
<?php if ($user_level>0) {?>
</a>
<?php } ?>
			<?php } ?>


<a href="<?php echo "$PHP_SELF?op=showinghistoryunit&cid=$rowGetListing->CID";?>" TITLE="Showing History" target="_sh<?php echo $rowGetListing->CID;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Unit Showing History" ALT="Showing History for Unit"></A>


	<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetListing->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetListing->TYPENAME;?> - <?php echo $rowGetListing->LOCNAME;?> - $<?php echo $rowGetListing->PRICE;?> - <?php echo $rowGetListing->STREET_NUM;?> <?php echo $rowGetListing->STREET;?> #<?php echo $rowGetListing->APT;?> - Listing #<?php echo $rowGetListing->CID;?> - mod: <?php echo $rowGetListing->MODBY;?> on <?php echo $rowGetListing->MOD;?></a>
</NOBR>

<?php }?>
</DIV>
<P><BR>
</td>
</tr>
	
<?php } ?>

</table>
<?php } ?>

<?php if($_SESSION['show_hot_list']) {
	$quStrGetHotList = "select * from HOTS where ITEM_TYPE='3' and UID='$uid' and GRID='$grid'";
	$quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die (mysqli_error($dbh));
	$num_hot_clients = mysqli_num_rows($quGetHotList);
	?>
<B>Hot List Clients</B> (<?php echo $num_hot_clients;?>)<BR>

<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">


<?php 
if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} 

while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {

	$quStrGetClientH = "select * from CLIENTS where CLID='$rowGetHotList->ITEM_ID' and UID='$uid' and GRID='$grid' LIMIT 1";
	$quGetClientH = mysqli_query($dbh, $quStrGetClientH) or die (mysqli_error($dbh));

WHILE ($rowGetClientH = mysqli_fetch_object($quGetClientH)) {
?>
<TR bgcolor="<?php echo $rowColor;?>">
<TD WIDTH="400">
<div class="controltext">
		<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetHotList->ITEM_ID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME;?></a>

</TD>

<TD  style="font-size:14px;" WIDTH="30">
<div class="controltext">
<?php echo $rowGetClientH->DATE_NEXT_CONTACT;?><BR>
<?php
foreach ($DEFINED_VALUE_SETS['CLIENT_STATUS2'] as $cskey => $csValue) { 

if ($rowGetClientH->CLIENT_STATUS2 == "$cskey") {
echo "<NOBR>$csValue</NOBR>";
}
}
?>
</DIV>
</TD>


<td WIDTH="16"><CENTER>

<?php
if ($rowGetClientH->CLIENT_EMAIL !="") {
echo "<A HREF=\"$PHP_SELF?op=mail_client&clid=$rowGetHotList->ITEM_ID\" target=\"_email$rowGetHotList->ITEM_ID\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";
}else {
echo "&nbsp;";
}; ?>

</CENTER></td>

<td ALIGN=CENTER  WIDTH="16"><div class="ad">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetHotList->ITEM_ID";?>#appointment" TITLE="Make Appointment with <?php echo $rowGetHotList->ITEM_NAME;?>"><img border="0" hspace="0" vspace="0" width="19" height="19" src="../images/clock.gif" TITLE="Make an Appointment" ALT="Make an Appointment"></A>
</TD>


<td ALIGN=CENTER WIDTH="16"><div class="ad">

<a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowGetHotList->ITEM_ID";?>" TITLE="Showing History for <?php echo $rowGetHotList->ITEM_NAME;?>" target="_sh<?php echo $rowGetHotList->ITEM_NAME;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History" ALT="Showing History"></A>
</TD>
<td ALIGN=CENTER WIDTH="19"><div class="ad"><a href="<?php echo "$PHP_SELF?op=listings&client_id_filter=$rowGetHotList->ITEM_ID";?>"><img border="0" hspace="2" vspace="0" width="19" height="19" src="../assets/images/matchlistings.gif" TITLE="Match Client to Listings" ALT="Match Client to Listings"></a></div></td>
<TD ALIGN=RIGHT WIDTH="20">

		<?php if($rowGetClientH->PUBLIC != "0") { echo "<div class=\"controltext\"><FONT COLOR='#999999'>Shared</FONT></DIV>"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?>

</TD>


<TD WIDTH="5">

<?php if (($rowGetClientH->UID=="$uid") OR ((($isAdmin) OR ($user_level >="4")) AND ($rowGetClientH->UID!="$uid"))){ ?><A HREF="<?php echo "$PHP_SELF?op=editClientReassign&clid=$rowGetClientH->CLID&fname=$rowGetClientH->NAME_FIRST&lname=$rowGetClientH->NAME_LAST";?>"><?php }?><img border="0" hspace="0" vspace="2" width="16" height="16" src="../assets/images/client-reassign.gif" TITLE="Reassign Client" ALT="Reassign Client"><?php if (($rowGetClientH->UID=="$uid") OR ((($isAdmin) OR ($user_level >="4")) AND ($rowGetClientH->UID!="$uid"))){ ?></A><?php }?>

</TD>


<TD WIDTH="16">
<a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=hotlist&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid";?>"><img border=0 src="../assets/images/icons/hotlist-del.gif" alt="delete from hot list"></a>
</DIV>

</TD>
</TR>
		<?php }?>


    	<?php
 if ($rowColor=="#F5F5DC" OR $rowColor=="$pref_row_color") {
    		$rowColor="#FFFFFF";
    	}else {

if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} 
    }
    }?>

</TABLE>
<?php } ?>


<?php if($_SESSION['show_hot_list']) {




if (($isAdmin) or ($user_level ==10)) {

$quStrGetneedatt = "SELECT * FROM CLIENTS where STATUS_CLIENT='1' AND DATE_NEXT_CONTACT<='$now' and GRID='$grid' ORDER BY DATE_NEXT_CONTACT";
	$quGetneedatt = mysqli_query($dbh, $quStrGetneedatt) or die (mysqli_error($dbh));
	$num_clients_needatt = mysqli_num_rows($quGetneedatt);

} else {

$quStrGetneedatt = "SELECT * FROM CLIENTS where STATUS_CLIENT='1' AND DATE_NEXT_CONTACT<='$now' and GRID='$grid' AND UID='$uid' ORDER BY DATE_NEXT_CONTACT";
	$quGetneedatt = mysqli_query($dbh, $quStrGetneedatt) or die (mysqli_error($dbh));
	$num_clients_needatt = mysqli_num_rows($quGetneedatt);

}

?>

<B>Active Clients Needing Attention</B>  (<?php echo $num_clients_needatt;?>)<BR>

<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">


<?php

if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} 

while ($rowGetneedatt = mysqli_fetch_object($quGetneedatt)) {?>

<TR bgcolor="<?php echo $rowColor;?>"><TD WIDTH="400">
<div class="controltext">
		<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetneedatt->CLID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo "$rowGetneedatt->NAME_FIRST $rowGetneedatt->NAME_LAST";?></a>


<?php
if ((($isAdmin) or ($user_level ==10)) AND ($rowGetneedatt->UID !=$uid)){

$quStrGetneedagent = "SELECT HANDLE, UID FROM USERS where USERS.UID='$rowGetneedatt->UID' LIMIT 1";
	$quGetneedagent = mysqli_query($dbh, $quStrGetneedagent) or die (mysqli_error($dbh));
while ($rowGetneedagent = mysqli_fetch_object($quGetneedagent)) {;


echo " | <FONT size=-1><I> $rowGetneedagent->HANDLE</I></FONT>";
}
}
?>

</DIV>
</TD>



<TD  style="font-size:14px;" WIDTH="30">
<div class="controltext">
<NOBR><?php echo $rowGetneedatt->DATE_NEXT_CONTACT;?></NOBR><BR>
<?php
foreach ($DEFINED_VALUE_SETS['CLIENT_STATUS2'] as $cskey => $csValue) { 

if ($rowGetneedatt->CLIENT_STATUS2 == "$cskey") {
echo "<NOBR>$csValue</NOBR>";
}
}
?>
</DIV>
</TD>

<td WIDTH="16"><CENTER>
<?php

if ($rowGetneedatt->CLIENT_EMAIL) {

echo "<A HREF=\"$PHP_SELF?op=mail_client&clid=$rowGetneedatt->CLID\" target=\"_email$rowGetneedatt->CLID\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";
} else {
echo "&nbsp;";
}

; ?>

</CENTER></td>

<td ALIGN=CENTER  WIDTH="16"><div class="ad">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetneedatt->CLID";?>#appointment" TITLE="Make Appointment with <?php echo "$rowGetneedatt->NAME_FIRST  $rowGetneedatt->NAME_LAST";?>" target="appt<?php echo $rowGetneedatt->CLID;?>"><img border="0" hspace="0" vspace="0" width="19" height="19" src="../images/clock.gif" TITLE="Make an Appointment" ALT="Make an Appointment"></A>
</TD>


<td ALIGN=CENTER WIDTH="16"><div class="ad">

<a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowGetneedatt->CLID";?>" TITLE="Showing History for <?php echo "$rowGetneedatt->NAME_FIRST $rowGetneedatt->NAME_LAST";?>" target="_sh<?php echo $rowGetneedatt->CLID;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History" ALT="Showing History"></A>
</TD>

<td ALIGN=CENTER WIDTH="19"><div class="ad"><a href="<?php echo "$PHP_SELF?op=listings&client_id_filter=$rowGetneedatt->CLID";?>" target="match<?php echo $rowGetneedatt->CLID;?>"><img border="0" hspace="2" vspace="0" width="19" height="19" src="../assets/images/matchlistings.gif" TITLE="Match Client to Listings" ALT="Match Client to Listings"></a></div></td>

<TD ALIGN=RIGHT WIDTH="25">

		<?php if($rowGetneedatt->PUBLIC != "0") { echo "<div class=\"controltext\"><FONT COLOR='#999999'>Shared</FONT></DIV>"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?>

</TD><TD WIDTH="5">

<?php if (($rowGetneedatt->UID=="$uid") OR ((($isAdmin) OR ($user_level >="4")) AND ($rowGetneedatt->UID!="$uid"))){ ?><A HREF="<?php echo "$PHP_SELF?op=editClientReassign&clid=$rowGetneedatt->CLID&fname=$rowGetneedatt->NAME_FIRST&lname=$rowGetneedatt->NAME_LAST";?>"><?php }?><img border="0" hspace="0" vspace="2" width="16" height="16" src="../assets/images/client-reassign.gif" TITLE="Reassign Client" ALT="Reassign Client"><?php if (($rowGetneedatt->UID=="$uid") OR ((($isAdmin) OR ($user_level >="4")) AND ($rowGetneedatt->UID!="$uid"))){ ?></A><?php }?>

</TD><TD WIDTH="16">



<?php
if ($rowGetneedatt->STATUS_CLIENT=="2"){
if ($user_level >"1") { ?><a href="<?php echo "$PHP_SELF?op=client-active&clid=$rowGetneedatt->CLID&cluid=$rowGetneedatt->UID&return=hotlist";?>"><?php }?><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/client-inactive.jpg"><?php if ($user_level >"1") { ?></a><?php }?><?php }
if ($rowGetneedatt->STATUS_CLIENT!="2"){
		if ($user_level >"1") { ?><a href="<?php echo "$PHP_SELF?op=client-inactive&clid=$rowGetneedatt->CLID&cluid=$rowGetneedatt->UID&return=hotlist";?>"><?php }?><img border="0" hspace="2" vspace="0" width="16" height="16" src="../assets/images/client-active.jpg"><?php if ($user_level >"1") { ?></a><?php }?>
<?php } ?>

</TD></TR><TR>
		
    	<?php
 if ($rowColor=="#F5F5DC" OR $rowColor=="$pref_row_color") {
    		$rowColor="#FFFFFF";
    	}else {

if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} 
    }
    }?>
	
<?php } ?>

</TR></TABLE>

</DIV>
<P><BR>
</td>
</tr>
</table>









<?php

if ($user_level >=1) {

$quStrGetllneedatt = "SELECT * FROM LANDLORD where NEXT_CONTACT<='$now' and GRID='$grid' ORDER BY NEXT_CONTACT";
$quGetllneedatt = mysqli_query($dbh, $quStrGetllneedatt) or die (mysqli_error($dbh));
$num_ll_needatt = mysqli_num_rows($quGetllneedatt);
?>
<B>Landlords Needing Attention</B>  (<?php echo $num_ll_needatt;?>)<BR>

<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">


<?php

if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} 

while ($rowGetllneedatt = mysqli_fetch_object($quGetllneedatt)) {?>

<TR bgcolor="<?php echo $rowColor;?>"><TD WIDTH="400">
<div class="controltext">
		<a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowGetllneedatt->LID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo "$rowGetllneedatt->SHORT_NAME $rowGetllneedatt->NAME_FIRST $rowGetllneedatt->NAME_LAST";?></a>

</DIV>
</TD>

<TD  style="font-size:14px;" WIDTH="30">
<div class="controltext">

<?php
foreach ($DEFINED_VALUE_SETS['LAST_CONTACT_ACTION'] as $lcakey => $lcaValue) { 

if ($rowGetllneedatt->LAST_CONTACT_ACTION == "$lcakey") {
echo "<NOBR>$lcaValue</NOBR><BR>";
}
}
?>
<NOBR><?php echo $rowGetllneedatt->LAST_CONTACTED;?></NOBR><BR>

</DIV>
</TD>

<TD  style="font-size:14px;" WIDTH="30">
<div class="controltext">
<NOBR><?php echo $rowGetllneedatt->NEXT_CONTACT;?></NOBR><BR>
</DIV>
</TD>


<td ALIGN=CENTER  WIDTH="16"><div class="ad">
<?php 

if ($rowGetllneedatt->OFF_PHONE) {
echo "<NOBR>O: $rowGetllneedatt->OFF_PHONE</NOBR>";}

if (($rowGetllneedatt->OFF_PHONE) AND ($rowGetllneedatt->HOME_PHONE)) {echo "<BR>";}


if ($rowGetllneedatt->HOME_PHONE) {
echo "<NOBR>H: $rowGetllneedatt->HOME_PHONE</NOBR>";
}?>

</DIV>
</TD>


<td WIDTH="16"><div class="controltext"><CENTER>
<?php
echo "<NOBR>";

if ($rowGetllneedatt->OFF_EMAIL) {
echo "O: <A HREF=\"mailto:$rowGetllneedatt->OFF_EMAIL\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=10 WIDTH=16></A>";
} else {
echo "&nbsp;";
}

if (($rowGetllneedatt->OFF_EMAIL) AND ($rowGetllneedatt->LL_EMAIL)) {echo "<BR>";}


if ($rowGetllneedatt->LL_EMAIL) {
echo "H: <A HREF=\"mailto:$rowGetllneedatt->LL_EMAIL\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=10 WIDTH=16></A>";
} else {
echo "&nbsp;";
}

echo "</NOBR>";
 
 if ($rowColor=="#F5F5DC" OR $rowColor=="$pref_row_color") {
    		$rowColor="#FFFFFF";
    	}else {

if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} }

 
 
 }} 


 
 
 
 
 
 
 ?>

</CENTER></DIV></td>




</TR></TABLE>

</DIV>











<BR>

<table width="100%" BORDER="0">
<tr>

<?php
	if($_SESSION['show_hot_list']) {
	$quStrGetHotList = "select * from HOTS where ITEM_TYPE='2' and UID='$uid' and GRID='$grid'";
	$quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die (mysqli_error($dbh));
	$num_DS = mysqli_num_rows($quGetHotList);
?>


<td style="font-size:14px;"><B>Deals Hot List</B> (<?php echo $num_DS;?>)<div class="controltext"><BR><P>

<TABLE BORDER=0 WIDTH="700"><TR>

<?php
	while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {?>

<TD WIDTH="650">

		<a href="<?php echo "$PHP_SELF?op=editDeal&did=$rowGetHotList->ITEM_ID&cid=$rowGetHotList->ITEM_ID2";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME;?></a>
</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD ALIGN=RIGHT WIDTH="25">

<?php if($rowGetHotList->PUBLIC != "0") { echo "<FONT COLOR='#999999'>Shared</FONT>"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?> 

</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25">

<a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=hotlist&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid";?>"><img border=0 src="../assets/images/icons/hotlist-del.gif" alt="delete from hot list"><br>

</TD></TR><TR>
	
	<?php }?>
<?php } ?>

</TR></TABLE>

<BR>


<?php
	if($_SESSION['show_hot_list']) {
	$quStrGetHotList = "select * from HOTS where ITEM_TYPE='2' and UID!='$uid' and GRID='$grid' and PUBLIC!='0'";
	$quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die (mysqli_error($dbh));
	$num_DSO = mysqli_num_rows($quGetHotList);
?>
Deal Sheets Shared From Others in the office (<?php echo $num_DSO;?>)<BR>

<TABLE BORDER=0 WIDTH="700"><TR>
<?php
	while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {?>

<TD WIDTH="650">

		<a href="<?php echo "$PHP_SELF?op=editDeal&did=$rowGetHotList->ITEM_ID&cid=$rowGetHotList->ITEM_ID2";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME;?></a>
</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD ALIGN=RIGHT WIDTH="25">
<?php if($rowGetHotList->PUBLIC != "0") { echo "<FONT COLOR='#999999'>Shared</FONT>"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?>

<?php if (($isAdmin) or ($user_level ==10)) {?>
</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="16">
<a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=$op&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid";?>"><img border=0 src="../assets/images/icons/hotlist-del.gif" alt="delete from hot list"></a>
<?php } else { ?>


</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="5">
&nbsp;
<?php } ?>


</TD></TR><TR>	
	<?php }?>
<?php } ?>
</TR></TABLE>

<BR>

<HR>
<P>



<?php
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where DATEIN='$now' and CLI='$grid' ORDER BY CLASS.TYPE, LANDLORD, LOC, STREET, STREET_NUM, APT";
	$quGetTodays = mysqli_query($dbh, $quStrGetTodays) or die (mysqli_error($dbh));
	$num_TNL = mysqli_num_rows($quGetTodays);
?>

<FONT style="font-size:14px;"><B>TODAY'S LISTING ADDITIONS <img src="../assets/images/icons/a.jpg" border=0 height=12 width=12> &amp; <img src="../assets/images/icons/u.jpg" border=0 height=12 width=12></B> (<?php echo $num_TNL;?>)</FONT><BR>
<P>
<I><a href="<?php echo "$PHP_SELF?op=hotlist-3days";?>">Last 3 Day's Listings</I> <FONT  SIZE="-3" COLOR="#999999">Click for list</FONT></A><BR>
<I><a href="<?php echo "$PHP_SELF?op=hotlist-1week";?>">Current Week's Listings</I> <FONT  SIZE="-3" COLOR="#999999">Click for list</FONT></A><BR>
<P>

<TABLE BORDER=0 WIDTH="100%"><TR>
<?php
	while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {?>
<TD>
<FONT style="font-size:12px;">
		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
<?php if ($rowGetTodays->STATUS=="ACT") { 
echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetTodays->CID&return_page=hotlist&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/act.gif'></a>";
} else {
echo "<a href='$PHP_SELF?op=activate&cid=$rowGetTodays->CID&return_page=hotlist&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/inact.jpg'></a>";
} ?>

<?php if($rowGetTodays->STATUS_ACTIVE =="1")  { ?>

<?php if ($user_level>0) {?>

                              <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetTodays->CID . "&turn=unavailable&return_page=hotlist&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/a.jpg" border=0 height=14 width=14>
<?php if ($user_level>0) {?>
</a>
<?php }?>

			    <?php  } else { ?>
<?php if ($user_level>0) {?>
			      <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetTodays->CID . "&turn=available&return_page=hotlist&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/u.jpg" border=0 height=14 width=14>
<?php if ($user_level>0) {?>
</a>
<?php } ?>
			<?php } ?>

<a href="<?php echo "https://www.BostonApartments.com/clpost.php?ad=$rowGetTodays->CID&cli=$grid&uid=$uid\" target=\"_CL".$rowGetHotList->ITEM_ID."\"";?>"><img width="12" height="12" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif"></A>


&nbsp;
<?php echo "$rowGetTodays->TYPENAME";?> - <?php echo $rowGetTodays->LOCNAME;?>&nbsp;
<?php echo $rowGetTodays->ROOMS;?> Beds-<?php echo $rowGetTodays->BATH;?> Bath - <?php echo $rowGetTodays->STREET_NUM;?> <?php echo $rowGetTodays->STREET;?> <?php echo $rowGetTodays->APT;?> -
$<?php echo $rowGetTodays->PRICE;?> | <?php echo $rowGetTodays->SHORT_NAME;?> | Mod:<?php echo $rowGetTodays->MODBY;?></a>
</FONT>
</TD></TR><TR>
	<?php }?>
</TR></TABLE>
<BR>


<?php 
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where CLASS.MOD='$now' and DATEIN!='$now' and CLI='$grid' AND STATUS_ACTIVE='1' ORDER BY CLASS.TYPE, LANDLORD, LOC, STREET, STREET_NUM, APT";
	$quGetTodays = mysqli_query($dbh, $quStrGetTodays) or die (mysqli_error($dbh));
	$num_TMAL = mysqli_num_rows($quGetTodays);
	?>

<FONT style="font-size:14px;"><B>TODAY'S MODIFIED AVAILABLE <img src="../assets/images/icons/a.jpg" border=0 height=12 width=12> LISTINGS:</B> (<?php echo $num_TMAL;?>)</FONT><BR>



<TABLE BORDER=0 WIDTH="100%"><TR>
<?php	while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {?>
<TD>
<FONT style="font-size:12px;">
		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
<?php if ($rowGetTodays->STATUS=="ACT") { 
echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetTodays->CID&return_page=hotlist&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/act.gif'></a>";
} else {
echo "<a href='$PHP_SELF?op=activate&cid=$rowGetTodays->CID&return_page=hotlist&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/inact.jpg'></a>";
} ?>


<a href="<?php echo "https://www.BostonApartments.com/clpost.php?ad=$rowGetTodays->CID&cli=$grid&uid=$uid\" target=\"_CL".$rowGetHotList->ITEM_ID."\"";?>"><img width="12" height="12" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif"></A>

&nbsp;
<?php echo "$rowGetTodays->TYPENAME";?> -  <?php echo $rowGetTodays->LOCNAME;?>&nbsp;
<?php echo $rowGetTodays->ROOMS;?> Beds-<?php echo $rowGetTodays->BATH;?> Bath - <?php echo $rowGetTodays->STREET_NUM;?> <?php echo $rowGetTodays->STREET;?> <?php echo $rowGetTodays->APT;?> -
$<?php echo $rowGetTodays->PRICE;?> | <?php echo $rowGetTodays->SHORT_NAME;?> | Mod:<?php echo $rowGetTodays->MODBY;?></A>
</FONT>
</TD></TR><TR>
	<?php }?>
</TR></TABLE>

<BR>
<?php 
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where CLASS.MOD='$now' and DATEIN!='$now' and CLI='$grid' AND STATUS_ACTIVE!='1' ORDER BY CLASS.TYPE, LANDLORD, LOC, STREET, STREET_NUM, APT";
	$quGetTodays = mysqli_query($dbh, $quStrGetTodays) or die (mysqli_error($dbh));
	$num_TMUL = mysqli_num_rows($quGetTodays);
?>
<FONT style="font-size:14px;"><B>TODAY'S MODIFIED <FONT COLOR="RED">UN</FONT>AVAILABLE <img src="../assets/images/icons/u.jpg" border=0 height=12 width=12> LISTINGS:</B> (<?php echo $num_TMUL;?>)</FONT><BR>
<TABLE BORDER=0 WIDTH="100%"><TR>
<?php 	while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {?>
<TD>
<FONT style="font-size:12px;">
		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
<?php if ($rowGetTodays->STATUS=="ACT") { 
echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetTodays->CID&return_page=hotlist&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/act.gif'></a>";
} else {
echo "<a href='$PHP_SELF?op=activate&cid=$rowGetTodays->CID&return_page=hotlist&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/inact.jpg'></a>";
} ?>
&nbsp;
<?php echo "$rowGetTodays->TYPENAME";?> - <?php echo $rowGetTodays->LOCNAME;?>&nbsp;
<?php echo $rowGetTodays->ROOMS;?> Beds-<?php echo $rowGetTodays->BATH;?> Bath - <?php echo $rowGetTodays->STREET_NUM;?> <?php echo $rowGetTodays->STREET;?> <?php echo $rowGetTodays->APT;?> -
$<?php echo $rowGetTodays->PRICE;?> | <?php echo $rowGetTodays->SHORT_NAME;?> | Mod:<?php echo $rowGetTodays->MODBY;?></a>
</FONT>
</TD></TR><TR>
	<?php }?>
</TR></TABLE>

</DIV>
<P><BR>
</td>
</tr>
</table>

<?php if ($rowGetUser2->SHOWGOOGLE=="y") { ?>
<TABLE BORDER=0 WIDTH="100%"><TR><TD>
<CENTER>
<!-- Include the Google Friend Connect javascript library. -->
<script type="text/javascript" src="http://www.google.com/friendconnect/script/friendconnect.js"></script>
<!-- Define the div tag where the gadget will be inserted. -->
<div id="div-3433427515832929140" style="width:276px;border:1px solid #cccccc;"></div>
<!-- Render the gadget into a div. -->
<script type="text/javascript">
var skin = {};
skin['BORDER_COLOR'] = '#cccccc';
skin['ENDCAP_BG_COLOR'] = '#e0ecff';
skin['ENDCAP_TEXT_COLOR'] = '#333333';
skin['ENDCAP_LINK_COLOR'] = '#0000cc';
skin['ALTERNATE_BG_COLOR'] = '#ffffff';
skin['CONTENT_BG_COLOR'] = '#ffffff';
skin['CONTENT_LINK_COLOR'] = '#0000cc';
skin['CONTENT_TEXT_COLOR'] = '#333333';
skin['CONTENT_SECONDARY_LINK_COLOR'] = '#7777cc';
skin['CONTENT_SECONDARY_TEXT_COLOR'] = '#666666';
skin['CONTENT_HEADLINE_COLOR'] = '#333333';
skin['NUMBER_ROWS'] = '4';
google.friendconnect.container.setParentUrl('/' /* location of rpc_relay.html and canvas.html */);
google.friendconnect.container.renderMembersGadget(
 { id: 'div-3433427515832929140',
   site: '00917586766472249347' },
  skin);
</script>
</CENTER>
</TD></TR></TABLE>

<?php } ?>
</font>
</center>
</TD></TR></TABLE>
<BR>
<!--END Hotlist -->