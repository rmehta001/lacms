<?php 
session_start();
include ("./inc/admin_key.php");
?>
<?php
$listing_id = $_GET['listing_id'];
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

$quStrGetListing = "select * from (CLASS inner join `GROUP` on CLASS.CLI=`GROUP`.GRID) inner join LOC on CLASS.LOC=LOC.LOCID where CID='$listing_id'";
$quGetListing = mysqli_query($dbh,$quStrGetListing) or die (mysqli_error());
$rowGetListing = mysqli_fetch_object($quGetListing);
 
$msg = "Delete a listing here. Pictures are also deleted.";

$action = "delete";



?>
<?php include("./includes/head_admin.php");?>
				<p>
				<span class="bigtitle">
				Delete Listing.
				</span><br>
				</p>
				
				<p>
				<span class="text">Listing belongs to: <a href="agency_edit.php?agency_id=<?php echo $rowGetListing->CLI;?>"><?php echo $rowGetListing->NAME;?></a></span>
				</p>
				
				<p>
				<?php echo $msg;?>
				</p>
				
				<p>
				<a href="listing_edit.php?listing_id=<?php echo $listing_id;?>">Click here</a> to edit this listing.
				</p>
				
				<p>
				<script language="javascript">
				<!--
				function delete_listing_form_submit() {
					if (confirm("Are you sure you want to delete this listing?")) {
						document.forms.delete_listing_form.submit();
					}
				}
				-->
				</script>
				
				
				
				
				
				<table width="100%" cellpadding="4" cellspacing="0" border="0">	
					<form name="delete_listing_form" method="post" action="listing_delete_thanks.php">
					<input type="hidden" name="listing_id" value="<?php echo $listing_id;?>">
					
					
					
					<tr>
						<td valign="middle" colspan="2">
						<span class="text">
						<?php echo format_ad($rowGetListing, $DEFINED_VALUE_SETS);?>
						</span>
						</td>
					</tr>
					<tr>
						<td valign="middle" align="right">
						<span class="text">
						&nbsp;
						</span>
						</td>
						<td valign="middle">
						<input type="button" onClick="delete_listing_form_submit();" value="<?php echo $action;?>">
						</td>
					</tr>
					</form>
				</table>
				</p>
				
<?php include("./includes/footer_admin.php");?>