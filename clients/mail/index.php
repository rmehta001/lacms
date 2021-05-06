<?php
session_start();
include("../inc/global.php");
include("../inc/local_info.php");
if (isset($HTTP_GET_VARS['debug'])) {
	error_reporting(E_ALL);
}
include("./app_core.php");
?>

<html>
<head>
<title>Send an Email</title>
</head>
<body>
<h1>Send an Email</h1>
<form action="mail.php" method="POST" enctype="multipart/form-data">
<p>
<TABLE><TR><TD>

To: 

</TD><TD>

<input type="text" name="to" value="" /><br />



</TD></TR><TR><TD>

From: 
</TD><TD>


<input type="text" name="from" value="<?php echo "$rowGetUsers->EMAIL";?>" /><br />
</TD></TR><TR><TD>

Subject: </TD><TD>

<input type="text" name="subject" value="" /></p>

</TD></TR></TABLE>

<p>Message:<br />
<textarea cols="70" rows="20" name="message"></textarea></p>
<p>File Attachment: <input type="file" name="fileatt" /></p>
<p><input type="submit" value="Send" /></p>
</form>
</body>
</html>
