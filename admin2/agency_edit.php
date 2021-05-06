<?php 
session_start();
include ("./inc/admin_key.php");
?>
<?php
if(isset($_GET['agency_id'])) {
    $agency_id= $_GET['agency_id'];
}
else{
    $agency_id=null;
}
if (isset($agency_id)) {
	//this is an edit//
	$word = "Edit";
	$msg = "Edit the agency's details here.";
	$action = "update";
	
	$quStrGetAgency = "select * from `GROUP` where GRID='$agency_id'";
	$quGetAgency = mysqli_query($dbh,$quStrGetAgency) or die (mysqli_error());
	$rowGetAgency = mysqli_fetch_object($quGetAgency);
	
	$is_active = ($rowGetAgency->GRSTATUS == 'ACT');
	
	$quStrGetAgents = "select * from USERS where `GROUP`='$agency_id'";
	$quGetAgents = mysqli_query($dbh,$quStrGetAgents) or die (mysqli_error());
	
	

}else {
	//this is a create//

	$word = "Create";
	$msg = "Create a new Agency and Admin user here.";
	$action = "create";
}
?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				<?php echo $word;?> Agency
				</span><br>
				<span class="subtitle2"><?php
                    if(isset($rowGetAgency)){echo $rowGetAgency->NAME;}?></span>
				</p>
				<?php if (isset($agency_id)) {?>
				<p>
				<?php if (!$is_active) {?>
				<a href="agency_reactivate.php?agency_id=<?php echo $agency_id;?>"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Reactivate Agency</span></a><br>
				<a href="agency_delete.php?agency_id=<?php echo $agency_id;?>"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Delete Agency</span></a><br>
				<?php }else { ?>
				<a href="agency_deactivate.php?agency_id=<?php echo $agency_id;?>"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Deactivate Agency</span></a><br>
				<?php } ?>
				</p>
				<p>
				<span class="subhead">Agents:</span><br>
				<a href="agent_edit.php?agency_id=<?php echo $agency_id;?>"><img src="./images/arrow_orange.jpg" width="7" height="9" border="0" hspace="0" vspace="0"><span class="task">Create a new Agent</span></a><br>
				<span class="text">Click on the icons to edit the agent,  click on the user name and password to log on as that agent</span>
				<table border="0" cellpadding="5">
				<tr>
				<?php while ($rowGetAgent = mysqli_fetch_object($quGetAgents)) {?>
				<?php 
				$style = "style=\"";
				if ($rowGetAgent->UID!==$rowGetAgency->ADMIN) { 
					$style .= "font-weight:normal;";
				}
				if (!$rowGetAgent->USER_ACTIVE) {
					$style .= "color:red;";
				}
				$style .= "\"";
				?>
					<td width="200"><a href="agent_edit.php?agent_id=<?php echo $rowGetAgent->UID;?>"><img src="./images/agent.gif" width="16" height="16" border="0" hspace="0" vspace="0"></a> <a target="new" <?php echo $style;?> href="http://<?php echo $rowGetAgent->HANDLE;?>:<?php echo $rowGetAgent->PASS;?>@www.bostonapartments.com/lacms"><span class="text"><?php echo $rowGetAgent->HANDLE;?> (<?php echo $rowGetAgent->PASS;?>)</span></a></b></td>

				<?php } ?>
				</tr>
				</table>
				<?php } ?>
				<p>
				
				
				<p>
				<?php echo $msg;?>
				</p>
				<p>
				(<b>*bolded</b> fields are required)
				</p>
				<p>
				
				<table width="100%" cellpadding="4" cellspacing="0" border="0">


					
					<form name="agency_edit_form" method="post" action="agency_edit_thanks.php">
					<input type="hidden" name="agency_id" value="<?php echo $agency_id;?>">
					<?php if (!isset($agency_id)) {?>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						<b>*Administrator Username:</b>
						</span>
						</td>
						<td valign="middle">
						<input id="admin_handle" name="admin_handle" type="text" size="20" required>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						<b>*Administrator Password:</b>
						</span>
						</td>
						<td valign="middle">
						<input id="admin_pass" name="admin_pass" type="text" size="20" reuqired>
						</td>
					</tr>
					<?php }?>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						<b>*Agency Name:</b>
						</span>
						</td>
						<td valign="middle">
						<input id="name" name="name" type="text" size="40" value="<?php  if(isset($rowGetAgency)){echo $rowGetAgency->NAME;}?>"required>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						<b>*Abbreviation:</b>
						</span>
						</td>
						<td valign="middle">
						<input id="abv" name="abv" type="text" size="20" value="<?php if(isset($rowGetAgency)){echo $rowGetAgency->ABV;}?>"required>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						<b>*Maximum Active Ads:</b>
						</span>
						</td>
						<td valign="middle">
						<input id="maxact" name="maxact" type="text" size="10" value="<?php if(isset($rowGetAgency)){ echo $rowGetAgency->MAXACT;}?>"required>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						<b>*Access Level:</b>
						</span>
						</td>
						<td valign="middle">
						<input id="level" name="level" type="text" size="10" value="<?php if(isset($rowGetAgency)){ echo $rowGetAgency->LEVEL;}?>"required>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
						<b>*Signature:</b>
						</span>
						</td>
						<td valign="middle">
						<textarea id="sig" name="sig" cols="40" rows="6" required><?php if(isset($rowGetAgency)){echo $rowGetAgency->SIG;}?></textarea>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Restrict Logins to an IP address:
						</span>
						</td>
						<td valign="middle">
						<span class="text">
						No<input type="radio" name="restrict_ip" value="0" <?php if (isset($rowGetAgency)&&!$rowGetAgency->RESTRICT_IP) { echo "checked"; }?>> Yes<input type="radio" name="restrict_ip" value="1" <?php if ( isset($rowGetAgency)&&$rowGetAgency->RESTRICT_IP) { echo "checked"; }?>>
						</span>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						IP Address:
						</span>
						</td>
						<td valign="middle">
						<input name="ip_address" type="text" size="20" value="<?php if(isset($rowGetAgency)){ echo $rowGetAgency->IP_ADDRESS;}?>">
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
						<td valign="top" align="right">
						<span class="text">
						Default HTML Header: 
						</span>
						</td>
						<td valign="middle">
						<textarea name="head" cols="40" rows="6"><?php if(isset($rowGetAgency)){ echo $rowGetAgency->HEAD;}?></textarea>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
						Default HTML Footer: 
						</span>
						</td>
						<td valign="middle">
						<textarea  name="foot" cols="40" rows="6"><?php if(isset($rowGetAgency)){ echo $rowGetAgency->FOOT;}?></textarea>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
					 	Type 1 HTML Header: 
						</span>
						</td>
						<td valign="middle">
						<textarea name="type1_head" cols="40" rows="6"><?php if(isset($rowGetAgency)){echo $rowGetAgency->TYPE1_HEAD;}?></textarea>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
						Type 1 HTML Footer: 
						</span>
						</td>
						<td valign="middle">
						<textarea  name="type1_foot" cols="40" rows="6"><?php if(isset($rowGetAgency)){ echo $rowGetAgency->TYPE1_FOOT;}?></textarea>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
					 	Type 2 HTML Header: 
						</span>
						</td>
						<td valign="middle">
						<textarea name="type2_head" cols="40" rows="6"><?php if(isset($rowGetAgency)){echo $rowGetAgency->TYPE2_HEAD;}?></textarea>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
						Type 2 HTML Footer: 
						</span>
						</td>
						<td valign="middle">
						<textarea  name="type2_foot" cols="40" rows="6"><?php if(isset($rowGetAgency)){echo $rowGetAgency->TYPE2_FOOT;}?></textarea>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
					 	Type 3 HTML Header: 
						</span>
						</td>
						<td valign="middle">
						<textarea name="type3_head" cols="40" rows="6"><?php if(isset($rowGetAgency)){ echo $rowGetAgency->TYPE3_HEAD;}?></textarea>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
						Type 3 HTML Footer: 
						</span>
						</td>
						<td valign="middle">
						<textarea  name="type3_foot" cols="40" rows="6"><?php if(isset($rowGetAgency)){ echo $rowGetAgency->TYPE3_FOOT;}?></textarea>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
					 	Type 4 HTML Header: 
						</span>
						</td>
						<td valign="middle">
						<textarea name="type4_head" cols="40" rows="6"><?php if(isset($rowGetAgency)){echo $rowGetAgency->TYPE4_HEAD;}?></textarea>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
						Type 4 HTML Footer: 
						</span>
						</td>
						<td valign="middle">
						<textarea  name="type4_foot" cols="40" rows="6"><?php if(isset($rowGetAgency)){echo $rowGetAgency->TYPE4_FOOT;}
						?></textarea>
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
				
