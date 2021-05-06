<?php
if ($isAdmin || $handle=="chinkle")
{
	if($_POST[conf]!='y')
	{	
		$msg = "you need to confirm the delete";
		$page = "deleteAgency";
	}
	else
	{
		$strUpdate="UPDATE CLASS SET AGENCY_HEADERS=$agency_reassign WHERE CLI=$grid AND AGENCY_HEADERS=$agency_id";
		mysqli_query($dbh, $strUpdate) or die ($strUpdate);
		$strDelete="DELETE FROM AGENCIES WHERE AGENCY_ID=$agency_id AND GID=$grid";
		mysqli_query($dbh, $strDelete) or die ($strDelete);
		$msg="agency succesfully deleted";
		$page=$return_page;
	}

}else
{ 
	$msg = "you do not have priviledges to delete";
	$page=$return_page;
}
?>
