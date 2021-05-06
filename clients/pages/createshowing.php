<!--BEGIN create showing -->
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
<b><font size="+2">CREATE A SHOWING</font></b>
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

<form action="<?php echo "$PHP_SELF?op=createshowingDo";?>" method="POST">
<INPUT TYPE="HIDDEN" NAME="cid" VALUE="<?php echo $cid;?>">


<?php
$quStrClass = "SELECT * FROM `CLASS` WHERE `CLI`=\"$grid\" AND `CID`=\"$cid\"";
$StrGetClass = mysqli_query($GLOBALS['dbh'], $quStrClass) or die (mysqli_error());

while ($rowclass = mysqli_fetch_object($StrGetClass)) {
?>
<INPUT TYPE="HIDDEN" NAME="lid" VALUE="<?php echo $rowclass->LANDLORD;?>">


<NOBR>Showing for: Listing #: <?php echo $cid;?> - <B><?php echo $rowclass->STREET_NUM;?> <?php echo $rowclass->STREET;?> Unit: <?php echo $rowclass->APT;?></B> by <?php echo $_SESSION["handle"];?></NOBR>

    <?php } ?>




<CENTER>

<TABLE BORDER="1" BORDERCOLOR="#000000" CELLPADDING="2" BGCOLOR="#FFFFFF"><TR><TD>
<TABLE><TR><TD>
<NOBR>Showing on:</NOBR>
</TD><TD><NOBR>
<INPUT TYPE="TEXT" NAME="showing_date" id="showing_date" class="w16em dateformat-Y-ds-m-ds-d" SIZE="10"></NOBR>
</TD></TR><TR><TD>
Time: 
</TD><TD>
<select name="show_time" id="show_time">
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
<NOBR>Client:</NOBR> 


</TD><TD>
<select name="clid" id="clid">

<?php
$quStrClients = "SELECT * FROM `CLIENTS` WHERE `GRID`=\"$grid\" AND `UID`=\"$uid\" ORDER BY `NAME_LAST` ASC";
$StrGetClients = mysqli_query($GLOBALS['dbh'], $quStrClients) or die (mysqli_error());

while ($rowclients = mysqli_fetch_object($StrGetClients)) {
?>

<option value="<?php echo $rowclients->CLID;?>"><?php echo $rowclients->NAME_FIRST;?> <?php echo $rowclients->NAME_LAST;?></option>

    <?php } ?>

</select>
</TD>

<TD ROWSPAN="3">
<NOBR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Create The Showing" STYLE="Background-Color : #adffad"></NOBR>
</TD>
</TR>
<TR><TD>
Rating (1-10): 
</TD><TD>
<select name="rating" id="rating">
<option value="99">Not Rated</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
</select>

</TD></TR></TABLE>

<TABLE  BGCOLOR="#FFFFFF"><TR>
			<td height="40"><div class="controltext"><NOBR>Showing Comments:</NOBR></div><textarea name="showcomment" rows="5" cols="75"></textarea>
			<BR><BR>
			
			</td>
			</tr></table>
</TD></TR></TABLE>
	</form>

<a href="<?php echo "$PHP_SELF?op=hotlist";?>" TITLE="Dashboard Stats & Shortcuts to Favorite Clients, Listings & more"><FONT SIZE="-1">Go to the Hot List to see all your appointments, reminders, &amp; showing history.</FONT></A><BR>
</td></TR></TABLE>

<?php
$rowclass = "";
$quStrClass2 = "SELECT * FROM `CLASS` WHERE `CLI`=\"$grid\" AND `CID`=\"$cid\"";
$StrGetClass2 = mysqli_query($GLOBALS['dbh'], $quStrClass) or die (mysqli_error());

while ($rowclass = mysqli_fetch_object($StrGetClass2)) {?>



<?php
$quStrll = "SELECT * FROM `LANDLORD` WHERE `GRID`=\"$grid\" AND `LID`=\"$rowclass->LANDLORD\"";
$StrGetll = mysqli_query($GLOBALS['dbh'], $quStrll) or die (mysqli_error());

while ($rowll = mysqli_fetch_object($StrGetll)) {?>



<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD style="font-size:10px;margin:5px;padding:10px;" VALIGN="TOP"> 


<?php if ($rowclass->CLI=="$grid") { ?>



<?php if ($rowclass->LANDLORD) {?>


<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD VALIGN="TOP">

<?php

if ($rowll->LAST_CONTACT_ACTION == "1") { $LCA="- Contact/Updated" ;}
if ($rowll->LAST_CONTACT_ACTION == "2") { $LCA="- Left Message" ;}
if ($rowll->LAST_CONTACT_ACTION == "3") { $LCA="- No Answer" ;}
if ($rowll->LAST_CONTACT_ACTION == "4") { $LCA="- Call later" ;}
if ($rowll->LAST_CONTACT_ACTION == "5") { $LCA="- Emailed" ;}
if ($rowll->LAST_CONTACT_ACTION == "6") { $LCA="- Landlord Feed" ;}
if ($rowll->LAST_CONTACT_ACTION == "7") { $LCA="- Don't Contact" ;}
if ($rowll->LAST_CONTACT_ACTION == "8") { $LCA="- Other" ;}

		$emailString = ($rowll->LL_EMAIL) ? "<a href=\"mailto:$rowll->LL_EMAIL\">$rowll->LL_EMAIL</a><br>" : "";



		
		$string .= "<a href=$PHP_SELF?op=editLandlord&lid=$rowll->LID>$rowll->HOME_NAME_FIRST $rowll->HOME_NAME_LAST, $rowll->OFF_NAME</A><br>";
		$string .= $emailString;

if ($rowll->MOBILE_PHONE) {
		$string .= "Mobile Phone: $rowll->MOBILE_PHONE <br>";
		}

if (($rowll->OFF_PHONE) OR ($rowll->OFF_FAX !="")) {
		$string .= "Office Phone: $rowll->OFF_PHONE    Fax: $rowll->OFF_FAX<br>";
		}

if (($rowll->HOME_PHONE) OR ($rowll->HOME_FAX !="")) {
		$string .= "Home Phone: $rowll->HOME_PHONE  Fax: $rowll->HOME_FAX <br>";
}

if (($rowll->HOME_SPOUSE_FIRST !="") OR ($rowll->HOME_SPOUSE_LAST !="")) {
		$string .= "Spouse:  $rowll->HOME_SPOUSE_FIRST $rowll->HOME_SPOUSE_LAST<br>";
}

if (($rowll->SPOUSE_CELL !="") OR ($rowll->SPOUSE_OFFICE !="")) {
		$string .= "Spouse Cell: $rowll->SPOUSE_CELL Spouse Office: $rowll->SPOUSE_OFFICE<br>";
}

if ($rowll->SPOUSE_EMAIL !="") {
		$string .= "Spouse Email: <A HREF=\"mailto:$rowll->SPOUSE_EMAIL\">$rowll->SPOUSE_EMAIL</A><br>";
}


if (($rowll->SUPER_NAME) OR ($rowll->SUPER_PHONE !="")) {
		$string .= "Super: $rowll->SUPER_NAME";
		$string .= " - $rowll->SUPER_PHONE<BR>";
			}

$string .= "Last LL: $rowll->LAST_CONTACTED Next LL: $rowll->NEXT_CONTACT $LCA<BR>";

if ($rowll->OFF_WEBSITE !="") {
		$string .= "<A HREF=\"$rowll->OFF_WEBLISTINGS\" target=\"_NEW\">Web Listings</A>";
}

if ($rowll->OFF_WEBSITE !="" AND $rowll->OFF_WEBLISTINGS !="") {
		$string .= " | "; }

if ($rowll->OFF_WEBLISTINGS !="") { 
		$string .= "<A HREF=\"$rowll->OFF_WEBSITE\" target=\"_NEW\">Website</A>"; }

if ($rowll->OFF_WEBSITE !="" OR $rowll->OFF_WEBLISTINGS !="") {
		$string .= " | "; }

$string .= "<A HREF=\"$PHP_SELF?op=addendums&lid=$rowll->LID\" target=\"_newaddenda\">Additional Addenda & Docs</a><BR>";


echo "<font size=1>";
echo $string;
echo "</font>";
?>

<TD><IMG SRC="https://www.BostonApartments.com/spacer.gif" HEIGHT="1" WIDTH="25" BORDER="0"></TD>



</TD><TD VALIGN="TOP">
<CENTER>
<TABLE border=0><TR><TD VALIGN="TOP"><CENTER>
	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none&vid=7&availFilter=n&sortD=ASC&sort=STREET,%20STREET_NUM,%20APT";?>" method="POST" target="_NEW">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="landlord" value="<?php echo $rowclass->LANDLORD;?>">
<!--	<input type="submit" value="All Listings For This Landlord" STYLE="Background-Color : #CCFFFF;"> -->

<button class="button-blue pure-button">All Listings For <?php echo $rowll->SHORT_NAME;?></button>

	</form>
<TABLE><TR><TD VALIGN="TOP">
<CENTER>
<?php

	echo "<A HREF=$PHP_SELF?op=buildings&lid=$rowclass->LANDLORD&llname=$rowll->SHORT_NAME target=\"_NEW\"><IMG src=../assets/images/buildings.jpg BORDER=0><BR><FONT SIZE=1px>Buildings</FONT></A>";

; ?>
</CENTER>
</TD><TD>&nbsp;&nbsp;
</TD><TD VALIGN="TOP">
<CENTER>

<?php
	echo "<NOBR><A HREF=$PHP_SELF?op=global-Landlord&lid=".($rowGetLandlord->LID??"")."&llname=".($rowGetLandlord->SHORT_NAME??"").">".($num_Units??"")."<IMG src=../assets/images/global.jpeg BORDER=0 TITLE=\"Edit ALL ".($rowGetLandlord->SHORT_NAME??"")."'s Units Globally\"></A></NOBR><BR>
	<FONT SIZE=1px>Global</font>";
 ?>

 </TD></TR></TABLE>
<font size=1>
<A HREF="<?php echo "$PHP_SELF?op=llcomments&llid=$rowclass->LANDLORD";?>" TITLE="View Landlord Comments" target="_newvlc">View Landlord Comments</A><br><A HREF="<?php echo "$PHP_SELF?op=createllcomments&llid=$rowclass->LANDLORD";?>" TITLE="Add Landlord Comment" target="_newclc">Create Landlord Comment</A><BR><A HREF="<?php echo "$PHP_SELF?op=showingsLandlord&llid=$rowclass->LANDLORD";?>" TITLE="View Landlord Showing History" target="_newlsh">View Landlord Showing History</A><BR>

<?php if (($rowclass->CLI==$grid) AND ($rowclass->SHOW_INSTRUCT!="")) { echo "<BR>Showing Instructions: ".$rowclass->SHOW_INSTRUCT;
if ($rowclass->TENANT_NAME) { echo "<BR>Tenant: ".$rowclass->TENANT_NAME; }
if ($rowclass->TENANT_PHONE) { echo "<BR>Tenant #: ".$rowclass->TENANT_PHONE; }


}  ?>



<?php } ?>

<?php } elseif (($rowclass->CLI=="1075") AND ($rowclass->SHOW_INSTRUCT!="")) {  ?>
	

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD VALIGN="TOP">
<div class="ad" align="left">
<?php echo "<BR>Showing Instructions: ".$rowclass->SHOW_INSTRUCT; ?>
<BR><IMG SRC="../assets/images/spacer.gif" WIDTH="270" HEIGHT="1">
</font></TD></TR></TABLE>


<?php } else {?>

 <IMG SRC="../assets/images/spacer.gif" WIDTH="270" HEIGHT="1">
	<?php } }}?>
</div>


</CENTER>

</TD></TR></TABLE>

</TD></TR></TABLE>









</TD></TR></TABLE>

</font>
</center>
</TD></TR></TABLE>

	
	
<!--END create showing -->