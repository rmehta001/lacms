


<!--BEGIN edit showing -->
<?php
if ($_SESSION["pref_row_color"]=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor=$_SESSION["pref_row_color"];
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
<b><font size="+2">EDIT A SHOWING</font></b>
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

<form action="<?php echo "$PHP_SELF?op=editshowingDo";?>" method="POST">
<INPUT TYPE="HIDDEN" NAME="cid" VALUE="<?php echo $cid;?>">
<INPUT TYPE="HIDDEN" NAME="showid" VALUE="<?php echo $showid;?>">


<?php
$quStrShow = "SELECT * FROM `SHOWINGS` WHERE `CLI`=\"$grid\" AND `SHOWID`=\"$showid\"";
$StrGetShow = mysqli_query($GLOBALS['dbh'], $quStrShow) or die (mysqli_error());


while ($rowShow = mysqli_fetch_object($StrGetShow)) {
?>
<INPUT TYPE="HIDDEN" NAME="lid" VALUE="<?php echo $rowShow->LANDLORD;?>">
<INPUT TYPE="HIDDEN" NAME="cid" VALUE="<?php echo $rowShow->CID;?>">

<?php

$quStrClass = "SELECT * FROM `CLASS` WHERE `CLI`=\"$grid\" AND `CID`=\"$rowShow->CID\"";
$StrGetClass = mysqli_query($GLOBALS['dbh'], $quStrClass) or die (mysqli_error());

while ($rowclass = mysqli_fetch_object($StrGetClass)) {
?>
<INPUT TYPE="HIDDEN" NAME="lid" VALUE="<?php echo $rowclass->LANDLORD;?>">


<NOBR>Showing for: Listing #: <?php echo $rowclass->CID;?> - <?php echo $rowclass->STREET_NUM;?> <?php echo $rowclass->STREET;?> Unit: <?php echo $rowclass->APT;?> by <?php echo $_SESSION["handle"];?></NOBR>





<CENTER>

<TABLE BORDER="1" BORDERCOLOR="#000000" CELLPADDING="2" BGCOLOR="#FFFFFF"><TR><TD>
<TABLE><TR><TD>
<NOBR>Showing on:</NOBR>
</TD><TD><NOBR>
<INPUT TYPE="TEXT" NAME="showing_date" id="showing_date" class="w16em dateformat-Y-ds-m-ds-d" SIZE="10" value="<?php echo $rowShow->SHOWING_DATE;?>"></NOBR>
</TD></TR><TR><TD>
Time: 
</TD><TD>
<select name="show_time" id="show_time">
<option value="00:00:00" <?php if ($rowShow->SHOW_TIME=="00:00:00") {echo "selected";} ?>>12:00am</option>
<option value="00:30:00" <?php if ($rowShow->SHOW_TIME=="00:30:00") {echo "selected";} ?>>12:30am</option>
<option value="01:00:00" <?php if ($rowShow->SHOW_TIME=="01:00:00") {echo "selected";} ?>>1:00am</option>
<option value="01:30:00" <?php if ($rowShow->SHOW_TIME=="01:30:00") {echo "selected";} ?>>1:30am</option>
<option value="02:00:00" <?php if ($rowShow->SHOW_TIME=="02:00:00") {echo "selected";} ?>>2:00am</option>
<option value="02:30:00" <?php if ($rowShow->SHOW_TIME=="02:30:00") {echo "selected";} ?>>2:30am</option>
<option value="03:00:00" <?php if ($rowShow->SHOW_TIME=="03:00:00") {echo "selected";} ?>>3:00am</option>
<option value="03:30:00" <?php if ($rowShow->SHOW_TIME=="03:30:00") {echo "selected";} ?>>3:30am</option>
<option value="04:00:00" <?php if ($rowShow->SHOW_TIME=="04:00:00") {echo "selected";} ?>>4:00am</option>
<option value="04:30:00" <?php if ($rowShow->SHOW_TIME=="04:30:00") {echo "selected";} ?>>4:30am</option>
<option value="05:00:00" <?php if ($rowShow->SHOW_TIME=="05:00:00") {echo "selected";} ?>>5:00am</option>
<option value="05:30:00" <?php if ($rowShow->SHOW_TIME=="05:30:00") {echo "selected";} ?>>5:30am</option>
<option value="06:00:00" <?php if ($rowShow->SHOW_TIME=="06:00:00") {echo "selected";} ?>>6:00am</option>
<option value="06:30:00" <?php if ($rowShow->SHOW_TIME=="06:30:00") {echo "selected";} ?>>6:30am</option>
<option value="07:00:00" <?php if ($rowShow->SHOW_TIME=="07:00:00") {echo "selected";} ?>>7:00am</option>
<option value="07:30:00" <?php if ($rowShow->SHOW_TIME=="07:30:00") {echo "selected";} ?>>7:30am</option>
<option value="08:00:00" <?php if ($rowShow->SHOW_TIME=="08:00:00") {echo "selected";} ?>>8:00am</option>
<option value="08:30:00" <?php if ($rowShow->SHOW_TIME=="08:30:00") {echo "selected";} ?>>8:30am</option>
<option value="08:45:00" <?php if ($rowShow->SHOW_TIME=="08:45:00") {echo "selected";} ?>>8:45am</option>
<option value="09:00:00" <?php if ($rowShow->SHOW_TIME=="09:00:00") {echo "selected";} ?>>9:00am</option>
<option value="09:15:00" <?php if ($rowShow->SHOW_TIME=="09:15:00") {echo "selected";} ?>>9:15am</option>
<option value="09:30:00" <?php if ($rowShow->SHOW_TIME=="09:30:00") {echo "selected";} ?>>9:30am</option>
<option value="09:45:00" <?php if ($rowShow->SHOW_TIME=="09:45:00") {echo "selected";} ?>>9:45am</option>
<option value="10:00:00" <?php if ($rowShow->SHOW_TIME=="10:00:00") {echo "selected";} ?>>10:00am</option>
<option value="10:15:00" <?php if ($rowShow->SHOW_TIME=="10:15:00") {echo "selected";} ?>>10:15am</option>
<option value="10:30:00" <?php if ($rowShow->SHOW_TIME=="10:30:00") {echo "selected";} ?>>10:30am</option>
<option value="10:45:00" <?php if ($rowShow->SHOW_TIME=="10:45:00") {echo "selected";} ?>>10:45am</option>
<option value="11:00:00" <?php if ($rowShow->SHOW_TIME=="11:00:00") {echo "selected";} ?>>11:00am</option>
<option value="11:15:00" <?php if ($rowShow->SHOW_TIME=="11:15:00") {echo "selected";} ?>>11:15am</option>
<option value="11:30:00" <?php if ($rowShow->SHOW_TIME=="11:30:00") {echo "selected";} ?>>11:30am</option>
<option value="11:45:00" <?php if ($rowShow->SHOW_TIME=="11:45:00") {echo "selected";} ?>>11:45am</option>
<option value="12:00:00" <?php if ($rowShow->SHOW_TIME=="12:00:00") {echo "selected";} ?>>12:00pm</option>
<option value="12:15:00" <?php if ($rowShow->SHOW_TIME=="12:15:00") {echo "selected";} ?>>12:15pm</option>
<option value="12:30:00" <?php if ($rowShow->SHOW_TIME=="12:30:00") {echo "selected";} ?>>12:30pm</option>
<option value="12:45:00">12:45pm</option>
<option value="13:00:00" <?php if ($rowShow->SHOW_TIME=="13:00:00") {echo "selected";} ?>>1:00pm</option>
<option value="13:15:00" <?php if ($rowShow->SHOW_TIME=="13:15:00") {echo "selected";} ?>>1:15pm</option>
<option value="13:30:00" <?php if ($rowShow->SHOW_TIME=="13:30:00") {echo "selected";} ?>>1:30pm</option>
<option value="13:45:00" <?php if ($rowShow->SHOW_TIME=="13:45:00") {echo "selected";} ?>>1:45pm</option>
<option value="14:00:00" <?php if ($rowShow->SHOW_TIME=="14:00:00") {echo "selected";} ?>>2:00pm</option>
<option value="14:15:00" <?php if ($rowShow->SHOW_TIME=="14:15:00") {echo "selected";} ?>>2:15pm</option>
<option value="14:30:00" <?php if ($rowShow->SHOW_TIME=="14:30:00") {echo "selected";} ?>>2:30pm</option>
<option value="14:45:00" <?php if ($rowShow->SHOW_TIME=="14:45:00") {echo "selected";} ?>>2:45pm</option>
<option value="15:00:00" <?php if ($rowShow->SHOW_TIME=="15:00:00") {echo "selected";} ?>>3:00pm</option>
<option value="15:15:00" <?php if ($rowShow->SHOW_TIME=="15:15:00") {echo "selected";} ?>>3:15pm</option>
<option value="15:30:00" <?php if ($rowShow->SHOW_TIME=="15:30:00") {echo "selected";} ?>>3:30pm</option>
<option value="15:45:00" <?php if ($rowShow->SHOW_TIME=="15:45:00") {echo "selected";} ?>>3:45pm</option>
<option value="16:00:00" <?php if ($rowShow->SHOW_TIME=="16:00:00") {echo "selected";} ?>>4:00pm</option>
<option value="16:15:00" <?php if ($rowShow->SHOW_TIME=="16:15:00") {echo "selected";} ?>>4:15pm</option>
<option value="16:30:00" <?php if ($rowShow->SHOW_TIME=="16:30:00") {echo "selected";} ?>>4:30pm</option>
<option value="16:45:00" <?php if ($rowShow->SHOW_TIME=="16:45:00") {echo "selected";} ?>>4:45pm</option>
<option value="17:00:00" <?php if ($rowShow->SHOW_TIME=="17:00:00") {echo "selected";} ?>>5:00pm</option>
<option value="17:15:00" <?php if ($rowShow->SHOW_TIME=="17:15:00") {echo "selected";} ?>>5:15pm</option>
<option value="17:30:00" <?php if ($rowShow->SHOW_TIME=="17:30:00") {echo "selected";} ?>>5:30pm</option>
<option value="17:45:00" <?php if ($rowShow->SHOW_TIME=="17:45:00") {echo "selected";} ?>>5:45pm</option>
<option value="18:00:00" <?php if ($rowShow->SHOW_TIME=="18:00:00") {echo "selected";} ?>>6:00pm</option>
<option value="18:15:00" <?php if ($rowShow->SHOW_TIME=="18:15:00") {echo "selected";} ?>>6:15pm</option>
<option value="18:30:00" <?php if ($rowShow->SHOW_TIME=="18:30:00") {echo "selected";} ?>>6:30pm</option>
<option value="18:45:00" <?php if ($rowShow->SHOW_TIME=="18:45:00") {echo "selected";} ?>>6:45pm</option>
<option value="19:00:00" <?php if ($rowShow->SHOW_TIME=="19:00:00") {echo "selected";} ?>>7:00pm</option>
<option value="19:15:00" <?php if ($rowShow->SHOW_TIME=="19:15:00") {echo "selected";} ?>>7:15pm</option>
<option value="19:30:00" <?php if ($rowShow->SHOW_TIME=="19:30:00") {echo "selected";} ?>>7:30pm</option>
<option value="19:45:00" <?php if ($rowShow->SHOW_TIME=="19:45:00") {echo "selected";} ?>>7:45pm</option>
<option value="20:00:00" <?php if ($rowShow->SHOW_TIME=="20:00:00") {echo "selected";} ?>>8:00pm</option>
<option value="20:30:00" <?php if ($rowShow->SHOW_TIME=="20:30:00") {echo "selected";} ?>>8:30pm</option>
<option value="21:00:00" <?php if ($rowShow->SHOW_TIME=="21:00:00") {echo "selected";} ?>>9:00pm</option>
<option value="21:30:00" <?php if ($rowShow->SHOW_TIME=="21:30:00") {echo "selected";} ?>>9:30pm</option>
<option value="22:00:00" <?php if ($rowShow->SHOW_TIME=="22:00:00") {echo "selected";} ?>>10:00pm</option>
<option value="22:30:00" <?php if ($rowShow->SHOW_TIME=="22:30:00") {echo "selected";} ?>>10:30pm</option>
<option value="23:00:00" <?php if ($rowShow->SHOW_TIME=="23:00:00") {echo "selected";} ?>>11:00pm</option>
<option value="23:30:00" <?php if ($rowShow->SHOW_TIME=="23:30:00") {echo "selected";} ?>>11:30pm</option>
</select>
</TD><TD></TR><TR><TD>
<NOBR>Client:</NOBR> 


</TD><TD>
<select name="clid" id="clid">

<?php
$quStrClients = "SELECT * FROM `CLIENTS` WHERE `GRID`=\"$grid\" AND `UID`=\"$uid\" ORDER BY `NAME_LAST` ASC";
$StrGetClients = mysqli_query($GLOBALS['dbh'], $quStrClients) or die (mysqli_error());

while ($rowclients = mysqli_fetch_object($StrGetClients)) {
?>

<option value="<?php echo $rowclients->CLID;?>" <?php if ($rowShow->CLID==$rowclients->CLID) {echo "selected";} ?>><?php echo $rowclients->NAME_FIRST;?> <?php echo $rowclients->NAME_LAST;?></option>

    <?php } ?>

</select>
</TD>

<TD ROWSPAN="3">
<NOBR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Save The Showing" STYLE="Background-Color : #adffad"></NOBR>
</TD>
</TR>
<TR><TD>
Rating (1-10): 
</TD><TD>
<select name="rating" id="rating">
<option value="99" <?php if ($rowShow->RATING=="99") {echo "selected";} ?>>Not Rated</option>
<option value="1" <?php if ($rowShow->RATING=="1") {echo "selected";} ?>>1</option>
<option value="2" <?php if ($rowShow->RATING=="2") {echo "selected";} ?>>2</option>
<option value="3" <?php if ($rowShow->RATING=="3") {echo "selected";} ?>>3</option>
<option value="4" <?php if ($rowShow->RATING=="4") {echo "selected";} ?>>4</option>
<option value="5" <?php if ($rowShow->RATING=="5") {echo "selected";} ?>>5</option>
<option value="6" <?php if ($rowShow->RATING=="6") {echo "selected";} ?>>6</option>
<option value="7" <?php if ($rowShow->RATING=="7") {echo "selected";} ?>>7</option>
<option value="8" <?php if ($rowShow->RATING=="8") {echo "selected";} ?>>8</option>
<option value="9" <?php if ($rowShow->RATING=="9") {echo "selected";} ?>>9</option>
<option value="10" <?php if ($rowShow->RATING=="10") {echo "selected";} ?>>10</option>
</select>

</TD></TR></TABLE>

<TABLE  BGCOLOR="#FFFFFF"><TR>
			<td height="40"><div class="controltext"><NOBR>Showing Comments:</NOBR></div><textarea name="showcomment" rows="5" cols="75"><?php echo $rowShow->SHOWCOMMENT; ?></textarea>
			<BR><BR>
			
			</td>
			</tr></table>
</TD></TR></TABLE>

    <?php }} ?>

</form>

<a href="<?php echo "$PHP_SELF?op=hotlist";?>" TITLE="Dashboard Stats & Shortcuts to Favorite Clients, Listings & more"><FONT SIZE="-1">Go to the Hot List to see all your appointments, reminders, &amp; showing history.</FONT></A><BR>
</td></TR></TABLE>


</TD></TR></TABLE>

</font>
</center>
</TD></TR></TABLE>
<!--END edit showing -->