<?php
//BEGIN editPicDo //
$pid = $_POST['pid'];
$cid = $_POST['cid'];
$picorder = $_POST['picorder'];
$another = $_POST['another'];
$desc = $_POST['desc'];
$quStrUpdatePic = "UPDATE PICTURE SET DESCRIPT='$desc',PICORDER='$picorder' WHERE PID=$pid";
$quUpdatePic = mysqli_query($dbh, $quStrUpdatePic) or die (dieNice("Sorry, couldn't update picture record.", "E-108"));
if ($another) {
	$page = "upload";
	$title = "Upload Picture";
	
}else {
	$page = "managePics";
	$title = "Manage Pictures";
	$disData = "pics";
	$msg = "Picture Info updated.";
}
//END editPicDo //
?>