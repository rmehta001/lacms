<!--BEGIN deleteAddendum -->

	<center>Are you sure you want to delete this addendum?<br>
	<?php echo "$rowGetLL->SHORT_NAME $rowGetLL->HOME_NAME $rowGetLL->OFF_NAME";?>
	<form action="<?php echo "$PHP_SELF?op=deleteAddendumDo";?>" method="POST">

<?php $llid = $HTTP_GET_VARS['lid'];?>
<?php $ll_addendum_id = $HTTP_GET_VARS['ll_addendum_id'];?>

	<input type="hidden" name="lid" value="<?php echo $llid;?>">
	<input type="hidden" name="ll_addendum_id" value="<?php echo $ll_addendum_id;?>">

	Please type 'y' to confirm: <input type="text" name="conf" size="3"><br>
	<input type="submit" value="Delete" STYLE="Background-Color : #A9F5A9">
	</form>
<BR>
<a href="#" onClick="history.go(-1)"><FONT COLOR="RED">Cancel</FONT></A>
	
<!--END deleteAddendum -->