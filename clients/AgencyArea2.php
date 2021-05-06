

<?php
ini_set("display_errors", 0);

include "../inc/local_info.php";
include "../inc/global.php";

if (isset($_GET['debug'])) {
    error_reporting(E_ALL);
}

include "./app_core.php";
//Start of changes by barkha
$PHP_SELF = $_SERVER['PHP_SELF'];
$intellirent = $_SESSION["intellirent"];

// end of changes by barkha
if (($_SESSION["grid"] == "") or ($_SESSION['uid'] == "")) {

    printf("<script>location.href='<?php echo $PHP_SELF; ?>/logout.php</script>");
}
?>

<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">


		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="../assets/style.css">
        <link href="../assets/datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />

        <!-- Start:- Bootstrap CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="bootstrap/css/main.css" rel="stylesheet">
        <!-- End:- Bootstrap CSS -->
		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<title>BostonApartments.com</title>
		<!-- MAIN JAVASCRIPT LAYER -->
		<?php include "../assets/main.js";?>
        <script src="../js/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../assets/datepicker/js/datepicker.js"></script>
			<script>
				$( function() {
					$( "#sortable" ).sortable();
					$( "#sortable" ).disableSelection();
				} );
			</script>

		<!--END MAIN JAVASCRIPT LAYER -->

<!-- Source the JavaScript spellChecker object -->
<script type="textjavascript" src="/speller/spellChecker.js"></script>

<!-- Call a function like this to handle the spell check command -->
<script type="text/javascript">
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

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

        <!-- Call back function 2 -->
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
            }
        </script>
<script type="text/javascript"  src="https://www.BostonApartments.com/openwysiwyg/wysiwyg.js"></script>

</head>


<?php
$pref_pagetrim = $_SESSION["pref_pagebg"];

if ($pref_pagetrim == "") {
    $pagetrim_color = "#AFDCEC";
} else {
    $pagetrim_color = "$pref_pagetrim";
}?>


<?php
$pref_topbar = $_SESSION["pref_topbar"];
if ($pref_topbar == "") {
    $topbarcolor = "#FFFF99";
} else {
    $topbarcolor = "$pref_topbar";
}?>

<?php
$grid = $_SESSION["grid"];
$uid = $_SESSION["uid"];
$user_level = $_SESSION["user_level"];
?>
<!-- the body setting of this page -->
<body bgcolor="#afdcec" onload="clock()">
<!--header-start-->
<div class="header" id="navbar">
	<div class="container-fluid m-0">
		<div class="row">
		<div class="col-lg-2">
			<a href="AgencyArea2.php?op=home"><img class="img-brand" style="max-width: 100%;" src="../logo.png"/></a>
		</div>
		<div class="col-lg-2">

			<small class="text-info"><strong><?php echo $_SESSION["handle"] ?></strong> Logged in from <strong><?php echo $_SESSION["group"] ?></strong></small>
			<small>CLI# <?php echo $grid; ?> UID# <?php echo $uid; ?></small>
			<small>Level <?php echo $user_level; ?>  privs</small>
                        <div id="google_translate_element" ></div>

		</div>
		<div class="col-lg-2">
			<div id="worldclock" class="text-center">&nbsp;</div>
			<div>
				<hr class="m-2">
			<select name="city" onchange="updateclock(this);" size="1" class="form-control custom-select-sm">
				<option value="" selected="">Local time</option>
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
			</div>

		</div>
		<div class="col-lg-2">
		  <div><a title="Create A Reminder" href="<?php echo $PHP_SELF; ?>?op=createReminder" class="btn btn-link btn-sm"><i class="fa fa-clock"></i> Calendar</a></div>
			<form action="<?php echo $PHP_SELF; ?>?op=findit" method="post" class="navbar-form" role="search">
        <div class="input-group">
            <input name="findit" type="text" class="form-control" id="findit" placeholder="Search Everything">
            <div class="input-group-btn">
                <button class="btn btn-primary btn-lg ml-1" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
        </form>


		</div>
		<div class="col-lg-1">
		<form action=<?php echo $PHP_SELF ?> method="GET">
			<input name="op" type="hidden" value="adlEdit"><input name="return_page" type="hidden" value="home">
			<div class="row">
				<div class="col-lg-3 p-1 pt-2"><?php echo $_SESSION["handle"] ?>-</div>
				<div class="col-lg-9"><input name="cid" title="Enter the Listing # to View/Edit" type="text" class="form-control"></div>
			</div>
			<input name="SUBMIT" title="View/Edit Listing #" class="btn btn-primary btn-block btn-sm" type="SUBMIT" value="View/Edit Listing #">
			</form>
		</div>
		<div class="col-lg-2  text-left">
                    <a href="<?php echo $PHP_SELF; ?>?op=createLandlord"  class="btn btn-block btn-link btn-sm"><i class="fa fa-plus-circle"></i>New Landlord</a>
			<a href="<?php echo $PHP_SELF; ?>?op=createClient" class="btn btn-block btn-link btn-sm"><i class="fa fa-plus-circle"></i>New Client</a>
	    </div>
                     <div class="col-lg-1  text-left">
                         <a href="<?php echo $PHP_SELF; ?>?op=adlEdit&amp;return_page=home" class="btn btn-block btn-link btn-sm"><i class="fa fa-plus-circle"></i>New Listing</a>
                    </div>
		</div>
	</div>
</div>

<!-- Main Page	-->
<div id="main">
    <div id="content">
<div class="container-fluid">
<!--Top Box-->

<div class="row p-2" style="background-color:#75B9FF;" id = "toggleMenu">

	<div id="col-lg-11 m-1">
	<a data-toggle="tooltip" data-placement="top" title="Dashboard Stats &amp; Shortcuts to Favorite Clients, Listings &amp; System Updates" href="<?php echo $PHP_SELF; ?>?op=home" class="btn btn-link btn-sm"><i class="fa fa-home"></i> Hot List</a>

	<a title="Ad Administration" href="<?php echo $PHP_SELF; ?>?op=sel"  class="btn btn-link btn-sm"><i class="fa fa-project-diagram"></i> Ads</a>

	<a title="Full Listing &amp; Ad Database System" href="<?php echo $PHP_SELF; ?>?op=listings&amp;vid=10&amp;listing_filter_display=small&amp;availFilter=n&amp;filterChange=1" class="btn btn-link btn-sm"><i class="fa fa-list"></i> Listings</a>
	<a title="Owners, Landlords &amp; Sellers" href="<?php echo $PHP_SELF; ?>?op=manageLandlord" class="btn btn-link btn-sm"><i class="fa fa-landmark"></i> Landlords</a>
	<a title="Clients: Buyers &amp; Renters" href="<?php echo $PHP_SELF; ?>?op=manageClients" class="btn btn-link btn-sm"><i class="fa fa-user-alt"></i> Clients</a>
        <?php if ($intellirent == 1) {?> <A title = "Rental Applications" href="<?php echo "$PHP_SELF?op=intellirent-applications"; ?>" class="btn btn-link btn-sm" font-size= "10"><i class="fa fa-play"></i>Applications</A><?php }?>
	<a title="Contacts other than Clients &amp; Landlords" href="https://www.BostonApartments.com/contacts" target="_Contacts" class="btn btn-link btn-sm"><i class="fa fa-book-open"></i> Contacts</a>
	<a title="Manage Your Open House Listings &amp; Ads" href="<?php echo $PHP_SELF; ?>?op=openhouse" class="btn btn-link btn-sm"><i class="fa fa-building"></i> Open Houses</a>
	<a title="Email Everyone @ the Office" href="<?php echo $PHP_SELF; ?>?op=mail_all_agents" class="btn btn-link btn-sm"><i class="fa fa-mail-bulk"></i> Email Office</a>
	<a title="Mortgage Calculator | Real Estate Forms | Email Extractor | Newsletter Management | Email Reminder | SS# Check | Reports | Forums" href="<?php echo $PHP_SELF; ?>?op=tools" class="btn btn-link btn-sm"><i class="fa fa-cogs"></i> Tools</a>
	<a title="Password | Colors | Agent Preferences &amp; Settings" href="<?php echo $PHP_SELF; ?>?op=editPrefs" class="btn btn-link btn-sm"><i class="fa fa-magnet"></i> Preferences</a>
	<a title="Click for Help on Everything" href="<?php echo $PHP_SELF; ?>?op=help" class="btn btn-link btn-sm"><i class="fa fa-question"></i> Help</a>
	<a title="Manage Agents, Templates, Backups &amp; more" href="<?php echo $PHP_SELF; ?>?op=admin" class="btn btn-link btn-sm"><i class="fa fa-user-check"></i> Admin</a>
	<a title="logout" href="../logout.php" class="btn btn-link btn-sm float-right" style="float: right;"><i class="fa fa-lock"></i> Logout</a>
	</div>
	</div>

<?php if (isset($msg)) {
    $msg_icon = "msg.jpg";
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
		<td valign="top" colspan="1" width="32" height="32" bgcolor="#FFFF99" align="left" valign="center"><img border="0" hspace="0" vspace="0" width="32" height="32" src="../assets/images/<?php echo $msg_icon; ?>"></td>
		<td colspan="1" height="32" bgcolor="#FFFF99" align="left"><table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
			<td valign="top" colspan="1" width="1" height="32"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/yl_spacer.gif"></td>
			<td colspan="1" bgcolor="#FFFF99" align="left"><div class="menu"><strong><?php echo $msg; ?></strong></div></td>
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
<?php
if (!isset($page) or $page == "") {
    $page = "home";
}
?>
<?php include "./pages/$page.php";?>
<?php
print_r($page);
?>
<?php /*
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

<?php
if (!isset($page) or $page == "") {
$page = "home";
}

?>

<?php include ("./pages/$page.php"); ?>

<?php //Nelliwinne Temp
//echo $page; ?>
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

 */?>	</div>
	</div>
<!-- Start Bootstrap JS -->
		<script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/main.js"></script>
<!-- End Bootstrap JS -->
<script style="text/JavaScript">
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
if (hr < 0)
	hr+=24;
if (hr > 23) hr-=24;
ampm = (hr > 11)?"PM":"AM";
statusampm = ampm.toLowerCase();

hr2 = hr;
if (hr2 == 0) hr2=12;
(hr2 < 13)?hr2:hr2 %= 12;
if (hr2<10) hr2="0"+hr2

var finaltime=hr2+':'+((mins < 10)?"0"+mins:mins)+':'+((secs < 10)?"0"+secs:secs)+' '+statusampm;
// var d = new Date();
// console.log(d);
// console.log(getTimezoneOffsett);
var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
var year = now.getFullYear();

var month = monthNames[now.getMonth()];
var day = now.getDate();

// console.log(date);
finaltime = day + " " + month + "-" + year + " " + " " + finaltime;
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
</body>
</html>
