<?php

$con = new PDO("mysql:host=localhost;dbname=LACMS;charset=utf8", "hejazi_wbusr", "hejazi_wbusr");

$cid = $_POST['cid'];
$ids = $_POST['ids'];
$pics = explode(',', $ids);

array_unshift($pics,"");
unset($pics[0]);

foreach ($pics as $picOrder => $pid) {
	$update = $con->prepare("UPDATE PICTURE SET PICORDER = :picorder WHERE PID = :pid AND CID = :cid");
	$update->execute(array(":picorder" => $picOrder, ":pid" => $pid, ":cid" => $cid));
}

?>