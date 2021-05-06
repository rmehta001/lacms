<!--BEGIN delete -->
		

&nbsp;<BR>
		<form action="<?php echo "$PHP_SELF?op=deleteReminder";?>" method="POST">
		<input type="hidden" name="RID" value="<?php echo $rid ;?>">

		<B>Please type 'y' to confirm.</B>

		<input type="text" name="conf" size="3">
		
		<input type="submit" value="Delete Reminder" STYLE="Background-Color : #A9F5A9"></form>
		<FONT SIZE="-3"><br></FONT>
<a href="#" onClick="history.go(-1)"><B><FONT COLOR="RED">Cancel</FONT></B></A>
<BR>
<P>&nbsp;<BR>
		</font>
		</center>

<!--END delete -->