<?php 
session_start();
include ("./inc/admin_key.php");
?>
<?php
if(isset($_POST['agent_id'])){

$agent_id = $_POST['agent_id'];}
else{
    $agent_id="";
}
if(isset( $_POST['transfer'])){
$transfer = $_POST['transfer'];}
else{
    $transfer="";
}

$quStrGetAgent = "select * from USERS inner join `GROUP` on USERS.`GROUP`=`GROUP`.GRID where UID='$agent_id'";
$quGetAgent = mysqli_query($dbh,$quStrGetAgent) or die (mysqli_error());
$rowGetAgent = mysqli_fetch_object($quGetAgent);


$quStrTransferListings = "update CLASS set UID='$transfer' where UID='$agent_id'";
$quTransferListings = mysqli_query($dbh,$quStrTransferListings) or die (mysqli_error());

$username = $rowGetAgent->HANDLE;
$agency_id = $rowGetAgent->GROUP;

//
$pw = new PwFile ("../.htpasswd");
$pw->deleteUser($username);


$quStrDeleteAgent = "delete from USERS where UID='$agent_id'";
$quStrDeleteAgent = mysqli_query($dbh,$quStrDeleteAgent) or die (mysqli_error());

$msg = "The user has been deleted.";


?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				Delete Agent - Complete
				</span>
				</p>
				<p>
				<?php echo $msg;?>
				</p>
				
				
				<p>
				<img src="./images/arrow_orange.jpg"><a href="agency_edit.php?agency_id=<?php echo $agency_id;?>">Edit Agency</a>
				</p>
				
				<p>
				<hr size="1" noshade width="100%" color="#666666">
				<img src="./images/arrow_orange.jpg"><a href="manage_agencies.php">Back to Manage Agencies</a>
				</p>
				
				
<?php include("./includes/footer_admin.php");?>
