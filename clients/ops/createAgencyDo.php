<?php
	echo $user;
if(!$isAdmin && $handle!="chinkle")
{
	$msg="You need to have admin privileges for this operation";
} elseif(!$_POST[AGENCY_NAME])
{
	$msg="You must supply an agency name.";
}else
{
	$agcyCheckStr="SELECT * FROM AGENCIES WHERE GID=$grid";
	$agcyCheckQ=mysqli_query($dbh, $agcyCheckStr);
	$agcy_count=mysqli_num_rows($agcyCheckQ);
	if ($agcy_count>=$agcy)
	{
		$msg="You have reached the limit of $agcy sub agency/office accounts.";
	} else {
		$fields="GID";
		$values="'$grid'";
		foreach ($_POST as $key => $value)
		{
			$fields="$fields , $key";
			$values="$values, '$value'";
		}
	
		$insertStr="INSERT INTO AGENCIES ($fields) VALUES ($values)";
		$insertQu=mysqli_query($dbh, $insertStr);
		$msg="New Agency $_POST[AGENCY_NAME]";
	}
} 
	$page=$return_page;
?>
