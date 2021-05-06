<BR>
<form action="<?php echo "$PHP_SELF?op=editClientShareDo";?>" method="POST">
<INPUT TYPE="HIDDEN" NAME="clid" VALUE="<?php echo "$clid";?>">
<INPUT TYPE="HIDDEN" NAME="cluid1" VALUE="<?php echo "$cluid1";?>">
<INPUT TYPE="HIDDEN" NAME="fname" VALUE="<?php echo "$fname";?>">
<INPUT TYPE="HIDDEN" NAME="lname" VALUE="<?php echo "$lname";?>">
	
	





<?php
$quStrGetname = "SELECT * FROM `USERS` WHERE `GROUP`=$grid ORDER BY `HANDLE`";
	$quGetname = mysqli_query($dbh, $quStrGetname) or die ($quStrGetname);
@	mysqli_data_seek ($quStrGetname, 0);
?>
<div class="controltext"><B>Share <?php echo "$fname $lname";?> with:</B><br>
<BR>
<select name="cluid" STYLE="Background-Color : #FFFFFF" SIZE=3 MULTIPLE>
<option value="">Un-Share</option>

		<?php 
while($rowGetname=mysqli_fetch_object($quGetname)) { 

if ($rowGetname->UID=="$cluid1") { echo ""; } else {

?>



		<option value="<?php echo $rowGetname->UID; ?>"><?php echo $rowGetname->HANDLE; ?></option>
		<?php }} ?> 
	</select>
<BR><BR>
<input type="submit" value=" SHARE THE CLIENT " STYLE="Background-Color : #A9F5A9">

</FORM>

<BR>