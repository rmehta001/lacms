<!--BEGIN Past Reminders-->
<FONT SIZE="-3"><BR></FONT>
<CENTER>
<TABLE BGCOLOR="#FFFFFF" WIDTH="760" BORDER="1" bordercolor="#000000"><TR><TD>
<CENTER>

<TABLE BGCOLOR="#FFFFFF" BORDER=0><TR>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/hotlist-pads.jpg" HEIGHT="54" WIDTH="120">
</TD>
<TD VALIGN="middle" ALIGN="CENTER">
<b><font size="+2">PAST APPOINTMENTS &amp; REMINDERS</font></b>
</TD>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/hotlist-pen.jpg" HEIGHT="54" WIDTH="120">
</TD></TR></TABLE>
<HR>
</CENTER>



<table width="100%" BORDER="0">
<tr>
<td style="font-size:14px;">


<B>Past Client Appointments</B> <A HREF="<?php echo "$PHP_SELF?op=manageClients\" target=\"_creater\" TITLE=\"Create A New Client Appointment\">";
?><FONT SIZE="-3" COLOR="GREEN">Create New Client Appointment</FONT></A><br><div class="controltext"><br><P>

<?php

$quStrGetappoint = "SELECT * FROM `CLIENTS` WHERE `SHOW_DATE`< '$now' AND `GRID`=\"$grid\" AND `UID`=\"$uid\" ORDER BY `SHOW_DATE` ASC";

	$StrGetappoint = mysqli_query($dbh, $quStrGetappoint) or die (mysqli_error($dbh));
	while ($rowappointget = mysqli_fetch_object($StrGetappoint)) {
		echo "<NOBR>
&nbsp;<a href=\"$PHP_SELF?op=deleteAppointmentconf&clid=$rowappointget->CLID\" TITLE=\"Cancel Appointment\"><img border=\"0\" src=\"../images/clock_delete.gif\" alt=\"Delete\" title=\"Cancel Appointment\"></A>&nbsp;<a href=\"$PHP_SELF?op=editClient&clid=$rowappointget->CLID#appointment\" target=\"_cled$rowappointget->CLID\" TITLE=\"Edit Appointment\"><img border=0 src=\"../images/clock_edit.gif\" alt=\"edit\" TITLE=\"h: $rowappointget->HOME_PHONE w: $rowappointget->WORK_PHONE c: $rowappointget->MOBILE_PHONE\"></A><a href=\"$PHP_SELF?op=editClient&clid=$rowappointget->CLID\" target=\"_cled$rowappointget->CLID\" TITLE=\"h: $rowappointget->HOME_PHONE w: $rowappointget->WORK_PHONE c: $rowappointget->MOBILE_PHONE\">&nbsp;".fuzDate($rowappointget->SHOW_DATE)." <FONT COLOR=\"#0099FF\">@</FONT> ".$rowappointget->SHOW_TIME." <FONT COLOR=\"#0099FF\">for</FONT> ".$rowappointget->SHOW_LENGTH." <FONT COLOR=\"#0099FF\">minutes with</FONT> ".$rowappointget->NAME_FIRST." ".$rowappointget->NAME_LAST."</A></NOBR><BR>" ;
  }

?>

</DIV>
<BR>

<B>Past Additional Appointments &amp; Reminders</B> <A HREF="<?php echo "$PHP_SELF?op=createReminder";?>"  target="_creater" TITLE="Create Reminder">
&nbsp;
<FONT SIZE="-3" COLOR="GREEN">Create New Reminder</FONT></A><div class="controltext">
<BR><P>

<?php
$quStrGetremind = "SELECT * FROM `REMINDERS` WHERE `REMIND_DATE` <= NOW() AND `CLI`=\"$grid\" AND `UID`=\"$uid\" ORDER BY `REMIND_DATE` ASC";

	$StrGetremind = mysqli_query($dbh, $quStrGetremind) or die (mysqli_error($dbh));
	while ($rowremindget = mysqli_fetch_object($StrGetremind)) {

echo "<NOBR>&nbsp;<a href=\"$PHP_SELF?op=deleteReminderconf&rid=$rowremindget->RID\" TITLE=\"Delete This Reminder\"><img border=\"0\" src=\"../images/clock_delete.gif\" alt=\"Delete\" title=\"Delete Reminder\"></a> &nbsp;";

echo "<a href=\"$PHP_SELF?op=editReminder&rid=$rowremindget->RID\" target=\"_ored$rowremindget->RID\" TITLE=\"Edit Appointment\"><img border=0 src=\"../images/clock_edit.gif\" alt=\"edit\" TITLE=\"Edit Appointment\">&nbsp;".fuzDate($rowremindget->REMIND_DATE)." <FONT COLOR='#999999'>@</FONT> ".$rowremindget->REMIND_TIME." <FONT COLOR='#999999'>for</FONT> ".$rowremindget->REMIND_LENGTH." <FONT COLOR='#999999'>minutes</FONT></A><BR><FONT COLOR=\"#0099FF\">".$rowremindget->REMIND."</FONT><BR>" ;
	
  }

?>
</DIV>


</CENTER>
</TD></TR></TABLE>

</font>
</center>
</TD></TR></TABLE>
<BR>
<!--END PastReminders -->