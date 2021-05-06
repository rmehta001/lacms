<!--BEGIN manageClients -->
<?php

$pref_pagebg = $_SESSION["pref_pagebg"];
$pref_coltit = $_SESSION["pref_coltit"];


$pref_pagebg='';
if (isset($pref_pagebg) ){
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
if ($pref_coltit=="") {
$coltitcolor="#3DB1FF";
} else {
$coltitcolor="$pref_coltit";
}

/*if($_SESSION['manageClients']) {
	$_manageClients = "n";
	$icon = "minus.gif";
}else {
	$_manageClients = 1;
	$icon = "plus.gif";*/

?>
<TABLE class="table table-info"WIDTH="100%" CELLPADDING="0" CELLPADDING="0" BORDER="0">
    <TR>
        <TD WIDTH="80">
            <a href="<?php echo "$PHP_SELF?op=createClient";?>">
              <span style="font-size: 35px; color: black;">
                <i class="fas fa-user-plus"></i>
              </span>
              <br>

            <nobr>New Client</nobr>
            </a>
        </TD>
        <TD ALIGN="CENTER">
            <TABLE WIDTH="250" CELLPADDING="0" CELLPADDING="0" BORDER="0">
                <TR>
                    <TD ALIGN="CENTER">
                      <span style="font-size: 40px; color: black;">
                        <i class="fas fa-address-book"></i>
                      </span>
                    </TD>
                    <TD>
                        <FONT SIZE="+1"><B>MANAGE CLIENTS</B></FONT>
                    </TD>
                </TR>
            </TABLE>
        </TD>
        <TD WIDTH="80"&nbsp;

        </TD>
    </TR>
</TABLE>




<table class="table table-active" border="4" cellspacing="0" cellpadding="5" WIDTH="100%">
<form action="<?php echo "$PHP_SELF";?>" method="GET">
<input type="hidden" name="op" value="manageClients">
<input type="hidden" name="clients_filter" value="1">


  <div class="container-fluid bg-light text-dark"><br>
  	<div class="col-lg-12 well">
  				<form>
  					<div class="col-sm-12">
  						<div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                  <label>Agent:</label>
                  <select class="form-control" name="clients_filter_agent" >
                  		<option value="">--</option>
                  		<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) { ?>
                  		<option value="<?php echo $rowGetUsers->UID;?>" <?php if ($uid =="$rowGetUsers->UID") { echo 'selected';}?>><?php echo $rowGetUsers->HANDLE; ?></option>
                  		<?php } ?>
                  	</select>
                  </div>
                  <div class="col-md-2">
                    <label>First Name:</label>
                    <input class="form-control" type="text" name="clients_filter_name_first" value="<?php if(isset($clients_filter_name_first)) echo $clients_filter_name_first;?>">
                  </div>
                  <div class="col-md-2">
                    <label>Last Name:</label>
                    <input class="form-control" type="text" name="clients_filter_name_last" value="<?php if(isset($clients_filter_name_last)) echo $clients_filter_name_last;?>">
                  </div>
                  <div class="col-md-2">
                    <label>Type:</label>
                    <select class="form-control" name="clients_filter_type">
                    	<option value="0">All</option>
                    	<?php while ($rowGetTypes = mysqli_fetch_object($quTypes)) {?>
                    		<option value="<?php echo $rowGetTypes->TYPE;?>" <?php //if ($rowGetTypes->TYPE==$clients_filter_type) { echo " selected";}?>><?php echo $rowGetTypes->TYPENAME;?></option>
                    	<?php } ?>
                    	</select>
                  </div>
                  <div class="col-md-2">
                    <label>Location:</label>
                    <select class="form-control" id="clients_filter_loc_pref" name='clients_filter_loc_pref'>
                     <option value="">--</option>
                     <?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>
                       <option value="<?php echo $rowLocs->LOCID; ?>">
                       <?php echo $rowLocs->LOCNAME; ?></option>
                     <?php }	?>
                   </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-1">
                  </div>
                  <div class="col-md-2"><br>
                    <label>Price Min</label>
                    <input class="form-control" type="text" name="clients_filter_price_min" value="<?php echo $clients_filter_price_min ?? 0;?>">
                  </div>
                  <div class="col-md-2"><br>
                    <label>Price Max</label>
                    <input class="form-control" type="text" name="clients_filter_price_max" value="<?php echo $clients_filter_price_max ?? 0;?>">
                  </div>
                  <div class="col-md-1"><br>
                    <label>Beds:</label>
                    <select class="form-control" name="clients_filter_beds">
                      <option value="">--</option>
                      <option value="0">Studio/Loft</option>
                      <option value="1">1 Bedroom</option>
                      <option value="2">2 Bedroom</option>
                      <option value="3">3 Bedroom</option>
                      <option value="4">4 Bedroom</option>
                      <option value="5">5 Bedroom</option>
                      <option value="6">6 Bedroom</option>
                      <option value="7">7 Bedroom</option>
                      <option value="8">8 Bedroom</option>
                      <option value="9">9 Bedroom</option>
                      <option value="10">10 Bedroom</option>
                      </select>
                    </div>
                    <div class="col-md-1"><br>
                      <label>Baths:</label>
                      <select class="form-control" name="clients_filter_baths">
                      <option value="">--</option>
                      <option value="0">.5-3/4</option>
                      <option value="1">1 Bath</option>
                      <option value="2">2 Bath</option>
                      <option value="3">3 Bath</option>
                      <option value="4">4 Bath</option>
                      <option value="5">5 Bath</option>
                      <option value="6">6 Bath</option>
                      <option value="99">Shared</option>
                      </select>
                  </div>
                  <div align="center"class="col-md-2"><br>
                    <label><b>Status:</b></label><br>
                      All
                      &nbsp;
                      &nbsp;
                      
                      <input  class="form-check-input" type="radio" name="clients_filter_status_client" value="0">
                      
                      Active
                      &nbsp;
                      &nbsp;
                      &nbsp;
                      <input class="form-check-input" type="radio" name="clients_filter_status_client" value="1"><br>           
                      Inactive
                      &nbsp;
                      &nbsp;
                      &nbsp;
                      <input class="form-check-input" type="radio" name="clients_filter_status_client" value="2">
                  </div>
                  <div class="col-md-2"><br>
                    <label>Building Type:</label>
                    <select class="form-control"name="clients_filter_building_pref">
                    <option value="">--</option>
                    <?php foreach ($DEFINED_VALUE_SETS['BUILDING_TYPE'] as $bkey => $bValue) {
                    //$selected = ($rowGetClient->BUILDING_TYPE==$bkey) ? " selected " : "";?>
                    <option value="<?php echo $bkey;?>" <?php //echo $selected;?>><?php echo $bValue;?></option>
                    <?php } ?>
                    </select>
                  </div>
                </div>
              <div class="row">
                  <div class="col-md-1">
                  </div>
                  <div class="col-md-2"><br>
                    <label>Partial Phone #:</label>
                    <input class="form-control"type="text" name="clients_filter_phone" value="<?php echo $clients_filter_phone ?? "";?>">
                  </div>
                  <div class="col-md-2"><br>
                    <label>Partial Email:</label>
                    <input class="form-control"type="text"  SIZE="8" name="clients_filter_email" value="<?php echo $clients_filter_email ?? "";?>">
                  </div>
                  <div class="col-md-4"><br>
                      <label></label><br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Furnished: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input"type="checkbox" name="clients_filter_furnishedon" value="1"> | Short-Term: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input"type="checkbox" name="clients_filter_shorttermon" value="1"> | Pets: &nbsp;<input type="checkbox" name="clients_filter_pets" value="1">
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lead Safe:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input class="form-check-input"type="checkbox" name="clients_leadsafe" value="1">
                    </div>
                  <div class="col-md-2"><br>
                    <label>Comm. Sub Type:</label>
                    <select class="form-control"name="clients_filter_subtype">
                    <option value="">--</option>
                    <option value="3">Accessories</option>
                    <option value="4">Apparel - Men</option>
                    <option value="5">Apparel - Women</option>
                    <option value="6">Apparel - Kids</option>
                    <option value="7">Apparel - Baby</option>
                    <option value="8">Art</option>
                    <option value="71">Attorney</option>
                    <option value="9">Auto Dealerships</option>
                    <option value="10">Auto Supply</option>
                    <option value="1">Banks</option>
                    <option value="11">Beauty Salons</option>
                    <option value="12">Bridal</option>
                    <option value="75">Broker-Business</option>
                    <option value="76">Broker-Industrial</option>
                    <option value="77">Broker-Investment Sales</option>
                    <option value="78">Broker-Office</option>
                    <option value="79">Broker-Residential</option>
                    <option value="80">Broker-Restaurants</option>
                    <option value="13">Candy</option>
                    <option value="14">Cards</option>
                    <option value="15">Check Cashing/Pawn</option>
                    <option value="16">Childcare</option>
                    <option value="17">Coffee</option>
                    <option value="18">Computer</option>
                    <option value="89">Contractor</option>
                    <option value="19">Convenience</option>
                    <option value="20">Cosmetics</option>
                    <option value="21">Cutlery</option>
                    <option value="88">Dance Studio</option>
                    <option value="67">Dentist</option>
                    <option value="22">Department Store</option>
                    <option value="81">Developer-Residential</option>
                    <option value="82">Developer-Commercial</option>
                    <option value="83">Developer-Retail</option>
                    <option value="23">Discount Store</option>
                    <option value="68">Doctor</option>
                    <option value="24">Drug Store</option>
                    <option value="25">Dry cleaning</option>
                    <option value="26">Educational</option>
                    <option value="27">Fabrics</option>
                    <option value="28">Fast Food</option>
                    <option value="29">Fine Jewelry</option>
                    <option value="30">Fitness Equipment</option>
                    <option value="31">Flooring</option>
                    <option value="32">Florist</option>
                    <option value="33">Furniture</option>
                    <option value="34">Gas</option>
                    <option value="35">Gifts</option>
                    <option value="36">Hardware/Home Improvement</option>
                    <option value="37">Health clubs/gyms</option>
                    <option value="38">Home Decor</option>
                    <option value="39">Housewares</option>
                    <option value="84">Investor-Office</option>
                    <option value="85">Investor-Retail</option>
                    <option value="86">Investor-Residential</option>
                    <option value="74">Laundromat</option>
                    <option value="40">Leather/luggage</option>
                    <option value="41">Liquor</option>
                    <option value="42">Major appliance</option>
                    <option value="72">Massage</option>
                    <option value="43">Medical equipment</option>
                    <option value="44">Movie Theaters</option>
                    <option value="45">Music instruments</option>
                    <option value="46">Nutrition</option>
                    <option value="47">Office Supply</option>
                    <option value="69">Office Use</option>
                    <option value="48">Optical/eye-ware</option>
                    <option value="49">Outdoor pool/patio</option>
                    <option value="50">Paper/Party Store</option>
                    <option value="51">Pet Supply</option>
                    <option value="52">Photocopies/printing</option>
                    <option value="87">Pizza</option>
                    <option value="90">Property Management/Vendor</option>
                    <option value="91">Property Management/Tenant</option>
                    <option value="66">Psychologist</option>
                    <option value="70">Real Estate Office</option>
                    <option value="53">Rental Center</option>
                    <option value="54">Restaurants/Bars</option>
                    <option value="73">Salon</option>
                    <option value="55">Seasonal</option>
                    <option value="56">Shoes</option>
                    <option value="57">Signs</option>
                    <option value="58">Specialty foods</option>
                    <option value="59">Sporting Goods</option>
                    <option value="60">Supermarkets</option>
                    <option value="61">Tobacco</option>
                    <option value="62">Toys/Games/Video Games</option>
                    <option value="63">Wall coverings/pain</option>
                    <option value="64">Warehouses/Wholesale Clubs</option>
                    <option value="65">Wireless Communications</option>
                    <option value="54">Yogurt</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-1">
                    </div>
                      <div class="col-md-2"><br><br>
                      <nobr>    <input type="submit" value="Search Clients" class="btn btn-primary">&nbsp; <A HREF="<?php echo "$PHP_SELF?op=manageClients&clients_filter=1&clients_filter_name_first=&clients_filter_name_last=&clients_filter_price_min=&clients_filter_price_max=&clients_filter_type=0&clients_filter_phone=&clients_filter_email=";?>">
                      <input type="button" class="btn btn-dark" value="Clear Search"></A></nobr>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>




<table class="table table-secondary">
<tr>
<td colspan="25"><center>
<NOBR>
<FONT SIZE="3"><B>
<A HREF="http://www.criminalpages.com/state-criminal-records-directory/state-of-massachusetts-criminal-records/" target="_criminal">Criminal History Check</A> &nbsp; | &nbsp; <A HREF="./pages/ssn_verify_form.php" target="_SSN">SS# Checker</A> &nbsp; | &nbsp; <A HREF="<?php echo "$PHP_SELF";?>?op=utilities"><i class="fas fa-plug"></i> Set up Utilities</A>  &nbsp; | &nbsp;
<a href="<?php echo "$PHP_SELF?op=mail_all_clients";?>" target="_new"><i class="fas fa-envelope"></i> Email ALL Clients</A>  &nbsp; | &nbsp;
   <a href="<?php echo "$PHP_SELF?op=mail_all_clients_active";?>" target="_new"><i class="fas fa-envelope"></i> Email All Active Clients</A>  &nbsp; | &nbsp;
     <a href="<?php echo "$PHP_SELF?op=mail_all_clients_inactive";?>" target="_new"><i class="fas fa-envelope"></i> Email All Inactive Clients</A></B></FONT>
</NOBR>
</CENTER>
</td>
	</tr>
  <tr>
	<td align="left" colspan="31" valign="bottom" bgcolor="#FFFFFF" style="font-size:15px;">
<!-------------------------------------------------------------------------------------------------------------------------------------------------------------->



<TABLE class="table table-light"border=0>
  <TR>
    <TD style="font-size:15px;">
      <center>
      <NOBR>Viewing Clients
      	<?php
      if (!isset ($_GET['show_all_clients'])) {
            if(!isset($clients_limit_start)){
                $clients_limit_start = 1;        
            } 

            if(!isset($clients_limit_n)){
                $clients_limit_n = 20;
            }

            if(!isset($clients_page)){
                $clients_page = 1;
            }

            if(!isset($clients_sort)){
                $clients_sort = "DESC";
            }
            if(!isset($clients_count)){
                $clients_count = 1;       
            }
            
            if(!isset($SortDir)){
                $SortDir = "DESC";
            }            

		$display_bunch = $clients_limit_start + $clients_limit_n;
		if ($display_bunch > $clients_count) {
			$display_bunch = $clients_count;
		}
		$display_start = $clients_limit_start;
		if ($display_start == 0 && $clients_count > 0) {
			$display_start = 1;
		}
		?>
		<b><?php echo $display_start;?> - <?php echo $display_bunch;?></b> of <b><?php echo $clients_count;?></b>
      		<?php if ($clients_count > $clients_limit_n) {?>
          </NOBR>
        </TD><td></td><td></td><td></td>
        <TD style="font-size:15px;" align="left" valign="bottom">

		Go to page&nbsp;&nbsp;

<FORM style="font-size:15px;">

  <select name="URL" onchange="window.location.href= this.form.URL.options[this.form.URL.selectedIndex].value">
  		<?php $pageTop = ceil($clients_count / $clients_limit_n);
  		for ($i=1;$i <= $pageTop;$i++) {
  ?>
  <OPTION VALUE="<?php echo "$PHP_SELF?op=manageClients&clients_page=$i";?>" <?php if ($clients_page == $i) { echo " selected ";}?>><?php echo $i;?></OPTION>

  		<?php } ?>
  </select>
</form>
  </td>
<TD style="font-size:15px;">
    <?php if (($clients_page) < ($clients_count / $clients_limit_n))
    {
			$nextPage = $clients_page + 1;


		if ($clients_page != 1) {
		$prevPage = $clients_page - 1;
		}
    else{ $prevPage = ""; }


			if ($clients_page !="1")
       {
			?>
      <nav>
        <ul class="pagination">
           <a class="page-link" href="<?php echo "$PHP_SELF?op=manageClients&clients_page=$prevPage";?>">Back</a>	<?php } ?>
           <a class="page-link" href="<?php echo "$PHP_SELF?op=manageClients&clients_page=1";?>">1</a>
           <a class="page-link" href="<?php echo "$PHP_SELF?op=manageClients&clients_page=2";?>">2</a>
           <a class="page-link" href="<?php echo "$PHP_SELF?op=manageClients&clients_page=3";?>">3</a>
           <a class="page-link" href="<?php echo "$PHP_SELF?op=manageClients&clients_page=$nextPage";?>">Next</a><?php } ?>
        </ul>
      </nav>
		<?php }
	}?>
	</CENTER>
	</TD>
  <td>
    <a class="btn btn-light"href="<?php echo "$PHP_SELF?op=manageClients&show_all_clients=1";?>">Show all Clients</a>
  </td>
</TR>
</TABLE>

<table class="table table-hover" border="0">


	<tr class="table table-info">

	<td align="center" bgcolor="<?php echo $coltitcolor;?>">

<?php if (!$clients_sort=="NAME_LAST") { ?>

<a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=NAME_LAST&SortDir=ASC&clients_page=".$clients_page;?>"><div class="controltext" <?php if ($clients_sort=="NAME_LAST") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3>Name</FONT></div></a>

	<?php } else {

if ($SortDir == "DESC") { ?>

<a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=NAME_LAST&SortDir=ASC&clients_page=".$clients_page;?>"><div <?php if ($clients_sort=="NAME_LAST") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Name</FONT></div></a>

	<?php } else { ?>

<a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=NAME_LAST&SortDir=DESC&clients_page=".$clients_page;?>"><div <?php if ($clients_sort=="NAME_LAST") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Name</FONT></div></a>

	<?php }} ?>
</div></td>


	<td align="center" bgcolor="<?php echo $coltitcolor;?>">
            
            <?php if (!$clients_sort=="HOME_PHONE") { ?>
                    <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=HOME_PHONE&SortDir=ASC&clients_page=".$clients_page;?>">
                        <div class="controltext" 
                            
                            <?php if ($clients_sort=="HOME_PHONE") { echo "style=\"text-decoration:underline\"";}?>>
                            <FONT SIZE=3><NOBR>Home Phone</NOBR></FONT></div>
                            </a>

                    <?php } else {

                if ($SortDir == "DESC") { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=HOME_PHONE&SortDir=ASC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="HOME_PHONE") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'><NOBR>Home Phone</NOBR>
                        </FONT>
                </div>
            </a>

                <?php } else { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=HOME_PHONE&SortDir=DESC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="HOME_PHONE") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'><NOBR>Home Phone</NOBR>
                        </FONT>
                        </div>
            </a>

                <?php }} ?>
            
        </td>


	<td align="center" bgcolor="<?php echo $coltitcolor;?>">
            
            <?php if (!$clients_sort=="WORK_PHONE") { ?>
                    <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=WORK_PHONE&SortDir=ASC&clients_page=".$clients_page;?>">
                        <div class="controltext" 
                            
                            <?php if ($clients_sort=="WORK_PHONE") { echo "style=\"text-decoration:underline\"";}?>>
                            <FONT SIZE=3><NOBR>Work Phone</NOBR></FONT></div>
                            </a>

                    <?php } else {

                if ($SortDir == "DESC") { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=WORK_PHONE&SortDir=ASC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="WORK_PHONE") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'><NOBR>Work Phone</NOBR>
                        </FONT>
                </div>
            </a>

                <?php } else { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=WORK_PHONE&SortDir=DESC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="WORK_PHONE") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'><NOBR>Work Phone</NOBR>
                        </FONT>
                        </div>
            </a>

                <?php }} ?>
          
        </td>

	<td align="center" bgcolor="<?php echo $coltitcolor;?>">
            
            <?php if (!$clients_sort=="TYPE") { ?>

                    <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=TYPE&SortDir=ASC&clients_page=".$clients_page;?>">
                        <div class="controltext" 
                            
                            <?php if ($clients_sort=="TYPE") { echo "style=\"text-decoration:underline\"";}?>>
                            <FONT SIZE=3>Type</FONT></div>
                            </a>

                    <?php } else {

                if ($SortDir == "DESC") { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=TYPE&SortDir=ASC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="TYPE") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Type</FONT>
                        </div>
            </a>

                <?php } else { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=TYPE&SortDir=DESC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="TYPE") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Type</FONT>
                        </div>
            </a>

                <?php }} ?>
            
        </td>


        <td align="center" width="75" bgcolor="<?php echo $coltitcolor;?>">
            
            <?php if (!$clients_sort=="LOC_PREF") { ?>
                    <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=LOC_PREF&SortDir=ASC&clients_page=".$clients_page;?>">
                        <div class="controltext" 
                            
                            <?php if ($clients_sort=="LOC_PREF") { echo "style=\"text-decoration:underline\"";}?>>
                            <FONT SIZE=3>Location</FONT></div>
                            </a>

                    <?php } else {

                if ($SortDir == "DESC") { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=LOC_PREF&SortDir=ASC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="LOC_PREF") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Location
                        </FONT>
                </div>
            </a>

                <?php } else { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=LOC_PREF&SortDir=DESC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="LOC_PREF") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Location
                        </FONT>
                        </div>
            </a>

                <?php }} ?>
           
        </td>



	<td align="center" bgcolor="<?php echo $coltitcolor;?>">
            
            
            <?php if (!$clients_sort=="ROOMS_PREF") { ?>
                    <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=ROOMS_PREF&SortDir=ASC&clients_page=".$clients_page;?>">
                        <div class="controltext" 
                            
                            <?php if ($clients_sort=="ROOMS_PREF") { echo "style=\"text-decoration:underline\"";}?>>
                            <FONT SIZE=3>Beds</FONT></div>
                            </a>

                    <?php } else {

                if ($SortDir == "DESC") { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=ROOMS_PREF&SortDir=ASC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="ROOMS_PREF") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Beds
                        </FONT>
                </div>
            </a>

                <?php } else { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=ROOMS_PREF&SortDir=DESC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="ROOMS_PREF") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Beds
                        </FONT>
                        </div>
            </a>

                <?php }} ?>
        
        </td>


	<td align="center" bgcolor="<?php echo $coltitcolor;?>">
            
            <?php if (!$clients_sort=="PRICEMIN") { ?>
                    <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=PRICEMIN&SortDir=ASC&clients_page=".$clients_page;?>">
                        <div class="controltext" 
                            
                            <?php if ($clients_sort=="PRICEMIN") { echo "style=\"text-decoration:underline\"";}?>>
                            <FONT SIZE=3>Price<BR>Min</FONT></div>
                            </a>

                    <?php } else {

                if ($SortDir == "DESC") { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=PRICEMIN&SortDir=ASC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="PRICEMIN") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Price<BR>Min
                        </FONT>
                </div>
            </a>

                <?php } else { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=PRICEMIN&SortDir=DESC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="PRICEMIN") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Price<BR>Min
                        </FONT>
                        </div>
            </a>

                <?php }} ?>
            
     
        </td>


	<td align="center" bgcolor="<?php echo $coltitcolor;?>">
            
            <?php if (!$clients_sort=="PRICEMAX") { ?>

                    <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=PRICEMAX&SortDir=ASC&clients_page=".$clients_page;?>">
                        <div class="controltext" 
                            
                            <?php if ($clients_sort=="PRICEMAX") { echo "style=\"text-decoration:underline\"";}?>>
                            <FONT SIZE=3>Price<BR>Max</FONT></div>
                            </a>

                    <?php } else {

                if ($SortDir == "DESC") { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=PRICEMAX&SortDir=ASC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="PRICEMAX") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Price<BR>Max
                        </FONT>
                </div>
            </a>

                <?php } else { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=PRICEMAX&SortDir=DESC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="PRICEMAX") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Price<BR>Max
                        </FONT>
                        </div>
            </a>

                <?php }} ?>
        
        </td>


<td align="center" bgcolor="<?php echo $coltitcolor;?>">

<?php if (!$clients_sort=="DATE_NEXT_CONTACT") { ?>

<NOBR><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_NEXT_CONTACT&clients_page=".$clients_page;?>"><div class="controltext" <?php if ($clients_sort=="DATE_NEXT_CONTACT") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3>Next Contact</A></NOBR><BR>

	<?php } else {

if ($SortDir == "DESC") { ?>

<NOBR><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_NEXT_CONTACT&SortDir=ASC&clients_page=".$clients_page;?>"><div class="controltext" <?php if ($clients_sort=="DATE_NEXT_CONTACT") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Next Contact</A></NOBR><BR>

	<?php } else { ?>

<a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_NEXT_CONTACT&SortDir=DESC&clients_page=".$clients_page;?>"><div class="controltext" <?php if ($clients_sort=="DATE_NEXT_CONTACT") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Next Contact</A><BR>

	<?php }} ?>





<?php if ($SortDir == "DESC") { ?>
<NOBR><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_MODIFIED&SortDir=ASC&clients_page=".$clients_page;?>"><div class="controltext" <?php if ($clients_sort=="DATE_MODIFIED") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Last Modified</A></NOBR>

	<?php } else { ?>
<NOBR><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_MODIFIED&SortDir=DESC&clients_page=".$clients_page;?>"><div class="controltext" <?php if ($clients_sort=="DATE_MODIFIED") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Last Modified</A></NOBR>


	<?php } ?>




</FONT></div>
</td>





<td align="center" bgcolor="<?php echo $coltitcolor;?>">
    
    <?php if (!$clients_sort=="DATE_MOVEIN") { ?>
                    <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_MOVEIN&SortDir=ASC&clients_page=".$clients_page;?>">
                        <div class="controltext" 
                            
                            <?php if ($clients_sort=="DATE_MOVEIN") { echo "style=\"text-decoration:underline\"";}?>>
                            <FONT SIZE=3>
                                <NOBR>Move In</NOBR><BR><NOBR>Date Range</NOBR>
                            </FONT>
                        </div>
                    </a>

                    <?php } else {

                if ($SortDir == "DESC") { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_MOVEIN&SortDir=ASC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="DATE_MOVEIN") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>
                        <NOBR>Move In</NOBR><BR><NOBR>Date Range</NOBR>
                        </FONT>
                </div>
            </a>

                <?php } else { ?>

            <a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_MOVEIN&SortDir=DESC&clients_page=".$clients_page;?>">
                <div <?php if ($clients_sort=="DATE_MOVEIN") { echo "style=\"text-decoration:underline\"";}?>>
                    <FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>
                        <NOBR>Move In</NOBR><BR><NOBR>Date Range</NOBR>
                        </FONT>
                        </div>
            </a>

                <?php }} ?>
    
</td>

<td align="center" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=CLIENT_EMAIL&clients_page=".$clients_page;?>"><div class="controltext" <?php if ($clients_sort=="CLIENT_EMAIL") { echo "style=\"text-decoration:underline;\"";}?>><FONT SIZE="3">Email</FONT></div></a></td>
	<td colspan="2" align="center" bgcolor="<?php echo $coltitcolor;?>">


<?php if (!$clients_sort=="DATE_CREATED") { ?>

	<a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_CREATED";?>"><div class="controltext" <?php if ($clients_sort=="DATE_CREATED") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3>Date Created</FONT></div></a>

	<?php } else {

if ($SortDir == "DESC") { ?>

<CENTER><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_CREATED&SortDir=ASC";?>"><div class="controltext" <?php if ($clients_sort=="DATE_CREATED") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Date</NOBR> Created</FONT></div></a></CENTER>

	<?php } else { ?>

<CENTER><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_CREATED&SortDir=DESC";?>"><div class="controltext" <?php if ($clients_sort=="DATE_CREATED") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Date</NOBR> Created</FONT></div></a></CENTER>

	<?php }} ?>

</td>
	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=USERS.HANDLE";?>"><div class="controltext" <?php if ($clients_sort=="USERS.HANDLE") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3>Agent&nbsp;</FONT></div></a></td>

		<td align="center" bgcolor="<?php echo $coltitcolor;?>">

	<a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=STATUS_CLIENT";?>"><div class="controltext" <?php if ($clients_sort=="STATUS_CLIENT") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=3>Status</FONT></div></a></td>
<td></td><td></td>

	</tr>


<?php
if (isset ($pref_row_color)){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} ?>


    <?php while ($rowGetClients = mysqli_fetch_object($quGetClients)) { ?>


    	<tr class="bg-light">






	<td bgcolor="" data-toggle="modal"><div class="ad"><NOBR>
<?php

if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";}
}

echo "&nbsp;<a href=\"$PHP_SELF?op=editClient&clid=$rowGetClients->CLID\" TITLE=\"Created ";

if ($rowGetClients->HANDLE) {
echo "by: ".$rowGetClients->HANDLE;
}
echo " on ". $rowGetClients->DATE_CREATED ." - Click to Edit/View\">";


if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";}
}
echo $rowGetClients->NAME_FIRST." ".$rowGetClients->NAME_LAST;

if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}

echo "</A>";

if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<BR>&nbsp; Inactive</FONT>";}

?></DIV></NOBR></td>



	<td bgcolor=""><div class="ad"><?php
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
 echo "$rowGetClients->HOME_PHONE";
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></div></td>


	<td bgcolor=""><div class="ad"><?php
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
 echo "$rowGetClients->WORK_PHONE";
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></div></td>


	<td bgcolor="" align=center><div class="ad"><?php
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}

echo "$rowGetClients->TYPENAME";


if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></div></td>



        <td bgcolor=""><div class="clientlocation" style="display:block;height: 125px;overflow-y: scroll"><div class="ad">
<?php
//echo "$rowGetClients->LOC_PREF";
$client_location_ids=explode(",", $rowGetClients->LOC_PREF);
$client_location_names="";
foreach ($client_location_ids as $client_location => $client_location_id)
{
        if(isset($client_location_id)){
        if(array_key_exists($client_location_id, $LOC_ARRAY)){
        $client_location_names.="<br><NOBR>".$LOC_ARRAY[$client_location_id];
            }
        else{
            $client_location_names.="<br><NOBR>".$LOC_ARRAY[1];
        }
        }
   
}
$client_location_names=preg_replace('/^<br>/',"" ,$client_location_names);

if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}

$client_location_names = str_replace("BOSTON - ", "", $client_location_names);

echo $client_location_names;
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></DIV>
</div></td>



	<td bgcolor="">
	<div class="clientrooms" style="display:block;height: 125px;overflow-y: scroll">

	<div class="ad">


	<?php $rprefs = explode(",", $rowGetClients->ROOMS_PREF);
	foreach ($rprefs as $rpref) {

if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}


if ($rpref == '0.25') {
echo "<NOBR>LOFT</NOBR><BR>";
} elseif ($rpref == '0.50') {
echo "<NOBR>STUDIO</NOBR><BR>";
} elseif ($rpref == '0.75') {
echo "<NOBR>STU/ALC</NOBR><BR>";
} elseif ($rpref == '0.76') {
echo "<NOBR>STU/2RM</NOBR><BR>";
} elseif ($rpref == '0.79') {
echo "<NOBR>STU/LFTBD</NOBR><BR>";
} elseif ($rpref == '1.0') {
echo "<NOBR>1 BED</NOBR><BR>";
} elseif ($rpref == '1.5') {
echo "<NOBR>1 BD SPLT</NOBR><BR>";
} elseif ($rpref == '1.75') {
echo "<NOBR>1 BD PLUS</NOBR><BR>";
} elseif ($rpref == '2.0') {
echo "<NOBR>2 BED</NOBR><BR>";
} elseif ($rpref == '2.5') {
echo "<NOBR>2 BD SPLT</NOBR><BR>";
} elseif ($rpref == '2.75') {
echo "<NOBR>2 BD PLUS</NOBR><BR>";
} elseif ($rpref == '3.0') {
echo "<NOBR>3 BED</NOBR><BR>";
} elseif ($rpref == '3.5') {
echo "<NOBR>3 BD SPLT</NOBR><BR>";
} elseif ($rpref == '3.75') {
echo "<NOBR>3 BD PLUS</NOBR><BR>";
} elseif ($rpref == '4.0') {
echo "<NOBR>4 BED</NOBR><BR>";
} elseif ($rpref == '4.5') {
echo "<NOBR>4 BD SPLT</NOBR><BR>";
} elseif ($rpref == '4.75') {
echo "<NOBR>4 BD PLUS</NOBR><BR>";
} elseif ($rpref == '5.0') {
echo "<NOBR>5 BED</NOBR><BR>";
} elseif ($rpref == '5.5') {
echo "<NOBR>5 BD SPLT</NOBR><BR>";
} elseif ($rpref == '5.75') {
echo "<NOBR>5 BD PLUS</NOBR><BR>";
} elseif ($rpref == '6.0') {
echo "<NOBR>6 BED</NOBR><BR>";
} elseif ($rpref == '7.0') {
echo "<NOBR>7 BED</NOBR><BR>";
} elseif ($rpref == '8.0') {
echo "<NOBR>8 BED</NOBR><BR>";
} elseif ($rpref == '9.0') {
echo "<NOBR>9 BED</NOBR><BR>";
} elseif ($rpref == '10.0') {
echo "<NOBR>10 BED</NOBR><BR>";
} elseif ($rpref == '11.0') {
echo "<NOBR>11 BED</NOBR><BR>";
} elseif ($rpref == '12.0') {
echo "<NOBR>12 BED</NOBR><BR>";
} elseif ($rpref == '13.0') {
echo "<NOBR>13 BED</NOBR><BR>";
} elseif ($rpref == '14.0') {
echo "<NOBR>14 BED</NOBR><BR>";
} elseif ($rpref == '15.0') {
echo "<NOBR>15 BED</NOBR><BR>";
} elseif ($rpref == '16.0') {
echo "<NOBR>16 BED</NOBR><BR>";
} elseif ($rpref == '17.0') {
echo "<NOBR>17 BED</NOBR><BR>";
} elseif ($rpref == '18.0') {
echo "<NOBR>18 BED</NOBR><BR>";
} elseif ($rpref == '19.0') {
echo "<NOBR>19 BED</NOBR><BR>";
} elseif ($rpref == '20.0') {
echo "<NOBR>20 BED</NOBR><BR>";
}







if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT></FONT>";}
}

	}?>
</div>
</div>
</td>



	<td bgcolor=""><div class="ad"><?php
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
echo "$rowGetClients->PRICEMIN";
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></div></td>

	<td bgcolor=""><div class="ad"><?php
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
 echo "$rowGetClients->PRICEMAX";
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?>
</div></td>

	<td bgcolor=""><div class="ad"><CENTER>
<?php
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}

 echo "<B>".$rowGetClients->DATE_NEXT_CONTACT."</B><BR>";


foreach ($DEFINED_VALUE_SETS['CLIENT_STATUS2'] as $cskey => $csValue) {

if ($rowGetClients->CLIENT_STATUS2 == "$cskey") {
echo $csValue;
}
}

 echo "<BR>".$rowGetClients->DATE_MODIFIED."<BR>";



if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></CENTER></DIV></td>


	<td bgcolor=""><div class="ad"><CENTER><NOBR><FONT SIZE=-3><?php
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
 echo "$rowGetClients->DATE_MOVEIN";
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></NOBR><BR><NOBR>


<?php if ($rowGetClients->DATE_MOVEIN > $rowGetClients->DATE_MOVEIN_END ) {echo "<font color=red>";} ?>

<?php
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
echo "$rowGetClients->DATE_MOVEIN_END";
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></NOBR>
<?php if ($rowGetClients->DATE_MOVEIN > $rowGetClients->DATE_MOVEIN_END ) {echo "</font>";} ?>
</FONT></CENTER></DIV></td>



<td bgcolor=""><CENTER>

<?php
if ( $rowGetClients->CLIENT_EMAIL != "" ) {
echo "<A HREF=\"$PHP_SELF?op=mail_client&clid=$rowGetClients->CLID\" target=\"_email$rowGetClients->CLID\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";
} else {
	echo " &nbsp; ";
}
; ?>

</CENTER></td>

<td bgcolor="" ALIGN=CENTER><div class="ad">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetClients->CLID";?>#appointment" TITLE="Make an Appointment with <?php echo $rowGetClients->NAME_FIRST.$rowGetClients->NAME_LAST;?>"><i class="fas fa-clock"></i></A>
</TD>


<td bgcolor="" ALIGN=CENTER><div class="ad">

<a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowGetClients->CLID";?>" TITLE="Showing History for <?php echo $rowGetClients->NAME_FIRST.$rowGetClients->NAME_LAST;?>" target="_sh<?php echo $rowGetClients->CLID;?>"><i class="fas fa-history"></i>
</A>
</TD>


<td bgcolor="" ALIGN=CENTER><div class="ad"><a href="<?php echo "$PHP_SELF?op=listings&client_id_filter=$rowGetClients->CLID";?>"><i class="fas fa-building" title="Match Listings to clients"></i></a></div></td>

	<td bgcolor=""><CENTER>
    <?php
  if ($rowGetClients->STATUS_CLIENT=="2"){
  if ($user_level >"1") { ?><a href="<?php echo "$PHP_SELF?op=client-active&clid=$rowGetClients->CLID&cluid=$rowGetClients->UID";?>"><?php }?><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/client-inactive.jpg"><?php if ($user_level >"1") { ?></a><?php }?><?php }
  if ($rowGetClients->STATUS_CLIENT!="2"){
  		if ($user_level >"1") { ?><a href="<?php echo "$PHP_SELF?op=client-inactive&clid=$rowGetClients->CLID&cluid=$rowGetClients->UID";?>"><?php }?><img border="0" hspace="2" vspace="0" width="16" height="16" src="../assets/images/client-active.jpg"><?php if ($user_level >"1") { ?></a><?php }?>
  <?php } ?>


<?php if ($rowGetClients->UID!="$uid") {?>
<?php
if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";}
}
 echo "<div class=ad><CENTER><NOBR> &nbsp;" . $rowGetClients->HANDLE . "'s</NOBR><BR>
 ";


 if ($rowGetClients->SHARE_WITH) {


$qustrgetshare = "SELECT `HANDLE` FROM `USERS` WHERE `GROUP`='$grid' AND `UID`='$rowGetClients->SHARE_WITH' LIMIT 1";
@ $qugetshare = mysqli_query($dbh, $qustrgetshare);
$rowgetshare = mysqli_fetch_object($qugetshare);

echo "<NOBR>&amp; ".$rowgetshare->HANDLE."</NOBR>";
 }


echo "</CENTER></DIV>";

if (isset($clients_filter_status_client) && $clients_filter_status_client !=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}

?>

<?php }?><div class="ad"><a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetClients->CLID";?>" TITLE="Edit/View <?php echo $rowGetClients->NAME_FIRST.$rowGetClients->NAME_LAST;?>"></a></CENTER>
</td>




	<td bgcolor=""><?php if ((($user_level>1) AND ($rowGetClients->UID=="$uid")) OR ((isset($isAdmin) OR ($user_level >="4")) AND ($rowGetClients->UID!="$uid"))){ ?><A HREF="<?php echo "$PHP_SELF?op=editClientReassign&clid=$rowGetClients->CLID&fname=$rowGetClients->NAME_FIRST&lname=$rowGetClients->NAME_LAST";?>><?php }?><img border="0" hspace="0" vspace="2" width="16" height="16" src="../assets/images/client-reassign.gif" TITLE="Reassign Client" ALT="Reassign Client">
  <?php if ((($user_level>1) AND ($rowGetClients->UID=="$uid")) OR ((isset($isAdmin) OR ($user_level >="4")) AND ($rowGetClients->UID!="$uid"))){ ?></A><?php }?></td>
<td bgcolor=""><?php if ($user_level>1) { ?><?php if ($rowGetClients->UID=="$uid") {?><div class="ad"><a href="<?php echo "$PHP_SELF?op=deleteClient&clid=$rowGetClients->CLID";?>"><i class="fas fa-times-circle"title="Delete Client"></i></a></div>
  <?php }?><?php }?><?php if (isset($isAdmin) OR ($user_level >="4")){?>
  <?php if ($rowGetClients->UID!="$uid") {?><div class="ad"><a href="<?php echo "$PHP_SELF?op=deleteClient&clid=$rowGetClients->CLID";?>"><i class="fas fa-times-circle" title="Delete Client"></i></a></div><?php }?><?php }?></td>
	</tr>

<?php

if (isset($rowGetUser) and ($rowGetUser->PREF_CLIENT_NOTES =="1")) {

if ($rowGetClients->CLIENT_NOTES) {
?>


<tr><TD COLSPAN=27" bgcolor=""><div class="ad">

<?php if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";} ?>

&nbsp;&nbsp;&nbsp; <?php echo $rowGetClients->CLIENT_NOTES;?>

<?php if ($rowGetClients->STATUS_CLIENT=="2"){echo "</FONT>";}?>

</DIV>
</TD>




</TR>

<?php }} ?>



<TR>

    	<?php
 if ($rowColor=="#F5F5DC" OR  isset($_SESSION["pref_row_color"]) AND $rowColor==$_SESSION["pref_row_color"]) {
    		$rowColor="#FFFFFF";
    	}else {

if (isset ($pref_row_color)){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
}
    }
    }?>
	</tr>
	</table>

</CENTER>
</TD></TR></TABLE>










		<CENTER>
<TABLE border=0><TR><TD style="font-size:15px;">

<NOBR>Viewing Clients
	<?php
if (!isset ($_GET["show_all_clients"])) {
		$display_bunch = $clients_limit_start + $clients_limit_n;
		if ($display_bunch > $clients_count) {
			$display_bunch = $clients_count;
		}
		$display_start = $clients_limit_start;
		if ($display_start == 0) {
			$display_start = 1;
		}
		?>
		<b><?php echo $display_start;?> - <?php echo $display_bunch;?></b> of <b><?php echo $clients_count;?></b>
		<?php if ($clients_count > $clients_limit_n) {?>

</NOBR></TD><TD style="font-size:15px;">

		&nbsp;&nbsp;&nbsp; go to page

</TD><FORM><TD style="font-size:15px;">


<select name="URL" onchange="window.location.href= this.form.URL.options[this.form.URL.selectedIndex].value">
		<?php $pageTop = ceil($clients_count / $clients_limit_n);
		for ($i=1;$i <= $pageTop;$i++) {
?>


<OPTION VALUE="<?php echo "$PHP_SELF?op=manageClients&clients_page=$i";?>" <?php if ($clients_page == $i) { echo " selected ";}?>><?php echo $i;?></OPTION>


		<?php } ?>
</select>

</TD>
</form>
<TD style="font-size:15px;">
<?php    

unset($_GET['clients_page']);
$url = http_build_query($_GET);    


?>
		&nbsp;&nbsp;&nbsp;<?php if (($clients_page) < ($clients_count / $clients_limit_n)) {
			$nextPage = $clients_page + 1;


					if ($clients_page != 1) {
		$prevPage = $clients_page - 1;
		}else{ $prevPage = ""; }


			if ($clients_page !="1") {
			?>
        
        
	<a class="btn btn-light"href="<?php echo "$PHP_SELF?".$url."&clients_page=$prevPage";?>">Back</a> &nbsp;&nbsp;&nbsp;
	<?php } ?>
	<a class="btn btn-light"href="<?php echo "$PHP_SELF?".$url."&clients_page=$nextPage";?>">Next</a>

		<?php } ?> &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-light"href="<?php echo "$PHP_SELF?".$url."&show_all_clients=1";?>">Show all Clients</a></NOBR>
		<?php }
	}?>


	</TD></TR></TABLE>
	</CENTER>


















	</CENTER>
<FONT SIZE="-3"><BR></FONT>
<!--END manageClients -->