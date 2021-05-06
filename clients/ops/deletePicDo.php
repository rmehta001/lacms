<?php
//BEGIN deletePicDo //
	$pid = $_POST['pid'];
	$cid = $_POST['cid'];
	$conf = $_POST['conf'];
	$ext = $_POST['ext'];
	if ($conf=="y" || $conf=="Y") {
		$quStrDeletePic = "DELETE FROM PICTURE WHERE PID=$pid";
		$quDeletePic = mysqli_query($dbh, $quStrDeletePic) or die (dieNice ("Sorry, couldn't delete picture record.", "E-109"));
		$quStrUpdateAd = "UPDATE CLASS SET PIC=PIC-1 WHERE CID=$cid AND CLI=$grid";
		$quUpdateAd = mysqli_query($dbh, $quStrUpdateAd) or die (dieNice ("Sorry, couldn't unlink the picture from the ad, contact tech suppor with details.", "E-110"));
		$picture = "$picsDirectory/$pid.$ext";
		unlink ($picture) or die (dieNice ("Sorry, couldn't erase the picture from memory.", "E-111"));
		$page = "managePics";
		$disData = "pics";
		$msg = "Picture Deleted.";
	}else {
		$page = "deletePic";
		$disData = "pic";
		$title = "Delete Picture Confirmation";
		$msg = "Picture not deleted,  you must type 'yes' to confirm";
		$msg_error = true;
	}
//END deletePicDo //
?>