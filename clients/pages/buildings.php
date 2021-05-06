<CENTER>
<TABLE BGCOLOR="#FFFFFF" WIDTH="650" BORDER=1 CELLPADDING=8><TR><TD>

<CENTER>
<h4><NOBR><IMG src="../assets/images/buildings.jpg" BORDER="0" TITLE="All Buildings for this Landlord"> List of Buildings/Properties for:<BR>
<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
  ?>
<a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$lid";?>" TITLE="Click to Edit / View <?php echo "$llname"; ?>"><?php echo "$llname"; ?></a>
</NOBR></H4>

<TABLE><TR><TD>

<?php
	$quStrGetBuildings = "SELECT DISTINCT `STREET_NUM` , `STREET` FROM CLASS WHERE `CLI` =$grid AND `CLASS`.`LANDLORD`=$lid ORDER BY `CLASS`.`STREET` ASC, `CLASS`.`STREET_NUM`";
	$quGetBuildings = mysqli_query($dbh, $quStrGetBuildings) or die ($quStrGetBuildings);
	$num_Buildings=mysqli_num_rows($quGetBuildings);
	if($num_Buildings>0)
	{
?>

<?php
	echo "<NOBR><A HREF=$PHP_SELF?op=global-Landlord&lid=$lid&llname=$llname><IMG src=../assets/images/global.jpeg BORDER=0 TITLE=\"Make Global changes to ALL Listings in ALL Buildings for this Landlord\"><FONT SIZE=1px>&nbsp;Click Here Make Global changes to ALL Listings in ALL Buildings</A>";?>
</FONT></NOBR>
<BR><BR>

<FONT SIZE="-1"><B><?php echo "Landlord has $num_Buildings buildings</B></FONT><BR><BR>";?>


<?php



echo "<TABLE CELLPADDING=0 CELLSPACING=0 BORDER=0>";


 while($rowBuildings = mysqli_fetch_object($quGetBuildings))
		{

echo "<TR><TD VALIGN=TOP>";

$quStrGetstatus = "SELECT STATUS FROM CLASS WHERE CLI='$grid' AND LANDLORD='$lid' AND STREET='$rowBuildings->STREET' AND STREET_NUM='$rowBuildings->STREET_NUM' AND STATUS='ACT' LIMIT 1";
$result = mysqli_query($dbh, $quStrGetstatus);
$test = mysqli_num_rows($result);
if ($test >0) {
echo "<img border='0' vspace='0' hspace='0' width='16' height='16' src='../assets/images/act.gif' title='Units Advertised' alt='Units Advertised'>";
} else {
echo "<img border='0' vspace='0' hspace='0' width='16' height='16' src='../assets/images/inact.jpg' title='No Units Advertised' alt='No Units Advertised'>";
}

echo "</TD><TD VALIGN=TOP>";

$quStrGetstatusa = "SELECT STATUS_ACTIVE FROM CLASS WHERE CLI='$grid' AND LANDLORD='$lid' AND STREET='$rowBuildings->STREET' AND STREET_NUM='$rowBuildings->STREET_NUM' AND STATUS_ACTIVE='1' LIMIT 1";
$result2 = mysqli_query($dbh, $quStrGetstatusa);
$test2 = mysqli_num_rows($result2);
if ($test2 >0) {
echo "<img src=\"../assets/images/icons/a.jpg\" border=0 height=16 width=16 alt=\"available\" title=\"Available Units\">";
} else {
echo "<img src=\"../assets/images/icons/u.jpg\" border=0 height=16 width=16 alt=\"unavailable\" title=\"No Units Available\">";
}

echo "</TD><TD VALIGN=TOP>";
?>

<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none&activeFilter=n&vid=7&sortD=ASC&sort=STREET,%20STREET_NUM,%20APT";?>" method="POST" target="_NEW">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="landlord" value="<?php echo $rowBuildings->LID;?>">
	<input type="hidden" name="street_num" value="<?php echo $rowBuildings->STREET_NUM;?>">
	<input type="hidden" name="street" value="<?php echo $rowBuildings->STREET;?>">

<input type="image" src="../assets/images/listings.gif" name="listings" border='0' vspace='0' hspace='0' TITLE="View Listings @ <?php echo "$rowBuildings->STREET_NUM $rowBuildings->STREET";?>">
	</form>

<?php

echo "</TD><TD VALIGN=TOP>";


if ($rowBuildings->STREET_NUM !="" or $rowBuildings->STREET!=""){


	if ($user_level>=3) {
	echo "<A HREF=\"$PHP_SELF?op=global-ListingsEdit&lid=$lid&street_num=$rowBuildings->STREET_NUM&street=$rowBuildings->STREET\">$rowBuildings->STREET_NUM $rowBuildings->STREET</A><BR>";

	} else {
		echo "$rowBuildings->STREET_NUM $rowBuildings->STREET<BR>";
	}


} else {
echo "<A HREF=$PHP_SELF?op=global-ListingsEdit&lid=$lid&street_num=$rowBuildings->STREET_NUM&street=$rowBuildings->STREET>No address given</A><BR>";
}

		echo "</TD><TD>";

?>




<FONT SIZE=-2>

<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none&vid=7&sortD=ASC&sort=STREET,%20STREET_NUM,%20APT";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="landlord" value="<?php echo $lid;?>">
	<input type="hidden" name="street" value="<?php echo $rowBuildings->STREET;?>">
	<input type="hidden" name="street_num" value="<?php echo $rowBuildings->STREET_NUM;?>">
	<input type="submit" value="Edit Building's Listings Individually" STYLE="Background-Color : #E0FFE0; font-size: 8px;"></form>

</FONT>
</TD>

<?php if ($user_level>=3) { ?>

<TD> &nbsp; </TD><TD VALIGN=TOP>
<?php
	echo "<A HREF=\"$PHP_SELF?op=global-ListingsEdit&lid=$lid&street_num=$rowBuildings->STREET_NUM&street=$rowBuildings->STREET\"><FONT COLOR=green SIZE=-1><img border=0 src=\"../images/icons/edit.gif\" alt=\"edit\">Edit Building Globally</FONT></A></TD>";

?>
<TD> &nbsp; </TD><TD VALIGN=TOP>

<?php

$quStrGetstatusp = "SELECT PIC FROM CLASS WHERE CLI='$grid' AND LANDLORD='$lid' AND STREET='$rowBuildings->STREET' AND STREET_NUM='$rowBuildings->STREET_NUM' AND PIC>='1' LIMIT 1";
$result3 = mysqli_query($dbh, $quStrGetstatusp);
$test3 = mysqli_num_rows($result3);
if ($test3 >0) {

?>

<a href="<?php echo "$PHP_SELF?op=pics-building&street_num=$rowBuildings->STREET_NUM&street=$rowBuildings->STREET&lid=$lid";?>" target="_NEW"><img border="0" src="../assets/images/pic-gallery.jpeg" HEIGHT="20" WIDTH="26" TITLE="Building Photo Gallery"></a><BR>

<?php  } else {
echo "&nbsp;";
} ?>




<?php
} ?>
<?php 
		}
	}
?>




</TD></TR></TABLE>



<P><CENTER>
<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none&vid=7&sortD=ASC&sort=STREET,%20STREET_NUM,%20APT";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="landlord" value="<?php echo $rowGetLandlord->LID;?>">
	<input type="submit" value="View All This Landlord's Listings" STYLE="Background-Color : #E0FFFF; font-size: 12px;">
</form>

<?php echo "</TR></TABLE><BR><NOBR><A HREF=$PHP_SELF?op=manageLandlord><FONT COLOR=RED SIZE=+1><B>BACK TO MANAGE LANDLORDS</B></FONT></A>"; ?>
 | 
<a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$lid";?>"><img border="0" vspace="0" hspace="0" src="../images/icons/edit.gif" TITLE="Edit/View <?php echo "$llname";?>'s Info" ALT="Edit/View <?php echo "$llname";?>'s Info">Edit/View <?php echo "$llname";?></a>
</NOBR>
</CENTER>


</TD></TR></TABLE>
</CENTER>