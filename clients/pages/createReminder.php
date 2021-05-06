<!--BEGIN createReminder -->
<?php
if ($_SESSION["pref_pagebg"]=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor=$_SESSION["pref_pagebg"];
} 
?>

<CENTER>
<TABLE BGCOLOR="#FFFFFF" WIDTH="760" BORDER="1" bordercolor="#000000"><TR><TD>
<CENTER>

<TABLE BGCOLOR="#FFFFFF" BORDER=0><TR>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/hotlist-pads.jpg" HEIGHT="54" WIDTH="120">
</TD>
<TD VALIGN="middle" ALIGN="CENTER">
<b><font size="+2">CREATE A REMINDER</font></b>
</TD>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/hotlist-pen.jpg" HEIGHT="54" WIDTH="120">
</TD></TR></TABLE>

<HR>
<CENTER>


<table width="100%" BORDER="0">
<tr>
<td>
<CENTER>

<form action="<?php echo "$PHP_SELF?op=createReminderDo";?>" method="POST">

<CENTER>

<TABLE BORDER="1" BORDERCOLOR="#000000" CELLPADDING="2" BGCOLOR="#FFFFFF"><TR><TD>
<TABLE><TR><TD>
<NOBR>Appointment on:</NOBR>
</TD><TD><NOBR>
<INPUT TYPE="TEXT" NAME="REMIND_DATE" id="REMIND_DATE" class="w16em dateformat-Y-ds-m-ds-d" SIZE="10"></NOBR>
</TD></TR><TR><TD>
Time: 
</TD><TD>
<select name="REMIND_TIME" id="REMIND_TIME">
<option value="00:00:00">12:00am</option>
<option value="00:30:00">12:30am</option>
<option value="01:00:00">1:00am</option>
<option value="01:30:00">1:30am</option>
<option value="02:00:00">2:00am</option>
<option value="02:30:00">2:30am</option>
<option value="03:00:00">3:00am</option>
<option value="03:30:00">3:30am</option>
<option value="04:00:00">4:00am</option>
<option value="04:30:00">4:30am</option>
<option value="05:00:00">5:00am</option>
<option value="05:30:00">5:30am</option>
<option value="06:00:00">6:00am</option>
<option value="06:30:00">6:30am</option>
<option value="07:00:00">7:00am</option>
<option value="07:30:00">7:30am</option>
<option value="08:00:00">8:00am</option>
<option value="08:30:00">8:30am</option>
<option value="08:45:00">8:45am</option>
<option value="09:00:00">9:00am</option>
<option value="09:15:00">9:15am</option>
<option value="09:30:00">9:30am</option>
<option value="09:45:00">9:45am</option>
<option value="10:00:00">10:00am</option>
<option value="10:15:00">10:15am</option>
<option value="10:30:00">10:30am</option>
<option value="10:45:00">10:45am</option>
<option value="11:00:00">11:00am</option>
<option value="11:15:00">11:15am</option>
<option value="11:30:00">11:30am</option>
<option value="11:45:00">11:45am</option>
<option value="12:00:00">12:00pm</option>
<option value="12:15:00">12:15pm</option>
<option value="12:30:00">12:30pm</option>
<option value="12:45:00">12:45pm</option>
<option value="13:00:00">1:00pm</option>
<option value="13:15:00">1:15pm</option>
<option value="13:30:00">1:30pm</option>
<option value="13:45:00">1:45pm</option>
<option value="14:00:00">2:00pm</option>
<option value="14:15:00">2:15pm</option>
<option value="14:30:00">2:30pm</option>
<option value="14:45:00">2:45pm</option>
<option value="15:00:00">3:00pm</option>
<option value="15:15:00">3:15pm</option>
<option value="15:30:00">3:30pm</option>
<option value="15:45:00">3:45pm</option>
<option value="16:00:00">4:00pm</option>
<option value="16:15:00">4:15pm</option>
<option value="16:30:00">4:30pm</option>
<option value="16:45:00">4:45pm</option>
<option value="17:00:00">5:00pm</option>
<option value="17:15:00">5:15pm</option>
<option value="17:30:00">5:30pm</option>
<option value="17:45:00">5:45pm</option>
<option value="18:00:00">6:00pm</option>
<option value="18:15:00">6:15pm</option>
<option value="18:30:00">6:30pm</option>
<option value="18:45:00">6:45pm</option>
<option value="19:00:00">7:00pm</option>
<option value="19:15:00">7:15pm</option>
<option value="19:30:00">7:30pm</option>
<option value="19:45:00">7:45pm</option>
<option value="20:00:00">8:00pm</option>
<option value="20:30:00">8:30pm</option>
<option value="21:00:00">9:00pm</option>
<option value="21:30:00">9:30pm</option>
<option value="22:00:00">10:00pm</option>
<option value="22:30:00">10:30pm</option>
<option value="23:00:00">11:00pm</option>
<option value="23:30:00">11:30pm</option>
</select>
</TD><TD></TR><TR><TD>
<NOBR>Appointment Length:</NOBR> 
</TD><TD>
<select name="REMIND_LENGTH" id="REMIND_LENGTH">
<option value="15">15 minutes</option>
<option value="30">30 minutes</option>
<option value="45">45 minutes</option>
<option value="60">1 hour</option>
<option value="90">1.5 hours</option>
<option value="120">2 hours</option>
<option value="180">3 hours</option>
<option value="240">4 hours</option>
</select>
</TD>

<TD ROWSPAN="3">
<NOBR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Create The Reminder" STYLE="Background-Color : #adffad"></NOBR>
</TD>
</TR></TABLE>

<TABLE  BGCOLOR="#FFFFFF"><TR>
			<td height="40"><div class="controltext"><NOBR>Reminder Notes:</NOBR></div><textarea name="REMIND" rows="5" cols="75"></textarea>
			<BR><BR>
			
			</td>
			</tr></table>
</TD></TR></TABLE>
	</form>
	<NOBR><B>Your Calendar to sync to to your Iphone, Outlook and more is:</B></NOBR><BR>
	<NOBR><A HREF="https://www.BostonApartments.com/calsync.php?cli=<?php echo $grid; ?>&uid=<?php echo $uid; ?>" target="ical">https://www.BostonApartments.com/calsync.php?cli=<?php echo $grid; ?>&uid=<?php echo $uid; ?></A></NOBR><BR>
<a href="<?php echo "$PHP_SELF?op=hotlist";?>" TITLE="Dashboard Stats & Shortcuts to Favorite Clients, Listings & more"><FONT SIZE="-1">Go to the Hot List to see all your appointments &amp; reminders</FONT></A><BR>
</td></TR></TABLE>


</TD></TR></TABLE>

</font>
</center>
</TD></TR></TABLE>
<!--END editReminders -->