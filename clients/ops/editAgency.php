<?php

$agency_id = $_GET['agency_id'] ?? "";
$quStrAgency="SELECT * FROM AGENCIES WHERE AGENCY_ID=$agency_id and GID=$grid";
$quAgency=mysqli_query($dbh, $quStrAgency);
$row_count= $quAgency != false ? mysqli_num_rows($quAgency) : 0;
if ($row_count<=0)
{
        $msg="Sorry, agency id #$agency_id not found.";
	$page=$return_page;
} elseif ($row_count>1)
{
	$msg="Sorry, problem with agency id #$agency_id.";
	$page=$return_page;
}else
{
	$page="editAgency";
}
?>
