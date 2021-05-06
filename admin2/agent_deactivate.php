<?php 
session_start();
include ("./inc/admin_key.php");

?>
<?php

$agent_id = $_GET['agent_id'];

$quStrGetAgent = "select * from USERS where UID='$agent_id'";
$quGetAgent = mysqli_query($dbh,$quStrGetAgent) or die (mysqli_error());
$rowGetAgent = mysqli_fetch_object($quGetAgent);



$username = $rowGetAgent->HANDLE;
$agency_id = $rowGetAgent->GROUP;


$pw = new PwFile ("../.htpasswd");
$pw->deleteUser($username);


$quStrUpdateAgent = "update USERS set USER_ACTIVE='0' where UID='$agent_id'";
$quUpdateAgent = mysqli_query($dbh,$quStrUpdateAgent) or die (mysqli_error());



$word = "Deactivate";
$msg = "The following Agent can no longer log into the system.";



?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				<?php echo $word;?> Agent - Complete
				</span>
				</p>
				<p>
				<?php echo $msg;?>
				</p>
				<p>
				<img src="./images/agent.gif" height="16" width="16" border="0"> <?php echo $username;?>
				</p>
				
				<p>
				<img src="./images/arrow_orange.jpg"><a href="agent_reactivate.php?agent_id=<?php echo $agent_id;?>">Reactivate Agent</a>
				</p>
				
				<p>
				<img src="./images/arrow_orange.jpg"><a href="agent_edit.php?agent_id=<?php echo $agent_id;?>">Edit Agent</a>
				</p>
				
				<p>
				<img src="./images/arrow_orange.jpg"><a href="agency_edit.php?agency_id=<?php echo $agency_id;?>">Edit Agency</a>
				</p>
				
				<p>
				<hr size="1" noshade width="100%" color="#666666">
				<img src="./images/arrow_orange.jpg"><a href="manage_agencies.php">Back to Manage Agencies</a>
				</p>
				
				
<?php include("./includes/footer_admin.php");?> 	
	
	
	
	
	
	
	
				
