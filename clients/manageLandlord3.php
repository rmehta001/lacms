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


$numLL = ceil($landlords_count / $LLlimitN);



//$quStrLimitCount = "SELECT count(LID) AS COUNTOF FROM LANDLORD WHERE GRID=$grid";
//$quLimitCount = mysqli_query($dbh, $quStrLimitCount) or die (dieNice("Sorry,  could not pagenate your Landlords", "ML-200"));
//$rowLimitCount = mysqli_fetch_object($quLimitCount);
//$numLL = ceil($rowLimitCount->COUNTOF / $LLlimitN);
?>	

  

<h2 class="textd textd-inverse">
	<img border="0" width="40" height="40" src="../assets/images/icons/Address-Book-icon.png">&nbsp;Manage Landlords</h2>


	<form action="<?php echo "$PHP_SELF";?>" method="GET">
	<input type="hidden" name="op" value="manageLandlord">
	<input type="hidden" name="landlords_filter" value="1">

	         
<div class="col-sm-12">
     <div class="col-sm-2">
<h4 class="textd textd-inverse"><i class="fa fa-search" style="font-size:20px;color:#2297c7;"></i> Find Landlords:</h4>
</div>
     <div class="col-sm-2">

<h6 class="textd textd-inverse">   	 <input type="text" style="height:20px; width:180px;" class="threed input pressable" name="landlords_filter_off_name" value="<?php echo $landlords_filter_off_name;?>" placeholder="Any Partial Name"></h6>

</div>
     <div class="col-xs-2">

<h6 class="textd textd-inverse">   	 <input type="text" style="height:20px; width:180px;" class="threed input pressable" name="landlords_filter_phone" value="<?php echo $landlords_filter_phone;?>" STYLE="Background-Color : #FFFFFF" placeholder="Partial Phone Number"></h6>
</div>
<div class="col-xs-2">

<h6 class="textd textd-inverse">   	 <input type="text" style="height:20px; width:180px;" class="threed input pressable" name="landlords_filter_email" value="<?php echo $landlords_filter_email;?>" STYLE="Background-Color : #FFFFFF" placeholder="Email"></h6>
</div>

     <div class="col-sm-2">	
	
<h6 class="textd textd-inverse">   	 <input type="text" style="height:20px; width:180px;" class="threed input pressable" name="landlords_filter_llnotes" value="<?php echo $landlords_filter_llnotes;?>" STYLE="Background-Color : #FFFFFF" placeholder="Keyword"></h6>
</div>
 <div class="col-sm-2">
 <a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_filter=1";?>"><span class="btn btn-info btn-xs" style="margin-top:10px">&nbsp; Search Landlords&nbsp; </a></span>
</div>
</div>
&nbsp;<br>
     <div class="col-sm-12">
 		
	     <div class="col-sm-4">
	
<h4 class="textd" style="color:#000;text-shadow:1px 1px 0px #ccc;">Last Contacted Date: <select class="threed pressable" name="landlords_filter_lc_month" STYLE="Background-Color : #FFFFFF">
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
	</select>

	<select name="landlords_filter_lc_day" class="threed pressable">
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
	</select>
	<select name="landlords_filter_lc_year" class="threed pressable">
	<option value="0">--</option>
	<?php 
	$start_year = date ("Y") - 4;
	$year = date ("Y");
	for ($i=$start_year;$i<=$year;$i++) {
	?>
		<option value="<?php echo $i;?>" <?php if ($landlords_filter_lc_year==$i) { echo "selected";}?>><?php echo $i;?></option>
		
		
	<?php } ?>
	</select></h4>
</div>
     <div class="col-sm-4">

<h4 class="textd" style="color:#000;text-shadow:1px 1px 0px #ccc;">Next Contact Date: &nbsp; &nbsp;<select class="threed pressable" name="landlords_filter_nc_month" STYLE="Background-Color : #FFFFFF">
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
	</select>
	<select name="landlords_filter_nc_day" class="threed pressable">
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
	</select>
	<select name="landlords_filter_nc_year" class="threed pressable">
	<option value="0">--</option>
	<?php 
	$start_year = date ("Y") - 4;
	$year = date ("Y");
	for ($i=$start_year;$i<=$year;$i++) { ?>
		<option value="<?php echo $i;?>" <?php if ($landlords_filter_nc_year==$i) { echo "selected";}?>><?php echo $i;?></option>

	<?php } 

	$start_year = date ("Y") + 1;
	$year = date ("Y") + 4;
	for ($i=$start_year;$i<=$year;$i++) {
?>
	<option value="<?php echo $i;?>" <?php if ($landlords_filter_nc_year==$i) { echo "selected";}?>><?php echo $i;?></option>
	
	
	<?php } ?>
	</select></h4>
	</div>
	     <div class="col-sm-2">
  <h4 class="textd" style="color:#000;text-shadow:1px 1px 0px #ccc;">Ranking <select class="threed pressable" name="LLRANK">
	<option value="">--</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>

	</select></h4>
</div>	

 <div class="col-sm-2">
 <a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_filter=1";?>"><span class="btn btn-danger btn-xs" style="margin-top:4px">&nbsp; &nbsp; &nbsp; Clear Search&nbsp; &nbsp; &nbsp; </a></span>
</div>	
</div>
<br>&nbsp;<br>
 <div class="col-sm-12">
  <div class="col-sm-1">
<a href="<?php echo "$PHP_SELF?op=createLandlord";?>"><img border="0" hspace="0" vspace="0" width="89" height="22" src="../assets/images/newLandlord.jpg"></a> 
</div>
 <div class="col-sm-3">
 <a href="<?php echo "$PHP_SELF?op=mail_all_landlords&e=1";?>"><IMG src="../images/icons/email.gif" BORDER="0" HEIGHT="15" WIDTH="22" TITLE="Email ALL Landlords at their personal email address"> Email ALL Landlords (personal)</A>
 </div>
  <div class="col-sm-3">
  <a href="<?php echo "$PHP_SELF?op=mail_all_landlords&e=2";?>"><IMG src="../images/icons/email.gif" BORDER="0" HEIGHT="15" WIDTH="22" TITLE="Email ALL Landlords at their office email address"> Email ALL Landlords (office)</A></div>
 <div class="col-sm-3">
 <a href="<?php echo "$PHP_SELF?op=mail_all_landlords&e=3";?>"><IMG src="../images/icons/email.gif" BORDER="0" HEIGHT="15" WIDTH="22" "TITLE"="Email ALL Landlords at their personal and office email addresses"> Email ALL Landlords (both)</A>
 </div>

  <div class="col-sm-2">
  <a href="<?php echo "$PHP_SELF?op=manageLandlord&show_all_landlords=1";?>"><span class="btn btn-warning btn-xs">Show ALL Landlords</a></span>
	</div>
	</div>
	</form>
<br>
	</div>
	</div>


		<?php
		
			if ((!$_GET['landlords_filter']) and ($show_all_landlords!=1)) { 


			} else {
		?>



	<tr>


<TD bgcolor="#FFFFFF" WIDTH="3">&nbsp;</TD>


	<td align="left" colspan="24" valign="bottom" bgcolor="#FFFFFF" style="font-size:10px;">
	
	
	
<CENTER>
<TABLE border=0><TR><TD style="font-size:10px;">

<NOBR>Viewing Landlords 
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
		<b><?php echo $display_start;?> - <?php echo $display_bunch;?></b> of <b><?php echo $landlords_count;?></b>
		<?php if ($landlords_count > $landlords_limit_n) {?>

</NOBR></TD><TD style="font-size:10px;">

		&nbsp;&nbsp;&nbsp; go to page  

</TD><FORM><TD style="font-size:10px;">


<select name="URL" onchange="window.location.href= this.form.URL.options[this.form.URL.selectedIndex].value">
		<?php $pageTop = ceil($landlords_count / $landlords_limit_n);
		for ($i=1;$i <= $pageTop;$i++) {
		
		?>
<OPTION VALUE="<?php echo "$PHP_SELF?op=manageLandlord&landlords_page=$i";?>" <?php if ($landlords_page == $i) { echo " selected "; } ?>><?php echo $i;?></OPTION>


		<?php } ?>
</select>

</TD>
</form>
<TD style="font-size:10px;">
		&nbsp;&nbsp;&nbsp;<?php if (($landlords_page) < ($landlords_count / $landlords_limit_n)) {
			$nextPage = $landlords_page + 1;
					
		if ($landlords_page != 1) {
		$prevPage = $landlords_page - 1;
		}else{ $prevPage = ""; }
			
				
			if ($landlords_page != 1) {
			?>
			
	<a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_page=$prevPage";?>"><-Back</a> &nbsp;&nbsp;&nbsp; 

	<?php } ?>
	
	<a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_page=$nextPage";?>">Next-></a> 

		<?php } ?> &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo "$PHP_SELF?op=manageLandlord&show_all_landlords=1";?>">Show all landlords</a></NOBR>
		<?php }
	}?>
	
	</TD></TR></TABLE>
	</CENTER>	
	</td>

		</tr>
		</TABLE>
	
		

		
		
		
		
		
		<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0" WIDTH="100%">
	<tr>
	<td colspan="24" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
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

   <?php while ($rowGetLandlord = mysqli_fetch_object($quPageLandlord)) { 
   

$quStrGetBuildings = "SELECT DISTINCT `STREET_NUM` , `STREET` FROM CLASS WHERE `CLI` =$grid AND `CLASS`.`LANDLORD`=$rowGetLandlord->LID";
	$quGetBuildings = mysqli_query($dbh, $quStrGetBuildings) or die ($quStrGetBuildings);
	$num_Buildings=mysqli_num_rows($quGetBuildings);

$quStrGetBuildings2 = "SELECT `STREET_NUM` , `STREET` FROM CLASS WHERE `CLI` =$grid AND `CLASS`.`LANDLORD`=$rowGetLandlord->LID";
$quGetBuildings2 = mysqli_query($dbh, $quStrGetBuildings2) or die ($quStrGetBuildings2);
$num_Units=mysqli_num_rows($quGetBuildings2);
	
	?>

	 
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
	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><CENTER>

<?php
	echo "<NOBR><A HREF=$PHP_SELF?op=buildings&lid=$rowGetLandlord->LID&llname=$rowGetLandlord->SHORT_NAME>$num_Buildings<IMG src=../assets/images/buildings.jpg BORDER=0 TITLE=\"$rowGetLandlord->SHORT_NAME's Buildings - Edit Units Globally/Individually\"></A></NOBR>";
 ?>
</CENTER>
</DIV>
</TD>

	<td bgcolor="<?php echo $rowColor;?>"><div class="ad">
<CENTER>
<?php
	echo "<NOBR><A HREF=$PHP_SELF?op=global-Landlord&lid=$rowGetLandlord->LID&llname=$rowGetLandlord->SHORT_NAME>$num_Units<IMG src=../assets/images/global.jpeg BORDER=0 TITLE=\"Edit ALL $rowGetLandlord->SHORT_NAME's Units Globally\"></A></NOBR>";
 ?>
</CENTER>
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
	
<A HREF="<?php echo "$PHP_SELF?op=adlEdit&LLID=$rowGetLandlord->LID";?>"><img border="0" vspace="0" hspace="0" SRC="../images/edit-new-listing-ll.gif" ALT="Create a new listing for <?php echo "$rowGetLandlord->SHORT_NAME";?>" TITLE="Create A New Listing For <?php echo "$rowGetLandlord->SHORT_NAME";?>" ALT="Create A New Listing For This Landlord"></a>
	
<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none&activeFilter=n&vid=7&sortD=ASC&sort=STREET,%20STREET_NUM,%20APT";?>" method="POST" target="_NEW">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="landlord" value="<?php echo $rowGetLandlord->LID;?>">
<input type="image" src="../assets/images/listings.gif" name="listings" border='0' vspace='0' hspace='0' TITLE="View ALL <?php echo "$rowGetLandlord->SHORT_NAME";?> Listings">
	

</DIV>
</td>
</form>
	<td bgcolor="<?php echo $rowColor;?>" VALIGN="TOP"><div class="ad">

<?php

$quStrGetstatus = "SELECT STATUS FROM CLASS WHERE CLI='$grid' AND LANDLORD='$rowGetLandlord->LID' AND STATUS='ACT' LIMIT 1";
$result = mysqli_query($dbh, $quStrGetstatus);
$test = mysqli_num_rows($result);
if ($test >0) {
echo "<img border='0' vspace='0' hspace='0' width='16' height='16' src='../assets/images/act.gif' title='Units Advertised' alt='Units Advertised'>";
} else {
echo "<img border='0' vspace='0' hspace='0' width='16' height='16' src='../assets/images/inact.jpg' title='No Units Advertised' alt='No Units Advertised'>";
}


echo "<BR>";

$quStrGetstatusa = "SELECT STATUS_ACTIVE FROM CLASS WHERE CLI='$grid' AND LANDLORD='$rowGetLandlord->LID' AND STATUS_ACTIVE='1' LIMIT 1";
$result2 = mysqli_query($dbh, $quStrGetstatusa);
$test2 = mysqli_num_rows($result2);
if ($test2 >0) {
echo "<img src=\"../assets/images/icons/a.jpg\" border=0 height=16 width=16 alt=\"available\" title=\"Available Units\">";
} else {
echo "<img src=\"../assets/images/icons/u.jpg\" border=0 height=16 width=16 alt=\"unavailable\" title=\"No Units Available\">";
}

?>

</DIV>
</td>


	<td bgcolor="<?php echo $rowColor;?>" VALIGN="TOP"><div class="ad">
	
<a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowGetLandlord->LID";?>"><img border="0" vspace="0" hspace="0" src="../images/icons/edit.gif" TITLE="Edit/View <?php echo "$rowGetLandlord->SHORT_NAME";?>'s Info" ALT="Edit/View <?php echo "$rowGetLandlord->SHORT_NAME";?>'s Info"></a><BR>
	<a href="<?php echo "$PHP_SELF?op=deleteLandlord&lid=$rowGetLandlord->LID";?>"><img border='0' vspace='0' hspace='0' src='../images/icons/delete.gif' TITLE="Delete <?php echo $rowGetLandlord->SHORT_NAME;?>"></a>
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
	<td colspan="24" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
<TR>

	<td> </td>

<TD colspan=24>


<CENTER>
<TABLE border=0><TR><TD style="font-size:10px;">

<NOBR>Viewing Landlords 
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
		<b><?php echo $display_start;?> - <?php echo $display_bunch;?></b> of <b><?php echo $landlords_count;?></b>
		<?php if ($landlords_count > $landlords_limit_n) {?>

</NOBR></TD><TD style="font-size:10px;">

		&nbsp;&nbsp;&nbsp; go to page  

</TD><FORM><TD style="font-size:10px;">


<select name="URL" onchange="window.location.href= this.form.URL.options[this.form.URL.selectedIndex].value">
		<?php $pageTop = ceil($landlords_count / $landlords_limit_n);
		for ($i=1;$i <= $pageTop;$i++) {		
?>

<OPTION VALUE="<?php echo "$PHP_SELF?op=manageLandlord&landlords_page=$i";?>" <?php if ($landlords_page == $i) { echo " selected "; } ?>><?php echo $i;?></OPTION>

		<?php } ?>
</select>

</TD>
</form>
<TD style="font-size:10px;">
		&nbsp;&nbsp;&nbsp;<?php if (($landlords_page) < ($landlords_count / $landlords_limit_n)) {
			$nextPage = $landlords_page + 1;
			if ($landlords_page != 1) {
		$prevPage = $landlords_page - 1;
		}else{ $prevPage = ""; }
			
				
			if ($landlords_page != 1) {
			?>
			
	<a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_page=$prevPage";?>"><-Back</a> &nbsp;&nbsp;&nbsp; 

	<?php } ?>
	
	<a href="<?php echo "$PHP_SELF?op=manageLandlord&landlords_page=$nextPage";?>">Next-></a> 

		<?php } ?> &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo "$PHP_SELF?op=manageLandlord&show_all_landlords=1";?>">Show all landlords</a></NOBR>
		<?php }
	}?>
	
	</TD></TR></TABLE>
	</CENTER>
	
	
	</td>
		</tr></TABLE>

<?php }  ?>

</CENTER>
</TD></TR></TABLE>
<P><BR>	
   
   
<!--END manageLandlord -->