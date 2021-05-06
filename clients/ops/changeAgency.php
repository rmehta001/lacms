<?php

	$strLookupGroup="select * from AGENCIES where GID=$grid and AGENCY_ID=$agency";
	$quLookupGroup = mysqli_query($dbh, $strLookupGroup) or die (dieNice("can't get agency info")); 
	if(mysqli_num_rows($quLookupGroup)>0 || $agency==0)
	{
		$changeStrAgency="update CLASS set AGENCY_HEADERS=$agency WHERE CID=$cid";
		$quchangeAgency = mysqli_query($dbh, $changeStrAgency) or die (dieNice ("Sorry, couldn't change agency.", "E-109"));
		$agencyArr=mysqli_fetch_object($quLookupGroup);
		if($agency==0)
		{ $msg="Assigned listing $cid to default agency"; }
		else
		{ $msg="Assigned listing $cid to agency $agencyArr->AGENCY_NAME"; }
	} else
	{
		$msg="Sorry, can't change agency: $cid - $agency.";
	}

	$page=$return_page;
?>
