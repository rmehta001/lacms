<!--BEGIN showings -->
<?php
$pref_pagebg = $_SESSION["pref_pagebg"];
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
<b><font size="+2">CLIENT EMAIL HISTORY</font></b>
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
<CENTER><B><FONT SIZE="+1">CLIENT EMAIL HISTORY</FONT></B>
</CENTER>

<?php



$quStrMail = "SELECT * FROM `LISTINGS_MAILEDTO_CLIENTS` WHERE `CLIENTID`=\"$clid\" AND `GRID`=\"$grid\" ORDER BY MAIL_SENT_DATE DESC";

$StrGetMail = mysqli_query($dbh, $quStrMail) or die (mysqli_error($dbh));
      if(mysqli_num_rows($StrGetMail)!=0){
?>

<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%"><TR><TD><NOBR><FONT SIZE="-1"><B>EMAIL DATE</B></FONT></NOBR></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>LISTING # | ADDRESS</B></FONT></TD></TR>


<?php
$pref_row_color = $_SESSION["pref_row_color"];
if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} ?>


<?php
while ($rowshow = mysqli_fetch_object($StrGetMail)) {
?>


<TR bgcolor="<?php echo $rowColor;?>"><TD><NOBR>
<?php echo $rowshow->MAIL_SENT_DATE;?></FONT>
</NOBR></TD>
<TD>

<?php

$quStrclass = "SELECT CID, STREET_NUM, STREET, APT, LANDLORD FROM `CLASS` WHERE `CLI`=\"$grid\" AND `CID`=\"$rowshow->CID\"";
$StrGetclass = mysqli_query($dbh, $quStrclass) or die (mysqli_error());

while ($rowclass = mysqli_fetch_object($StrGetclass)) {
?>
<NOBR><FONT SIZE="-1">
<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowclass->CID\" target=\"_showrowclass->CID\">
$rowclass->CID";?></a></TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><FONT SIZE="-1"><a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowclass->CID\" target=\"_showrowclass->CID\"?>$rowclass->STREET_NUM";?> <?php echo $rowclass->STREET;?> #<?php echo $rowclass->APT;?></a>
</FONT></NOBR>

<?php } ?>


</TD><TD>&nbsp;</TD><TD>&nbsp;
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
echo "<CENTER><FONT COLOR=\"#FF0000\">Sorry, there is no Email History for this client</FONT></CENTER><BR>";
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