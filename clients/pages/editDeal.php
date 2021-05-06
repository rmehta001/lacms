<!--BEGIN editDeal -->
<BR>
<div align="left" style="padding:0px;margin:px;border:1px solid black;width:585;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:15px;color:black;">
<FONT SIZE=-4><br></FONT>
<!--Tabs-->
<?php include ("folderTabs2.php"); ?>
<!--/Tabs-->
<BR>
<br>
<center>
	<table border="0" cellspacing="0" cellpadding="0" width="95%">
	<tr>
	<td colspan="7" valign="top" width="100%" height="10" bgcolor="#FFFFFF"><a href="<?php echo "$PHP_SELF?op=hot_list_add&item_type=2&item_id=$did&item_id2=$cid&return_page=$op&return_page_rid=$did&return_page_rid2=$cid";?>"><img border="0" hspace="0" vspace="0" width="96" height="23" src="../assets/images/addToHotList.jpg"></a></td>
	</tr>
	<tr>
	<td colspan="15" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td colspan="2" bgcolor="#FFFF99">
		<table width="100%">
			<tr>
			
			<td height="30" align="center" bgcolor="#FFFF99"><div class="controltext">Deal Sheet for</div><div class="menu"><?php echo $_SESSION["abv"]."-$rowGetAd->CID <br> $rowGetAd->STREET $rowGetAd->APT, $rowGetAd->LOCNAME";?></div></td>
			
			</tr>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td colspan="2" bgcolor="#FFFF99">
		<table>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="ad" align="left"><?php echo format_ad($rowGetAd, $DEFINED_VALUE_SETS);?></div></td>
			</tr>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td colspan="2" bgcolor="#FFFF99">
		<table height="100" width="100%">
			<form action="<?php echo "$PHP_SELF?op=editDealLandlordFee";?>" method="POST">
			<input type="hidden" name="cid" value="<?php echo $cid;?>">
			<input type="hidden" name="did" value="<?php echo $did;?>">
			
			<tr>
			
			<td height="30" bgcolor="#FFFF99"><div class="ad"><?php echo display_landlord($rowGetAd);?></div></td>
			<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
			
			<td height="30" bgcolor="#FFFF99"><table height="100" width="100%">
					<tr>
					<td align="right" height="30" bgcolor="#FFFF99"><div class="controltext">Landlord Fee: $</div></td>
					<td height="30" bgcolor="#FFFF99"><div class="controltext"><?php echo $rowGetAd->LANDLORD_FEE;?></div></td>
					</tr>
					<tr>
					<td align="right" height="30" bgcolor="#FFFF99"><div class="controltext">Amount Paid: $</div></td>
					<td height="30" bgcolor="#FFFF99"><input type="text" size="5" name="LANDLORD_PAID" value="<?php echo $rowGetDeal->LANDLORD_PAID;?>"></td>
					</tr>
					<tr>
					<td colspan="2" align="center" height="30" bgcolor="#FFFF99"><input type="submit" value="Update Landlord Accounting" STYLE="Background-Color : #E0FFFF"></td>
					</tr>
					
					</table></td>
			</tr>
			</form>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="15" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
		<table height="100" width="75%">
			<tr>
			<td><div class="menu">Client(s):</div></td>
			</tr>
			<?php
			
			$num_clients = mysqli_num_rows($quGetDealClients);
			
			while ($rowGetClients = mysqli_fetch_object($quGetDealClients)) { 
				
				
				
				
				
				
				?>
			
			<tr>
			<td valign="top" height="30" bgcolor="#FFFF99"><table>
				<form action="<?php echo "$PHP_SELF?op=editDealClientStatus";?>" method="POST">
				<input type="hidden" name="dclid" value="<?php echo $rowGetClients->CLID;?>">
				<input type="hidden" name="did" value="<?php echo $did;?>">
				<input type="hidden" name="cid" value="<?php echo $cid;?>">
				<tr>
				<td height="30" bgcolor="#FFFF99" valign="top"><div class="menu"><?php echo "$rowGetClients->NAME_FIRST $rowGetClients->NAME_LAST";?></div><div class="ad"><?php echo "home:$rowGetClients->HOME_PHONE<br>work:$rowGetClients->WORK_PHONE<br>mobile:$rowGetClients->MOBILE_PHONE<br>email:$rowGetClients->CLIENT_EMAIL";?></div></td>
				<td height="30" bgcolor="#FFFF99">&nbsp;</td>
				<td height="30" bgcolor="#FFFF99" valign="top"><div class="menu">Application status:</div><select name="app_status">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['CLIENT_APP_STATUS'] as $askey => $asValue) { 
						$selected = ($rowGetClients->CLIENT_APP_STATUS==$askey) ? " selected " : "";?>
					<option value="<?php echo $askey;?>" <?php echo $selected;?>><?php echo $asValue;?></option>
					<?php } ?>
				</select><br>
				<input type="hidden" name="credit_check" value="0">
				<div class="menu">Credit Check <input type="checkbox" name="credit_check" value="1" <?php if ($rowGetClients->CLIENT_CREDIT_CHECK) { echo " checked "; } ?>><br>
				<input type="submit" value="Update Client Status" STYLE="Background-Color : #E0FFFF"></td>
				<td height="30" bgcolor="#FFFF99"></td>
				</tr>
				</form>
				</table></td>
			
			
			</tr>   
			        
			<?php } ?>
			</table></td>
			<td height="30" align="left" valign="top" bgcolor="#FFFF99">
			<table height="100" width="100%">
					<tr>
					<td  height="30" bgcolor="#FFFF99"><div class="controltext"><form method="GET" action="<?php echo "$PHP_SELF";?>">
					<input type="hidden" name="op" value="editDealAccounting">
					<input type="hidden" name="cid" value="<?php echo $cid;?>">
					<input type="hidden" name="did" value="<?php echo $did;?>">
					<input type="submit" value="View Client accounting details" STYLE="Background-Color : #E0FFFF"></form></div></td>
					</tr>
					
					
					
					</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="15" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
</center>

	<br>
</div>

<!--END editDeal -->