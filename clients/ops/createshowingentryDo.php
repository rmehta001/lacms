<?php
//BEGIN createshowingDo //

$PHP_SELF = $_SERVER['PHP_SELF'];
	if ($_SESSION ["level"]>4) {
	
	
	
	
		$clid = isset($_POST['clid']);
		$showcomment = isset($_POST['showcomment']);
		$showing_date = $now;


		
		$quStrAddClient = "INSERT INTO SHOWINGS (CLI, UID, CLID, SHOWING_DATE, SHOWCOMMENT) VALUES ('$grid', '$uid', '$clid', '$showing_date', '$showcomment')";
		$quAddClient = mysqli_query($dbh, $quStrAddClient) or die ($quStrAddClient);
		$page = "manageClients";

$quStrGC = "select * from CLIENTS where `CLID`='$clid' AND `GRID`='$grid' LIMIT 1";
$quGC = mysqli_query($dbh, $quStrGC) or die (mysqli_error()); 
	while ($rowGC = mysqli_fetch_object($quGC)) {
$name_first = $rowGC->NAME_FIRST;
$name_last =  $rowGC->NAME_LAST;
	
}

		$msg = "New Client Entry created for $_SESSION[name_first] $name_last by $_SESSION[handle].
				
		&nbsp;&nbsp;

		
		<a href=\"$PHP_SELF?op=editClient&clid=$clid\" TITLE=\"Edit $name_first $name_last\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Edit $name_first $name_last\"></a>

		
		&nbsp;&nbsp;

		
				<a href=\"$PHP_SELF?op=showingsClient&clid=$clid\" TITLE=\"Edit $name_first $name_last Comments\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Edit $name_first $name_last Comments\"></a>

		
		&nbsp;&nbsp;
		
		
<a href=\"$PHP_SELF?op=listings&client_id_filter=$clid\"><img border=\"0\" hspace=\"2\" vspace=\"0\" width=\"19\" height=\"19\" src=\"../assets/images/matchlistings.gif\" TITLE=\"Match $name_first $name_last to Listings\" ALT=\"Match $name_first $name_last to Listings\"></a>

&nbsp;&nbsp;

<A HREF=\"$PHP_SELF?op=mail_client&clid=$clid\" target=\"_email$clid\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>

&nbsp;&nbsp;

<A HREF=\"$PHP_SELF?op=editClientReassign&clid=$clid&fname=$name_first&lname=$name_last\"><FONT SIZE=\"-2\"><img border=\"0\" hspace=\"0\" vspace=\"0\" width=\"16\" height=\"16\" src=\"../assets/images/client-reassign.gif\" TITLE=\"Reassign Client\" ALT=\"Reassign Client\"> Reassign $name_first $name_last</FONT></A>


</NOBR>
	
		" ;
		
		
		
		
		
		
		$title = "manageClients";

		$sec_op = "manageClients";
		

		
	}else {		
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
	
	
//END createshowingDo //
?>