<?php
session_start();
include("../inc/global.php");
include("../inc/local_info.php");
if (isset($HTTP_GET_VARS['debug'])) {
	error_reporting(E_ALL);
}
include("./app_core.php");
?>
<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">

<STYLE>
<!--
//* STYLE BEGIN */

BODY
DIV 

.splashtext { font-family: Verdana; font-size: 10px}
.contenttext { font-family: Verdana; font-size: 10px }
.contenttext:first-letter { font-size:105%; }
.contentnav { font-family: Verdana; font-size: 9px; font-color: light-grey }
.menu { font-family: Verdana; font-size:12px; text-decoration: none  }
.controltext {font-family:monospace; font-size:20px; text-decoration: none }
.controltextimp {font-family:monospace; font-size:14px; text-decoration:underline }
.topic { font-family: Verdana; font-size:14px; text-decoration:none;   }
.ad { font-family: Verdana; font-size: 10px;}
.conArea {background-color:#FFFF99; border:1px solid #000000; border-bottom:0px solid black; padding:5;}
.conAreaBottom {background-color:#FFFF99; border:1px solid #000000; padding:5;}
.conRow {:first-line {font-family: Verdana; font-size: 14px; text-align:left; text-decoration: underline;} font-family: Verdana; font-size: 14px; text-decoration: none; background-color:#FFFF99}
.conCell { font-family: Verdana; font-size: 12px; text-decoration: none; background-color:#FFFF99;}
SPAN
.conCell2 { font-family: Verdana; font-size: 14px; text-decoration: none; background-color:#FFFF99;}
.conCell { font-family: Verdana; font-size: 12px; text-decoration: none; background-color:#FFFF99;}
.whiteTabFirst {padding:10px; text-align:left; font-weight:bold;cursor:hand;}
.whiteTab {padding:10px; text-align:left; font-weight:bold;border-left-width:1px;border-left-style:solid;border-left-color:black;cursor:hand;}
.yellowTab {padding:10px; text-align:left;font-weight:bold; border-left-width:1px;border-left-style:solid;border-left-color:black;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:black;background-color:#EEE8AA;cursor:hand;}
.yellowTabFirst {padding:10px; text-align:left;font-weight:bold;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:black;background-color:#EEE8AA;cursor:hand;}
A:link {text-decoration: none; color: black}
A:visited { text-decoration: none; color: black}
A:hover   {text-decoration: underline; color: grey}
TD
.controltext {font-family:monospace; font-size:12px; text-decoration: none }
.ad { font-family: Verdana; font-size: 10px}


.clientlocation {
width: 170;
height: 38px;
overflow: auto;
}


.descviewad {
width: 444px;
height: 190px;
overflow: auto;
}

.toplist {
width: 600px;
height: 170px;
overflow: auto;
}


.lastlogin {
width: 250px;
height: 150px;
overflow: auto;
}

.lastloginagent {
width: 150px;
height: 150px;
overflow: auto;
}

/***** Navigation *****/

<?php
if ($pref_topmenu=="") {
$topmenucolor="#75b9ff";
} else {
$topmenucolor="$pref_topmenu";
} ?>

#navigation
{
	background:<?php echo $topmenucolor;?>;
	color:#fff;
	height:15px;
	line-height:2em;
}

* html #navigation a {width:1%;}

#navigation .selected,#navigation a:hover
{
	background:#D2D1D9;
	color:#333;
	text-transform:uppercase;
	text-decoration:none;

}

#navigation2 .selected,#navigation a:hover
{
	background:#CCFFFF;
	color:#333;
	text-transform:uppercase;
	text-decoration:none;

}
/***** End Style *****/
-->
</STYLE>




		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php if ($title) { $title = " - " . $title; }; ?>
		<title>BostonApartments.com<?php echo $title;?></title>
		<!-- MAIN JAVASCRIPT LAYER -->
		<?php include ("../assets/main.js"); ?>

        <script type="text/javascript" src="../assets/datepicker/js/datepicker.js"></script>
        <link href="../assets/datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />



		<!--END MAIN JAVASCRIPT LAYER -->
     
<!-- Source the JavaScript spellChecker object -->
<script language="javascript" type="text/javascript" src="/speller/spellChecker.js">
</script>

<!-- Call a function like this to handle the spell check command -->
<script language="javascript" type="text/javascript">
function openSpellChecker() {
        // get the textarea we're going to check
        var txt = document.adlEditForm.simpleBODY;
        // give the spellChecker object a reference to our textarea
        // pass any number of text objects as arguments to the constructor:
        var speller = new spellChecker( txt );
        // kick it off
        speller.openChecker();
}
</script>

<script language="JavaScript" type="text/javascript" src="http://www.bostonapartments.com/openwysiwyg/wysiwyg.js"></script>



<!-- // <script language="JavaScript" type="text/javascript" src="http://www.bostonapartments.com/openwysiwyg/wysiwyg-settings.js"></script> // optional // -->



</head>


<?php
if ($pref_pagetrim=="") {
$pagetrim_color="#AFDCEC";
} else {
$pagetrim_color="$pref_pagetrim";
} ?>


<body topmargin="0" leftmargin="5" rightmargin="2" onLoad="clock()" BGCOLOR="<?php echo $pagetrim_color;?>">

<div align="center" style="position:relative;">
<?php 

// DON'T PRINT HEADER SWITCH //
if (!$dontPrintHeader) {
?>
<!--Top Box-->

<?php
if ($pref_topbar=="") {
$topbarcolor="#FFFF99";
} else {
$topbarcolor="$pref_topbar";
} ?>

<div id="toggleMenu" style="display: block">
<div style="margin:5px;font-size:10px;font-family:Verdana,Arial,Helvetica;width:99%;border:1px solid black;background-color:<?php echo $topbarcolor;?>;align:center;">

<table width="99%" BORDER="0" CELLPADDING="0" CELLSPACING="0" HEIGHT="51">
<tr>
<td width="242" align="left" valign="top"><a href="<?php echo "$PHP_SELF?op=hotlist";?>" TITLE="Dashboard Stats & Shortcuts to Favorite Clients, Listings & more"><img src="../assets/images/logo.gif" BORDER="0"></A></td>
<td style="font-size:9px;" align="left" valign="top"><NOBR><?php echo $handle;?> Logged in from</NOBR><br><?php echo $group;?><br>
<NOBR>CLI# <?php echo $grid;?> - UID# <?php echo $uid;?></NOBR><BR>
<NOBR>Level <?php echo $user_level;?> privs | <a href="../logout.php">Logout</a></NOBR>
</TD>

<td style="font-size:10px;" align="left" valign="top">

<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><td style="font-size:10px;" align="left" valign="top"><? echo date('l F jS, Y');?><BR></TD></TR><TR><td style="font-size:10px;" align="left" valign="top"><SCRIPT LANGUAGE="JavaScript">
<!-- Begin
var newwindow;
function popnewwindow(url)
{
	newwindow=window.open(url,'name','height=310,width=420');
	if (window.focus) {newwindow.focus()}
}
//  End -->
</script>
<!-- <a href="javascript:popnewwindow('../assets/popupcalender.htm');"> -->

<A HREF="<?php echo "$PHP_SELF?op=createReminder\" target=\"_creater\" TITLE=\"Create A Reminder\">";?><FONT SIZE="-3" COLOR="GREEN"><img border="0" hspace="0" vspace="0" width="12" height="12" src="../images/clock.gif" TITLE="Create A Reminder" ALT="Create A Reminder">Calendar</FONT></a>

</TD></TR><TR><td style="font-size:10px;" align="left" valign="top"><NOBR>

<span id="pendule" style="position:relative;"></span>


<form name="where">
<table border="0" width="165" cellspacing="0" cellpadding="0" VALIGN=TOP>

  <tr>
    <td align="left" valign="top"><NOBR>

<script language="JavaScript">
if (document.all||document.getElementById)
document.write('<span id="worldclock" style="font:bold 10px Arial;"></span>')

zone=0;
isitlocal=true;
ampm='';

function updateclock(z){
zone=z.options[z.selectedIndex].value;
isitlocal=(z.options[0].selected)?true:false;
}

function WorldClock(){
now=new Date();
ofst=now.getTimezoneOffset()/60;
secs=now.getSeconds();
sec=-1.57+Math.PI*secs/30;
mins=now.getMinutes();
min=-1.57+Math.PI*mins/30;
hr=(isitlocal)?now.getHours():(now.getHours() + parseInt(ofst)) + parseInt(zone);
hrs=-1.575+Math.PI*hr/6+Math.PI*parseInt(now.getMinutes())/360;
if (hr < 0) hr+=24;
if (hr > 23) hr-=24;
ampm = (hr > 11)?"PM":"AM";
statusampm = ampm.toLowerCase();

hr2 = hr;
if (hr2 == 0) hr2=12;
(hr2 < 13)?hr2:hr2 %= 12;
if (hr2<10) hr2="0"+hr2

var finaltime=hr2+':'+((mins < 10)?"0"+mins:mins)+':'+((secs < 10)?"0"+secs:secs)+' '+statusampm;

if (document.all)
worldclock.innerHTML=finaltime
else if (document.getElementById)
document.getElementById("worldclock").innerHTML=finaltime
else if (document.layers){
document.worldclockns.document.worldclockns2.document.write(finaltime)
document.worldclockns.document.worldclockns2.document.close()
}


setTimeout('WorldClock()',1000);
}

window.onload=WorldClock
//-->
</script>
&nbsp;</nobr>
<!--Place holder for NS4 only-->
<!--
<ilayer id="worldclockns" width=100% height=35><layer id="worldclockns2" width=100% height=35 left=0 top=0 style="font:bold 10px Arial;"></layer></ilayer> -->

</NOBR></td><TD style="font-size:10px;" align="left" valign="top">

<select name="city" size="1" onchange="updateclock(this);" style="font-size:10px;font-family:Verdana,Arial,Helvetica;height:19"> 
<option value="" selected>Local time</option>
<option value="-8">Alaska</option>
<option value="-5">Chicago</option>
<option value="-6">Denver</option>
<option value="-4">Detroit</option>
<option value="-10">Hawaii</option>
<option value="-5">New York</option>
<option value="-7">Pheonix</option>
<option value="-8">San Francisco</option>
<option value="7">Bangkok</option>
<option value="-3">Buenos Aires</option>
<option value="12">Fiji</option>
<option value="8">Hong Kong</option>
<option value="1">London GMT</option>
<option value="2">Rome</option>
<option value="2">Stockholm</option>
<option value="10">Sydney</option>
<option value="9">Tokyo</option> 
</select>
  </tr>
</table>


</TD></TR></TABLE>
</form>




</TD>
<td valign="top" style="font-size:10px;"><CENTER>

<form action="<?php echo "$PHP_SELF?op=findit";?>" method="POST"><font size=-3>

<INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE="Quick Search" style="font-size:10px;font-family:Verdana,Arial,Helvetica;height:22;width:125" TITLE="Search Clients, Landlords, Listings and more"><br><input type="text" name="findit" size="12" TITLE="Enter the term or partial phrase to search clients, landlords, listings and more"></form>

</CENTER>
</td>




</TD>
<td valign="top" style="font-size:10px;"><CENTER>

<form action="<?php echo "$PHP_SELF";?>" method="GET"><font size=-3>

<INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE="View/Edit Listing #" style="font-size:10px;font-family:Verdana,Arial,Helvetica;height:22;width:115" TITLE="View/Edit Listing #"><br><input type="hidden" name="op" value="adlEdit"><input type="hidden" name="return_page" value="<?php echo $page; ?>"><?php echo $abv;?>-<input type="text" name="cid" size="8" TITLE="Enter the Listing # to View/Edit"></form>
</CENTER>
</td>

<td align="right" valign="top" width="98">
<?php if ($user_level>0) {?>
<a href="<?php echo "$PHP_SELF?op=adlEdit&return_page=$page";?>"><img border="0" src="../assets/images/compose.gif" TITLE="Click to Create a new listing"></a>
<?php }?>

</td>
</tr>
</table>

<div align="left" style="padding:5px;width:99%;height:17px;background-color:<?php echo $topmenucolor;?>;"><div id="navigation">
<NOBR><a href="<?php echo "$PHP_SELF?op=home";?>" TITLE="Welcome Page with System Updates">&nbsp;Home&nbsp;</a>|<a href="<?php echo "$PHP_SELF?op=sel";?>" TITLE="Ad Administration">&nbsp;Ads&nbsp;</a>|<a href="<?php echo "$PHP_SELF?op=listings&vid=$listview&listing_filter_display=$listsearch&availFilter=$listactive&filterChange=1";?>" TITLE="Full Listing & Ad Database System">&nbsp;Listings&nbsp;</a>|<?php if ($user_level>"0.5") {?><a href="<?php echo "$PHP_SELF?op=manageLandlord";?>" TITLE="Owners, Landlords & Sellers">&nbsp;Landlords&nbsp;</a>|<?php }?><a href="<?php echo "$PHP_SELF?op=manageClients";?><?php if ($pref_all_clients==1) {?>&clients_filter=1&clients_filter_name_first=&clients_filter_name_last=&clients_filter_price_min=&clients_filter_price_max=&clients_filter_type=0&clients_filter_phone=&clients_filter_email=&clients_filter_status_client=1<?php } ?>" TITLE="Clients: Buyers & Renters">&nbsp;Clients&nbsp;</a>|<a href="http://www.bostonapartments.com/contacts" target="_Contacts" TITLE="Contacts other than Clients & Landlords">&nbsp;Contacts&nbsp;</a>|<a href="<?php echo "$PHP_SELF?op=hotlist";?>" TITLE="Dashboard Stats & Shortcuts to Favorite Clients, Listings & more">&nbsp;Hot List&nbsp;</a>|<a href="<?php echo "$PHP_SELF?op=openhouse";?>" TITLE="Manage Your Open House Listings & Ads">&nbsp;Open Houses&nbsp;</a>|<a href="<?php echo "$PHP_SELF?op=cobroke-menu";?>" TITLE="Landlord Listings & Co-Brokes from Other Agencies | Manage Co-Broke Settings">&nbsp;Co-Brokes&nbsp;</a>|<a href="<?php echo "$PHP_SELF?op=mail_all_agents";?>" TITLE="Email Everyone @ the Office">&nbsp;Email Office&nbsp;</a>|<a href="<?php echo "$PHP_SELF?op=tools";?>" TITLE="Mortgage Calculator | Real Estate Forms | Email Extractor | Newsletter Management | Email Reminder | SS# Check | Reports | Chat | Forums">&nbsp;Tools&nbsp;</A>|<a href="<?php echo "$PHP_SELF?op=editPrefs";?>" TITLE="Password | Colors | Agent Preferences & Settings">&nbsp;Preferences&nbsp;</a>|<a href="<?php echo "$PHP_SELF?op=help";?>" TITLE="Click for Help on Everything">&nbsp;Help&nbsp;</a><?php if ($isAdmin) {?>|<a href="<?php echo "$PHP_SELF?op=admin";?>" TITLE="Manage Agents, Templates, Backups & more">&nbsp;Admin&nbsp;</a><?php }?>|<a href="../logout.php">&nbsp;Logout&nbsp;</a></NOBR></DIV></div>
</div>
<CENTER>
<!--End Top box-->
<?php 
} //End dontPrintHeader block //
?>
</div>

<?php if ($msg) {
	$msg_icon = ($msg_err) ? "msgerr.jpg" : "msg.jpg";
?>
<!--Message box -->
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="96%">
<tr>
	<td valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="../assets/images/blk_spacer.gif"></td>
</tr>
<tr>
	<td valign="top" width="99%"><table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
		<td valign="top" colspan="1" width="1" height="32" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif" bgcolor="#000000"></td>
		<td valign="top" colspan="1" width="32" height="32" bgcolor="#FFFF99" align="left" valign="center"><img border="0" hspace="0" vspace="0" width="32" height="32" src="../assets/images/<?php echo $msg_icon;?>"></td>
		<td colspan="1" height="32" bgcolor="#FFFF99" align="left"><table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
			<td valign="top" colspan="1" width="1" height="32"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/yl_spacer.gif"></td>
			<td colspan="1" bgcolor="#FFFF99" align="left"><div class="menu"><strong><?php echo $msg;?></strong></div></td>
			<td valign="top" colspan="1" width="1" height="32"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/yl_spacer.gif"></td>
			</tr>
			</table></td>
		<td valign="top" colspan="1" width="1" height="32" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		</table></td>
</tr>
<tr>
	<td valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="../assets/images/blk_spacer.gif"></td>
</tr>
</table></DIV>

<!--End Message Box -->
<?php }?>

</DIV>


<div align="CENTER" style="margin:5px;font-size:10px;font-family:Verdana,Arial,Helvetica;width:99%;">

<table border="0" cellspacing="0" cellpadding="0" width="100%">

<tr>
<td align="center" valign="top" width="100%">
<!--Content -->

<table border="0" cellspacing="0" cellpadding="0" width="99%">
<tr>
	<td valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
</tr>
<tr>
	<td valign="top" width="100%"><CENTER>

		<table border="0" cellspacing="0" cellpadding="0" height="100%" width="100%">
			<tr>
			<td valign="top" width="1" height="10" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="../assets/images/blk_spacer.gif"></td>
			<td valign="top" align="center" height="10" bgcolor="#EEEEEE">

<!-- //BEGIN PHP CONTENT // -->


<?php include ("./pages/$page.php"); ?>					


<!-- //END PHP CONTENT//-->	

			</td>
			<td valign="top" width="1" height="10" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="../assets/images/blk_spacer.gif"></td>
			</tr>
			</table>
	</CENTER></td>
</tr>
<tr>
	<td valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="../assets/images/blk_spacer.gif"></td>
</tr>
</table>
</div>
<!--End Content -->
</td>

</tr>
</table>
</div>
</body>
</html>