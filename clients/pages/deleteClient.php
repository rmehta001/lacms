<!--BEGIN deleteClient -->
<?php

$return_page = isset ($_GET['return_page']);

?>

	<br>
	<B>CLIENT DELETION</B>
	<br>
	<Br>
	
	
	<center>Are you sure you want to delete this client contact?<br>
            <?php //Start of changes by barkha
            $PHP_SELF = $_SERVER['PHP_SELF']; 
        ?> 
	<?php  if (isset ($rowGetClient)) echo "$rowGetClient->NAME_FIRST $rowGetClient->NAME_LAST";?>
	<form action="<?php echo "$PHP_SELF?op=deleteClientDo";?>" method="POST">
	<input type="hidden" name="clid" value="<?php echo $rowGetClient->CLID;?>">

<input type="hidden" name="return_page" value="<?php echo $return_page;?>">	


	Please type 'y' to confirm: <input type="text" name="conf" size="3"><br>
	<input type="submit" value="Delete" STYLE="Background-Color : #A9F5A9">
	</form>
	<BR>
	<a href="#" onClick="history.go(-1)"><FONT COLOR="RED">Cancel</FONT></A>
<!--END deleteClient -->