<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change the Agent Created by in ALL<BR>
the listings at <?php echo "$street_num";?> <?php echo "$street";?><BR><BR>
<P>
This effects which personal signature shows in ads.<BR>
<P>
	<form action="<?php echo "$PHP_SELF?op=global-ListingsEdit-agentDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">
<input TYPE="HIDDEN" NAME="street_num" value="<?php echo "$street_num";?>">
<input TYPE="HIDDEN" NAME="street" value="<?php echo "$street";?>">

Pick the Agent and click the button below.<BR>
<P>

<?php if ($isAdmin OR $user_level >="4") {?>
	
Change Agent:<br>
	<select name="UID" STYLE="Background-Color : #FFFFFF">
		<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) { ?>
		<option value="<?php echo $rowGetUsers->UID;?>" <?php if ($rowGetAd->UID==$rowGetUsers->UID) { echo "selected "; }?>><?php echo $rowGetUsers->HANDLE; ?></option>
		<?php } ?> 
	</select>
<?php } else {?>

<B><FONT COLOR="#FF0000">You do not have permission to use this option. Only the Admin may make this change.</FONT></B>
<?php }?>

<?php if ($isAdmin OR $user_level >="4") {?>
<BR><P>
This change will change EVERY LISTING at <?php echo "$street_num";?> <?php echo "$street";?> for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Creating Agent in ALL the listings at this building" STYLE="Background-Color : #A9F5A9"></form>
<br>

<?php } ?>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-ListingsEdit&lid=$lid&street_num=$street_num&street=$street";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->