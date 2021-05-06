<?php

function get_thumb ($rowGetAd)
{
	$quStrGetPics = "SELECT * FROM PICTURE WHERE CID=$rowGetAd->CID ORDER BY PID LIMIT 1";
	$quGetPics = mysqli_query($dbh, $quStrGetPics);
	if($rowGetPics = mysqli_fetch_object($quGetPics))
	{	$rowGetPics="<a href=\"https://www.BostonApartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$rowGetAd->CID\"><img border=0 src='https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT' width='125' alt='$rowGetPics->DESCRIPT'></a><br>"; }
	return $rowGetPics;
}

$thumb=get_thumb($rowGetAd);
$adstring= format_ad_email ($rowGetAd, $DEFINED_VALUE_SETS);

?>



<h1>Send an Email</h1>
<form action="mail.php" method="POST" enctype="multipart/form-data">
<p>
<TABLE><TR><TD>

To: 

</TD><TD>

<input type="text" name="to" value="" /><br />




</TD></TR><TR><TD>

From: 
</TD><TD>


<input type="text" name="from" value="<?php echo "$rowGetUser->EMAIL";?>" /><br />
</TD></TR><TR><TD>

Subject: </TD><TD>

<input type="text" name="subject" value="" /></p>

</TD></TR></TABLE>

<p>Message:<br />




<textarea cols="70" rows="20" name="message" value="">


<?php echo $adstring;?>

<?php echo $thumb;?>





</textarea></p>
<p>File Attachment: <input type="file" name="fileatt" /></p>
<p><input type="submit" value="Send" /></p>


</form>




<?php if ($cid) {?>

Ad ID#: <?php echo "$rowGetAd->ABV";?>-<?php echo "$rowGetAd->CID";?> <br>
Created by: <?php echo "$rowGetAd->HANDLE";?> <br>
On: <?php echo "$rowGetAd->DATEIN";?> <br>
Last Modifed on: <?php echo "$rowGetAd->MOD";?><br>
Last Modifed by: <?php echo "$rowGetAd->MODBY";?><br>
Status: <?php if ($rowGetAd->STATUS=="ACT") {
				echo "Active Ad";
			}else {
				echo "Inactive Ad";
			} ?>


 / Unit is <?php if ($rowGetAd->STATUS_ACTIVE=="1") {
				echo "Available";
			}else {
				echo "Unavailable";
			} ?>
<?php }else {?>
	
Not a valid listing number.

<?php }?>


<BR><BR>



				<table align="center">
				<tr>
				<td height="30" width="160" bgcolor="#FFFF99"><div class="controltext">Client List</div></td>
				<td align="center" height="30" width="90" bgcolor="#FFFF99">&nbsp;</td>
				<td align="center" height="30" width="160" bgcolor="#FFFF99"><div class="controltext">Clients to add to deal</div></td></tr>
				<tr>
				<td align="center" height="30" bgcolor="#FFFF99"><select name="client_list" multiple="multiple" size="10" style="width:200px">
					<option value="">* Please select client(s) *</option>
					<?php while ($rowGetClients = mysqli_fetch_object($quGetClients)) {?>
						<option value="<?php echo $rowGetClients->CLID;?>"><?php echo $rowGetClients->NAME_LAST;?>, <?php echo $rowGetClients->NAME_FIRST;?> - <?php echo $rowGetClients->CLIENT_EMAIL;?></option>
					<?php } ?>
					</select>
				</td>
				<td align="center" height="30" bgcolor="#FFFF99"><input type="button" class="button" style="width:90px" onclick="addClient();" value="Add &gt;&gt;" /><br><br><input type="button" class="button" style="width:90px" onclick="removeClient();" value="&lt;&lt; Remove" /></td>
				<td align="center" height="30" bgcolor="#FFFF99"> <select id="5" name="selected_clients[]" multiple="multiple" size="10" style="width:200px">
                      		</select></td>
                		</tr>
                		</table>


</body>
</html>