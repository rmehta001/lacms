<html>
<head>
<title>LACMS Admin2</title>

<!-- Source the JavaScript spellChecker object -->
<script language="javascript" type="text/javascript" src="/speller/spellChecker.js">
</script>

<!-- Call a function like this to handle the spell check command -->
<script language="javascript" type="text/javascript">
function openSpellChecker() {
        // get the textarea we're going to check
        var txt = document.listing_edit_form.BODY;
        // give the spellChecker object a reference to our textarea
        // pass any number of text objects as arguments to the constructor:
        var speller = new spellChecker( txt );
        // kick it off
        speller.openChecker();
}
</script>


<?php include("./includes/styles_admin.php");?>
</head>

<body bgcolor="white">
<span class="text">
<center>
<table width="80%"  border="0" cellspacing="0" cellpadding="0" style="background-color: #4d90fe">
	<tr>
		<td valign="top">
		<table width="100%" border="0" cellspacing="2" cellpadding="8" style="background-color: #4d90fe">
			<tr style="background-color: #4d90fe">
				<td valign="top">
				<table width="100%" border="0" cellspacing="2" cellpadding="4">
					<tr>
						<td valign="middle">
						<span class="subtitle">LACMS Admin2</span>
						</td>
						<td valign="middle">
						<span class="text"><?php echo $_SESSION['handle'];?> logged in.
						<b>
						</td>
					</tr>
				</table>
				</td>
			</tr>





			<tr style="background-color: #4d90fe">
				<td valign="top">


<TABLE border=0><TR><TD>

				<a href="index.php"><span class="menu">Home </span></a> | <a href="manage_agencies.php"><span class="menu<?php if ($op=="manage_agencies") { echo "Highlighted"; }?>">Manage Agencies</span></a> | <a href="manage_listings.php"><span class="menu<?php if ($op=="manage_listings") { echo "Highlighted"; }?>">Manage Listings</span></a>

</TD><TD>
<!--<font color="#000000" face="Verdana" size="1"><form action="/lacms/admin2/listing_edit.php-->
<!--" method="GET"><INPUT TYPE=IMAGE SRC="../images/jumptolisting.gif" NAME="SUBMIT"><br><input type="text" name="listing_id" size="12"></form>-->
</TD></TR></TABLE>

				</td>

			</tr>
			<tr bgcolor="#FFFFFF">
				<td valign="top">
				<span class="text">