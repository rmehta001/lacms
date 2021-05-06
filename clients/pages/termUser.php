<!--BEGIN termUser -->

	<center>
	Are you sure you want to terminate <?php echo $rowGetUser->HANDLE; ?>?</br>
	<form action="<?php   $PHP_SELF = $_SERVER['PHP_SELF']; echo "$PHP_SELF?op=termUserDo"; ?>" method="POST">
	<input type="hidden" name="term_uid" value="<?php echo $term_uid;?>">
	Please type 'y' to confirm:<input type="text" name="conf" size="3"><br><br>
	Transfer all ads to: <select name="transfer_uid">
	<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) {
		if ($rowGetUsers->UID!==$term_uid) { ?>
			<option value="<?php echo $rowGetUsers->UID;?>"><?php echo $rowGetUsers->HANDLE;?></option>
		<?php }
	 } ?>
	</select><br>
	<input type="submit" value="terminate">
	</form>
	</center>

<!--END termUser -->