<?php



//---Live Values---//





//DB CONNECT//

$dbh = mysqli_connect ("localhost", "root", "") or die ("I cannot connect to the database.");

$DBNAME = "lacms";









$PASSWORD_FILE = "/usr/home/eboyer/public_html/bostonapartments/lacms/.htpasswd";

$liveDataDir = "../test/";

$picsDirectory = "/usr/home/eboyer/public_html/bostonapartments/pics";

$picsTempDir = "/usr/home/eboyer/public_html/bostonapartments/lacms/preview/";

$defaultLocHTML_HEAD = "This is the dumb head <br>";

$defaultLocHTML_FOOT = "This is the dumb foot <br>";

$defaultTypeHTML_HEAD = "This is the dumb head <br>";

$defaultTypeHTML_FOOT = "This is the dumb foot <br>";



?>

