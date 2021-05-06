<!--BEGIN agentreport -->

<?php
$PHP_SELF = $_SERVER['PHP_SELF'];
if ($_SESSION['pref_pagebg'] == "") {
    $pagebgcolor = "#F5F5DC";
} else {
    $pagebgcolor = $_SESSION['pref_pagebg'];
}
?>
	<br>

	<table border="0" cellspacing="0" class = "table-striped" cellpadding="0" width="100%" BGCOLOR="#86cfda">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<!-- <td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td> -->
	<td align="center">
		<table  class = "full-width">
			<tr>
			<td height="30" width="500" class="p-2">

<?php if (isset($showback)) {
    if ($showback != "no") {?>

<FONT SIZE="-1"><B><a href="<?php echo "$PHP_SELF?op=manageUsers"; ?>"><FONT COLOR="GREEN">Back to Manage Agents</FONT></A></B></FONT><FONT SIZE="-3"><BR></FONT>

<?php }
}
?>

			<CENTER>





<B>AGENT <?php if (isset($showback)) {
    if ($showback == "no") {echo " ACTIVITY ";}
}
?> REPORT</B><BR>

<NOBR>Username: <?php if (isset($rowGetUser)) {
    echo $rowGetUser->HANDLE;
}
?> - Agent ID# <?php if (isset($rowGetUser)) {
    echo $rowGetUser->UID;
}
?></NOBR><BR>

<TABLE BORDER="0"><TR><TD><NOBR>
<FONT SIZE="-2">
<?php
if (isset($rowGetUser)) {
    $result_agentactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE STATUS='ACT' AND `CLI`='" . $grid . "' AND `UID`='" . $rowGetUser->UID . "'");
    $num_agentactive_ads = mysqli_num_rows($result_agentactive);
}
if (isset($num_agentactive_ads)) {
    echo "Total # of Active Ads <img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/act.gif'>: </FONT> &nbsp; <FONT SIZE='-2'>" . $num_agentactive_ads . "</FONT> &nbsp; <FONT SIZE='-2'>";
}

if (isset($rowGetUser)) {
    $result_agentinactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE STATUS='STO' AND `CLI`='" . $grid . "' AND `UID`='" . $rowGetUser->UID . "'");
    $num_agentinactive_ads = mysqli_num_rows($result_agentinactive);
}
if (isset($num_agentinactive_ads)) {
    echo "Total # of Inactive Ads <img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.gif'>: </FONT> &nbsp; <FONT SIZE='-2'>" . $num_agentinactive_ads . "</FONT></NOBR></TD></TR></TABLE>";
}

?>


<TABLE BORDER="0"><TR><TD><NOBR><FONT SIZE="-2">
<?php
if (isset($rowGetUser)) {
    $result_agent30oldactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE (STATUS='ACT' AND ((`MOD` < DATE_SUB(CURDATE() ,INTERVAL 30 DAY)) AND `UID`=" . $rowGetUser->UID . " AND `CLI`='" . $grid . "'))");
    $num_agent30oldactive_ads = mysqli_num_rows($result_agent30oldactive);
}
if (isset($num_agent30oldactive_ads)) {
    echo "<NOBR>Total # of Active Ads <img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/act.gif'> over 30 days: </FONT></NOBR></TD><TD><NOBR><FONT SIZE='-2'>" . $num_agent30oldactive_ads . "</FONT></NOBR></TD><TD><NOBR><FONT SIZE=-2>";
}

if (isset($rowGetUser)) {

    $result_agent60oldactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE (STATUS='ACT' AND ((`MOD` < DATE_SUB(CURDATE() ,INTERVAL 60 DAY)) AND `UID`=" . $rowGetUser->UID . " AND `CLI`='" . $grid . "'))");
    $num_agent60oldactive_ads = mysqli_num_rows($result_agent60oldactive);
}
if (isset($num_agent60oldactive_ads)) {
    echo " | 60 days: </FONT></NOBR></TD><TD><NOBR><FONT SIZE='-2'>" . $num_agent60oldactive_ads . "</FONT></NOBR></TD><TD><NOBR><FONT SIZE=-2>";
}

if (isset($rowGetUser)) {
    $result_agent90oldactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE (STATUS='ACT' AND ((`MOD` < DATE_SUB(CURDATE() ,INTERVAL 90 DAY)) AND `UID`=" . $rowGetUser->UID . " AND `CLI`='" . $grid . "'))");
    $num_agent90oldactive_ads = mysqli_num_rows($result_agent90oldactive);
}
if (isset($num_agent90oldactive_ads)) {
    echo " | 90 days: </FONT></NOBR></TD><TD><FONT SIZE='-2'>" . $num_agent90oldactive_ads . "</FONT></TD></TABLE>";
}

?>

<BR>

<TABLE BGCOLOR="#FFFFFF" BORDER="1" BORDERCOLOR="#000000" CELLPADDING="0" CELLSPACING="0"><TR><TD>
<TABLE CELLPADDING="10"  CELLSPACING="0" BORDER="0"><TR><TD><NOBR><FONT SIZE="-1">Click the # of days old to Deactivate <img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.gif' TITLE='Deactivate'>, Mark Unavailable <img src="../assets/images/icons/u.jpg" border=0 HEIGHT="10" WIDTH="10" alt="Unavailable Listing" title="Unavailable Listing">,</NOBR><BR><NOBR>&amp; Mark Occupied <img src="../assets/images/icons/occupied.jpg" border=0 height=10 width=10 alt="Occupied Unit" title="Occupied Unit"> ALL LISTINGS advertised by <?php if (isset($rowGetUser)) {
    echo $rowGetUser->HANDLE;
}
?></FONT>
</NOBR></TD><TD>&nbsp;</TD><TD><NOBR>&nbsp;
<A HREF="<?php if (isset($rowGetUser)) {
    echo "$PHP_SELF?op=30daysdeactivateagent&deactuser=" . $rowGetUser->UID;
}
?>"><FONT COLOR="#FF0000">30</FONT></A></B>
&nbsp;&nbsp;<A HREF="<?php if (isset($rowGetUser)) {
    echo "$PHP_SELF?op=30daysdeactivateagent&deactuser=" . $rowGetUser->UID;
}
?>"><FONT COLOR="#FF0000">60</FONT></A></B>
&nbsp;&nbsp; <A HREF="<?php if (isset($rowGetUser)) {
    echo "$PHP_SELF?op=30daysdeactivateagent&deactuser=" . $rowGetUser->UID;
}
?>"><FONT COLOR="#FF0000">90</FONT></A></B>
</NOBR></TD></TR></TABLE>
</TD></TR></TABLE>
<BR>




<?php
if (isset($rowGetUser)) {
    $quStrGetLLogin = "SELECT * FROM `SESSIONS` WHERE `UID`=$rowGetUser->UID ORDER BY `TIMEIN` DESC LIMIT 0,30";
    $quGetLLogin = mysqli_query($dbh, $quStrGetLLogin) or die($quStrGetLLogin);
    $rowGetLLogin = mysqli_fetch_object($quGetLLogin);
}
?>

<TABLE CELLPADDING="10"  CELLSPACING="0" BORDER="0" BGCOLOR="#FFFFFF" WIDTH="100%"><TR><TD>
<TABLE WIDTH="99%"  BGCOLOR="#FFFFFF"><TR><TD VALIGN="TOP" WIDTH="46%">




<FONT SIZE="-2"><NOBR><SPAN style="font-size:12px;"><B>Last 25 Listings Modified by <?php if (isset($rowGetUser)) {
    echo $rowGetUser->HANDLE;
}
?>:</SPAN></B></NOBR><BR><BR>

<?php
if (isset($rowGetUser)) {
    $quStrGetLAList = "SELECT * FROM `CLASS` LEFT JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE `MODBY`=\"$rowGetUser->HANDLE\" AND `CLI`=$grid ORDER BY `MOD` DESC LIMIT 0,25";
    $quGetLAList = mysqli_query($dbh, $quStrGetLAList) or die($quStrGetLAList);
    $rowGetLAList = mysqli_fetch_object($quGetLAList);

    @mysqli_data_seek($quGetLAList, 0);
}
echo "<TABLE CELLPADDING='5' CELLSPACING='0' BORDER='0'>";
if (isset($quGetLAList)) {
    while ($rowGetLAList = mysqli_fetch_object($quGetLAList)) {

        $rowGetLAList->LOCNAME = str_replace("BOSTON - ", "", $rowGetLAList->LOCNAME);

        echo "<TR><TD VALIGN='TOP'><NOBR><FONT SIZE='3'><A HREF=\"$PHP_SELF?op=adlEdit&cid=" . $rowGetLAList->CID . "\" target=\"edit$rowGetLAList->CID\"><img border=0 src='../images/icons/edit.gif' alt='edit' HEIGHT='10'><B>" . $rowGetLAList->STREET_NUM . " " . $rowGetLAList->STREET . " " . $rowGetLAList->APT . "</B> - " . $rowGetLAList->LOCNAME . "</A></FONT></NOBR></TD><TD VALIGN='TOP'><NOBR><FONT SIZE='3'>&nbsp;";

        if ($rowGetLAList->STATUS == "ACT") {
            echo "<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/act.gif'>";
        } else {
            echo "<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.jpg'>";
        }?>


<?php if ($rowGetLAList->STATUS_ACTIVE == "1") {?>

<img src="../assets/images/icons/a.jpg" border=0 height=10 width=10 vspace='2' hspace='0'>

			    <?php } else {?>
<img src="../assets/images/icons/u.jpg" border=0 height=10 width=10 vspace='2' hspace='0'>
			<?php }

        echo " | " . $rowGetLAList->MOD . "</FONT></NOBR></TD></TR>";
    }
}

?>
</TABLE>


</TD>
<TD  WIDTH="5%">&nbsp;</TD>
<TD VALIGN="TOP" WIDTH="30%">
<NOBR><SPAN style="font-size:12px;"><B>Last 25 Listings Created by <?php if (isset($rowGetUser)) {
    echo $rowGetUser->HANDLE;
}
?>:</B></SPAN></NOBR><BR><BR>
<?php
if (isset($rowGetUser)) {
    $quStrGetLBList = "SELECT * FROM `CLASS`  LEFT JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE `UID`=\"$rowGetUser->UID\" AND `CLI`=$grid ORDER BY `DATEIN` DESC LIMIT 0,25";
    $quGetLBList = mysqli_query($dbh, $quStrGetLBList) or die($quStrGetLBList);
    $rowGetLBList = mysqli_fetch_object($quGetLBList);

    echo "<TABLE CELLPADDING='5' CELLSPACING='0' BORDER='0'>";

    @mysqli_data_seek($quGetLBList, 0);
    while ($rowGetLBList = mysqli_fetch_object($quGetLBList)) {

        $rowGetLBList->LOCNAME = str_replace("BOSTON - ", "", $rowGetLBList->LOCNAME);

        echo "<TR><TD VALIGN='TOP'><NOBR><FONT SIZE='3'><A HREF=\"$PHP_SELF?op=adlEdit&cid=" . $rowGetLBList->CID . "\" target=\"edit$rowGetLBList->CID\"><img border=0 src='../images/icons/edit.gif' alt='edit' HEIGHT='10'><B>" . $rowGetLBList->STREET_NUM . " " . $rowGetLBList->STREET . " " . $rowGetLBList->APT . "</B> - " . $rowGetLBList->LOCNAME . "</FONT></A></NOBR></TD><TD VALIGN='TOP'><NOBR><FONT SIZE='3'>&nbsp;";

        if ($rowGetLBList->STATUS == "ACT") {
            echo "<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/act.gif'>";
        } else {
            echo "<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.jpg'>";
        }?>


<?php if ($rowGetLBList->STATUS_ACTIVE == "1") {?>

<img src="../assets/images/icons/a.jpg" border=0 height=10 width=10 vspace='2' hspace='0'>

			    <?php } else {?>
<img src="../assets/images/icons/u.jpg" border=0 height=10 width=10 vspace='2' hspace='0'>
			<?php }

        echo " | " . $rowGetLBList->MOD . "</FONT></NOBR></TD></TR>";
    }}
?>
</TABLE>


</TD></TR></TABLE>
</TD></TR></TABLE>


<BR>

<!--<TABLE BORDER="0"><TR><TD>-->
<!---->
<!--	<form action="--><?php //echo "$PHP_SELF?op=listings&listing_filter_display=none";?><!--" method="POST">-->
<!--	<input type="hidden" name="filterChange" value="1">-->
<!--	<input type="hidden" name="user" value="--><?php // if (isset($euid)) echo $euid;?><!--">-->
<!--	<input type="submit" value="View ALL Listings CREATED by --><?php // if (isset($rowGetUser)) echo $rowGetUser->HANDLE;?><!--" STYLE="Background-Color : #E0FFFF">-->
<!--	</form>-->
<!--</TD><TD>&nbsp;</TD><TD>-->
<!---->
<!--	<form action="--><?php //echo "$PHP_SELF?op=listings&listing_filter_display=none";?><!--" method="POST">-->
<!--	<input type="hidden" name="filterChange" value="1">-->
<!--	<input type="hidden" name="modby" value="--><?php // if (isset($rowGetUser)) echo $rowGetUser->HANDLE;?><!--">-->
<!--	<input type="submit" value="View ALL Listings LAST MODIFIED by --><?php // if (isset($rowGetUser)) echo $rowGetUser->HANDLE;?><!--" STYLE="Background-Color : #E0FFFF">-->
<!--	</form>-->
<!--</TD></TR></TABLE>-->



</td>
		</tr>

		<TR><TD>

<TABLE CELLPADDING="10" CELLSPACING="0" BORDER="1" width = "100%" BGCOLOR="#FFFFFF"><TR><TD>
<TABLE width = "100%"><TR><TD>
<SPAN style="font-size:12px;"><B>Last 100 Ads posted to Craigslist by <?php if (isset($rowGetUser)) {
    echo $rowGetUser->HANDLE;
}
?>:</B></SPAN>
<BR>

<div class="toplist">


<?php
if (isset($rowGetUser)) {
    $quStrGetCLList = "SELECT * FROM ((POSTTO LEFT JOIN CLASS ON POSTTO.CID = CLASS.CID) INNER JOIN LOC ON CLASS.LOC = LOC.LOCID) WHERE POSTTO.CLI ='$grid' AND POSTTO.UID=\"$rowGetUser->UID\" AND `POSTWHERE`='Craigslist' ORDER BY `POSTDATE` DESC LIMIT 0,100";
    $quGetCLList = mysqli_query($dbh, $quStrGetCLList) or die($quStrGetCLList);
    $rowGetCLList = mysqli_fetch_object($quGetCLList);

    echo "<TABLE CELLPADDING='5' CELLSPACING='0' BORDER='0' width = '100%'>";

    @mysqli_data_seek($quGetCLList, 0);
    while ($rowGetCLList = mysqli_fetch_object($quGetCLList)) {

        echo "<TR><TD VALIGN='TOP'><NOBR><FONT SIZE='3'><A HREF=\"$PHP_SELF?op=adlEdit&cid=" . $rowGetCLList->CID . "\" target=\"edit$rowGetCLList->CID\"><img border=0 src='../images/icons/edit.gif' alt='edit' HEIGHT='10'><B>" . $rowGetCLList->STREET_NUM . " " . $rowGetCLList->STREET . " " . $rowGetCLList->APT . " </B> - " . $rowGetCLList->LOCNAME . "</A></FONT></NOBR></TD><TD VALIGN='TOP'><NOBR><FONT SIZE='3'>&nbsp;";

        if ($rowGetCLList->STATUS == "ACT") {
            echo "<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/act.gif'>";
        } else {
            echo "<img border='0' vspace='2' hspace='0' width='10' height='10' src='../assets/images/inact.jpg'>";
        }?>


<?php if ($rowGetCLList->STATUS_ACTIVE == "1") {?>

<img src="../assets/images/icons/a.jpg" border=0 height=10 width=10 vspace='2' hspace='0'>

			    <?php } else {?>
<img src="../assets/images/icons/u.jpg" border=0 height=10 width=10 vspace='2' hspace='0'>
			<?php }

        echo " | " . substr($rowGetCLList->POSTDATE, 0, 10) . " at " . substr($rowGetCLList->POSTDATE, 11, 8) . "</FONT></NOBR></TD></TR>";
    }
}
?>
</TABLE>
</div>


</TD>

<TD class = "d-block ml-2 p-2">

<FONT SIZE="3"><B>Last 30 Logins by <?php if (isset($rowGetUser)) {
    echo $rowGetUser->HANDLE;
}
?>:</B><BR><BR>

<DIV CLASS="lastloginagent">
<?php
@mysqli_data_seek($quGetLLogin, 0);

if (isset($quGetLLogin)) {
    while ($rowGetLLogin = mysqli_fetch_object($quGetLLogin)) {

        echo "<NOBR>" . substr($rowGetLLogin->TIMEIN, 0, 10) . " at " . substr($rowGetLLogin->TIMEIN, 11, 8) . "</NOBR><BR>";

    }
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




<TABLE CELLPADDING="10" CELLSPACING="0" BORDER="1" BGCOLOR="#FFFFFF" WIDTH="100%"><TR><TD>

<SPAN style="font-size:12px;"><B>Listings/Ads Marked Pending <img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="12" WIDTH="12" alt="Pending Status - Yes" title="Pending Status = YES - Check Status"> by <?php if (isset($rowGetUser)) {
    echo $rowGetUser->HANDLE;
}
?>:</B></SPAN>

<TABLE BORDER="0" WIDTH="100%" CELLPADDING="10">
<?php
if (isset($rowGetUser)) {
    $quStrGetListing = "select * from ((CLASS INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) where CLI='$grid' and STATUS_PENDING!='0' AND MODBY=\"$rowGetUser->HANDLE\"";
    $quGetListing = mysqli_query($dbh, $quStrGetListing) or die(mysqli_error());

    @mysqli_data_seek($quStrGetListing, 0);
    while ($rowGetListing = mysqli_fetch_object($quGetListing)) {
        ?>

<TR>
<TD WIDTH="700" style="font-size:15px;">

<?php if ($rowGetListing->STATUS_PENDING == "1") {?>
<img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="12" WIDTH="12" alt="Pending Status - Yes" TITLE="Pending Status Yes - Click to change Pending Status">
<?php }?>


<?php if ($rowGetListing->STATUS == "ACT") {
            echo "<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/act.gif'>";
        } else {
            echo "<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/inact.jpg'>";
        }?>


<?php if ($rowGetListing->STATUS_ACTIVE == "1") {?>

<img src="../assets/images/icons/a.jpg" border="0" height="12" width="12">

			    <?php } else {?>
<img src="../assets/images/icons/u.jpg" border="0" height="12" width="12">
			<?php }?>


	<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetListing->CID"; ?>"><img border=0 src="../images/icons/edit.gif" alt="edit" HEIGHT="12"><?php echo $rowGetListing->TYPENAME; ?> - <?php echo $rowGetListing->LOCNAME; ?> - $<?php echo $rowGetListing->PRICE; ?> <?php echo $rowGetListing->STREET_NUM; ?> <?php echo $rowGetListing->STREET; ?> #<?php echo $rowGetListing->APT; ?> - Listing #<?php echo $rowGetListing->CID; ?> - mod: <?php echo $rowGetListing->MODBY; ?> on <?php echo $rowGetListing->MOD; ?></a>


 <?php }}?>
</DIV>
<BR>
</td>
</tr>
</table>
</TD></TR></TABLE>


		</TD>
		</TR>


<TR><TD>

<TABLE CELLPADDING="10" CELLSPACING="0" BORDER="1" BGCOLOR="#FFFFFF" WIDTH="100%"><TR><TD>

<SPAN style="font-size:12px;"><B>Active Clients:</B></SPAN><BR>
<FONT SIZE="-2">
<?php

if (isset($rowGetUser)) {
    $quStrGetCList = "SELECT * FROM `CLIENTS` WHERE `UID`='$rowGetUser->UID' AND `GRID`='$grid' AND STATUS_CLIENT='1' ORDER BY `NAME_LAST`, `NAME_FIRST` ASC";
    $quGetCList = mysqli_query($dbh, $quStrGetCList) or die($quStrGetCList);
}
echo "<TABLE WIDTH=\"100%\" CELLPADDING=\"10\" CELLSPACING=\"0\">";

if ($_SESSION['pref_row_color']) {
    $rowColor = $_SESSION['pref_row_color'];
} else {
    $rowColor = "#F5F5DC";
}

@mysqli_data_seek($quStrGetCList, 0);

if (isset($quGetCList)) {
    while ($rowGetCList = mysqli_fetch_object($quGetCList)) {
        ?>

<TR bgcolor="<?php echo $rowColor; ?>"><TD WIDTH="250">
<div class="controltext med-font">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetCList->CLID"; ?>">
<?php

        echo "<A HREF=\"$PHP_SELF?op=editClient&clid=" . $rowGetCList->CLID . "\" target=\"edit$rowGetCList->CLID\">" . $rowGetCList->NAME_LAST . ", " . $rowGetCList->NAME_FIRST . "</A>";
        ?>
</DIV>

</TD>
<TD ><div class="controltext med-font">
<?php echo $rowGetCList->DATE_NEXT_CONTACT; ?>
</DIV></TD>
<TD WIDTH="5">&nbsp;</TD>
<TD><div class="controltext med-font">
<?php
foreach ($DEFINED_VALUE_SETS['CLIENT_STATUS2'] as $cskey => $csValue) {

            if ($rowGetCList->CLIENT_STATUS2 == "$cskey") {
                echo "<NOBR>$csValue</NOBR>";
            }
        }
        ?></DIV>
</TD>

<td WIDTH="16"><CENTER>
<?php
if ($rowGetCList->CLIENT_EMAIL) {

            echo "<A HREF=\"$PHP_SELF?op=mail_client&clid=$rowGetCList->CLID\" target=\"_email$rowGetCList->CLID\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";
        } else {
            echo "&nbsp;";
        }

        ;?>

</CENTER></td>

<td ALIGN=CENTER  WIDTH="16"><div class="ad">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetCList->CLID"; ?>#appointment" TITLE="Make Appointment with <?php echo "$rowGetCList->NAME_FIRST  $rowGetCList->NAME_LAST"; ?>" target="appt<?php echo $rowGetCList->CLID; ?>"><img border="0" hspace="0" vspace="0" width="19" height="19" src="../images/clock.gif" TITLE="Make an Appointment" ALT="Make an Appointment"></A>
</TD>


<td ALIGN=CENTER WIDTH="16"><div class="ad">

<a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowGetCList->CLID"; ?>" TITLE="Showing History for <?php echo "$rowGetCList->NAME_FIRST $rowGetCList->NAME_LAST"; ?>" target="_sh<?php echo $rowGetCList->CLID; ?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History" ALT="Showing History"></A>
</TD>

<td ALIGN=CENTER WIDTH="19"><div class="ad"><a href="<?php echo "$PHP_SELF?op=listings&client_id_filter=$rowGetCList->CLID"; ?>" target="match<?php echo $rowGetCList->CLID; ?>"><img border="0" hspace="2" vspace="0" width="19" height="19" src="../assets/images/matchlistings.gif" TITLE="Match Client to Listings" ALT="Match Client to Listings"></a></div></td>

<TD ALIGN=RIGHT WIDTH="25">

		<?php if ($rowGetCList->PUBLIC != "0") {echo "<div class=\"controltext\"><FONT COLOR='#999999'>Shared</FONT></DIV>";} else {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}?>

</TD><TD WIDTH="5">

<?php if (($rowGetCList->UID == "$uid") or ((($_SESSION['isAdmin']) or ($_SESSION['user_level'] >= "4")) and ($rowGetCList->UID != "$uid"))) {?><A HREF="<?php echo "$PHP_SELF?op=editClientReassign&clid=$rowGetCList->CLID&fname=$rowGetCList->NAME_FIRST&lname=$rowGetCList->NAME_LAST"; ?>"><?php }?><img border="0" hspace="0" vspace="2" width="16" height="16" src="../assets/images/client-reassign.gif" TITLE="Reassign Client" ALT="Reassign Client"><?php if (($rowGetCList->UID == "$uid") or ((($_SESSION['isAdmin']) or ($_SESSION['user_level'] >= "4")) and ($rowGetCList->UID != "$uid"))) {?></A><?php }?>

</TD><TD WIDTH="16">

<?php
if ($rowGetCList->STATUS_CLIENT == "2") {
            if ($_SESSION['user_level'] > "1") {?><a href="<?php echo "$PHP_SELF?op=client-active&clid=$rowGetCList->CLID&cluid=$rowGetCList->UID&return=hotlist"; ?>"><?php }?><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/client-inactive.jpg"><?php if ($_SESSION['user_level'] > "1") {?></a><?php }?><?php }
        if ($rowGetCList->STATUS_CLIENT != "2") {
            if ($_SESSION['user_level'] > "1") {?><a href="<?php echo "$PHP_SELF?op=client-inactive&clid=$rowGetCList->CLID&cluid=$rowGetCList->UID&return=hotlist"; ?>"><?php }?><img border="0" hspace="2" vspace="0" width="16" height="16" src="../assets/images/client-active.jpg"><?php if ($_SESSION['user_level'] > "1") {?></a><?php }?>
<?php }?>

</FONT>
</TD>
</TR>
    	<?php
if ($rowColor == "#F5F5DC" or $rowColor == $_SESSION['pref_row_color']) {
            $rowColor = "#FFFFFF";
        } else {

            if ($_SESSION['pref_row_color']) {
                $rowColor = $_SESSION['pref_row_color'];
            } else {
                $rowColor = "#F5F5DC";
            }
        }
    }
}
?>


</TABLE>
</TD></TR></TABLE>

<TABLE CELLPADDING="10" CELLSPACING="0" BORDER="1" BGCOLOR="#FFFFFF" WIDTH="100%"><TR><TD>

<SPAN style="font-size:12px;"><B>Inactive Clients:</B></SPAN><BR>

<FONT SIZE="-2">
<?php
if (isset($rowGetUser)) {
    $quStrGetDList = "SELECT * FROM `CLIENTS` WHERE `UID`='$rowGetUser->UID' AND `GRID`='$grid' AND STATUS_CLIENT='2' ORDER BY `NAME_LAST`, `NAME_FIRST` ASC";
    $quGetDList = mysqli_query($dbh, $quStrGetDList) or die($quStrGetDList);
    @mysqli_data_seek($quStrGetDList, 0);

    echo "<TABLE WIDTH=\"100%\" CELLPADDING=\"10\" CELLSPACING=\"0\">";

    if ($_SESSION['pref_row_color']) {
        $rowColor = $_SESSION['pref_row_color'];
    } else {
        $rowColor = "#F5F5DC";
    }

    while ($rowGetDList = mysqli_fetch_object($quGetDList)) {
        ?>
<TR bgcolor="<?php echo $rowColor; ?>"><TD WIDTH="250"><div class="controltext med-font">

<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetDList->CLID"; ?>"><?php echo "<A HREF=\"$PHP_SELF?op=editClient&clid=" . $rowGetDList->CLID . "\" target=\"edit$rowGetDList->CLID\">" . $rowGetDList->NAME_LAST . ", " . $rowGetDList->NAME_FIRST . "</A><BR>";
        ?></DIV>
<TD ><div class="controltext med-font">
<?php echo $rowGetDList->DATE_NEXT_CONTACT; ?>
</DIV></TD>
<TD WIDTH="5">&nbsp;</TD>
<TD><div class="controltext med-font">
<?php
foreach ($DEFINED_VALUE_SETS['CLIENT_STATUS2'] as $cskey => $csValue) {

            if ($rowGetDList->CLIENT_STATUS2 == "$cskey") {
                echo "<NOBR>$csValue</NOBR>";
            }
        }

        ?></DIV>
</TD>

<td WIDTH="16"><CENTER>
<?php
if ($rowGetDList->CLIENT_EMAIL) {

            echo "<A HREF=\"$PHP_SELF?op=mail_client&clid=$rowGetDList->CLID\" target=\"_email$rowGetDList->CLID\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";
        } else {
            echo "&nbsp;";
        }
    }
    ;?>

</CENTER></td>

<td ALIGN=CENTER  WIDTH="16"><div class="ad">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetDList->CLID"; ?>#appointment" TITLE="Make Appointment with <?php echo "$rowGetDList->NAME_FIRST  $rowGetDList->NAME_LAST"; ?>" target="appt<?php echo $rowGetDList->CLID; ?>"><img border="0" hspace="0" vspace="0" width="19" height="19" src="../images/clock.gif" TITLE="Make an Appointment" ALT="Make an Appointment"></A>
</TD>

<td ALIGN=CENTER WIDTH="16"><div class="ad">
<a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowGetDList->CLID"; ?>" TITLE="Showing History for <?php echo "$rowGetDList->NAME_FIRST $rowGetDList->NAME_LAST"; ?>" target="_sh<?php echo $rowGetDList->CLID; ?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History" ALT="Showing History"></A>
</TD>

<td ALIGN=CENTER WIDTH="19"><div class="ad"><a href="<?php echo "$PHP_SELF?op=listings&client_id_filter=$rowGetDList->CLID"; ?>" target="match<?php echo $rowGetDList->CLID; ?>"><img border="0" hspace="2" vspace="0" width="19" height="19" src="../assets/images/matchlistings.gif" TITLE="Match Client to Listings" ALT="Match Client to Listings"></a></div></td>

<TD ALIGN=RIGHT WIDTH="25">

		<?php if (isset($rowGetDList)) {
        if ($rowGetDList->PUBLIC != "0") {echo "<div class=\"controltext\"><FONT COLOR='#999999'>Shared</FONT></DIV>";} else {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
    }
    ?>

</TD><TD WIDTH="5">

<?php if (isset($rowGetDList)) {
        if (($rowGetDList->UID == "$uid") or ((($_SESSION['isAdmin']) or ($_SESSION['user_level'] >= "4")) and ($rowGetDList->UID != "$uid"))) {
            ?><A HREF="<?php if (isset($rowGetDList)) {
                echo "$PHP_SELF?op=editClientReassign&clid=$rowGetDList->CLID&fname=$rowGetDList->NAME_FIRST&lname=$rowGetDList->NAME_LAST";
            }
            ?>"><?php }
    }
    ?><img border="0" hspace="0" vspace="2" width="16" height="16" src="../assets/images/client-reassign.gif" TITLE="Reassign Client" ALT="Reassign Client"><?php if (isset($rowGetDList)) {
        if (($rowGetDList->UID == "$uid") or ((($_SESSION['isAdmin']) or ($_SESSION['user_level'] >= "4")) and ($rowGetDList->UID != "$uid"))) {?></A><?php }
    }
    ?>

</TD><TD WIDTH="16">

<?php
if (isset($rowGetDList)) {
        if ($rowGetDList->STATUS_CLIENT == "2") {
            if ($_SESSION['user_level'] > "1") {?><a href="<?php echo "$PHP_SELF?op=client-active&clid=$rowGetDList->CLID&cluid=$rowGetDList->UID&return=hotlist"; ?>"><?php }?><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/client-inactive.jpg"><?php if ($_SESSION['user_level'] > "1") {?></a><?php }?><?php }
    }

    if (isset($rowGetDList)) {
        if ($rowGetDList->STATUS_CLIENT != "2") {
            if ($_SESSION['user_level'] > "1") {?><a href="<?php echo "$PHP_SELF?op=client-inactive&clid=$rowGetDList->CLID&cluid=$rowGetDList->UID&return=hotlist"; ?>"><?php }?><img border="0" hspace="2" vspace="0" width="16" height="16" src="../assets/images/client-active.jpg"><?php if ($_SESSION['user_level'] > "1") {?></a><?php }?>
<?php }
    }
    ?>

</FONT>
</TD>
</TR>
    	<?php
if ($rowColor == "#F5F5DC" or $rowColor == $_SESSION['pref_row_color']) {
        $rowColor = "#FFFFFF";
    } else {

        if ($_SESSION['pref_row_color']) {
            $rowColor = $_SESSION['pref_row_color'];
        } else {
            $rowColor = "#F5F5DC";
        }
    }
}?>


</TABLE>

</TD></TR></TABLE>
</TD></TR></TABLE>







<TABLE BORDER="1" BORDERCOLOR="#000000" CELLPADDING="10" BGCOLOR="#FFFFFF" WIDTH="90%"><TR><TD>
<SPAN style="font-size:12px;"><B>Showings History:</B></SPAN><BR>

<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="10" WIDTH="100%"><TR><TD><NOBR><FONT SIZE="-1"><B>SHOW DATE</B></FONT></NOBR></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>LISTING</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>OWNER</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>CLIENT</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>RATING</TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>COMMENTS</B></FONT></TD></TR>

<?php
$quStrShow = "SELECT * FROM `SHOWINGS` WHERE `CLI`=\"$grid\" AND `UID`=\"$uid\" ORDER BY SHOWING_DATE DESC";
$StrGetShow = mysqli_query($dbh, $quStrShow) or die(mysqli_error());

if ($_SESSION['pref_row_color']) {
    $rowColor = $_SESSION['pref_row_color'];
} else {
    $rowColor = "#F5F5DC";
}

while ($rowshow = mysqli_fetch_object($StrGetShow)) {
    ?>

<TR bgcolor="<?php echo $rowColor; ?>"><TD><NOBR>
<FONT SIZE="3"><A HREF="<?php echo "$PHP_SELF?op=editshowing&cid=$rowshow->CID&showid=$rowshow->SHOWID"; ?>" target="_SHOW<?php echo "$rowshow->SHOWID"; ?>"><?php echo $rowshow->SHOWING_DATE; ?></A></FONT>
</NOBR></TD>
<TD>&nbsp;</TD>
<TD>


<?php
$quStrclass = "SELECT STREET_NUM, STREET, APT FROM `CLASS` WHERE `CLI`=\"$grid\" AND `CID`=\"$rowshow->CID\"";
    $StrGetclass = mysqli_query($dbh, $quStrclass) or die(mysqli_error());

    while ($rowclass = mysqli_fetch_object($StrGetclass)) {
        ?>
<NOBR><FONT SIZE="3">
<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowshow->CID&return_page=sel&return_page_rid=$rowshow->CID&return_page_div=$k"; ?>" target="_show<?php echo $rowclass->CID; ?>"><?php echo $rowclass->STREET_NUM; ?> <?php echo $rowclass->STREET; ?> #<?php echo $rowclass->APT; ?></a>
</FONT></NOBR>
<?php }?>


</TD><TD>&nbsp;</TD>
<TD>
<?php
$quStrll = "SELECT SHORT_NAME FROM `LANDLORD` WHERE `GRID`=\"$grid\" AND `LID`=\"$rowshow->LID\"";
    $StrGetll = mysqli_query($dbh, $quStrll) or die(mysqli_error());

    while ($rowll = mysqli_fetch_object($StrGetll)) {
        ?>
<NOBR><FONT SIZE="3"><a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowll->LID"; ?>" TITLE="Edit/View <?php echo "$rowll->SHORT_NAME"; ?>'s Info" target="_sll<?php echo $rowll->LID; ?>"><?php echo $rowll->SHORT_NAME; ?></A></FONT></NOBR>
<?php }?>



</TD><TD>&nbsp;</TD><TD>
<?php
$quStrcl = "SELECT NAME_FIRST, NAME_LAST FROM `CLIENTS` WHERE `GRID`=\"$grid\" AND `CLID`=\"$rowshow->CLID\"";
    $StrGetcl = mysqli_query($dbh, $quStrcl) or die(mysqli_error());

    while ($rowcl = mysqli_fetch_object($StrGetcl)) {
        ?>
<NOBR>
<FONT SIZE="3">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowcl->CLID\" TITLE=\"Edit/View" . $rowcl->NAME_FIRST . $rowcl->NAME_LAST; ?>" TARGET="_Client<?php echo $rowcl->CLID; ?>"><?php echo $rowcl->NAME_FIRST . " " . $rowcl->NAME_LAST; ?></A>
</FONT>
</NOBR>
<?php }?>


</TD><TD>&nbsp;</TD><TD><CENTER>
<FONT SIZE="3"><?php echo $rowshow->RATING; ?></FONT>
</CENTER></TD><TD>&nbsp;</TD><TD><FONT SIZE="2">
<?php echo $rowshow->SHOWCOMMENT; ?></FONT>
</TD></TR>

    	<?php
if ($rowColor == "#F5F5DC" or $rowColor == $_SESSION['pref_row_color']) {
        $rowColor = "#FFFFFF";
    } else {

        if ($_SESSION['pref_row_color']) {
            $rowColor = $_SESSION['pref_row_color'];
        } else {
            $rowColor = "#F5F5DC";
        }
    }
}?>
</TABLE>


</TD></TR></TABLE>
<FONT SIZE="2"><BR></FONT>


</TD>

	<!-- <td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td> -->

</TR>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>

	<br>

<!--END agentreport -->