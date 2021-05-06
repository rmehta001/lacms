<?php 
session_start();
include ("./inc/admin_key.php");

?>
<?php

$agency_id = $_POST['agency_id'];
$conf = ($_POST['conf'] == 'yes');

if ($conf) {

	$quStrDeactivateAgency = "update `GROUP` set GRSTATUS='' where GRID='$agency_id'";
	$quDeactivateAgency = mysqli_query($dbh,$quStrDeactivateAgency) or die (mysqli_error());



	$quStrDeactAds = "update CLASS set STATUS='STO' where CLI='$agency_id'";
	$quDeactAds = mysqli_query($dbh,$quStrDeactAds) or die (mysqli_error());
	$msg = "The Agency can no longer log into the system,  their ads have been turned off,  but not deleted.";
}else {
	$msg = "Confirmation Failed.  No action taken.";
}


$word = "Deactivate";
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
				
				<?php if ($conf) {?>
				<p>
				<img src="./images/arrow_orange.jpg"><a href="agency_reactivate.php?agency_id=<?php echo $agency_id;?>">Reactivate Agency</a>
				</p>
				<?php }else { ?>
				<p>
				<img src="./images/arrow_orange.jpg"><a href="agency_deactivate.php?agency_id=<?php echo $agency_id;?>">Deactivate Agency</a>
				</p>
				<?php } ?>
				
				<p>
				<img src="./images/arrow_orange.jpg"><a href="agency_edit.php?agency_id=<?php echo $agency_id;?>">Edit Agency</a>
				</p>
				
				
				
				<p>
				<hr size="1" noshade width="100%" color="#666666">
				<img src="./images/arrow_orange.jpg"><a href="manage_agencies.php">Back to Manage Agencies</a>
				</p>
				
				
<?php include("./includes/footer_admin.php");?> 	
	
	
	
	
	
	
	
				
