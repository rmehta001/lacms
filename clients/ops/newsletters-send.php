<?php
// set time limit to 15 minutes (900/60)
set_time_limit(900);

	$nl_id = preg_replace("/'\/<>\"/","",$_GET['nl_id']);
	if (empty($nl_id))
	die("Invalid ID");
	$query = "SELECT * FROM NEWSLETTERS WHERE NL_ID='$nl_id'";
	$res = mysqli_query($dbh, $query) or die(mysqli_error($dbh)());
	$r = mysqli_fetch_assoc($res);
	$subject = $r['NL_NAME'];
	$message = $r['NL_CONTENT'] . '<BR><P><font size=-1><I>This Newsletter was provided to you by a participating agency of BostonApartments.com. Anything expressed in the newsletter is the work of the participating agency and BostonApartments.com takes no responsiblity for its content. If you would like to unsubscribe, please <A HREF=https://www.BostonApartments.com/newsletters-unsubscribe.php>CLICK HERE</A> or go to <A HREF=https://www.BostonApartments.com/newsletters-unsubscribe.php>https://www.BostonApartments.com/newsletters-unsubscribe.php</A></FONT></I>';


$type2 = $r['NL_TYPE'];
$type = $type2 ;
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: newsletters@' . $_SERVER['SERVER_NAME'] . "\r\n" .
	'Reply-To: newsletters@' . $_SERVER['SERVER_NAME'] . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	       




if ($type="Clients") {

if ($isAdmin) {
$query = "SELECT * FROM CLIENTS WHERE GRID=$grid AND NEWSLETTER_SUBSCRIBE='2'";
} else {
$query = "SELECT * FROM CLIENTS WHERE GRID=$grid AND UID=$uid AND NEWSLETTER_SUBSCRIBE='2'";
}
	$res = mysqli_query($dbh, $query) or die(mysqli_error($dbh)());
	while ($r = mysqli_fetch_assoc($res))
	{
		$email = $r['CLIENT_EMAIL'];
		$mail = mail($email, $subject, $message, $headers);
		}
$msg = "Newsletter Sent";
$page = "newsletters-show";
return "";
}


if ($type="Landlords") {

if ($isAdmin) { 
$query = "SELECT * FROM LANDLORD WHERE GRID=$grid AND NEWSLETTER_SUBSCRIBE='2'";
} else {
$query = "SELECT * FROM LANDLORD WHERE GRID=$grid AND UID=$uid AND NEWSLETTER_SUBSCRIBE='2'";
}
	$res = mysqli_query($dbh, $query) or die(mysqli_error($dbh)());
	while ($r = mysqli_fetch_assoc($res))
	{
		$email = $r['LL_EMAIL'];
		$mail = mail($email, $subject, $message, $headers);
		$email = $r['OFF_EMAIL'];
		$mail = mail($email, $subject, $message, $headers);
	}

$msg = "Newsletter Sent";
$page = "newsletters-show";
return "";
}



if ($type="Everyone") {

if ($isAdmin) { 
$query = "SELECT * FROM LANDLORD WHERE GRID=$grid AND NEWSLETTER_SUBSCRIBE='2'";
} else {
$query = "SELECT * FROM LANDLORD WHERE GRID=$grid AND UID=$uid AND NEWSLETTER_SUBSCRIBE='2'";
}
	$res = mysqli_query($dbh, $query) or die(mysqli_error($dbh)());
	while ($r = mysqli_fetch_assoc($res))
	{
		$email = $r['LL_EMAIL'];
		$mail = mail($email, $subject, $message, $headers);
		$email = $r['OFF_EMAIL'];
		$mail = mail($email, $subject, $message, $headers);
	}

if ($isAdmin) {
$query = "SELECT * FROM CLIENTS WHERE GRID=$grid AND NEWSLETTER_SUBSCRIBE='2'";
} else {
$query = "SELECT * FROM CLIENTS WHERE GRID=$grid AND UID=$uid AND NEWSLETTER_SUBSCRIBE='2'";
}
	$res = mysqli_query($dbh, $query) or die(mysqli_error($dbh)());
	while ($r = mysqli_fetch_assoc($res))
	{
		$email = $r['CLIENT_EMAIL'];
		$mail = mail($email, $subject, $message, $headers);
	}
$msg = "Newsletter Sent";
$page = "newsletters-show";
return "";
}





/*
    if ($mail)
    {
    echo "Email sent to " . $email . '<br>';
    die;
    }
    else
    {
    echo "Error in mailing " . $email . '<br>';
    die;
    } 
*/
?>
