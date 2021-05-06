<?php
session_start();
include("../inc/global.php");
include("../inc/local_info.php");
if (isset($HTTP_GET_VARS['debug'])) {
	error_reporting(E_ALL);
}
include("./app_core.php");

if (($grid =="") or ($uid=="")){
printf("<script>location.href='$PHP_SELF/logout.php</script>");
}

?>
<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">



        <link href="../assets/datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />


	<style>
/*

Author: Matt Wisniewski
http://tinderlight.us

*/

.btn{text-shadow:0 0 13px rgba(0,0,0,.3);border:1px solid #bfbfbf;border-radius:5px;box-shadow:0 4px 0 #a5a5a5,0 5px 0 #565656,0 5px 10px rgba(0,0,0,.4);background-color:#f2f2f2}

.btn-success{border:1px solid #189600;background-color:#5CB85C;color:#fff;border-radius:5px;box-shadow:0 4px 0 #007c2d,0 5px 0 #00520c,0 5px 10px rgba(0,0,0,.4)}

.btn-danger{border:1px solid #970000;color:#fff;background-color:#b85c5c;border-radius:5px;box-shadow:0 4px 0 #7e0000,0 5px 0 #520000,0 5px 10px rgba(0,0,0,.4)}

.btn-warning{border:1px solid #977400;color:#000;background-color:#ffab00;border-radius:5px;box-shadow:0 4px 0 #7e4500,0 5px 0 #523c00,0 5px 10px rgba(0,0,0,.4)}

.btn-info{border:1px solid #006297;color:#fff;background-color:#00a3ff;border-radius:4px;box-shadow:0 4px 0 #00587e,0 5px 0 #000f52,0 5px 10px rgba(0,0,0,.4)}

.threed{border:1px solid #bfbfbf;border-radius:5px;box-shadow:0 2px 0 #a5a5a5,0 2px 0 #565656,0 2px 5px rgba(0,0,0,.4)}

.pressable{position:relative}.pressable:focus{margin-top:2px;top:2px;outline:0;box-shadow:0 2px 0 #a5a5a5,0 2px 0 #565656,0 2px 5px rgba(0,0,0,.4)}input{padding:1em}

.input:focus{margin-top:2px;top:2px;outline:0;box-shadow:0 2px 0 #a5a5a5,0 2px 0 #565656,0 2px 5px rgba(0,0,0,.4)}

.textd{text-shadow:1px 1px 0 #000}.textd-inverse{text-shadow:1px 1px 0 #666}

.btn{padding:.5em 1em;position:relative}
</style>

<style>
p.small {
    text-align: left;
font-size: 0.575em;
font-weight: normal;
} 
</style>
<style>
.table-hover tbody tr:hover td {
    background: #428bca;
}
</style>


		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php if ($title) { $title = " - " . $title; }; ?>
		<title>BostonApartments.com<?php echo $title;?></title>
		<!-- MAIN JAVASCRIPT LAYER -->
		<?php include ("../assets/main3.js"); ?>
		
		<script type="text/javascript" src="../assets/datepicker/js/datepicker.js"></script>
		
		<script src="jquery-1.12.4.js"></script>
		<script src="jquery-ui.js"></script>
			<script>
				$( function() {
					$( "#sortable" ).sortable();
					$( "#sortable" ).disableSelection();
				} );
			</script>

		<!--END MAIN JAVASCRIPT LAYER -->
     
<!-- Source the JavaScript spellChecker object -->
<script language="javascript" type="text/javascript" src="/speller/spellChecker.js"></script>

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

<script language="JavaScript" type="text/javascript" src="https://www.BostonApartments.com/openwysiwyg/wysiwyg.js"></script>




<!-- // <script language="JavaScript" type="text/javascript" src="https://www.BostonApartments.com/openwysiwyg/wysiwyg-settings.js"></script> // optional // -->

<!-- Bootstrap -->
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- new -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- end new -->	
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		
  <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- new -->    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<!-- end -->

	<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


  <!-- end bootstrap -->
 
</head>


<?php
if ($pref_pagetrim=="") {
$pagetrim_color="#AFDCEC";
} else {
$pagetrim_color="$pref_pagetrim";
} ?>


<body topmargin="0" leftmargin="5" rightmargin="2" onLoad="clock()" BGCOLOR="<?php echo $pagetrim_color;?>">

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

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>             
      </button>
      <a href="<?php echo "$PHP_SELF?op=hotlist";?>" TITLE="Dashboard Stats & Shortcuts to Favorite Clients, Listings & more"><img src="../logo-sm.png" BORDER="0" HEIGHT="40" VSPACE="3"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">

	  <li><a href="<?php echo "$PHP_SELF?op=sel";?>" TITLE="Ad Administration">&nbsp;Ads&nbsp;</a></li>
	   <li>
          <a href="<?php echo "$PHP_SELF?op=listings&vid=$listview&listing_filter_display=$listsearch&availFilter=$listactive&filterChange=1";?>" TITLE="Full Listing & Ad Database System">Listings</a></li> 
 
 <li> <a class="dropdown-toggle" data-toggle="dropdown" href="https://www.BostonApartments.com/contacts" target="_Contacts" TITLE="Contacts other than Clients & Landlords">Contacts <span class="caret"></span></a>
          <ul class="dropdown-menu">
     <li><?php if ($user_level>="0.25") {?><a href="<?php echo "$PHP_SELF?op=manageLandlord";?>" TITLE="Owners, Landlords & Sellers">Landlords</a></li>
	 <li><?php }?><a href="<?php echo "$PHP_SELF?op=manageClients";?><?php if ($pref_all_clients==1) {?>&clients_filter=1&clients_filter_name_first=&clients_filter_name_last=&clients_filter_price_min=&clients_filter_price_max=&clients_filter_type=0&clients_filter_phone=&clients_filter_email=&clients_filter_status_client=1<?php } ?>" TITLE="Clients: Buyers & Renters">Clients</a></li>
<li><a href="<?php echo "$PHP_SELF?op=mail_all_agents";?>" TITLE="Email Everyone @ the Office">Email Office</a></li>
<li><a href="https://www.BostonApartments.com/contacts" target="_Contacts" TITLE="Contacts other than Clients & Landlords">Contact Manager</a></li>	 </ul></li>

	   <li>
          <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo "$PHP_SELF?op=tools";?>" TITLE="Mortgage Calculator | Real Estate Forms | Email Extractor | Newsletter Management | Email Reminder | SS# Check | Reports | Forums">Tools <span class="caret"></span></a>
          <ul class="dropdown-menu">
<li> <A HREF="<?php echo "$PHP_SELF?op=createReminder\" target=\"_creater\" TITLE=\"Create A Reminder\">";?><img border="0" hspace="0" vspace="0" width="16" height="16" src="../images/clock.gif" TITLE="Create A Reminder" ALT="Create A Reminder"> Calendar</a></li>
<li><a href="<?php echo "$PHP_SELF?op=forms";?>">Real Estate Forms</a> </li>
<li> <a href="http://www.masslandrecords.com/">Massachusetts Land Records</a></li>
<li><a href="<?php echo "$PHP_SELF?op=newsletters";?>">Newsletters</a> </li> 
<li><a href="https://www.bostonapartments.com/reminders/">Email Reminders</a></li>
<li><a href="<?php echo "$PHP_SELF?op=email-extractor";?>">Email Extractor</a> </li>
<li><a href="https://www.bostonapartments.com/calculator-mortgage.php" target="_NEW">Mortgage Calculator</a></li>
<li><a href="https://www.bostonapartments.com/lacms/clients/pages/ssn_verify_form.php">Social Security # Checker</a></li>
<li><a href="http://www.criminalpages.com/" target="_NEW">Criminal History Check</a></li>
<li><a href="<?php echo "$PHP_SELF?op=reports";?>">Reports & Statistics</a></li>
<li><a href="<?php echo "$PHP_SELF?op=tools";?>" TITLE="Mortgage Calculator | Real Estate Forms | Email Extractor | Newsletter Management | Email Reminder | SS# Check | Reports | Forums">All Tools</a></li>
</ul></li>

<li><a href="<?php echo "$PHP_SELF?op=help";?>" TITLE="Click for Help on Everything">&nbsp;Help&nbsp;</a></li>
<li><?php if (($isAdmin) OR ($user_level >= "10")) {?>
<a href="<?php echo "$PHP_SELF?op=admin";?>" TITLE="Manage Agents, Templates, Backups & more">Admin</a><?php }?></li>		  
 </ul>
 </li>
     
           
		<form class="navbar-form navbar-left" action="<?php echo "$PHP_SELF?op=findit";?>" method="POST">
       <div class="form-group">
    <input type="text" class="form-control" style="width:160px;max-width:160px;display:inline-block" placeholder="Global Quick Search" name="findit" TITLE="Enter the term or partial phrase to search clients, landlords, listings and more">      <button class="btn btn-default btn-sm" type="submit" name="submit" value="Quick Search" title="Search Clients, Landlords, Listings and more" style="margin-left:-7px;margin-top:-4px;min-height:30px;">
        <i class="glyphicon glyphicon-search"></i>
      </button>
	</div>
</form>
	  
<form class="navbar-form navbar-left" action="<?php echo "$PHP_SELF";?>" method="GET">
<input type="hidden" name="op" value="adlEdit"><input type="hidden" name="return_page" value="<?php echo $page; ?>">      
		<div class="form-group">
   <input type="text" class="form-control" placeholder="View/Edit Listing #" name="View/Edit Listing #" TITLE="View/Edit Listing #" style="width:160px;max-width:160px;display:inline-block">	<button class="btn btn-default btn-sm" type="submit" name="submit" value="View/Edit Listing" title="View/Edit Listing #" style="margin-left:-7px;margin-top:-4px;min-height:30px;"><span class="glyphicon glyphicon-search"></span></button>
</div>
</form>


   <div class="btn-group">
        <button type="button" data-toggle="dropdown" class="btn btn-warning dropdown-toggle" style="margin-top:8px;"><span class="glyphicon glyphicon-pencil" style="color:yellow;height:16px"></span> Create NEW <span class="caret"></span></button>
        <ul class="dropdown-menu">

	<li> <?php if ($user_level>"0") {?>
<a href="<?php echo "$PHP_SELF?op=adlEdit&return_page=$page";?>" title="Click to create a new Landlord"><span class="glyphicon glyphicon-pencil"></span> New Listing</a><?php }?></li>
<li class="divider"></li>
   <li> <?php if ($user_level>"0") {?><a href="<?php echo "$PHP_SELF?op=createLandlord";?>" title="Click to create a new Landlord"><span class="glyphicon glyphicon-pencil"></span> New Landlord</a></li>
<li class="divider"></li>
	<li> <a href="<?php echo "$PHP_SELF?op=createClient";?>" title="Click to create a new Client"><span class="glyphicon glyphicon-pencil"></span> New Client</a> <?php } ?></li>
<li class="divider"></li>
            <li> <a href="<?php echo "$PHP_SELF?op=openhouse";?>" TITLE="Manage Your Open House Listings & Ads"><span class="glyphicon glyphicon-pencil"></span> Open House</a></li>
			</ul>
    </div>
	
	&nbsp;
   <div class="btn-group">
        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"  style="margin-top:8px;"><span class="glyphicon glyphicon-user"></span> <?php echo $handle;?>
    <span class="caret"></span></button>
        <ul class="dropdown-menu">
	<li class="dropdown-header">Account Details</li>
	<li> &nbsp;  &nbsp; <i class="fa fa-users" style="font-size:16px"></i> <?php echo $group;?></li>
	<li>  &nbsp;  &nbsp; <i class="fa fa-hashtag" style="font-size:16px"></i> CLI: <?php echo $grid;?></li>
	<li>  &nbsp;  &nbsp; <span class="glyphicon glyphicon-user"></span> User ID: <?php echo $uid;?></li>
<li>  &nbsp;  &nbsp; <i class="fa fa-key"></i> Level <?php echo $user_level;?> privileges</li>
<li class="divider"></li>
	<li class="dropdown-header">Settings</li>
<li> <a href="<?php echo "$PHP_SELF?op=editPrefs";?>" TITLE="Agent Preferences & Settings"><i class="fa fa-gear fa-spin" style="font-size:16px"></i> Agent Preferences</a></li>
<li> <a href="<?php echo "$PHP_SELF?op=changePassword";?>"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
<li class="divider"></li>      
<li> <a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    
	</div>
    </div>
    </nav>


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

<div class="alert alert-dismissible alert-success">
  <button class="close" type="button" data-dismiss="alert">&times;</button>
  <strong>Well done!</strong> You successfully read <a class="alert-link" href="#">this important alert message</a>.
</div>

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


<!-- //BEGIN PHP CONTENT // -->


<?php include ("./pages/$page.php"); ?>					


<!-- //END PHP CONTENT//-->	

</div>
<!--End Content -->
</td>

</tr>
</table>
</div>

</body>
</html>
