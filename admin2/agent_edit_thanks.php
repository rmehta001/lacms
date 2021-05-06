<?php 
session_start();
include ("./inc/admin_key.php");
?>
<?php
if(isset($_POST['agent_id'])){
$agent_id = $_POST['agent_id'];}


if(isset( $_POST['agency_id'])){
$agency_id = $_POST['agency_id'];}

if(isset($_POST['handle'])){
$username = $_POST['handle'];}
else{
    $username="";
}
if(isset($_POST['pass'])){
$pass = $_POST['pass'];}
else{
    $pass="";
};
if(isset($_POST['email'])){
$email = $_POST['email'];}
else{
    $email="";
}
if(isset($_POST['user_level'])){
$user_level = $_POST['user_level'];}
else{
    $user_level="";
}
if(isset($_POST['user_restrict_ip'])){
$user_restrict_ip = $_POST['user_restrict_ip'];}
else{
    $user_restrict_ip="";
}
if(isset($_POST['num_ads'])){
$num_ads = $_POST['num_ads'];}
else{
    $num_ads="";
}
if(isset($_POST['user_sig'])){
$user_sig = $_POST['user_sig'];}
else{
    $user_sig="";
}
if(isset($_POST['use_version'])){
$use_version = $_POST['use_version'];}
else{
    $use_version="";
}
if(isset( $_POST['pref_adl_view'])){
$pref_adl_view = $_POST['pref_adl_view'];}
else{
    $pref_adl_view="";}
if(isset($_POST['pref_auto_update_landlord'])){
$pref_auto_update_landlord = $_POST['pref_auto_update_landlord'];}
else{
    $pref_auto_update_landlord="";
}

if (!empty($agent_id)) {
	//this is an edit//
	$quStrUpdateAgent = "update USERS set PASS='$pass', EMAIL='$email', USER_LEVEL='$user_level', USER_RESTRICT_IP='$user_restrict_ip', NUM_ADS='$num_ads', USER_SIG='$user_sig', USE_VERSION='$use_version', PREF_ADL_VIEW='$pref_adl_view', PREF_AUTO_UPDATE_LANDLORD='$pref_auto_update_landlord' where UID='$agent_id'";
	$quUpdateAgent = mysqli_query($dbh,$quStrUpdateAgent) or die (mysqli_error());
	
//	$pw = new PwFile("../.htpasswd");
//	$pw->updateUser($username, $pass);
	
	$word = "Edit";
	$msg = "The following agent has been updated:";
}else {
	//this is a create//
	$quStrInsertAgent = "insert into USERS (`GROUP`, HANDLE, PASS, EMAIL, USER_LEVEL, USER_RESTRICT_IP, NUM_ADS, USER_SIG, USE_VERSION, PREF_ADL_VIEW, PREF_AUTO_UPDATE_LANDLORD) values ('$agency_id', '$username', '$pass', '$email', '$user_level', '$user_restrict_ip', '$num_ads', '$user_sig', '$use_version', '$pref_adl_view', '$pref_auto_update_landlord')";
	$quInsertAgent = mysqli_query($dbh,$quStrInsertAgent) or die (mysqli_error());
	$agent_id = mysqli_insert_id($dbh);
	
//	$pw = new PwFile("../.htpasswd");
//	$pw->addUser($username, $pass);
	
	$word = "Created";
	$msg = "The following agent has been created:";
}

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
				<b><?php echo $username;?></b>
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
	
	
	
	
	
	
	
				
