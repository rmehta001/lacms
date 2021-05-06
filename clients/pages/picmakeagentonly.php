<!--html code if successfully updated-->
<html>
<head>
<title>Picture Status Updated</title>

<?php
//START Pic Make Private //

	$now_now = date ("Ymd");
			$pid = $HTTP_GET_VARS['pid'];
			$cid = $HTTP_GET_VARS['cid'];


			$quStrUpdatePic = "update PICTURE set AGENTONLY='1' where PID='$pid'";
			$quUpdatePic = mysqli_query($dbh, $quStrUpdatePic) or die (mysqli_error($dbh));





// header("Location: $PHP_SELF/clients/pages/editLandlord.php&lid=$lid"); //

//END picmakeprivate //
?>

<meta http-equiv="refresh" content="0;url=<?php echo $PHP_SELF;?>?op=managePics&amp;cid=<?php echo $cid;?>">

</head>
<body>
<P><BR><P>

<A HREF="<?php echo $PHP_SELF;?>?op=managePics&amp;cid=<?php echo $cid;?>">Back to Editing Listing # <?php echo $cid;?></A>

<P><BR><P>
</BODY></HTML>
