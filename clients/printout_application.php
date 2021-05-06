<?php
session_start();                 
include("../inc/global.php");    
include("../inc/local_info.php");

mysqli_select_db($dbh, "$DBNAME");

$clid = $HTTP_GET_VARS['clid'];
$now = date(Ymd);

$now_year = substr ($now, 0,4);
$now_month = substr ($now, 4,2);
$now_day = substr ($now, 6,2);
$now2 = "$now_month/$now_day/$now_year. ";

$quStrGetClient = "SELECT * FROM `CLIENTS` WHERE CLID=$clid AND GRID=$grid";
$quGetClient = mysqli_query($dbh, $quStrGetClient) or die (dieNice("Sorry, couldn't find that client.", "C-117"));
$rowGetClient = mysqli_fetch_object($quGetClient);

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/style.css">

		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php if ($title) { $title = " - " . $title; }; ?>
		<title>BostonApartments.com Apartment Application</title>
		<!-- MAIN JAVASCRIPT LAYER -->
		<?php include ("../assets/main.js"); ?>
		<!--END MAIN JAVASCRIPT LAYER -->
                
</head>
<body topmargin="10" leftmargin="10" >
<div align="left" style="position:relative;">

<TABLE BORDER=1><TR><TD>

<TABLE BORDER=0 WIDTH="100%"><TR><TD>
<B>APARTMENT APPLICATION</B>
</TD>
<TD> 
<NOBR><div class="controltext">Date Created: 
<?php echo $now2 ;?></DIV></NOBR>
<NOBR><div class="controltext">By Agent: <?php 
if($handle)
{ echo $handle; }
else
{ echo $rowGetClient->UID; }

echo " - Agency: $group";

?></DIV></NOBR>
</TD>
<TD align="right">

<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><td bgcolor="#FFFF99" align="right"><div class="controltext"><a href="javascript:print_screen();">Send to Printer</a><BR><a href="javascript:close_window();">Close Window</a></div></td></TR></TABLE>

</TD>

</TR></TABLE>




</TD>
</TR>

	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>

<TR>
<td height="30">
			

<TABLE CELLPADDING="0" CELLSPACING="0"><TR><TD>


			<TABLE CELLPADDING="0" CELLSPACING="0"><TR><TD><div class="controltext"><NOBR>First Name:</NOBR></div><input type="text" name="name_first" size="20" value="<?php echo $rowGetClient->NAME_FIRST;?>"></td>

			<td height="30" width="1">&nbsp;</td>

			<td height="30" width="20"><div class="controltext"><NOBR>Last Name:</NOBR></div><input type="text" name="name_last" size="20" value="<?php echo $rowGetClient->NAME_LAST;?>"></td>

			<td height="30" width="1">&nbsp;</td>

			<td height="30" width="20"><div class="controltext"><NOBR>Social Security #:</NOBR></div><INPUT TYPE="text" name="SOCIAL" VALUE="<?php echo $rowGetClient->SOCIAL;?>" STYLE="Background-Color : #FFFFFF" SIZE="12"></td>
			
			<td height="30" width="1">&nbsp;</td>

			<TD align="center">
<div class="controltext">D.O.B.:</div><input type="text" name="CLDOB" value="<?php echo $rowGetClient->CLDOB;?>" SIZE="10">
</td>
		<td height="30" width="1">&nbsp;</td>

			<TD align="center">
<div class="controltext">#Tenants:</div><input type="text" SIZE="2" name="num_people" value="<?php echo $rowGetClient->NUM_PEOPLE;?>">
</td>
			
			</TR></TABLE>
			
</TD></TR>
<tr><TD>

<TABLE CELLPADDING="0" CELLSPACING="0"><TR><TD><td valign="bottom" height="30" width="20"><div class="controltext"><NOBR>Home Phone:</NOBR></div><input type="text" name="home_phone" size="15" value="<?php echo $rowGetClient->HOME_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1">&nbsp;</td>
			<td valign="bottom" height="30" width="20"><div class="controltext"><NOBR>Work Phone:</NOBR></div><input type="text" name="work_phone" size="15" value="<?php echo $rowGetClient->WORK_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1">&nbsp;</td>
			<td valign="bottom" height="30" width="20"><div class="controltext"><NOBR>Mobile Phone:</NOBR></div><input type="text" name="mobile_phone" size="15" value="<?php echo $rowGetClient->MOBILE_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1">&nbsp;</td>
			<td valign="bottom" height="30" width="20"><div class="controltext">Email:</div><input type="text" name="client_email" size="20" value="<?php echo $rowGetClient->CLIENT_EMAIL;?>"></td>
			<td valign="bottom" height="30" width="1">&nbsp;</td>
			<td valign="bottom" height="30" width="1">&nbsp;</td>
			</tr></TABLE>
</TD></TR>
<TR><td>

<TABLE CELLPADDING="0" CELLSPACING="0"><TR><TD>
<div class="controltext">Address:</div><input type="text" name="curaddress" size="28" value="<?php echo $rowGetClient->CURADDRESS;?>"></td>

			<td height="30" width="1">&nbsp;</td>

			<td height="30" width="20"><div class="controltext">City:</div><input type="text" name="curcity" size="25" value="<?php echo $rowGetClient->CURCITY;?>"></td>

			<td height="30" width="1">&nbsp;</td>


			<td height="30" width="20"><div class="controltext">State:</div><input type="text" name="curstate" size="2" value="<?php echo $rowGetClient->CURSTATE;?>"></td>

			<td height="30" width="1">&nbsp;</td>


			<td height="30" width="20"><div class="controltext">Zip:</div><input type="text" name="curzip" size="10" value="<?php echo $rowGetClient->CURZIP;?>"></td>

			<td height="30" width="1">&nbsp;</td></tr></TABLE>

</TD>
</tr>
</table>


	</td>

	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>


	<tr>

			<td height="30">

<TABLE><TR><TD>
<div class="menu">Current Employer:</div>
<input type="text" name="CURREMPLOY" size="30" value="<?php echo $rowGetClient->CURREMPLOY;?>">

</TD><TD>

<div class="menu">Current Employer Address:</div>
<input type="text" name="CURREMPLOYADDRESS" size="30" value="<?php echo $rowGetClient->CURREMPLOYADDRESS;?>">
</TD></TR><TR><TD>
<div class="menu">Current Employer Phone:</div>
<input type="text" name="CURREMPLOYPHONE" size="20" value="<?php echo $rowGetClient->CURREMPLOYPHONE;?>">

</TD><TD>

<div class="menu">Current Employer Contact:</div>
<input type="text" name="CURREMPLOYCONTACT" size="30" value="<?php echo $rowGetClient->CURREMPLOYCONTACT;?>">
</TD></TR><TR><TD>

<div class="menu">Current Position:</div>
<input type="text" name="CURREMPLOYPOS" size="20" value="<?php echo $rowGetClient->CURREMPLOYPOS;?>">
</TD><TD>

<div class="menu">Current Salary/Income:</div>
<input type="text" name="CURREMPLOYSALARY" size="20" value="<?php echo $rowGetClient->CURREMPLOYSALARY;?>">
</TD></TR></TABLE>

</TD>
</TR>

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	<tr>
		<td height="30" width="28">


<TABLE><TR><TD>
<div class="menu">Previous Employer:</div>
<input type="text" name="PREVEMPLOY" size="30" value="<?php echo $rowGetClient->PREVEMPLOY;?>">

</TD><TD>

<div class="menu">Previous Employer Address:</div>
<input type="text" name="PREVEMPLOYADDRESS" size="30" value="<?php echo $rowGetClient->PREVEMPLOYADDRESS;?>">
</TD></TR><TR><TD>
<div class="menu">Previous Employer Phone:</div>
<input type="text" name="PREVEMPLOYPHONE" size="30" value="<?php echo $rowGetClient->PREVEMPLOYPHONE;?>">

</TD><TD>

<div class="menu">Previous Employer Contact:</div>
<input type="text" name="PREVEMPLOYCONTACT" size="30" value="<?php echo $rowGetClient->PREVEMPLOYCONTACT;?>">
</TD></TR><TR><TD>
<div class="menu">Previous Position:</div>
<input type="text" name="PREVEMPLOYPOS" size="30" value="<?php echo $rowGetClient->PREVEMPLOYPOS;?>">
</TD><TD>
<div class="menu">Previous Salary/Income:</div>
<input type="text" name="PREVEMPLOYSALARY" size="20" value="<?php echo $rowGetClient->PREVEMPLOYSALARY;?>">
</TD></TR></TABLE>


</TD>
</TR>



	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>



	<tr>
	<td height="30">

<TABLE><TR><TD>
<div class="menu">Current Landlord:</div>
<input type="text" name="CURRLL" size="30" value="<?php echo $rowGetClient->CURRLL;?>">
</TD><TD>
<div class="menu">Current Landlord Address:</div>
<input type="text" name="CURRLLADDRESS" size="30" value="<?php echo $rowGetClient->CURRLLADDRESS;?>">
</TD></TR>
<TR><TD>

<div class="menu">Current Landlord Phone:</div>
<input type="text" name="CURRLLPHONE" size="20" value="<?php echo $rowGetClient->CURRLLPHONE;?>">

</TD><TD>

<div class="menu">Current Rent:</div>
<input type="text" name="CURRLLRENT" size="20" value="<?php echo $rowGetClient->CURRLLRENT;?>">
</TD></TR></TABLE>



</TD>
</TR>



	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	

	<tr>
	<td height="30" width="28">
			
			
<TABLE><TR><TD>
<div class="menu">Previous Landlord:</div>
<input type="text" name="PREVLL" size="30" value="<?php echo $rowGetClient->PREVLL;?>">
</TD><TD>
<div class="menu">Previous Landlord Address:</div>
<input type="text" name="PREVLLADDRESS" size="30" value="<?php echo $rowGetClient->PREVLLADDRESS;?>">
</TD></TR><TR><TD>
<div class="menu">Previous Landlord Phone:</div>
<input type="text" name="PREVLLPHONE" size="20" value="<?php echo $rowGetClient->PREVLLPHONE;?>">
</TD><TD>
<div class="menu">Previous Rent:</div>
<input type="text" name="PREVLLRENT" size="20" value="<?php echo $rowGetClient->PREVLLRENT;?>">
</TD></TR></TABLE>


</TD>
</TR>

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>



	<tr>
	<td height="30" width="28">
<TABLE><TR><TD>
<div class="menu">Credit Reference:</div>
<input type="text" name="CREDITREF" size="30" value="<?php echo $rowGetClient->CREDITREF;?>">
</TD><TD>
<div class="menu">Credit Account #:</div>
<input type="text" name="CREDITACCOUNT" size="30" value="<?php echo $rowGetClient->CREDITACCOUNT;?>">
</TD></TR><TR><TD>
<div class="menu">Personal Reference:</div>
<input type="text" name="PERSREF" size="20" value="<?php echo $rowGetClient->PERSREF;?>">
</TD><TD>
<div class="menu">Personal Reference Tel:</div>
<input type="text" name="PERSREFCONTACT" size="20" value="<?php echo $rowGetClient->PERSREFCONTACT;?>">
</TD></TR></TABLE>
</TD>
</TR>


	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>


	<tr>
	<td height="30" width="28">
			
			
<TABLE><TR><TD>
<div class="controltext">Additional monies paid with this application include:</DIV>

			<table width="100%">
			<tr>
<td align="center" height="30"><div class="controltext"><NOBR>First paid:</NOBR></div>$<input type="text" name="payment_first_paid"  size="5" value="<?php echo $rowGetClient->PAYMENT_FIRST_PAID;?>"></td>

<td>&nbsp;</td>

<td align="center" height="30"><div class="controltext"><NOBR>Last paid:</NOBR></div>$<input type="text" name="payment_last_paid" size="5" value="<?php echo $rowGetClient->PAYMENT_LAST_PAID;?>"></td>

<td>&nbsp;</td>

<td align="center" height="30"><div class="controltext"><NOBR>Security paid:</NOBR></div>$<input type="text" name="payment_sec_paid" size="5" value="<?php echo $rowGetClient->PAYMENT_SEC_PAID;?>"></td>

<td>&nbsp;</td>

<td align="center" height="30"><div class="controltext"><NOBR>Key Dep. paid:</NOBR></div>$<input type="text" name="key_dep_paid" size="5" value="<?php echo $rowGetClient->KEY_DEP_PAID;?>"></td>

<td>&nbsp;</td>

<td align="center" height="30"><div class="controltext"><NOBR>Cleaning Dep. paid:</NOBR></div>$<input type="text" name="clean_dep_paid" size="5" value="<?php echo $rowGetClient->CLEAN_DEP_PAID;?>"></td>

<td>&nbsp;</td>

<td align="center" height="30"><div class="controltext"><NOBR>Fee paid:</NOBR></div>$<input type="text" name="tenant_fee_paid" size="5" value="<?php echo $rowGetClient->TENANT_FEE_PAID;?>"></td>


			</tr></table>


</TD></TR></TABLE>


</TD>
</TR>

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>


<TR><TD>
<PRE>
This form shall be construed as a rental application and offered to: <?php echo $group; ?> 
for unit # ___________  at ____________________________________________ (street address)
_______________________________________________________________________ (city, state & zip)
This application includes a deposit in the amount of $_____________ to be used towards the first month's rent
upon acceptance of this offer to rent. Rent per month is $_______ Term of lease: _______ (months) ______ (days)
Lease to start: __________________ and terminate on: _____________________
The following utilities are due in addition to the rent: ______________________________________________________
Additional monies due upon acceptance of this application by the landlord may include and are not limited to: 
First Month's Rent, Last Month's Rent, Security Deposit, Key Deposit, Cleaning Deposit and Broker's Fees.

I hereby authorize the landlord and its agents to check my credit and criminal history.
I understand this is an application and does not constitute acceptance by the landlord.

Applicant Signature: _________________________________________________________
</PRE>
</TD></TR>

	
		<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>



			</table>




</td>
			
			</tr>
			</table>





<FONT SIZE="-2">Printed by BostonApartments.com - Copyright <SCRIPT>
<!--
var dt = new Date();
var y = dt.getYear();
if (y < 1000) y +=1900;
document.write(y);
// -->
</SCRIPT> BostonApartments.com. All Rights reserved</FONT>
</td>
</tr>
</table>
</div>
</body>
</html>