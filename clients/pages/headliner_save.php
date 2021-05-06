<?php 
//headliner_save.php

//required image dimensions//
$BAM_TN_LANDSCAPE_WIDTH = 193;
$BAM_TN_LANDSCAPE_HEIGHT = 200;
$BAM_TN_PORTRAIT_WIDTH = 120;
$BAM_TN_PORTRAIT_HEIGHT = 120;
$HEADLINER_TN_LANDSCAPE_WIDTH = 193;
$HEADLINER_TN_LANDSCAPE_HEIGHT = 200;
$HEADLINER_TN_PORTRAIT_WIDTH = 120;
$HEADLINER_TN_PORTRAIT_HEIGHT = 120;
$RUNWAY_TN_LANDSCAPE_WIDTH = 193;
$RUNWAY_TN_LANDSCAPE_HEIGHT = 200;
$RUNWAY_TN_PORTRAIT_WIDTH = 120;
$RUNWAY_TN_PORTRAIT_HEIGHT = 120;
$MODEL_DETAIL_WIDTH = 234;
$MODEL_DETAIL_HEIGHT = 250;
$MODEL_TN_WIDTH = 80;
$MODEL_TN_HEIGHT = 120;
$MODEL_TN_SM_WIDTH = 30;
$MODEL_TN_SM_HEIGHT = 45;




$hid = $_POST['hid'];

$body = $_POST['body'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$date = $year . "-" . $month . "-" . $day;
$is_designated = $_POST['is_designated'];

if ($hid) {
	if ($_POST['delete']) {
		$delete = true;
		//this is a delete//
		$quStrDeleteHeadliner = "delete from headliners where headliner_id='$hid' and headliners.GROUP=$grid";
		$quDeleteHeadliner = mysqli_query($dbh, $quStrDeleteHeadliner);
		
		$quStrGetHeadlinerImages = "select * from headliner_images where headliner='$hid' and headliners.GROUP=$grid";
		$quGetHeadlinerImages = mysqli_query($dbh, $quStrGetHeadlinerImages);
		while ($rowGetHeadlinerImages = mysqli_fetch_object($quGetHeadlinerImages)) {
			$del_img_id = $rowGetHeadlinerImages->headliner_img_id;
			$del_main_ext = $rowGetHeadlinerImages->ext;
			$del_main_img = "../headliner_images/img_$del_img_id.$del_main_ext";
			$del_tn_ln_ext = $rowGetHeadlinerImages->tn_landscape_ext;
			$del_tn_ln_img ="../headliner_images/tn_landscape_img_$del_img_id.$del_tn_ln_ext";
			$del_tn_pt_ext = $rowGetHeadlinerImages->tn_portrait_ext;
			$del_tn_pt_img ="../headliner_images/tn_portrait_img_$del_img_id.$del_tn_pt_ext";
			
			@unlink($del_main_img);
			@unlink($del_tn_ln_img);
			@unlink($del_tn_pt_img);
		}
		$quStrDeleteHeadlinerImages = "delete from headliner_images where headliner='$hid' and headliners.GROUP=$grid";
		$quDeleteHeadlinerImages = mysqli_query($dbh, $quStrDeleteHeadlinerImages) or die(mysqli_error($dbh));
		$msg = "Thank you, the headliner has been deleted.";
		$word = "delete";
		
	}else {
		if ($is_designated) {
			$quStrUpdateHeadliners = "update headliners set is_designated='0'";
			$quUpdateHeadliners = mysqli_query($dbh, $quStrUpdateHeadliners);
		}
		//this is an edit//
		$quStrUpdateHeadliner = "update headliners set body='$body', date='$date', is_designated='$is_designated' where headliner_id='$hid' and headliners.GROUP=$grid";
		$quUpdateHeadliner = mysqli_query($dbh, $quStrUpdateHeadliner);
		$msg = "Thank you, your edits have been made.";
		$word = "edit";  
	}
}else {
	if ($is_designated) {
			$quStrUpdateHeadliners = "update headliners set is_designated='0'";
			$quUpdateHeadliners = mysqli_query($dbh, $quStrUpdateHeadliners);
	}
	//this is a create//
	$quStrInsertHeadliner = "insert into headliners (body, date, is_designated, headliners.GROUP) values ('$body', '$date', '$is_designated', '$grid')";
	$quInsertHeadliner = mysqli_query($dbh, $quStrInsertHeadliner);
	$hid = mysqli_insert_id($dbh);
	$msg = "Thank you, your headliner has been created.";
	$word = "create";
}

/*  WHY DID I MAKE ALL THIS CODE?  ???? /// :(
$quStrCheckDesignated = "select * from headliners where is_designated='1'";
$quCheckDesignated = mysqli_query($dbh, $quStrCheckDesignated);
$rowCheckDesignated = mysqli_fetch_object($quCheckDesignated);
if (!$rowCheckDesignated->headliner_id) {
	$quStrGetLatestHeadliner = "select * from headliners where headliner_id<>'$hid' order by date limit 1";
	$quGetLatestHeadliner = mysqli_query($dbh, $quStrGetLatestHeadliner);
	$rowGetLatestHeadliner = mysqli_fetch_object($quGetLatestHeadliner);
	$latest_id = $rowGetLatestHeadliner->headliner_id;
	
	$quStrUpdateLatest = "update headliners set is_designated='1' where headliner_id='$latest_id'";
	$quUpdateLatest = mysqli_query($dbh, $quStrUpdateLatest);
}
*/

//images//
$existing_img = 0;
if(!$delete) {
	
	//insert image one
	if(!$_FILES['main_file_one']['error'] && !$_FILES['tn_portrait_one']['error'] && !$_FILES['tn_landscape_one']['error']) {
		$name_main = $_FILES['main_file_one']['name'];
		$name_tn_ln = $_FILES['tn_landscape_file_one']['name'];
		$name_tn_pt = $_FILES['tn_portrait_file_one']['name'];
		if ((!strpos($name_main, ".gif")) && (!strpos($name_main, ".GIF")) && (!strpos($name_tn_ln, ".gif")) && (!strpos($name_tn_ln, ".GIF")) && (!strpos($name_tn_pt, ".gif")) && (!strpos($name_tn_pt, ".GIF")))  {
			$quStrDeleteExistingImage = "delete from headliner_images where headliner='$hid' and headliners.GROUP=$grid and img_num='1'";
			$quDeleteExistingImage = mysqli_query($dbh, $quStrDeleteExistingImage);
			$main_tmp_img = $_FILES['main_file_one']['tmp_name'];
			$tn_ln_tmp_img = $_FILES['tn_landscape_one']['tmp_name'];
			$tn_pt_tmp_img = $_FILES['tn_portrait_one']['tmp_name'];
			$main_img_info = getimagesize($main_tmp_img);
			$tn_ln_img_info = getimagesize($tn_ln_tmp_img);
			$tn_pt_img_info = getimagesize($tn_pt_tmp_img);
				
			$main_width = $main_img_info[0];
			$main_height = $main_img_info[1];
			$main_type = $main_img_info[2];
			$tn_ln_type = $tn_ln_img_info[2];
			$tn_pt_type = $tn_pt_img_info[2];
			if ($main_type==1) {
				$main_ext = "gif";
			}elseif ($main_type==2) {
				$main_ext = "jpg";
			}elseif ($main_type==3) {
				$main_ext = "png";
			}
			if ($tn_ln_type==1) {
				$tn_ln_ext = "gif";
			}elseif ($tn_ln_type==2) {
				$tn_ln_ext = "jpg";
			}elseif ($tn_ln_type==3) {
				$tn_ln_ext = "png";
			}
			if ($tn_pt_type==1) {
				$tn_pt_ext = "gif";
			}elseif ($tn_pt_type==2) {
				$tn_pt_ext = "jpg";
			}elseif ($tn_pt_type==3) {
				$tn_pt_ext = "png";
			}
			$quStrInsertHeadlinerImages = "insert into headliner_images (headliner, img_num, height, width, ext, tn_landscape_ext, tn_portrait_ext, headliner_images.GROUP) values ('$hid', '1', '$main_height', '$main_width', '$main_ext', '$tn_ln_ext', '$tn_pt_ext', '$grid')";
			$quInsertHeadlinerImages = mysqli_query($dbh, $quStrInsertHeadlinerImages) or die ($quStrInsertHeadlinerImages);
			$headliner_img_id = mysqli_insert_id($dbh);
			$main_img_path = "../../headliner_images/img_$headliner_img_id.$main_ext";
			$tn_ln_img_path = "../../headliner_images/tn_landscape_img_$headliner_img_id.$tn_ln_ext";
			$tn_pt_img_path = "../../headliner_images/tn_portrait_img_$headliner_img_id.$tn_pt_ext";
				
			copy ($main_tmp_img, $main_img_path) or die ("Can't Copy Nothing");
			copy ($tn_ln_tmp_img, $tn_ln_img_path)or die ("Can't Copy Nothing");
			copy ($tn_pt_tmp_img, $tn_pt_img_path)or die ("Can't Copy Nothing");
		}else {
			$set_one_err = true;
		}
	}
	//insert image two
	if(!$_FILES['main_file_two']['error'] && !$_FILES['tn_portrait_two']['error'] && !$_FILES['tn_landscape_two']['error']) {
		$name_main = $_FILES['main_file_two']['name'];
		$name_tn_ln = $_FILES['tn_landscape_file_two']['name'];
		$name_tn_pt = $_FILES['tn_portrait_file_two']['name'];
		if ((!strpos($name_main, ".gif")) && (!strpos($name_main, ".GIF")) && (!strpos($name_tn_ln, ".gif")) && (!strpos($name_tn_ln, ".GIF")) && (!strpos($name_tn_pt, ".gif")) && (!strpos($name_tn_pt, ".GIF")))  {
			$quStrDeleteExistingImage = "delete from headliner_images where headliner='$hid' and headliners.GROUP=$grid and img_num='2'";
			$quDeleteExistingImage = mysqli_query($dbh, $quStrDeleteExistingImage);
			$main_tmp_img = $_FILES['main_file_two']['tmp_name'];
			$tn_ln_tmp_img = $_FILES['tn_landscape_two']['tmp_name'];
			$tn_pt_tmp_img = $_FILES['tn_portrait_two']['tmp_name'];
			$main_img_info = getimagesize($main_tmp_img);
			$tn_ln_img_info = getimagesize($tn_ln_tmp_img);
			$tn_pt_img_info = getimagesize($tn_pt_tmp_img);
				
			$main_width = $main_img_info[0];
			$main_height = $main_img_info[1];
			$main_type = $main_img_info[2];
			$tn_ln_type = $tn_ln_img_info[2];
			$tn_pt_type = $tn_pt_img_info[2];
			if ($main_type==1) {
				$main_ext = "gif";
			}elseif ($main_type==2) {
				$main_ext = "jpg";
			}elseif ($main_type==3) {
				$main_ext = "png";
			}
			if ($tn_ln_type==1) {
				$tn_ln_ext = "gif";
			}elseif ($tn_ln_type==2) {
				$tn_ln_ext = "jpg";
			}elseif ($tn_ln_type==3) {
				$tn_ln_ext = "png";
			}
			if ($tn_pt_type==1) {
				$tn_pt_ext = "gif";
			}elseif ($tn_pt_type==2) {
				$tn_pt_ext = "jpg";
			}elseif ($tn_pt_type==3) {
				$tn_pt_ext = "png";
			}
			$quStrInsertHeadlinerImages = "insert into headliner_images (headliner, img_num, height, width, ext, tn_landscape_ext, tn_portrait_ext, headliner_images.GROUP) values ('$hid', '2', '$main_height', '$main_width', '$main_ext', '$tn_ln_ext', '$tn_pt_ext', '$grid')";
			$quInsertHeadlinerImages = mysqli_query($dbh, $quStrInsertHeadlinerImages) or die ($quStrInsertHeadlinerImages);
			$headliner_img_id = mysqli_insert_id($dbh);
			$main_img_path = "../../headliner_images/img_$headliner_img_id.$main_ext";
			$tn_ln_img_path = "../../headliner_images/tn_landscape_img_$headliner_img_id.$tn_ln_ext";
			$tn_pt_img_path = "../../headliner_images/tn_portrait_img_$headliner_img_id.$tn_pt_ext";
				
			copy ($main_tmp_img, $main_img_path);
			copy ($tn_ln_tmp_img, $tn_ln_img_path);
			copy ($tn_pt_tmp_img, $tn_pt_img_path);
		}else {
			$set_two_err = true;
		}
	}

}	
		
		

		
	



?>
<?php // include("../includes/head_admin.php");?>

  <!-- <tr bgcolor="#ffffff">
    <td valign="top" colspan="3" class="menu">
	<a href="getting_started.php">Getting Started</a> | <a href="booking_information.php">Booking Information</a> | <a href="our_clients.php">Our Clients</a> | <a href="contact_us.php">Contact Us</a>
	</td>
  </tr> -->
  <tr>
    <td valign="top" colspan="3" bgcolor="#ffffff">
	<table width="100%" border="0" cellpadding="8" cellspacing="0">
  <tr>
    <td valign="top" class="text">
	<p><span class="bigtitle"><b><?php echo ucwords($word);?> Headliners</b></span></p>

<p>
	<?php echo $msg;?>
	</p>
	<p>
<img src="../images/arrow.gif"><a href="<?php echo "$PHP_SELF?op=headliner_browse";?>" class="menu">Back to Manage Headliners</a>
</p>

	          </td>
</tr>

</table>  
<?php include("../includes/footer_admin.php");?>