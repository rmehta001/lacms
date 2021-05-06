<?php
//BEGIN client Reassign Do //
//changes done by Tanvi//
$clid = isset($_POST['clid']);
$cluid = isset($_POST['cluid']);
$cluid1 = isset($_POST['cluid1']);

if (isset($cluid1) and ($cluid1=="$uid") OR isset($user_level) and ($user_level >="4") OR isset($isAdmin)) {


$quStrTransferClient = "UPDATE CLIENTS SET `UID`='$cluid', `DATE_MODIFIED`='$now' WHERE `CLID`='$clid' AND GRID='$grid'";
$quTransferClient = mysqli_query($dbh, $quStrTransferClient);




$quStrAgentHandle = "SELECT `HANDLE` FROM USERS WHERE `UID`='$cluid' AND `GROUP`='$grid' LIMIT 1";
$quAgentHandle = mysqli_query($dbh, $quStrAgentHandle);


if ($rowAgentHandle = mysqli_fetch_object($quAgentHandle)) {
$cluid_handle = "$rowAgentHandle->HANDLE";



$quStrTransferClientBy = "UPDATE CLIENTS SET `MODIFIED_LAST`='$cluid_handle' WHERE `CLID`='$clid' AND GRID='$grid'";
$TransferClientBy = mysqli_query($dbh, $quStrTransferClientBy);






$action = "Client transferred by $_SESSION[handle] to $cluid_handle";
} else {
$action = "Client transferred by $_SESSION[handle] to $cluid";
}
$quStrAddClientH = "INSERT INTO CLIENTS_HISTORY (UID, HANDLE, CLI, CLID, ACTION) VALUES ('$uid', '$_SESSION[handle]', '$grid', '$clid', '$action')";
$quAddClientH = mysqli_query($dbh, $quStrAddClientH) or die ($quStrAddClientH);





$quStrNClient = "SELECT * FROM CLIENTS WHERE `UID`='$cluid' AND GRID='$grid' LIMIT 1";
$quNClient = mysqli_query($dbh, $quStrNClient);
if (isset($rowNClient)) if ($rowNClient = mysqli_fetch_object($quNClient)) {
$clientN_email = "$rowNClient->CLIENT_EMAIL";
}

$quStrAClient = "SELECT * FROM CLIENTS WHERE `CLID`='$clid' AND GRID='$grid' LIMIT 1";
$quAClient = mysqli_query($dbh, $quStrAClient);

if (isset($rowAClient)) if($rowAClient = mysqli_fetch_object($quAClient)) {

$name_first = "$rowAClient->NAME_FIRST";
$name_last = "$rowAClient->NAME_LAST";
$home_phone = "$rowAClient->HOME_PHONE";
$work_phone = "$rowAClient->WORK_PHONE";
$mobile_phone = "$rowAClient->MOBILE_PHONE";
$client_email = "$rowAClient->CLIENT_EMAIL";

if (isset($rowAClient)) if ($rowAClient->ROOMS_PREF) { $rooms_pref = "# of Beds: $rowAClient->ROOMS_PREF &nbsp;&nbsp;"; }
if (isset($rowAClient)) if ($rowAClient->PRICEMIN) { $pricemin = "$ min: $rowAClient->PRICEMIN"; }
if (isset($rowAClient)) if ($rowAClient->PRICEMAX) { $pricemax = " - $ max: $rowAClient->PRICEMAX"; }

}


$quStrAgent = "SELECT `EMAIL` FROM `USERS` WHERE `UID`='$cluid' AND `GROUP`='$grid' LIMIT 1";
$quAgent = mysqli_query($dbh, $quStrAgent);
if (isset($rowEAgent)) if ($rowEAgent = mysqli_fetch_object($quAgent)) {
$Aemail = "$rowEAgent->EMAIL";
}
if (isset($Aemail)) if($Aemail !="") {

$quStrSAgent = "SELECT `EMAIL` FROM `USERS` WHERE `UID`='$uid' AND `GROUP`='$grid' LIMIT 1";
$quSAgent = mysqli_query($dbh, $quStrSAgent);
if (isset($rowSAgent)) if ($rowSAgent = mysqli_fetch_object($quSAgent)) {
$SAemail = "$rowSAgent->EMAIL";
}

if (isset($rowAgent)) if ($rowAgent = mysqli_fetch_object($quAgent)) {
$Aemail = "$rowEAgent->EMAIL";
}

		//Begin mail agent //
		
$to = "$Aemail";
$subject = "New Client at BostonApts.com";

$message = "
<html>
<head>
<title>New Client in BostonApts.com</title>
</head>
<body>
<p>You have a new client!</p>
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


if (isset($Aemail)) if($SAemail !="") {

$headers .= 'From: <'.$SAemail.'>' . "\r\n";

} else {
$headers .= 'From: <webmaster@bostonapartments.com>' . "\r\n";
}


mail($to,$subject,$message,$headers);

		
		//END mail agent //

}





$msg = "The Client has been transferred";
		$title = "Manage Clients";
		$disData = "clients";
		$sec_op = "manageClients";

} else {
$msg = "<FONT COLOR=RED>The Client was NOT transferred</FONT>. Either it's not your client or you're not the Admin";
		$title = "Manage Clients";
		$disData = "clients";
		$sec_op = "manageClients";

}

//END client Reassign Do //
?>