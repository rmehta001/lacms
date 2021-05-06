<?php 
session_start();
include ("./inc/admin_key.php");

?>
<?php

$agency_id = $_GET['agency_id'];

	$quStrReactivateAgency = "update `GROUP` set GRSTATUS='ACT' where GRID='$agency_id'";
	$quReactivateAgency = mysqli_query($dbh,$quStrReactivateAgency) or die (mysqli_error());




	$msg = "System access has been restored to the Agency.";



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
				
				
				<p>
				<img src="./images/arrow_orange.jpg"><a href="agency_deactivate.php?agency_id=<?php echo $agency_id;?>">Deactivate Agency</a>
				</p>
				
				
				<p>
				<img src="./images/arrow_orange.jpg"><a href="agency_edit.php?agency_id=<?php echo $agency_id;?>">Edit Agency</a>
				</p>
				
				
				
				<p>
				<hr size="1" noshade width="100%" color="#666666">
				<img src="./images/arrow_orange.jpg"><a href="manage_agencies.php">Back to Manage Agencies</a>
				</p>
				
				
<?php include("./includes/footer_admin.php");?> 	
	
	
	
	
	
	
	
				
