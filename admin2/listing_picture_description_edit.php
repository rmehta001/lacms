<?php 
session_start();
include ("./inc/admin_key.php");
?>
<?php
$picture_id = $_GET['pid'];

$quStrGetPicture = "select * from PICTURE where PID='$picture_id'";
$quGetPicture = mysqli_query($dbh,$quStrGetPicture) or die(mysqli_error($dbh));
$rowGetPicture = mysqli_fetch_object($quGetPicture);

$listing_id = $rowGetPicture->CID;


$quStrGetListing = "select * from CLASS inner join `GROUP` on CLASS.CLI=`GROUP`.GRID where CID='$listing_id'";
$quGetListing = mysqli_query($dbh,$quStrGetListing) or die (mysqli_error());
$rowGetListing = mysqli_fetch_object($quGetListing);
 
$msg = "Edit a picture's description here.";

$action = "edit";



?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				Edit Picture Description.
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
				<script language="javascript">
				<!--
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
				-->
				</script>
				
				
				
				
				
				<table width="100%" cellpadding="4" cellspacing="0" border="0">	
					<form name="listing_pictures_edit_form" method="post" action="listing_pictures_edit.php?mode=edit_descript">
					<input type="hidden" name="pid" value="<?php echo $picture_id;?>">
					<input type="hidden" name="listing_id" value="<?php echo $listing_id;?>">
					
					<?php
					$picture_src = "../../pics/$rowGetPicture->PID.$rowGetPicture->EXT";
					$picture_path = "$picsDirectory/$rowGetPicture->PID.$rowGetPicture->EXT";
					$image_size = getimagesize ($picture_path);
					$real_width = $image_size[0];
					$real_height = $image_size[1];
					?>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						&nbsp;
						</span>
						</td>
						<td class="text"><img style="width:145;height:200;" id="img_<?php echo $rowGetPicture->PID;?>" onClick="reveal_size('img_<?php echo $rowGetPicture->PID;?>',<?php echo $real_width;?>, <?php echo $real_height;?>);"  width="145" height="200" src="<?php echo $picture_src;?>"></td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Textural Description:
						</span>
						</td>
						<td valign="middle">
						<input type="text" name="descript" value="<?php echo $rowGetPicture->DESCRIPT;?>">
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
				</p>
				
<?php include("./includes/footer_admin.php");?>