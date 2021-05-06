<!--BEGIN createDeal -->
<br>

<div align="left" style="padding:0px;margin:px;border:1px solid black;width:585;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:15px;color:black;">
<FONT SIZE=-4><BR></FONT>
<!--Tabs-->
<?php include ("folderTabs2.php"); ?>
<!--/Tabs-->
<br>
<br>
<center>	
	<table border="0" cellspacing="0" cellpadding="0" align="center" width="300">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99" width="50%">
			<table>
			<tr>
			
			<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext">Create Deal Sheet for:</div><div class="ad"><?php echo $abv;?>-<?php echo $cid;?></div></td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td width="50%" bgcolor="#FFFF99" align="center">
			<table align="center" border="0">
			<tr>
			<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext">Address:</div><div class="ad"><?php echo $rowGetAd->STREET;?>&nbsp;<?php echo $rowGetAd->APT;?></div></td>
			</tr>
			<tr>
			<td align="center" height="30" bgcolor="#FFFF99"><div class="ad" align="left"><?php echo format_ad($rowGetAd, $DEFINED_VALUE_SETS);?></div></td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<form action="<?php echo "$PHP_SELF?op=createDealDo";?>" name="addClientsToDeal" method="POST">
	<input type="hidden" name="cid" value="<?php echo $rowGetAd->CID;?>">
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99" align="center">
			<table>
			<tr>
			<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext"><B>Add clients to deal.</B></div></td>
			</tr>
			<tr>
			<td align="center" height="30" bgcolor="#FFFF99">
				<table align="center">
				<tr>
				<td height="30" width="160" bgcolor="#FFFF99"><div class="controltext">Client List</div></td>
				<td align="center" height="30" width="90" bgcolor="#FFFF99">&nbsp;</td>
				<td align="center" height="30" width="160" bgcolor="#FFFF99"><div class="controltext">Clients to add to deal</div></td></tr>
				<tr>
				<td align="center" height="30" bgcolor="#FFFF99"><select name="client_list" multiple="multiple" size="10" style="width:200px; Background-Color : #FFFFFF">
					<option value="">* Please select client(s) *</option>
					<?php while ($rowGetClients = mysqli_fetch_object($quGetClients)) {?>
						<option value="<?php echo $rowGetClients->CLID;?>"><?php echo $rowGetClients->NAME_LAST;?>, <?php echo $rowGetClients->NAME_FIRST;?></option>
					<?php } ?>
					</select>
				</td>
				<td align="center" height="30" bgcolor="#FFFF99"><input type="button" class="button" style="width:90px" onclick="addClient();" value="Add &gt;&gt;" /><br><br><input type="button" class="button" style="width:90px" onclick="removeClient();" value="&lt;&lt; Remove" /></td>
				<td align="center" height="30" bgcolor="#FFFF99"> <select id="5" name="selected_clients[]" multiple="multiple" size="10" style="width:200px; Background-Color : #FFFFFF">
                      		</select></td>
                		</tr>
                		</table></td>
                	</tr>
                	</table>
        </td>
        <td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99" align="center">
			<table>
			<tr>
			<td align="center" height="30" bgcolor="#FFFF99"><input type="button" value="Save" onClick="submit_selected_clients();" STYLE="Background-Color : #E0FFFF"></tr>
			</tr>
			</table>
	</td>
        <td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</form>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	<br>
	<br>
	</center>
	</div>
	<br>				
			
<!--END createDeal -->	