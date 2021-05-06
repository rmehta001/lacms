<!--BEGIN changePassword -->
<br>
	<CENTER><B>Change Password for <?php echo $_SESSION["handle"];?> from <?php echo $_SESSION["group"];?></B><br><br>
		<table class="table table-borderless"border="1" cellpadding="5" BGCOLOR="#FFFFFF">
		<tr>
		<td align="center">Passwords are a minimum of 4 characters, maximum of 20, using only a-z, A-Z, 0-9 and no spaces.<br>
		Both login names and passwords are case-sensitive.
		</td>
		</tr>
		</table>
		<br>
		<form action="<?php echo "$PHP_SELF?op=changePasswordDo"; ?>" method="POST">
		<table class="table table-borderless"border="0">
		<div class="row">
			<div class="col-md-5"></div>
		<div class="col-sm-2" align="left">
			<label>Old Password:</label>
			<input class="form-control"type="password" name="oldPass">
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-5"></div>
	<div class="col-sm-2" align="left">
		<label>New Password:</label>
		<input class="form-control"type="password" name="newPass">
	</div>
</div><br>
<div class="row">
	<div class="col-md-5"></div>
<div class="col-sm-2" align="left">
	<label>Retype New Password:</label>
	<input class="form-control"type="password" name="newPassConf">
</div>
</div><br>
<div class="row">
	<div class="col-md-5"></div>
<div class="col-sm-2" align="left">
	<input class="btn btn-primary"type="submit" value="Change Password"/>
</div>
</div>
</table>
		</form>

<!--End changePassword -->
