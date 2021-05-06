<!--BEGIN showings -->
<?php
if ($_SESSION["pref_pagebg"]=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor=$_SESSION["pref_pagebg"];
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
<b><font size="+2">LISTING SHOWING HISTORY</font></b>
</TD>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/hotlist-pen.jpg" HEIGHT="54" WIDTH="120">
</TD></TR></TABLE>

<HR>
</CENTER><B><a href="<?php echo "$PHP_SELF?op=createshowing&cid=$cid";?>" TITLE="Create A New Showing"><FONT COLOR="GREEN" SIZE="-1">New Showing</FONT></A></B>
<CENTER>


<table width="100%" BORDER="0">
<tr>
<td>
<CENTER>





<CENTER>

<TABLE BORDER="1" BORDERCOLOR="#000000" CELLPADDING="2" BGCOLOR="#FFFFFF" WIDTH="95%"><TR><TD>

<?php
$quStrShow = "SELECT * FROM `SHOWINGS` WHERE `CLI`=\"$grid\" AND `CID`=\"$cid\" ORDER BY SHOWING_DATE DESC";
$StrGetShow = mysqli_query($GLOBALS['dbh'], $quStrShow) or die (mysqli_error());

      if(mysqli_num_rows($StrGetShow)!=0){
		  
?>

<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%"><TR><TD><NOBR><FONT SIZE="-1"><B>SHOW DATE</B></FONT></NOBR></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>LISTING</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>OWNER</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>CLIENT</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>AGENT</TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>RATING</TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>COMMENTS</B></FONT></TD></TR>

<?php
if ($_SESSION["pref_pagebg"]){
$rowColor = $_SESSION["pref_pagebg"];
} else {
$rowColor = "#F5F5DC";
} ?>

<?php 
while ($rowshow = mysqli_fetch_object($StrGetShow)) {
?>

<TR bgcolor="<?php echo $rowColor;?>"><TD><NOBR>
<FONT SIZE="-1">

<a href="<?php echo "$PHP_SELF?op=editshowing&showid=$rowshow->SHOWID";?>" TITLE="Edit Showing Info"><?php echo $rowshow->SHOWING_DATE;?></A></FONT>
</NOBR></TD>
<TD>&nbsp;</TD>
<TD>


<?php
$quStrclass = "SELECT STREET_NUM, STREET, APT FROM `CLASS` WHERE `CLI`=\"$grid\" AND `CID`=\"$rowshow->CID\"";
$StrGetclass = mysqli_query($GLOBALS['dbh'], $quStrclass) or die (mysqli_error());

while ($rowclass = mysqli_fetch_object($StrGetclass)) {
?>
<NOBR><FONT SIZE="-1">
<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowshow->CID&return_page=sel&return_page_rid=$rowshow->CID&return_page_div=".($k??"")."";?>" target="_show<?php echo $rowshow->CID;?>"><?php echo $rowclass->STREET_NUM;?> <?php echo $rowclass->STREET;?> #<?php echo $rowclass->APT;?></a>
</FONT></NOBR>
<?php } ?>


</TD><TD>&nbsp;</TD>
<TD>
<?php
$quStrll = "SELECT * FROM `LANDLORD` WHERE `GRID`=\"$grid\" AND `LID`=\"$rowshow->LID\"";
$StrGetll = mysqli_query($GLOBALS['dbh'], $quStrll) or die (mysqli_error());

while ($rowll = mysqli_fetch_object($StrGetll)) {
	
			      if(mysqli_num_rows($StrGetll)!=0){
	
?>
<NOBR><FONT SIZE="-1"><a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowll->LID";?>" TITLE="Edit/View <?php echo "$rowll->SHORT_NAME";?>'s Info" target="_sll<?php echo $rowll->LID;?>"><?php echo $rowll->SHORT_NAME;?></A></FONT></NOBR>
<?php
      } else {
echo "<CENTER><FONT COLOR=\"#FF0000\">No Landlord</FONT></CENTER><BR>";
}
} ?>



</TD><TD>&nbsp;</TD><TD>
<?php
$quStrcl = "SELECT * FROM `CLIENTS` WHERE `GRID`=\"$grid\" AND `CLID`=\"$rowshow->CLID\"";
$StrGetcl = mysqli_query($GLOBALS['dbh'], $quStrcl) or die (mysqli_error());
while ($rowcl = mysqli_fetch_object($StrGetcl)) {
	
		      if(mysqli_num_rows($StrGetcl)!=0){
?>
<NOBR>
<FONT SIZE="-1">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowcl->CLID\" TITLE=\"Edit/View".$rowcl->NAME_FIRST.$rowcl->NAME_LAST;?>" TARGET="_Client<?php echo $rowcl->CLID;?>"><?php echo $rowcl->NAME_FIRST." ".$rowcl->NAME_LAST; ?></A>
</FONT>
</NOBR>
<?php
      } else {
echo "<FONT SIZE=-1 COLOR=\"#CCCCCC\">No Client</FONT></CENTER><BR>";
}


} ?>





</TD><TD>&nbsp;</TD><TD>
<?php
$quStrag = "SELECT HANDLE, FNAME, LNAME FROM `USERS` WHERE `GROUP`=\"$grid\" AND `UID`=\"$rowshow->UID\"";
$StrGetag = mysqli_query($GLOBALS['dbh'], $quStrag) or die (mysqli_error());
while ($rowag = mysqli_fetch_object($StrGetag)) {
	
	      if(mysqli_num_rows($StrGetag)!=0){
	
	
?>
<NOBR>
<FONT SIZE="-1">
<?php echo $rowag->HANDLE." ".$rowag->LNAME; ?></FONT>
</NOBR>
<?php 
      } else {
echo "<FONT SIZE=-1 COLOR=\"#CCCCCC\">No Agent</FONT></CENTER><BR>";
}
}
 ?>





</TD><TD>&nbsp;</TD><TD><CENTER>
<FONT SIZE="-1"><a href="<?php echo "$PHP_SELF?op=editshowing&showid=$rowshow->SHOWID";?>" TITLE="Edit Showing Info"><?php echo $rowshow->RATING;?></A></FONT>
</CENTER></TD><TD>&nbsp;</TD><TD><FONT SIZE="-2">
<a href="<?php echo "$PHP_SELF?op=editshowing&showid=$rowshow->SHOWID";?>" TITLE="Edit Showing Info"><?php echo $rowshow->SHOWCOMMENT;?></A></FONT>
</TD></TR>

    	<?php
 if ($rowColor=="#F5F5DC" OR $rowColor==$_SESSION["pref_pagebg"]) {
    		$rowColor="#FFFFFF";
    	}else {

if ($_SESSION["pref_pagebg"]){
$rowColor = $_SESSION["pref_pagebg"];
} else {
$rowColor = "#F5F5DC";
} 
    }
    }?>
</TABLE>

<?php 
      } else {
echo "<CENTER><FONT COLOR=\"#FF0000\">Sorry, there is no showing history for this unit</FONT></CENTER><BR>";
} ?>


</TD></TR></TABLE>


<a href="<?php echo "$PHP_SELF?op=hotlist";?>" TITLE="Dashboard Stats & Shortcuts to Favorite Clients, Listings & more"><FONT SIZE="-1">Go to the Hot List to see all your appointments, reminders, &amp; showing history.</FONT></A><BR>
</td></TR></TABLE>


</TD></TR></TABLE>

</font>
</center>
</TD></TR></TABLE>
<!--END editReminders -->