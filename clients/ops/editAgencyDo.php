<?php
$isAdmin = $_SESSION['isAdmin'] ?? false;
$user_level = $_SESSION['user_level'] ?? 0;
$handle = $_SESSION['handle'] ?? "";
$agency_id = $_POST['agency_id'] ?? "";
$AGENCY_NAME = $_POST['$AGENCY_NAME'] ?? "";

if (($isAdmin) OR $user_level >= "10" OR $handle=="eboyer" && $agency_id>0)
{
        $quStrAgency="select * from AGENCIES WHERE GID=$grid AND AGENCY_ID=$agency_id";
        $quAgency=mysqli_query($dbh, $quStrAgency);
	if($quAgency != false && mysqli_num_rows($quAgency)==1)
	{
		$others="AGENCY_NAME='$AGENCY_NAME'";
	        foreach ($_POST as $key => $value)
	        {
			$others=$others.", $key='$value'";
		}

		$a=mysqli_fetch_object($quAgency);
		$updateStrAgency="UPDATE AGENCIES SET $others WHERE GID=$grid AND AGENCY_ID=$agency_id";
		mysqli_query($dbh, $updateStrAgency) or die (mysqli_error($dbh));
		$msg="Updating $a->AGENCY_NAME";
	} else {
		$msg="having trouble with agency id: $agency_id.";
	}
} else
{
	$msg = "Sorry, you need to be admin to edit agencies";
}
$page=$return_page;
?>
