<?php



$url="/lacms/clients/watermark/wmpic.php?photo=$pid.$ext&text=$text&size=$size";
echo "<img src=$url><br>";

echo "<a href=$PHP_SELF?op=watermarkDo&pid=$pid&ext=$ext&text=$text&size=$size&cid=$cid>Save</a>&nbsp<a href=$PHP_SELF?op=editPic2&cid=$cid&pid=$pid>Retry</a>";




?>
