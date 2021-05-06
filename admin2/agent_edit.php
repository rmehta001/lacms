<?php 
session_start();
include ("./inc/admin_key.php");
?>
<?php
if(isset($_GET['agent_id'])) {
    $agent_id = $_GET['agent_id'];
}
else{
    $agent_id=null;
}
if (isset($agent_id)) {
	//this is an edit//
	$word = "Edit";
	$msg = "Edit the Agent's details here.";
	$action = "update";
	
	$quStrGetAgent = "select * from `USERS` inner join `GROUP` on USERS.`GROUP`=`GROUP`.GRID where UID='$agent_id'";
	$quGetAgent = mysqli_query($dbh,$quStrGetAgent) or die (mysqli_error());
	$rowGetAgent = mysqli_fetch_object($quGetAgent);
	$agency_id = $rowGetAgent->GRID;

	$quStrGetAgency = "select * from `GROUP` where GRID='$agency_id'";
	$quGetAgency = mysqli_query($dbh,$quStrGetAgency) or die (mysqli_error());
	$rowGetAgency = mysqli_fetch_object($quGetAgency);
	$is_admin = ($rowGetAgency->ADMIN == $rowGetAgent->UID);
	
}else {
	$agency_id = $_GET['agency_id'];
	$quStrGetAgency = "select * from `GROUP` where GRID='$agency_id'";
	
	$quGetAgency = mysqli_query($dbh,$quStrGetAgency) or die (mysqli_error());
	$rowGetAgency = mysqli_fetch_object($quGetAgency);

	//this is a create//
	$word = "Create";
	$msg = "Create a new Agent here.";
	
	$action = "create";
}
?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				<?php echo $word;?> Agent
				</span><br>
				<?php if (isset($agent_id)) {?>
				<img src="./images/agent.gif" width="16" height="16" hspace="0" vspace="0"><span class="subtitle2"><?php echo $rowGetAgent->HANDLE;?></span> <span class="fineprint"><?php if ($rowGetAgent->USER_ACTIVE) { echo "(active)"; } else { echo "(inactive)";}?></span>
				<br>
				<span class="text">Belongs to <a href="agency_edit.php?agency_id=<?php echo $rowGetAgent->GRID;?>"><?php echo $rowGetAgent->NAME;?></a></span>
				<?php }else {?> 
				<span class="text">Create for <a href="agency_edit.php?agency_id=<?php echo $agency_id;?>"><?php echo $rowGetAgency->NAME;?></a></span>
				<?php } ?>
				</p>
				<?php if (isset($agent_id)) {?>
				<p>
				<?php 
				if ($rowGetAgent->USER_ACTIVE) {?>
				<a href="agent_deactivate.php?agent_id=<?php echo $agent_id;?>"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Deactivate Agent</span></a><br>
				<?php }else {?>
				<a href="agent_reactivate.php?agent_id=<?php echo $agent_id;?>"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Reactivate Agent</span></a><br>
				<?php } ?>
				<?php if (!$is_admin) {?>
				<a href="agent_delete.php?agent_id=<?php echo $agent_id;?>"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Delete Agent</span></a><br>
				<?php }?>
				<?php if ($agent_id!==$rowGetAgent->ADMIN) { ?>
				<a href="agent_designate.php?agent_id=<?php echo $agent_id;?>"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Designate Agent as Admininstrator</span></a><br>
				<?php }?>
				</p>
				<?php }?>

				<p>
				<?php echo $msg;?>
				</p>
				<p>
				(<b>*bolded</b> fields are required)
				</p>
				<p>
				
				<table width="100%" cellpadding="4" cellspacing="0" border="0">

					<form name="agent_edit_form" method="post" action="agent_edit_thanks.php">
					<input type="hidden" name="agency_id" value="<?php echo $agency_id;?>">
					<input type="hidden" name="agent_id" value="<?php echo $agent_id;?>">

					<?php if (!isset($agent_id)) {?>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						<b>*Username:</b>
						</span>
						</td>
						<td valign="middle">
						<input id="handle" name="handle" type="text" size="20" required>
						</td>
					</tr>
					<?php }else{ ?>
					<input type="hidden" name="handle" value="<?php echo $rowGetAgent->HANDLE;?>">
					<?php } ?>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						<b>*Password:</b>
						</span>
						</td>
						<td valign="middle">
						<input id="pass" name="pass" type="text" size="20" value="<?php if(isset($agent_id)){ echo $rowGetAgent->PASS;}?>" required>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Email:
						</span>
						</td>
						<td valign="middle">
						<input id="email" name="email" type="text" size="40" value="<?php if(isset($agent_id)) echo $rowGetAgent->EMAIL;?>">
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						User Level:
						</span>
						</td>
						<td valign="middle">
						0<input type="radio" name="user_level" value="0" <?php if (isset($rowGetAgent)&&$rowGetAgent->USER_LEVEL==0 ) { echo "checked";}?>>
						
						.5<input type="radio" name="user_level" value="0.5" <?php if (isset($rowGetAgent)&&$rowGetAgent->USER_LEVEL=="0.5") { echo "checked";}?>>
						
						1<input type="radio" name="user_level" value="1" <?php if (isset($rowGetAgent)&&$rowGetAgent->USER_LEVEL==1) { echo "checked";}?>> 2<input type="radio" name="user_level" value="2" <?php if (isset($rowGetAgent)&&$rowGetAgent->USER_LEVEL==2) { echo "checked";}?>> 3<input type="radio" name="user_level" value="3" <?php if (isset($rowGetAgent)&&$rowGetAgent->USER_LEVEL==3) { echo "checked";}?>>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Restrict user to IP address:
						</span>
						</td>
						<td valign="middle">
						No <input type="radio" name="user_restrict_ip" value="0" <?php if (isset($rowGetAgent)&&!$rowGetAgent->USER_RESTRICT_IP) { echo "checked";}?>> Yes<input type="radio" name="user_restrict_ip" value="1" <?php if (isset($rowGetAgent)&&$rowGetAgent->USER_RESTRICT_IP) { echo "checked";}?>>
						</td>
					</tr>

					<tr>
						<td valign="middle" align="right">
						<span class="text">
						&nbsp;
						</span>
						</td>
						<td valign="middle">
                            <input type="submit" name="edit" value="<?php echo $action;?>">
						</td>
					</tr>

					<tr>

						<td valign="middle" align="right">
						<span class="subhead">Preferences:</span>
						</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Number of Ads to display on screen:
						</span>
						</td>
						<td valign="middle">
						<input name="num_ads" type="text" size="10" value="<?php
                if (isset($rowGetAgent)&&$rowGetAgent->NUM_ADS >0) {
                 echo $rowGetAgent->NUM_ADS;
                } else {
                echo "10";
                }
                ?>">
                            </td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						User Signature
						</span>
						</td>
						<td valign="middle">
						<textarea name="user_sig" cols="40" rows="6"><?php if(isset($rowGetAgent)) echo $rowGetAgent->USER_SIG;?></textarea>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Use Software Version:
						</span>
						</td>
						<td valign="middle">
						1.0 <input type="radio" name="use_version" value="1" <?php if (isset($rowGetAgent)&&$rowGetAgent->USE_VERSION=="1") { echo "checked";}?>> 2.0<input type="radio" name="use_version" value="2" <?php if (isset($rowGetAgent)&&$rowGetAgent->USE_VERSION=="2" || (!isset($agent_id))) { echo "checked";}?>>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Default view for ads/listings:
						</span>
						</td>
						<td valign="middle">
						Simple <input type="radio" name="pref_adl_view" value="1"> Full<input type="radio" name="pref_adl_view" value="2" >
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Automatically update linked Landlords when ads/listings are updated:
						</span>
						</td>
						<td valign="middle">
						No <input type="radio" name="pref_auto_update_landlord" value="0" <?php if (isset($rowGetAgent)&&!$rowGetAgent->PREF_AUTO_UPDATE_LANDLORD) { echo "checked";}?>> Yes<input type="radio" name="pref_auto_update_landlord" value="1" <?php if (isset($rowGetAgent)&&$rowGetAgent->PREF_AUTO_UPDATE_LANDLORD) { echo "checked";}?>>
						</td>
					</tr>
					
					
					
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						&nbsp;
						</span>
						</td>
						<td valign="middle">
                            <input type="submit" name="edit" value="<?php echo $action;?>">
						</td>
					</tr>
					
					</form>
				</table>
				</p>
				
<?php include("./includes/footer_admin.php");?> 	
				