<?php
$agency_object=mysqli_fetch_object($quAgency);

if (!isset($pref_pagebg) || $pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>

<B>MULTI-OFFICE / SUB AGENCY SET-UP</B>

<form action=<?php echo "$PHP_SELF?op=editAgencyDo&return_page=$return_page" ?> method=POST>
<br>Sub-Agency/Office Name: <input type=text name=AGENCY_NAME size=16 value="<?php echo $agency_object->AGENCY_NAME; ?>"><br><br>
<input type=hidden name=agency_id value=<?php echo $agency_id; ?> >

<TABLE BORDER=1 BGCOLOR="<?php echo $pagebgcolor;?>"><TR><TD>


<?php
$result = mysqli_query($dbh, "SHOW COLUMNS FROM AGENCIES");
if (!$result) {
   echo 'Could not run query: ' . mysqli_error($dbh);
   exit;
}
if (mysqli_num_rows($result) > 0) {
   while ($row = mysqli_fetch_assoc($result)) {
//	print_r($row);
	$name=$row['Field'];
	if(preg_match('/HEADER\_/',$name)|| preg_match('/FOOTER\_/',$name) || preg_match('/CUSTOM_SIGNATURE/', $name))
	{	
	echo $name.":</TD><TD> <textarea name=$name cols=62 rows=6 >".htmlspecialchars($agency_object->$name)."</textarea><br></TD></TR><TR><TD>";	
	}
   }
}
?> 


</TD></TR></TABLE>

<input type=submit value="Save Changes" STYLE="Background-Color : #adffad">
<a href=<?php echo "$PHP_SELF?op=return_page_op"; ?>>Cancel</a>
</form>
