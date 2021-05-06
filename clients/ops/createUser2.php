<?php
//BEGIN createUser //
	if ((!$isAdmin) AND ($user_level < "10")){
		die (dieNice("Sorry,  you are not the admin user.", "E-10000"));
	}
	$page = "createUser";
	
	$title = "Create User";
//END createUser //
?>
