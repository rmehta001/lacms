<?php
//BEGIN createUserDo //
$isAdmin=$_SESSION["isAdmin"];
$user_level=$_SESSION["user_level"];

	if ((!$isAdmin) AND ($user_level < "10")) {
		die (dieNice("Sorry,  you are not the admin and do not have permission to create a user.", "E-10000"));
	}
	$new_handle = $_POST['new_handle'];
	$new_passwd = $_POST['new_passwd'];
	$conf_new_passwd = $_POST['conf_new_passwd'];
	$new_email = $_POST['email'];
	$new_level = $_POST['level'];

	$new_agency = $_POST['eagency'];
	$new_website = $_POST['personal_website'];

$new_facebook = $_POST['facebook'];
$new_twitter = $_POST['twitter'];
$new_myspace = $_POST['myspace'];
$new_linkedin = $_POST['linkedin'];

	$agent_type = $_POST['agent_type'];
	$new_meetagents = $_POST['meetagents'];
	$new_meetorder = $_POST['meetorder'];

	$new_fname = mysqli_real_escape_string($dbh, $_POST['fname']);
	$new_lname = mysqli_real_escape_string($dbh, $_POST['lname']);
	$new_cellphone = $_POST['cellphone'];
	$new_directline = $_POST['directline'];

	$new_position = mysqli_real_escape_string($dbh, $_POST['position']);


//	$user_sig = mysqli_real_escape_string(prepareAdBody ($_POST['user_sig'], false));
	$user_sig = mysqli_real_escape_string($dbh, $_POST['user_sig']);

	$user_restrict_ip = $_POST['user_restrict_ip'] ?? false;
	$user_restrict_ip_address = $_POST['user_restrict_ip_address'];
	
	
	if ($new_passwd !== $conf_new_passwd) {
		$page = "createUser";
		$msg = "Passwords did not match,  please try again";
		$msg_err = true;
		$title = "Create User";
	}elseif (!$new_level) {
		$page = "createUser";
		$msg = "Make sure you select an Access Level";
		$msg_err = true;
		$title = "Create User";
	}else {
		$quStrInsUser = "INSERT INTO USERS (`GROUP`, HANDLE, PASS, EMAIL, USER_LEVEL, USER_SIG, USER_RESTRICT_IP, USER_RESTRICT_IP_ADDRESS, FNAME, LNAME, CELLPHONE, DIRECTLINE, AGENCY, AGENT_TYPE, PERSONAL_WEBSITE, FACEBOOK, TWITTER, MYSPACE, LINKEDIN, MEETORDER, MEETAGENTS, POSITION, SOURCEPREF, LISTVIEW) VALUES ($grid, '$new_handle', '$new_passwd', '$new_email', '$new_level', '$user_sig', '$user_restrict_ip', '$user_restrict_ip_address', '$new_fname', '$new_lname', '$new_cellphone', '$new_directline', '$new_agency', '$agent_type', '$new_website', '$new_facebook', '$new_twitter', '$new_myspace', '$new_linkedin', '$new_meetorder', '$new_meetagents', '$new_position', '$grid', '10')";
		
		$quInsUser = mysqli_query($dbh, $quStrInsUser);
		if (!$quInsUser) {
			$page = "createUser";
			$msg = "Sorry, that name is already taken";
			$msg_error = true;
			$title = "Create User";
		}else {
			$pw = new PwFile($PASSWORD_FILE);
			$usr_ID = $new_handle;
			$usr_passwd = $new_passwd;
			$pw->addUser($usr_ID, $usr_passwd);
			$page = "manageUsers";
			$msg = "New user, $new_handle, created.";
			$title = "Manage Agents";
			$needOptions = true;
		}
	}
//END createUserDo //
?>
