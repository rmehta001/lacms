<!--html code if successfully updated-->
<html>
<head>
<title>Date on Market Updated</title>

<?php
//START LL Last Contact Do //

	$now_now = date ("Ymd");

			$lid = $HTTP_GET_VARS['cid'];
			$grid = $HTTP_GET_VARS['grid'];
			$next_contact = $HTTP_GET_VARS['next_contact'];
			$quStrUpdateListing = "update CLASS set DATEONMARKET='$now_now' where CID='$cid' and CLI='$grid'";
			$quUpdateListing = mysqli_query($dbh, $quStrUpdateListing) or die (mysqli_error($dbh));


if ($next_contact < $now_now  ) {

			$quStrUpdateListing2 = "update CLASS set DATEONMARKET='$now_now' where CID='$cid' and CLI='$grid'";
			$quUpdateListing = mysqli_query($dbh, $quStrUpdateListing) or die (mysqli_error($dbh));
	}



// header("Location: $PHP_SELF/clients/pages/editLandlord.php&lid=$lid"); //

//END LL Last Contact Do //
?>

<meta http-equiv="refresh" content="0;url=<?php echo $PHP_SELF;?>?op=adlEdit&amp;cid=<?php echo $cid;?>">

</head>
<body>
<P><BR><P>

<A HREF="<?php echo $PHP_SELF;?>?op=adlEdit&amp;cid=<?php echo $cid;?>">Back to Editing Listing # <?php echo $cid;?></A>

<P><BR><P>
</BODY></HTML>