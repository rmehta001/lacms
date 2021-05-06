<!--BEGIN createClient -->
<?php include ("../assets/buttons.php");
if (isset($pref_pagebg))
$pref_pagebg = $_SESSION["pref_pagebg"];
$pref_coltit = $_SESSION["pref_coltit"];

if(!isset($mi_year)){
    $mi_year = date("Y")-1;
}

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
?>
<table height="80"class="table table-info">
<tr border="0">
</tr>
<tr>
  <td align="CENTER">
  <font size="5">  <B>CREATE A NEW CLIENT</B></font><br>
  </td>
</tr>
</table>

<form action="<?php echo "$PHP_SELF?op=createClientDo";?>" method="POST">
<div class="container bg-light text-dark"><br>
    <h1 class="well">Client Information :</h1><br>
	<div class="col-lg-12 well">
	<div class="row">
				<form>
					<div class="col-sm-12">
						<div class="row">
              <div class="col-sm-6 form-group">
								<label>Client Status:</label>
                <select class="form-control"name="CLIENT_STATUS2" ID="CLIENT_STATUS2">
              					<option value="--">--</option>
              					<?php foreach ($DEFINED_VALUE_SETS['CLIENT_STATUS2'] as $cskey => $csValue) { ?>
              					<option value="<?php echo $cskey;?>"><?php echo $csValue;?></option>
              					<?php } ?>
              	</select>
              </div>
              <div class="col-sm-6 form-group">
                &nbsp;&nbsp;
                 &nbsp;&nbsp;
								<label>Active</label>
                &nbsp;&nbsp;
                 &nbsp;&nbsp;
                <input align="center"class="form-check-input" type="radio" name="status_client" value="option1" checked>
                &nbsp;&nbsp;
                <label>Inactive</label>
                &nbsp;&nbsp;
                 &nbsp;&nbsp;
                <input  class="form-check-input" type="radio" name="status_client" value="option2">
							</div>
            </div>
            <br>
              <div class="row">
                <?php
             		$dc_year = date("Y");
             		$dc_month = date("n");
             		$dc_day = date("j");
             		?>
             			<?php
             		$nc_year = date("Y");
             		$nc_month = date("n");
             		$nc_day = date("j");
             		?>
							<div class="col-sm-4 form-group">
								<label>Move In Date(Begin)</label>
                        <nobr><select name="mi_month" >

                           <option value="1" <?php if ($dc_month==1) { echo "selected";}?>>Jan</option>
                						<option value="2" <?php if ($dc_month==2) { echo "selected";}?>>Feb</option>
                						<option value="3" <?php if ($dc_month==3) { echo "selected";}?>>Mar</option>
                						<option value="4" <?php if ($dc_month==4) { echo "selected";}?>>April</option>
                						<option value="5" <?php if ($dc_month==5) { echo "selected";}?>>May</option>
                						<option value="6" <?php if ($dc_month==6) { echo "selected";}?>>Jun</option>
                						<option value="7" <?php if ($dc_month==7) { echo "selected";}?>>Jul</option>
                						<option value="8" <?php if ($dc_month==8) { echo "selected";}?>>Aug</option>
                						<option value="9" <?php if ($dc_month==9) { echo "selected";}?>>Sep</option>
                						<option value="10" <?php if ($dc_month==10) { echo "selected";}?>>Oct</option>
                						<option value="11" <?php if ($dc_month==11) { echo "selected";}?>>Nov</option>
                						<option value="12" <?php if ($dc_month==12) { echo "selected";}?>>Dec</option>
                         </select>

                	<select name="mi_day">

                		<option value="">--</option>

                						<?php for ($i=1;$i<=31;$i++) {?>
                						<option value="<?php echo $i;?>" <?php if ($dc_day==$i) { echo "selected";}?>><?php echo $i;?></option>
                						<?php } ?>
                         </select>
                	<select name="mi_year" >
                	<option value="">--</option>
                <?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>
                <option value="<?php echo $i;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
                <?php echo $i;?>
                </option>
                <option value="<?php echo $i+1;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
                <?php echo $i+1;?>
                </option><?php } ?>
              </select></nobr>
							</div>

              <div class="col-sm-4 form-group">
                <label>Move In Date(End)</label><br>
                      <nobr><select name="mie_month">
              						<option value="1" <?php if ($dc_month==1) { echo "selected";}?>>Jan</option>
              						<option value="2" <?php if ($dc_month==2) { echo "selected";}?>>Feb</option>
              						<option value="3" <?php if ($dc_month==3) { echo "selected";}?>>Mar</option>
              						<option value="4" <?php if ($dc_month==4) { echo "selected";}?>>April</option>
              						<option value="5" <?php if ($dc_month==5) { echo "selected";}?>>May</option>
              						<option value="6" <?php if ($dc_month==6) { echo "selected";}?>>Jun</option>
              						<option value="7" <?php if ($dc_month==7) { echo "selected";}?>>Jul</option>
              						<option value="8" <?php if ($dc_month==8) { echo "selected";}?>>Aug</option>
              						<option value="9" <?php if ($dc_month==9) { echo "selected";}?>>Sep</option>
              						<option value="10" <?php if ($dc_month==10) { echo "selected";}?>>Oct</option>
              						<option value="11" <?php if ($dc_month==11) { echo "selected";}?>>Nov</option>
              						<option value="12" <?php if ($dc_month==12) { echo "selected";}?>>Dec</option>
              						</select>
              			         <select name="mie_day" >

                  						<?php for ($i=1;$i<=31;$i++) {?>
                  						<option value="<?php echo $i;?>" <?php if ($dc_day==$i) { echo "selected";}?>><?php echo $i;?></option>
                  						<?php } ?>
                  						</select>

                      			<select name="mie_year">

                            <?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>
                            <option value="<?php echo $i;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
                            <?php echo $i;?>
                            </option>

                            <option value="<?php echo $i+1;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
                            <?php echo $i+1;?>
                            </option>
                						<?php } ?>
                          </select></nobr>
                      </div>

                </div>
          <!------------->
                <div class="row">
							           <div class="col-sm-4 form-group">
								         <label>Date Created:</label><br>
                              <nobr><select name="dc_month" >
                         						<option value="1" <?php if ($dc_month==1) { echo "selected";}?>>Jan</option>
                         						<option value="2" <?php if ($dc_month==2) { echo "selected";}?>>Feb</option>
                         						<option value="3" <?php if ($dc_month==3) { echo "selected";}?>>Mar</option>
                         						<option value="4" <?php if ($dc_month==4) { echo "selected";}?>>April</option>
                         						<option value="5" <?php if ($dc_month==5) { echo "selected";}?>>May</option>
                         						<option value="6" <?php if ($dc_month==6) { echo "selected";}?>>Jun</option>
                         						<option value="7" <?php if ($dc_month==7) { echo "selected";}?>>Jul</option>
                         						<option value="8" <?php if ($dc_month==8) { echo "selected";}?>>Aug</option>
                         						<option value="9" <?php if ($dc_month==9) { echo "selected";}?>>Sep</option>
                         						<option value="10" <?php if ($dc_month==10) { echo "selected";}?>>Oct</option>
                         						<option value="11" <?php if ($dc_month==11) { echo "selected";}?>>Nov</option>
                         						<option value="12" <?php if ($dc_month==12) { echo "selected";}?>>Dec</option>
                         						</select>
                         			        <select name="dc_day" >
                         						<?php for ($i=1;$i<=31;$i++) {?>
                         						<option value="<?php echo $i;?>" <?php if ($dc_day==$i) { echo "selected";}?>><?php echo $i;?></option>
                         						<?php } ?>
                         						</select>
                         			        <select name="dc_year" >
                         						<?php for ($i=(date("Y")-4);$i<=date("Y");$i++) {?>
                         						<option value="<?php echo $i;?>" <?php if ($dc_year==$i) { echo "selected";}?>><?php echo $i;?></option>
                         						<?php } ?>
                                  </select>
                                </nobr><br><br>
                                Subscribed to Daily Emails<br> & Newsletters: <input type="checkbox" name="newsletter_subscribe" <?php if(isset($rowGetClient))  if ($rowGetClient->NEWSLETTER_SUBSCRIBE=='2') { echo checked;} ?> value="2">
							           </div>
                         <div class="col-sm-4 form-group">
    								         <label>Next Contact Date:</label><br>
                              <NOBR><select name="nc_month">
                  						<option value="1" <?php if ($nc_month==1) { echo "selected";}?>>Jan</option>
                  						<option value="2" <?php if ($nc_month==2) { echo "selected";}?>>Feb</option>
                  						<option value="3" <?php if ($nc_month==3) { echo "selected";}?>>Mar</option>
                  						<option value="4" <?php if ($nc_month==4) { echo "selected";}?>>April</option>
                  						<option value="5" <?php if ($nc_month==5) { echo "selected";}?>>May</option>
                  						<option value="6" <?php if ($nc_month==6) { echo "selected";}?>>Jun</option>
                  						<option value="7" <?php if ($nc_month==7) { echo "selected";}?>>Jul</option>
                  						<option value="8" <?php if ($nc_month==8) { echo "selected";}?>>Aug</option>
                  						<option value="9" <?php if ($nc_month==9) { echo "selected";}?>>Sep</option>
                  						<option value="10" <?php if ($nc_month==10) { echo "selected";}?>>Oct</option>
                  						<option value="11" <?php if ($nc_month==11) { echo "selected";}?>>Nov</option>
                  						<option value="12" <?php if ($nc_month==12) { echo "selected";}?>>Dec</option>
                  						</select>
                  			      <select name="nc_day">
                  						<?php for ($i=1;$i<=31;$i++) {?>
                  						<option value="<?php echo $i;?>" <?php if ($nc_day==$i) { echo "selected";}?>><?php echo $i;?></option>
                  						<?php } ?>
                  						</select>

                  			      <select name="nc_year" >
                              <?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>
                              <option value="<?php echo $i+1;?>" <?php if ($nc_year==$i) { echo "selected";}?>>
                              <?php echo $i+1;?>
                              </option>
                              <option value="<?php echo $i;?>" <?php if ($nc_year==$i) { echo "selected";}?>>
                              <?php echo $i;?>
                              </option>
                  						<?php } ?>
                              </select></nobr>
                              <br><br>Share Client? &nbsp; <input type="checkbox" name="public" value="1" <?php if(isset($rowGetClient)) if ($rowGetClient->PUBLIC) { echo " checked "; } ?>>
                        </div>
                    </div>
              <!------------->
                  <div class="row">
                       <div class="col-sm-4 form-group">
                       <label>First Name:</label><br>
                       <input class="form-control"type="text" name="name_first" value="<?php if(isset($rowGetClient)) {echo $rowGetClient->NAME_FIRST;}?>">
                     </div>
                     <div class="col-sm-4 form-group">
                     <label>Last Name:</label><br>
                     <input class="form-control"type="text" name="name_last" value="<?php if(isset($rowGetClient)) {echo $rowGetClient->NAME_LAST;}?>">
                   </div>
                   <div class="col-sm-4 form-group">
                   <label>Interested In:</label><br>
                   <select class="form-control"name="type_pref" >
                   <!-- <?php while ($rowTypes = mysqli_fetch_object($quTypes)) {?>
                   <option value="<?php echo $rowTypes->TYPE;?>"><?php echo $rowTypes->TYPENAME;?></option>
                   <?php }?>
                   -->
                   <option value="1">Rental</option>
                   <option value="2">Sale</option>
                   <option value="3">Commercial Sale</option>
                   <option value="4">Commercial Rental</option>
                   <option value="5">Parking Spaces - Rent</option>
                   <option value="6">Parking Spaces - Sale</option>
                   <option value="7">Parking Spaces - Wanted</option>
                   <option value="8">Vacation Rental</option>
                   <option value="9">Rent To Own</option>
                   <option value="10">Business Opportunities</option>
                   <option value="11">Senior Living Rental</option>
                   <option value="12">Senior Living Sale</option>
                   <option value="13">Bank Owned</option>
           			   </select>
                </div>
              </div>
          <!---------------->
              <div class="row">
                  <div class="col-sm-4 form-group">
                  <label>Sub Type:</label><br>
                  <select class="form-control"name="client_subtype" >
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
              <div class="col-sm-4 form-group">
                 <label>Building Pref:</label><br>
                 <select class="form-control"name="building_pref[]" multiple SIZE="8">
     					   <option value="--">--</option>
     					   <?php foreach ($DEFINED_VALUE_SETS['BUILDING_TYPE'] as $bldkey => $bldValue) {
     						 $selected = ($rowGetClient->BUILDING_PREF==$bldkey) ? " selected " : "";?>
     					   <option value="<?php echo $bldkey;?>" <?php echo $selected;?>><?php echo $bldValue;?></option>
     					   <?php } ?>
     				     </select>
              </div>
          </div>
      <!------------------->
      <div class="row">
          <div class="col-sm-4 form-group">
          <label>Home Phone:</label><br>
          <input class="form-control"type="text" name="home_phone"value="<?php if(isset($rowGetClient)) echo $rowGetClient->HOME_PHONE;?>">
          </div>
          <div class="col-sm-4 form-group">
          <label>Work Phone:</label><br>
          <input class="form-control"type="text" name="work_phone" value="<?php if(isset($rowGetClient)) echo $rowGetClient->WORK_PHONE;?>">
          </div>
          <div class="col-sm-4 form-group">
          <label>Mobile Phone:</label><br>
          <input class="form-control"type="text" name="mobile_phone"value="<?php if(isset($rowGetClient)) echo $rowGetClient->MOBILE_PHONE;?>">
          </div>
    </div>
    <!------------------->
    <div class="row">
        <div class="col-sm-4 form-group">
        <label>Email:</label><br>
        <input class="form-control"type="text" name="client_email"value="<?php if(isset($rowGetClient)) echo $rowGetClient->CLIENT_EMAIL;?>">
        </div>
        <div class="col-sm-4 form-group">
        <label>Email: (Alternative)</label><br>
        <input class="form-control"type="text" name="client_email2"value="<?php if(isset($rowGetClient)) echo $rowGetClient->CLIENT_EMAIL2;?>">
        </div>
    </div>
    <!------------------->
    <div class="row">
        <div class="col-sm-4 form-group">
        <label>Address:</label><br>
        <input class="form-control"type="text" name="curaddress"value="<?php if(isset($rowGetClient)) echo $rowGetClient->CURADDRESS;?>">
        </div>
        <div class="col-sm-4 form-group">
        <label>City:</label><br>
        <input class="form-control"type="text" name="curcity" value="<?php if(isset($rowGetClient)) echo $rowGetClient->CURCITY;?>">
        </div>
        <div class="col-sm-1 form-group">
        <label>State:</label><br>
        <input class="form-control"type="text" name="curstate"value="<?php if(isset($rowGetClient)) echo $rowGetClient->CURSTATE;?>">
        </div>
        <div class="col-sm-3 form-group">
        <label>Zip:</label><br>
        <input class="form-control"type="text" name="curzip"value="<?php if(isset($rowGetClient)) echo $rowGetClient->CURZIP;?>">
        </div>
    </div>
    <!------------------->
    <div class="row">
        <div class="col-sm-2 form-group">
        <label># Of People:</label><br>
        <input class="form-control"type="text" name="num_people" value="<?php if(isset($rowGetClient)) echo $rowGetClient->NUM_PEOPLE;?>">
        </div>
        <div class="col-sm-2 form-group">
        <label>Client Type:</label><br>
          <select class="form-control"name="client_type">
          <option value="--">--</option>
          <?php foreach ($DEFINED_VALUE_SETS['CLIENT_TYPE'] as $ctkey => $ctValue) {
          $selected = ($rowGetClient->CLIENT_TYPE==$ctkey) ? " selected " : "";?>
          <option value="<?php echo $ctkey;?>" <?php echo $selected;?>><?php echo $ctValue;?></option>
          <?php } ?>
         </select>
        </div>
        <div class="col-sm-4 form-group">
        <label>Employment:</label><br>
          <select class="form-control"name="client_employment">
          <option value="--">--</option>
          <?php foreach ($DEFINED_VALUE_SETS['CLIENT_EMPLOYMENT'] as $cekey => $ceValue) {
          $selected = ($rowGetClient->CLIENT_EMPLOYMENT==$cekey) ? " selected " : "";?>
          <option value="<?php echo $cekey;?>" <?php echo $selected;?>><?php echo $ceValue;?></option>
          <?php } ?>
          </select>
        </div>
        <div class="col-sm-4 form-group">
        <label>Company Name:</label><br>
        <input class="form-control"type="text" name="curremploy" value="<?php if(isset($rowGetClient)) echo $rowGetClient->CURREMPLOY;?>">
        </div>
    </div>
    <!------------------->
    <div class="row">
        <div class="col-sm-4 form-group">
        <label>Price Minimum:</label><br>
        <input class="form-control"type="text" name="pricemin" placeholder="$"value="<?php if(isset($rowGetClient))  echo $rowGetClient->PRICEMIN;?>">
        </div>
        <div class="col-sm-4 form-group">
        <label>Price Maximum:</label><br>
        <input class="form-control"type="text" name="pricemax" placeholder="$"value="<?php if(isset($rowGetClient)) echo $rowGetClient->PRICEMAX;?>">
        </div>
        <div class="col-sm-4 form-group"><br><nobr>
        <label>Furnished</label>
        <input type="checkbox" name="client_furnished" value="1" <?php if(isset($rowGetClient)) if ($rowGetClient->CLIENT_FURNISHED) { echo " checked "; } ?>>
        <label>Short-Term</label>
        <input type="checkbox" name="client_shortterm" value="1" <?php if(isset($rowGetClient)) if ($rowGetClient->CLIENT_SHORTTERM) { echo " checked "; } ?>>
        <label>Lead Safe</label>
        <input type="checkbox" name="client_leadsafe" value="1" <?php if(isset($rowGetClient)) if ($rowGetClient->LEADSAFE) { echo " checked "; } ?>></nobr>
        </div>
    </div>
    <!------------------->
    <div class="row">
        <div class="col-sm-4 form-group">
        <label>Location preference(s):</label><br>
          <select class="form-control"name="loc_pref[]" multiple SIZE=8 >
        	<?php while ($rowFavLocs = mysqli_fetch_object($quFavLocs)) { ?>
        	<option value="<?php echo $rowFavLocs->LOCID;?>" <?php if (isset($rowGetAd) && $rowGetAd->LOC==$rowFavLocs->LOCID) {echo " selected"; $locSeled = true; }?>><?php echo $rowFavLocs->LOCNAME;?></option>
        	<?php } ?>
          <option value="0">--------------------</option>
        	<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>
        		<option value="<?php echo $rowLocs->LOCID; ?>" <?php if (isset($rowGetAd) && $rowGetAd->LOC==$rowLocs->LOCID && $locSeled == false) {echo " selected"; }?> >
        		<?php echo $rowLocs->LOCNAME; ?></option>
        	<?php }	?>
          </select>
        </div>
        <div class="col-sm-4 form-group">
        <label># of Bedrooms:</label><br>
        <select class="form-control"name="rooms_pref[]" multiple SIZE=8>
        <?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $roomkey => $roomval) { ?>
        <option value="<?php echo $roomkey;?>" ><?php echo $roomval;?></option>
        <?php }?>
        </select>
        </div>
        <div class="col-sm-2 form-group">
        <label># of Baths:</label><br>
        <select class="form-control"name="bath_pref[]" multiple  SIZE=8 >
        <?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bathkey => $bathval) { ?>
        <option value="<?php echo $bathkey;?>" ><?php echo $bathval;?></option>
        <?php }?>
        </select>
        </div>
        <div class="col-sm-2 form-group">
        <label>Pets preference:</label><br>
        <select class="form-control"name="pets_pref[]" multiple  SIZE=8 >
        <?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petskey => $petsval) { ?>
        <option value="<?php echo $petskey;?>"><?php echo $petsval;?></option>
        <?php }?>
        </select>
        </div>
    </div>
    <!------------------->
    <div class="row">
        <div class="col-sm-4 form-group">
        <label>Client Source:</label><br>
        <select class="form-control"name="SOURCE">
        <option value="--">--</option>
        <?php foreach ($DEFINED_VALUE_SETS['SOURCE'] as $skey => $sValue) {
        $selected = ($rowGetClient->SOURCE==$skey) ? " selected " : "";?>
        <option value="<?php echo $skey;?>" <?php echo $selected;?>><?php echo $sValue;?></option>
        <?php } ?>
      	</select>
        </div>
    </div>
    <!------------------->
    <div class="row">
      <div class="col-sm-12 form-group">
      <label>Additional Comments:</label><br>
      <textarea class="form-control"name="client_notes" rows="5" cols="150"><?php if(isset($rowGetClient)) echo $rowGetClient->CLIENT_NOTES;?></textarea>
      </div>
    </div>
    <!------------------->
    <div class="row">
        <div class="col-sm-3 form-group">
        <label>Appointment On:</label><br>
        <INPUT TYPE="date" NAME="SHOW_DATE" class="form-control">
        </div>
        <div class="col-sm-2 form-group">
        <label>Time:</label><br>
        <INPUT TYPE="time" NAME="SHOW_TIME" class="form-control">
        </div>
        <div class="col-sm-2 form-group">
        <label>Duration:</label><br>
        <select class="form-control"name="SHOW_LENGTH" id="SHOW_LENGTH">
        <option value="15">15 minutes</option>
        <option value="30">30 minutes</option>
        <option value="45">45 minutes</option>
        <option value="60">1 hour</option>
        <option value="90">1.5 hours</option>
        <option value="120">2 hours</option>
        <option value="180">3 hours</option>
        <option value="240">4 hours</option>
        </select>
        </div>
    </div>
    <br><h3 class="well">&nbsp;&nbsp;Accounting :</h3>
    <div class="row">
  				<form>
  					<div class="col-sm-12">
              <!-------------------------------->
  						<div class="row">
                <div class="col-sm-2">
                <label>Tenant fee paid:</label><br>
                    <input class="form-control"type="text" name="tenant_fee_paid" placeholder="$"value="<?php if(isset($rowGetClient)) echo $rowGetClient->TENANT_FEE_PAID;?>">
                  </div>
                  <div class="col-sm-2">
                  </div>
                  <div class="col-sm-4"><br>
                  <label>Fee Disclosure Given?</label>&nbsp;
                  <input type="checkbox" name="fee_disclosure" value="1" <?php if(isset($rowGetClient)) if ($rowGetClient->FEE_DISCLOSURE) { echo " checked "; } ?>>
                </div>
                <div class="col-sm-4"><br>
                  <A HREF="https://www.BostonApartments.com/rentips-fee-disclosure.htm" target="_NEW"><i class="fas fa-print"></i>Print Fee Disclosure</a>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-2">
                <label>First Month Paid</label><br>
                <input class="form-control"type="text" name="payment_first_paid" placeholder="$"value="<?php if(isset($rowGetClient)) echo $rowGetClient->PAYMENT_FIRST_PAID;?>">
                  </div>
                  <div class="col-sm-2">
                  </div>
                  <div class="col-sm-4"><br>
                  <label>Agency Disclosure Given?</label>&nbsp;
                  <input type="checkbox" name="agency_disclosure" value="1" <?php if(isset($rowGetClient)) if ($rowGetClient->AGENCY_DISCLOSURE) { echo " checked "; } ?>>
                </div>
                <div class="col-sm-4"><br>
                  <A HREF="https://www.BostonApartments.com/agencydisclosure.htm" target="_NEW"><i class="fas fa-print"></i>Print Agency Disclosure</a>
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-2">
                  <label>Last Month Paid</label><br>
                  <input class="form-control"type="text" name="payment_last_paid" placeholder="$" value="<?php if(isset($rowGetClient)) echo $rowGetClient->PAYMENT_LAST_PAID;?>">
                    </div>
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-4"><br>
                    <label>Credit Check Completed?</label>&nbsp;
                    <input type="checkbox" name="client_credit_check" placeholder="$"value="1" <?php if(isset($rowGetClient)) if ($rowGetClient->CLIENT_CREDIT_CHECK) { echo " checked "; } ?>>
                  </div>
                  <div class="col-sm-4"><br>
                    <A HREF="https://www.BostonApartments.com/leadlaw.htm" target="_NEW"><i class="fas fa-print"></i>Print Lead law Notice - Rentals</a>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-2">
                <label>Security deposit paid:</label><br>
                <input class="form-control"type="text" name="payment_sec_paid" placeholder="$" value="<?php if(isset($rowGetClient)) echo $rowGetClient->PAYMENT_SEC_PAID;?>">
                  </div>
                  <div class="col-sm-2">
                  </div>
                  <div class="col-sm-4">
                </div>
                <div class="col-sm-4"><br>
                  <A HREF="https://www.BostonApartments.com/rentips-leadlaw-notification-sale.htm" target="_NEW"><i class="fas fa-print"></i>Print Lead law Notice - Sales</a>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-2">
              <label>Key deposit paid:</label><br>
              <input class="form-control"type="text" name="key_dep_paid"placeholder="$" value="<?php if(isset($rowGetClient)) echo $rowGetClient->KEY_DEP_PAID;?>">
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2">
            <label>Cleaning deposit paid:</label><br>
            <input class="form-control"type="text" name="clean_dep_paid" placeholder="$"value="<?php if(isset($rowGetClient)) echo $rowGetClient->CLEAN_DEP_PAID;?>">
              </div>
              <div class="col-sm-2">
              </div>
              <div class="col-sm-3"><br>
                <label>Application status:</label><br>
                <select class="form-control"name="client_app_status">
                <option value="--">--</option>
                <?php foreach ($DEFINED_VALUE_SETS['CLIENT_APP_STATUS'] as $askey => $asValue) {
                  $selected = ($rowGetClient->CLIENT_APP_STATUS==$askey) ? " selected " : "";?>
                <option value="<?php echo $askey;?>" <?php echo $selected;?>><?php echo $asValue;?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <!------------------->
          <div class="row">
          </div>
    <!------------------->
    <div class="row">
      <div class="col-sm-4">
      </div>
        <div class="col-sm-4"><br>
        <input class="btn btn-primary"type="submit" value="Save"alt="SAVE">
      </div>
    </div>
  <!------------------------>
  </div>
  </form>
</div>
</div>
</div>

<!----------------------------------------------------------------------------->
