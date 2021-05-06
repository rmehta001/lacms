<!--BEGIN edit ll comments -->
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
<b><font size="+2">EDIT A LANDLORD COMMENT</font></b>
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






<form action="<?php echo "$PHP_SELF?op=editllcommentDo";?>" method="POST">
<INPUT TYPE="HIDDEN" NAME="llid" VALUE="<?php echo $llid;?>">
<INPUT TYPE="HIDDEN" NAME="llcomment_id" VALUE="<?php echo $llcomment_id;?>">

<?php
$quStrComment = "SELECT * FROM `LANDLORD_COMMENTS` WHERE `CLI`=\"$grid\" AND `LLCOMMENT_ID`=\"$llcomment_id\"";
$StrGetComment = mysqli_query($dbh, $quStrComment) or die (mysqli_error($dbh));





while ($rowComment = mysqli_fetch_object($StrGetComment)) {
?>


<TABLE  BGCOLOR="#FFFFFF"><TR>
			<td height="40"><div class="controltext"><NOBR>Comments:</NOBR></div><textarea name="llcomment" rows="5" cols="75"><?php echo $rowComment->LLCOMMENT; ?></textarea>
			<BR><BR>
			
			</td>
			</tr></table>
</TD></TR></TABLE>

    <?php } ?>

	
	<INPUT TYPE="SUBMIT" VALUE="Save Edited Landlord Comment"> &nbsp; &nbsp; <A HREF="<?php echo "$PHP_SELF?op=llcomments&llid=$llid";?>"><INPUT TYPE="SUBMIT" VALUE="CANCEL"></A>
	
</form>


</td></TR></TABLE>


</TD></TR></TABLE>




</font>
</center>
</TD></TR></TABLE>
<!--END edit showing -->