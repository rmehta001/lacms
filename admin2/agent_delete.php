<?php 
session_start();
include ("./inc/admin_key.php");
?>
<?php
$agent_id = $_GET['agent_id'];

$quStrGetAgent = "select * from USERS inner join `GROUP` on USERS.`GROUP`=`GROUP`.GRID where UID='$agent_id'";
$quGetAgent = mysqli_query($dbh,$quStrGetAgent) or die (mysqli_error());
$rowGetAgent = mysqli_fetch_object($quGetAgent);

$agency_id = $rowGetAgent->GROUP;
$quStrGetAgency = "select * from `GROUP` where GRID='$agency_id'";
$quGetAgency = mysqli_query($dbh,$quStrGetAgency) or die (mysqli_error());
$rowGetAgency = mysqli_fetch_object($quGetAgency);

$is_admin = ($rowGetAgency->ADMIN == $rowGetAgent->UID);

if (!$is_admin){
	$quStrGetOtherAgents = "select * from USERS where `GROUP`='$agency_id' and UID<>'$agent_id'";
	$quGetOtherAgents = mysqli_query($dbh,$quStrGetOtherAgents) or die (mysqli_error());
	$msg = "Deleting a user completely removes them from the system,  and cannot be undone.  All listings linked to a deleted agent must be transfered to another agent in that agency.";
}else {
	$msg = "Admins may not be deleted";
}

?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				Delete Agent
				</span><br>
				<img src="./images/agent.gif" width="16" height="16" hspace="0" vspace="0"><span class="subtitle2"><?php echo $rowGetAgent->HANDLE;?></span> <span class="fineprint"><?php if ($rowGetAgent->USER_ACTIVE) { echo "(active)"; } else { echo "(inactive)";}?></span>
				<br>
				<span class="text">Belongs to <a href="agency_edit.php?agency_id=<?php echo $rowGetAgent->GRID;?>"><?php echo $rowGetAgent->NAME;?></a></span>
				</p>
				
				<p>
				<?php echo $msg;?>
				</p>
				
				<?php 
				if (!$is_admin) {?>
				<p>
				
				<table width="100%" cellpadding="4" cellspacing="0" border="0">
				
					<form name="agent_delete_form" method="post" action="agent_delete_thanks.php">
					<input type="hidden" name="agent_id" value="<?php echo $agent_id;?>">
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Transfer all <?php echo $rowGetAgent->HANDLE;?>'s listings to:
						</span>
						</td>
						<td valign="middle">
						<select name="transfer">
						<?php while ($rowGetOtherAgents = mysqli_fetch_object($quGetOtherAgents)) {?>
						<option value="<?php echo $rowGetOtherAgents->UID;?>"><?php echo $rowGetOtherAgents->HANDLE;?></option>
						<?php } ?>
						</select>
						</td>
					</tr>
				
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						&nbsp;
						</span>
						</td>
						<td valign="middle">
						<input type="submit" value="transfer & delete">
						</td>
					</tr>
					
					</form>
				</table>
				</p>
				<?php }?>
				
<?php include("./includes/footer_admin.php");?> 	
				
