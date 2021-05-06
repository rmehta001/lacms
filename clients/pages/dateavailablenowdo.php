<!--html code if successfully updated-->
<html>
<head>
<title>Date on Market Updated</title>

<?php
//START Avail Date Now Do //

	$now_now = date ("Ymd");

			$cid = $HTTP_GET_VARS['cid'];
			$grid = $HTTP_GET_VARS['grid'];
			$next_contact = $now_now;
			$quStrUpdateListing = "update CLASS set AVAIL='$now_now' where CID='$cid' and CLI='$grid'";
			$quUpdateListing = mysqli_query($dbh, $quStrUpdateListing) or die (mysqli_error($dbh));


if ($next_contact < $now_now  ) {

			$quStrUpdateListing2 = "update CLASS set AVAIL='$now_now' where CID='$cid' and CLI='$grid'";
			$quUpdateListing = mysqli_query($dbh, $quStrUpdateListing) or die (mysqli_error($dbh));
	}

	// echo "<script>window.close();</script>"; //
	
	
// header("Location: $PHP_SELF/clients/pages/editLandlord.php&lid=$lid"); //

//END Avail Date Now Do //
?>

<meta http-equiv="refresh" content="0;url=<?php echo $PHP_SELF;?>?op=adlEdit&amp;cid=<?php echo $cid;?>">

</head>
<body>
<P><BR><P>

<A HREF="<?php echo $PHP_SELF;?>?op=adlEdit&amp;cid=<?php echo $cid;?>">Back to Editing Listing # <?php echo $cid;?></A>

<P><BR><P> 

</BODY></HTML>