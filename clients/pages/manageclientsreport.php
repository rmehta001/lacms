<!--BEGIN agentreport -->

<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}

?>
	<br>

	<table border="0" cellspacing="0" cellpadding="0" width="90%" BGCOLOR="<?php echo $pagebgcolor;?>">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center">
		<table WIDTH="99%">
			<tr>
			<td height="30" width="500">

<?php if ($showback != "no") { ?>

<FONT SIZE="-1"><B><a href="<?php echo "$PHP_SELF?op=manageUsers";?>"><FONT COLOR="GREEN">Back to Admin</FONT></A></B></FONT><FONT SIZE="-3"><BR></FONT>

<?php } ?>

			<CENTER>





<B>CLIENTS / AGENTS REPORT</B><BR>


<TABLE CELLPADDING="2" CELLSPACING="0" BORDER="0"><TR>


<TD ROWSPAN="7">
<NOBR><FONT SIZE="-2"><B>Last 30 Office Logins:</B></NOBR><BR>
<DIV class="lastlogin">
<?php
$quStrGetLLogin = "SELECT * FROM (SESSIONS LEFT JOIN USERS ON SESSIONS.UID=USERS.UID) WHERE `GRID`=$grid ORDER BY `TIMEIN` DESC LIMIT 0,30";
	$quGetLLogin = mysqli_query($dbh, $quStrGetLLogin) or die ($quStrGetLLogin);
	$rowGetLLogin=mysqli_fetch_object($quGetLLogin);

@	mysqli_data_seek ($quGetLLogin, 0);

while($rowGetLLogin=mysqli_fetch_object($quGetLLogin)) {


echo  "<NOBR>". substr ($rowGetLLogin->TIMEIN, 0, 10) ." at ". substr ($rowGetLLogin->TIMEIN, 11, 8) ." - ".$rowGetLLogin->HANDLE."</NOBR><BR>" ;

}

?>
</FONT>
<BR>
</DIV>
</TD>
<TD ROWSPAN="7">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</TD>





<TD><NOBR>
<FONT SIZE=-1>
<?php
$result_clients = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE `GRID`='$grid'");
$num_active_clients = mysqli_num_rows($result_clients);
?>

Total # of Clients: </NOBR></TD><TD><FONT SIZE=-1><?php echo $num_active_clients;?></FONT></NOBR>
</TD>
</TR><TR><TD><NOBR><FONT SIZE=-1>
<?php 
$result_clientsactive = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND `GRID`='$grid'");
$num_active_clients = mysqli_num_rows($result_clientsactive);

echo "Total # of Active Clients <img border=\"0\" hspace=\"2\" vspace=\"0\" width=\"16\" height=\"16\" src=\"../assets/images/client-active.jpg\">: </NOBR></TD><TD><NOBR><FONT SIZE=-1>".$num_active_clients."</FONT></NOBR></TD></TR><TR><TD><NOBR><FONT SIZE=-1>";




$result_clientsinactive = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND `GRID`='$grid'");
$num_inactive_clients = mysqli_num_rows($result_clientsinactive);

echo "Total # of Inactive <img border=\"0\" hspace=\"2\" vspace=\"0\" width=\"16\" height=\"16\" src=\"../assets/images/client-inactive.jpg\"> Clients: </NOBR></TD><TD><NOBR><FONT SIZE=-1>".$num_inactive_clients."</FONT></NOBR></TD></TR><TR><TD><NOBR><FONT SIZE=-1>";





$result_clients30oldactive = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE (STATUS_CLIENT='1' AND ((`DATE_MODIFIED` < DATE_SUB(CURDATE() ,INTERVAL 30 DAY)) AND `GRID`='".$grid."'))");
$num_clients30oldactive = mysqli_num_rows($result_clients30oldactive);

echo "Total # of Active Clients Not Modified for over 30 days old: </FONT></NOBR></TD><TD><NOBR><FONT SIZE=-1>". $num_clients30oldactive . "</FONT></NOBR></TD></TR><TR><TD><NOBR><FONT SIZE=-1>";

$result_clients60oldactive = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE (STATUS_CLIENT='1' AND ((`DATE_MODIFIED` < DATE_SUB(CURDATE() ,INTERVAL 60 DAY)) AND `GRID`='".$grid."'))");
$num_clients60oldactive = mysqli_num_rows($result_clients60oldactive);

echo "Total # of Active Clients Not Modified for over 60 days old: </NOBR></TD><TD><NOBR><FONT SIZE=-1>".$num_agency60oldactive."</FONT></NOBR></TD></TR><TR><TD><NOBR><FONT SIZE=-1>";

$result_clients90oldactive = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE (STATUS_CLIENT='1' AND ((`DATE_MODIFIED` < DATE_SUB(CURDATE() ,INTERVAL 90 DAY)) AND `GRID`='".$grid."'))");
$num_clients90oldactive = mysqli_num_rows($result_clients90oldactive);

echo "Total # of Active Clients Not Modified for over 90 days old: </NOBR></TD><TD><NOBR><FONT SIZE=-1>".$num_clients90oldactive."</FONT></NOBR></TD></TR><TR><TD><NOBR><FONT SIZE=-1>";

$result_clientsin30active = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE (STATUS_CLIENT='1' AND (( (`DATE_MODIFIED` > DATE_SUB(CURDATE() ,INTERVAL 30 DAY) ) AND ((`DATE_MODIFIED` < DATE_SUB(CURDATE() ,INTERVAL 30 DAY))) AND `GRID`='".$grid."'))");
$num_clientsin30active = mysqli_num_rows($result_clientsin30active);

echo "Total # of Active Clients Modified within 30 days: </NOBR></TD><TD><NOBR><FONT SIZE=-1>".$num_clients90oldactive."</FONT></NOBR></TD></TR><TR><TD><NOBR><FONT SIZE=-1>";

?>


Total Maximum # of Clients:</FONT></NOBR></TD><TD><FONT SIZE=-1><B>Unlimited</B></FONT></NOBR></TD></TR></TABLE>

<FONT SIZE="-2"><BR>

<TABLE BGCOLOR="#FFFFFF" BORDER="1" BORDERCOLOR="#000000" CELLPADDING="0" CELLSPACING="0"><TR><TD>


<TABLE CELLPADDING="2" CELLSPACING="0" BORDER="0"><TR><TD><NOBR><FONT SIZE="-1">Click the # of days old to Deactivate <img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.gif' TITLE='Deactivate'>, Mark Unavailable <img src="../assets/images/icons/u.jpg" border=0 HEIGHT="10" WIDTH="10" alt="Unavailable Listing" title="Unavailable Listing">,</NOBR><BR><NOBR>&amp; Mark Occupied <img src="../assets/images/icons/occupied.jpg" border=0 height=10 width=10 alt="Occupied Unit" title="Occupied Unit"> ALL LISTINGS advertised by <?php echo $group;?></FONT>
</NOBR></TD><TD>&nbsp;</TD><TD><NOBR>&nbsp;
<A HREF="<?php echo "$PHP_SELF?op=14daysdeactivate&deactuser=ALL";?>"><FONT COLOR="#FF0000">14</FONT></A></B> &nbsp; <A HREF="<?php echo "$PHP_SELF?op=30daysdeactivate&deactuser=ALL";?>"><FONT COLOR="#FF0000">30</FONT></A></B> &nbsp; <A HREF="<?php echo "$PHP_SELF?op=60daysdeactivate&deactuser=ALL";?>"><FONT COLOR="#FF0000">60</FONT></A></B> &nbsp; <A HREF="<?php echo "$PHP_SELF?op=90daysdeactivate&deactuser=ALL";?>"><FONT COLOR="#FF0000">90</FONT></A></B></NOBR>
</TD>
</TR></TABLE>


</TD></TR></TABLE>
<BR>


</CENTER>


<NOBR><B>Breakdown of Ads by Agent:</B></NOBR><BR>

<TABLE><TR><TD>

<FONT SIZE="-2"><I>Username:</I></FONT><BR>
<?php

@	mysqli_data_seek ($quGetUsers, 0);

echo "<TABLE>";

while($rowGetUsers=mysqli_fetch_object($quGetUsers)) {

$result_agentactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE STATUS='ACT' AND `CLI`='$grid' AND `UID`=".$rowGetUsers->UID."");
$num_agentactive_ads = mysqli_num_rows($result_agentactive);


?>

<TR><TD><FONT SIZE="-2">
<?php echo $rowGetUsers->HANDLE;?>
</FONT></TD><TD>


<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/act.gif'>: </TD>
<TD><font size=-2>
<?php echo $num_agentactive_ads; ?>
</FONT></TD>
<TD><font size=-2>
<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.gif' TITLE='Deactivate'>: </FONT></TD><TD><font size=-2>
<?php
$result_agentinactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE STATUS='STO' AND `CLI`='$grid' AND `UID`=".$rowGetUsers->UID."");
$num_agentinactive_ads = mysqli_num_rows($result_agentinactive);
echo $num_agentinactive_ads;
?>
</FONT>
</TD>
<TD>&nbsp;</TD>
<TD>
<FONT SIZE="-2">
# of Active <img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/act.gif'> Ads over 30 days old: 
<?php
$result_agentoldactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE (STATUS='ACT' AND ((`MOD` < DATE_SUB(CURDATE() ,INTERVAL 30 DAY)) AND `CLI`='".$grid."' AND `UID`='".$rowGetUsers->UID."'))");
$num_agentoldactive_ads = mysqli_num_rows($result_agentoldactive);

if ($num_agentoldactive_ads !="0") {
echo "<B>".$num_agentoldactive_ads."</B>";
} else {
echo $num_agentoldactive_ads;
}
?>
</FONT>
</TD>
<TD> &nbsp;&nbsp;&nbsp;</TD>

<TD><NOBR>
<font size=-2>
<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.gif' TITLE='Deactivate'>Deactivate ads  for <B><?php echo $rowGetUsers->HANDLE;?></B> that are over </FONT></NOBR></TD><TD>&nbsp;</TD>
<TD><font size=-2>
<A HREF="<?php echo "$PHP_SELF?op=14daysdeactivate&deactuser=".$rowGetUsers->UID;?>" TITLE="Click to Deactivate Listings older than 14 days by <?php echo $rowGetUsers->HANDLE;?>"><FONT COLOR="#FF0000">14</FONT></A></FONT></TD>
<TD><font size=-2>
<A HREF="<?php echo "$PHP_SELF?op=30daysdeactivate&deactuser=".$rowGetUsers->UID;?>" TITLE="Click to Deactivate Listings older than 30 days by <?php echo $rowGetUsers->HANDLE;?>"><FONT COLOR="#FF0000">30</FONT></A></FONT></TD>
<TD><font size=-2>
<A HREF="<?php echo "$PHP_SELF?op=60daysdeactivate&deactuser=".$rowGetUsers->UID;?>" TITLE="Click to Deactivate Listings older than 60 days by <?php echo $rowGetUsers->HANDLE;?>"><FONT COLOR="#FF0000">60</FONT></A></FONT></TD>
<TD><font size=-2>
<A HREF="<?php echo "$PHP_SELF?op=90daysdeactivate&deactuser=".$rowGetUsers->UID;?>" TITLE="Click to Deactivate Listings older than 90 days by <?php echo $rowGetUsers->HANDLE;?>"><FONT COLOR="#FF0000">90</FONT></A></FONT></TD>
<TD>
<FONT SIZE="-2">
days old.</FONT>
</TD>

</TR>

<?php } ?>

</TABLE>
</TD></TR></TABLE>

<BR>





<TABLE WIDTH="99%"><TR><TD VALIGN="TOP" WIDTH="47%">



<NOBR><SPAN style="font-size:12px;"><B>Last 25 Listings Modified by the office:</B></SPAN></NOBR><BR><BR>
<?php

$quStrGetLAList = "SELECT * FROM `CLASS` LEFT JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE `CLI`=$grid ORDER BY `MOD` DESC LIMIT 0,25";
	$quGetLAList = mysqli_query($dbh, $quStrGetLAList) or die ($quStrGetLAList);
	$rowGetLAList=mysqli_fetch_object($quGetLAList);

@	mysqli_data_seek ($quGetLAList, 0);

echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0'>";

while($rowGetLAList=mysqli_fetch_object($quGetLAList)) {

$rowGetLAList->LOCNAME = str_replace("BOSTON - ", "", $rowGetLAList->LOCNAME);

echo  "<TR><TD VALIGN='TOP'><NOBR><FONT SIZE='-2'><STRONG><A HREF=\"$PHP_SELF?op=adlEdit&cid=".$rowGetLAList->CID."\" target=\"edit$rowGetLAList->CID\"><img border=0 src='../images/icons/edit.gif' alt='edit' HEIGHT='10'>".$rowGetLAList->STREET_NUM." ".$rowGetLAList->STREET." ".$rowGetLAList->APT."</STRONG> - ".$rowGetLAList->LOCNAME."</FONT></A></FONT></NOBR></TD><TD VALIGN='TOP'><NOBR><FONT SIZE='-2'>&nbsp;" ;

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
			

echo " | ".$rowGetLAList->MOD." | ".$rowGetLAList->MODBY."</FONT></NOBR></TD></TR>";
}

?>
</TABLE>


</TD>
<TD  WIDTH="6%">&nbsp;</TD>
<TD VALIGN="TOP" WIDTH="47%">
<NOBR><SPAN style="font-size:12px;"><B>Last 25 Listings Created by the office:</B></SPAN></NOBR><BR><BR>
<?php 
$quStrGetLBList = "SELECT * FROM `CLASS` LEFT JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE `CLI`=$grid ORDER BY `DATEIN` DESC LIMIT 0,25";
	$quGetLBList = mysqli_query($dbh, $quStrGetLBList) or die ($quStrGetLBList);
	$rowGetLBList=mysqli_fetch_object($quGetLBList);


echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0'>";

@	mysqli_data_seek ($quGetLBList, 0);
while($rowGetLBList=mysqli_fetch_object($quGetLBList)) {
$rowGetLBList->LOCNAME = str_replace("BOSTON - ", "", $rowGetLBList->LOCNAME);

echo  "<TR><TD VALIGN='TOP'><NOBR><FONT SIZE='-2'><STRONG><A HREF=\"$PHP_SELF?op=adlEdit&cid=".$rowGetLBList->CID."\" target=\"edit$rowGetLBList->CID\"><img border=0 src='../images/icons/edit.gif' alt='edit' HEIGHT='10'>".$rowGetLBList->STREET_NUM." ".$rowGetLBList->STREET." ".$rowGetLBList->APT." </STRONG> - ".$rowGetLBList->LOCNAME."</A></FONT></NOBR></TD><TD VALIGN='TOP'><NOBR><FONT SIZE='-2'>&nbsp;" ;

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
			

echo " | ".$rowGetLBList->MOD." | ".$rowGetLBList->MODBY."</FONT></NOBR></TD></TR>";
}
?>
</TABLE>


</TD></TR></TABLE>



<BR>

<TABLE><TR><TD>
<SPAN style="font-size:12px;"><B>Last 250 Ads posted to Craigslist by <?php echo $group ;?>:</B></SPAN>
<BR>
<div class="toplist">
<?php 
$quStrGetCLList = "SELECT * FROM (((POSTTO LEFT JOIN USERS ON POSTTO.UID = USERS.UID) LEFT JOIN CLASS ON POSTTO.CID = CLASS.CID) INNER JOIN LOC ON CLASS.LOC = LOC.LOCID) WHERE POSTTO.CLI ='$grid' AND `POSTWHERE`='Craigslist' ORDER BY `POSTDATE` DESC LIMIT 0,250";
	$quGetCLList = mysqli_query($dbh, $quStrGetCLList) or die ($quStrGetCLList);
	$rowGetCLList=mysqli_fetch_object($quGetCLList);


echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0'>";

@	mysqli_data_seek ($quGetCLList, 0);
while($rowGetCLList=mysqli_fetch_object($quGetCLList)) {

echo  "<TR><TD VALIGN='TOP'><NOBR><FONT SIZE='-2'><img border=0 src='../images/icons/edit.gif' alt='edit' HEIGHT='10'><A HREF=\"$PHP_SELF?op=adlEdit&cid=".$rowGetCLList->CID."\" target=\"edit$rowGetCLList->CID\"># ". $rowGetCLList->CID."-".$rowGetCLList->LOCNAME."-".$rowGetCLList->STREET_NUM." ".$rowGetCLList->STREET." ".$rowGetCLList->APT."</A></FONT></NOBR></TD><TD VALIGN='TOP'><NOBR><FONT SIZE='-2'>&nbsp;" ;


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
			


echo  " | ". substr ($rowGetCLList->POSTDATE, 0, 10) ." at ". substr ($rowGetCLList->POSTDATE, 11, 8) ." by: ".$rowGetCLList->HANDLE."</FONT></NOBR></TD></TR>" ;

}
?>
</TABLE>
</TD>
</TR></TABLE>

</DIV>


</td>
		</tr>

<TR><TD>




<SPAN style="font-size:12px;"><B>Listings/Ads Marked Pending <img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="12" WIDTH="12" alt="Pending Status - Yes" title="Pending Status = YES - Check Status"> for the office:</B></SPAN>
<TABLE BORDER="0" WIDTH="700">
<?php 

	$quStrGetListing = "select * from ((CLASS INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) where CLI='$grid' and STATUS_PENDING!='0'";
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



		</TD>
		</TR>


</table>
		<br>

</TD>

	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>

</TR>

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	
	<br>

<!--END agentreport -->