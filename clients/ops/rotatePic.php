<?php
   if( $degrees > 0 && is_file("$picsDirectory/$pid.$ext"))
   {
      $command="/usr/bin/convert -rotate $degrees $picsDirectory/$pid.$ext /tmp/$pid.$ext";
      $output=exec($command);
	if(is_file("/tmp/$pid.$ext"))
	{
		$command="/bin/mv /tmp/$pid.$ext $picsDirectory/$pid.$ext";
		$output=exec($command);
	}
        $page = "rotateRedirect";
        $msg = "rotating $pid $cid by $rotate degrees";
   } else {
	$page = "rotateRedirect";
	$msg="error while rotating $pid $cid";
	$msg_err = true;
   }
?>
