<!--BEGIN edit ll notes -->
<?php
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
<b><font size="+2">EDIT LANDLORD'S NOTES</font></b>
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


<?

if (($llid == 0) or ($llid == "")) { ?>

<CENTER><H3><FONT COLOR=RED>There is no Landlord to edit the notes for</FONT></H3></center>

<? } else { ?>


<form action="<?php echo "$PHP_SELF?op=editllnoteDo";?>" method="POST">
<INPUT TYPE="HIDDEN" NAME="llid" VALUE=<?php echo $llid;?>>

<?php

$quStrnote = "SELECT * FROM `LANDLORD` WHERE `GRID`=\"$grid\" AND `LID`=\"$llid\"";
$StrGetnote = mysqli_query($dbh, $quStrnote) or die (mysqli_error($dbh));


while ($rownote = mysqli_fetch_object($StrGetnote)) {
?>


<TABLE  BGCOLOR="#FFFFFF"><TR>
			<td height="40"><div class="controltext"><NOBR>Notes:</NOBR></div><textarea name="llnote" rows="5" cols="75"><?php echo $rownote->LLNOTES; ?></textarea>
			<BR><BR>
			
			</td>
			</tr></table>
</TD></TR></TABLE>

    <?php } ?>

	
	<INPUT TYPE="SUBMIT" VALUE="Save Edited Landlord Notes"> &nbsp; &nbsp; <A HREF="<?php echo "$PHP_SELF?op=llnote&llid=$llid";?>"><INPUT TYPE="SUBMIT" VALUE="CANCEL"></A>
	
</form>

<?php } ?>
<BR><BR>
</td></TR></TABLE>


</TD></TR></TABLE>




</font>
</center>
</TD></TR></TABLE>
<!--END edit showing -->