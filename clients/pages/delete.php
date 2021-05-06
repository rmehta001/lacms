<!--BEGIN delete -->
		
		Created by : <?php echo "$rowGetAd->HANDLE";?> <br>
		Created On: <?php echo "$rowGetAd->DATEIN";?> <br>
		Last Modifed on : <?php echo "$rowGetAd->MOD";?><br>
		Status : <?php if ($rowGetAd->STATUS=="ACT") {
				echo "Active";
			}else {
				echo "Inactive";
			} ?><br><br>

<TABLE BGCOLOR="#FFFFFF"><TR><TD>

		<?php echo format_ad($rowGetAd, $DEFINED_VALUE_SETS); ?><br>
<HR>
</TD></TR></TABLE>


<?php
if ($rowGetAd->CLI!=$grid) { echo "<FONT COLOR=RED><B>YOU ARE NOT ALLOWED TO DELETE THIS AD</B></FONT><BR><BR>"; } else {

?>


&nbsp;<BR>
		<form action="<?php echo "$PHP_SELF?op=deleteDo";?>" method="POST">
		<input type="hidden" name="cid" value="<?php echo $rowGetAd->CID;?>">
<input type="hidden" name="cli" value="<?php echo $rowGetAd->CLI;?>">
		<B>Please type 'y' to confirm.</B>

		<input type="text" name="conf" size="3">
		

		<input type="submit" value="Delete Ad" STYLE="Background-Color : #A9F5A9"></form>
		<FONT SIZE="-3"><br></FONT>
		
		<?php } ?>
<a href="#" onClick="history.go(-1)"><B><FONT COLOR="RED">Cancel</FONT></B></A>
<BR>
<P>&nbsp;<BR>
		</font>
		</center>

<!--END delete -->