<?php
session_start();
include("../inc/global.php");
include("../inc/local_info.php");
if (isset($HTTP_GET_VARS['debug'])) {
	error_reporting(E_ALL);
}

/*///////////////////////////////////////////////////////////////////////////
//bstapts admin interface 1.0. �2002 Chris Hinkle Legacy-Adaptive Systems //
//////////////////////////////////////////////////////////////////////////*/
?>
<html>
<head>
<style type="text/css">
<!--
body{font-family:Geneva,Arial,Helvetica,sans-serif;font-size:12px;background-color:#FFFFFF;color:black;scrollbar-base-color:#666699;scrollbar-arrow-color:#ddddff;} html{scrollbar-base-color:#666699;scrollbar-arrow-color:#ddddff;} input{font-family:Geneva,Arial,Helvetica,sans-serif;font-size:12px;} form{margin:0px;} a{color:#333399;font-family:Geneva,Arial,Helvetica,sans-serif;font-size:12px;text-decoration:none;} a:hover{color:blue;text-decoration:underline;} a.menuitem{color:#eeeeff;font-family:Verdana,Helvetica,sans-serif;font-size:11px;font-weight:normal;} a.menuitem:hover{color:yellow;} a.helpitem{color:#cccccc;font-family:Verdana,Helvetica,sans-serif;font-size:12px;font-weight:normal;} a.helpitem:hover{color:yellow;} a.widget{color:#222244;font-family:Verdana,Helvetica,sans-serif;font-size:11px;} a.widget:hover{color:blue;background-color:#e9e9e9;} .outline{background-color:black;} .menu{color:white;background-color:#444466;font-family:Verdana,Helvetica,sans-serif;} .header{color:#ccccee;background-color:#444466;font-family:Verdana,Helvetica,sans-serif;font-weight:bold;font-size:17px;} .header:hover{color:white;} .light{color:white;font-family:Geneva,Arial,Helvetica,sans-serif;font-size:12px;} .smallheader{color:#ccccee;background-color:#444466;font-family:Geneva,Arial,Helvetica,sans-serif;font-size:12px;} .smallheader:hover{color:white;} .small{color:#aaaacc;font-family:Geneva,Arial,Helvetica,sans-serif;font-size:11px;} .legend{color:#000000;font-family:Geneva,Arial,Helvetica,sans-serif;font-size:11px;} .control{color:black;background-color:#cccccc;} .item{color:black;background-color:#e9e9e9;} .button{color:white;background-color:#666699;border-bottom:thin solid #222244;border-right:thin solid #222244;border-top:thin solid #9999cc;border-left:thin solid #9999cc;font-size:11px;font-family:Verdana,Helvetica,sans-serif;font-weight:normal;} .selected{background-color:#bbcbff;} .text{color:black;background-color:white;} .item0{background-color:#f3f3f3;} .item1{background-color:#e9e9e9;} .fixed{font-size:13px;font-family:monospace, fixed;} td{font-size:12px;font-family:Geneva,Arial,Helvetica,sans-serif;} th{font-size:12px;font-family:Geneva,Arial,Helvetica,sans-serif;} .list{background-color:#f0f0ff;} .listlt{background-color:#ffffff;} 
-->
</style>
</head>
<body>
<table border="0">
<tr>
<td width="40"> Company </td>
<td> Handle </td>
<td> Passwd </td>
</tr>

<?php


$quStrGetGroups = "SELECT * FROM `GROUP` WHERE GRID<>1 ORDER BY NAME";
$quGetGroups = mysqli_query($dbh,$quStrGetGroups);

while ($rowGetGroups = mysqli_fetch_object($quGetGroups)) {
	$quStrGetUsers = "SELECT * FROM USERS WHERE `GROUP`=$rowGetGroups->GRID ";
	$quGetUsers = mysqli_query($dbh,$quStrGetUsers);
?>
<tr>
<td><?php echo $rowGetGroups->NAME;?></td>
</tr>
<?php	
	while ($rowGetUsers = mysqli_fetch_object ($quGetUsers)) {
?>
<tr>
<td><?php if ($rowGetGroups->ADMIN==$rowGetUsers->UID) { echo "ADMIN"; }?>&nbsp;</td>
<td><?php echo $rowGetUsers->HANDLE;?></td>
<td><?php echo $rowGetUsers->PASS;?></td>
</tr>
<?php }?>
<tr><td height="1" colspan="3"><hr size="1" noshade></td>
<tr>
<?php } ?>
</table>

</body>
</html>