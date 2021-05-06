<?php

/*///////////////////////////////////////////////////////////////////////////
 //bstapts logout routine 1.0.  copyright 2009 BostonApartments.com         //
 //////////////////////////////////////////////////////////////////////////*/
session_start();
include("./inc/global.php");
include("./inc/local_info.php");
date_default_timezone_set("America/New_York");
// update timeout
$now = date ("YmdHis");
$sid = session_id();
$quStrLogOut = "UPDATE SESSIONS SET TIMEOUT=$now WHERE SID='$sid'";
$quLogOut = $dbh-> query($quStrLogOut)or die ("can't log out");
$name=$_SESSION ["handle"];


// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
   setcookie(session_name(), '', time() - 42000,
       $params["path"], $params["domain"],
       $params["secure"], $params["httponly"]
   );
   }

// Finally, destroy the session.
unset($_SESSION);
session_destroy();
session_start();
session_regenerate_id(true);
session_destroy();


?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./assets/style.css">

		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php if (isset($title)) { $title = " - " . $title; }; ?>
		<title>BostonApartments.com</title>
		
                
</head>

<body topmargin="10" leftmargin="10" >

<div align="center" style="position:relative;">

<!--Top Box-->
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="./assets/images/blk_spacer.gif"></td>
			
</tr>
<tr>
<td valign="top" width="100%"><table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
		<td valign="top" colspan="1" width="1" height="80"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="./assets/images/blk_spacer.gif"></td>
		<td valign="top" colspan="1" width="242" height="80" bgcolor="#FFFF99" align="left"><img border="0" hspace="0" vspace="0" width="242" height="51" src="./assets/images/logo.gif"></td>
		<td valign="top" colspan="1" bgcolor="#FFFF99" align="left"><table border="0" cellspacing="0" cellpadding="0" width="100%">
										<tr>
		<td align="left"><img border="0" hspace="0" vspace="0" width="100%" height="10" src="./assets/images/yl_spacer.gif"></td></td>
			</tr>
			<tr>
		<td align="left"><div class="menu"> logged out</td>
				</tr>
				</table></td>
		<td valign="top" colspan="1" width="300" bgcolor="#FFFF99" align="right"><table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
			<td align="right"><img border="0" hspace="0" vspace="0" width="98" height="81" src="./assets/images/yl_spacer.gif"></td>
											<td><img border="0" hspace="0" vspace="0" width="4"  src="./assets/images/yl_spacer.jpg"></td>
						</tr>
						</table></td>
		<td valign="top" colspan="1" width="1" height="80"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="./assets/images/blk_spacer.gif"></td>
		</tr>
		</table></td>
</tr>


<tr>
<td valign="top" width="100%"><table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
		<td valign="top" colspan="10" width="100%" height="1"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="./assets/images/blk_spacer.gif"></td>
		</tr>
		</table></td>
</tr>
</table>
<W>
</div>
<!--End Top box-->



<?php 
	$msg_icon = "msg.jpg";
?>
<!--Message box --><CENTER>
<table border="0" cellspacing="0" cellpadding="0" width="100%" BORDER=1 BORDERCOLOR="#000000">
<tr>
	<td valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="./assets/images/blk_spacer.gif"></td>
</tr>
<tr>
	<td valign="top" width="100%"><table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
		<td valign="top" colspan="1" width="1" height="32"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="./assets/images/blk_spacer.gif"></td>
		<td valign="top" colspan="1" width="32" height="32" bgcolor="#FFFF99" align="left" valign="center"><img border="0" hspace="0" vspace="0" width="32" height="32" src="./assets/images/<?php echo $msg_icon;?>"></td>
		<td colspan="1" height="32" bgcolor="#FFFF99" align="left"><table border="0" cellspacing="0" cellpadding="0" width="100%">
									<tr>
		<td valign="top" colspan="1" width="1" height="32"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="./assets/images/yl_spacer.gif"></td>
		<td colspan="1" bgcolor="#FFFF99" align="left"><div class="menu"><strong>Logged Out</strong> - <I>For complete logout / database security, close all browsers when finished.</I></div></td>
		<td valign="top" colspan="1" width="1" height="32"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="./assets/images/yl_spacer.gif"></td>
					</tr>
					</table></td>
		<td valign="top" colspan="1" width="1" height="32"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="./assets/images/blk_spacer.gif"></td>
		</tr>
		</table></td>
</tr>
<tr>
	<td valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="./assets/images/blk_spacer.gif"></td>
</tr>
</table>

<br>

<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="left" valign="top" width="80%">
<!--Content -->

<CENTER>
<table border="0" cellspacing="0" cellpadding="0" width="90%">
<tr>
	<td valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="./assets/images/blk_spacer.gif"></td>
</tr>
<tr>
	<td valign="top" width="100%"><table border="0" cellspacing="0" cellpadding="0" height="100%" width="100%">
				<tr>
		<td valign="top" width="1" height="10" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="./assets/images/blk_spacer.gif"></td>
		<td valign="top" align="center" height="10" bgcolor="#FFFFFF">

<P><BR>
					<B>Your Login has expired.</B>

<P>
You may <a href=<?php  echo "./login.php";?>><B>click here to login</B>
<P>


<FONT SIZE="-1" COLOR="#FF0000"><I>Internet Explorer and Safari users need to close all browsers<BR>to completely log out and be able to log in as a different user.</I></FONT><BR>

</center>



					</td>
					<td valign="top" width="1" height="10" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="./assets/images/blk_spacer.gif"></td>
					</tr>
					</table></td>
</tr>
<tr>
	<td valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="./assets/images/blk_spacer.gif"></td>
</tr>
</table></CENTER>
</div>
</body>
