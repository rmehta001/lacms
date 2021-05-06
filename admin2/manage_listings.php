<?php
session_start();
include ("./inc/admin_key.php");
$PHP_SELF=$_SERVER['PHP_SELF'];


//DEFINED VALUE SETS //
$quStrGetValueDefs = "SELECT * FROM VALUE_DEFINE";
$quGetValueDefs = mysqli_query($dbh,$quStrGetValueDefs);

while (($rowGetValueDefs = mysqli_fetch_object($quGetValueDefs)) ){

    $string = $rowGetValueDefs->DEFINE;
    $values = explode (",", $string);
    foreach ($values as $key => $value) {
        $values2[$key] = explode("_", $value);
    }
    foreach ($values2 as $values3) {
        $offset = $values3[0];
        $DEFINED_VALUE_SETS[$rowGetValueDefs->CLASS_NAME][$offset] = isset($values3[1])?$values3[1]:null;
    }

    $string = false;
    $values = false;
    $values2 = false;
    $values3 = false;
    $offset = false;


}

if(isset($_GET['mode'])) {
    $mode = $_GET['mode'];

    if ($mode == 'toggle_status') {
        $listing_id = $_GET['listing_id'];
        $quStrGetListing = "select  STATUS from CLASS where CID='$listing_id'";
        $quGetListing = mysqli_query($dbh, $quStrGetListing) or die (mysqli_error());
        $rowGetListing = mysqli_fetch_object($quGetListing);
        if ($rowGetListing->STATUS == 'ACT') {
            $new_status = 'STO';
        } else {
            $new_status = 'ACT';
        }
        $quStrUpdateClass = "update CLASS set STATUS='$new_status' where CID='$listing_id'";
        $quUpdateClass = mysqli_query($dbh, $quStrUpdateClass) or die (mysqli_error());
    } elseif ($mode == 'select_and_do') {
        $select_operation = $_POST['select_operation'];
        $conf = $_POST['conf'];
        if ($select_operation == "delete" && $conf) {
            foreach ($_POST['selected_listings'] as $selected_listing) {
                db_delete_listing_admin($selected_listing);
            }
        } elseif ($select_operation == "deactivate") {
            foreach ($_POST['selected_listings'] as $selected_listing) {
                db_deactivate_listing_admin($selected_listing);
            }
        } elseif ($select_operation == "activate") {
            foreach ($_POST['selected_listings'] as $selected_listing) {
                db_activate_listing_admin($selected_listing);
            }
        }
    }
}


$nowYmd = date("Ymd");


if (isset($_GET['filter_set'])) {
    $filter_set = $_GET['filter_set'];
}

$show_ads=true;
if(isset($_SESSION['show_ads']))
{
    $show_ads=$_SESSION['show_ads'];
}
if (isset($_GET['show_ads'])) {
    $show_ads = $_GET['show_ads'];
    $_SESSION['show_ads']=$show_ads;
	if ($show_ads=="n") {
        $show_ads = false;
	}
	if($show_ads=="1")
    {
        $show_ads=true;
    }
}
if(isset( $_SESSION['listings_page']))
{
    $listings_page=$_SESSION['listings_page'];
}
if (isset($_GET['listings_page'])) {
    $listings_page = $_GET['listings_page'];
    $_SESSION['listings_page']=$listings_page;

}else {
	if (!isset( $listings_page)) {
        $listings_page=1;
        $_SESSION['listings_page']=1;
	}
}

//session_register ("listings_sort");
if(isset($_SESSION['sort']))
    {
        $listings_sort=$_SESSION['sort'];
    }

if (isset($_GET['sort'])) {
    $_SESSION['sort'] = $_GET['sort'];
    $_SESSION['sort']= $listings_sort;

}else {
	if (!isset($listings_sort)) {
		$listings_sort = "DATEIN";
        $_SESSION['sort']="DATEIN";
	}
}

//session_register ("listings_sort_dir");
if(isset($_SESSION['listings_sort_dir']))
{
    $listings_sort_dir=$_SESSION['listings_sort_dir'];
}
if (isset($_GET['listings_sort_dir'])) {
    $_SESSION['listings_sort_dir'] = $_GET['listings_sort_dir'];
    $_SESSION['listings_sort_dir']= $listings_sort_dir;
}else {
	if (!isset($listings_sort_dir)) {
		$listings_sort_dir = "desc";
        $_SESSION['listings_sort_dir']=$listings_sort_dir;
	}
}
//session_register("listings_cli");

if(isset( $_SESSION['listings_cli'])){
    $listings_cli=$_SESSION['listings_cli'];
}
if(isset($_GET['listings_cli'])){
    $listings_cli = $_GET['listings_cli'];
    $_SESSION['listings_cli']= $listings_cli;
}
else {
    if (!isset($filter_set)){
        $listings_cli = "1";
    }
}
//session_register("bool_listings_cli");
$_SESSION['bool_listings_cli']="nocheck";
if (isset($_GET['bool_listings_cli'])) {
    $bool_listings_cli = $_GET['bool_listings_cli'];
    if ($bool_listings_cli == "n") {
        $bool_listings_cli = "nocheck";
        $_SESSION['bool_listings_cli']=$bool_listings_cli;
        }
    else if($bool_listings_cli="1"){
        $bool_listings_cli="checked";
        $_SESSION['bool_listings_cli']=$bool_listings_cli;
    }
    }
else {
    if (!isset($filter_set)) {
        $bool_listings_cli = "1";
    }
}


//session_register("listings_uid");

if(isset($_SESSION['listings_uid']))
{
    $listings_uid=$_SESSION['listings_uid'];
}
if (isset($_GET['listings_uid'])) {
    $listings_uid = $_GET['listings_uid'];
    $_SESSION['listings_uid']=$listings_uid;
}else {
	if (!isset($listings_uid)) {
		$listings_uid = 2;
        $_SESSION['listings_uid']=2;
	}
}
//session_register("bool_listings_uid");
$_SESSION['bool_listings_uid']="nocheck";
if (isset($_GET['bool_listings_uid'])) {

    $bool_listings_uid = $_GET['bool_listings_uid'];
	if ($bool_listings_uid == "n") {
		$bool_listings_uid = "unchecked";
        $_SESSION['bool_listings_uid']=$bool_listings_uid;
	}
	elseif($bool_listings_uid=="1"){
        $bool_listings_uid = "checked";
        $_SESSION['bool_listings_uid']=$bool_listings_uid;
    }
}
//session_register ("listings_type");

if(isset( $_SESSION['listings_type'])){
    $listings_type=$_SESSION['listings_type'];
}
if (isset($_GET['listings_type'])) {
    $listings_type  = $_GET['listings_type'];
   $_SESSION['listings_type']=  $listings_type;
}else {
	if (!isset($listings_type)) {
		$listings_type = 1;

	}
}

//session_register ("bool_listings_type");
$_SESSION['bool_listings_type']="nocheck";
if (isset($_GET['bool_listings_type'])) {
    $bool_listings_type = $_GET['bool_listings_type'];
	if ($bool_listings_type == "n") {
		$bool_listings_type = "nochecked";
        $_SESSION['bool_listings_type']=  $bool_listings_type;
	}
	else if($bool_listings_type=="1"){
        $bool_listings_type ="checked";
        $_SESSION['bool_listings_type']=  $bool_listings_type;
    }
}else {
	if (!isset($filter_set)) {
		$bool_listings_type = 1;
	}
}

//session_register ("listings_loc");
if(isset(    $_SESSION['$listings_loc']))
{
    $listings_loc=$_SESSION['$listings_loc'];
}
if (isset($_GET['listings_loc'])) {
    $listings_loc = $_GET['listings_loc'];
    $_SESSION['$listings_loc']=$listings_loc;
}else {
	if (!isset( $listings_loc)) {
		$listings_loc = 1;
	}
}
//session_register ("bool_listings_loc");
$_SESSION['bool_listings_loc']="nocheck";
if (isset($_GET['bool_listings_loc'])) {
    $bool_listings_loc= $_GET['bool_listings_loc'];

	if ($bool_listings_loc == "n") {
		$bool_listings_loc =="nocheck";
        $_SESSION['bool_listings_loc']= $bool_listings_loc;
	}
	else if($bool_listings_loc=="1"){
        $bool_listings_loc = "checked";
        $_SESSION['bool_listings_loc']= $bool_listings_loc;
    }
}

//session_register("listings_datein_start");
if(isset($_SESSION['listings_datein_start']))
{
    $listings_datein_start=$_SESSION['listings_datein_start'] ;
}

if (isset($_GET['listings_datein_start'])) {
    $_SESSION['listings_datein_start'] = $_GET['listings_datein_start'];
    $listings_datein_start=$_SESSION['listings_datein_start'] ;
}else {
	if (!isset($listings_datein_start)) {
		$listings_datein_start = $nowYmd;
	}
}
//session_register("bool_listings_datein_start");
$_SESSION['bool_listings_datein_start']="nocheck";
if (isset($_GET['bool_listings_datein_start'])) {
    $bool_listings_datein_start = $_GET['bool_listings_datein_start'];
    if ($bool_listings_datein_start == "n"){
    $bool_listings_datein_start = "nocheck";
    $_SESSION['bool_listings_datein_start'] = $bool_listings_datein_start;
}
else if ($bool_listings_datein_start=="1"){
        $bool_listings_datein_start = "checked";
        $_SESSION['bool_listings_datein_start'] = $bool_listings_datein_start;
    }
}

//session_register("listings_datein_end");
if(isset($_SESSION['listings_datein_end']))
{
    $listings_datein_end=$_SESSION['listings_datein_end'] ;
}
if (isset($_GET['listings_datein_end'])) {
    $_SESSION['listings_datein_end'] = $_GET['listings_datein_end'];
    $listings_datein_end=$_SESSION['listings_datein_end'] ;
}else {
    if (!isset($listings_datein_end)) {
        $listings_datein_end = $nowYmd;
    }
}

//session_register("bool_listings_datein_end");
$_SESSION['bool_listings_datein_end']="nocheck";
if (isset($_GET['bool_listings_datein_end'])) {
	$bool_listings_datein_end = $_GET['bool_listings_datein_end'];
	if ($bool_listings_datein_end == "n") {
		$bool_listings_datein_end = "nocheck";
        $_SESSION['bool_listings_datein_end']=$bool_listings_datein_end;
	}
	elseif($bool_listings_datein_end=="1"){
        $bool_listings_datein_end = "checked";
        $_SESSION['bool_listings_datein_end']=$bool_listings_datein_end;
    }
}


//session_register("listings_mod_start");
if(isset($_SESSION['listings_mod_start']))
{
    $listings_mod_start=$_SESSION['listings_mod_start'] ;
}
if (isset($_GET['listings_mod_start'])) {
    $_SESSION['listings_mod_start'] = $_GET['listings_mod_start'];
    $listings_mod_start=$_SESSION['listings_mod_start'] ;
}else {
    if (!isset($listings_mod_start)) {
        $listings_mod_start = $nowYmd;
    }
}



//session_register("bool_listings_mod_start");

$_SESSION['bool_listings_mod_start']="nocheck";
if (isset($_GET['bool_listings_mod_start'])) {
	$bool_listings_mod_start = $_GET['bool_listings_mod_start'];
	$_SESSION['$bool_listings_mod_start']=$bool_listings_mod_start;
	if ($bool_listings_mod_start == "n") {
		$bool_listings_mod_start = "nocheck";
		$_SESSION['bool_listings_mod_start']=$bool_listings_mod_start;
	}
	else if($bool_listings_mod_start=="1"){
        $bool_listings_mod_start = "checked";
        $_SESSION['bool_listings_mod_start']=$bool_listings_mod_start;
    }

}

//session_register("listings_mod_end");
if (isset($_GET['listings_mod_end'])) {
	$listings_mod_end = $_GET['listings_mod_end'];
	$_SESSION['$listings_mod_end']=$listings_mod_end;
}else {
	if (!isset($listings_mod_end)) {
		$listings_mod_end = $nowYmd;
	}
}
//session_register("bool_listings_mod_end");
$_SESSION['bool_listings_mod_end']="nocheck";
if (isset($_GET['bool_listings_mod_end'])) {
	$bool_listings_mod_end = $_GET['bool_listings_mod_end'];
    $_SESSION['bool_listings_mod_end']=$bool_listings_mod_end;
	if ($bool_listings_mod_end == "n") {
		$bool_listings_mod_end = "nocheck";
        $_SESSION['bool_listings_mod_end']=$bool_listings_mod_end;
	}
	else if($bool_listings_mod_end=="1"){
        $bool_listings_mod_end =="checked";
        $_SESSION['bool_listings_mod_end']=$bool_listings_mod_end;
    }
}

//session_register("listings_modby");
if (isset($_GET['listings_modby'])) {
	$listings_modby = $_GET['listings_modby'];
    $_SESSION['$listings_modby']=$listings_modby;
}else {
	if (!isset($listings_modby)) {
		$listings_modby = 2;
	}
}
//session_register("bool_listings_modby");
$_SESSION['bool_listings_modby']="nocheck";
if (isset($_GET['bool_listings_modby'])) {
	$bool_listings_modby = $_GET['bool_listings_modby'];

	if ($bool_listings_modby == "n") {
		$bool_listings_modby = "nocheck";
        $_SESSION['bool_listings_modby']=$bool_listings_modby;
	}
	else if($bool_listings_modby=="1"){
        $bool_listings_modby="checked";
        $_SESSION['bool_listings_modby']=$bool_listings_modby;
    }
}

//ORDER BY
if (isset($listings_sort)) {
	$order_by = "order by $listings_sort $listings_sort_dir";

}
else{
    $order_by=null;
}

//WHERE
$where ="where 1";
if ($_SESSION['bool_listings_cli']=="checked") {
	$where .= " and CLI='$listings_cli'";
}
if ($_SESSION['bool_listings_uid']=="checked") {
	$where .= " and CLASS.UID='$listings_uid'";
}
if ($_SESSION['bool_listings_type']=="checked") {
	$where .= " and CLASS.TYPE='$listings_type'";
}
if ( $_SESSION['bool_listings_loc']=="checked") {
	$where .= " and LOC='$listings_loc'";
}
if ($_SESSION['bool_listings_datein_start']=="checked") {
	$where .= " and DATEIN >= '$listings_datein_start'";
}
if ($_SESSION['bool_listings_datein_end']=="checked") {
	$where .= " and DATEIN <= '$listings_datein_end'";
}
if ($_SESSION['bool_listings_mod_start']=="checked") {
	$where .= " and MOD >= '$listings_mod_start'";
}
if ($_SESSION['bool_listings_mod_end']=="checked") {
	$where .= " and MOD <= '$listings_mod_end'";
}
if ($_SESSION['bool_listings_modby']=="checked") {
	$where .= " and MODBY = '$listings_modby'";
}

//LIMIT
$limit_n = 30;
$limit_n1=$limit_n*$listings_page;
$limit_start = ($listings_page * $limit_n) - $limit_n;
$limit = "limit $limit_start, $limit_n1";


//FROM
$table_set = "((((CLASS inner join LOC on CLASS.LOC=LOC.LOCID) inner join `GROUP` on CLASS.CLI=`GROUP`.GRID) inner join TYPES on CLASS.TYPE=TYPES.TYPE) inner join USERS on CLASS.UID=USERS.UID) ";

$quStrGetListings = "select * from $table_set $where $order_by $limit";
$quGetListings = mysqli_query($dbh,$quStrGetListings) or die (mysqli_error());

$quStrGetCount = "select count(CID) as listings_count from $table_set  LIMIT 50";
$quGetCount = mysqli_query($dbh,$quStrGetCount) or die (mysqli_error());
$rowGetCount = mysqli_fetch_object($quGetCount);

$listings_count = 100;




//Form options
$quStrGetAgencies = "select * from `GROUP` order by NAME";
$quGetAgencies = mysqli_query($dbh,$quStrGetAgencies) or die (mysqli_error());

$quStrGetAgents = "select * from USERS order by HANDLE";
$quGetAgents = mysqli_query($dbh,$quStrGetAgents) or die (mysqli_error());

$quStrGetTypes = "select * from TYPES order by TYPE";
$quGetTypes = mysqli_query($dbh,$quStrGetTypes) or die (mysqli_error());

$quStrGetLocs = "select * from LOC order by LOCNAME";
$quGetLocs = mysqli_query($dbh,$quStrGetLocs) or die (mysqli_error());



?>

<?php include("./includes/head_admin.php");?>
				<p>
				<a href="listing_edit.php"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Create new Listing</span></a> &nbsp;&nbsp;&nbsp; <a href="full_text_search.php"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Full Text Search</span></a>


				</p>
<br>
<br>
<div style="border:1px solid black;">
<table width="75%" border="0">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
<input type="hidden" name="filter_set" value="1">
<input type="hidden" name="bool_listings_cli" value="n">
<input type="hidden" name="bool_listings_uid" value="n">
<input type="hidden" name="bool_listings_type" value="n">
<input type="hidden" name="bool_listings_loc" value="n">
<input type="hidden" name="bool_listings_modby" value="n">
<input type="hidden" name="bool_listings_datein_start" value="n">
<input type="hidden" name="bool_listings_datein_end" value="n">
<input type="hidden" name="bool_listings_mod_start" value="n">
<input type="hidden" name="bool_listings_mod_end" value="n">
    <input type="hidden" name="bool_listings_loc" value="n">




  <tr>
    <td class="fineprint<?php if ($_SESSION['bool_listings_cli']=="checked") { echo "Red";}?>" valign="top">Agency:</td>
    <td class="fineprint" valign="top"><input type="checkbox" name="bool_listings_cli" value="1" <?php if($_SESSION['bool_listings_cli']=="checked") { echo "checked";}?>></td>
    <td class="fineprint" valign="top"><select name="listings_cli">
      <?php
      mysqli_data_seek($quGetAgencies, 0);
      while ($rowGetAgencies = mysqli_fetch_object($quGetAgencies)) {?>
      <option value="<?php echo $rowGetAgencies->GRID;?>" <?php if (isset($listings_cli)&&$listings_cli==$rowGetAgencies->GRID) { echo "selected";}?>><?php echo $rowGetAgencies->NAME;?></option>
      <?php } ?>
      </select></td>
    <td class="fineprint<?php if ($_SESSION['bool_listings_uid']=="checked") { echo "Red";}?>" valign="top">Agent:</td>
    <td class="fineprint" valign="top"><input type="checkbox" name="bool_listings_uid" value="1" <?php if ($_SESSION['bool_listings_uid']=="checked") { echo "checked";}?>></td>
    <td class="fineprint" valign="top"><select name="listings_uid">
    <?php
    mysqli_data_seek($quGetAgents, 0);
    while ($rowGetAgents = mysqli_fetch_object($quGetAgents)) {?>
    <option value="<?php echo $rowGetAgents->UID;?>" <?php if (isset($listings_uid)&&$listings_uid==$rowGetAgents->UID) { echo "selected";}?>><?php echo $rowGetAgents->HANDLE;?></option>
    <?php } ?>
      </select></td>
  </tr>
  <tr>
    <td class="fineprint<?php if ( $_SESSION['bool_listings_type']=="checked") { echo "Red";}?>" valign="top">Type:</td>
    <td valign="top"><input type="checkbox" name="bool_listings_type" value="1" <?php if ( $_SESSION['bool_listings_type']=="checked") { echo "checked";}?>></td>
    <td valign="top"><select name="listings_type">
    <?php
    mysqli_data_seek($quGetTypes, 0);
    while ($rowGetTypes = mysqli_fetch_object($quGetTypes)) {?>
    <option value="<?php echo $rowGetTypes->TYPE;?>" <?php if (isset($listings_type)&&$listings_type==$rowGetTypes->TYPE) { echo "selected";}?>><?php echo $rowGetTypes->TYPENAME;?></option>
    <?php } ?>
      </select></td>
      <td class="fineprint<?php if ($_SESSION['bool_listings_loc']=="checked") { echo "Red";}?>" valign="top">Location:</td>
    <td valign="top"><input type="checkbox" name="bool_listings_loc" value="1" <?php if ($_SESSION['bool_listings_loc']=="checked") { echo "checked"; }?>></td>
    <td valign="top"><select name="listings_loc">
    <?php
    mysqli_data_seek($quGetLocs, 0);
    while ($rowGetLocs = mysqli_fetch_object($quGetLocs)) {?>
    <option value="<?php echo $rowGetLocs->LOCID;?>" <?php if (isset($listings_loc)&&$listings_loc==$rowGetLocs->LOCID) { echo "selected";}?>><?php echo ucwords(strtolower($rowGetLocs->LOCNAME));?></option>
    <?php } ?>
      </select></td>
  </tr>
  <tr>
    <td class="fineprint<?php if ($_SESSION['bool_listings_modby']=="checked") { echo "Red";}?>" valign="top">Modified By:</td>
    <td  valign="top"><input name="bool_listings_modby" type="checkbox" <?php if ($_SESSION['bool_listings_modby']=="checked") { echo "checked";}?>></td>
    <td  valign="top"><select name="listings_modby">
    <?php
    mysqli_data_seek($quGetAgents, 0);
    while ($rowGetAgents = mysqli_fetch_object($quGetAgents)) {?>
    <option value="<?php echo $rowGetAgents->HANDLE;?>" <?php if ($listings_modby==$rowGetAgents->HANDLE) { echo "selected";}?>><?php echo $rowGetAgents->HANDLE;?></option>
    <?php } ?>
      </select></td>
    <td class="fineprint" valign="top">&nbsp;</td>
    <td  valign="top">&nbsp;</td>
    <td  valign="top">&nbsp;</td>

  </tr>
  <tr>
    <td class="fineprint<?php if ( $_SESSION['bool_listings_datein_start']=="checked") { echo "Red";}?>" valign="top">Created Start Date:</td>
    <td valign="top"><input type="checkbox" name="bool_listings_datein_start" value="1" <?php if ($_SESSION['bool_listings_datein_start']=="checked") { echo "checked";}?>></td>
    <td valign="top"><input size="15" type="text" name="listings_datein_start" value="<?php if(isset($listings_datein_start)) {echo $listings_datein_start;}?>"></td>
    <td class="fineprint<?php if ($_SESSION['bool_listings_mod_start']=="checked") { echo "Red";}?>" valign="top"><p>Modifed Start Date:</p></td>
    <td valign="top"><input type="checkbox" name="bool_listings_mod_start" value="1" <?php if ($_SESSION['bool_listings_mod_start']=="checked") { echo "checked";}?>></td>
    <td valign="top"><input size="15" type="text" name="listings_mod_start" value="<?php if(isset($listings_mod_start)){echo $listings_mod_start;}?>"></td>
  </tr>
  <tr>
    <td class="fineprint<?php if ($_SESSION['bool_listings_datein_end']=="checked") { echo "Red";}?>" valign="top"><p>Created End Date::</p></td>
    <td valign="top"><input type="checkbox" name="bool_listings_datein_end" value="1" <?php if($_SESSION['bool_listings_datein_end']=="checked") { echo "checked";}?>></td>
    <td valign="top"><input size="15" type="text" name="listings_datein_end" value="<?php if(isset($listings_datein_end)){echo $listings_datein_end;}?>"></td>
    <td class="fineprint<?php if ($_SESSION['bool_listings_mod_end']=="checked") { echo "Red";}?>" valign="top">Modified End Date</td>
    <td valign="top"><input type="checkbox" name="bool_listings_mod_end" value="1" <?php if ($_SESSION['bool_listings_mod_end']=="checked") { echo "checked";}?>></td>
    <td valign="top"><input size="15" type="text" name="listings_mod_end" value="<?php echo $listings_mod_end;?>"> <input type="submit" value="Filter"></td></td>
  </tr>



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
<script language="javascript">
<!--
function page_flip_form_submit () {
	document.forms.page_flip_form.submit();
}
-->
</script>
<form name="page_flip_form" action="<?php echo $PHP_SELF;?>" method="GET">
<b><?php echo "$display_start - $display_bunch";?></b> of <b><?php echo $listings_count;?></b>
&nbsp;&nbsp;&nbsp;
<?php
if ($listings_count >= $display_bunch) {
	echo "go to page ";
	?>

	<select name="listings_page" onChange="page_flip_form_submit();">
	<?php
	$pageTop = ceil($listings_count / $limit_n);
	for ($i=1;$i <= $pageTop;$i++) {?>
		<option value="<?php echo $i;?>" <?php if ($i==$listings_page) { echo "selected"; }?>><?php echo $i;?></option>
	<?php }?>
	</select>
	</form>

<?php }?>
<br>
<?php if ($show_ads) {?>
<a href="<?php echo $_SERVER['PHP_SELF'] . "?show_ads=n";?>">Hide Ads</a>
<?php } else { ?>
<a href="<?php echo $_SERVER['PHP_SELF'] . "?show_ads=1";?>">Show Ads</a>
<?php }?>
</p>
<script language="javascript">
<!--
function select_and_do_form_submit() {
	var bad = 0;
	var msg = "";
	var is_delete = 0;
	if (document.forms.select_and_do_form.select_operation.selectedIndex==0) {
		bad++;
		msg += "Please select something to do first.";
	}
	if (document.forms.select_and_do_form.select_operation.selectedIndex==1) {
		is_delete = 1;
	}
	
	if (bad) {
		alert(msg);
	}else if (is_delete) {
		if (confirm("Are you sure you want to delete these selected ads,  this is not undoable")) {
			document.forms.select_and_do_form.conf.value = 1;
			document.forms.select_and_do_form.submit();
		}
	}else {
		document.forms.select_and_do_form.submit();
	}
}


function select_all_listings() {                                                       
	for (var i=0;i<document.select_and_do_form.elements.length;i++) {                                                    
		var e = document.select_and_do_form.elements[i];
		if (e.name != "select_all_listings_box" && e.type=="checkbox"){ 
			e.checked = document.select_and_do_form.select_all_listings_box.checked;
		}
	}                                          
}                                                       
-->
</script>	

<form action="<?php echo "$PHP_SELF?mode=select_and_do";?>" enctype="application/x-www-form-urlencoded" name="select_and_do_form" method="POST">
<input type="hidden" name="conf" value="0">
<p>
<select name="select_operation"><option>With Selected:</option>
<option value="delete">Delete...</option>
<option value="deactivate">Deactivate..</option>
<option value="activate">Activate...</option>
</select> 
<input onClick="select_and_do_form_submit();" type="button" value="go">
</p>

				<p>
				<table width="100%" bgcolor="#333333" cellpadding="8" cellspacing="0" border="0">
					<tr bgcolor="#CECE66">
						<td width="30" valign="middle"><input type="checkbox" name="select_all_listings_box" onClick="select_all_listings();"></td>
						<td width="30" valign="middle">
						<?php
						$img = "";
						if (isset($listings_sort)&&$listings_sort=="CID" && $listings_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif (isset($listings_sort)&&$listings_sort=="CID" && $listings_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=CID&listings_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						ID</span>
						</a>
						</td>
						<td width="10" valign="middle">
						<?php
						$img = "";
						if (isset($listings_sort)&&$listings_sort=="STATUS" && $listings_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif (isset($listings_sort)&&$listings_sort=="STATUS" && $listings_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=STATUS&listings_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						Status</span>
						</a>
						</td>
						<td width="10" valign="middle">
						<?php
						$img = "";
						if (isset($listings_sort)&&$listings_sort=="PIC" && $listings_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif (isset($listings_sort)&&$listings_sort=="PIC" && $listings_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=PIC&listings_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						Pics</span>
						</a>
						</td>
						<td width="200" valign="middle">
						<?php
						$img = "";
						if (isset($listings_sort)&&$listings_sort=="NAME" && $listings_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif (isset($listings_sort)&&$listings_sort=="NAME" && $listings_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=NAME&listings_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						Agency</span>
						</a>
						</td>
						<td width="200" valign="middle">
						<?php
						$img = "";
						if (isset($listings_sort)&&$listings_sort=="LOCNAME" && $listings_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif (isset($listings_sort)&&$listings_sort=="LOCNAME" && $listings_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=LOCNAME&listings_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						Location</span>
						</a>
						</td>
						<td width="120" valign="middle">
						<?php
						$img = "";
						if (isset($listings_sort)&&$listings_sort=="DATEIN" && $listings_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif (isset($listings_sort)&&$listings_sort=="DATEIN" && $listings_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=DATEIN&listings_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						Created On</span>
						</a>
						</td>
						<td width="100" valign="middle">
						<?php
						$img = "";
						if ($listings_sort=="HANDLE" && $listings_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif ($listings_sort=="HANDLE" && $listings_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=HANDLE&listings_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						Created By</span>
						</a>
						</td>
						<td width="100" valign="middle">
						<?php
						$img = "";
						if ($listings_sort=="MOD" && $listings_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif ($listings_sort=="MOD" && $listings_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?sort=MOD&listings_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						Modified On</span>
						</a>
						</td>
						<td valign="middle">
						&nbsp;
						</td>
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
						<td valign="middle"><input type="checkbox" name="selected_listings[]" value="<?php echo $rowGetListings->CID;?>"></td>
						<td valign="middle">
						<span class="text">
						<?php echo $rowGetListings->CID; ?>
						</span>
						</td>
						<td valign="middle">
						<span class="text">
						<a href="<?php echo ($PHP_SELF . "?mode=toggle_status&listing_id=" . $rowGetListings->CID);?>">
						<?php if ($rowGetListings->STATUS=='ACT') { echo  "<img border='0' src='../assets/images/act.gif'>"; } else { echo "<img border='0' src='../assets/images/inact.gif'>"; }?>
						</a>
						</span>
						</td>
						<td valign="middle">
						<span class="text">
						<?php if ($rowGetListings->PIC) { echo  "<img src='http://www.bostonapartments.com/images/pic.gif'>"; } else {echo "&nbsp;"; }?>
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
						<a href="listing_edit.php?listing_id=<?php echo $rowGetListings->CID;?>">Edit</a>
						</span>
						</td>
						<td valign="middle">
						<span class="text">
						<a href="listing_delete.php?listing_id=<?php echo $rowGetListings->CID;?>">Delete</a>
						</span>
						</td>
					</tr>
					<?php if ($show_ads) {?>
					<tr bgcolor="<?php echo $bgcolor;?>">
						<td class="ad" colspan="11"><?php echo format_ad($rowGetListings, $DEFINED_VALUE_SETS);?></td>
					</tr>
					<?php } ?>
				<?php }
			}else { ?>
				<tr bgcolor="ffffff">
					<td class="fineprint" colspan="10">No records founds, try widening your search criteria</td>
				</tr>
			<?php } ?>

				</table>
				</p>
</form>
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
				
