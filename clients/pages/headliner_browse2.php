<?php 
//headliner_browse.php


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




$limit_n = 10;
$limit_start = ($page * $limit_n) - $limit_n;
$limit = "limit $limit_start, $limit_n";

$table_set = "headliners left join headliner_images on headliner_images.headliner=headliners.headliner_id";

$where = "where img_num<>'2' and headliners.GROUP=$grid";

$order_by = "order by date desc, headliner_id";

$quStrGetHeadlinerCount = "select count(headliner_id) as headliner_count from $table_set $where";
$quGetHeadlinerCount = mysqli_query($dbh, $quStrGetHeadlinerCount);
$rowGetHeadlinerCount = mysqli_fetch_object($quGetHeadlinerCount);
$headliner_count = $rowGetHeadlinerCount->headliner_count;

$quStrGetHeadliners = "select  * from $table_set $where $order_by $limit";
$quGetHeadliners = mysqli_query($dbh, $quStrGetHeadliners);




?>
<?php  // include("../includes/head_admin.php");?>

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
	<p><span class="bigtitle"><b>Manage Headliners</b></span></p>
  <p>Click the headliner to edit. The Headliners appear in alphabetical order. The designated headliner will appear on the home page. If no headliner is designated then the default home page will appear. The first 20 headliners will be current. The rest will be in the archive.</p>
<p>
<img src="../images/arrow.gif"><a href="./headliner_edit.php" class="menu">Create a new Headliner</a>
</p>
<p>
<?php
$display_bunch = $limit_start + $limit_n;
if ($display_bunch > $headliner_count) {
	$display_bunch = $headliner_count;
}
$display_start = $limit_start;
if ($display_start == 0) {
	$display_start = 1;
}

?>
Results <?php echo $display_start;?> - <?php echo $display_bunch;?> of <?php echo $headliner_count;?>
<?php if ($headliner_count > $limit_n) {?>
&nbsp;&nbsp;&nbsp;Go to page...
<?php $pageTop = ceil($headliner_count / $limit_n);
for ($i=1;$i <= $pageTop;$i++) {
	if ($page == $i) {
		echo "$i |";
	}else {?>
		<a href="<?php echo "$PHP_SELF?page=$i";?>"><?php echo $i;?></a> |
	<?php } ?>
<?php } ?>
&nbsp;&nbsp;&nbsp;<?php if (($page) < ($headliner_count / $limit_n)) {
	$nextPage = $page + 1;
	?>
	<a href="<?php echo "$PHP_SELF?page=$nextPage";?>">Next</a>
<?php } ?>
<?php }?>
<hr size="1" noshade></p>
	
	<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <?php while ($rowGetHeadliners = mysqli_fetch_object($quGetHeadliners)) {
  	$hid = $rowGetHeadliners->headliner_id;
  	if ($hid!==$last_hid) {
  	$img_id = $rowGetHeadliners->headliner_img_id;
  	$img_ext = $rowGetHeadliners->tn_portrait_ext;
  	//use tn_portait
  	$tn_portrait_path = "tn_portrait_img_$img_id.$img_ext";
  	$main_path = "img_$img_id.$rowGetHeadliners->ext";
  	$caption = "$rowGetHeadliners->body";
  	$is_designated = "$rowGetHeadliners->is_designated";
  ?>
  <tr>
  <td valign="top"><a href="./headliner_edit.php?hid=<?php echo $rowGetHeadliners->headliner_id;?>" target="new"><img src="../headliner_images/<?php echo $tn_portrait_path;?>" border="0" width="<?php echo $HEADLINER_TN_PORTRAIT_WIDTH;?>" height="<?php echo $HEADLINER_TN_PORTRAIT_HEIGHT;?>" ></a></td>
  <td width="162" valign="middle"><span class="caption"><?php echo $caption;?></span></td>
  <td valign="middle"><span class="menu"><a href="headliner_edit.php?hid=<?php echo $rowGetHeadliners->headliner_id;?>">edit</a></span></td>
  <td valign="middle"><span class="menu"><?php if ($is_designated) { echo "(Currently appears on home page)";} else { echo "&nbsp;";}?></span></td>
  </tr>
  <tr>
  <td colspan="4"><hr size="1" noshade></td>
  </tr>
  
<?php
	$last_hid = $hid;
 	}
} 

?>

</table>

Results <?php echo $display_start;?> - <?php echo $display_bunch;?> of <?php echo $headliner_count;?>
<?php if ($headliner_count > $limit_n) {?>
&nbsp;&nbsp;&nbsp;Go to page...
<?php $pageTop = ceil($headliner_count / $limit_n);
for ($i=1;$i <= $pageTop;$i++) {
	if ($page == $i) {
		echo "$i |";
	}else {?>
		<a href="<?php echo "$PHP_SELF?page=$i";?>"><?php echo $i;?></a> |
	<?php } ?>
<?php } ?>
&nbsp;&nbsp;&nbsp;<?php if (($page) < ($headliner_count / $limit_n)) {
	$nextPage = $page + 1;
	?>
	<a href="<?php echo "$PHP_SELF?page=$nextPage";?>">Next</a>
<?php } ?>
<?php }?>


	          </td>
</tr>

</table>  
<?php // include("../includes/footer_admin.php");?>

