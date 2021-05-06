<!--html code if successfully updated-->
<html>
<head>
<title>Landlord Listings Last Modified Date Updated</title>

<?php
//START LL Last Contact Do //

	$now_now = date ("Ymd");

			$lid = $HTTP_GET_VARS['lid'];
			$grid = $HTTP_GET_VARS['grid'];
			$next_contact = $HTTP_GET_VARS['next_contact'];
			$quStrUpdateListings = "update CLASS set `MOD`='$now_now', `MODBY`='$handle' where LANDLORD='$lid' and CLI='$grid'";
			$quUpdateListings = mysqli_query($dbh, $quStrUpdateListings) or die (mysqli_error($dbh));


if ($next_contact < $now_now  ) {

			$quStrUpdateLandlord2 = "update LANDLORD set NEXT_CONTACT='$now_now' where LID='$lid' and GRID='$grid'";
			$quUpdateLandlord = mysqli_query($dbh, $quStrUpdateLandlord2) or die (mysqli_error($dbh));
	}



// header("Location: $PHP_SELF/clients/pages/editLandlord.php&lid=$lid"); //

//END LL Last Contact Do //
?>

<meta http-equiv="refresh" content="0;url=<?php echo $PHP_SELF;?>?op=editLandlord&amp;lid=<?php echo $lid;?>">

</head>
<body>
<P><BR><P>

<A HREF="<?php echo $PHP_SELF;?>?op=editLandlord&amp;lid=<?php echo $lid;?>">Back to Editing Landlord # <?php echo $lid;?></A>

<P><BR><P>
</BODY></HTML>