<!--BEGIN agentreport -->

<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
?>
	<br>

	<table border="0" cellspacing="0" cellpadding="0" width="80%" BGCOLOR="<?php echo $pagebgcolor;?>">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">
		<table>
			<tr>
			<td height="30" width="500">

<?php if ($showback != "no") { ?>

<FONT SIZE="-1"><B><a href="<?php echo "$PHP_SELF?op=manageUsers";?>"><FONT COLOR="GREEN">Back to Manage Agents</FONT></A></B></FONT><FONT SIZE="-3"><BR></FONT>

<?php } ?>

			<CENTER>





<B>AGENT <?php if ($showback == "no") { echo " ACTIVITY "; } ?> REPORT</B><BR>

<NOBR>Username: <?php echo $rowGetUser->HANDLE;?> - Agent ID# <?php echo $rowGetUser->UID;?></NOBR><BR>

<TABLE BORDER="0"><TR><TD><NOBR>
<FONT SIZE="-2">
<?php 
$result_agentactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE STATUS='ACT' AND `CLI`='".$grid."' AND `UID`='".$rowGetUser->UID."'");
$num_agentactive_ads = mysqli_num_rows($result_agentactive);

echo "Total # of Active Ads <img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/act.gif'>: </FONT> &nbsp; <FONT SIZE='-2'>". $num_agentactive_ads . "</FONT> &nbsp; <FONT SIZE='-2'>";

$result_agentinactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE STATUS='STO' AND `CLI`='".$grid."' AND `UID`='".$rowGetUser->UID."'");
$num_agentinactive_ads = mysqli_num_rows($result_agentinactive);

echo "Total # of Inactive Ads <img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.gif'>: </FONT> &nbsp; <FONT SIZE='-2'>". $num_agentinactive_ads . "</FONT></NOBR></TD></TR></TABLE>";
?>


<TABLE BORDER="0"><TR><TD><NOBR><FONT SIZE="-2">
<?php

$result_agent30oldactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE (STATUS='ACT' AND ((`MOD` < DATE_SUB(CURDATE() ,INTERVAL 30 DAY)) AND `UID`=".$rowGetUser->UID." AND `CLI`='".$grid."'))");
$num_agent30oldactive_ads = mysqli_num_rows($result_agent30oldactive);

echo "<NOBR>Total # of Active Ads <img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/act.gif'> over 30 days: </FONT></NOBR></TD><TD><NOBR><FONT SIZE='-2'>". $num_agent30oldactive_ads . "</FONT></NOBR></TD><TD><NOBR><FONT SIZE=-2>";

$result_agent60oldactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE (STATUS='ACT' AND ((`MOD` < DATE_SUB(CURDATE() ,INTERVAL 60 DAY)) AND `UID`=".$rowGetUser->UID." AND `CLI`='".$grid."'))");
$num_agent60oldactive_ads = mysqli_num_rows($result_agent60oldactive);

echo " | 60 days: </FONT></NOBR></TD><TD><NOBR><FONT SIZE='-2'>". $num_agent60oldactive_ads ."</FONT></NOBR></TD><TD><NOBR><FONT SIZE=-2>";

$result_agent90oldactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE (STATUS='ACT' AND ((`MOD` < DATE_SUB(CURDATE() ,INTERVAL 90 DAY)) AND `UID`=".$rowGetUser->UID." AND `CLI`='".$grid."'))");
$num_agent90oldactive_ads = mysqli_num_rows($result_agent90oldactive);

echo " | 90 days: </FONT></NOBR></TD><TD><FONT SIZE='-2'>". $num_agent90oldactive_ads ."</FONT></TD></TABLE>";

?>

<BR>

<TABLE BGCOLOR="#FFFFFF" BORDER="1" BORDERCOLOR="#000000" CELLPADDING="0" CELLSPACING="0"><TR><TD>
<TABLE CELLPADDING="2" CELLSPACING="0" BORDER="0"><TR><TD><NOBR><FONT SIZE="-1">Click the # of days old to Deactivate <img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.gif' TITLE='Deactivate'>, Mark Unavailable <img src="../assets/images/icons/u.jpg" border=0 HEIGHT="10" WIDTH="10" alt="Unavailable Listing" title="Unavailable Listing">,</NOBR><BR><NOBR>&amp; Mark Occupied <img src="../assets/images/icons/occupied.jpg" border=0 height=10 width=10 alt="Occupied Unit" title="Occupied Unit"> ALL LISTINGS advertised by <?php echo $rowGetUser->HANDLE;?></FONT>
</NOBR></TD><TD>&nbsp;</TD><TD><NOBR>&nbsp;
<A HREF="<?php echo "$PHP_SELF?op=30daysdeactivateagent&deactuser=".$rowGetUser->UID;?>"><FONT COLOR="#FF0000">30</FONT></A></B>
&nbsp;&nbsp;<A HREF="<?php echo "$PHP_SELF?op=30daysdeactivateagent&deactuser=".$rowGetUser->UID;?>"><FONT COLOR="#FF0000">60</FONT></A></B>
&nbsp;&nbsp; <A HREF="<?php echo "$PHP_SELF?op=30daysdeactivateagent&deactuser=".$rowGetUser->UID;?>"><FONT COLOR="#FF0000">90</FONT></A></B>
</NOBR></TD></TR></TABLE>
</TD></TR></TABLE>
<BR>




<?php
$quStrGetLLogin = "SELECT * FROM `SESSIONS` WHERE `UID`=$rowGetUser->UID ORDER BY `TIMEIN` DESC LIMIT 0,30";
	$quGetLLogin = mysqli_query($dbh, $quStrGetLLogin) or die ($quStrGetLLogin);
	$rowGetLLogin=mysqli_fetch_object($quGetLLogin);
?>

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="1" BGCOLOR="#FFFFFF" WIDTH="100%"><TR><TD>
<TABLE WIDTH="99%" BGCOLOR="#FFFFFF"><TR><TD VALIGN="TOP" WIDTH="46%">




<FONT SIZE="-2"><NOBR><SPAN style="font-size:12px;"><B>Last 25 Listings Modified by <?php echo $rowGetUser->HANDLE;?>:</SPAN></B></NOBR><BR><BR>

<?php

$quStrGetLAList = "SELECT * FROM `CLASS` LEFT JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE `MODBY`=\"$rowGetUser->HANDLE\" AND `CLI`=$grid ORDER BY `MOD` DESC LIMIT 0,25";
	$quGetLAList = mysqli_query($dbh, $quStrGetLAList) or die ($quStrGetLAList);
	$rowGetLAList=mysqli_fetch_object($quGetLAList);

@	mysqli_data_seek ($quGetLAList, 0);

echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0'>";

while($rowGetLAList=mysqli_fetch_object($quGetLAList)) {

$rowGetLAList->LOCNAME = str_replace("BOSTON - ", "", $rowGetLAList->LOCNAME);

echo  "<TR><TD VALIGN='TOP'><NOBR><FONT SIZE='-2'><A HREF=\"$PHP_SELF?op=adlEdit&cid=".$rowGetLAList->CID."\" target=\"edit$rowGetLAList->CID\"><img border=0 src='../images/icons/edit.gif' alt='edit' HEIGHT='10'><B>".$rowGetLAList->STREET_NUM." ".$rowGetLAList->STREET." ".$rowGetLAList->APT."</B> - ".$rowGetLAList->LOCNAME."</A></FONT></NOBR></TD><TD VALIGN='TOP'><NOBR><FONT SIZE='-2'>&nbsp;" ;

if ($rowGetLAList->STATUS=="ACT") { 
echo "<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/act.gif'>";
} else {
echo "<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.jpg'>";
} ?>


<?php if($rowGetLAList->STATUS_ACTIVE =="1")  { ?>

<img src="../assets/images/icons/a.jpg" border=0 height=10 width=10 vspace='2' hspace='0'>

			    <?php  } else { ?>
<img src="../assets/images/icons/u.jpg" border=0 height=10 width=10 vspace='2' hspace='0'>
			<?php }
			

echo " | ".$rowGetLAList->MOD."</FONT></NOBR></TD></TR>";
}

?>
</TABLE>


</TD>
<TD  WIDTH="5%">&nbsp;</TD>
<TD VALIGN="TOP" WIDTH="30%">
<NOBR><SPAN style="font-size:12px;"><B>Last 25 Listings Created by <?php echo $rowGetUser->HANDLE;?>:</B></SPAN></NOBR><BR><BR>
<?php 
$quStrGetLBList = "SELECT * FROM `CLASS`  LEFT JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE `UID`=\"$rowGetUser->UID\" AND `CLI`=$grid ORDER BY `DATEIN` DESC LIMIT 0,25";
	$quGetLBList = mysqli_query($dbh, $quStrGetLBList) or die ($quStrGetLBList);
	$rowGetLBList=mysqli_fetch_object($quGetLBList);


echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0'>";

@	mysqli_data_seek ($quGetLBList, 0);
while($rowGetLBList=mysqli_fetch_object($quGetLBList)) {

$rowGetLBList->LOCNAME = str_replace("BOSTON - ", "", $rowGetLBList->LOCNAME);

echo  "<TR><TD VALIGN='TOP'><NOBR><FONT SIZE='-2'><A HREF=\"$PHP_SELF?op=adlEdit&cid=".$rowGetLBList->CID."\" target=\"edit$rowGetLBList->CID\"><img border=0 src='../images/icons/edit.gif' alt='edit' HEIGHT='10'><B>".$rowGetLBList->STREET_NUM." ".$rowGetLBList->STREET." ".$rowGetLBList->APT."</B> - ".$rowGetLBList->LOCNAME."</FONT></A></NOBR></TD><TD VALIGN='TOP'><NOBR><FONT SIZE='-2'>&nbsp;" ;


if ($rowGetLBList->STATUS=="ACT") { 
echo "<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/act.gif'>";
} else {
echo "<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.jpg'>";
} ?>


<?php if($rowGetLBList->STATUS_ACTIVE =="1")  { ?>

<img src="../assets/images/icons/a.jpg" border=0 height=10 width=10 vspace='2' hspace='0'>

			    <?php  } else { ?>
<img src="../assets/images/icons/u.jpg" border=0 height=10 width=10 vspace='2' hspace='0'>
			<?php }
			

echo " | ".$rowGetLBList->MOD."</FONT></NOBR></TD></TR>";
}
?>
</TABLE>


</TD></TR></TABLE>
</TD></TR></TABLE>


<BR>

<TABLE BORDER="0"><TR><TD>

	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="user" value="<?php echo $euid;?>">
	<input type="submit" value="View ALL Listings CREATED by <?php echo $rowGetUser->HANDLE;?>" STYLE="Background-Color : #E0FFFF">
	</form>
</TD><TD>&nbsp;</TD><TD>

	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="modby" value="<?php echo $rowGetUser->HANDLE;?>">
	<input type="submit" value="View ALL Listings LAST MODIFIED by <?php echo $rowGetUser->HANDLE;?>" STYLE="Background-Color : #E0FFFF">
	</form>
</TD></TR></TABLE>



</td>
		</tr>
		
		<TR><TD>

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="1" BGCOLOR="#FFFFFF"><TR><TD>
<TABLE><TR><TD>
<SPAN style="font-size:12px;"><B>Last 100 Ads posted to Craigslist by <?php echo $rowGetUser->HANDLE ;?>:</B></SPAN>
<BR>

<div class="toplist">


<?php 

$quStrGetCLList = "SELECT * FROM ((POSTTO LEFT JOIN CLASS ON POSTTO.CID = CLASS.CID) INNER JOIN LOC ON CLASS.LOC = LOC.LOCID) WHERE POSTTO.CLI ='$grid' AND POSTTO.UID=\"$rowGetUser->UID\" AND `POSTWHERE`='Craigslist' ORDER BY `POSTDATE` DESC LIMIT 0,100";
	$quGetCLList = mysqli_query($dbh, $quStrGetCLList) or die ($quStrGetCLList);
	$rowGetCLList=mysqli_fetch_object($quGetCLList);


echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0'>";

@	mysqli_data_seek ($quGetCLList, 0);
while($rowGetCLList=mysqli_fetch_object($quGetCLList)) {

echo  "<TR><TD VALIGN='TOP'><NOBR><FONT SIZE='-2'><A HREF=\"$PHP_SELF?op=adlEdit&cid=".$rowGetCLList->CID."\" target=\"edit$rowGetCLList->CID\"><img border=0 src='../images/icons/edit.gif' alt='edit' HEIGHT='10'><B>".$rowGetCLList->STREET_NUM." ".$rowGetCLList->STREET." ".$rowGetCLList->APT." </B> - ".$rowGetCLList->LOCNAME."</A></FONT></NOBR></TD><TD VALIGN='TOP'><NOBR><FONT SIZE='-2'>&nbsp;" ;


if ($rowGetCLList->STATUS=="ACT") { 
echo "<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/act.gif'>";
} else {
echo "<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.jpg'>";
} ?>


<?php if($rowGetCLList->STATUS_ACTIVE =="1")  { ?>

<img src="../assets/images/icons/a.jpg" border=0 height=10 width=10 vspace='2' hspace='0'>

			    <?php  } else { ?>
<img src="../assets/images/icons/u.jpg" border=0 height=10 width=10 vspace='2' hspace='0'>
			<?php }
			


echo  " | ". substr ($rowGetCLList->POSTDATE, 0, 10) ." at ". substr ($rowGetCLList->POSTDATE, 11, 8) ."</FONT></NOBR></TD></TR>" ;

}
?>
</TABLE>
</div>


</TD>
<TD>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</TD>
<TD>

<FONT SIZE="-2"><B>Last 30 Logins by <?php echo $rowGetUser->HANDLE;?>:</B><BR><BR>

<DIV CLASS="lastloginagent">
<?php
@	mysqli_data_seek ($quGetLLogin, 0);

while($rowGetLLogin=mysqli_fetch_object($quGetLLogin)) {


echo  "<NOBR>". substr ($rowGetLLogin->TIMEIN, 0, 10) ." at ". substr ($rowGetLLogin->TIMEIN, 11, 8) ."</NOBR><BR>" ;

}

?>
</FONT>
</DIV>

</TD></TR></TABLE>

</TD></TR></TABLE>

		</TD>		
</TR>		

<TR>
		<TD>




<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="1" BGCOLOR="#FFFFFF" WIDTH="100%"><TR><TD>

<SPAN style="font-size:12px;"><B>Listings/Ads Marked Pending <img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="12" WIDTH="12" alt="Pending Status - Yes" title="Pending Status = YES - Check Status"> by <?php echo $rowGetUser->HANDLE ;?>:</B></SPAN>

<TABLE BORDER="0" WIDTH="700">
<?php 

	$quStrGetListing = "select * from ((CLASS INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) where CLI='$grid' and STATUS_PENDING!='0' AND MODBY=\"$rowGetUser->HANDLE\"";
	$quGetListing = mysqli_query($dbh, $quStrGetListing) or die (mysqli_error($dbh));
	
@	mysqli_data_seek ($quStrGetListing, 0);	
	while ($rowGetListing = mysqli_fetch_object($quGetListing)) {?>
	
<TR>
<TD WIDTH="700" style="font-size:10px;">

<?php if($rowGetListing->STATUS_PENDING=="1")
			   { ?>
<img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="12" WIDTH="12" alt="Pending Status - Yes" TITLE="Pending Status Yes - Click to change Pending Status">
<?php  }  ?>


<?php if ($rowGetListing->STATUS=="ACT") { 
echo "<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/act.gif'>";
} else {
echo "<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/inact.jpg'>";
} ?>


<?php if($rowGetListing->STATUS_ACTIVE =="1")  { ?>

<img src="../assets/images/icons/a.jpg" border="0" height="12" width="12">

			    <?php  } else { ?>
<img src="../assets/images/icons/u.jpg" border="0" height="12" width="12">
			<?php } ?>


	<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetListing->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit" HEIGHT="12"><?php echo $rowGetListing->TYPENAME;?> - <?php echo $rowGetListing->LOCNAME;?> - $<?php echo $rowGetListing->PRICE;?> <?php echo $rowGetListing->STREETNUM;?> <?php echo $rowGetListing->STREET;?> #<?php echo $rowGetListing->APT;?> - Listing #<?php echo $rowGetListing->CID;?> - mod: <?php echo $rowGetListing->MODBY;?> on <?php echo $rowGetListing->MOD;?></a>


<?php }?>
</DIV>
<BR>
</td>
</tr>
</table>
</TD></TR></TABLE>


		</TD>
		</TR>


<TR><TD>

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="1" BGCOLOR="#FFFFFF" WIDTH="100%"><TR><TD>

<SPAN style="font-size:12px;"><B>Active Clients:</B></SPAN><BR>
<FONT SIZE="-2">
<?php 


$quStrGetCList = "SELECT * FROM `CLIENTS` WHERE `UID`='$rowGetUser->UID' AND `GRID`='$grid' AND STATUS_CLIENT='1' ORDER BY `NAME_LAST`, `NAME_FIRST` ASC";			$quGetCList = mysqli_query($dbh, $quStrGetCList) or die ($quStrGetCList);


@	mysqli_data_seek ($quStrGetCList, 0);
while($rowGetCList=mysqli_fetch_object($quGetCList)) {
?>
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetCList->CLID";?>">
<?php

echo  "<A HREF=\"$PHP_SELF?op=editClient&clid=".$rowGetCList->CLID."\" target=\"edit$rowGetCList->CLID\">". $rowGetCList->NAME_LAST.", ".$rowGetCList->NAME_FIRST."</A><BR>" ;

}
?>

</FONT>
</TD></TR>

<TR><TD>

<SPAN style="font-size:12px;"><B>Inactive Clients:</B></SPAN><BR>

<FONT SIZE="-2">
<?php 


$quStrGetDList = "SELECT * FROM `CLIENTS` WHERE `UID`='$rowGetUser->UID' AND `GRID`='$grid' AND STATUS_CLIENT='2' ORDER BY `NAME_LAST`, `NAME_FIRST` ASC";			$quGetDList = mysqli_query($dbh, $quStrGetDList) or die ($quStrGetDList);

@	mysqli_data_seek ($quStrGetDList, 0);
while($rowGetDList=mysqli_fetch_object($quGetDList)) {
?>
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetDList->CLID";?>">
<?php

echo  "<A HREF=\"$PHP_SELF?op=editClient&clid=".$rowGetDList->CLID."\" target=\"edit$rowGetDList->CLID\">". $rowGetDList->NAME_LAST.", ".$rowGetDList->NAME_FIRST."</A><BR>" ;

}
?>
</FONT>
</TD></TR>

</table>
</TR></TD></TABLE>


</TD>

	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>

</TR>

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	
	<br>

<!--END agentreport -->