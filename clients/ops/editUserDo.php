<?php
//BEGIN editUserDo //
	if ($isAdmin or $user_level=10) {
		$agenthandle = $_POST['agenthandle'];
		$euid = $_POST['uid'];
		$eemail = $_POST['email'];
		$elevel = $_POST['level'];
		$efname = mysqli_real_escape_string($dbh, $_POST['fname']);
		$elname = mysqli_real_escape_string($dbh, $_POST['lname']);
		$eposition = mysqli_real_escape_string($dbh, $_POST['position']);
		$emeetagents = $_POST['meetagents'];
		$emeetorder = $_POST['meetorder'];
		$ebio = mysqli_real_escape_string($dbh, $_POST['bio']);
		$ecellphone = $_POST['cellphone'];
		$edirectline = $_POST['directline'];
		$epersonal_website = $_POST['personal_website'];
		$user_restrict_ip = $_POST['user_restrict_ip'];
		$user_restrict_ip_address = $_POST['user_restrict_ip_address'];
		$euser_sig = mysqli_real_escape_string($dbh, $_POST['user_sig']);
//		$euser_sig = mysqli_real_escape_string($dbh, $euser_sig);
		$password = $_POST['password'];
		$agent_type = $_POST['agent_type'];
		
		
	$facebook = $_POST['facebook'];
	$twitter = $_POST['twitter'];
	$myspace = $_POST['myspace'];
	$linkedin = $_POST['linkedin'];

		$CL_HEADERU = mysqli_real_escape_string($dbh, $_POST['CL_HEADERU']);
		$CL_FOOTERU = mysqli_real_escape_string($dbh, $_POST['CL_FOOTERU']);

		$eagency = $_POST['eagency'];

		$quStrUpdateUser = "UPDATE USERS SET POSITION='$eposition', EMAIL='$eemail', MEETAGENTS='$emeetagents', MEETORDER='$emeetorder', BIO='$ebio', USER_LEVEL='$elevel', USER_RESTRICT_IP='$user_restrict_ip', USER_RESTRICT_IP_ADDRESS='$user_restrict_ip_address', USER_SIG='$euser_sig', FNAME='$efname', LNAME='$elname', CELLPHONE='$ecellphone', DIRECTLINE='$edirectline', PERSONAL_WEBSITE='$epersonal_website', PASS='$password', AGENCY='$eagency', AGENT_TYPE='$agent_type', CL_HEADERU='$CL_HEADERU', CL_FOOTERU='$CL_FOOTERU', FACEBOOK='$facebook', TWITTER='$twitter', MYSPACE='$myspace', LINKEDIN='$linkedin' WHERE UID='$euid' AND `GROUP`='$grid'";
		$quUpdateUser = mysqli_query($dbh, $quStrUpdateUser)or die (mysqli_error($dbh));
		$quStrGetHandle = "select HANDLE, PASS from USERS where UID='$euid' and `GROUP`='$grid'";
		$quGetHandle = mysqli_query($dbh, $quStrGetHandle)or die (mysqli_error($dbh));
		$rowGetHandle = mysqli_fetch_object($quGetHandle);
		//$pw = new PwFile($PASSWORD_FILE);
		$usr_ID = $rowGetHandle->HANDLE;
		$usr_passwd = $rowGetHandle->PASS;
		//$pw->updateUser($usr_ID, $usr_passwd);

		
		
		$page = "manageUsers";
		$msg = "Agent $agenthandle updated. ";
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, Your access level does not allow that functionality.";
		$msg_error = true;
	}
//END editUserDo //
?>
