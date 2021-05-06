<?php 
//BEGIN watermarkprefsDo //
$PHP_SELF = $_SERVER['PHP_SELF'];
	$watermark = (isset ($_POST['watermark']));
	$watermark_on = (isset ($_POST['watermark_on']));
	$watermark_placement = (isset ($_POST['watermark_placement']));

	$pic_custom_width = (isset ($_POST['pic_custom_width']));
	$pic_custom_height = (isset ($_POST['pic_custom_height']));
	$watermark_font = (isset ($_POST['watermark_font']));

	$quStrHFPrefs = "UPDATE `GROUP` SET WATERMARK='$watermark', WATERMARK_ON='$watermark_on' , WATERMARK_PLACEMENT='$watermark_placement', PIC_CUSTOM_WIDTH='$pic_custom_width', PIC_CUSTOM_HEIGHT='$pic_custom_height', WATERMARK_FONT='$watermark_font' WHERE `GRID`=$grid";
	$quHFPrefs = mysqli_query($dbh, $quStrHFPrefs) or die ("Something is wrong with watermarkprefsDo");

if (isset ($isAdmin)) {
	$page = "admin";
        $msg = "Watermark settings for $_SESSION[group] saved.";
	$title = "Admin";
} else {
$page = "home";
 }
	
	
//END watermarkprefsDo  //

?>