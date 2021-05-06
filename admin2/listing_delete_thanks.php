<?php 
session_start();
include ("./inc/admin_key.php");
include("../inc/local_info.php");
?>
<?php

$listing_id = $_POST['listing_id'];

/*

$quStrGetListing = "select * from CLASS inner join `GROUP` on CLASS.CLI=`GROUP`.GRID where CID='$listing_id'";
$quGetListing = mysqli_query($dbh, $quStrGetListing) or die (mysqli_error($dbh));
$rowGetListing = mysqli_fetch_object($quGetListing);

$quStrCountPics = "select count(PID) as picture_count from PICTURE where CID='$listing_id'";
$quCountPics = mysqli_query($dbh, $quStrCountPics) or die (mysqli_error($dbh));
$rowCountPics = mysqli_fetch_object($quCountPics);
$picture_count = $rowCountPics->picture_count;

if ($picture_count) {
	$quStrGetPics = "select * from PICTURE where CID='$listing_id'";
	$quGetPics = mysqli_query($dbh, $quStrGetPics) or die (mysqli_error($dbh));
	while ($rowGetPics = mysqli_fetch_object($quGetPics)) {
		$picture = "$picsDirectory$rowGetPics->PID.$rowGetPics->EXT";
		unlink ($picture);
	}
	$quStrDeletePics = "delete from PICTURE where CID='$listing_id'";
	$quDeletePics = mysqli_query($dbh, $quStrDeletePics) or die (mysqli_error($dbh));
}

$quStrDeleteListing = "delete from CLASS where CID='$listing_id'";
$quDeleteListing = mysqli_query($dbh, $quStrDeleteListing) or die (mysqli_error($dbh));

*/

db_delete_listing_admin ($listing_id);

$msg = "The Listing has been deleted.";
	

	

?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				Delete Listing - Complete
				</span>
				</p>
				<p>
				<?php echo $msg;?>
				</p>

				<p>
				<hr size="1" noshade width="100%" color="#666666">
				<img src="./images/arrow_orange.jpg"><a href="manage_listings.php">Back to Manage Listings.</a>
				</p>
				
				
<?php include("./includes/footer_admin.php");?> 	
	
	
	
	
	
	
	
				