<?php

require("ssn_verify.php");

if ($_POST) extract($_POST);

if (isset($ssn)) {
  $check = isValidSSN($ssn);
	if ($check) $response = $ssn." appears to be a valid Social Security Number.";
	else $response = "<FONT COLOR=#CC0000>".$ssn." is an INVALID Social Security Number.</FONT>";
}

?>

<HTML>
<HEAD>
<TITLE>SS# Verification</TITLE>
</HEAD>
<BODY>
<BR>
<TABLE CELLPADDING ="5" BORDER="1" BORDERCOLOR="1" BGCOLOR="#FFFFFF" WIDTH="80%"><TR><TD>
<FONT SIZE="-1">This page determines whether or not a particular Social Security Number has been issued by the Social Security Administration based on their
 (bizzare) sequence of number issuance.  It also checks for known bogus numbers, such as ones that have been used in advertising.<BR>
<br>
This does not guarantee that a Social Security number is real nor belongs to or has been issued to anyone. It does however cut down on placing and paying for credit checks with bogus social security numbers.<BR>
<BR>
The data used is taken from the January 19, 2010 SSA Issuance Table.</FONT>


<CENTER>
<FONT FACE="Verdana" SIZE=2 COLOR=#000000><B><?= isset($response)?></B><BR><BR><BR>
<FORM NAME="ssn_verify" ACTION="<?=$PHP_SELF?>" METHOD="POST">
Enter Social Security # to Check:&nbsp;&nbsp;
<INPUT TYPE=TEXT NAME="ssn" VALUE="<?=isset($ssn)?>" SIZE=11 MAXLENGTH=11>
&nbsp;&nbsp;
<INPUT TYPE=SUBMIT VALUE="Check SSN">
</P></B></TD></TR></TABLE>
<BR>
</BODY>
</HTML>
