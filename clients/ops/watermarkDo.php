<?php

$url="/lacms/clients/watermark/wmpic.php?photo=$pid.$ext&text=$text&size=$size";
`cd /tmp/ ;wget "http://localhost/$url"`;
`mv /tmp/$pic.$ext $picsDirectory/`;

$disData="pic";
$msg=$url;
$page="editPic2";

?>
