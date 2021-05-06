<!--BEGIN showings -->
<?php
if (isset($pref_pagebg))
if($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>

<CENTER>
<TABLE BGCOLOR="#FFFFFF" WIDTH="800" BORDER="1" bordercolor="#000000"><TR><TD>
<CENTER>

<TABLE BGCOLOR="#FFFFFF" BORDER=0><TR>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/hotlist-pads.jpg" HEIGHT="54" WIDTH="120">
</TD>
<TD VALIGN="middle" ALIGN="CENTER">
<b><font size="+2">LANDLORD COMMENTS</font></b>
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





<CENTER>

<TABLE BORDER="1" BORDERCOLOR="#000000" CELLPADDING="2" BGCOLOR="#FFFFFF" WIDTH="95%"><TR><TD>
<CENTER><B><FONT SIZE="+1">LANDLORD COMMENT HISTORY</FONT></B>
<div class="controltext">
<a href="<?php echo "$PHP_SELF?op=createllcomments&llid=$llid";?>" TITLE="Add Landlord Comment" target="_sh<?php echo $llid;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings.jpg" TITLE="Add Landlord Comment" ALT="Landlord Comments"> Add a New Landlord Comment</A>
</div>
</CENTER>

<?php
$quStrComment = "SELECT * FROM `LANDLORD_COMMENTS` WHERE `CLI`=\"$grid\" AND `LLID`=\"$llid\" ORDER BY `LLCOMMENT_ID` DESC";
$StrGetComment = mysqli_query($dbh, $quStrComment) or die (mysqli_error($dbh));
      if(mysqli_num_rows($StrGetComment)!=0){
?>

<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%"><TR>
<?php if ($user_level>"9") {?>
<TD WIDTH="5"> &nbsp; </TD>
<?php }?>

<TD WIDTH="75"><NOBR><FONT SIZE="-1"><B>COMMENT DATE</B></FONT></NOBR></TD><TD>&nbsp;</TD><TD WIDTH="50"><FONT SIZE="-1"><B>AGENT</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>COMMENTS</B></FONT></TD></TR>


<?php
$pref_row_color = $_SESSION['pref_row_color'];
if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} ?>


<?php
while ($rowComment = mysqli_fetch_object($StrGetComment)) {
?>


<TR bgcolor="<?php echo $rowColor;?>">

<TD>

<?php if ($user_level>"9") {?>
<center><nobr><a href="<?php echo "$PHP_SELF?op=deletellcomment&llid=$rowComment->LLID&llcomment_id=$rowComment->LLCOMMENT_ID";?>"><img border="0" src="../images/icons/delete.gif" alt="delete" title="DELETE this Comment FOREVER" vspace="0" hspace="0"></span></a><A HREF="<?php echo "$PHP_SELF?op=editllcomment&llid=$rowComment->LLID&llcomment_id=$rowComment->LLCOMMENT_ID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"></a></nobr>
</TD><TD>
<?php }?>

<NOBR><FONT SIZE="-1"><?php echo $rowComment->LLCOMMENT_DATE;?></FONT></NOBR></TD>
<TD>&nbsp;</TD>
<TD>
<nobr>
<?php echo "$rowComment->HANDLE";?>
</nobr>

</TD><TD>&nbsp;</TD>
<TD>
<?php echo $rowComment->LLCOMMENT;?></FONT>
</TD></TR>



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
	
	
<?php 
      } else {
echo "<CENTER><FONT COLOR=\"#FF0000\">Sorry, there are no comments for this landlord</FONT></CENTER><BR>";
} ?>
</TABLE>



</TD></TR></TABLE>


</td></TR>
</TABLE>


</TD></TR></TABLE>

</font>
</center>
</TD></TR></TABLE>
<!--END editReminders -->