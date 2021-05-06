<!--BEGIN deleteLandlord -->

	<center>Are you sure you want to delete this landlord record?<br>
	
	<FONT COLOR=RED SIZE=+1>THIS WILL DELETE THE LANDLORD</FONT><BR>
	<?php //Start of changes by barkha
            $PHP_SELF = $_SERVER['PHP_SELF']; 
        ?> 
	
	<?php echo "$rowGetLL->SHORT_NAME $rowGetLL->OFF_NAME";?>
	<form action="<?php echo "$PHP_SELF?op=deleteLandlordDo";?>" method="POST">
	<input type="hidden" name="lid" value="<?php echo $rowGetLL->LID;?>">
	<BR>
	<FONT COLOR=RED>Do you want to delete the landlord's Listings?</FONT> <BR>
	
						<select name="deletelistings" STYLE="Background-Color : #FFFFFF">
						<option value="1">No</option>
						<option value="2">Yes</option>
						</select>
	<P>
	
	
	
	
	
	
	
	
	
	
	<BR>
	Please type 'y' to confirm: <input type="text" name="conf" size="3"><br>
	<input type="submit" value="Delete" STYLE="Background-Color : #A9F5A9">
	</form>
<BR>
<a href="#" onClick="history.go(-1)"><FONT COLOR="RED">Cancel</FONT></A>
	<BR><P></P><BR>
<!--END deleteLandlord -->