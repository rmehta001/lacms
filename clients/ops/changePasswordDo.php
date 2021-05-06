<?php
//BEGIN changePasswordDo //
	$oldPass = $_POST['oldPass'];
	$newPass = $_POST['newPass'];
	$newPassConf = $_POST['newPassConf'];
	if ($oldPass==$_SESSION["pass"]) {
		if ($newPass==$newPassConf) {
			$quStrUpdateUser = "UPDATE USERS SET PASS='$newPass' WHERE UID=$uid AND `GROUP`=$grid";
			$quUpdateUser = mysqli_query($dbh, $quStrUpdateUser) or die (dieNice("Sorry, couldn't update your password.", "E-112"));
			$pw = new PwFile($PASSWORD_FILE);
			$usr_ID = $_SESSION["handle"];
			$usr_passwd = $newPass;
			$pw->updateUser($usr_ID, $usr_passwd);
			$page = "home";
			$disData = "ads";
			$msg = "Password Changed";
		}else {
			$page = "changePassword";
			$msg = "Passwords do not match,  please try again.";
			$msg_error = true;
		}
	}else {
		$page = "changePassword";
		$msg = "Password is incorrect,  please try again.";
		$msg_error = true;
	}
//END changePasswordDo //
?>