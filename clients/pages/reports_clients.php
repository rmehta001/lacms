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
<h3><NOBR>CLIENT REPORTS &amp; STATISTICS</NOBR></H3>
</TD>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/reports.jpg" HEIGHT="50" WIDTH="85">
</TD></TR></TABLE>



	<div align="center" class="menu">

<?php
$grid=$_SESSION["grid"];

// GLOBAL STATS

// Query the database and get the count
// total ads

$result = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid'");
$totalclients = mysqli_num_rows($result);

// total active clients

$result_active = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid'");
$total_active = mysqli_num_rows($result_active);


// total inactive clients

$result_active = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid'");
$total_inactive = mysqli_num_rows($result_active);

// number of agents with Clients

$agentswithclients = mysqli_query($dbh, "SELECT COUNT(*) FROM `CLIENTS` WHERE `GRID`='$grid' GROUP BY `UID`");
$num_rows_agentwithclients = mysqli_num_rows($agentswithclients);







// Display the results

?>


<TABLE WIDTH="70%" BGCOLOR="#FFFFFF" BORDER="1" BORDERCOLOR="#000000"><TR><TD><CENTER>


<TABLE><TR><TD><img border="0" hspace="2" vspace="0" width="16" height="16" src="../assets/images/client-active.jpg"> Active
</TD><TD>
<img border="0" hspace="2" vspace="0" width="16" height="16" src="../assets/images/client-inactive.jpg"> Inactive Clients 
</TD></TR></TABLE>

<TABLE WIDTH="500"><TR><TD COLSPAN="2"><B><CENTER>CLIENT BREAKDOWN</B></CENTER>
</TD></TD><TR><TD>

Total number of clients: 
</TD><TD ALIGN="RIGHT">
<?php echo $totalclients;?><BR>
</TD></TR><TR><TD>

Total number of Active clients:
</TD><TD ALIGN="RIGHT">
<?php echo $total_active;?><BR>
</TD></TR><TR><TD>

Total number of Inactive clients:
</TD><TD ALIGN="RIGHT">
<?php echo $total_inactive;?><BR>

</TD></TR><TR><TD>
# of Agents with Clients - <?php echo $num_rows_agentwithclients;?>
</TD></TR></TABLE>

<TABLE CELLPADDING=5 CELLSPACING=3><TR><TD>

<B>ACTIVE CLIENTS BY SOURCE:</B><BR>
<BR>

<?php					
$result_activeba = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='7'");
$total_activeba = mysqli_num_rows($result_activeba);
?>
BostonApartments.com - <?php echo $total_activeba."<BR>";?>

<?php					
$result_activepc = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='2'");
$total_activepc = mysqli_num_rows($result_activepc);
?>
Phone Call - <?php echo $total_activepc."<BR>";?>

<?php					
$result_activear = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='3'");
$total_activear = mysqli_num_rows($result_activear);
?>
Agent Referral - <?php echo $total_activear."<BR>";?>

<?php					
$result_activerc = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='4'");
$total_activerc = mysqli_num_rows($result_activerc);
?>
Referral - Client - <?php echo $total_activerc."<BR>";?>

<?php					
$result_activeri = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='16'");
$total_activeri = mysqli_num_rows($result_activeri);
?>
Referral - Inside - <?php echo $total_activeri."<BR>";?>

<?php					
$result_activewi = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='5'");
$total_activewi = mysqli_num_rows($result_activewi);
?>
Walk-in - <?php echo $total_activewi."<BR>";?>

<?php					
$result_activews = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='6'");
$total_activews = mysqli_num_rows($result_activews);
?>
Our Website - <?php echo $total_activews."<BR>";?>

<?php					
$result_activeca = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='1'");
$total_activeca = mysqli_num_rows($result_activeca);
?>
Classified Ads - <?php echo $total_activeca."<BR>";?>

<?php					
$result_activecl = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='8'");
$total_activecl = mysqli_num_rows($result_activecl);
?>
Craigslist - <?php echo $total_activecl."<BR>";?>

<?php					
$result_activeow = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='9'");
$total_activeow = mysqli_num_rows($result_activeow);
?>
Other Website - <?php echo $total_activeow."<BR>";?>

<?php					
$result_activeln = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='10'");
$total_activeln = mysqli_num_rows($result_activeln);
?>
Loopnet - <?php echo $total_activeln."<BR>";?>

<?php					
$result_activecos = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='11'");
$total_activecos = mysqli_num_rows($result_activecos);
?>
Costar - <?php echo $total_activeln."<BR>";?>

<?php					
$result_activemls = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='12'");
$total_activemls = mysqli_num_rows($result_activemls);
?>
MLS - <?php echo $total_activemls."<BR>";?>

<?php					
$result_activenw = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='13'");
$total_activenw = mysqli_num_rows($result_activenw);
?>
Network - <?php echo $total_activenw."<BR>";?>

<?php					
$result_activecc = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='14'");
$total_activecc = mysqli_num_rows($result_activecc);
?>
Constant Contact - <?php echo $total_activecc."<BR>";?>

<?php					
$result_activeic = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='15'");
$total_activeic = mysqli_num_rows($result_activeic);
?>
ICSC - <?php echo $total_activeic."<BR>";?>

<?php					
$result_actives = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='17'");
$total_actives = mysqli_num_rows($result_actives);
?>
Sign - <?php echo $total_actives."<BR>";?>

<?php					
$result_activeo = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='1' AND GRID='$grid' AND SOURCE='17'");
$total_activeo = mysqli_num_rows($result_activeo);
?>
Other - <?php echo $total_activeo."<BR>";?>

</TD><TD>

<B>INACTIVE CLIENTS BY SOURCE:</B><BR>
<BR>

<?php					
$result_activeba = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='7'");
$total_activeba = mysqli_num_rows($result_activeba);
?>
BostonApartments.com - <?php echo $total_activeba."<BR>";?>

<?php					
$result_activepc = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='2'");
$total_activepc = mysqli_num_rows($result_activepc);
?>
Phone Call - <?php echo $total_activepc."<BR>";?>

<?php					
$result_activear = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='3'");
$total_activear = mysqli_num_rows($result_activear);
?>
Agent Referral - <?php echo $total_activear."<BR>";?>

<?php					
$result_activerc = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='4'");
$total_activerc = mysqli_num_rows($result_activerc);
?>
Referral - Client - <?php echo $total_activerc."<BR>";?>

<?php					
$result_activeri = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='16'");
$total_activeri = mysqli_num_rows($result_activeri);
?>
Referral - Inside - <?php echo $total_activeri."<BR>";?>

<?php					
$result_activewi = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='5'");
$total_activewi = mysqli_num_rows($result_activewi);
?>
Walk-in - <?php echo $total_activewi."<BR>";?>

<?php					
$result_activews = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='6'");
$total_activews = mysqli_num_rows($result_activews);
?>
Our Website - <?php echo $total_activews."<BR>";?>

<?php					
$result_activeca = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='1'");
$total_activeca = mysqli_num_rows($result_activeca);
?>
Classified Ads - <?php echo $total_activeca."<BR>";?>

<?php					
$result_activecl = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='8'");
$total_activecl = mysqli_num_rows($result_activecl);
?>
Craigslist - <?php echo $total_activecl."<BR>";?>

<?php					
$result_activeow = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='9'");
$total_activeow = mysqli_num_rows($result_activeow);
?>
Other Website - <?php echo $total_activeow."<BR>";?>

<?php					
$result_activeln = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='10'");
$total_activeln = mysqli_num_rows($result_activeln);
?>
Loopnet - <?php echo $total_activeln."<BR>";?>

<?php					
$result_activecos = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='11'");
$total_activecos = mysqli_num_rows($result_activecos);
?>
Costar - <?php echo $total_activeln."<BR>";?>

<?php					
$result_activemls = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='12'");
$total_activemls = mysqli_num_rows($result_activemls);
?>
MLS - <?php echo $total_activemls."<BR>";?>

<?php					
$result_activenw = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='13'");
$total_activenw = mysqli_num_rows($result_activenw);
?>
Network - <?php echo $total_activenw."<BR>";?>

<?php					
$result_activecc = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='14'");
$total_activecc = mysqli_num_rows($result_activecc);
?>
Constant Contact - <?php echo $total_activecc."<BR>";?>

<?php					
$result_activeic = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='15'");
$total_activeic = mysqli_num_rows($result_activeic);
?>
ICSC - <?php echo $total_activeic."<BR>";?>

<?php					
$result_actives = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='17'");
$total_actives = mysqli_num_rows($result_actives);
?>
Sign - <?php echo $total_actives."<BR>";?>

<?php					
$result_activeo = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE STATUS_CLIENT='2' AND GRID='$grid' AND SOURCE='17'");
$total_activeo = mysqli_num_rows($result_activeo);
?>
Other - <?php echo $total_activeo."<BR>";?>



</TD><td>

<B>ALL CLIENTS BY SOURCE</B><BR>
<BR>
<?php					
$result_activeba = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='7'");
$total_activeba = mysqli_num_rows($result_activeba);
?>
BostonApartments.com - <?php echo $total_activeba."<BR>";?>

<?php					
$result_activepc = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='2'");
$total_activepc = mysqli_num_rows($result_activepc);
?>
Phone Call - <?php echo $total_activepc."<BR>";?>

<?php					
$result_activear = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='3'");
$total_activear = mysqli_num_rows($result_activear);
?>
Agent Referral - <?php echo $total_activear."<BR>";?>

<?php					
$result_activerc = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='4'");
$total_activerc = mysqli_num_rows($result_activerc);
?>
Referral - Client - <?php echo $total_activerc."<BR>";?>

<?php					
$result_activeri = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='16'");
$total_activeri = mysqli_num_rows($result_activeri);
?>
Referral - Inside - <?php echo $total_activeri."<BR>";?>

<?php					
$result_activewi = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='5'");
$total_activewi = mysqli_num_rows($result_activewi);
?>
Walk-in - <?php echo $total_activewi."<BR>";?>

<?php					
$result_activews = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='6'");
$total_activews = mysqli_num_rows($result_activews);
?>
Our Website - <?php echo $total_activews."<BR>";?>

<?php					
$result_activeca = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='1'");
$total_activeca = mysqli_num_rows($result_activeca);
?>
Classified Ads - <?php echo $total_activeca."<BR>";?>

<?php					
$result_activecl = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='8'");
$total_activecl = mysqli_num_rows($result_activecl);
?>
Craigslist - <?php echo $total_activecl."<BR>";?>

<?php					
$result_activeow = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='9'");
$total_activeow = mysqli_num_rows($result_activeow);
?>
Other Website - <?php echo $total_activeow."<BR>";?>

<?php					
$result_activeln = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='10'");
$total_activeln = mysqli_num_rows($result_activeln);
?>
Loopnet - <?php echo $total_activeln."<BR>";?>

<?php					
$result_activecos = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='11'");
$total_activecos = mysqli_num_rows($result_activecos);
?>
Costar - <?php echo $total_activeln."<BR>";?>

<?php					
$result_activemls = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='12'");
$total_activemls = mysqli_num_rows($result_activemls);
?>
MLS - <?php echo $total_activemls."<BR>";?>

<?php					
$result_activenw = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='13'");
$total_activenw = mysqli_num_rows($result_activenw);
?>
Network - <?php echo $total_activenw."<BR>";?>

<?php					
$result_activecc = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='14'");
$total_activecc = mysqli_num_rows($result_activecc);
?>
Constant Contact - <?php echo $total_activecc."<BR>";?>

<?php					
$result_activeic = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='15'");
$total_activeic = mysqli_num_rows($result_activeic);
?>
ICSC - <?php echo $total_activeic."<BR>";?>

<?php					
$result_actives = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='17'");
$total_actives = mysqli_num_rows($result_actives);
?>
Sign - <?php echo $total_actives."<BR>";?>

<?php					
$result_activeo = mysqli_query($dbh, "SELECT * FROM CLIENTS WHERE GRID='$grid' AND SOURCE='17'");
$total_activeo = mysqli_num_rows($result_activeo);
?>
Other - <?php echo $total_activeo."<BR>";?>


</TD><TR></TABLE>









</div>
	<Br>
	<Br>

<CENTER>
</TD></TR></TABLE>
<BR>
<!--END reports -->
