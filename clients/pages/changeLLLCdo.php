<!--html code if successfully updated-->
<html>
<head>
<title>Landlord Last Contact Date Updated</title>

<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
//START LL Last Contact Do //

	$now_now = date ("Ymd");

			$lid = $_GET['lid'];
			$grid = $_GET['grid'];
			$next_contact = $_GET['next_contact'];
			$quStrUpdateLandlord = "update LANDLORD set LAST_CONTACTED='$now_now' where LID='$lid' and GRID='$grid'";
			$quUpdateLandlord = mysqli_query($dbh, $quStrUpdateLandlord) or die (mysqli_error($dbh));


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