<!--BEGIN createLandlordAddendum -->

<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}

$llid = $HTTP_GET_VARS['lid'];

?>


	<TABLE BORDER=0><TR><TD VALIGN=TOP><B>CREATE A NEW ADDENDUM</B></TD>
</TR></TABLE>

	<form action="<?php echo "$PHP_SELF?op=createAddendumDo";?>" method="POST">

	<input type="hidden" name="lid" value="<?php echo $llid; ?>">


	<table border="0" cellspacing="0" cellpadding="5" BGCOLOR="<?php echo $pagebgcolor;?>">
	<tr>
	<td>


<div class="controltext">Addendum Name:</DIV><input type="text" name="addendum_name" size="20" value="" SIZE="40"> 


		<table width="100%">
			<tr>
			<td align="left"><div class="controltext" style="font-size:10px;">Addendum:</div><textarea cols="60" rows="20" name="ll_addendum"></textarea></td>
			</tr>
		</table>


<input type="submit" value="Save" STYLE="Background-Color : #E0FFC0"></td>

			</tr>
		</table>
	</form>

	<br>
	<br>


	

<!--END createLandlordAddendum -->