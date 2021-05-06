<!--BEGIN manageListingDeals -->
<span style="font-size:5px;"><BR></span>
<div align="left" style="padding:0px;margin:px;border:1px solid black;width:780;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:15px;color:black;">
<FONT SIZE=-4><BR></FONT>
<!--Tabs-->
<?php include ("folderTabs2.php"); ?>
<!--/Tabs-->
<BR><center>
<TABLE BGCOLOR="#FFFFFF" BORDER=0><TR>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/dealsheets.jpg" HEIGHT="54" WIDTH="87">
</TD>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<h3><NOBR>DEAL SHEETS</NOBR></H3>
</TD></TR></TABLE>


	<table width="80%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td align="left" colspan="8" valign="top"  height="1" bgcolor="#FFFFFF"><a href="<?php echo "$PHP_SELF?op=createDeal&cid=$cid";?>"><img border="0" hspace="0" vspace="0" width="65" height="22" src="../assets/images/newDeal.jpg"></a></td>
	</tr>
	<tr>
	<td colspan="8" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="15" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="left" bgcolor="#99CCFF"><div class="controltext">Status</div></td>
	<td align="left" width="250" bgcolor="#99CCFF"><div class="controltext">Client(s)</div></td>
	<td align="left" bgcolor="#99CCFF"><div class="controltext">Approval</div></td>
	<td align="left" bgcolor="#99CCFF"><div class="controltext">Balance</div></td>
	<td align="left" bgcolor="#99CCFF">&nbsp;</td>
	<td align="left" bgcolor="#99CCFF">&nbsp;</td>
	<td valign="top" height="15" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="8" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<?php $rowColor = "#F5F5DC";?>
	<?php while ($rowGetDeals = mysqli_fetch_object($quGetDeals)) {
		$Client_Str = "";
		$Client_Sum = 0;
		$Client_Balance = "";
		$Listing_Sum = 0;
		$quStrGetDealClients = "SELECT * FROM DEALCLIENTS INNER JOIN CLIENTS ON DEALCLIENTS.DCLID=CLIENTS.CLID WHERE DID='$rowGetDeals->DID' ORDER BY NAME_LAST";
		$quGetDealClients = mysqli_query($GLOBALS['dbh'], $quStrGetDealClients);
		$num_clients = mysqli_num_rows($quGetDealClients);
		$i=0;
		while ($rowGetClients = mysqli_fetch_object($quGetDealClients)) {
			$i++;
			$Client_Str .= "$rowGetClients->NAME_FIRST $rowGetClients->NAME_LAST";
			switch ($num_clients - $i) {
				case 0: 
					$Client_Str .= "";
					break;
				case 1: $Client_Str .= " and ";
					break;
				default:
					$Client_Str .= ", ";
		                        break;           
		        }
		    	$Client_Sum += $rowGetClients->TENANT_FEE_PAID;
   			$Client_Sum += $rowGetClients->PAYMENT_FIRST_PAID;
   			$Client_Sum += $rowGetClients->PAYMENT_LAST_PAID;
   			$Client_Sum += $rowGetClients->PAYMENT_SEC_PAID;
   			$Client_Sum += $rowGetClients->KEY_DEP_PAID;
   			$Client_Sum += $rowGetClients->CLEAN_DEP_PAID;
    	
		
		}
		$Listing_Sum += $rowGetDeals->TENANT_FEE;
   		$Listing_Sum += $rowGetDeals->LANDLORD_FEE;
   		$Listing_Sum += $rowGetDeals->PAYMENT_FIRST;
   		$Listing_Sum += $rowGetDeals->PAYMENT_LAST;
   		$Listing_Sum += $rowGetDeals->PAYMENT_SEC;
   		$Listing_Sum += $rowGetDeals->KEY_DEPOSIT;
   		$Listing_Sum += $rowGetDeals->CLEAN_DEPOSIT;
		
		if ($Listing_Sum==$Client_Sum) {
			$Client_Balance = "Paid";
		}elseif ($Listing_Sum < $Client_Sum) {
			$Client_Balance = "Over Paid";
		}elseif ($Listing_Sum > $Client_Sum) {
			$Client_Balance = "Unpaid";
		}

	?>

		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td bgcolor="<?php echo $rowColor;?>"><div class="ad">&nbsp;<?php echo $DEFINED_VALUE_SETS['DSTATUS'][$rowGetDeals->DSTATUS];?></div></td>
		<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><?php echo $Client_Str;?></div></td>
		<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><!--?php echo $DEFINED_VALUE_SETS['STATUS'][$rowGetDeals->STATUS];?--><div></td>
		<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><?php echo $Client_Balance;?></td>
		<td bgcolor="<?php echo $rowColor;?>"><a href="<?php echo "$PHP_SELF?op=editDeal&cid=$cid&did=$rowGetDeals->DID";?>"><img width="28" height="15" border="0" vspace="0" hspace="0" src="../assets/images/edit.jpg"></a></td>
		<td bgcolor="<?php echo $rowColor;?>"><?php if ($rowGetDeals->DUID==$uid) { echo "<a href='$PHP_SELF?op=deleteDeal&cid=$rowGetDeals->CID&did=$rowGetDeals->DID'><img width='39' height='15' border='0' vspace='0' hspace='0' src='../assets/images/delete.jpg'></a>"; }?></td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>

		<?php if ($rowColor=="#F5F5DC") {
    			$rowColor="#FFFFFF";
    		}else {
    			$rowColor="#F5F5DC";
    		}
   	 }?>
		
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td colspan="6" bgcolor="<?php echo $rowColor;?>">&nbsp;</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<?php if ($rowColor=="#F5F5DC") {
    		$rowColor="#FFFFFF";
    	}else {
    		$rowColor="#F5F5DC";
    	}?>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td colspan="6" bgcolor="<?php echo $rowColor;?>">&nbsp;</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="8" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	<br>
	<br>
	</center>
	</div>
	<br>
	<br>
	
	
	

<!--End manageListingDeals -->