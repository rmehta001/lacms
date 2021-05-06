<?php 
$two_days_ago =  getdate(strtotime ("-2 day"));

$year = $two_days_ago['year'];
$mon = (strlen ($two_days_ago['mon']) <= 1) ? "0" .  $two_days_ago['mon'] : $two_days_ago['mon'];
$mday = (strlen ($two_days_ago['mday']) <= 1) ? "0" .  $two_days_ago['mday'] : $two_days_ago['mday'];

$str_date = $year . $mon . $mday;

exec ("rm -R '/usr/home/eboyer/lacmsBACKUP/$str_date/'");

?>

