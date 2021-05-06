<?php
//BEGIN Pic Codes //


$cid = $_POST['cid'];
$pid = $_POST['pid'];
$ext = $_POST['ext'];

$title = "Picture Codes";
$page = "picturelinks";

      $quStrGetPic = "SELECT * FROM PICTURE WHERE CID=$cid AND PID=$pid";
      $quGetPic = mysqli_query($dbh, $quStrGetPic);
      if($rowGetPic = mysqli_fetch_object($quGetPic))
      {
         $rowGetPic="https://www.BostonApartments.com/pics/$rowGetPic->PID.$rowGetPic->EXT"; 
}else { 

$rowGetPic="huh?"; 
}




//END Pic Codes //
?>
