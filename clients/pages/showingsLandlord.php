<!--BEGIN showings -->
<?php

if(isset($pref_pagebg))
if ($pref_pagebg=="") {
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
<b><font size="+1">LANDLORD LISTING SHOWING HISTORY</font></b>
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
<CENTER><B><FONT SIZE="+1">LANDLORD SHOWINGS HISTORY</FONT></B>
</CENTER>

<?php
$quStrShow = "SELECT * FROM `SHOWINGS` WHERE `CLI`=\"$grid\" AND `LID`=\"$llid\" ORDER BY SHOWING_DATE DESC";
$StrGetShow = mysqli_query($dbh, $quStrShow) or die (mysqli_error($dbh));
      if(mysqli_num_rows($StrGetShow)!=0){
?>

<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%"><TR><TD><NOBR><FONT SIZE="-1"><B>SHOW DATE</B></FONT></NOBR></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>LISTING</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>AGENT</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>CLIENT</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>RATING</TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>COMMENTS</B></FONT></TD></TR>


<?php
if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} ?>


<?php
while ($rowshow = mysqli_fetch_object($StrGetShow)) {
?>



<TR bgcolor="<?php echo $rowColor;?>"><TD><NOBR>
<A HREF="<?php echo "$PHP_SELF?op=editshowing&cid=$rowshow->CID&showid=$rowshow->SHOWID";?>"><FONT SIZE="-1"><?php echo $rowshow->SHOWING_DATE;?></FONT></A>
</NOBR></TD>
<TD>&nbsp;</TD>
<TD>


<?php

$quStrclass = "SELECT STREET_NUM, STREET, APT, LANDLORD FROM `CLASS` WHERE `CLI`=\"$grid\" AND `CID`=\"$rowshow->CID\"";
$StrGetclass = mysqli_query($dbh, $quStrclass) or die (mysqli_error());

while ($rowclass = mysqli_fetch_object($StrGetclass)) {
?>
<NOBR><FONT SIZE="-1">
<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowshow->CID&return_page=sel&return_page_rid=$rowshow->CID&return_page_div=$k";?>" target="_show<?php echo $rowshow->CID;?>"><?php echo $rowclass->STREET_NUM;?> <?php echo $rowclass->STREET;?> #<?php echo $rowclass->APT;?></a>
</FONT></NOBR>

<?php } ?>


</TD><TD>&nbsp;</TD>
<TD>

<?php
$quStrhandle = "SELECT HANDLE FROM `USERS` WHERE `GROUP`=\"$grid\" AND `UID`=\"$rowshow->UID\"";
$StrGethandle = mysqli_query($dbh, $quStrhandle) or die (mysqli_error($dbh));

while ($rowhandle = mysqli_fetch_object($StrGethandle)) {
	
	echo $rowhandle->HANDLE;
	}
	
?>


</TD><TD>&nbsp;</TD><TD>
<?php
$quStrcl = "SELECT NAME_FIRST, NAME_LAST FROM `CLIENTS` WHERE `GRID`=\"$grid\" AND `CLID`=\"$rowshow->CLID\"";
$StrGetcl = mysqli_query($dbh, $quStrcl) or die (mysqli_error());

while ($rowcl = mysqli_fetch_object($StrGetcl)) {
	
			      if(mysqli_num_rows($StrGetcl)!=0){
	
?>
<NOBR>
<FONT SIZE="-1">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowshow->CLID\" TITLE=\"Edit/View".$rowcl->NAME_FIRST.$rowcl->NAME_LAST;?>" TARGET="_Client<?php echo $rowcl->CLID;?>"><?php echo $rowcl->NAME_FIRST." ".$rowcl->NAME_LAST; ?></A>
</FONT>
</NOBR>
<?php 
      } else {
echo "<FONT COLOR=\"#FF0000\">No Agent</FONT>";
}
} ?>


</TD><TD>&nbsp;</TD><TD><CENTER>
<FONT SIZE="-1"><?php echo $rowshow->RATING;?></FONT>
</CENTER></TD><TD>&nbsp;</TD><TD><FONT SIZE="-2">
<?php echo $rowshow->SHOWCOMMENT;?></FONT>
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
echo "<CENTER><FONT COLOR=\"#FF0000\">Sorry, there is no showing history for this Landlord</FONT></CENTER><BR>";
} ?>
</TABLE>







</TD></TR></TABLE>


<a href="<?php echo "$PHP_SELF?op=hotlist";?>" TITLE="Dashboard Stats & Shortcuts to Favorite Clients, Listings & more"><FONT SIZE="-1">Go to the Hot List to see all your appointments, reminders, &amp; showing history.</FONT></A><BR>
</td></TR>



</TABLE>


</TD></TR></TABLE>

</font>
</center>
</TD></TR></TABLE>
<!--END editReminders -->