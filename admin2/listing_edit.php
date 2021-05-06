<?php
session_start();
include ("./inc/admin_key.php");
while (($rowGetValueDefs = mysqli_fetch_object($quGetValueDefs)) ){

    $string = $rowGetValueDefs->DEFINE;
    $values = explode (",", $string);
    foreach ($values as $key => $value) {
        $values2[$key] = explode("_", $value);
    }
    foreach ($values2 as $values3) {
        $offset = $values3[0];
        $DEFINED_VALUE_SETS[$rowGetValueDefs->CLASS_NAME][$offset] = isset($values3[1])?$values3[1]:null;
    }

    $string = false;
    $values = false;
    $values2 = false;
    $values3 = false;
    $offset = false;


}
?>
<?php
if(isset($_GET['listing_id'])){
$listing_id = $_GET['listing_id'];}

if (isset($listing_id)) {
	//this is an edit//
	$word = "Edit";
	$msg = "Edit the Listing's settings here.";
	$action = "update";

	$quStrGetListing = "select * from (`CLASS` left join LANDLORD on CLASS.LANDLORD=LANDLORD.LID) inner join USERS on CLASS.UID=USERS.UID  where CID='$listing_id'";
	$quGetListing = mysqli_query($dbh,$quStrGetListing) or die (mysqli_error());
	$rowGetListing = mysqli_fetch_object($quGetListing);
	$agency_id = $rowGetListing->CLI;

	$quStrGetAgency = "select * from `GROUP` where GRID='$agency_id'";
	$quGetAgency = mysqli_query($dbh,$quStrGetAgency) or die (mysqli_error());
	$rowGetAgency = mysqli_fetch_object($quGetAgency);

	$quStrGetPictureCount = "select count(PID) as picture_count from PICTURE where CID='$listing_id'";
	$quGetPictureCount = mysqli_query($dbh,$quStrGetPictureCount) or die (mysqli_error());
	$rowGetPictureCount = mysqli_fetch_object($quGetPictureCount);
	$picture_count = $rowGetPictureCount->picture_count;

}else {
	//this is a create//
	$word = "Create";
	$msg = "Create a new Listing here.";
	$action = "create";
}
?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				<?php echo $word;?> Listing
				</span><br>
				</p>
				<?php if (isset($listing_id)) {?>
				<p>
				<span class="text">Listing belongs to: <a href="agency_edit.php?agency_id=<?php echo $rowGetAgency->GRID;?>"><?php echo $rowGetAgency->NAME;?></a></span>
				</p>
				<?php } ?>
				<p>
				<?php echo $msg;?>
				</p>
				<p>
				<?php if(isset($picture_count)) {?>
				<a href="listing_pictures_edit.php?listing_id=<?php echo $listing_id;?>">Click here</a> to edit this listing's pictures (<b><?php echo $picture_count;?></b>) or upload new ones.
				<?php }else { ?>
				<a href="listing_pictures_edit.php?listing_id=<?php echo $listing_id;?>">Click here</a> to upload pictures for this listing.
				<?php } ?>
				</p>
				<p>
				To delete this listing, <a href="listing_delete.php?listing_id=<?php echo $listing_id;?>">click here</a>.
				</p>
				<p>
				(<b>*bolded</b> fields are required)
				</p>
				<p>

				<table width="100%" cellpadding="4" cellspacing="0" border="0">
				<script language="javascript">
				<!--
				function listing_edit_form_submit() {
					var bad = 0;
					var msg = "";

					if (document.getElementById("LOC").selectedIndex==0) {
						bad++;
						msg += "Please choose a Location. \n";
					}

					if (bad) {
						alert (msg);
					}else {
						document.forms.listing_edit_form.submit();
					}
				}
				-->
				</script>


					<form name="listing_edit_form" method="post" action="listing_edit_thanks.php">
					<input type="hidden" name="listing_id" value="<?php if(isset($listing_id)) { echo $listing_id;}?>">
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						<b>*Agency:</b>
						</span>
						</td>
						<td valign="middle">
						<select name="CLI">
						<?php
						$quStrGetAgencies = "select * from `GROUP` order by NAME";
						$quGetAgencies = mysqli_query($dbh,$quStrGetAgencies) or die (mysqli_error($dbh));
						while ($rowGetAgencies = mysqli_fetch_object($quGetAgencies)) {
							echo "<option value=\"";
							echo $rowGetAgencies->GRID;
							echo "\" ";
							if (!isset($listing_id) && $rowGetAgencies->GRID==1) {
								echo "selected";
							}elseif (isset($rowGetListing)&&$rowGetListing->CLI==$rowGetAgencies->GRID) {
								echo "selected";
							}
							echo ">";
							echo $rowGetAgencies->NAME;
							echo "</option> \n";
						}?>
						</select>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						<b>*Type:</b>
						</span>
						</td>
						<td valign="middle">
						<select id="TYPE" name="TYPE">
						<?php
						$quStrGetTypes = "select * from TYPES order by TYPE";
						$quGetTypes = mysqli_query($dbh,$quStrGetTypes) or die(mysqli_error($dbh));
						while ($rowGetTypes = mysqli_fetch_object($quGetTypes)) {
							echo "<option value=\"";
							echo $rowGetTypes->TYPE;
							echo "\" ";
							if (isset($rowGetListing)&&$rowGetListing->TYPE==$rowGetTypes->TYPE) {
								echo "selected";
							}
							echo ">";
							echo $rowGetTypes->TYPENAME;
							echo "</option> \n";
						}?>
						</select>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						<b>*Location:</b>
						</span>
						</td>
						<td valign="middle">
						<select id="LOC" name="LOC">
						<option value="--">Please Choose:</option>
						<?php
						$quStrGetFavLocs = "SELECT * FROM FAVLOC INNER JOIN LOC ON FAVLOC.LOC=LOC.LOCID WHERE UID='$uid' ORDER BY SCORE DESC LIMIT 10";
						$quGetFavLocs = mysqli_query($dbh,$quStrGetFavLocs) or die(mysqli_error());
						while ($rowGetFavLocs = mysqli_fetch_object($quGetFavLocs)) {
							echo "<option value=\"";
							echo $rowGetFavLocs->LOCID;
							echo "\" ";
							if ($rowGetListing->LOC==$rowGetFavLocs->LOCID) {
								echo "selected";
								$locSeled = true;
							}
							echo ">";
							echo $rowGetFavLocs->LOCNAME;
							echo "</option> \n";
						}?>
						<option value="--">--------------------------</option>
						<?php
						$quStrGetLocs = "select * from LOC order by LOCNAME";
						$quGetLocs = mysqli_query($dbh,$quStrGetLocs) or die(mysqli_error());
						while ($rowGetLocs = mysqli_fetch_object($quGetLocs)) {
							echo "<option value=\"";
							echo $rowGetLocs->LOCID;
							echo "\" ";
							if (isset($rowGetListing)&&$rowGetListing->LOC==$rowGetLocs->LOCID && !$locSeled) {
								echo "selected";
							}
							echo ">";
							echo $rowGetLocs->LOCNAME;
							echo "</option> \n";
						}?>
						</select>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Special Order:
						</span>
						</td>
						<td valign="middle">
						<?php
						if (!isset($listing_id)) {
							$sporder = 99;
						}else {
							$sporder = $rowGetListing->SPORDER;
						}?>
						<input name="SPORDER" type="text" size="10" value="<?php echo $sporder;?>">
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Fee Disclosure:
						</span>
						</td>
						<td valign="middle">
						<select name="NOFEE">
						<option value="--">--</option>
						<?php foreach ($DEFINED_VALUE_SETS['NOFEE'] as $nfkey => $nfValue) {
							$selected = ($rowGetListing->NOFEE==$nfkey) ? " selected " : ""; ?>
							<option value="<?php echo $nfkey;?>" <?php echo $selected;?>><?php echo $nfValue;?></option>
						<?php } ?>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Number of Bedrooms:
						</span>
						</td>
						<td valign="middle">
						<select name="ROOMS">
						<option value="--">--</option>
						<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) {
							$selected = ($rowGetListing->ROOMS==$key) ? " selected " : ""; ?>
							<option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $roomsValue;?></option>
						<?php } ?>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Number of Bathrooms:
						</span>
						</td>
						<td valign="middle">
						<select name="BATH">
						<option value="--">--</option>
						<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bathkey => $bathValue) {
							$selected = ($rowGetListing->BATH==$bathkey) ? " selected " : ""; ?>
							<option value="<?php echo $bathkey;?>" <?php echo $selected;?>><?php echo $bathValue;?></option>
						<?php } ?>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Date Available:
						</span>
						</td>
						<td valign="middle">
						<?php
						if (!isset($listing_id)) {
							$avail = date ("Y-m-d");
						}else {
							$avail = $rowGetListing->AVAIL;
						}?>
						<input name="AVAIL" type="text" size="10" value="<?php echo $avail;?>">
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						Rent in Dollars:
						</span>
						<span class="fineprint">Do <i>not</i> include "$" or decimal points</span>
						</td>
						<td valign="middle">
						<input name="PRICE" type="text" size="10" value="<?php if(isset($rowGetListing)){echo $rowGetListing->PRICE;}?>">
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
						Remarks (ad body):
						</span>
						</td>
						<td valign="middle">
						<textarea rows="6" cols="40" name="BODY"><?php if(isset($rowGetListing)){echo $rowGetListing->BODY;}?></textarea>
                        <input type="button" value="Check Spelling" onClick="openSpellChecker();"/>

						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
						AltSig:
						</span>
						</td>
						<td valign="middle">
						<textarea rows="6" cols="40" name="ALTSIG"><?php if(isset($rowGetListing)){echo $rowGetListing->ALTSIG;}?></textarea>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<span class="text">
						Virtual Tour:
						</span>
						</td>
						<td valign="middle">
						<input type="text"  size="40" name="VIRT_TOUR" value="<?php if(isset($rowGetListing)){ echo $rowGetListing->VIRT_TOUR;}?>">
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						&nbsp;
						</span>
						</td>
						<td valign="middle">
						<input onClick="listing_edit_form_submit();" type="button" value="<?php echo $action;?>">
						</td>
					</tr>
					<tr bgcolor="#FFA4A4">
						<td valign="middle" align="right">
						<span class="text">
						Street Number:
						</span>
						</td>
						<td valign="middle">
						<input name="STREET_NUM" type="text" size="10" value="<?php if(isset($rowGetListing)){echo $rowGetListing->STREET_NUM;}?>">
						</td>
					</tr>
					<tr bgcolor="#FFA4A4">
						<td valign="middle" align="right">
						<span class="text">
						Street Name:
						</span>
						</td>
						<td valign="middle">
						<input name="STREET" type="text" size="30" value="<?php if(isset($rowGetListing)){ echo $rowGetListing->STREET;}?>">
						</td>
					</tr>
					<tr bgcolor="#FFA4A4">
						<td valign="middle" align="right">
						<span class="text">
						Apartment Number:
						</span>
						</td>
						<td valign="middle">
						<input name="APT" type="text" size="10" value="<?php if(isset($rowGetListing)){echo $rowGetListing->APT;}?>">
						</td>
					</tr>
					<tr bgcolor="#FFA4A4">
						<td valign="middle" align="right">
						<span class="text">
						ZIP Code:
						</span>
						</td>
						<td valign="middle">
						<input name="ZIP" type="text" size="10" value="<?php if(isset($rowGetListing)){ echo $rowGetListing->ZIP;}?>">
						</td>
					</tr>
					<tr bgcolor="#FFA4A4">
						<td valign="middle" align="right">
						<span class="text">
						Offer Link to Map in Ad:
						</span>
						</td>
						<td valign="middle">
						<select name="MAP">
						<option value="0">No Map</option>
						<?php
						$quStrGetMaps = "select * from MAP_OFFER";
						$quGetMaps = mysqli_query($dbh,$quStrGetMaps) or die (mysqli_error());
						while ($rowGetMaps = mysqli_fetch_object($quGetMaps)) {
							?><option value="<?php echo $rowGetMaps->id;?>" <?php if (isset($rowGetListing)&&$rowGetListing->MAP==$rowGetMaps->id) { echo "selected";}?>><?php echo $rowGetMaps->title;?></option>
						<?php } ?>
						</select>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						&nbsp;
						</span>
						</td>
						<td valign="middle">
						<input onClick="listing_edit_form_submit();" type="button" value="<?php echo $action;?>">
						</td>
					</tr>
					</form>
				</table>
				</p>
				
<?php include("./includes/footer_admin.php");?> 	
				
