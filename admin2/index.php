<?php 
session_start();
include ("./inc/admin_key.php");
$op = "";
?>

<?php include("./includes/head_admin.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Watch</title>
</head>
<body>

<div style="width:520px;margin:0 auto;">
    <canvas id="clock" width="520" height="520"></canvas>
</div>

<script type="text/javascript">
    var canvas = document.getElementById('clock');
    var clock = canvas.getContext('2d');

    function drowClock(){


        clock.clearRect(0, 0, 800, 800);


        var now = new Date();
        var secd = now.getSeconds();
        var min = now.getMinutes();
        var hour = now.getHours();

        hour = hour + (min / 60);
        hour = hour > 12 ? hour - 12 : hour;


        clock.beginPath();
        clock.lineWidth = 10;
        clock.strokeStyle = "blue";
        clock.arc(250, 250, 200, 0, 360, false);
        clock.stroke();
        clock.closePath();

        for (var i = 0; i < 12; i++) {
            clock.save();

            clock.lineWidth = 7;

            clock.strokeStyle = "#000";

            clock.translate(250, 250);

            clock.rotate((i * 30) * Math.PI / 180);
            clock.beginPath();
            clock.moveTo(0, -170);
            clock.lineTo(0, -190);
            clock.closePath();
            clock.stroke();
            clock.restore();
        }
        //分刻度
        for (var i = 0; i < 60; i++) {
            clock.save();
            clock.lineWidth = 3;
            clock.strokeStyle = "#000";
            clock.translate(250, 250);
            clock.rotate((i * 6) * Math.PI / 180);//角度*Math.PI/180=弧度
            clock.beginPath();
            clock.moveTo(0, -180);
            clock.lineTo(0, -190);
            clock.closePath();
            clock.stroke();
            clock.restore();
        }

        clock.save();
        clock.lineWidth = 7;
        clock.strokeStyle = "black";
        clock.translate(250, 250);
        clock.rotate(hour * 30 * Math.PI / 180);
        clock.beginPath();

        clock.moveTo(0, -140);
        clock.lineTo(0, 10);
        clock.stroke();
        clock.closePath();
        clock.restore();

        clock.save();
        clock.lineWidth = 5;
        clock.strokeStyle = "black";
        clock.translate(250, 250);
        clock.rotate(min * 6 * Math.PI / 180);
        clock.beginPath();

        clock.moveTo(0, -160);
        clock.lineTo(0, 10);
        clock.stroke();
        clock.closePath();
        clock.restore();

        //second
        clock.save();
        clock.lineWidth = 3;
        clock.strokeStyle = "red";
        clock.translate(250, 250);
        clock.rotate(secd * 6 * Math.PI / 180);
        clock.beginPath();

        clock.moveTo(0, -170);
        clock.lineTo(0, 10);
        clock.closePath();
        clock.stroke();

        //Draw intersection
        clock.beginPath();
        clock.arc(0, 0, 5, 0, 360, false);
        clock.closePath();
        clock.fillStyle = "gray";
        clock.fill();
        clock.stroke();


        clock.beginPath();
        clock.arc(0, -150, 5, 0, 360, false);
        clock.closePath();
        clock.fillStyle = "gray";
        clock.fill();
        clock.stroke();
        clock.restore();
    }
    drowClock();
    setInterval(drowClock, 1000);
</script>


</body>
</html>

				
<?php include("./includes/footer_admin.php");?>	
				
