<BR>
<form action="<?php echo "$PHP_SELF?op=editClientReassignDo";?>" method="POST">
<INPUT TYPE="HIDDEN" NAME="clid" VALUE="<?php echo "$clid";?>">
<INPUT TYPE="HIDDEN" NAME="cluid1" VALUE="<?php echo "$uid";?>">



<?php
$quStrGetname = "SELECT * FROM `USERS` WHERE `GROUP`=$grid ORDER BY `HANDLE`";
	$quGetname = mysqli_query($dbh, $quStrGetname) or die ($quStrGetname);
@mysqli_data_seek ($quStrGetname, 0);
?>
<div class="controltext"><B>Transfer <?php echo "$fname $lname";?> to:</B><br>
<BR>
<select name="cluid" STYLE="Background-Color : #FFFFFF" SIZE=3 MULTIPLE>
		<?php 
while($rowGetname=mysqli_fetch_object($quGetname)) { ?>
		<option value="<?php if (isset($rowGetname)) echo $rowGetname->UID; ?>"><?php if (isset($rowGetname)) echo $rowGetname->HANDLE; ?></option>
		<?php } ?> 
	</select>
<BR><BR>
<input type="submit" value=" TRANSFER THE CLIENT " STYLE="Background-Color : #A9F5A9">

</FORM>

<BR>