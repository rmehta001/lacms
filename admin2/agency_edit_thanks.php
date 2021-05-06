<?php 
session_start();
include ("./inc/admin_key.php");

?>
<?php

if(!is_null($_POST['agency_id'])){
$agency_id = $_POST['agency_id'];}

echo empty($agency_id);

if(isset($_POST['admin_handle'])){
$admin_handle = $_POST['admin_handle'];}
else{
    $admin_handle="";
}

if(isset($_POST['admin_pass'])){
$admin_pass = $_POST['admin_pass'];}
else{
    $admin_pass="";
}
if(isset($_POST['name'])){
$name = mysqli_real_escape_string($dbh,$_POST['name']);}
else{
    $name="";
}
if(isset($_POST['abv'])){
$abv = $_POST['abv'];}
else{
    $abv="";
}
if(isset($_POST['level'])){
$level = $_POST['level'];}
else{
    $level="";
}
if(isset($_POST['maxact'])){
$maxact = $_POST['maxact'];}
else{
    $maxact="";
}
if(isset( $_POST['sig'])){
$sig = $_POST['sig'];}
else{
    $sig="";
}
if(isset($_POST['restrict_ip'])){
$restrict_ip = $_POST['restrict_ip'];}
else{
    $restrict_ip="";
}
if(isset($_POST['ip_address'])){
$ip_address = $_POST['ip_address'];}
else{
    $ip_address="";
}
if(isset($_POST['head'])){
$head = $_POST['head'];}
else{
    $head="";
}
if(isset($_POST['foot'])){
$foot = $_POST['foot'];}
else{
    $foot="";
}
if(isset($_POST['type1_head'])){
$type1_head = $_POST['type1_head'];}
else{
    $type1_head="";
}

if(isset($_POST['type1_foot'])){
$type1_foot = $_POST['type1_foot'];}
else{
    $type1_foot="";
}
if(isset($_POST['type2_head'])){
$type2_head = $_POST['type2_head'];}
else{
    $type2_head="";
}

if(isset($_POST['type2_foot'])){
$type2_foot = $_POST['type2_foot'];}
else{
    $type2_foot="";
}
if(isset($_POST['type3_head'])){
$type3_head = $_POST['type3_head'];}
else{
    $type3_head="";
}
if(isset($_POST['type3_foot'])){
$type3_foot = $_POST['type3_foot'];}
else{
    $type3_foot="";
}
if(isset($_POST['type4_head'])){
$type4_head = $_POST['type4_head'];}
else{
    $type4_head="";
}
if(isset($_POST['type4_foot'])){
$type4_foot = $_POST['type4_foot'];}
else{
    $type4_foot="";
}


if ( !empty($agency_id)) {
	//this is an edit//
	$quStrUpdateAgency = "update `GROUP` set NAME='$name', ABV='$abv', LEVEL='$level', MAXACT='$maxact', SIG='$sig', RESTRICT_IP='$restrict_ip', IP_ADDRESS='$ip_address', HEAD='$head', FOOT='$foot', TYPE1_HEAD='$type1_head', TYPE1_FOOT='$type1_foot', TYPE2_HEAD='$type2_head', TYPE2_FOOT='$type2_foot', TYPE3_HEAD='$type3_head', TYPE3_FOOT='$type3_foot', TYPE4_HEAD='$type4_head', TYPE4_FOOT='$type4_foot' where GRID='$agency_id'";
	$quUpdateAgency = mysqli_query($dbh,$quStrUpdateAgency) or die (mysqli_error($GLOBALS['dbh']));
	$word = "Edit";
	$msg = "The following agency has been updated:";
	
	$new_agency = $agency_id;
}else {
	//this is a create//
	
	//insert agency
	$quStrInsertAgency = "insert into `GROUP` (NAME, ABV, LEVEL, MAXACT, SIG, RESTRICT_IP, IP_ADDRESS, HEAD, FOOT, TYPE1_HEAD, TYPE1_FOOT, TYPE2_HEAD, TYPE2_FOOT, TYPE3_HEAD, TYPE3_FOOT, TYPE4_HEAD, TYPE4_FOOT) values ('$name', '$abv', '$level', '$maxact', '$sig', '$restrict_ip', '$ip_address', '$head', '$foot', '$type1_head', '$type1_foot', '$type2_head', '$type2_foot', '$type3_head', '$type3_foot', '$type4_head', '$type4_foot')";
	$quInsertAgency = mysqli_query($dbh,$quStrInsertAgency) or die (mysqli_error($GLOBALS['dbh']));
	$new_agency = mysqli_insert_id($dbh);

	//insert admin
	$quStrInsertUser = "insert into USERS (`GROUP`, HANDLE, PASS, USER_LEVEL) values ('$new_agency', '$admin_handle', '$admin_pass', '3')";
	$quInsertUser = mysqli_query($dbh,$quStrInsertUser) or die (mysqli_error($GLOBALS['dbh']));
	$new_admin = mysqli_insert_id($dbh);
	
	//set admin//
	$quStrSetAdmin = "update `GROUP` set ADMIN='$new_admin' where GRID='$new_agency'";
	$quSetAdmin = mysqli_query($dbh,$quStrSetAdmin) or die (mysqli_error($GLOBALS['dbh']));
	

//	$username = $admin_username;
//	$pass = $admin_pass;
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

				<img src="./images/arrow_orange.jpg"><a href="agency_edit.php?agency_id=<?php echo $new_agency;?>">Edit Agency</a>
				</p>
				
				<p>
				<hr size="1" noshade width="100%" color="#666666">
				<img src="./images/arrow_orange.jpg"><a href="manage_agencies.php">Back to Manage Agencies</a>
				</p>
				
				
<?php include("./includes/footer_admin.php");?> 	
	
	
	
	
	
	
	
				
