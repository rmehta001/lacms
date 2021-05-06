<?php 
session_start();
include ("./inc/admin_key.php");
?>
<?php
$listing_id = $_GET['listing_id'];
$mode = $_GET['mode'];

if ($mode=='delete') {
	$pid = $_POST['pid'];
	$quStrGetPicture = "select * from PICTURE where PID='$pid'";
	$quGetPicture = mysqli_query($dbh,$quStrGetPicture) or die (mysqli_error());
	$rowGetPicture = mysqli_fetch_object($quGetPicture);
	
	$ext = $rowGetPicture->EXT;
	
	$picture = "$picsDirectory/$pid.$ext";
	unlink ($picture);
	
	$quStrDeletePicture = "delete from PICTURE where PID='$pid'";
	$quDeletePicture = mysqli_query($dbh,$quStrDeletePicture) or die (mysqli_error());
	
	$quStrUpdateListing = "update CLASS set PIC=PIC-1 where CID='$cid'";
	$quUpdateListing = mysqli_query($dbh,$quStrUpdateListing) or die (mysqli_error());
}
	
$quStrGetListing = "select * from CLASS inner join `GROUP` on CLASS.CLI=`GROUP`.GRID where CID='$listing_id'";
$quGetListing = mysqli_query($dbh,$quStrGetListing) or die (mysqli_error());
$rowGetListing = mysqli_fetch_object($quGetListing);
 
$quStrGetPicturesCount = "select count(PID) as picture_count from PICTURE where CID='$listing_id'";
$quGetPicturesCount = mysqli_query($dbh,$quStrGetPicturesCount) or die (mysqli_error());
$rowPicturesCount = mysqli_fetch_object($quGetPicturesCount);
$pictures_count = $rowPicturesCount->picture_count;

if ($pictures_count) {
	$word = "Upload and edit";
	$msg = "Edit existing and upload new Pictures here.";
	$quStrGetPictures = "select * from PIC where CID='$listing_id'";
	$quGetPictures = mysqli_query($dbh,$quStrGetPictures) or die (mysqli_error());
	
}else {
	$word = "Upload";
	$msg = "Upload pictures for the listing here.";
}



$action = "upload";



?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				<?php echo $word;?> Pictures.
				</span><br>
				</p>
				
				<p>
				<span class="text">Listing belongs to: <a href="agency_edit.php?agency_id=<?php echo $rowGetListing->CLI;?>"><?php echo $rowGetListing->NAME;?></a></span>
				</p>
				
				<p>
				<?php echo $msg;?>
				</p>
				
				<p>
				<a href="listing_edit.php?listing_id=<?php echo $listing_id;?>">Click here</a> to edit this listing.
				</p>
				
				<p>
				
				<table width="100%" cellpadding="4" cellspacing="0" border="0">	
					<form name="listing_pictures_edit_form" method="post" action="listing_pictures_edit_thanks.php">
					<input type="hidden" name="listing_id" value="<?php echo $listing_id;?>">
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Send this file:
						</span>
						</td>
						<td valign="middle">
						<input type="file" name="picture">
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						&nbsp;
						</span>
						</td>
						<td valign="middle">
						<input type="submit" value="<?php echo $action;?>">
						</td>
					</tr>
					</form>
				</table>
				
				<?php if ($pictures_count) { ?>
				<table cellpadding="4" cellspacing="0" border="0">
				<?php 
					$i = 0;
					while ($rowGetPictures = mysqli_fetch_object($quGetPictures)) {
						$i++;
						if (!($i%4)) {
							echo "<tr>";
						}
					?>                                         
						<td class="text"><img width="145" height="200" src="vfv"><input type="checkbox">Delete</td>
					<?php
						if ($i%4) {
							echo "</tr>";
						}
					}?>					
				</table>
				<?php } ?>
				
				</p>
				
<?php include("./includes/footer_admin.php");?>