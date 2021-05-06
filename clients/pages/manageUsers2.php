<!--BEGIN manageUsers -->
<?php
if ($pref_coltit=="") {
$coltitcolor="#3DB1FF";
} else {
$coltitcolor="$pref_coltit";
}
?>


	<br>
	<table width="85%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
	<tr>
	<td align="left" colspan="4" valign="top"  height="1" bgcolor="#FFFFFF"><a href="<?php echo "$PHP_SELF?op=createUser";?>"><img border="0" hspace="0" vspace="0" width="84" height="45" src="../assets/images/newAgent.gif"></a></td>
	
	<TD colspan="3" ALIGN="CENTER">
	<TABLE BGCOLOR="#FFFFFF"><TR><TD><IMG SRC="../images/manageagents2.gif"></TD><TD><NOBR><B>MANAGE AGENTS</B></NOBR></TD></TR></TABLE>
	</TD>
	
	<td align="right" colspan="3" width="100" valign="bottom"  height="1" bgcolor="#FFFFFF"><div class="controlText"><a href="<?php echo "$PHP_SELF?op=restrict_ip";?>">Restrict Login</a></div></td>
	</tr>
	<tr>
	<td colspan="15" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	<TD>
	<img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></TD>
	
	</tr>
	<tr>
	<td valign="top" height="16" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="left" bgcolor="<?php echo $coltitcolor;?>"><div class="controltext">Name</div></td>
	<td bgcolor="<?php echo $coltitcolor;?>">&nbsp;&nbsp;</TD>
	<td align="left" bgcolor="<?php echo $coltitcolor;?>"><div class="controltext">Email</div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><div class="controltext">Level</div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><div class="controltext">User Signature</div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><div class="controltext"><FONT SIZE=-3><A HREF="https://www.BostonApartments.com/meettheagents.php?cli=<?php echo $grid;?>" target="_new">Meet Agents Order</A></FONT></div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><img border="0" hspace="0" vspace="0" src="../assets/images/icons/user_edit.gif"></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
<td align="center" bgcolor="<?php echo $coltitcolor;?>"><img border="0" hspace="0" vspace="0" src="../assets/images/icons/user_delete.gif"></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>

<td align="center" bgcolor="<?php echo $coltitcolor;?>"><div class="ad">Last Login</DIV></td>
<TD WIDTH="24" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</TD>
<td valign="top" height="15" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
</tr>
	<tr>
	<td colspan="15" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>	

<?php
if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
}
?>

	<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) { ?>
			
    	<tr>
	<td valign="top" height="3" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $rowColor;?>"><div class="ad">
	<?php echo "<a TITLE=\"Click Here to Log in as ".$rowGetUsers->HANDLE."\" target=\"_loginnew$rowGetUsers->HANDLE\" href=\"http://$rowGetUsers->HANDLE:$rowGetUsers->PASS@www.bostonapartments.com/lacms/\">";?><?php echo "$rowGetUsers->HANDLE";?></A></td>
	<td bgcolor="<?php echo $rowColor;?>">&nbsp;&nbsp;</TD>
	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><A HREF="mailto:<?php echo "$rowGetUsers->EMAIL";?>"><?php echo "$rowGetUsers->EMAIL";?></a></div></td>
	<td bgcolor="<?php echo $rowColor;?>" align=center><div class="ad"><?php echo "$rowGetUsers->USER_LEVEL";?></div></td>
	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><?php echo "$rowGetUsers->USER_SIG";?></div></td>

	<td bgcolor="<?php echo $rowColor;?>" align=center><div class="ad"><?php echo "$rowGetUsers->MEETORDER";?></div></td>

	<td bgcolor="<?php echo $rowColor;?>" VALIGN="TOP"><div class="ad"><a href="<?php echo "$PHP_SELF?op=editUser&uid=$rowGetUsers->UID";?>"><img width="59" height="20" border="0" vspace="0" hspace="0" src="../assets/images/editagent.gif"> </a></div>
</td>
	<td bgcolor="<?php echo $rowColor;?>"><div class="ad">&nbsp;</DIV></TD>
<td VALIGN="TOP" bgcolor="<?php echo $rowColor;?>">

<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none&vid=6";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="user" value="<?php echo $rowGetUsers->UID;?>">
<input STYLE="Background-Color : #6666CC; color: #ffffff; padding: 0px; font-size: 10px; width : 130px" type="submit" value="View <?php echo $rowGetUsers->HANDLE;?>'s listings"></form>
</td>
	<td bgcolor="<?php echo $rowColor;?>"><div class="ad">&nbsp;</DIV></TD>

	<?php if ($rowGetUsers->UID!==$uid) {?>
	<td VALIGN="TOP" bgcolor="<?php echo $rowColor;?>"><div class="ad"><a href="<?php echo "$PHP_SELF?op=termUser&uid=$rowGetUsers->UID";?>"><IMG SRC="../assets/images/terminateagent.gif"  HEIGHT="20" WIDTH="87" vspace="0" hspace="0" BORDER="0"></a></div></td>
	<?php }else {?>
	<td bgcolor="<?php echo $rowColor;?>">&nbsp;</TD>
	<?php }?>

<td bgcolor="<?php echo $rowColor;?>">&nbsp;</TD>
<TD VALIGN="TOP" bgcolor="<?php echo $rowColor;?>"><div class="ad">
	<?php
$everlogged = "";
	$quStrGetLLogin = "SELECT * FROM `SESSIONS` WHERE `UID`=$rowGetUsers->UID ORDER BY `TIMEIN` DESC LIMIT 0,1";
	$quGetLLogin = mysqli_query($dbh, $quStrGetLLogin) or die ($quStrGetLLogin);
	$rowGetLLogin=mysqli_fetch_object($quGetLLogin);

if ($rowGetLLogin->TIMEIN) {

echo  substr ($rowGetLLogin->TIMEIN, 0, 10) ."<BR>";
echo  substr ($rowGetLLogin->TIMEIN, 11, 8);
$everlogged = "yes";
} else {
echo "Never" ;
}
?>
</DIV>
</TD>
<TD VALIGN="TOP" bgcolor="<?php echo $rowColor;?>"><div class="ad">
	<?php

if ($everlogged = "yes") {
echo  "<CENTER><a href=\"$PHP_SELF?op=agentreport&euid=$rowGetUsers->UID\"><IMG SRC=\"../assets/images/agentreport-lg.gif\" TITLE=\"Agent  Report\" ALT=\"Agent Report\" BORDER=\"0\"></A></CENTER>";
} else {
echo "&nbsp;" ;
}
?>
</DIV>
</TD>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>

<?php
if ($rowColor=="#F5F5DC" OR $rowColor=="$pref_row_color") {
    		$rowColor="#FFFFFF";
    }else {
 		if ($pref_row_color=="") {
    		$rowColor="#F5F5DC";
		}else {
    		$rowColor="$pref_row_color";
    		}
}
} ?>


	<tr>
	<td colspan="15" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	<br>

<!--END manageUsers -->