<B><FONT="+2">CREATE A NEW AGENCY</B></FONT><BR>


<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="1" BORDERCOLOR="#000000" BGCOLOR="<?php echo $pagebgcolor;?>"><TR><TD>
<CENTER>

<form action=<?php echo "$PHP_SELF?op=createAgencyDo&return_page=$return_page" ?> method=POST>

<br>Agency Name: <input type=text name=AGENCY_NAME size=16><br><br>

<TABLE>

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
	if(preg_match('/HEADER\_/',$name)|| preg_match('/FOOTER\_/',$name) || preg_match('/CUSTOM\_/',$name))
	{	echo "<TR><TD VALIGN=RIGHT>".$name.":</TD><TD><textarea name=$name cols=62 rows=6 ></textarea></TD></TR>";	}
   }
}
?> 


</TABLE>


<input type=submit value="Create Agency">
</form>
<BR></CENTER>
</TD></TR></TABLE>