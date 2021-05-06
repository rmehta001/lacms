<?php 
session_start();
include ("./inc/admin_key.php");



//DEFINED VALUE SETS //
$quStrGetValueDefs = "SELECT * FROM VALUE_DEFINE";
$quGetValueDefs = mysqli_query($dbh,$quStrGetValueDefs);

while ($rowGetValueDefs = mysqli_fetch_object($quGetValueDefs)) {
	$string = $rowGetValueDefs->DEFINE;
	$values = explode (",", $string);
	foreach ($values as $key => $value) {
		$values2[$key] = explode ("_", $value);
	}
	foreach ($values2 as $values3) {
		$offset = $values3[0];
		$DEFINED_VALUE_SETS[$rowGetValueDefs->CLASS_NAME][$offset] = $values3[1];
	}
	
	$string = false;
	$values = false;
	$values2 = false;
	$values3 = false;
	$offset = false;
	
	
}

$nowYmd = date("Ymd");

if ($_POST['search_for']) {
	$search_for = $_POST['search_for'];
}

if ($_POST['replace_with']) {
	$replace_with = $_POST['replace_with'];
}

session_register ("listings_page");
if ($_GET['listings_page']) {
	$listings_page = $_GET['listings_page'];
}else {
	if (!$listings_page) { 
		$listings_page = 1;
	}
}




//WHERE 
$where = "where  match (ALTSIG,BODY) against ('$search_for')";

//LIMIT
$limit_n = 50;
$limit_start = ($listings_page * $limit_n) - $limit_n;
$limit = "limit $limit_start, $limit_n";

//ORDER BY
$order_by = "order by score desc";

//FROM
$table_set = "((((CLASS inner join LOC on CLASS.LOC=LOC.LOCID) inner join `GROUP` on CLASS.CLI=`GROUP`.GRID) inner join TYPES on CLASS.TYPE=TYPES.TYPE) inner join USERS on CLASS.UID=USERS.UID)";



$replace = $_POST['replace'];
if ($replace=="n") {
	$replace = false;
}
if ($replace) {
	$quStrGetListings = "select  * ,  match (ALTSIG, BODY) against ('$search_for') as score from $table_set $where $order_by $limit";
	$quGetListings = mysqli_query($dbh, $quStrGetListings) or die (mysqli_error($dbh));
	while ($rowGetListing = mysqli_fetch_object($quGetListings)) {
		$replace_with = stripslashes ($replace_with);
		$replace_with = str_replace("\"", "", $replace_with);
		$listing_id = $rowGetListing->CID;
		$old_body = $rowGetListing->BODY;
		$new_body = str_replace ($search_for, $replace_with, $old_body);
		$new_body = mysqli_real_escape_string($dbh, $new_body);
		
		$quStrUpdateClass = "update CLASS set BODY='$new_body' where CID='$listing_id'";
		$quUpdateClass = mysqli_query($dbh, $quStrUpdateClass) or die (mysqli_error($dbh));
		$replaced++;
	}
	$old_replace_with = $replace_with;
	$replace_with = $search_for;
	$search_for = $old_replace_with;
	
}

$quStrGetListings = "select  * ,  match (ALTSIG, BODY) against ('$search_for') as score from $table_set $where $order_by $limit";
$quGetListings = mysqli_query($dbh, $quStrGetListings) or die (mysqli_error($dbh));

$quStrGetCount = "select count(CID) as listings_count from $table_set $where";
$quGetCount = mysqli_query($dbh, $quStrGetCount) or die (mysqli_error($dbh));
$rowGetCount = mysqli_fetch_object($quGetCount);
$listings_count = $rowGetCount->listings_count;


$search_for = stripslashes ($search_for);
$replace_with = stripslashes ($replace_with);

?>

<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				Full Text Search
				</span><br>
				<span class="text">Use this form to correct spelling and grammar mistakes or search for certain words or phrases.</span>
				</p>
<br>
<br>
<div style="border:1px solid black;width:400px;">
<table width="75%" border="0">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <tr> 
    <td width="50" class="subhead" valign="top">Search for:</td>
    <td class="fineprint" valign="top"><textarea cols="30" rows="2" name="search_for"><?php echo $search_for;?></textarea></td>
  </tr>
  <tr>
  	<td class="fineprint" valign="top">&nbsp;</td>
  	<td class="fineprint" valign="top">Boolean operators permitted. Finds occurences in the BODY and ALTSIG fields. Examples:  "Use quotes to delimit phrases" or do "not" and each word will be searched for seperatly</td>
  </tr>
  <tr> 
    <td width="50" class="subhead" valign="top">Replace with:</td>
    <td valign="top"><textarea cols="30" rows="2" name="replace_with"><?php echo $replace_with;?></textarea></td>
  </tr>
  <tr>
  	<td class="fineprint" valign="top">&nbsp;</td>
  	<td class="fineprint" valign="top">Boolean operators <i>NOT</i> permitted. All occurences of the text in the Search For box in the BODY fields will be replaced with the text in the Replace With box.</td>
  </tr>
  <tr>
  	<td class="fineprint" valign="top">&nbsp;</td>
  	<td class="fineprint" valign="top"><input type="radio" name="replace" value="n" checked>Just Search<br>
  	<input type="radio" name="replace" value="1">Search & Replace
  	</td>
  	
  </tr>
  <tr>
  	<td class="fineprint" valign="top">&nbsp;</td>
  	<td valign="top"><input type="submit" value="   Go   ">
  </tr>
  <?php if ($replaced) {?>
  <tr>
  	<td colspan="2" class="text"><?php echo $replaced;?> records updated. </td>
  </tr>
  <?php } ?>
  </form>
</table>
</div>

<p><?php
$display_bunch = $limit_start + $limit_n;
if ($display_bunch > $listings_count) {
	$display_bunch = $listings_count;
}
$display_start = $limit_start;
if ($display_start == 0) {
	$display_start = 1;
}
?>
<form action="<?php echo $PHP_SELF;?>" method="GET">
<b><?php echo "$display_start - $display_bunch";?></b> of <b><?php echo $listings_count;?></b>
&nbsp;&nbsp;&nbsp;
<?php 
if ($listings_count >= $display_bunch) {
	echo "go to page ";
	?>
	
	<select name="listings_page">
	<?php
	$pageTop = ceil($listings_count / $limit_n);
	for ($i=1;$i <= $pageTop;$i++) {
		echo "<option value=\"$i\">$i</option>";
	}
	?>
	</select>
	</form>
	
<?php }?>
<br>
</p>

				<p>
				<table width="100%" bgcolor="#333333" cellpadding="8" cellspacing="0" border="0">
					<tr bgcolor="#CECE66">
						<td width="30" valign="middle">
						<span class="heading">
						ID</span>						
						<td width="200" valign="middle">
						<span class="heading">
						Agency</span>						
						</td>
						<td width="200" valign="middle">
						<span class="heading">
						Location</span>
						</td>
						<td width="100" valign="middle">
						<span class="heading">
						Created On</span>
						</td>
						<td width="100" valign="middle">
						<span class="heading">
						Created By</span>
						</td>
						<td width="100" valign="middle">
						<span class="heading">
						Modified On</span>
						</td>
						<td width="100" valign="middle">
						<span class="heading">
						Modified By</span>
						<td valign="middle">
						&nbsp;
						</td>
					</tr>
				<?php 
				if ($listings_count) {
					while ($rowGetListings = mysqli_fetch_object($quGetListings)) {
						$i++;
						if (($i%2)) {
							$bgcolor="#E0E09C";
						}else {
							$bgcolor="#ffffff";
						}?>
					
					<tr bgcolor="<?php echo $bgcolor;?>">
						<td valign="middle">
						<span class="text">
						<?php echo $rowGetListings->CID; ?>
						</span>
						</td>
						<td valign="middle">
						<span class="text">
						<?php echo $rowGetListings->NAME;?>
						</span>
						</td>
						<td valign="middle">
						<span class="text">
						<?php echo ucwords(strtolower($rowGetListings->LOCNAME));?>
						</span>
						</td>
						<td valign="middle">
						<span class="text">
						<?php echo $rowGetListings->DATEIN;?>
						</span>
						</td>
						</td>
						<td valign="middle">
						<span class="text">
						<?php echo $rowGetListings->HANDLE;?>
						</span>
						</td>
						</td>
						<td valign="middle">
						<span class="text">
						<?php echo $rowGetListings->MOD;?>
						</span>
						</td>
						<td valign="middle">
						<span class="text">
						<?php echo $rowGetListings->MODBY;?>
						</span>
						</td>
						<td valign="middle">
						<span class="text">
						<a href="listing_edit.php?listing_id=<?php echo $rowGetListings->CID;?>">Edit</a>
						</span>
						</td>
					</tr>
					<tr bgcolor="<?php echo $bgcolor;?>">
						<td class="ad" colspan="8"><?php echo format_ad_ft ($rowGetListings, $DEFINED_VALUE_SETS, $search_for);?></td>
					</tr>
				<?php }  
			}else { ?>
				<tr bgcolor="ffffff">
					<td class="fineprint" colspan="8">No records founds, try widening your search criteria</td>
				</tr>
			<?php } ?>
					
				</table>
				</p>
				<p>
<p><?php
$display_bunch = $limit_start + $limit_n;
if ($display_bunch > $listings_count) {
	$display_bunch = $listings_count;
}
$display_start = $limit_start;
if ($display_start == 0) {
	$display_start = 1;
}
?>
<form action="<?php echo $PHP_SELF;?>" method="GET">
<b><?php echo "$display_start - $display_bunch";?></b> of <b><?php echo $listings_count;?></b>
&nbsp;&nbsp;&nbsp;
<?php 
if ($listings_count >= $display_bunch) {
	echo "go to page ";
	?>
	
	<select name="listings_page">
	<?php
	$pageTop = ceil($listings_count / $limit_n);
	for ($i=1;$i <= $pageTop;$i++) {
		echo "<option value=\"$i\">$i</option>";
	}
	?>
	</select>
	</form>
	
<?php }?>
</p>			
<?php include("./includes/footer_admin.php");?>	
				