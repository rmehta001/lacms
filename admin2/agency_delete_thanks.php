<?php 
session_start();
include ("./inc/admin_key.php");
?>
<?php

$agency_id = $_POST['agency_id'];
$conf = ($_POST['conf'] == 'yes');

if ($conf) {
	//delete pics
	$quStrGetPics = "select * from CLASS inner join PICTURE on CLASS.CID=PICTURE.CID where CLI='$agency_id'";
	$quGetPics = mysqli_query($dbh,$quStrGetPics) or die (mysqli_error());
	while ($rowGetPics = mysqli_fetch_object($quGetPics)) {
		$pic_path = "/usr/home/eboyer/public_html/bostonapartments/pics/$rowGetPics->PID.$rowGetPics->EXT";
		unlink ($pic_path);
		$quStrDeletePic = "delete from PICTURE where PID='$rowGetPics->PID'";
		$quDeletePic = mysqli_query($dbh,$quStrDeletePic) or die (mysqli_error());
	}
	//delete Ads
	$quStrDeleteAds = "delete from CLASS where CLI='$agency_id'";
	$quDeleteAds = mysqli_query($dbh,$quStrDeleteAds) or die (mysqli_error());
	
	
	//delete Landlords
	$quStrDeleteLandlords = "delete from LANDLORD where GRID='$agency_id'";
	$quDeleteLandlords = mysqli_query($dbh,$quStrDeleteLandlords) or die (mysqli_error());
	
	//delete clients
	$quStrDeleteClients = "delete from CLIENTS where GRID='$agency_id'";
	$quDeleteClients = mysqli_query($dbh,$quStrDeleteClients) or die (mysqli_error());
	
	//delete deal clients
	$quStrDeleteDClients = "delete from DEALCLIENTS where DGRID='$agency_id'";
	$quDeleteDClients = mysqli_query($dbh,$quStrDeleteDClients) or die (mysqli_error());
	
	//delete deals
	$quStrDeleteDeals = "delete from DEALS where GRID='$agency_id'";
	$quDeleteDeals = mysqli_query($dbh,$quStrDeleteDeals) or die (mysqli_error());
	
	//delete users
	$quStrGetUsers = "select * from USERS where `GROUP`='$agency_id'";
	$quGetUsers = mysqli_query($dbh,$quStrGetUsers) or die (mysqli_error());
	
//	//$pw = new PwFile ("../.htpasswd");
//	while ($rowGetUser = mysqli_fetch_object($quGetUsers)) {
//		$handle = $rowGetUser->HANDLE;
//		$pw->deleteUser ($handle);
//	}
	$quStrDeleteUsers = "delete from USERS where `GROUP`='$agency_id'";
	$quDeleteUsers = mysqli_query($dbh,$quStrDeleteUsers) or die (mysqli_error());

	//delete hots
	$quStrDeleteHots = "delete from HOTS where `GRID`='$agency_id'";
	$quDeleteHots = mysqli_query($dbh,$quStrDeleteHots) or die (mysqli_error());

	//delete open houses
	$quStrDeleteHots = "delete from OPENHOUSE where `CLI`='$agency_id'";
	$quDeleteHots = mysqli_query($dbh,$quStrDeleteHots) or die (mysqli_error());

	//delete newsletters
	$quStrDeleteHots = "delete from NEWSLETTERS where `GRID`='$agency_id'";
	$quDeleteHots = mysqli_query($dbh,$quStrDeleteHots) or die (mysqli_error());


	//delete landlord_addendums
	$quStrDeleteLA = "delete from LANDLORD_ADDENDUMS where `CLI`='$agency_id'";
	$quDeleteLA = mysqli_query($dbh,$quStrDeleteLA) or die (mysqli_error());


	//delete landlord_addendum_file

	$quStrDeleteLAF = "delete from LANDLORD_ADDENDUM_FILE where `GID`='$agency_id'";
	$quDeleteLAF = mysqli_query($dbh,$quStrDeleteLAF) or die (mysqli_error());

// still need to delete the orphan files from clients/documents //
	
	//delete the agency itself
	$quStrDeleteAgency = "delete from `GROUP` where GRID='$agency_id'";
	$quDeleteAgency = mysqli_query($dbh,$quStrDeleteAgency) or die (mysqli_error());
	
	$msg = "The Agency, and all records associated with the Agency, have been erased.";
	
}else {
	$msg = "Confirmation Failed.  No action taken.";
}


$word = "Delete";
?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				<?php echo $word;?> Agency - Complete
				</span>
				</p>
				<p>
				<?php echo $msg;?>
				</p>
				
				<?php if (!$conf) {?>
				<p>
				<img src="./images/arrow_orange.jpg"><a href="agency_reactivate.php?agency_id=<?php echo $agency_id;?>">Reactivate Agency</a>
				</p>
				<p>
				<img src="./images/arrow_orange.jpg"><a href="agency_edit.php?agency_id=<?php echo $agency_id;?>">Edit Agency</a>
				</p>
				<?php } ?>
				
				<p>
				<hr size="1" noshade width="100%" color="#666666">
				<img src="./images/arrow_orange.jpg"><a href="manage_agencies.php">Back to Manage Agencies</a>
				</p>
				
				
<?php include("./includes/footer_admin.php");?> 	
	
	
	
	
	
	
	
				
