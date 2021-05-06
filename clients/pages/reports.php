<HEAD>
<SCRIPT LANGUAGE="JavaScript">

<!-- Begin
var navName = navigator.appName ;
var brVer = navigator.userAgent; var brNum; var reg = new RegExp('/');
function verNumIE() {
   var brVerId = brVer.indexOf('MSIE');
   brNum = brVer.substr(brVerId,8);
}
function verNumOt() {
   var brVerId = brVer.search(reg);
   brNum = brVer.substring(brVerId+1);
}
//  End -->
</script>

</HEAD>


<!--BEGIN reports -->
	<br>

<TABLE BGCOLOR="#FFFFFF" BORDER=0><TR>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/reports.jpg" HEIGHT="50" WIDTH="85">
</TD>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<h3><NOBR>REPORTS &amp; STATISTICS</NOBR></H3>
</TD>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/reports.jpg" HEIGHT="50" WIDTH="85">
</TD></TR></TABLE>



	<div align="center" class="menu">

<?php

// GLOBAL STATS

// Query the database and get the count
// total ads

$result = mysqli_query($dbh, "SELECT * FROM CLASS");
$num_rows = mysqli_num_rows($result);

// total active ads

$result_active = mysqli_query($dbh, "SELECT * FROM CLASS WHERE STATUS='ACT'");
$num_rows2 = mysqil_num_rows($result_active);

// total deactivated ads

$result_deactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE STATUS='STO'");
$num_rows3 = mysqil_num_rows($result_deactive);

// total residential rental ads

$result_rentals = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='1'");
$num_rows4 = mysqil_num_rows($result_rentals);

// Active rentals

$result_rentals_act = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='1' AND STATUS='ACT'");
$num_rows13 = mysqil_num_rows($result_rentals_act);

// total residential sales ads

$result_sales = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='2'");
$num_rows5 = mysqil_num_rows($result_sales);

// total active residential sales ads

$result_sales_act = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='2' AND STATUS='ACT'");
$num_rows14 = mysqil_num_rows($result_sales_act);

// total commercial rental ads

$result_commrent = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='4'");
$num_rows6 = mysqil_num_rows($result_commrent);

// total active commercial rental ads

$result_commrent_act = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='4' AND STATUS='ACT'");
$num_rows15 = mysqil_num_rows($result_commrent_act);

// total commercial sales ads

$result_commsale = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='3'");
$num_rows7 = mysqil_num_rows($result_commsale);

// total active commercial sales ads

$result_commsale_act = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='3' AND STATUS='ACT'");
$num_rows16 = mysqil_num_rows($result_commsale_act);

// total parking for rent ads

$result_parkrent = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='5'");
$num_rows8 = mysqil_num_rows($result_parkrent);

// total parking for sale ads

$result_parksale = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='6'");
$num_rows9 = mysqil_num_rows($result_parksale);

// total parking wanted ads

$result_parkwant = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='7'");
$num_rows10 = mysqil_num_rows($result_parkwant);

// total vacation ads

$result_vacation = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='8'");
$num_rows11 = mysqil_num_rows($result_vacation);

// total vacation ads

$result_renttoown = mysqli_query($dbh, "SELECT * FROM CLASS WHERE TYPE='9'");
$num_rows12 = mysqil_num_rows($result_renttoown);

// total ads with pictures

$result_pictures = mysqli_query($dbh, "SELECT * FROM CLASS WHERE PIC > '0'");
$num_rows17 = mysqil_num_rows($result_pictures);

// AGENCY STATS

// max ads

$result_maxads = "SELECT `MAXACT` FROM `GROUP` WHERE `GRID`='$grid'";
$result_maxadsp = mysqli_query($dbh, $result_maxads);

// total active

$result_agencyactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE STATUS='ACT' AND `CLI`='$grid'");
$num_rows70 = mysqil_num_rows($result_agencyactive);

// $result_adsbyagent = mysqli_query($dbh, "SELECT COUNT(*) FROM `CLASS` WHERE `CLI`='$grid' GROUP BY `UID`");
// $num_rows53 = mysqil_num_rows($result_adsbyagent) + 1;

// number of agents

$result_agentnum = mysqli_query($dbh, "SELECT * FROM `USERS` WHERE `GROUP` = '$grid'");
$num_rows52 = mysqil_num_rows($result_agentnum);

// number of agents with ads

$agentswithads = mysqli_query($dbh, "SELECT COUNT(*) FROM `CLASS` WHERE `CLI`='$grid' GROUP BY `UID`");
$num_rows53 = mysqil_num_rows($agentswithads);

$result_landlordnum = mysqli_query($dbh, "SELECT * FROM LANDLORD WHERE GRID=$grid");
$num_rows18 = mysqil_num_rows($result_landlordnum);

$result_adsnum = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid'");
$num_rows22 = mysqil_num_rows($result_adsnum);

// agency rentals

$result_arental = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND TYPE='1'");
$num_rows19 = mysqil_num_rows($result_arental);

$result_arental_active = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='ACT' AND TYPE=1");
$num_rows20 = mysqil_num_rows($result_arental_active);

$result_arental_deactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='STO' AND TYPE=1");
$num_rows21 = mysqil_num_rows($result_arental_deactive);

$result_arental_avail = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS_ACTIVE='1' AND TYPE=1");
$num_rows60 = mysqil_num_rows($result_arental_avail);

// agency sales

$result_asales = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND TYPE='2'");
$num_rows23 = mysqil_num_rows($result_asales);

$result_asales_active = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='ACT' AND TYPE=2");
$num_rows24 = mysqil_num_rows($result_asales_active);

$result_asales_deactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='STO' AND TYPE=2");
$num_rows25 = mysqil_num_rows($result_asales_deactive);

$result_asales_avail = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS_ACTIVE='1' AND TYPE=2");
$num_rows61 = mysqil_num_rows($result_asales_avail);

// agency commercial rentals

$result_acommr = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND TYPE='4'");
$num_rows26 = mysqil_num_rows($result_acommr);

$result_acommr_active = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='ACT' AND TYPE=4");
$num_rows27 = mysqil_num_rows($result_acommr_active);

$result_acommr_deactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='STO' AND TYPE=4");
$num_rows28 = mysqil_num_rows($result_acommr_deactive);

$result_acommr_avail = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS_ACTIVE='1' AND TYPE=4");
$num_rows62 = mysqil_num_rows($result_acommr_avail);

// agency commercial sales

$result_acomms = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND TYPE='3'");
$num_rows29 = mysqil_num_rows($result_acomms);

$result_acomms_active = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='ACT' AND TYPE=3");
$num_rows30 = mysqil_num_rows($result_acomms_active);

$result_acomms_deactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='STO' AND TYPE=3");
$num_rows31 = mysqil_num_rows($result_acomms_deactive);

$result_acomms_avail = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS_ACTIVE='1' AND TYPE=3");
$num_rows63 = mysqil_num_rows($result_acomms_avail);

// agency parking spaces

$result_aparkr = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND TYPE='5'");
$num_rows32 = mysqil_num_rows($result_aparkr);

$result_aparkr_active = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='ACT' AND TYPE=5");
$num_rows33 = mysqil_num_rows($result_aparkr_active);

$result_aparkr_deactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='STO' AND TYPE=5");
$num_rows34 = mysqil_num_rows($result_aparkr_deactive);

$result_aparkr_avail = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS_ACTIVE='1' AND TYPE=5");
$num_rows64 = mysqil_num_rows($result_aparkr_avail);

$result_aparks = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND TYPE='6'");
$num_rows35 = mysqil_num_rows($result_aparks);

$result_aparks_active = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='ACT' AND TYPE=6");
$num_rows36 = mysqil_num_rows($result_aparks_active);

$result_aparks_deactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='STO' AND TYPE=6");
$num_rows37 = mysqil_num_rows($result_aparks_deactive);

$result_aparks_avail = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS_ACTIVE='1' AND TYPE=6");
$num_rows65 = mysqil_num_rows($result_aparks_avail);

$result_aparkw = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND TYPE='7'");
$num_rows38 = mysqil_num_rows($result_aparkw);

$result_aparkw_active = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='ACT' AND TYPE=7");
$num_rows39 = mysqil_num_rows($result_aparkw_active);

$result_aparkw_deactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='STO' AND TYPE=7");
$num_rows40 = mysqil_num_rows($result_aparkw_deactive);

$result_aparkw_avail = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS_ACTIVE='1' AND TYPE=7");
$num_rows66 = mysqil_num_rows($result_aparkw_avail);

// agency vacation

$result_vacation = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND TYPE='8'");
$num_rows41 = mysqil_num_rows($result_vacation);

$result_vacation_active = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='ACT' AND TYPE=8");
$num_rows42 = mysqil_num_rows($result_vacation_active);

$result_vacation_deactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='STO' AND TYPE=8");
$num_rows43 = mysqil_num_rows($result_vacation_deactive);

$result_vacation_avail = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS_ACTIVE='1' AND TYPE=8");
$num_rows67 = mysqil_num_rows($result_vacation_avail);

// agency rent to own

$result_rto = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND TYPE='9'");
$num_rows44 = mysqil_num_rows($result_rto);

$result_rto_active = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='ACT' AND TYPE=9");
$num_rows45 = mysqil_num_rows($result_rto_active);

$result_rto_deactive = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS='STO' AND TYPE=9");
$num_rows46 = mysqil_num_rows($result_rto_deactive);

$result_rto_avail = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND STATUS_ACTIVE='1' AND TYPE=9");
$num_rows68 = mysqil_num_rows($result_rto_avail);

// agency ads with pictures

$result_apictures = mysqli_query($dbh, "SELECT * FROM CLASS WHERE PIC>'0' AND CLI='$grid'");
$num_rows47 = mysqil_num_rows($result_apictures);

$result_apicturesa = mysqli_query($dbh, "SELECT * FROM CLASS WHERE PIC>'0' AND CLI='$grid' AND STATUS='ACT'");
$num_rows48 = mysqil_num_rows($result_apicturesa);

$result_apicturesd = mysqli_query($dbh, "SELECT * FROM CLASS WHERE PIC>'0' AND CLI='$grid' AND STATUS='STO'");
$num_rows49 = mysqil_num_rows($result_apicturesd);

$result_apicturesavail = mysqli_query($dbh, "SELECT * FROM CLASS WHERE PIC>'0' AND CLI='$grid' AND STATUS_ACTIVE='1'");
$num_rows69 = mysqil_num_rows($result_apicturesavail);

// Agent information

// num of ads
$result_adsnumagent = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND UID='$uid'");
$num_rows51 = mysqil_num_rows($result_adsnumagent);

// number ads active

$result_adsnumagent = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND UID='$uid' AND STATUS='ACT'");
$num_rows71 = mysqil_num_rows($result_adsnumagent);

// agent ads available

$result_adsnumagent = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND UID='$uid' AND STATUS_ACTIVE='1'");
$num_rows72 = mysqil_num_rows($result_adsnumagent);

// agent ads deactivated

$result_adsnumagent = mysqli_query($dbh, "SELECT * FROM CLASS WHERE CLI='$grid' AND UID='$uid' AND STATUS='STO'");
$num_rows73 = mysqil_num_rows($result_adsnumagent);

// Display the results

?>


<TABLE WIDTH="70%" BGCOLOR="#FFFFFF" BORDER="1" BORDERCOLOR="#000000"><TR><TD><CENTER>


<TABLE><TR><TD><img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/act.gif'> Active
</TD><TD>
<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/inact.jpg'> Deactivated
</TD><TD>
<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/icons/avail.jpg'> Available
</TD></TR></TABLE>

<TABLE WIDTH="500"><TR><TD COLSPAN="2"><B><CENTER>STATISTICS FROM ALL AGENCIES</B></CENTER>
</TD></TD><TR><TD>

Total number of listings: 
</TD><TD ALIGN="RIGHT">
<? echo $num_rows;?><BR>
</TD></TR><TR><TD>

Total number of Active listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows2;?><BR>
</TD></TR><TR><TD>

Total number of Deactivated listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows3;?><BR>

</TD></TR><TR><TD>
Total number of Residential Rental listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows4;?><BR>

</TD></TR><TR><TD>
Total number of Active Residential Rental listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows13;?><BR>

</TD></TR><TR><TD>
Total number of Residential Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows5;?><BR>

</TD></TR><TR><TD>
Total number of Active Residential Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows14;?><BR>

</TD></TR><TR><TD>
Total number of Commercial Rental listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows6;?><BR>

</TD></TR><TR><TD>
Total number of Active Commercial Rental listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows15;?><BR>

</TD></TR><TR><TD>
Total number of Commercial Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows7;?><BR>

</TD></TR><TR><TD>
Total number of Active Commercial Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows16;?><BR>

</TD></TR><TR><TD>
Total number of Parking Spaces for Rent listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows8;?><BR>

</TD></TR><TR><TD>
Total number of Parking Spaces for Sale listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows9;?><BR>

</TD></TR><TR><TD>
Total number of Parking Spaces Wanted listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows10;?><BR>

</TD></TR><TR><TD>
Total number of Vacation Rental listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows11;?><BR>

</TD></TR><TR><TD>
Total number of Rent To Own listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows12;?><BR>

</TD></TR><TR><TD>
Total number of ads with pictures:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows17;?><BR>

</TD></TR></TABLE>
<P><BR>

<TABLE WIDTH="500"><TR><TD COLSPAN="2"><B><CENTER>AGENCY STATISTICS FOR: &nbsp; <?php echo $group;?></B></CENTER>
</TD></TD><TR><TD>

Total number of ads/listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows22;?><BR>
</TD></TR><TR><TD>
Maximum number or Activated Ads:
</TD><TD ALIGN="RIGHT">

<?
if ($result_maxadsp) {
    while ($array= mysqli_fetch_assoc($result_maxadsp)) {
        print "$array[MAXACT]";
    }

} else {

    print "<li>No results.</li>";
}
?>

</TD></TR><TR><TD>

Total Activated listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows70;?><BR>

</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Residential Rental listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows19;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Active Residential Rental listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows20;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Available Residential Rental listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows60;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Deactivated Residential Rental listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows21;?><BR>
</TD></TR><TR><TD>
Total Residential Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows23;?><BR>
</TD></TR><TR><TD>
Total Active Residential Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows24;?><BR>
</TD></TR><TR><TD>
Total Available Residential Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows61;?><BR>
</TD></TR><TR><TD>
Total Deactivated Residential Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows25;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Commercial Rental listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows26;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Active Commercial Rental listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows27;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Available Commercial Rental listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows62;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Deactivated Commercial Rental listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows28;?><BR>
</TD></TR><TR><TD>
Total Commercial Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows29;?><BR>
</TD></TR><TR><TD>
Total Active Commercial Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows30;?><BR>
</TD></TR><TR><TD>
Total Available Commercial Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows63;?><BR>
</TD></TR><TR><TD>
Total Deactivated Commercial Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows31;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Parking Rental listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows32;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Active Parking Rental listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows33;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Available Parking Rental listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows64;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Deactivated Parking Rental listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows34;?><BR>
</TD></TR><TR><TD>
Total Parking Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows35;?><BR>
</TD></TR><TR><TD>
Total Active Parking Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows36;?><BR>
</TD></TR><TR><TD>
Total Available Parking Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows65;?><BR>
</TD></TR><TR><TD>
Total Deactivated Parking Sales listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows37;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Parking Wanted listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows38;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Active Parking Wanted listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows39;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Available Parking Wanted listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows66;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Deactivated Parking Wanted listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows40;?><BR>
</TD></TR><TR><TD>
Total Vacation listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows41;?><BR>
</TD></TR><TR><TD>
Total Active Vacation listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows42;?><BR>
</TD></TR><TR><TD>
Total Available Vacation listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows67;?><BR>
</TD></TR><TR><TD>
Total Deactivated Vacation listings:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows43;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Rent To Own listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows44;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Active Rent To Own listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows45;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Available Rent To Own listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows68;?><BR>
</TD></TR><TR><TD BGCOLOR="#FFFF99">
Total Deactivated Rent To Own listings:
</TD><TD ALIGN="RIGHT" BGCOLOR="#FFFF99">
<? echo $num_rows46;?><BR>
</TD></TR><TR><TD>
Total listings with pictures:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows47;?><BR>
</TD></TR><TR><TD>
Total Active listings with pictures:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows48;?><BR>
</TD></TR><TR><TD>
Total Available listings with pictures:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows69;?><BR>
</TD></TR><TR><TD>
Total Deactivated listings with pictures:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows49;?><BR>
</TD></TR><TR><TD>
Total number of Landlords:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows18;?><BR>
</TD></TR><TR><TD>
Total number of Agents:
</TD><TD ALIGN="RIGHT">
<? echo $num_rows52;?><BR>
</TD></TR><TR><TD>
Number of Agents with Ads
</TD><TD ALIGN="RIGHT">
<? echo $num_rows53;?><BR>
</TD></TR></TABLE>

<P><BR>

<TABLE WIDTH="500"><TR><TD COLSPAN="2"><B><CENTER>AGENT STATISTICS FOR USERNAME: &nbsp; <?php echo $handle;?></B></CENTER>
</TD></TR><TR><TD>

Your Agent UID is: </TD><TD ALIGN="RIGHT"> <?php echo $uid;?><BR></TD></TR><TR><TD>

Your Agency CLI is: </TD><TD ALIGN="RIGHT"> <?php echo $grid;?><BR></TD></TR><TR><TD>

Total number of ads for username <?php echo $handle;?>: </TD><TD ALIGN="RIGHT">
<? echo $num_rows51;?><BR>

</TD></TR><TR><TD>
Total number of Active ads: </TD><TD ALIGN="RIGHT">
<? echo $num_rows71;?><BR>
</TD></TR><TR><TD>
Total number of Available ads: </TD><TD ALIGN="RIGHT">
<? echo $num_rows72;?><BR>

</TD></TR><TR><TD>
Total number of Deactivated ads: </TD><TD ALIGN="RIGHT">
<? echo $num_rows73;?><BR>

</TD></TR><TR><TD COLSPAN=2>

<SCRIPT LANGUAGE="JavaScript">

<!-- Begin
if (navigator.appName == 'Microsoft Internet Explorer') {
  verNumIE() ;
} else {
  verNumOt() ;
}
document.write("<CENTER><P><BR>");
document.write("<TABLE BORDER=2 WIDTH=500>");
document.write("<CAPTION Align=Top><b>BROWSER INFORMATION</b></CAPTION>");
document.write("<Tr>");
document.write("<td bgcolor=#FFFF99><b>IP Address: </b></td>");
document.write("<td><? echo $_SERVER['REMOTE_ADDR'];?> </td>");
document.write("</Tr>");
document.write("<Tr>");
document.write("<td bgcolor=#FFFF99><b>Browser Name: </b></td>");
document.write("<td>",navName,"</td>");
document.write("</Tr>");
document.write("<Tr>");
document.write("<td bgcolor=#FFFF99><b>Platform Name: </b></td>");
document.write("<td>",navigator.platform,"</td>");
document.write("</Tr>");
document.write("<Tr>");
document.write("<td BGCOLOR=#FFFF99><B>Code Name:</B></td><td>");
document.write(navigator.appCodeName,"</td></tr><TR>");
document.write("<td bgcolor=#FFFF99><b>Browser Version: </b></td>");
document.write("<td>",brNum,"</td>");
document.write("</Tr>");
document.write("<Tr>");
document.write("<td bgcolor=#FFFF99><b>Is Java enabled?: </b></td>");
if ( !(navigator.javaEnabled()) ) {
  java="No" ;
} else {
  java="Yes" ;
}
document.write("<td>",java,"</td>");
document.write("</Tr>");

document.write("<tr><td BGCOLOR=#FFFF99><B>Screen Resolution:</B></td><td>");
document.write(screen.width," x ",screen.height,"</td></tr>");

document.write("<tr><td BGCOLOR=#FFFF99><B>Number of Colors:</B></td><td>");
document.write(window.screen.colorDepth," bit color</td></tr>");

document.write("<tr><td BGCOLOR=#FFFF99><B>Pages viewed this session:</B></td><td>");
document.write(history.length,"</td></tr>");

document.write("</TABLE>");
document.write("</CENTER>");
//  End -->
</script>

</TD></TR></TABLE>

<?php
// Display browser type
echo "<p><B>Browser:</B> " . $_SERVER['HTTP_USER_AGENT'] . "</p>";
?> 

<!-- 
// $query = "SELECT COUNT(*) FROM `CLASS` WHERE `CLI`='$grid' GROUP BY `UID`";
 -->

<P><BR>

</div>
	<Br>
	<Br>

<CENTER>
</TD></TR></TABLE>

<!--END reports -->
