<!--BEGIN editDealAccounting -->
	<?php 
	$Listing_Sum = 0;
	$Listing_Sum += $rowGetAd->TENANT_FEE;
	$Listing_Sum += $rowGetAd->PAYMENT_FIRST;
	$Listing_Sum += $rowGetAd->PAYMENT_LAST;
	$Listing_Sum += $rowGetAd->PAYMENT_SEC;
	$Listing_Sum += $rowGetAd->CLEAN_DEPOSIT;
	$Listing_Sum += $rowGetAd->KEY_DEPOSIT;
	?>
<br>

<div align="left" style="padding:0px;margin:px;border:1px solid black;width:585;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:15px;color:black;">
<!--Tabs-->
<?php include ("folderTabs2.php"); ?>
<!--/Tabs-->
<br>
<br>
<center>

	<table border="0" cellspacing="0" cellpadding="0" width="75%">
	<tr>
	<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td colspan="1" bgcolor="#FFFF99"><table width="100%">
			<tr>
			<td height="30" align="center" bgcolor="#FFFF99"><div class="controltext">Deal Sheet Accounting for</div><div class="menu"><?php echo "$abv-$rowGetAd->CID <br> $rowGetAd->STREET $rowGetAd->APT, $rowGetAd->LOCNAME";?></div></td>
			</tr>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99"><table width="100%">
			<tr>
			<td align="center" bgcolor="#FFFF99"><table width="100%" cellspacing="0" cellpadding="0" bgcolor="FFFFFF">
					<tr>
					<td height="30" align="center" bgcolor="#FFFF99">&nbsp;</td>
					<td valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="controltext">Tenant Fee</div></td>
					<td valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="controltext">First Month</div></td>
					<td valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="controltext">Last Month</div></td>
					<td valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="controltext">Security Deposit</div></td>
					<td valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="controltext">Cleaning Deposit</div></td>
					<td valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="controltext">Key Deposit</div></td>
					<td valign="top" width="1" height="100%" bgcolor="#FFFF99"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="controltext">Total</div></td>
					</tr>
					<tr>
					<td colspan="15" valign="top" width="100%" height="1"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
					</tr>
					<tr>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="ad">Due:</div></td>
					<td valign="top" width="1" height="100%" bgcolor="#FFFF99"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="ad">$<?php echo $rowGetAd->TENANT_FEE;?></div></td>
					<td valign="top" width="1" height="100%" bgcolor="#FFFF99"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="ad">$<?php echo $rowGetAd->PAYMENT_FIRST;?></div></td>
					<td valign="top" width="1" height="100%" bgcolor="#FFFF99"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="ad">$<?php echo $rowGetAd->PAYMENT_LAST;?></div></td>
					<td valign="top" width="1" height="100%" bgcolor="#FFFF99"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="ad">$<?php echo $rowGetAd->PAYMENT_SEC;?></div></td>
					<td valign="top" width="1" height="100%" bgcolor="#FFFF99"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="ad">$<?php echo $rowGetAd->CLEAN_DEPOSIT;?></div></td>
					<td valign="top" width="1" height="100%" bgcolor="#FFFF99"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="ad">$<?php echo $rowGetAd->KEY_DEPOSIT;?></div></td>
					<td valign="top" width="1" height="100%" bgcolor="#FFFF99"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="#FFFF99"><div class="ad">$<?php echo $Listing_Sum;?></div></td>
					</tr>
					<form action="<?php echo "$PHP_SELF?op=editDealAccountingDo&did=$did&cid=$cid";?>" method="POST">
					
					<tr>
					<td colspan="15" valign="top" width="100%" height="1"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
					</tr>
					<?php
			
					$num_clients = mysqli_num_rows($quGetDealClients);
					
					$rowColor = "#FFFF99";
					while ($rowGetClients = mysqli_fetch_object($quGetDealClients)) { 
					$Client_Sum = 0;
					$Client_Sum += $rowGetClients->TENANT_FEE_PAID;
   					$Client_Sum += $rowGetClients->PAYMENT_FIRST_PAID;
   					$Client_Sum += $rowGetClients->PAYMENT_LAST_PAID;
   					$Client_Sum += $rowGetClients->PAYMENT_SEC_PAID;
   					$Client_Sum += $rowGetClients->KEY_DEP_PAID;
   					$Client_Sum += $rowGetClients->CLEAN_DEP_PAID;
   					$CLIENTS_SUM += $Client_Sum;
					
					$share_tenant_fee = round(($rowGetAd->TENANT_FEE/$num_clients), 2);
					$share_payment_first = round(($rowGetAd->PAYMENT_FIRST/$num_clients), 2);
					$share_payment_last = round(($rowGetAd->PAYMENT_LAST/$num_clients), 2);
					$share_payment_sec = round(($rowGetAd->PAYMENT_SEC/$num_clients), 2);
					$share_key_dep = round(($rowGetAd->KEY_DEPOSIT/$num_clients), 2);
					$share_clean_dep = round(($rowGetAd->CLEAN_DEPOSIT/$num_clients), 2);
					
					?>
					
					
					<td height="30" align="center" bgcolor="<?php echo $rowColor;?>"><div class="ad"><?php echo "$rowGetClients->NAME_FIRST $rowGetClients->NAME_LAST";?></div></td>
					<td valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="<?php echo $rowColor;?>"><input type="text" size="5" name="<?php echo $rowGetClients->CLID;?>~TENANT_FEE_PAID" value="<?php echo $rowGetClients->TENANT_FEE_PAID;?>"></td>
					<td valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="<?php echo $rowColor;?>"><input type="text" size="5" name="<?php echo $rowGetClients->CLID;?>~PAYMENT_FIRST_PAID" value="<?php echo $rowGetClients->PAYMENT_FIRST_PAID;?>"></td>
					<td valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="<?php echo $rowColor;?>"><input type="text" size="5" name="<?php echo $rowGetClients->CLID;?>~PAYMENT_LAST_PAID" value="<?php echo $rowGetClients->PAYMENT_LAST_PAID;?>"></td>
					<td valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="<?php echo $rowColor;?>"><input type="text" size="5" name="<?php echo $rowGetClients->CLID;?>~PAYMENT_SEC_PAID" value="<?php echo $rowGetClients->PAYMENT_SEC_PAID;?>"></td>
					<td valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="<?php echo $rowColor;?>"><input type="text" size="5" name="<?php echo $rowGetClients->CLID;?>~CLEAN_DEP_PAID" value="<?php echo $rowGetClients->CLEAN_DEP_PAID;?>"></td>
					<td valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="<?php echo $rowColor;?>"><input type="text" size="5" name="<?php echo $rowGetClients->CLID;?>~KEY_DEP_PAID" value="<?php echo $rowGetClients->KEY_DEP_PAID;?>"></td>
					<td valign="top" width="1" height="100%" bgcolor="<?php echo $rowColor;?>"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td height="30" align="center" bgcolor="<?php echo $rowColor;?>"><div class="ad">$<?php echo $Client_Sum; ?></div></td>
					</tr>
					
					<?php if ($rowColor=="#FFFF99") {
				    		$rowColor="#FFFFFF";
				    	}else {
				    		$rowColor="#FFFF99";
				    	}?>
									
					<?php } 
					$BALANCE = $Listing_Sum - $CLIENTS_SUM;
					?>
					<tr>
					<td colspan="15" valign="top" width="100%" height="1"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
					</tr>
					
					<tr>
					<td bgcolor="#FFFF99" colspan="12">&nbsp;</td>
					<td bgcolor="#FFFF99"><div class="controltext">Balance</div></td>
					<td bgcolor="#FFFF99" valign="top" width="1" height="100%"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
					<td bgcolor="#FFFF99"><div class="ad">$<?php echo $BALANCE;?></div></td>
					</tr>
					<tr>
					<td bgcolor="#FFFF99" colspan="13">&nbsp;</td>
					<td bgcolor="#FFFF99">&nbsp;</td>
					<td bgcolor="#FFFF99" align="center"><input type="submit" value="Update"></td>
					</tr>
					</form>
					<tr>
					<td colspan="15" bgcolor="#FFFF99"><div class="ad"><a href="<?php echo "$PHP_SELF?op=editDeal&cid=$cid&did=$did";?>"><- Back to the Deal Sheet</a></div></td>
					</tr>
					
					</table>
			</td>
			</tr>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	<br>
	<br>
	</center>
	</div>
	<br>
	<br>
	
					
					
					
   				
   				
				
				
				
<!--END editDealAccounting -->