<?php 
//BEGIN editHFDo //
$PHP_SELF = $_SERVER['PHP_SELF'];
	$head = mysqli_real_escape_string($dbh, isset ($_POST['head']));
	$foot = mysqli_real_escape_string($dbh, isset ($_POST['foot']));
	$type1_head = mysqli_real_escape_string($dbh, isset ($_POST['type1_head']));
	$type1_foot = mysqli_real_escape_string($dbh, isset ($_POST['type1_foot']));
	$type2_head = mysqli_real_escape_string($dbh, isset ($_POST['type2_head']));
	$type2_foot = mysqli_real_escape_string($dbh, isset ($_POST['type2_foot']));
	$type3_head = mysqli_real_escape_string($dbh, isset ($_POST['type3_head']));
	$type3_foot = mysqli_real_escape_string($dbh, isset ($_POST['type3_foot']));
	$type4_head = mysqli_real_escape_string($dbh, isset ($_POST['type4_head']));
	$type4_foot = mysqli_real_escape_string($dbh, isset ($_POST['type4_foot']));
	$type5_head = mysqli_real_escape_string($dbh, isset ($_POST['type5_head']));
	$type5_foot = mysqli_real_escape_string($dbh, isset ($_POST['type5_foot']));
	$type6_head = mysqli_real_escape_string($dbh, isset ($_POST['type6_head']));
	$type6_foot = mysqli_real_escape_string($dbh, isset ($_POST['type6_foot']));
	$type7_head = mysqli_real_escape_string($dbh, isset ($_POST['type7_head']));
	$type7_foot = mysqli_real_escape_string($dbh, isset ($_POST['type7_foot']));
	$type8_head = mysqli_real_escape_string($dbh, isset ($_POST['type8_head']));
	$type8_foot = mysqli_real_escape_string($dbh, isset ($_POST['type8_foot']));
	$type9_head = mysqli_real_escape_string($dbh, isset ($_POST['type9_head']));
	$type9_foot = mysqli_real_escape_string($dbh, isset ($_POST['type9_foot']));
	$type10_head = mysqli_real_escape_string($dbh, isset ($_POST['type10_head']));
	$type10_foot = mysqli_real_escape_string($dbh, isset ($_POST['type10_foot']));
	$type11_head = mysqli_real_escape_string($dbh, isset ($_POST['type11_head']));
	$type11_foot = mysqli_real_escape_string($dbh, isset ($_POST['type11_foot']));
	$type12_head = mysqli_real_escape_string($dbh, isset ($_POST['type12_head']));
	$type12_foot = mysqli_real_escape_string($dbh, isset ($_POST['type12_foot']));
	$type13_head = mysqli_real_escape_string($dbh, isset ($_POST['type13_head']));
	$type13_foot = mysqli_real_escape_string($dbh, isset ($_POST['type13_foot']));
	$meetagents_head = mysqli_real_escape_string($dbh, isset ($_POST['meetagents_head']));
	$meetagents_foot = mysqli_real_escape_string($dbh, isset ($_POST['meetagents_foot']));
	$cobroke_head = mysqli_real_escape_string($dbh, isset ($_POST['cobroke_head']));
	$cobroke_foot = mysqli_real_escape_string($dbh, isset ($_POST['cobroke_foot']));
	$email_header = mysqli_real_escape_string($dbh, isset ($_POST['email_header']));
	$email_footer = mysqli_real_escape_string($dbh, isset ($_POST['email_footer']));
        $openhouse_foot = mysqli_real_escape_string($dbh, isset ($_POST['openhouse_foot']));
        $openhouse_head = mysqli_real_escape_string($dbh, isset ($_POST['openhouse_head']));
	$quStrHFPrefs = "UPDATE `GROUP` SET HEAD='$head', FOOT='$foot', TYPE1_HEAD='$type1_head', TYPE1_FOOT='$type1_foot', TYPE2_HEAD='$type2_head', TYPE2_FOOT='$type2_foot', TYPE3_HEAD='$type3_head', TYPE3_FOOT='$type3_foot', TYPE4_HEAD='$type4_head', TYPE4_FOOT='$type4_foot', TYPE5_HEAD='$type5_head', TYPE5_FOOT='$type5_foot', TYPE6_HEAD='$type6_head', TYPE6_FOOT='$type6_foot', TYPE7_HEAD='$type7_head', TYPE7_FOOT='$type7_foot', TYPE8_HEAD='$type8_head', TYPE8_FOOT='$type8_foot', TYPE9_HEAD='$type9_head', TYPE9_FOOT='$type9_foot', TYPE10_HEAD='$type10_head', TYPE10_FOOT='$type10_foot', TYPE11_HEAD='$type11_head', TYPE11_FOOT='$type11_foot', TYPE12_HEAD='$type12_head', TYPE12_FOOT='$type12_foot', TYPE13_HEAD='$type13_head', TYPE13_FOOT='$type13_foot', MEETAGENTS_HEAD='$meetagents_head', MEETAGENTS_FOOT='$meetagents_foot', COBROKE_HEAD='$cobroke_head', COBROKE_FOOT='$cobroke_foot', OPENHOUSE_HEAD='$openhouse_head', OPENHOUSE_FOOT='$openhouse_foot', EMAIL_HEADER='$email_header', EMAIL_FOOTER='$email_footer' WHERE `GRID`=$grid";
	$quHFPrefs = mysqli_query($dbh, $quStrHFPrefs) or die ("Something is wrong");
	$page = "admin";
	$msg = "Header and Footer settings for BostonApartments.com saved.";
	$title = "Admin";
	
//END editHFDo //
?>