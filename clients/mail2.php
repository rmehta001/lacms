<html>
<head>
<title> Sending Email </title>

<script Language="JavaScript">
<!--
function close_window() {
	window.close();}
-->
</script>

</head>
<body>
<?php
// Read POST request params into global vars
$to      = $_POST['to'];
$from    = $_POST['from'];
$subject = $_POST['subject'];
$client_list = $_POST['client_list'];


if(get_magic_quotes_gpc())
	$message = stripslashes($_POST['message']);
else
	$message = $_POST['message'];
$bcc     = $_POST['bcc'];

if ($client_list) {
$to .= ",$client_list";
}

// Obtain file upload vars
$fileatt      = $_FILES['fileatt']['tmp_name'];
$fileatt_type = $_FILES['fileatt']['type'];
$fileatt_name = $_FILES['fileatt']['name'];

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


$headers .= "From: $from \r\n";
$headers .= "bcc: $bcc \r\n";

if (is_uploaded_file($fileatt)) {
  // Read the file to be attached ('rb' = read binary)
  $file = fopen($fileatt,'rb');
  $data = fread($file,filesize($fileatt));
  fclose($file);

  // Generate a boundary string
  $semi_rand = md5(time());
  $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
  
  // Add the headers for a file attachment
  $headers .= "\nMIME-Version: 1.0\n" .
              "Content-Type: multipart/mixed;\n" .
              " boundary=\"{$mime_boundary}\"";

  // Add a multipart boundary above the plain message
  $message = "This is a multi-part message in MIME format.\n\n" .
             "--{$mime_boundary}\n" .
             "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
             "Content-Transfer-Encoding: 7bit\n\n <--" .
             $message . "-->\n\n";

  // Base64 encode the file data
  $data = chunk_split(base64_encode($data));

  // Add file attachment to the message
  $message .= "--{$mime_boundary}\n" .
              "Content-Type: {$fileatt_type};\n" .
              " name=\"{$fileatt_name}\"\n" .
              //"Content-Disposition: attachment;\n" .
              //" filename=\"{$fileatt_name}\"\n" .
              "Content-Transfer-Encoding: base64\n\n" .
              $data . "\n\n" .
              "--{$mime_boundary}--\n";
}

// Send the message
$ok = @mail($to, $subject, $message, $headers);
if ($ok) {

  echo "<p>Your email has been sent</p> <a href=\"#\" onClick=\"history.go(-2)\">Click to go Back to the BostonApartments.com Database</a>";
echo "TO: $to";
  echo "<p><a href=\"javascript:close_window();\">Click Here to Close this tab/window</a>";

} else {
  echo "<p>Your email could not be sent. Sorry!  Please check the email address it is being sent to.</p>";
}
?>
</body>
</html>
