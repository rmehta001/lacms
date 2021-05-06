<!--BEGIN editAddendum -->

<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>


	<TABLE BORDER=0><TR><TD VALIGN=TOP><B>EDIT / VIEW ADDENDUM </B></TD>
</TR></TABLE>

	<form action="<?php echo "$PHP_SELF?op=editAddendumDo";?>" method="POST">
	<input type="hidden" name="lid" value="<?php echo $lid; ?>">	

	<input type="HIDDEN" name="ll_addendum_id" value="<?php echo $rowGetLandlordA->LL_ADDENDUM_ID; ?>">


	<table border="0" cellspacing="0" cellpadding="5" BGCOLOR="<?php echo $pagebgcolor;?>">
	<tr>
	<td>


<div class="controltext">Addendum Name:</DIV><input type="text" name="addendum_name" size="20" value="<?php echo $rowGetLandlordA->ADDENDUM_NAME;?>" SIZE="40"> 


		<table width="100%">
			<tr>
			<td align="left"><div class="controltext" style="font-size:10px;">Addendum:</div><textarea cols="60" rows="20" name="ll_addendum"><?php echo $rowGetLandlordA->LL_ADDENDUM; ?></textarea></td>
			</tr>
		</table>

<input type="submit" value="Save" STYLE="Background-Color : #adffad"></td>

			</tr>
		</table>
	</form>

	<br>
	<br>


	

<!--END editAddendum -->