
<!--BEGIN createReminder -->
<?php
$PHP_SELF = $_SERVER['PHP_SELF'];
$pref_pagebg = $_SESSION["pref_pagebg"];
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
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
<b><font size="+2">CREATE A CLIENT COMMENT</font></b>
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

<form action="<?php echo "$PHP_SELF?op=createshowingentryDo";?>" method="POST">

<input type="hidden" name="clid" value="<?php echo $clid;?>>
			<td height="40"><div class="controltext"><NOBR>Add to Client Comments / Showing History:</NOBR></div><textarea name="showcomment" rows="5" cols="75"></textarea>
			<BR><BR>
			

			<INPUT TYPE="SUBMIT" VALUE="Add to Client Comments / Showing History">
			
			</TD></TR></TABLE>
	</form>

<a href="<?php echo "$PHP_SELF?op=hotlist";?>" TITLE="Dashboard Stats & Shortcuts to Favorite Clients, Listings & more"><FONT SIZE="-1">Go to the Hot List to see all your appointments, reminders, &amp; showing history.</FONT></A><BR>
</td></TR></TABLE>


</TD></TR></TABLE>

</font>
</center>
</TD></TR></TABLE>
<!--END editReminders -->