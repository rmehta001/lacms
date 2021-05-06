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
<link rel="stylesheet" type="text/css" href="../assets/style.css">

		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php if ($title) { $title = " - " . $title; }; ?>
		<title>BostonApartments.com<?php echo $title;?></title>
		<!-- MAIN JAVASCRIPT LAYER -->
		<?php include ("../assets/main.js"); ?>
		<!--END MAIN JAVASCRIPT LAYER -->
                
</head>
<body topmargin="10" leftmargin="10" >
<div align="center" style="position:relative;">

<?php if ($msg) {
	$msg_icon = ($msg_err) ? "msgerr.jpg" : "msg.jpg";
?>
<!--Message box -->
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
	<td valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="../assets/images/blk_spacer.gif"></td>
</tr>
<tr>
	<td valign="top" width="100%"><table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
		<td valign="top" colspan="1" width="1" height="32"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td valign="top" colspan="1" width="32 "height="32" bgcolor="#FFFF99" align="left" valign="center"><img border="0" hspace="0" vspace="0" width="32" height="32" src="../assets/images/<?php echo $msg_icon;?>"></td>
		<td colspan="1" height="32" bgcolor="#FFFF99" align="left"><table border="0" cellspacing="0" cellpadding="0" width="100%">
									<tr>
									<td valign="top" colspan="1" width="1" height="32"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/yl_spacer.gif"></td>
									<td colspan="1" bgcolor="#FFFF99" align="left"><div class="menu"><strong><?php echo $msg;?></strong></div></td>
									<td valign="top" colspan="1" width="1" height="32"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/yl_spacer.gif"></td>
									</tr>
									</table></td>
		<td valign="top" colspan="1" width="1" height="32"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		</table></td>
</tr>
<tr>
	<td valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="../assets/images/blk_spacer.gif"></td>
</tr>
</table>
<br>
<!--End Message Box -->
<?php }?>




<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="left" valign="top" width="80%">
<!--Content -->
<table border="0" cellspacing="0" cellpadding="0" width="90%">
<tr>
	<td valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
</tr>
<tr>
	<td valign="top" width="100%"><table border="0" cellspacing="0" cellpadding="0" height="100%" width="100%">
					<tr>
					<td valign="top" width="1" height="10" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="../assets/images/blk_spacer.gif"></td>
					<td valign="top" align="center" height="10" bgcolor="#FFFFFF">
<!-- //BEGIN PHP CONTENT // -->
<?php include ("./pages/$page.php"); ?>					
<!-- //END PHP CONTENT//-->	
					</td>
					<td valign="top" width="1" height="10" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="../assets/images/blk_spacer.gif"></td>
					</tr>
					</table></td>
</tr>
<tr>
	<td valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="1" src="../assets/images/blk_spacer.gif"></td>
</tr>
</table>
<!--End Content -->
</td>
<td align="right" valign="top">&nbsp;
</td>
</tr>
</table>

</div>
</body>
</html>