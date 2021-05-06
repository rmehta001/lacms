<?php
//BEGIN client Share Do //
//changes done by Tanvi//

$clid = $_POST['clid'];
$cluid = $_POST['cluid'];
$cluid1 = $_POST['cluid1'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];




if (($cluid1=="$uid") OR ($user_level > "3") OR ($isAdmin)) {



if ($cluid=="") {



$quStrShareClientBy = "UPDATE CLIENTS SET `SHARE_WITH`='' WHERE `CLID`='$clid' AND GRID='$grid'";
$ShareClientBy = mysqli_query($dbh, $quStrShareClientBy);


$action = "Client UNSHARED by $handle";

$quStrAddClientH = "INSERT INTO CLIENTS_HISTORY (UID, HANDLE, CLI, CLID, ACTION) VALUES ('$uid', '$handle', '$grid', '$clid', '$action')";
$quAddClientH = mysqli_query($dbh, $quStrAddClientH) or die ($quStrAddClientH);

$msg = "Client has been UNSHARED by $handle";
		$title = "Manage Clients";
		$disData = "clients";

		header("Location: $PHP_SELF?op=editClient&clid=$clid");
die();
		
		$sec_op = "manageClients";

		
} else {





$quStrAgentHandle = "SELECT `HANDLE` FROM USERS WHERE `UID`='$cluid' AND `GROUP`='$grid' LIMIT 1";
$quAgentHandle = mysqli_query($dbh, $quStrAgentHandle);

$quStrAgentHandle2 = "SELECT `HANDLE` FROM USERS WHERE `UID`='$cluid1' AND `GROUP`='$grid' LIMIT 1";
$quAgentHandle2 = mysqli_query($dbh, $quStrAgentHandle2);




if ($rowAgentHandle = mysqli_fetch_object($quAgentHandle)) {
$cluid_handle = "$rowAgentHandle->HANDLE";

if ($rowAgentHandle2 = mysqli_fetch_object($quAgentHandle2)) {
$cluid_handle2 = "$rowAgentHandle2->HANDLE";


$quStrShareClientBy = "UPDATE CLIENTS SET `SHARE_WITH`='$cluid' WHERE `CLID`='$clid' AND GRID='$grid'";
$ShareClientBy = mysqli_query($dbh, $quStrShareClientBy);






$action = "Client $fname $lname shared by $cluid_handle2 with $cluid_handle by $handle";
} else {
$action = "Client $fname $lanme shared by $cluid_handle2 with $cluid_handle by $handle";
}
$quStrAddClientH = "INSERT INTO CLIENTS_HISTORY (UID, HANDLE, CLI, CLID, ACTION) VALUES ('$uid', '$handle', '$grid', '$clid', '$action')";
$quAddClientH = mysqli_query($dbh, $quStrAddClientH) or die ($quStrAddClientH);




$quStrNClient = "SELECT * FROM CLIENTS WHERE `UID`='$cluid' AND GRID='$grid' LIMIT 1";
$quNClient = mysqli_query($dbh, $dbh, $quStrNClient);
if ($rowNClient = mysqli_fetch_object($quNClient)) {
$clientN_email = "$rowNClient->CLIENT_EMAIL";
}

$quStrAClient = "SELECT * FROM CLIENTS WHERE `CLID`='$clid' AND GRID='$grid' LIMIT 1";
$quAClient = mysqli_query($dbh, $dbh, $quStrAClient);

if ($rowAClient = mysqli_fetch_object($quAClient)) {

$name_first = "$rowAClient->NAME_FIRST";
$name_last = "$rowAClient->NAME_LAST";
$home_phone = "$rowAClient->HOME_PHONE";
$work_phone = "$rowAClient->WORK_PHONE";
$mobile_phone = "$rowAClient->MOBILE_PHONE";
$client_email = "$rowAClient->CLIENT_EMAIL";

if ($rowAClient->ROOMS_PREF) { $rooms_pref = "# of Beds: $rowAClient->ROOMS_PREF &nbsp;&nbsp;"; }
if ($rowAClient->PRICEMIN) { $pricemin = "$ min: $rowAClient->PRICEMIN"; }
if ($rowAClient->PRICEMAX) { $pricemax = " - $ max: $rowAClient->PRICEMAX"; }

}


$quStrAgent = "SELECT `EMAIL` FROM `USERS` WHERE `HANDLE`='$cluid_handle' AND `GROUP`='$grid' LIMIT 1";
$quAgent = mysqli_query($dbh, $dbh, $quStrAgent);
if ($rowEAgent = mysqli_fetch_object($quAgent)) {
$Aemail = "$rowEAgent->EMAIL";
}
if ($Aemail !="") {

$quStrSAgent = "SELECT `EMAIL` FROM `USERS` WHERE `UID`='$uid' AND `GROUP`='$grid' LIMIT 1";
$quSAgent = mysqli_query($dbh, $dbh, $quStrSAgent);
if ($rowSAgent = mysqli_fetch_object($quSAgent)) {
$SAemail = "$rowSAgent->EMAIL";
}

if ($rowAgent = mysqli_fetch_object($quAgent)) {
$Aemail = "$rowEAgent->EMAIL";
}

		//Begin mail agent //
		
$to = "$Aemail";
$subject = "New Shared Client at BostonApts.com";

$message = "
<html>
<head>
<title>New Shared Client in BostonApts.com</title>
</head>
<body>
<p>You have a new shared client with $cluid_handle2!</p>
<table>
<tr>
<th>First Name</th>
<th> &nbsp; </th>
<th>Last Name</th>
<th> &nbsp; </th>
<th>Work Phone</th>
<th> &nbsp; </th>
<th>Home Phone</th>
<th> &nbsp; </th>
<th>Cell Phone</th>
<th> &nbsp; </th>
<th>Email</th>
</tr>
<tr>
<td>$name_first</td>
<td> &nbsp; </td>
<td>$name_last</td>
<td> &nbsp; </td>
<td>$home_phone</td>
<td> &nbsp; </td>
<td>$work_phone</td>
<td> &nbsp; </td>
<td>$mobile_phone</td>
<td> &nbsp; </td>
<td><A HREF=\"mailto:$client_email\">$client_email</A></td>
</tr>
</table>
<NOBR>$rooms_pref $pricemin $pricemax</NOBR>
<BR><BR>
<A HREF=https://www.BostonApartments.com/lacms>Click to Log In and see</A><BR>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// More headers


if ($SAemail !="") {

$headers .= 'From: <'.$SAemail.'>' . "\r\n";

} else {
$headers .= 'From: <webmaster@bostonapartments.com>' . "\r\n";
}


mail($to,$subject,$message,$headers);

		
		//END mail agent //

}



$msg = "Client $fname $lname is now shared by $cluid_handle2 and $cluid_handle by $handle";
		$title = "Manage Clients";
		$disData = "clients";

		header("Location: $PHP_SELF?op=editClient&clid=$clid");
die();

		$sec_op = "manageClients";

} else {
$msg = "<FONT COLOR=RED>The Client was NOT shared</FONT>. Either it's not your client or you're not the Admin";
		$title = "Manage Clients";
		$disData = "clients";
		$sec_op = "manageClients";

}
}}
//END client Share Do //
?>