<?php



//---Live Values---//





//DB CONNECT//
$DBNAME = "lacms";
$dbh = mysqli_connect ("localhost", "bstapts_wbusr", "bstapts_wbusr", $DBNAME) or die ("I cannot connect to the database.");











$PASSWORD_FILE = "/usr/home/eboyer/public_html/bostonapartments/lacms/.htpasswd";

$liveDataDir = "../test/";

$picsDirectory = "/usr/home/eboyer/public_html/bostonapartments/pics";

$defaultLocHTML_HEAD = "This is the dumb head <br>";

$defaultLocHTML_FOOT = "This is the dumb foot <br>";

$defaultTypeHTML_HEAD = "This is the dumb head <br>";

$defaultTypeHTML_FOOT = "This is the dumb foot <br>";



?>
