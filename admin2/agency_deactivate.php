<?php 
session_start();
include ("./inc/admin_key.php");
?>
<?php
$agency_id = $_GET['agency_id'];

if ($agency_id) {
	$quStrGetAgency = "select * from `GROUP` where GRID='$agency_id'";
	$quGetAgency = mysqli_query($dbh,$quStrGetAgency) or die (mysqli_error());
	$rowGetAgency = mysqli_fetch_object($quGetAgency);
	
	$word = "Deactivate";
	$msg = "Deactivating an agency denies all access to the system,  and deactivates all classified ads.  Access can be restored by \"reactivating\" an agency,  but ads' orginal status cannot be restored. Are you sure you want to do this?";
	$action = "deactivate $rowGetAgency->NAME";
}
?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				<?php echo $word;?> Agency
				</span><br>
				<span class="subtitle2"><?php echo $rowGetAgency->NAME;?></span>
				</p>
				
				<p>
				<?php echo $msg;?>
				</p>
				
				<p>
				
				<table width="100%" cellpadding="4" cellspacing="0" border="0">
					
					<form method="post" action="agency_deactivate_thanks.php">
					<input type="hidden" name="agency_id" value="<?php echo $agency_id;?>">
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						<b>*Please type the word yes in lower case:</b>
						</span>
						</td>
						<td valign="middle">
						<input name="conf" type="text" size="10">
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
				
