<!--BEGIN Cobroke -->
	<CENTER><B>Manage Co-Broke Settings for <?php echo $_SESSION ["group"];?></B><br>
		<table border="1" cellpadding="5" BGCOLOR="#FFFFFF" WIDTH="95%">
		<tr>
		<td><FONT SIZE="-1">
Passwords should be a minimum of 1 characters, maximum of 10, using only a-z, A-Z, 0-9 and no spaces.<br>
<P>
Setting the password to nothing/blank will disable the ability to show co-broke listings.<BR>
The password must be used in the url to show the co-broke listings.<BR>example url: http://bostonapartments.com/cobrokes.php?cli=392&amp;p=1111
<BR>( p=password | cli=your group ID )   Without a password and corresponding cli the output will not work so your data is secure. If you change this password, you need to change the password in the links to the co-broke listings on your website as well.<BR>
<P>
You can use the url for emailing up-to-date co-brokes to your mailing list of sent out to other brokers.<BR>
<P>
If you choose to Co-Broke a listing with BostonApartments.com, the information displayed is governed by the co-broke view selected below.<BR>
<P>
Only listings marked as "Co-Broke this listing" (found on the simple form above Helpful Tools) and marked Available <img src="../assets/images/icons/a.jpg" border=0 height=14 width=14> will show on the co-broke list.<BR>
<P>
You can use the sterilized view to protect the proprietary information of a listing by only allowing normally publically viewable information to appear in your co-broke list. If using the sterilized view, password protection to the results is not necessary.<BR>
<P>
Using the Detailed view will output information the public should see. It should only be used for exclusive listings you want to co-broke. Access should only be made accessible to licensed real estate agents and it is suggested that the page should be behind some sort of password protection if used on your website if you choose to use the detailed view.<BR>

</FONT>
		</td>
		</tr>
		</table>
		<br>
		<form action="<?php echo "$PHP_SELF?op=cobrokeDo"; ?>" method="POST">

<TABLE>

			<tr>
			<td height="30" valign="top">Co-Broke Password:
</TD><TD valign="top">
<input type="text" size="10" name="cobroke_pw" value="<?php if (isset ($rowGetGroup)) echo $rowGetGroup->COBROKE_PW;?>">
</td>
</tr>
			<tr>
			<td height="30" valign="top">Co-Broke View:
</TD><TD valign="top">
Sterilized <input type="radio" name="cobroke_view" value="0" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->COBROKE_VIEW==0) { echo " checked "; }?> > | Detailed <input type="radio" name="cobroke_view" value="1" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->COBROKE_VIEW==1) { echo " checked "; }?>><BR><FONT SIZE="-2" COLOR="RED">Detailed gives out info like key, tenant, address, etc. Sterilized shows no more than a normal ad</FONT>
</td>
</tr>
			<tr>
			<td height="30" valign="top"><NOBR>Co-Broke with BostonApts.com:&nbsp; &nbsp;</NOBR>
</TD><TD valign="top">
No <input type="radio" name="cobroke_bos" value="0" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->COBROKE_BOS==0) { echo " checked "; }?> > Yes <input type="radio" name="cobroke_bos" value="1" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->COBROKE_BOS==1) { echo " checked "; }?>>
</td>
</tr>
			<tr>
			<td height="30" valign="top">Co-Broke Header:
</TD><TD BGCOLOR="#FFFFFF" valign="top">
<textarea id="cobroke_head" name="cobroke_head" rows="5" cols="80"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->COBROKE_HEAD);?></TEXTAREA>
</td>
</tr>
			<tr>
			<td height="30" valign="top">Co-Broke Footer:
</TD><TD BGCOLOR="#FFFFFF" valign="top">
<textarea id="cobroke_foot" name="cobroke_foot" rows="5" cols="80"><?php if (isset ($rowGetGroup)) echo htmlspecialchars($rowGetGroup->COBROKE_FOOT);?></TEXTAREA>
</td>
</tr>
</TABLE>
<P>

<style type="text/css">
.funkybutton { background-color: #e0ffff; font-size: 80%;
                     font-weight: bold; }
</style>
<input type="submit" value="Change Password &amp; Templates for Co-Brokes" class="funkybutton" /><BR>
<P>
<A HREF="<?php echo "$PHP_SELF?op=cobroke"; ?>">If you want to use a WYSIWYG editor to<BR>create headers and footers Click Here</A>
<BR>
<?php
if (isset ($rowGetGroup)) if ($rowGetGroup->COBROKE_PW != "") {
?>
<P>
<CENTER>
<A HREF="https://www.BostonApartments.com/cobrokes.php?cli=<?php if (isset ($rowGetGroup)) echo $rowGetGroup->GRID;?>&p=<?php if (isset ($rowGetGroup)) echo $rowGetGroup->COBROKE_PW;?>" target="_NEW"><FONT COLOR="GREEN">See <?php echo $_SESSION["group"];?> Current Co-broke Listings</FONT></A><BR></CENTER>
<?php } ?>

</td>









		</tr>
		</table>
		</form>

<!--End changePassword -->