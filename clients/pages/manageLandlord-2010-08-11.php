<!--BEGIN manageLandlord -->
<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}

if ($pref_coltit=="") {
$coltitcolor="#3DB1FF";
} else {
$coltitcolor="$pref_coltit";
}

$quStrLimitCount = "SELECT count(LID) AS COUNTOF FROM LANDLORD WHERE GRID=$grid";
$quLimitCount = mysqli_query($dbh, $quStrLimitCount) or die (dieNice("Sorry,  could not pagenate your ads", "E-200"));
$rowLimitCount = mysqli_fetch_object($quLimitCount);
$numLL = ceil($rowLimitCount->COUNTOF / $LLlimitN);
?>	

	<TABLE><TR><TD><img border="0" width="48" height="48" src="../assets/images/icons/Address-Book-icon.png"></TD><TD><FONT SIZE="+1"><B>MANAGE LANDLORDS</B></FONT></TD></TR></TABLE>


	<table border="1" BORDERCOLOR="#000000" cellspacing="0" cellpadding="0" WIDTH="900" BGCOLOR="#FFFFFF"><TR><TD><CENTER>

	<div style="border:1px solid black;width:900px;height:107px;background-color:<?php echo $pagebgcolor;?>;padding:5px;">

	<table border="0" cellspacing="0" cellpadding="3" WIDTH="100%">
	<form action="<?php echo "$PHP_SELF";?>" method="GET">
	<input type="hidden" name="op" value="manageLandlord">
	<input type="hidden" name="landlords_filter" value="1">
	<tr>
	<td style="font-size:16px;">

<TABLE CELLPADDING="0" CELLSPACING="0" WIDTH="100%"><TR><TD ROWSPAN=2>
<NOBR>

<IMG SRC="../images/search.gif" border="0"> Find Landlords: &nbsp; &nbsp;
</NOBR>
</TD><TD>
<CENTER>
<input type="submit" value="Search Landlords" STYLE="Background-Color : #E0FFFF; " ></CENTER></TD></TR><TR><TD>
<CENTER>



<a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_filter=1";?>"><FONT COLOR="#FF0000" SIZE="-1">Clear Search</FONT></a></CENTER>
</TD></TR></TABLE>


</TD><td style="font-size:10px;" align="RIGHT">
<NOBR>
Office Name: <input type="text" name="landlords_filter_off_name" value="<?php echo $landlords_filter_off_name;?>" STYLE="Background-Color : #FFFFFF">


</TD><td style="font-size:10px;" align="RIGHT">
<NOBR>


Phone: <input type="text"  SIZE="20" name="landlords_filter_phone" value="<?php echo $landlords_filter_phone;?>" STYLE="Background-Color : #FFFFFF">

</TD></TR><TR><td style="font-size:10px;" align="RIGHT">

<NOBR>


Short Name: <input type="text" name="landlords_filter_short_name" value="<?php echo $landlords_filter_short_name;?>" STYLE="Background-Color : #FFFFFF">
</td>
<td align="right" style="font-size:10px;">First Name: <input type="text" name="landlords_filter_home_name_first" value="<?php echo $landlords_filter_home_name_first;?>" STYLE="Background-Color : #FFFFFF"></td>
	<td align="right" style="font-size:10px;"><NOBR>Last Name: <input type="text" name="landlords_filter_home_name_last" value="<?php echo $landlords_filter_name_home_last;?>" STYLE="Background-Color : #FFFFFF"></NOBR></td>
	</tr>

<TR><td style="font-size:10px;" align="RIGHT"> <FONT SIZE="-3"></FONT></TD></TR>


	<tr>
	<td align="right" style="font-size:10px;"><NOBR>Last Contacted: <select name="landlords_filter_lc_month" STYLE="Background-Color : #FFFFFF">
	<option value="0">--</option>
	<option value="1" <?php if ($landlords_filter_lc_month==1) { echo "selected";}?>>Jan</option>
	<option value="2" <?php if ($landlords_filter_lc_month==2) { echo "selected";}?>>Feb</option>
	<option value="3" <?php if ($landlords_filter_lc_month==3) { echo "selected";}?>>Mar</option>
	<option value="4" <?php if ($landlords_filter_lc_month==4) { echo "selected";}?>>April</option>
	<option value="5" <?php if ($landlords_filter_lc_month==5) { echo "selected";}?>>May</option>
	<option value="6" <?php if ($landlords_filter_lc_month==6) { echo "selected";}?>>Jun</option>
	<option value="7" <?php if ($landlords_filter_lc_month==7) { echo "selected";}?>>Jul</option>
	<option value="8" <?php if ($landlords_filter_lc_month==8) { echo "selected";}?>>Aug</option>
	<option value="9" <?php if ($landlords_filter_lc_month==9) { echo "selected";}?>>Sep</option>
	<option value="10" <?php if ($landlords_filter_lc_month==10) { echo "selected";}?>>Oct</option>
	<option value="11" <?php if ($landlords_filter_lc_month==11) { echo "selected";}?>>Nov</option>
	<option value="12" <?php if ($landlords_filter_lc_month==12) { echo "selected";}?>>Dec</option>
	</select>&nbsp;
	<select name="landlords_filter_lc_day" STYLE="Background-Color : #FFFFFF">
	<option value="0">--</option>
	<option value="1" <?php if ($landlords_filter_lc_day==1) { echo "selected";}?>>1</option>
	<option value="2" <?php if ($landlords_filter_lc_day==2) { echo "selected";}?>>2</option>
	<option value="3" <?php if ($landlords_filter_lc_day==3) { echo "selected";}?>>3</option>
	<option value="4" <?php if ($landlords_filter_lc_day==4) { echo "selected";}?>>4</option>
	<option value="5" <?php if ($landlords_filter_lc_day==5) { echo "selected";}?>>5</option>
	<option value="6" <?php if ($landlords_filter_lc_day==6) { echo "selected";}?>>6</option>
	<option value="7" <?php if ($landlords_filter_lc_day==7) { echo "selected";}?>>7</option>
	<option value="8" <?php if ($landlords_filter_lc_day==8) { echo "selected";}?>>8</option>
	<option value="9" <?php if ($landlords_filter_lc_day==9) { echo "selected";}?>>9</option>
	<option value="10" <?php if ($landlords_filter_lc_day==10) { echo "selected";}?>>10</option>
	<option value="11" <?php if ($landlords_filter_lc_day==11) { echo "selected";}?>>11</option>
	<option value="12" <?php if ($landlords_filter_lc_day==12) { echo "selected";}?>>12</option>
	<option value="13" <?php if ($landlords_filter_lc_day==13) { echo "selected";}?>>13</option>
	<option value="14" <?php if ($landlords_filter_lc_day==14) { echo "selected";}?>>14</option>
	<option value="15" <?php if ($landlords_filter_lc_day==15) { echo "selected";}?>>15</option>
	<option value="16" <?php if ($landlords_filter_lc_day==16) { echo "selected";}?>>16</option>
	<option value="17" <?php if ($landlords_filter_lc_day==17) { echo "selected";}?>>17</option>
	<option value="18" <?php if ($landlords_filter_lc_day==18) { echo "selected";}?>>18</option>
	<option value="19" <?php if ($landlords_filter_lc_day==19) { echo "selected";}?>>19</option>
	<option value="20" <?php if ($landlords_filter_lc_day==20) { echo "selected";}?>>20</option>
	<option value="21" <?php if ($landlords_filter_lc_day==21) { echo "selected";}?>>21</option>
	<option value="22" <?php if ($landlords_filter_lc_day==22) { echo "selected";}?>>22</option>
	<option value="23" <?php if ($landlords_filter_lc_day==23) { echo "selected";}?>>23</option>
	<option value="24" <?php if ($landlords_filter_lc_day==24) { echo "selected";}?>>24</option>
	<option value="25" <?php if ($landlords_filter_lc_day==25) { echo "selected";}?>>25</option>
	<option value="26" <?php if ($landlords_filter_lc_day==26) { echo "selected";}?>>26</option>
	<option value="27" <?php if ($landlords_filter_lc_day==27) { echo "selected";}?>>27</option>
	<option value="28" <?php if ($landlords_filter_lc_day==28) { echo "selected";}?>>28</option>
	<option value="29" <?php if ($landlords_filter_lc_day==29) { echo "selected";}?>>29</option>
	<option value="30" <?php if ($landlords_filter_lc_day==30) { echo "selected";}?>>30</option>
	<option value="31" <?php if ($landlords_filter_lc_day==31) { echo "selected";}?>>31</option>
	</select>&nbsp;
	<select name="landlords_filter_lc_year" STYLE="Background-Color : #FFFFFF">
	<option value="0">--</option>
	<?php 
	$start_year = date ("Y") - 4;
	$year = date ("Y");
	for ($i=$start_year;$i<=$year;$i++) { ?>
		<option value="<?php echo $i;?>" <?php if ($landlords_filter_lc_year==$i) { echo "selected";}?>><?php echo $i;?></option>
	<?php } ?>
	</select>

</NOBR>
</TD><td style="font-size:10px;" align="RIGHT">
<NOBR>

Next Contact Date: <select name="landlords_filter_nc_month" STYLE="Background-Color : #FFFFFF">
	<option value="0">--</option>
	<option value="1" <?php if ($landlords_filter_nc_month==1) { echo "selected";}?>>Jan</option>
	<option value="2" <?php if ($landlords_filter_nc_month==2) { echo "selected";}?>>Feb</option>
	<option value="3" <?php if ($landlords_filter_nc_month==3) { echo "selected";}?>>Mar</option>
	<option value="4" <?php if ($landlords_filter_nc_month==4) { echo "selected";}?>>April</option>
	<option value="5" <?php if ($landlords_filter_nc_month==5) { echo "selected";}?>>May</option>
	<option value="6" <?php if ($landlords_filter_nc_month==6) { echo "selected";}?>>Jun</option>
	<option value="7" <?php if ($landlords_filter_nc_month==7) { echo "selected";}?>>Jul</option>
	<option value="8" <?php if ($landlords_filter_nc_month==8) { echo "selected";}?>>Aug</option>
	<option value="9" <?php if ($landlords_filter_nc_month==9) { echo "selected";}?>>Sep</option>
	<option value="10" <?php if ($landlords_filter_nc_month==10) { echo "selected";}?>>Oct</option>
	<option value="11" <?php if ($landlords_filter_nc_month==11) { echo "selected";}?>>Nov</option>
	<option value="12" <?php if ($landlords_filter_nc_month==12) { echo "selected";}?>>Dec</option>
	</select>&nbsp;
	<select name="landlords_filter_nc_day" STYLE="Background-Color : #FFFFFF">
	<option value="0">--</option>
	<option value="1" <?php if ($landlords_filter_nc_day==1) { echo "selected";}?>>1</option>
	<option value="2" <?php if ($landlords_filter_nc_day==2) { echo "selected";}?>>2</option>
	<option value="3" <?php if ($landlords_filter_nc_day==3) { echo "selected";}?>>3</option>
	<option value="4" <?php if ($landlords_filter_nc_day==4) { echo "selected";}?>>4</option>
	<option value="5" <?php if ($landlords_filter_nc_day==5) { echo "selected";}?>>5</option>
	<option value="6" <?php if ($landlords_filter_nc_day==6) { echo "selected";}?>>6</option>
	<option value="7" <?php if ($landlords_filter_nc_day==7) { echo "selected";}?>>7</option>
	<option value="8" <?php if ($landlords_filter_nc_day==8) { echo "selected";}?>>8</option>
	<option value="9" <?php if ($landlords_filter_nc_day==9) { echo "selected";}?>>9</option>
	<option value="10" <?php if ($landlords_filter_nc_day==10) { echo "selected";}?>>10</option>
	<option value="11" <?php if ($landlords_filter_nc_day==11) { echo "selected";}?>>11</option>
	<option value="12" <?php if ($landlords_filter_nc_day==12) { echo "selected";}?>>12</option>
	<option value="13" <?php if ($landlords_filter_nc_day==13) { echo "selected";}?>>13</option>
	<option value="14" <?php if ($landlords_filter_nc_day==14) { echo "selected";}?>>14</option>
	<option value="15" <?php if ($landlords_filter_nc_day==15) { echo "selected";}?>>15</option>
	<option value="16" <?php if ($landlords_filter_nc_day==16) { echo "selected";}?>>16</option>
	<option value="17" <?php if ($landlords_filter_nc_day==17) { echo "selected";}?>>17</option>
	<option value="18" <?php if ($landlords_filter_nc_day==18) { echo "selected";}?>>18</option>
	<option value="19" <?php if ($landlords_filter_nc_day==19) { echo "selected";}?>>19</option>
	<option value="20" <?php if ($landlords_filter_nc_day==20) { echo "selected";}?>>20</option>
	<option value="21" <?php if ($landlords_filter_nc_day==21) { echo "selected";}?>>21</option>
	<option value="22" <?php if ($landlords_filter_nc_day==22) { echo "selected";}?>>22</option>
	<option value="23" <?php if ($landlords_filter_nc_day==23) { echo "selected";}?>>23</option>
	<option value="24" <?php if ($landlords_filter_nc_day==24) { echo "selected";}?>>24</option>
	<option value="25" <?php if ($landlords_filter_nc_day==25) { echo "selected";}?>>25</option>
	<option value="26" <?php if ($landlords_filter_nc_day==26) { echo "selected";}?>>26</option>
	<option value="27" <?php if ($landlords_filter_nc_day==27) { echo "selected";}?>>27</option>
	<option value="28" <?php if ($landlords_filter_nc_day==28) { echo "selected";}?>>28</option>
	<option value="29" <?php if ($landlords_filter_nc_day==29) { echo "selected";}?>>29</option>
	<option value="30" <?php if ($landlords_filter_nc_day==30) { echo "selected";}?>>30</option>
	<option value="31" <?php if ($landlords_filter_nc_day==31) { echo "selected";}?>>31</option>
	</select>&nbsp;
	<select name="landlords_filter_nc_year" STYLE="Background-Color : #FFFFFF">
	<option value="0">--</option>
	<?php 
	$start_year = date ("Y") - 4;
	$year = date ("Y");
	for ($i=$start_year;$i<=$year;$i++) { ?>
		<option value="<?php echo $i;?>" <?php if ($landlords_filter_nc_year==$i) { echo "selected";}?>><?php echo $i;?></option>
	<?php } ?>
	</select>


</NOBR>
</TD><td style="font-size:10px;" align="RIGHT">
<NOBR>
Email: <input type="text"  SIZE="20" name="landlords_filter_email" value="<?php echo $landlords_filter_email;?>" STYLE="Background-Color : #FFFFFF">

</NOBR>

</td>
	</tr>
	
	</form>
	</table>
	</div>
<img border="0" hspace="0" vspace="0" width="900" height="1" src="../assets/images/spacer.gif">

	<table border="0" cellspacing="0" cellpadding="0" WIDTH="880">
	<tr>
	<td align="left" colspan="25" valign="bottom"  height="1" bgcolor="#FFFFFF">

<a href="<?php echo "$PHP_SELF?op=createLandlord";?>"><img border="0" hspace="0" vspace="0" width="89" height="22" src="../assets/images/newLandlord.jpg"></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <FONT SIZE="-2"><B><a href="<?php echo "$PHP_SELF?op=mail_all_landlords&e=1";?>"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22 TITLE="Email ALL Landlords at their personal email address"> Email ALL Landlords (personal)</A> &nbsp;&nbsp;&nbsp;  <a href="<?php echo "$PHP_SELF?op=mail_all_landlords&e=2";?>"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22 TITLE="Email ALL Landlords at their office email address"> Email ALL Landlords (office)</A> &nbsp;&nbsp;&nbsp; <a href="<?php echo "$PHP_SELF?op=mail_all_landlords&e=3";?>"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22 TITLE="Email ALL Landlords at their personal and office email addresses"> Email ALL Landlords (both)</A></B></FONT>

</td>
	</tr>
	<tr>


<TD bgcolor="#FFFFFF" WIDTH="3">&nbsp;</TD>


	<td align="left" colspan="24" valign="bottom" bgcolor="#FFFFFF" style="font-size:10px;">
	<?php
	if (!$_GET['show_all_landlords']) {
		$display_bunch = $landlords_limit_start + $landlords_limit_n;
		if ($display_bunch > $landlords_count) {
			$display_bunch = $landlords_count;
		}
		$display_start = $landlords_limit_start;
		if ($display_start == 0) {
			$display_start = 1;
		}
		?>
		<p>
		<b><?php echo $display_start;?> - <?php echo $display_bunch;?></b> of <b><?php echo $landlords_count;?></b>
		<?php if ($landlords_count > $landlords_limit_n) {?>
		&nbsp;&nbsp;&nbsp;go to page 
		<?php $pageTop = ceil($landlords_count / $landlords_limit_n);
		for ($i=1;$i <= $pageTop;$i++) {
			if ($landlords_page == $i) {
				echo "$i |";
			}else {?>
				<a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_page=$i";?>"><?php echo $i;?></a> |
			<?php } ?>
		<?php } ?>
		&nbsp;&nbsp;&nbsp;<?php if (($landlords_page) < ($landlords_count / $landlords_limit_n)) {
			$nextPage = $landlords_page + 1;
			?>
		<NOBR>	<a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_page=$nextPage";?>">Next</a> 

		<?php } ?> &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo "$PHP_SELF?op=manageLandlord&show_all_landlords=1";?>">Show all landlords</a></NOBR>
		<?php }
	}?></td>

		</tr>
		</TABLE>
		
		
		
		<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0">
	<tr>
	<td colspan="25" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="15" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>

	<td align="left" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_sort=SHORT_NAME";?>"><div class="controltext" <?php if ($landlords_sort=="SHORT_NAME") { echo "style=\"text-decoration:underline;\"";}?>><NOBR><FONT SIZE="-1">Short Name</FONT></NOBR></div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="left" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_sort=OFF_NAME";?>"><div class="controltext" <?php if ($landlords_sort=="OFF_NAME") { echo "style=\"text-decoration:underline;\"";}?>><NOBR><FONT SIZE="-1">Office Name</FONT></NOBR></div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>

	<td align="left" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_sort=HOME_NAME_LAST";?>"><div class="controltext" <?php if ($landlords_sort=="HOME_NAME_LAST") { echo "style=\"text-decoration:underline;\"";}?>><NOBR><FONT SIZE="-1">Last Name</FONT></NOBR></div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>


	<td align="left" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_sort=OFF_PHONE";?>"><div class="controltext" <?php if ($landlords_sort=="OFF_PHONE") { echo "style=\"text-decoration:underline;\"";}?>><NOBR><FONT SIZE="-1">Work Phone</FONT></NOBR></div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="left" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_sort=HOME_PHONE";?>"><div class="controltext" <?php if ($landlords_sort=="HOME_PHONE") { echo "style=\"text-decoration:underline;\"";}?>><NOBR><FONT SIZE="-1">Home Phone</FONT></NOBR></div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="left" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_sort=MOBILE_PHONE";?>"><div class="controltext" <?php if ($landlords_sort=="MOBILE_PHONE") { echo "style=\"text-decoration:underline;\"";}?>><NOBR><FONT SIZE="-1">Cell Phone</FONT></NOBR></div></td>
	<td align="left" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="left" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_sort=LAST_CONTACTED";?>"><div class="controltext" <?php if ($landlords_sort=="LAST_CONTACTED") { echo "style=\"text-decoration:underline;\"";}?>><NOBR><FONT SIZE="-1">Last Contact</FONT></NOBR></div></td>
	<td align="left" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="left" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_sort=NEXT_CONTACT";?>"><div class="controltext" <?php if ($landlords_sort=="NEXT_CONTACT") { echo "style=\"text-decoration:underline;\"";}?>><NOBR><FONT SIZE="-1">Next Contact</FONT></NOBR></div></td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td valign="top" height="15" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="25" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>	
	
<?php
if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} ?>

   <?php while ($rowGetLandlord = mysqli_fetch_object($quPageLandlord)) { ?>
       		
    	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>



	<td bgcolor="<?php echo $rowColor;?>"><div class="ad">&nbsp;<a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowGetLandlord->LID";?>" TITLE="Edit/View <?php echo "$rowGetLandlord->SHORT_NAME";?>'s Info"><?php echo "$rowGetLandlord->SHORT_NAME";?></A></td>
	<td align="center" bgcolor="<?php echo $rowColor;?>">&nbsp;</td>
	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><?php echo "$rowGetLandlord->OFF_NAME";?></div></td>

	<td align="center" bgcolor="<?php echo $rowColor;?>">&nbsp;</td>
	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><?php echo "$rowGetLandlord->HOME_NAME_LAST";?></div></td>

	<td align="center" bgcolor="<?php echo $rowColor;?>">&nbsp;</td>
	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><NOBR><?php echo "$rowGetLandlord->OFF_PHONE";?></NOBR></div></td>
	<td align="center" bgcolor="<?php echo $rowColor;?>">&nbsp;</td>
	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><NOBR><?php echo "$rowGetLandlord->HOME_PHONE";?></NOBR></div></td>

	<td align="center" bgcolor="<?php echo $rowColor;?>">&nbsp;</td>

	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><NOBR><?php echo "$rowGetLandlord->MOBILE_PHONE";?></NOBR></div></td>

	<td align="center" bgcolor="<?php echo $rowColor;?>">&nbsp;</td>

	<td bgcolor="<?php echo $rowColor;?>" align="center"><div class="ad"><NOBR><?php echo "$rowGetLandlord->LAST_CONTACTED";?></NOBR></div></td>

	<td align="center" bgcolor="<?php echo $rowColor;?>">&nbsp;</td>

	<td bgcolor="<?php echo $rowColor;?>" align="center"><div class="ad"><NOBR><?php echo "$rowGetLandlord->NEXT_CONTACT";?></NOBR></div></td>
	<td bgcolor="<?php echo $rowColor;?>"><div class="ad">

<?php
	echo "<A HREF=$PHP_SELF?op=buildings&lid=$rowGetLandlord->LID&llname=$rowGetLandlord->SHORT_NAME><IMG src=../assets/images/buildings.jpg BORDER=0 TITLE=\"$rowGetLandlord->SHORT_NAME's Buildings - Edit Units Globally/Individually\"></A>";
 ?>

</DIV>
</TD>

	<td bgcolor="<?php echo $rowColor;?>"><div class="ad">

<?php
	echo "<A HREF=$PHP_SELF?op=global-Landlord&lid=$rowGetLandlord->LID&llname=$rowGetLandlord->SHORT_NAME><IMG src=../assets/images/global.jpeg BORDER=0 TITLE=\"Edit ALL $rowGetLandlord->SHORT_NAME's Units Globally\"></A>";
 ?>

</DIV>
</TD>




	<td bgcolor="<?php echo $rowColor;?>" align="right"><div class="ad">

<?php
if ( $rowGetLandlord->LL_EMAIL != "" ) {
	echo "<NOBR>H:<A HREF=$PHP_SELF?op=mail_landlord&lid=$rowGetLandlord->LID&e=1><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22 TITLE=\"Email $rowGetLandlord->SHORT_NAME at Personal Email\"></A></NOBR>";
} else {
	echo " &nbsp; ";
}
; ?>


<?php
if ( $rowGetLandlord->OFF_EMAIL != "" ) {
	echo "<NOBR>O:<A HREF=$PHP_SELF?op=mail_landlord&lid=$rowGetLandlord->LID&e=2><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22 TITLE=\"Email $rowGetLandlord->SHORT_NAME at Office\"></A></NOBR>";
} else {
	echo " &nbsp; ";
}
; ?>

</DIV>
</TD>
<td bgcolor="<?php echo $rowColor;?>"><div class="ad">

<?php
if ( $rowGetLandlord->OFF_WEBSITE != "" ) {
	echo "<A HREF=$rowGetLandlord->OFF_WEBSITE target=\"_NEW\"><FONT SIZE=-3 COLOR=blue>Website</FONT></A>";
} else {
	echo " &nbsp; ";
}
; ?>

<?php
if ( $rowGetLandlord->OFF_WEBLISTINGS != "" ) {
	echo "<BR><NOBR><A HREF=$rowGetLandlord->OFF_WEBLISTINGS target=_NEW><FONT SIZE=-3 COLOR=blue>Web List</FONT></A></NOBR>";
} else {
	echo " &nbsp; ";
}
; ?>

</div></td>
	<td bgcolor="<?php echo $rowColor;?>" VALIGN="TOP">
<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none&activeFilter=n&vid=7&sortD=ASC&sort=STREET,%20STREET_NUM,%20APT";?>" method="POST" target="_NEW">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="landlord" value="<?php echo $rowGetLandlord->LID;?>">
<input type="image" src="../assets/images/listings.gif" name="listings" border='0' vspace='0' hspace='0' TITLE="View ALL <?php echo "$rowGetLandlord->SHORT_NAME";?> Listings">
	</form>

</DIV>
</td>

	<td bgcolor="<?php echo $rowColor;?>" VALIGN="TOP"><div class="ad">
<a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowGetLandlord->LID";?>"><img border="0" vspace="0" hspace="0" src="../images/icons/edit.gif" TITLE="Edit/View <?php echo "$rowGetLandlord->SHORT_NAME";?>'s Info" ALT="Edit/View <?php echo "$rowGetLandlord->SHORT_NAME";?>'s Info"></a>
</DIV>
</td>


	<td bgcolor="<?php echo $rowColor;?>" VALIGN="TOP"><div class="ad">

<A HREF="<?php echo "$PHP_SELF?op=adlEdit&LLID=$rowGetLandlord->LID";?>"><img border="0" vspace="0" hspace="0" SRC="../images/edit-new-listing-ll.gif" ALT="Create a new listing for <?php echo "$rowGetLandlord->SHORT_NAME";?>" TITLE="Create A New Listing For <?php echo "$rowGetLandlord->SHORT_NAME";?>" ALT="Create A New Listing For This Landlord"></a>

</DIV>
</td>




	<td bgcolor="<?php echo $rowColor;?>" VALIGN="TOP"><div class="ad"><a href="<?php echo "$PHP_SELF?op=deleteLandlord&lid=$rowGetLandlord->LID";?>"><img border='0' vspace='0' hspace='0' src='../images/icons/delete.gif' TITLE="Delete <?php echo $rowGetLandlord->SHORT_NAME;?>"></a>
</DIV></TD>



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
	<td colspan="25" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
<TR>

	<td> </td>

<TD colspan=14>


<TABLE WIDTH="100%"><TR>
<td align="left" colspan="17" valign="bottom" bgcolor="#FFFFFF" style="font-size:10px;">
	<?php
	if (!$_GET['show_all_landlords']) {
		$display_bunch = $landlords_limit_start + $landlords_limit_n;
		if ($display_bunch > $landlords_count) {
			$display_bunch = $landlords_count;
		}
		$display_start = $landlords_limit_start;
		if ($display_start == 0) {
			$display_start = 1;
		}
		?>
		<p>
		<b><?php echo $display_start;?> - <?php echo $display_bunch;?></b> of <b><?php echo $landlords_count;?></b>
		<?php if ($landlords_count > $landlords_limit_n) {?>
		&nbsp;&nbsp;&nbsp;go to page 
		<?php $pageTop = ceil($landlords_count / $landlords_limit_n);
		for ($i=1;$i <= $pageTop;$i++) {
			if ($landlords_page == $i) {
				echo "$i |";
			}else {?>
				<a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_page=$i";?>"><?php echo $i;?></a> |
			<?php } ?>
		<?php } ?>

		&nbsp;&nbsp;&nbsp;<?php if (($landlords_page) < ($landlords_count / $landlords_limit_n)) {
			$nextPage = $landlords_page + 1;
			?>
		<NOBR>	<a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_page=$nextPage";?>">Next</a>
		<?php } ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo "$PHP_SELF?op=manageLandlord&show_all_landlords=1";?>">Show all landlords</a></NOBR>
		<?php }
	}?></td>
		</tr></TABLE>

<TD> &nbsp; 

</TD></TR></TABLE>

</CENTER>
</TD></TR></TABLE>
<P><BR>	
   
   
<!--END manageLandlord -->