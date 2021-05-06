<?php

session_start();
include ("./inc/admin_key.php");

$op = "manage_agencies";
$_SESSION["op"]=$op;
$PHP_SELF=$_SERVER['PHP_SELF'];

if(isset($_SESSION["agency_page"]))
{
    $agency_page=  $_SESSION["agency_page"];
}
if (isset($_GET['agency_page'])) {
    $_SESSION["agency_page"] = $_GET['agency_page'];
    $agency_page=  $_SESSION["agency_page"];
}else {
	if (!isset($agency_page)) {
		$agency_page = 1;
	}
}
if(isset($_SESSION["agency_sort"]))
{
    $agency_sort=  $_SESSION["agency_sort"];
}
if (isset($_GET['agency_sort'])) {
    $_SESSION["agency_sort"] = $_GET['agency_sort'];
    $agency_sort=  $_SESSION["agency_sort"];
}else {
	if (!isset( $agency_sort)) {
		$agency_sort = "NAME";

	}
}

if(isset($_SESSION["agency_sort_dir"] ))
{
    $agency_sort_dir=$_SESSION["agency_sort_dir"];
}
if (isset($_GET['agency_sort_dir'])) {
    $_SESSION["agency_sort_dir"] = $_GET['agency_sort_dir'];
    $agency_sort_dir=$_SESSION["agency_sort_dir"];
}else {
	if (!isset($agency_sort_dir)) {
		$agency_sort_dir = "desc";

	}
}

$limit_n = 50;
$limit_start = ($agency_page * $limit_n) - $limit_n;
$limit = "limit $limit_start, $limit_n";


$order_by = "order by $agency_sort $agency_sort_dir";

$where = "where 1";

$group_by = "group by GRID";

$having = "";

$table_set = "(`GROUP` left join CLASS on `GROUP`.GRID=CLASS.CLI)";

//$table_set = "(SESSIONS right join `GROUP` on SESSIONS.GRID=`GROUP`.GRID) right join CLASS on CLASS.CLI=`GROUP`.GRID";

//$table_set = "(SESSIONS right join CLASS on SESSIONS.GRID=CLASS.CLI) right join `GROUP` on `GROUP`.GRID=SESSIONS.GRID";

//$table_set = "(`GROUP` left join CLASS on `GROUP`.GRID=CLASS.CLI) left join SESSIONS on `GROUP`.GRID=SESSIONS.GRID";

$quStrGetAgencyCount = "select count(GRID) as agency_count from `GROUP` $where";
$quGetAgencyCount = mysqli_query($dbh,$quStrGetAgencyCount) or die (mysqli_error());
$rowGetAgencyCount = mysqli_fetch_object($quGetAgencyCount);
$agency_count = $rowGetAgencyCount->agency_count;

$quStrGetAgencies = "select distinct `GROUP`.GRID, NAME, MAXACT, count(STATUS='ACT') as ACTIVE_ADS from $table_set $where $group_by $having $order_by $limit";
$quGetAgencies = mysqli_query($dbh,$quStrGetAgencies) or die (mysqli_error());



?>
<?php

?>

<?php include("./includes/head_admin.php");?>
				<p>
				<a href="agency_edit.php"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Create new Agency</span></a> &nbsp;&nbsp;&nbsp; <a target="new" href="../admin/pwSync.php"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Repair password list</span></a> &nbsp;&nbsp;&nbsp; <a target="new" href="../admin/userList.php"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Print password list</span></a>


 &nbsp;&nbsp;&nbsp; <a target="new" href="../admin/lastlogin.php"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Last Login list</span></a>


				</p>
<br>
<br>
<p>
<?php
$display_bunch = $limit_start + $limit_n;
if ($display_bunch > $agency_count) {
	$display_bunch = $agency_count;
}
$display_start = $limit_start;
if ($display_start == 0) {
	$display_start = 1;
}
?>
<b><?php echo "$display_start - $display_bunch";?></b> of <b><?php echo $agency_count;?></b>
&nbsp;&nbsp;&nbsp;
<?php 
if ($agency_count >= $display_bunch) {
	echo "go to page";
	$pageTop = ceil($agency_count / $limit_n);
	for ($i=1;$i <= $pageTop;$i++) {
		if ($agency_page == $i) {
			echo "$i |";
		}else {
			echo "<a href=\"$PHP_SELF?agency_page=$i\">$i</a> |";
		}
	}
	if ($agency_page < $pageTop) {
		$next_page = $agency_page++;
		echo "<a href=\"$PHP_SELF?agency_page=$next_page\">next</a> |"; 
	}
	if ($agency_page > 1) {
		$prev_page = $agency_page--;
		echo "<a href=\"$PHP_SELF?agency_page=$prev_page\">prev</a> |"; 
	}
}?>
<?php echo "<a href=\"manage_allagencies.php\">All Listings</a>"; ?>
</p>
				<p>
				<table width="100%" bgcolor="#333333" cellpadding="8" cellspacing="0" border="0">
					<tr style="background-color: #93D1FF">
						<td width="30" valign="middle">
						<?php 
						$img = "";
						if ($agency_sort=="GRID" && $agency_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif ($agency_sort=="GRID" && $agency_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?agency_sort=GRID&agency_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						ID</span>						</span>
						</a>
						</td>
						<td width="225" valign="middle">
						<?php 
						$img = "";
						if ($agency_sort=="NAME" && $agency_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif ($agency_sort=="NAME" && $agency_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?agency_sort=NAME&agency_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						Name</span>
						</a>
						</td>
						<td valign="middle">
						<?php 
						$img = "";
						if ($agency_sort=="MAXACT" && $agency_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif ($agency_sort=="MAXACT" && $agency_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?agency_sort=MAXACT&agency_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						Active Ads Maximum</span>
						</a>
						</td>
						<td valign="middle">
						<?php 
						$img = "";
						if ($agency_sort=="ACTIVE_ADS" && $agency_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif ($agency_sort=="ACTIVE_ADS" && $agency_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?agency_sort=ACTIVE_ADS&agency_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						Active Ads</span>
						</a>
						</td>
						<?php
						/*
						<td valign="middle">
						<?php 
						$img = "";
						if ($agency_sort=="LOGINS" && $agency_sort_dir=="desc") {
							$img = "<img src=\"./images/down_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "asc";
						}elseif ($agency_sort=="LOGINS" && $agency_sort_dir=="asc") {
							$img = "<img src=\"./images/up_arrow_white.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" width=\"9\" height=\"7\">";
							$dis_dir = "desc";
						}else {
							$dis_dir = "asc";
						}?>
						<a href="<?php echo $_SERVER['PHP_SELF'] . "?agency_sort=LOGINS&agency_sort_dir=$dis_dir";?>">
						<span class="heading">
						<?php echo $img;?>
						Logins</span>
						</a>
						*/
						?>
						</td>
						<td valign="middle">
						&nbsp;
						</td>
						
					</tr>
					<?php while ($rowGetAgencies = mysqli_fetch_object($quGetAgencies)) {
						$i++;
						if (($i%2)) {
							$bgcolor="#93D1FF";
						}else {
							$bgcolor="#ffffff";
						}?>
					<tr bgcolor="<?php echo $bgcolor;?>">
						<td valign="middle">
						<span class="text">
						<?php echo $rowGetAgencies->GRID;?>
						</span>
						</td>
						<td valign="middle">
						<span class="text">
						<?php echo $rowGetAgencies->NAME;?>
						</span>
						</td>
						<td valign="middle">
						<span class="text">
						<?php echo $rowGetAgencies->MAXACT;?>
						</span>
						</td>
						<td valign="middle">
						<span class="text">
						<?php echo $rowGetAgencies->ACTIVE_ADS;?>
						</span>
						</td>
						<!--
						<td valign="middle">
						<span class="text">
						<?php echo $rowGetAgencies->LOGINS;?>
						</span>
						</td>
						-->
                        <form action="agency_edit.php" method="get">
						<td valign="middle">
						<span class="text">
						<a href="agency_edit.php?agency_id=<?php echo $rowGetAgencies->GRID;?>">Edit</a>
						</span>
                        </td></form>
						
					</tr>
					<?php } ?>
				</table>
				</p>
				<p>
<p>
<?php
$display_bunch = $limit_start + $limit_n;
if ($display_bunch > $agency_count) {
	$display_bunch = $agency_count;
}
$display_start = $limit_start;
if ($display_start == 0) {
	$display_start = 1;
}
?>
<b><?php echo "$display_start - $display_bunch";?></b> of <b><?php echo $agency_count;?></b>
&nbsp;&nbsp;&nbsp;
<?php 
if ($agency_count > $display_bunch) {
	echo "go to page";
	$pageTop = ceil($agency_count / $limit_n);
	for ($i=1;$i <= $pageTop;$i++) {
		if ($agency_page == $i) {
			echo "$i |";
		}else {
			echo "<a href=\"$PHP_SELF?agency_page=$i\">$i</a> |";
		}
	}
	if ($agency_page < $pageTop) {
		$next_page = $agency_page++;
		echo "<a href=\"$PHP_SELF?agency_page=$next_page\">next</a> |"; 
	}
	if ($agency_page > 1) {
		$prev_page = $agency_page--;
		echo "<a href=\"$PHP_SELF?agency_page=$prev_page\">prev</a> |"; 
	}
}?>
</p>			
<?php include("./includes/footer_admin.php");?>	
				
