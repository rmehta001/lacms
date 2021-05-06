<?php
//---Live Values---//
//DB CONNECT//

$dbname = 'lacms';
$servername = "localhost";
$username = "root";
$password = "";
// Create connection

$GLOBALS['dbh'] = new mysqli($servername, $username, $password, $dbname);
$dbh = $GLOBALS['dbh'];
// Check connection
if ($dbh->connect_error) {
    die("Connection failed: " . $dbh->connect_error);
}
$GLOBALS['dbh'] = new mysqli($servername, $username, $password, $dbname);
$dbh = $GLOBALS['dbh'];
// Check connection
if ($dbh->connect_error) {
    die("Connection failed: " . $dbh->connect_error);
}
$a = 'aa';
$PASSWORD_FILE = "/usr/home/eboyer/public_html/bostonapartments/lacms/.htpasswd";
$liveDataDir = "../test/";
$picsDirectory = "/usr/home/eboyer/public_html/bostonapartments/pics";
$picsTempDir = "/usr/home/eboyer/public_html/bostonapartments/lacms/preview/";
$defaultLocHTML_HEAD = "This is the dumb head <br>";
$defaultLocHTML_FOOT = "This is the dumb foot <br>";
$defaultTypeHTML_HEAD = "This is the dumb head <br>";
$defaultTypeHTML_FOOT = "This is the dumb foot <br>";
