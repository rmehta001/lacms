<?php

$con = new PDO("mysql:host=localhost;dbname=LACMS;charset=utf8", "hejazi_wbusr", "hejazi_wbusr");
$cid = $_GET['cid'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pics reorder</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>

.gallery{ width:100%; float:left;}
.gallery ul{ margin:0; padding:0; list-style-type:none;}
.gallery ul li{ padding:7px; border:2px solid #ccc; float:left; margin:10px 7px; background:none; width:auto; height:auto;}
.gallery img{ width:200px; height:170px;}

/* NOTICE */
.notice, .notice a{ color: #fff !important; }
.notice { z-index: 8888; }
.notice a { font-weight: bold; }
.notice_error { background: #E46360; }
.notice_success { background: #657E3F; }
	</style>
</head>
<body style="padding-top:20px">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <a href="javascript:void(0);" class="btn btn-primary btn-flat reorder_link" id="save_reorder" style="width:100%">Reorder photos</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="reorder-helper" class="light_box" style="display:none;">1. Drag photos to reorder.<br>2. Click 'Save Reordering' when finished.</div>
        </div>
        <div class="col-md-12">
            <div class="gallery">
                <ul class="reorder_ul reorder-photos-list">
                <?php 
                    //Fetch all images from database
                    $images = $con->prepare("SELECT * FROM PICTURE WHERE CID = ? ORDER BY PICORDER,PID");
                    $images->execute(array($cid));
                    $images = $images->fetchAll(PDO::FETCH_ASSOC);
                    if(!empty($images)){
                        foreach($images as $row){
                ?>
                    <li id="image_li_<?php echo $row['PID']; ?>" class="ui-sortable-handle"><a href="javascript:void(0);" style="float:none;" class="image_link"><img src="../../../pics/<?php echo $row['PID'] . '.' . $row['EXT']; ?>" alt=""></a></li>
                <?php } } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
$(document).ready(function(){
        $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
        $('.reorder_link').html('Save Reordering');
        $('.reorder_link').attr("id","save_reorder");
        $('#reorder-helper').slideDown('slow');
        $('.image_link').attr("href","javascript:void(0);");
        $('.image_link').css("cursor","move");
        $("#save_reorder").click(function( e ){
            if( !$("#save_reorder i").length ){
                $("ul.reorder-photos-list").sortable('destroy');
                $("#reorder-helper").html( "Reordering Photos - This could take a moment. Please don't navigate away from this page." ).removeClass('light_box').addClass('notice notice_error');
    
                var h = [];
                $("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                
                $.ajax({
                    type: "POST",
                    url: "managePics-reorder-do.php",
                    data: {ids: "" + h + "", cid: <?= $cid ?>},
                    success: function(){
                        //console.log(data);
                        window.location.replace("https://bostonapartments.com/lacms/clients/AgencyArea2.php?op=managePics&cid=<?= $cid ?>");
                    }
                }); 
                return false;

            }   
            e.preventDefault();     
        });
});
</script>

</body>
</html>