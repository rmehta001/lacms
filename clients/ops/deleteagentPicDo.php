<?php
//BEGIN deletePicDo //
	$uid = $_POST['uid'];
	$handle = $_POST['handle'];
	$ext = $_POST['ext'];
	$extnew = "";

	if ($ext!="") {



		$quStrUpdatePic = "UPDATE `USERS` SET PICEXT='' WHERE UID=$uid";
		$quUpdatePic = mysqli_query($dbh, $quStrUpdatePic) or die (dieNice ("Sorry, couldn't unlink the picture from the agent, contact tech support with details.", "E-Agent Photo delete"));
		$picture = "$picsDirectory/$handle.$ext";
		unlink ($picture) or die (dieNice ("Sorry, couldn't erase the picture from memory.", "E-111"));
		$page = "editPrefs";
		$disData = "user";
		$msg = "Picture Deleted.";
	}else {
		$page = "editPrefs";
		$disData = "user";
		$title = "Delete Picture Confirmation";
		$msg = "Picture not deleted,  you must type 'yes' to confirm";
		$msg_error = true;
	}
//END deletePicDo //
?>