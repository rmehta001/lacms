<?php
//BEGIN deletePicDo //
	$pid = $_POST['pid'];
	$lid = $_POST['lid'];
	$conf = $_POST['conf'];
	$ext = $_POST['ext'];
	if ($conf=="y" || $conf=="Y") {
		$quStrDeletePic = "DELETE FROM LANDLORD_ADDENDUM_FILE WHERE PID=$pid AND GID=$grid AND LID=$lid";
		$quDeletePic = mysqli_query($dbh, $quStrDeletePic) or die (dieNice ("Sorry, couldn't delete document record.", "E-109"));

		$picture = "../clients/documents/$pid.$ext";
		unlink ($picture) or die (dieNice ("Sorry, couldn't erase the picture from memory.", "E-111"));
		$page = "addendums";
		$disData = "landlord";
		$msg = "Document Deleted.";
	}else {
		$page = "deleteAddendumFile";
		$disData = "landlord";
		$title = "Delete Document Confirmation";
		$msg = "Document not deleted,  you must type 'y' to confirm";
		$msg_error = true;
	}
//END deletePicDo //
?>