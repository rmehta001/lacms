<?php
session_start();
include ("./inc/admin_key.php");
?>
<?php
$uid=$_SESSION['uid'];
$now = date ("Ymd");
if(isset($_POST['listing_id']))
{
$listing_id = $_POST['listing_id'];
}
else{
    $listing_id="";
}
if(isset($_POST['CLI'])){
$CLI = $_POST['CLI'];}
else{
    $CLI="";
}
if(isset($_POST['TYPE'])){
$TYPE = $_POST['TYPE'];}
else{
    $TYPE="";
}
if(isset($_POST['LOC'])){
$LOC = $_POST['LOC'];}
else{
    $LOC="";
}
if(isset($_POST['SPORDER'])){
$SPORDER = $_POST['SPORDER'];}
else{
    $SPORDER="";
}
if(isset( $_POST['NOFEE'])){
$NOFEE = $_POST['NOFEE'];}
else{
    $NOFEE="";
}
if(isset($_POST['ROOMS'])){
$ROOMS = $_POST['ROOMS'];}
else{
    $ROOMS="";
}
if(isset( $_POST['BATH'])){
$BATH = $_POST['BATH'];}
else{
    $BATH="";
}
if(isset($_POST['AVAIL'])){
$AVAIL = $_POST['AVAIL'];}
else{
    $AVAIL="";
}
if(isset($_POST['PRICE'])){
$PRICE = $_POST['PRICE'];}
else{
    $PRICE="";
}
if(isset($_POST['BODY'])){
$BODY = $_POST['BODY'];}
else{
    $BODY="";
}
if(isset( $_POST['ALTSIG'])){
$ALTSIG = $_POST['ALTSIG'];}
else{
    $ALTSIG="";
}
if(isset($_POST['VIRT_TOUR'])){
$VIRT_TOUR = $_POST['VIRT_TOUR'];}
else
{
    $VIRT_TOUR="";
}
//$EXTERNALPIC = $_POST['EXTERNALPIC'];
if(isset($_POST['STREET_NUM'])){
$STREET_NUM = $_POST['STREET_NUM'];}
else{
    $STREET_NUM="";
}
if(isset($_POST['STREET']))
{
$STREET = $_POST['STREET'];}
else{
    $STREET="";
}
if(isset($_POST['APT'])){
$APT = $_POST['APT'];}
else{
    $APT="";
}
if(isset($_POST['ZIP'])){
$ZIP = $_POST['ZIP'];}
else{
    $ZIP="";
}
if(isset($_POST['MAP'])){
$MAP_OFFER = $_POST['MAP'];}
else{
    $MAP_OFFER="";
}




if (!empty($listing_id)) {
	//this is an edit//
	$quStrUpdateListing = "update CLASS set `MOD`='$now', CLI='$CLI', TYPE='$TYPE', LOC='$LOC', SPORDER='$SPORDER', NOFEE='$NOFEE', ROOMS='$ROOMS', BATH='$BATH', AVAIL='$AVAIL', PRICE='$PRICE', BODY='$BODY', ALTSIG='$ALTSIG', VIRT_TOUR='$VIRT_TOUR',  STREET_NUM='$STREET_NUM', STREET='$STREET', APT='$APT', ZIP='$ZIP', MAP='$MAP_OFFER' where CID='$listing_id'";
	$quUpdateListing = mysqli_query($dbh,$quStrUpdateListing) or die (mysqli_error());

	$word = "Edit";
	$msg = "The following listing has been updated:";

}else {
	//this is a create//
	$quStrInsertListing = "insert into CLASS (STATUS, DATEIN, `MOD`, UID, CLI, TYPE, LOC, SPORDER, NOFEE, ROOMS, BATH, AVAIL, PRICE, BODY, ALTSIG, VIRT_TOUR,  STREET_NUM, STREET, APT, ZIP, MAP) values ('ACT', '$now', '$now',  '$uid', '$CLI', '$TYPE', '$LOC', '$SPORDER', '$NOFEE', '$ROOMS', '$BATH', '$AVAIL', '$PRICE', '$BODY', '$ALTSIG', '$VIRT_TOUR',  '$STREET_NUM', '$STREET', '$APT', '$ZIP', '$MAP_OFFER')";
	$quInsertListing = mysqli_query($dbh,$quStrInsertListing) or die (mysqli_error());

	$listing_id = mysqli_insert_id($dbh);

	$word = "Created";
	$msg = "The following agent has been created:";
}
$quStrGetListing = "SELECT * FROM (CLASS inner join LOC on CLASS.LOC=LOC.LOCID) inner join `GROUP` on CLASS.CLI=`GROUP`.GRID where CLASS.CID='$listing_id'";
$quGetListing = mysqli_query($dbh,$quStrGetListing) or die (mysqli_error());
echo mysqli_affected_rows($dbh);
$rowGetListing = mysqli_fetch_object($quGetListing) or die (mysqli_error());
echo $rowGetListing->CLI. "ddd";
?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				<?php echo $word;?> Listing - Complete
				</span>
				</p>
				<p>
				<?php echo $msg;?>
				</p>
				<p>
                    <?php echo format_ad($rowGetListing, $DEFINED_VALUE_SETS);?>
				</p>
				
				
				<p>
				<img src="./images/arrow_orange.jpg"><a href="listing_edit.php?listing_id=<?php echo $listing_id;?>">Edit Listing</a>
				</p>
				<p>
				<img src="./images/arrow_orange.jpg"><a href="listing_pictures_edit.php?listing_id=<?php echo $listing_id;?>"><?php if (isset($picture_count)) { ?>Edit Listing's pictures (<b><?php echo $picture_count;?></b>)<?php } else { ?>Upload pictures for this Listing<?php } ?></a>
				</p>
				<p>
				<img src="./images/arrow_orange.jpg"><a href="agency_edit.php?agency_id=<?php echo $rowGetListing->CLI;?>">Edit Listing's Agency: <?php if(isset($rowetListing)){echo $rowetListing->NAME;}?></a>
				</p>
				
				<p>
				<hr size="1" noshade width="100%" color="#666666">
				<img src="./images/arrow_orange.jpg"><a href="manage_listings.php">Back to Manage Listings</a>
				</p>
				
				
<?php include("./includes/footer_admin.php");?> 	
	
	
	
	
	
	
	
				
