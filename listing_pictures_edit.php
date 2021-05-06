<?php 
session_start();
include ("./inc/admin_key.php");
?>
<?php
$listing_id = $_GET['listing_id'];
$mode = $_GET['mode'];

if ($mode=='delete') {
	$listing_id = $_POST['listing_id'];
	$pids = $_POST['pid'];
	foreach ($pids as $pid) {
		$quStrGetPicture = "select * from PICTURE where PID='$pid'";
		$quGetPicture = mysqli_query($dbh, $quStrGetPicture) or die (mysqli_error($dbh));
		$rowGetPicture = mysqli_fetch_object($quGetPicture);
		
		$ext = $rowGetPicture->EXT;
		
		$picture = "$picsDirectory/$pid.$ext";
		@unlink ($picture);
	
		$quStrDeletePicture = "delete from PICTURE where PID='$pid'";
		$quDeletePicture = mysqli_query($dbh, $quStrDeletePicture) or die (mysqli_error($dbh));
	
		$quStrUpdateListing = "update CLASS set PIC=PIC-1 where CID='$cid'";
		$quUpdateListing = mysqli_query($dbh, $quStrUpdateListing) or die (mysqli_error($dbh));
	}
}elseif ($mode=='upload') {
	$listing_id = $_POST['listing_id'];
	$picture = $_FILES['picture'];
	$descript = $_POST['descript'];
	
	$some_split = split ("\.", $picture['name']);
	$ext = $some_split[1];
	
	if (!$picture['error']) {
		$quStrInsertPicture = "insert into PICTURE (CID, EXT, DESCRIPT, UID) values ('$listing_id', '$ext', '$descript', '$uid')";
		$quInsertPicture = mysqli_query($dbh, $quStrInsertPicture) or die (mysqli_error($dbh));
		$new_pid = mysqli_insert_id($dbh);
		
		$new_picture = "$picsDirectory$new_pid.$ext";
		move_uploaded_file ($picture['tmp_name'], $new_picture) or die ("yo");

		
		$quStrUpdateListing = "update CLASS set PIC=PIC+1 where CID='$listing_id'";
		$quUpdateListing = mysqli_query($dbh, $quStrUpdateListing) or die (mysqli_error($dbh));
		
	}
	
	
}elseif ($mode=="edit_descript") { 
	$pid = $_POST['pid'];
	$descript = $_POST['descript'];
	$listing_id = $_POST['listing_id'];
	
	$quStrUpdatePicture = "update PICTURE set DESCRIPT='$descript' where PID='$pid'";
	$quUpdatePicture = mysqli_query($dbh, $quStrUpdatePicture) or die (mysqli_error($dbh));
	
	
}
	



$quStrGetListing = "select * from CLASS inner join `GROUP` on CLASS.CLI=`GROUP`.GRID where CID='$listing_id'";
$quGetListing = mysqli_query($dbh, $quStrGetListing) or die (mysqli_error($dbh));
$rowGetListing = mysqli_fetch_object($quGetListing);
 
$quStrGetPicturesCount = "select count(PID) as picture_count from PICTURE where CID='$listing_id'";
$quGetPicturesCount = mysqli_query($dbh, $quStrGetPicturesCount) or die (mysqli_error($dbh));
$rowPicturesCount = mysqli_fetch_object($quGetPicturesCount);
$pictures_count = $rowPicturesCount->picture_count;

if ($pictures_count) {
	$word = "Upload and edit";
	$msg = "Edit existing and upload new Pictures here.";
	$quStrGetPictures = "select * from PICTURE where CID='$listing_id'";
	$quGetPictures = mysqli_query($dbh, $quStrGetPictures) or die (mysqli_error($dbh));
	
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
					<form enctype="multipart/form-data" name="listing_pictures_edit_form" method="post" action="listing_pictures_edit.php?mode=upload">
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
						Textural Description:
						</span>
						</td>
						<td valign="middle">
						<input type="text" name="descript">
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
				<script language="javascript">
				<!--
				function delete_pictures_form_submit() {
					if (confirm("Are you sure you want to delete these pictures?")) {
						document.forms.delete_pictures_form.submit();
					}
				}
				
				function reveal_size (id, real_width, real_height) {
					var img = document.getElementById(id);
					width = img.style.width;
					if (img.style.width == "145px") {
						img.style.width = real_width;
						img.style.height = real_height;
					}else {
						img.style.width = 145;
						img.style.height = 200;
					}
				}
				function restore_size (id) {
					var img = document.getElementById(id);
					img.style.width = 145;
					img.style.height = 200;
				}
				
				-->
				</script>
				<p class="text">
				Click on images to reveal actuall proportions. Click them again to return them to normalized sizes.<br>
				Mark checkboxs for each image and click "delete" to delete them.
				</p>
				<table cellpadding="4" cellspacing="0" border="0">
				<form name="delete_pictures_form" action="<?php echo $PHP_SELF . "?mode=delete";?>" method="POST">
				<input type="hidden" name="listing_id" value="<?php echo $listing_id;?>">
				<tr>
				<?php 
					$i = 0;
					while ($rowGetPictures = mysqli_fetch_object($quGetPictures)) {
						$i++;
						$picture_src = "../../pics/$rowGetPictures->PID.$rowGetPictures->EXT";
						$picture_path = "$picsDirectory$rowGetPictures->PID.$rowGetPictures->EXT";
						$image_size = getimagesize ($picture_path);
						$real_width = $image_size[0];
						$real_height = $image_size[1];
						?>                                         
						<td class="text"><span class="text"><?php echo $rowGetPictures->DESCRIPT;?> <a href="listing_picture_description_edit.php?pid=<?php echo $rowGetPictures->PID;?>">(Edit)</a></span><br><img style="width:145;height:200;" id="img_<?php echo $rowGetPictures->PID;?>" onClick="reveal_size('img_<?php echo $rowGetPictures->PID;?>',<?php echo $real_width;?>, <?php echo $real_height;?>);"  width="145" height="200" src="<?php echo $picture_src;?>"><br><input name="pid[]" type="checkbox" value="<?php echo $rowGetPictures->PID;?>">Delete</td>
					<?php
						if (!($i%4)) {
							echo "</tr><tr>";
						}
					}?>
				</tr>
				<tr>
				<td><input type="button" onClick="delete_pictures_form_submit();" value="delete"></td>
				</tr>
				</form>					
				</table>
				<?php } ?>
				
				</p>
				
<?php include("./includes/footer_admin.php");?>