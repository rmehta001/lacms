<!--BEGIN manageUsers -->

<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
  
  $rowColor = isset($_SESSION["pref_row_color"]) ? $_SESSION["pref_row_color"] : "#e2effa";
  
    
if (!isset($pref_coltit)){
$coltitcolor="#3DB1FF";
} else {
$coltitcolor="$pref_coltit";
}
?>


	<br>
	<table width="90%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="border:1px solid #ddd;">
	<tr>
	<td align="left" colspan="5"  height="60" bgcolor="#FFFFFF">
	<TABLE BGCOLOR="#FFFFFF"><TR>
	<TD><a href="<?php echo "$PHP_SELF?op=createUser";?>"><IMG SRC="../images/addUser.png" style="width:60px;height:60px;"></a></TD>
	<TD><a href="<?php echo "$PHP_SELF?op=createUser";?>"><NOBR><B style="color:#1296db;font-size:25px;">ADD AGENTS</B></NOBR></a></TD>
	</TR></TABLE>
	</td>
	<TD colspan="2" ALIGN="CENTER">
	<TABLE BGCOLOR="#FFFFFF"><TR><TD><IMG SRC="../images/agencyManagement.png" style="width:60px;height:60px;"></TD><TD><NOBR><B style="color:#1296db;font-size:25px;">MANAGE AGENTS</B></NOBR></TD></TR></TABLE>
	</TD>
	
	<td align="right" colspan="7" width="100" valign="top"  height="1" bgcolor="#FFFFFF"><!-- <div class="controlText"><a href="<?php echo "$PHP_SELF?op=restrict_ip";?>">Restrict Logins to a fixed IP</a> --></div></td>
	</tr>
	</table>
<style type="text/css">
.my td{height:50px;font-size:16px;}
TD .controltext{color:#fff;font-size:17px;font-weight:bold;}
.ad{font-size:13px;}
</style>
	<table class="my" width="90%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="border:1px solid #ddd;">
	<tr>
	<td align="left" bgcolor="<?php echo $coltitcolor;?>" style="padding-left:10px;"><div class="controltext">Name</div></td>
	<td bgcolor="<?php echo $coltitcolor;?>">&nbsp;&nbsp;</TD>
	<td align="left" bgcolor="<?php echo $coltitcolor;?>"><div class="controltext">Email / Cell</div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><div class="controltext">Level</div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><div class="controltext">User Signature</div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><div class="controltext"><FONT SIZE=-3><A HREF="https://www.BostonApartments.com/meettheagents.php?cli=<?php echo $grid;?>" target="_new" class="controltext">Meet Agents Order</A></FONT></div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><img border="0" hspace="0" vspace="0" src="../images/modify.png" style="width:31px;height:31px;"></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><img border="0" hspace="0" vspace="0" src="../images/list.png" style="width:31px;height:31px;"></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><img border="0" hspace="0" vspace="0" src="../images/delete.png" style="width:31px;height:31px;"></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>

	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><div class="controltext">Last Login</DIV></td>
	<TD WIDTH="24" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</TD>
	</tr>
	<tr>
	</tr>	

<?php
if (isset($pref_row_color)){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#e2effa";
}
?>

	<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) { ?>
			
    	<tr>
	<td bgcolor="<?php echo $rowColor;?>" style="padding-left:10px;"><div class="ad">
	<?php echo "<a TITLE=\"Click Here to Log in as ".$rowGetUsers->HANDLE."\" target=\"_loginnew$rowGetUsers->HANDLE\" href=\"http://$rowGetUsers->HANDLE:$rowGetUsers->PASS@www.bostonapartments.com/lacms/\">";?><?php echo "$rowGetUsers->HANDLE";?></A></td>
	<td bgcolor="<?php echo $rowColor;?>">&nbsp;&nbsp;</TD>
	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><A HREF="mailto:<?php echo "$rowGetUsers->EMAIL";?>" TITLE="Click here to Email <?php echo $rowGetUsers->HANDLE;?>"><?php echo "$rowGetUsers->EMAIL";?></a><FONT SIZE="-3"><BR></FONT><?php echo $rowGetUsers->CELLPHONE;?>
	
	
	</div></td>
	<td bgcolor="<?php echo $rowColor;?>" align=center><div class="ad"><?php echo "$rowGetUsers->USER_LEVEL";?></div></td>
	<td bgcolor="<?php echo $rowColor;?>" align=center><div class="ad"><?php echo "$rowGetUsers->USER_SIG";?></div></td>

	<td bgcolor="<?php echo $rowColor;?>" align=center><div class="ad"><?php echo "$rowGetUsers->MEETORDER";?></div></td>

	<td bgcolor="<?php echo $rowColor;?>" align=center><div class="ad" STYLE="Background-Color :#1296db; color: #ffffff; padding: 0px; font-size: 12px; width : 80px;height:25px;line-height:25px;border-radius:10px;"><a href="<?php echo "$PHP_SELF?op=editUser&uid=$rowGetUsers->UID";?>" style="color:#fff;">Edit Agent</a></div></td>
	<td bgcolor="<?php echo $rowColor;?>" align=center><div class="ad">&nbsp;</DIV></TD>
	<td bgcolor="<?php echo $rowColor;?>" align=center>

	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none&vid=6";?>" method="POST" style="margin: 0;">
		<input type="hidden" name="filterChange" value="1">
		<input type="hidden" name="user" value="<?php echo $rowGetUsers->UID;?>">
		<input STYLE="Background-Color : #6666CC; color: #ffffff; padding: 0px; font-size: 12px; width : 150px;height:25px;line-height:25px;border:0;border-radius:10px;" type="submit" value="View <?php echo $rowGetUsers->HANDLE;?>'s listings"></form>
	</td>
	<td bgcolor="<?php echo $rowColor;?>" align=center><div class="ad">&nbsp;</DIV></TD>

	<?php if ($rowGetUsers->UID!=$uid) {?>
	<td bgcolor="<?php echo $rowColor;?>" align=center><div class="ad" STYLE="Background-Color :red; color: #ffffff; padding: 0px; font-size: 12px; width : 110px;height:25px;line-height:25px;border-radius:10px;"><a href="<?php echo "$PHP_SELF?op=termUser&uid=$rowGetUsers->UID";?>" style="color:#fff;">Terminate Agent</a></div></td>
	<?php }else {?>
	<td bgcolor="<?php echo $rowColor;?>">&nbsp;</TD>
	<?php }?>

<td bgcolor="<?php echo $rowColor;?>">&nbsp;</TD>
<TD bgcolor="<?php echo $rowColor;?>" align=center><div class="ad"><NOBR>
	<?php
$everlogged = "";
	$quStrGetLLogin = "SELECT * FROM `SESSIONS` WHERE `UID`=$rowGetUsers->UID ORDER BY `TIMEIN` DESC LIMIT 0,1";
	$quGetLLogin = mysqli_query($dbh, $quStrGetLLogin) or die ($quStrGetLLogin);
	$rowGetLLogin = mysqli_fetch_object($quGetLLogin);
        

 
 if (isset($rowGetLLogin))
if ($rowGetLLogin->TIMEIN) {

echo  substr ($rowGetLLogin->TIMEIN, 0, 10) ."<BR>";
echo  substr ($rowGetLLogin->TIMEIN, 11, 8);
$everlogged = "yes";
} else {
echo "Never" ;
}
?></NOBR>
</DIV>
</TD>
<TD VALIGN="TOP" bgcolor="<?php echo $rowColor;?>"><div class="ad">
	<?php

if ($everlogged = "yes") {
echo  "<CENTER><a href=\"$PHP_SELF?op=agentreport&euid=$rowGetUsers->UID\"><IMG SRC=\"../images/report.png\" TITLE=\"Agent Report for ".$rowGetUsers->HANDLE."\" ALT=\"Agent Report\" BORDER=\"0\" style=\"width:30px;height:30px;margin-top:10px;\"></A></CENTER>";
} else {
echo "&nbsp;" ;
}
?>
</DIV>
</TD>
		</tr>

<?php

if ($rowColor=="#e2effa" OR $rowColor==$_SESSION['pref_row_color']) {
    		$rowColor="#FFFFFF";
    }else {
 		if ($_SESSION['pref_row_color']=="") {
    		$rowColor="#e2effa";
		}else {
    		$rowColor="#e2effa";
    		}
}
} ?>

	</table>
	<br>

<!--END manageUsers -->