<!--BEGIN createllcomments -->
<?php

if (isset($pref_pagebg))
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
<b><font size="+2">CREATE A LANDLORD COMMENT</font></b>
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

<form action="<?php echo "$PHP_SELF?op=createllcommentsDo";?>" method="POST">

<input type="hidden" name="llid" value="<?php echo $llid;?>">
			<td height="40"><div class="controltext">
			<CENTER>
			
			<NOBR>Add to Landlord Comments:</NOBR></CENTER></div>
			
			<CENTER>
			<textarea name="llcomment" rows="5" cols="75"></textarea>
			<BR><BR>
			

			<INPUT TYPE="SUBMIT" VALUE="Add to Landlord Comments">
			</CENTER>
			</TD></TR></TABLE>
	</form>
<center><A HREF="<?php echo "$PHP_SELF?op=editLandlord&lid=$llid";?>"><INPUT TYPE="SUBMIT" VALUE="CANCEL"></A>
	
<BR><BR>
<a href="<?php echo "$PHP_SELF?op=hotlist";?>" TITLE="Dashboard Stats & Shortcuts to Favorite Clients, Listings & more"><FONT SIZE="-1">Go to the Hot List to see all your appointments, reminders, &amp; showing history.</FONT></A><BR>
</td></TR></TABLE>


</TD></TR></TABLE>

</font>
</center>
</TD></TR></TABLE>
<!--END createllcomments -->