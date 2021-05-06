<?php
//BEGIN termUserDo //
	$term_uid = $_POST['term_uid'];
	if ($term_uid==$uid) {
		die (dieNice ("Sorry, Dave,  I cannot let you do that.  -hal", "E-20000"));
	}
	$conf = $_POST['conf'];
	$transfer_uid = $_POST['transfer_uid'];
	if (!$transfer_uid) {
		die (dieNice ("Sorry, I couldn't tell who you wanted to transfer the ads to, it may be your browser's fault.", "E-20000"));
	}
	if ($conf=='y' | $conf=='Y') {
		$quStrGetUser = "SELECT * FROM USERS WHERE UID='$term_uid'";
		$quGetUser = mysqli_query($dbh, $quStrGetUser);
		$rowGetUser = mysqli_fetch_object($quGetUser);
		$quStrDeleteUser = "DELETE FROM USERS WHERE UID='$term_uid' AND `GROUP`='$grid'"; 
		$quDeleteUser = mysqli_query($dbh, $quStrDeleteUser) or die (dieNice("Sorry, That agent could not be deleted", "E-12000"));

		$quStrDeleteHots = "DELETE FROM HOTS WHERE UID='$term_uid' AND `GRID`='$grid'";
		$quDeleteHots = mysqli_query($dbh, $quStrDeleteHots) or die (dieNice("Sorry, The Hot List for that agent could not be deleted", "E-12000"));

		$quStrDeleteFavloc = "DELETE FROM FAVLOC WHERE UID='$term_uid'";
		$quDeleteFavloc = mysqli_query($dbh, $quStrDeleteFavloc) or die (dieNice("Sorry, The Favorite Locations for that agent could not be deleted", "E-12000"));

		$quStrDeleteAgentAd = "DELETE FROM CLASS_AGENTS WHERE UID='$term_uid'";
		$quDeleteAgentAd = mysqli_query($dbh, $quStrDeleteAgentAd) or die (dieNice("Sorry, The Alternative Agent Ads for that agent could not be deleted", "E-12000"));



//		$pw = new PwFile($PASSWORD_FILE);
//		$usr_ID = $rowGetUser->HANDLE;
//		$pw->deleteUser($usr_ID);

		$quStrTransferAds = "UPDATE CLASS SET UID='$transfer_uid' WHERE UID='$term_uid'";	
		$quTransferAds = mysqli_query($dbh, $quStrTransferAds);

		$quStrTransferClients = "UPDATE CLIENTS SET UID='$transfer_uid' WHERE UID='$term_uid'";	
		$quTransferClients = mysqli_query($dbh, $quStrTransferClients);

		$quStrTransferClients = "UPDATE PICTURE SET UID='$transfer_uid' WHERE UID='$term_uid'";	
		$quTransferClients = mysqli_query($dbh, $quStrTransferClients);

		$quStrTransferNewsletters = "UPDATE NEWSLETTERS SET UID='$transfer_uid' WHERE UID='$term_uid'";	
		$quTransferNewsletters = mysqli_query($dbh, $quStrTransferNewsletters);

		$quStrTransferDeals = "UPDATE DEALS SET DUID='$transfer_uid' WHERE DUID='$term_uid'";	
		$quTransferDeals = mysqli_query($dbh, $quStrTransferDeals);




		$page = "manageUsers";
		$msg = "Agent, $rowGetUser->HANDLE, has been terminated.";
		$title = "Manage Agents";
		$needOptions = true;
	} else {
		$page = "termUser-error";
		$msg = "<FONT COLOR=red>Please type 'y' to confirm,  no action taken.</FONT>";
		$msg_error = true;
		$title = "Terminate Agent Error";
	}
//END termUserDo //
?>