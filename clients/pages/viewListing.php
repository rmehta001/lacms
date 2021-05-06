<!--BEGIN viewListing -->
	<?php
	$avail = ($rowGetAd->AVAIL=="0000-00-00") ? "" : "$rowGetAd->AVAIL";
	$availb = ($rowGetAd->AVAILB) ? "Yes" : "No";
	$status = ($rowGetAd->STATUS=="ACT") ? "Active" : "Inactive";
	$price = ($rowGetAd->PRICE) ? "$" . number_format ($rowGetAd->PRICE) : "";
	
	?>	
	
	<div align="center">
	<p>
	<center><h2>View Listing <?php echo "$abv-$cid";?></h2>
	<?php if ($dontPrintHeader) { ?>
		<a href="<?php echo "$PHP_SELF?op=editListing&cid=$cid";?>">switch to edit mode</a> | <a href="javascript:print_screen();">Print Screen</a> | <a href="javascript:close_window();">Close Window</a>
	<?php } else { ?>
	<a href="<?php echo "$PHP_SELF?op=editListing&cid=$cid";?>">switch to edit mode</a> | <a href="<?php echo "$PHP_SELF?op=viewListing&cid=$cid&dontPrintHeader=1";?>">switch to print mode</a> | <a href="<?php echo "$PHP_SELF?op=edit&cid=$cid";?>">edit advertisment</a></center>
	<?php } ?>
	
	<table cellpadding="4" cellspacing ="0" border=0>
	<tr>
		<td colspan=3>
		<p>
		<?php echo $rowGetAd->SIG;?>
		</p>
		</td>
		
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td >
		<p>
		Landlord:<br>
		<b><?php echo $rowGetAd->HOME_NAME_FIRST;?> <?php echo $rowGetAd->HOME_NAME_LAST;?>,<br> <?php echo $rowGetAd->OFF_NAME;?></b>
		</td>
		<td align="center" width="50%">
		<p>
		<b>
		<?php echo $rowGetAd->LOCNAME;?><br>
		<?php echo $rowGetAd->STREET;?> <?php if ($rowGetAd->APT) { echo", Apt. $rowGetAd->APT"; }?><br>
		<?php echo $DEFINED_VALUE_SETS['ROOMS'][$rowGetAd->ROOMS];?> / <?php echo $DEFINED_VALUE_SETS['BATH'][$rowGetAd->BATH];?>
		
		<br>
		<?php if ($rowGetAd->PETSA) { echo $DEFINED_VALUE_SETS['PETSA'][$rowGetAd->PETSA]; } ?>
		</b>
		</p>
		</td>
		<td align="right" >
		<p>
		<b><?php echo $rowGetAd->NAME;?></b>
		<br>
		entry date:
		<br>
		<?php echo $rowGetAd->DATEIN;?>
		<br>
		last modified:
		<br>
		<?php echo $rowGetAd->MOD;?><br>
		By:<?php echo $rowGetAd->MODBY;?>
		
		</p>
		</td>
	</tr>
	<tr> 
		<td colspan="3" align="center" width="50%">
		<br>Available: <?php echo $rowGetAd->AVAIL;?>
		<br>Price: <?php echo $price;?>
		</td>
	<tr>
		<td ><img src="spacer.gif" width="100%" height="1"></td>
		<td ><img src="spacer.gif" width="100%" height="1"></td>
		<td ><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
		<b>Status:</b>
		<br>
		Advertising: <?php if ($rowGetAd->STATUS=="ACT") { echo "Active"; } else { echo "Inactive"; }?> &nbsp;&nbsp;|&nbsp;&nbsp; 
		Vacancy: <?php if ($rowGetAd->VACANT) { echo "Vacant"; } else { echo "Occupied"; }?> &nbsp;&nbsp;|&nbsp;&nbsp; 
		Available: <?php if ($rowGetAd->STATUS_ACTIVE) { echo "Available"; } else { echo "Not available"; }?><br>  
		</td>
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="left">
		<b>Advertisement:</b>
		<br>
		<?php echo format_ad($rowGetAd, $DEFINED_VALUE_SETS);?>
		</td>
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan=3>
		<b>Notes:</b>
		<br>
		<?php echo $rowGetAd->LISTING_NOTES;?>
		</td>
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	</table>
	</p>
	<p>
	<table cellpadding="4" cellspacing ="0" border=0>
	<tr>
		<td colspan="4">
		<b></b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>listing type:</b>
		</td>
		<td width="25%">
		<?php echo $DEFINED_VALUE_SETS['LISTING_TYPE'][$rowGetAd->LISTING_TYPE];?>
		</td>
		<td width="25%" align="right">
		<b>date listed</b>
		</td>
		<td width="25%">
		<?php echo $rowGetAd->DATEIN;?>
		</td>
	</tr>
		<td width="25%" align="right">
		<b>lease type:</b>
		</td>
		<td width="25%">
		<?php echo $DEFINED_VALUE_SETS['LEASE_TYPE'][$rowGetAd->LEASE_TYPE];?>
		</td>
		<td width="25%" align="right">
		<b>terms:</b>
		</td>
		<td width="25%">
		<?php echo $rowGetAd->TERMS;?>
		</td>
	</tr>
	</tr>
		<td width="25%" align="right">
		<b>price negotiable:</b>
		</td>
		<td width="25%">
		<?php if ($rowGetAd->PRICE_NEG) { echo "Yes"; } else { echo "No."; } ?>
		</td>
		<td width="25%" align="right">
		&nbsp;
		</td>
		<td width="25%">
		&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<b>Fee</b>
		</td>
	</tr>
		<td width="25%" align="right">
		<b>Broker Fee:</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->BROKER_FEE;?> 
		</td>
		<td width="25%" align="right">
		<b></b>
		</td>
		<td width="25%">
		&nbsp;
		</td>
	</tr>
		<td width="25%" align="right">
		<b>First:</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->PAYMENT_FIRST;?> 
		</td>
		<td width="25%" align="right">
		<b>&nbsp</b>
		</td>
		<td width="25%">
		
		</td>
		<td width="25%" align="right">
		
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Last:</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->PAYMENT_LAST;?>  
		</td>
		<td width="25%" align="right">
		&nbsp;
		</td>
		<td width="25%">
		&nbsp;
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Security:</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->PAYMENT_SEC;?> 
		</td>
		<td width="25%" align="right">
		<b>&nbsp;</b>
		</td>
		<td width="25%">
		&nbsp;
		</td>
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Key Deposit:</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->KEY_DEPOSIT;?> 
		</td>
		
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Cleaning Deposit:</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->CLEAN_DEPOSIT;?> 
		</td>
		
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Total:</b>
		</td>
		<td width="25%">
		<?php 
			$totalDue = ($rowGetAd->PAYMENT_LAST + $rowGetAd->PAYMENT_FIRST + $rowGetAd->PAYMENT_SEC + $rowGetAd->BROKER_FEE + $rowGetAd->KEY_DEPOSIT + $rowGetAd->CLEAN_DEPOSIT );
			
		?>
		<?php echo "\$" . $totalDue;?> 
		</td>
	</tr>
	
	<tr>
		<td width="25%" align="right">
		<b>Fee Comments:</b>
		</td>
		<td width="25%">
		<?php echo $rowGetAd->FEE_COMMENTS;?>
		</td>
		
	<tr>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	
	<tr>
		<td colspan="4">
		<b>Parking</b>
		</td>
	</tr>
		<td width="25%" align="right">
		<b>Number of spaces:</b>
		</td>
		<td width="25%">
		<?php echo $rowGetAd->PARKING_NUM;?>
		</td>
		<td width="25%" align="right">
		<b>Cost per space</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->PARKING_COST;?>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Type:</b>
		</td>
		<td width="25%">
		<?php echo $DEFINED_VALUE_SETS['PARKING_TYPE'][$rowGetAd->PARKING_TYPE];?>
		</td>
		<td width="25%" align="right">
		<b>&nbsp</b>
		</td>
		<td width="25%">
		
		</td>
		<td width="25%" align="right">
		
		
	</tr>
	<tr>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<b>Key Info</b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Key is:</b>
		</td>
		<td width="25%">
		<?php echo $rowGetAd->KEY_INFO;?>
		</td>
		<td width="25%" align="right">
		<b>&nbsp</b>
		</td>
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Show instructions:</b>
		</td>
		<td colspan="2">
		<?php echo $rowGetAd->SHOW_INSTRUCT;?>
		</td>
		
		
	</tr>
	<tr>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<b>Laundry/Storage</b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Laundry:</b>
		</td>
		<td width="25%">
		<?php echo $DEFINED_VALUE_SETS['LAUNDRY_ROOM'][$rowGetAd->LAUNDRY_ROOM];?>
		</td>
		<td width="25%" align="right" valign="top">
		<b>Storage:</b>
		</td>
		<td width="25%">
		Attic: <?php if ($rowGetAd->STORAGE_ATTIC) { echo "Yes."; } else { echo "No.";}?><br>
		Basement: <?php if ($rowGetAd->STORAGE_BASEMENT) {echo "Yes."; }else { echo "No.";}?><br>
		Bin: <?php if ($rowGetAd->STORAGE_BIN) {echo "Yes."; }else { echo "No."; }?><br>
		</td>
		
	</tr>
	<tr>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	</table>
	<p>
	<table cellpadding="4" cellspacing ="0" border=0>
	<tr>
		<td colspan="4">
		<b>Features:</b>
		</td>
	</tr>
	<?php 
	 
	?>
	<tr>
		<td colspan="3">
		<?php 
		
		if ($rowGetAd->FEATURES_DELEADED        ) { echo "Deleaded"         ; }
		if ($rowGetAd->FEATURES_FURNISHED       ) { echo " &nbsp;&nbsp;Furnished"     ; }
		if ($rowGetAd->FEATURES_NON_SMOKING     ) { echo " &nbsp;&nbsp;Non-smoking"   ; }
		if ($rowGetAd->FEATURES_ALARM           ) { echo " &nbsp;&nbsp;Alarm"         ; }
		if ($rowGetAd->FEATURES_HEAT            ) { echo " &nbsp;&nbsp;Heat"          ; }
		if ($rowGetAd->FEATURES_HOT_WATER       ) { echo " &nbsp;&nbsp;Hot Water"     ; }
		if ($rowGetAd->FEATURES_HT_AND_HW       ) { echo " &nbsp;&nbsp;Heat & Hot Water"       ; }
		if ($rowGetAd->FEATURES_ALL_UTILITIES   ) { echo " &nbsp;&nbsp;All Utilities" ; }
		if ($rowGetAd->FEATURES_GAS_HEAT        ) { echo " &nbsp;&nbsp;Gas Heat"      ; }
		if ($rowGetAd->FEATURES_OIL_HEAT        ) { echo " &nbsp;&nbsp;Oil Heat"      ; }
		if ($rowGetAd->FEATURES_ELEC_HEAT       ) { echo " &nbsp;&nbsp;Electric Heat"     ; }
		if ($rowGetAd->FEATURES_HWFI            ) { echo " &nbsp;&nbsp;Hardwood floors"          ; }
		if ($rowGetAd->FEATURES_FIREPLACE       ) { echo " &nbsp;&nbsp;Fireplace"     ; }
		if ($rowGetAd->FEATURES_CARPET          ) { echo " &nbsp;&nbsp;Carpet"        ; }
		if ($rowGetAd->FEATURES_MODERN_KITCHEN  ) { echo " &nbsp;&nbsp;Modern Kitchen"; }
		if ($rowGetAd->FEATURES_KITCHENETTE     ) { echo " &nbsp;&nbsp;Kitchenette"   ; }
		if ($rowGetAd->FEATURES_EAT_IN_KITCHEN  ) { echo " &nbsp;&nbsp;Eat-in-Kitchen"; }
		if ($rowGetAd->FEATURES_GAS_RANGE       ) { echo " &nbsp;&nbsp;Gas Range"     ; }
		if ($rowGetAd->FEATURES_ELEC_RANGE      ) { echo " &nbsp;&nbsp;Elec Range"    ; }
		if ($rowGetAd->FEATURES_DISPOSAL        ) { echo " &nbsp;&nbsp;Disposal"      ; }
		if ($rowGetAd->FEATURES_DISHWASHER      ) { echo " &nbsp;&nbsp;Dishwasher"    ; }
		if ($rowGetAd->FEATURES_SKYLIGHT        ) { echo " &nbsp;&nbsp;Skylight"      ; }
		if ($rowGetAd->FEATURES_PORCH           ) { echo " &nbsp;&nbsp;Porch"         ; }
		if ($rowGetAd->FEATURES_BALCONY         ) { echo " &nbsp;&nbsp;Balcony"       ; }
		if ($rowGetAd->FEATURES_PATIO           ) { echo " &nbsp;&nbsp;Patio"         ; }
		if ($rowGetAd->FEATURES_CENTRAL_AC      ) { echo " &nbsp;&nbsp;Central AC"    ; }
		if ($rowGetAd->FEATURES_AC              ) { echo " &nbsp;&nbsp;AC"            ; }
		if ($rowGetAd->FEATURES_DECK            ) { echo " &nbsp;&nbsp;Deck"          ; }
		if ($rowGetAd->FEATURES_MODERN_BATH     ) { echo " &nbsp;&nbsp;Modern Bath"   ; }
		if ($rowGetAd->FEATURES_WHIRLPOOL     ) { echo " &nbsp;&nbsp;Whirlpool Tub"   ; }
		if ($rowGetAd->FEATURES_DINNING_ROOM    ) { echo " &nbsp;&nbsp;Dining Room"  ; }
		
		
		
		?>
		</td>
		
	</tr>   
	<tr>    
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>   
	<tr>    
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>   
	<tr>    
		<td colspan="4">
		<b>Amenities:</b>
		</td>
	</tr>   
	<?php //divide by three here and list $Amenities; 
	?>      
	<tr>    
		<td colspan="3">
		
		<?php 
		if ($rowGetAd->AMENITIES_CONCIEARGE ) { echo "Concierge"    ; }
		if ($rowGetAd->AMENITIES_ELEVATOR   ) { echo " &nbsp;&nbspElevator"   ; }
		if ($rowGetAd->AMENITIES_DECK       ) { echo " &nbsp;&nbspDeck"       ; }
		if ($rowGetAd->AMENITIES_ROOF_DECK  ) { echo " &nbsp;&nbspRoof Deck"  ; }
		if ($rowGetAd->AMENITIES_GARDEN     ) { echo " &nbsp;&nbspGarden"     ; }
		if ($rowGetAd->AMENITIES_YARD       ) { echo " &nbsp;&nbspYard"       ; }
		if ($rowGetAd->AMENITIES_SECURITY   ) { echo " &nbsp;&nbspSecurity"   ; }
		if ($rowGetAd->AMENITIES_HEALTH_CLUB) { echo " &nbsp;&nbspHealth Club"; }
		if ($rowGetAd->AMENITIES_POOL       ) { echo " &nbsp;&nbspPool"       ; }
		if ($rowGetAd->AMENITIES_TENNIS     ) { echo " &nbsp;&nbspTennis"     ; }
		if ($rowGetAd->AMENITIES_LOUNGE     ) { echo " &nbsp;&nbspLounge"     ; }
		if ($rowGetAd->AMENITIES_SAUNA      ) { echo " &nbsp;&nbspSauna"      ; }
		if ($rowGetAd->AMENITIES_HIGH_CEILINGS      ) { echo " &nbsp;&nbspHigh Ceilings"      ; }
		if ($rowGetAd->AMENITIES_WALK_IN_CLOSET      ) { echo " &nbsp;&nbspWalk-in Closet"      ; }
		if ($rowGetAd->AMENITIES_BALCONY      ) { echo " &nbsp;&nbspBalcony"      ; }
		


		?>                                                                
		
		</td>
		
	</tr>
	<?php if ($rowGetAd->BUILDING_TYPE) { ?>
	<tr>
		<td width="25%"><img src="spacer.gif" width=151 height="1"></td>
		<td width="25%"><img src="spacer.gif" width=151 height="1"></td>
		<td width="25%"><img src="spacer.gif" width=151 height="1"></td>
		<td width="25%"><img src="spacer.gif" width=151 height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	<tr>
		<td colspan="4">
		<b>Building Type:</b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<?php echo $DEFINED_VALUE_SETS['BUILDING_TYPE'][$rowGetAd->BUILDING_TYPE]; ?>
		</td>
		
	</tr>
	<?php }?>
	
	<tr>
	
	
	
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	<tr>
		<td colspan="4">
		<b>Misc:</b>
		</td>
	</tr>
	<tr>
		
		<td width="25%" align="right" valign="top">
		Students:
		</td>
		<td width="25%">
		<?php  echo $rowGetAd->STUDENTS;?>
		</td>
		
	</tr>
	<tr>
		<td width="25%" align="right">
		Tax Clause:
		</td>
		<td width="25%">
		<?php echo $rowGetAd->TAX_CLAUSE;?>
		</td>
		<td width="25%" align="right" valign="top">
		Alarm:
		</td>
		<td width="25%">
		<?php  echo $rowGetAd->ALARM;?>
		</td>
		
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<?php if ($rowGetAd->LANDLORD) { ?>
	<tr>
		<td colspan="4">
		<b>Landlord</b>
		</td>
	</tr>
	
	
	<tr>
		<td width="25%" align="right" valign="top" >
		<?php echo $rowGetAd->HOME_NAME_FIRST;?>  <?php echo $rowGetAd->HOME_NAME_LAST;?><br><br>
		
			<?php
			if ($rowGetAd->HOME_STREET) {
				echo "Home Address:<br> \n";
				echo "$rowGetAd->HOME_STREET <br> \n $rowGetAd->HOME_STATE $rowGetAd->HOME_ZIP <br><br>";
			}
			if ($rowGetAd->HOME_PHONE) {
				echo "Home Phone: $rowGetAd->HOME_PHONE <br> \n";
			}
			if ($rowGetAd->HOME_FAX) {
				echo "Home Fax: $rowGetAd->HOME_FAX <br> \n";
			}
			?>
		
		
		
		</td>
		<td width="25%" align="right" valign="top" >
		<?php echo $rowGetAd->OFF_NAME;?><br><br>
		
		<?php
			if ($rowGetAd->OFF_STREET) {
				echo "Business Address:<br> \n";
				echo "$rowGetAd->OFF_STREET <br> \n";
				echo "$rowGetAd->OFF_CITY, $rowGetAd->OFF_STATE $rowGetAd->OFF_ZIP<br><br>";
			}
			if ($rowGetAd->OFF_PHONE) {
				echo "Business Phone: $rowGetAd->OFF_PHONE <br> \n";
			}
			if ($rowGetAd->OFF_FAX) {
				echo "Business Fax: $rowGetAd->OFF_FAX <br><br> \n";
			}
			
			?>
		</td>
	</tr>
	<tr>
		<td  colspan="2">
		
			<?php 
			if ($rowGetAd->LLNOTES) {
				echo "<br><br>COMMENTS: $rowGetAd->LLNOTES <br> \n";
			}
			if ($rowGetAd->ADDENDUM) {
				echo "<br><br>ADDENDUM: $rowGetAd->ADDENDUM <br> \n";
			}
			?>
		</td>
	</tr>
	
	<? } ?>
	
		<tr>
		<td colspan="3" align="center">
		&nbsp;
		</td>
	</tr>
	</table>
	</p>
	</div>
	
	
	


<!--END viewListing -->