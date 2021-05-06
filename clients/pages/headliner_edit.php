<?php 
//headliner_edit.php

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



$hid = $HTTP_GET_VARS['hid'];

$order_by = "order by img_num";

$table_set = "headliners left join headliner_images on headliner_images.headliner=headliners.headliner_id";
if ($hid) {
	$word = "edit";
	$quStrGetHeadliner = "select * from $table_set where headliner_id='$hid' $order_by";
	$quGetHeadliner = mysqli_query($dbh, $quStrGetHeadliner) or die(mysqli_error($dbh));
	//die ($quStrGetHeadliner);
	$rowGetHeadliner = mysqli_fetch_object($quGetHeadliner);
}else {
	$word = "create";
}



?>
<?php include("../includes/head_admin.php");?>

  
  <tr>
    <td valign="top" colspan="3" bgcolor="#ffffff">
	<table width="100%" border="0" cellpadding="8" cellspacing="0">
  <tr>
    <td valign="top" class="text">
	<p><span class="bigtitle"><b><?php echo ucwords($word);?> Headliner</b></span></p>

<p>
	<?php if ($hid) {?>
	Feel free to edit this headliner below. In order to replace images you must replace <b>all three</b> images.
	<?php }else { ?>
	Create a new headliner by completing the form below. The headliners will appear in chronological order by date. You can designate one headliner only to appear as a promotion from the home page.
	<?php }?>
	</p>
	<p>
	(<b>*bolded</b> fields are required)</p>
	<table border="0" cellpadding="1" cellspacing="0" width="100%">
 <form name="<a href="<?php echo "$PHP_SELF?op=headliner_edit";?>" enctype="multipart/form-data" action="<?php echo "$PHP_SELF?op=headliner_save";?>" method="post">
 <input type="hidden" name="hid" value="<?php echo $hid;?>">
<?php
if ($hid) {
	$month = substr($rowGetHeadliner->date, 5,2);
	$day = substr($rowGetHeadliner->date, 8,2);
	$year = substr($rowGetHeadliner->date, 0,4);
}else {
	$month = date ("m");
	$day = date ("d");
	$year = date ("Y");
}
?>
<tr>
    <td valign="top" class="footer" align="right"><input name="is_designated" type="checkbox" value="1" <?php if ($rowGetHeadliner->is_designated) { echo " checked ";}?>></td>
    <td valign="top" class="footer">Make this the home page headliner.</td>
  </tr>
   <tr>
  <td colspan="2"><hr size="1" noshade width="100%"></td></tr>
 <tr>
    <td valign="top" class="footer" align="right"><b>*Date:</b></td>
    <td valign="top"><select name="month">
	<option value="1" <?php if ($month==1) { echo " selected"; }?>>January</option>
	<option value="2" <?php if ($month==2) { echo " selected"; }?>>February</option>
	<option value="3" <?php if ($month==3) { echo " selected"; }?>>March</option>
	<option value="4" <?php if ($month==4) { echo " selected"; }?>>April</option>
	<option value="5" <?php if ($month==5) { echo " selected"; }?>>May</option>
	<option value="6" <?php if ($month==6) { echo " selected"; }?>>June</option>
	<option value="7" <?php if ($month==7) { echo " selected"; }?>>July</option>
	<option value="8" <?php if ($month==8) { echo " selected"; }?>>August</option>
	<option value="9" <?php if ($month==9) { echo " selected"; }?>>September</option>
	<option value="10" <?php if ($month==10) { echo " selected"; }?>>October</option>
	<option value="11" <?php if ($month==11) { echo " selected"; }?>>November</option>
	<option value="12" <?php if ($month==12) { echo " selected"; }?>>December</option>
	</select>
	&nbsp;
	<select name="day">
	<option value="1" <?php if ($day==1) { echo " selected"; }?>>1</option>
	<option value="2" <?php if ($day==2) { echo " selected"; }?>>2</option>
	<option value="3" <?php if ($day==3) { echo " selected"; }?>>3</option>
	<option value="4" <?php if ($day==4) { echo " selected"; }?>>4</option>
	<option value="5" <?php if ($day==5) { echo " selected"; }?>>5</option>
	<option value="6" <?php if ($day==6) { echo " selected"; }?>>6</option>
	<option value="7" <?php if ($day==7) { echo " selected"; }?>>7</option>
	<option value="8" <?php if ($day==8) { echo " selected"; }?>>8</option>
	<option value="9" <?php if ($day==9) { echo " selected"; }?>>9</option>
	<option value="10" <?php if ($day==10) { echo " selected"; }?>>10</option>
	<option value="11" <?php if ($day==11) { echo " selected"; }?>>11</option>
	<option value="12" <?php if ($day==12) { echo " selected"; }?>>12</option>
	<option value="13" <?php if ($day==13) { echo " selected"; }?>>13</option>
	<option value="14" <?php if ($day==14) { echo " selected"; }?>>14</option>
	<option value="15" <?php if ($day==15) { echo " selected"; }?>>15</option>
	<option value="16" <?php if ($day==16) { echo " selected"; }?>>16</option>
	<option value="17" <?php if ($day==17) { echo " selected"; }?>>17</option>
	<option value="18" <?php if ($day==18) { echo " selected"; }?>>18</option>
	<option value="19" <?php if ($day==19) { echo " selected"; }?>>19</option>
	<option value="20" <?php if ($day==20) { echo " selected"; }?>>20</option>
	<option value="21" <?php if ($day==21) { echo " selected"; }?>>21</option>
	<option value="22" <?php if ($day==22) { echo " selected"; }?>>22</option>
	<option value="23" <?php if ($day==23) { echo " selected"; }?>>23</option>
	<option value="24" <?php if ($day==24) { echo " selected"; }?>>24</option>
	<option value="25" <?php if ($day==25) { echo " selected"; }?>>25</option>
	<option value="26" <?php if ($day==26) { echo " selected"; }?>>26</option>
	<option value="27" <?php if ($day==27) { echo " selected"; }?>>27</option>
	<option value="28" <?php if ($day==28) { echo " selected"; }?>>28</option>
	<option value="29" <?php if ($day==29) { echo " selected"; }?>>29</option>
	<option value="30" <?php if ($day==30) { echo " selected"; }?>>30</option>
	<option value="31" <?php if ($day==31) { echo " selected"; }?>>31</option>
	</select>
	&nbsp;
	<select name="year">
	<?php 
	if (!$hid) {
		$old_year = date("Y") - 10;
		$this_year = date ("Y");
		for ($i=$old_year;$i <= $this_year;$i++) {?>
			<option value="<?php echo $i;?>" <?php if ($i==$this_year) {echo " selected ";}?>><?php echo $i;?></option>
		<?php }
	}else {
		$old_year = $year - 10;
		$this_year = date ("Y");
		for ($i=$old_year;$i <= $this_year;$i++) {?>
			<option value="<?php echo $i;?>" <?php if ($i==$year) {echo " selected ";}?>><?php echo $i;?></option>
		<?php }
	}?>
	</select>
	</td>
  </tr>
  
 <tr>
    <td valign="top" class="footer" align="right"><P><BR><b>*Headline:</b></td>
    <td valign="top"><P><BR>
<textarea id="body" name="body" cols="30" rows="10"><?php echo htmlspecialchars($rowGetHeadliner->body);?></textarea>
<script language="JavaScript">
   generate_wysiwyg('body');
 </script>




</td>
  </tr>
  <tr>
    <td valign="top" class="subtitle"><b>*Images</b></td>
    <td valign="top">
 <tr>
  <td colspan="2"><hr size="1" noshade width="100%"></td></tr>
  <?php if ($rowGetHeadliner->headliner_img_id) {
  	$img_id = $rowGetHeadliner->headliner_img_id;
  	$main_ext = $rowGetHeadliner->ext;
  	$main_path = "img_$img_id.$main_ext";
  ?>
  <tr>
  <td colspan="2">
  <img src="../headliner_images/<?php echo $main_path;?>" height="<?php echo $rowGetHeadliner->height;?>" width="<?php echo $rowGetHeadliner->width;?>"><br>
  </td>
  </tr>
  <?php }?>
  
  <tr>
    <td valign="top" class="footer" colspan="2"><b><?php if ($rowGetHeadliner->headliner_img_id) { echo "Replace";} else { echo "Add a";} ?> Main Image:</b></td>
    
  </tr>
 
  <tr>
    <td valign="top" class="footer" align="right"><b>*File Path:</b></td>
    <td valign="top">
	<input id="main_file_one" name="main_file_one" type="file">
	</td>
  </tr>
  <?php if ($rowGetHeadliner->headliner_img_id) {
  	$tn_ln_ext = $rowGetHeadliner->tn_landscape_ext;
  	$tn_landscape_img = "tn_landscape_img_$img_id.$tn_ln_ext";
  ?>
  <tr>
  <td colspan="2">
  <img src="../headliner_images/<?php echo $tn_landscape_img;?>" width="<?php echo $HEADLINER_TN_LANDSCAPE_WIDTH;?>" height="<?php echo $HEADLINER_TN_LANDSCAPE_HEIGHT;?>"><br>
  </td>
  </tr>
  <?php } ?>
  <tr>
    <td valign="top" class="footer" colspan="2"><b><?php if ($rowGetHeadliner->headliner_img_id) { echo "Replace";} else { echo "Add a";} ?> Landscape Thumb</b> (Optimum Image Width:<?php echo $HEADLINER_TN_LANDSCAPE_WIDTH;?>px, Height:<?php echo $HEADLINER_TN_LANDSCAPE_HEIGHT;?>px):</td>
    
  </tr>
  <tr>
    <td valign="top" class="footer" align="right"><b>*File Path:</b></td>
    <td valign="top">
	<input id="tn_landscape_one" name="tn_landscape_one" type="file">
	</td>
  </tr>
  <?php if ($rowGetHeadliner->headliner_img_id) {
  	$tn_pt_ext = $rowGetHeadliner->tn_portrait_ext;
  	$tn_portrait_img = "tn_portrait_img_$img_id.$tn_ln_ext";
  ?>
  <tr>
  <td colspan="2">
  <img src="../headliner_images/<?php echo $tn_portrait_img;?>" width="<?php echo $HEADLINER_TN_PORTRAIT_WIDTH;?>" height="<?php echo $HEADLINER_TN_PORTRAIT_HEIGHT;?>"><br>
  </td>
  </tr>
  <?php } ?>
  <tr>
    <td valign="top" class="footer" colspan="2"><b><?php if ($rowGetHeadliner->headliner_img_id) { echo "Replace";} else { echo "Add a";} ?> Portrait Thumb</b> (Optimum Image Width:<?php echo $HEADLINER_TN_PORTRAIT_WIDTH;?>px, Height:<?php echo $HEADLINER_TN_PORTRAIT_HEIGHT;?>px):</td>
    
  </tr>
  <tr>
    <td valign="top" class="footer" align="right"><b>*File Path:</b></td>
    <td valign="top">
	<input id="tn_portrait_one" name="tn_portrait_one" type="file">
	</td>
  </tr>
  <tr>
  <td colspan="2">
  <hr size="1" noshade width="100%">
  </td>
  </tr>
  <?php 
  $another_image = @mysqli_data_seek($quGetHeadliner,1);
  if ($another_image) {
  	$rowGetAnotherHeadliner = mysqli_fetch_object($quGetHeadliner);
  }
  ?>
  <?php if ($rowGetAnotherHeadliner->headliner_img_id) {
  	$img_id = $rowGetAnotherHeadliner->headliner_img_id;
  	$main_ext = $rowGetAnotherHeadliner->ext;
  	$main_path = "img_$img_id.$main_ext";
  ?>
 
  <tr>
  <td colspan="2">
  <img src="../headliner_images/<?php echo $main_path;?>" height="<?php echo $rowGetAnotherHeadliner->height;?>" width="<?php echo $rowGetAnotherHeadliner->width;?>"><br>
  </td>
  </tr>
  <?php }?>
  <tr>
    <td valign="top" class="subtitle" colspan="2"><b><?php if ($rowGetAnotherHeadliner->headliner_img_id) { echo "Replace";} else { echo "Add an";} ?> Additional Image:</b></td>
    
  </tr>
 
  <tr>
    <td valign="top" class="footer" align="right"><b>*File Path:</b></td>
    <td valign="top">
	<input name="main_file_two" type="file">
	</td>
  </tr>
  <?php if ($rowGetAnotherHeadliner->headliner_img_id) {
  	$tn_ln_ext = $rowGetAnotherHeadliner->tn_landscape_ext;
  	$tn_landscape_img = "tn_landscape_img_$img_id.$tn_ln_ext";
  ?>
  <tr>
  <td colspan="2">
  <img src="../headliner_images/<?php echo $tn_landscape_img;?>" width="<?php echo $HEADLINER_TN_LANDSCAPE_WIDTH;?>" height="<?php echo $HEADLINER_TN_LANDSCAPE_HEIGHT;?>"><br>
  </td>
  </tr>
  <?php } ?>
  <tr>
    <td valign="top" class="footer" colspan="2"><b><?php if ($rowGetAnotherHeadliner->headliner_img_id) { echo "Replace";} else { echo "Add an";} ?> Additional Landscape Thumb</b> (Optimum Image Width:<?php echo $HEADLINER_TN_LANDSCAPE_WIDTH;?>px, Height:<?php echo $HEADLINER_TN_LANDSCAPE_HEIGHT;?>px):</td>
    
  </tr>
  <tr>
    <td valign="top" class="footer" align="right"><b>*File Path:</b></td>
    <td valign="top">
	<input name="tn_landscape_two" type="file">
	</td>
  </tr>
   <?php if ($rowGetAnotherHeadliner->headliner_img_id) {
  	$tn_pt_ext = $rowGetAnotherHeadliner->tn_portrait_ext;
  	$tn_portrait_img = "tn_portrait_img_$img_id.$tn_ln_ext";
  ?>
  <tr>
  <td colspan="2">
  <img src="../headliner_images/<?php echo $tn_portrait_img;?>" width="<?php echo $HEADLINER_TN_PORTRAIT_WIDTH;?>" height="<?php echo $HEADLINER_TN_PORTRAIT_HEIGHT;?>"><br>
  </td>
  </tr>
  <?php } ?>
  <tr>
    <td valign="top" class="footer" colspan="2"><b><?php if ($rowGetAnotherHeadliner->headliner_img_id) { echo "Replace";} else { echo "Add an";} ?> Additional Portrait Thumb</b> (Optimum Image Width:<?php echo $HEADLINER_TN_PORTRAIT_WIDTH;?>px, Height:<?php echo $HEADLINER_TN_PORTRAIT_HEIGHT;?>px):</td>
    
  </tr>
  <tr>
    <td valign="top" class="footer" align="right"><b>*File Path:</b></td>
    <td valign="top">
	<input name="tn_portrait_two" type="file">
	</td>
  </tr>  
   
  <tr>
  <td colspan="2"><hr size="1" noshade width="100%"></td></tr>
  
  <tr>
    <td valign="top" align="right">&nbsp;</td>
    <?php 
    if ($hid) {
    	$action = "Update";
    }else {
    	$action = "Create Headliner";
    }
    ?>
    <td valign="top"><input onClick="headliner_edit_form_submit();" type="submit" value="<?php echo $action;?>">
	<p>
	<?php if ($hid) {?>
	<input name="delete" type="checkbox" value="1"> Delete this headliner.
	<?php }?>
	</p></td>
 
 
  
  </tr>
  </form>
</table>

	          </td>
</tr>

</table>  
<?php include("../includes/footer_admin.php");?>
