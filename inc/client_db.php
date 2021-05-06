<?php



//DB CONNECT//

$link = mysqli_connect ("localhost", "bstapts_wbusr", "bstapts_wbusr") or die ("I cannot connect to the database.");



$DBNAME = "lacms";

$picsDirectory = "/usr/home/eboyer/public_html/bostonapartments/pics";



// DB CONNECT //

mysqli_select_db ($link, $DBNAME);



?>
