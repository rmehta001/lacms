<!--BEGIN editPrefs -->
<div class="container-fluid bg-secondary">
<br>
<div class="container bg-light">
<br>
<h1 class="text-center">Edit Preferences for <?php echo $_SESSION["handle"];?> from <?php echo $_SESSION["group"];?></h1><br />
<form action="<?php echo "$PHP_SELF?op=editPrefsDo"; ?>" method="post">
  <br>
<div class="row">
  <div class="col-md-3">
  <input type="submit" class="btn btn-success text-white"value=" Save Agent Preferences ">
</div>
  <div class="col-md-2">
        <!-- <input type="button" href="<?php echo "$PHP_SELF?op=changePassword";?>"TITLE="Click here to change your password" value="Change Password" class="btn btn-primary stretched-link"/>-->
         <nobr><a href="<?php echo "$PHP_SELF?op=changePassword";?>" TITLE="Click here to change your password" class="btn btn-primary stretched-link text-white ggggggg">Change Password</a></nobr>
  </div>
</div>
<br>
<div class="row">
<div class="col-md-12">
  <label><I class="text-danger">(You have to log out an log back in for some of the changes to your preferences to take place after you save. In some cases you may have to close your browser,)</i></label>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <label><NOBR>Default number of ads/listings to display on page:</label>
    <input class="form-control form-control-light"type="text" name="num_ads" value="<?php echo (isset ($rowGetUser) and ($rowGetUser->NUM_ADS)) ? $rowGetUser->NUM_ADS : '1' ;?>">
</div>
</div><br>
<div class="row">
  <div class="col-md-12">
    <label>Personal Signature (to be displayed optionally in the body of each ad, e.g. Call Pat: (617) 123-4567)</label>
    <textarea class="form-control" rows="4"name="user_sig"value="<?php echo (isset ($rowGetUser) and ($rowGetUser->USER_SIG));?>"></textarea>
    (No HTML accepted.)
  </div>
</div><br>
<div class="row">
  <div class="col-md-4">
    <label>First Name:</label>
    <!-- Amit Shrma debug <//?php echo ($rowGetUser->FNAME)?>; -->
     <input class="form-control"type="text" name="fname" placeholder="e.g. john"value="<?php echo (isset($rowGetUser) && isset($rowGetUser->FNAME)) ? $rowGetUser->FNAME : '1'; ?>">
  </div>
  <div class="col-md-4">
    <label>Last Name:</label>
    <input class="form-control"type="text" name="lname" placeholder="e.g. last name"value="<?php echo (isset($rowGetUser) && isset($rowGetUser->LNAME)) ? $rowGetUser->LNAME : '1';?>">
  </div>
  <div class="col-md-4">
    <label>Position:</label>
    <input class="form-control"type="text" name="position" placeholder="e.g. agent"value="<?php echo (isset($rowGetUser) && isset($rowGetUser->POSITION)) ? $rowGetUser->POSITION : '1'; ?>">
  </div>
</div><br>
<div class="row">
  <div class="col-md-4">
    <label>Cell Phone:</label>
    <input class="form-control"type="text" name="cellphone"placeholder="e.g. 123456789"value="<?php echo (isset($rowGetUser) && isset($rowGetUser->CELLPHONE)) ? $rowGetUser->CELLPHONE : '1'; ?>">
  </div>
  <div class="col-md-4">
    <label>Direct Line:</label>
    <input class="form-control"type="text" name="directline"placeholder="e.g. 123456789"value="<?php echo (isset($rowGetUser) && isset($rowGetUser->DIRECTLINE)) ? $rowGetUser->DIRECTLINE : '1'; ?>">
  </div>
  <div class="col-md-4">
    <label>E-mail:</label>
    <input class="form-control"type="text" name="email"placeholder="e.g. 123456789"value="<?php echo (isset ($rowGetUser) and ($rowGetUser->EMAIL)) ? htmlspecialchars($rowGetUser->EMAIL) : '1';?>">
  </div>
</div><br>

<div class="row">
  <div class="col-md-4">
    <label>Personal Website:</label>
    <input class="form-control"type="text" name="personal_website"placeholder="e.g. 123456789" value="<?php echo (isset ($rowGetUser) and ($rowGetUser->PERSONAL_WEBSITE)) ? htmlspecialchars($rowGetUser->PERSONAL_WEBSITE) : '1';?>"><p class="text-danger">(e.g. https://www.BostonApartments.com)</p>
  </div>
  <div class="col-md-4">
    <label>Facebook:</label>
    <input class="form-control"type="text" name="facebook"placeholder="e.g. 123456789"value="<?php echo (isset ($rowGetUser) and ($rowGetUser->FACEBOOK)) ? htmlspecialchars($rowGetUser->FACEBOOK) : '1';?>"><p class="text-danger">(e.g. https://www.facebook.com/pageName)</p>
  </div>
  <div class="col-md-4">
    <label>Twitter:</label>
    <input class="form-control"type="text" name="twitter"placeholder="e.g. 123456789"value="<?php echo (isset ($rowGetUser) and ($rowGetUser->TWITTER)) ? htmlspecialchars($rowGetUser->TWITTER) : '1';?>"><p class="text-danger">(e.g. http://www.Twitter.com/feedname)</p>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <label>My Space:</label>
    <input class="form-control"type="text" name="myspace"placeholder="e.g. 123456789" value="<?php echo (isset ($rowGetUser) and ($rowGetUser->MYSPACE)) ? htmlspecialchars($rowGetUser->MYSPACE) : '1';?>"><p class="text-danger">(e.g. http://www.myspace.com/pagename)</p>
  </div>
  <div class="col-md-4">
    <label>Linkedin:</label>
    <input class="form-control"type="text" name="linkedin"placeholder="e.g. 123456789"value="<?php echo (isset ($rowGetUser) and ($rowGetUser->LINKEDIN)) ? htmlspecialchars($rowGetUser->LINKEDIN) : '1';?>"><p class="text-danger">(e.g. http://www.linkedin.com/pagename)</p>
  </div>
  <div class="col-md-4">
    <label>Show Picture in Signature:</label>
    <select class="form-control" name="showpic_sig">
    <OPTION VALUE="2" <?php if (isset ($rowGetUser) and ($rowGetUser->SHOWPIC_SIG=="2")) { echo " selected "; }?>>No</OPTION>
    <OPTION VALUE="1" <?php if (isset ($rowGetUser) and ($rowGetUser->SHOWPIC_SIG=="1")) { echo " selected "; }?>>Yes</OPTION>
    </select>
  </div>
</div>
</div>
<br>
<div class="container bg-light">
  <br>
<div class="row">
  <div class="col-md-4">
    <label>Agent Type for Default Listings:</label>
    <select class="form-control"id="agent_type" name="agent_type">
    	<option value="" <?php if (isset ($rowGetUser) and ($rowGetUser->AGENT_TYPE=="")) { echo " selected"; }?> >No Preference</option>
    	<option value="1" <?php if (isset ($rowGetUser) and ($rowGetUser->AGENT_TYPE==1)) { echo " selected"; }?> >Rentals</option>
    	<option value="2" <?php if (isset ($rowGetUser) and ($rowGetUser->AGENT_TYPE==2)) { echo " selected"; }?> >Sales
    	<option value="3" <?php if (isset ($rowGetUser) and ($rowGetUser->AGENT_TYPE==3)) { echo " selected"; }?> >Commercial Sales
    	<option value="4" <?php if (isset ($rowGetUser) and ($rowGetUser->AGENT_TYPE==4)) { echo " selected"; }?> >Commercial Rentals
    	<option value="5" <?php if (isset ($rowGetUser) and ($rowGetUser->AGENT_TYPE==5)) { echo " selected"; }?> >Parking Spaces
    	<option value="8" <?php if (isset ($rowGetUser) and ($rowGetUser->AGENT_TYPE==8)) { echo " selected"; }?> >Vacations
    	<option value="9" <?php if (isset ($rowGetUser) and ($rowGetUser->AGENT_TYPE==9)) { echo " selected"; }?> >Rent To Own
    	<option value="10" <?php if (isset ($rowGetUser) and ($rowGetUser->AGENT_TYPE==10)) { echo " selected"; }?> >Business Opportunities
    	<option value="11" <?php if (isset ($rowGetUser) and ($rowGetUser->AGENT_TYPE==13)) { echo " selected"; }?> >Senior Rentals
    	<option value="12" <?php if (isset ($rowGetUser) and ($rowGetUser->AGENT_TYPE==12)) { echo " selected"; }?> >Senior Sales
    	<option value="13" <?php if (isset ($rowGetUser) and ($rowGetUser->AGENT_TYPE==13)) { echo " selected"; }?> >Bank Owned
      </select>
  </div>
  <div class="col-md-4">
    <label>Default View for Listings:</label>
    <select class="form-control" name="listview">
    <OPTION VALUE="">--</OPTION>
    <?php
    $quStrGetViews = "SELECT * FROM VIEWS WHERE GRID=$grid OR PUBLIC=1 ORDER BY NAME";
    $quGetViews = mysqli_query($dbh, $quStrGetViews) or die ($quStrGetViews);
    $quStrGetView = "SELECT * FROM VIEWS WHERE ID=$vid AND (GRID='$grid' OR PUBLIC=1)";
    $quGetView = mysqli_query ($dbh, $quStrGetView);
    $rowGetView = mysqli_fetch_array ($quGetView);
  	mysqli_data_seek ($quGetViews, 0);
    while ($rowGetViews = mysqli_fetch_object($quGetViews)) {?>
    <?php if ($rowGetViews->ID!=9 || $agcy>0) { ?>
    <option value="<?php if (isset ($rowGetUser)) echo $rowGetViews->ID;?>" <?php if (isset ($rowGetUser)) if ($rowGetUser->LISTVIEW==$rowGetViews->ID) { echo " selected "; }?>><?php if (isset ($rowGetUser)) echo $rowGetViews->NAME;?></option>
    <?php } ?><?php } ?>
    </select>
  </div>
  <div class="col-md-4">
    <label>Default Search For Listings:</label>
    <select class="form-control" name="listsearch">
    <OPTION VALUE="small" <?php if (isset ($rowGetUser)) if ($rowGetUser->LISTSEARCH=="small") { echo " selected "; }?>>Simple</OPTION>
    <OPTION VALUE="big" <?php if (isset ($rowGetUser)) if ($rowGetUser->LISTSEARCH=="big") { echo " selected "; }?>>Full</OPTION>
    <OPTION VALUE="mobile" <?php  if (isset ($rowGetUser)) if ($rowGetUser->LISTSEARCH=="mobile") { echo " selected "; }?>>Mobile</OPTION>
    <OPTION VALUE="none" <?php  if (isset ($rowGetUser)) if ($rowGetUser->LISTSEARCH=="none") { echo " selected "; }?>>none</OPTION>
    </select>
  </div>
</div><br>
<div class="row">
  <div class="col-md-4">
    <label>Show Search form on results:</label>
    <select class="form-control" name="listsearchshow">
    <OPTION VALUE="n" <?php  if (isset ($rowGetUser)) if ($rowGetUser->LISTSEARCHSHOW=="n") { echo " selected "; }?>>No</OPTION>
    <OPTION VALUE="y" <?php  if (isset ($rowGetUser)) if ($rowGetUser->LISTSEARCHSHOW=="y") { echo " selected "; }?>>Yes</OPTION>
    </select>
  </div>
  <div class="col-md-4">
    <label>Default Only Available Listings:</label>
    <select class="form-control" name="listactive">
    <OPTION VALUE="y" <?php  if (isset ($rowGetUser)) if ($rowGetUser->LISTACTIVE=="y") { echo " selected "; }?>>Yes</OPTION>
    <OPTION VALUE="n" <?php  if (isset ($rowGetUser)) if ($rowGetUser->LISTACTIVE=="n") { echo " selected "; }?>>No</OPTION>
    </select>
  </div>
  <div class="col-md-4">
    <label>Default only for New Listings:</label>
    <select class="form-control" name="actsto">
    <OPTION VALUE="ACT" <?php  if (isset ($rowGetUser)) if ($rowGetUser->ACTSTO=="ACT") { echo " selected "; }?>>Advertised</OPTION>
    <OPTION VALUE="STO" <?php  if (isset ($rowGetUser)) if ($rowGetUser->ACTSTO=="STO") { echo " selected "; }?>>Not Advertised</OPTION>
    </select>
  </div>
</div><br>
<div class="row">
  <div class="col-md-4">
    <label>Default for New Listings:</label>
    <select class="form-control" name="avlnew">
    <OPTION VALUE="A" <?php  if (isset ($rowGetUser)) if ($rowGetUser->AVLNEW=="A") { echo " selected "; }?>>Available</OPTION>
    <OPTION VALUE="U" <?php  if (isset ($rowGetUser)) if ($rowGetUser->AVLNEW=="U") { echo " selected "; }?>>Unavailable</OPTION>
    </select>
  </div>
  <div class="col-md-4">
    <label>Default Source for Listings:</label>
    <select class="form-control" name="sourcepref">
    <OPTION VALUE="$grid" <?php  if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREF=="$grid") { echo " selected "; }?>>Our Office Only</OPTION>
    <OPTION VALUE="1075" <?php  if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREF=="1075") { echo " selected "; }?>>MLS + Office</OPTION>
    <OPTION VALUE="1075A" <?php if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREF=="1075A") { echo " selected "; }?>>MLS Only</OPTION>
    <OPTION VALUE="BA" <?php if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREF=="BA") { echo " selected "; }?>>BostonApts Only</OPTION>
    <OPTION VALUE="YGL" <?php if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREF=="YGL") { echo " selected "; }?>>YGL Only</OPTION>
    <OPTION VALUE="ALL" <?php if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREF=="ALL") { echo " selected "; }?>>ALL Sources
    </select>
  </div>
  <div class="col-md-4">
    <label>Include MLS in Quick Search:</label>
    <select class="form-control" name="sourceprefquick">
    <OPTION VALUE="ALL" <?php if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREFQUICK=="ALL") { echo " selected "; }?>>All Sources</OPTION>
    <OPTION VALUE="NOMLS" <?php if (isset ($rowGetUser)) if ($rowGetUser->SOURCEPREFQUICK=="NOMLS") { echo " selected "; }?>>No MLS</OPTION>
    </select>
  </div>
</div><br>
<div class="row">
  <div class="col-md-4">
    <label>Default Town Listings:</label>
    <select class="form-control" name="mls_town_pref">
    <OPTION VALUE="1" <?php if (isset ($rowGetUser)) if (isset ($rowGetUser)) if ($rowGetUser->MLS_TOWN_PREF=="1") { echo " selected "; }?>>Only Cities/Towns <?php echo $_SESSION["group"];?> has listings</OPTION>
    <OPTION VALUE="2" <?php if (isset ($rowGetUser)) if (isset ($rowGetUser))  if ($rowGetUser->MLS_TOWN_PREF=="2") { echo " selected "; }?>>All MLS Towns/Cities</OPTION>
    </select>
  </div>
  <div class="col-md-4">
    <label>Show Landlord List on Search Forms:</label>
    <select class="form-control" name="pref_show_ll_search">
    <OPTION VALUE="0" <?php if (isset ($rowGetUser)) if (isset ($rowGetUser)) if ($rowGetUser->PREF_SHOW_LL_SEARCH=="0") { echo " selected "; }?>>Yes</OPTION>
    <OPTION VALUE="1" <?php if (isset ($rowGetUser)) if (isset ($rowGetUser)) if ($rowGetUser->PREF_SHOW_LL_SEARCH=="1") { echo " selected "; }?>>No</OPTION>
    </select>  </div>
  <div class="col-md-4">
    <label>Show shared clients in the Hot List:</label>
    <select class="form-control" name="listsharedc">
    <OPTION VALUE="y" <?php if (isset ($rowGetUser)) if ($rowGetUser->LISTSHAREDC=="y") { echo " selected "; }?>>Yes</OPTION>
    <OPTION VALUE="n" <?php if (isset ($rowGetUser)) if ($rowGetUser->LISTSHAREDC=="n") { echo " selected "; }?>>No</OPTION>
    </select>
  </div>
</div><br>
<div class="row">
  <div class="col-md-4">
    <label>Show shared listings in the Hot List:</label>
    <select class="form-control" name="listsharedl">
    <OPTION VALUE="y" <?php if (isset ($rowGetUser)) if ($rowGetUser->LISTSHAREDL=="y") { echo " selected "; }?>>Yes</OPTION>
    <OPTION VALUE="n" <?php if (isset ($rowGetUser)) if ($rowGetUser->LISTSHAREDL=="n") { echo " selected "; }?>>No</OPTION>
    </select>
  </div>
  <div class="col-md-4">
    <label>Show Pending Listings in the Hot List:</label>
    <select class="form-control" name="pref_show_pending_hotlist">
    <OPTION VALUE="0" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_SHOW_PENDING_HOTLIST=="0") { echo " selected "; }?>>Yes</OPTION>
    <OPTION VALUE="1" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_SHOW_PENDING_HOTLIST=="1") { echo " selected "; }?>>No</OPTION>
    </select>
  </div>
  <div class="col-md-4">
    <label>Show Landlords Needing Attenttion in the Hot List:</label>
    <select class="form-control" name="pref_show_ll_hl">
    <OPTION VALUE="0" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_SHOW_LL_HL=="0") { echo " selected "; }?>>Yes</OPTION>
    <OPTION VALUE="1" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_SHOW_LL_HL=="1") { echo " selected "; }?>>No</OPTION>
    </select>
  </div>
</div><br>
<div class="row">
  <div class="col-md-4">
    <?php if ((isset($isAdmin)) or ($user_level ==10)) { ?>
    <label>Show Other Agent's Appointments in the Hotlist:</label>
    <select class="form-control" name="pref_show_appt_o">
    <OPTION VALUE="0" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_SHOW_APPT_O=="0") { echo " selected "; }?>>Yes</OPTION>
    <OPTION VALUE="1" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_SHOW_APPT_O=="1") { echo " selected "; }?>>No</OPTION>
    </select>
    <?php } ?>
  </div>
  <div class="col-md-4">
  </div>
  <div class="col-md-4">
    <label>Get a CC of emails you send:</label>
    <select class="form-control" name="emailbcc">
    <OPTION VALUE="n" <?php if (isset ($rowGetUser)) if (isset ($rowGetUser)) if ($rowGetUser->EMAILBCC=="n") { echo " selected "; }?>>No</OPTION>
    <OPTION VALUE="y" <?php if (isset ($rowGetUser)) if (isset ($rowGetUser)) if ($rowGetUser->EMAILBCC=="y") { echo " selected "; }?>>Yes</OPTION>
    </select>
  </div>
</div><br>
</div>
<br>
<div class="container bg-light">
  <br>
<div class="row">
  <div class="col-md-8">
    <label>Default View for editing and composing Listings/Ads:</label>
    &nbsp;&nbsp;Simple&nbsp;&nbsp;<input type="radio" name="pref_adl_view" value="1" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_ADL_VIEW==1) { echo " checked "; }?>>&nbsp; Full&nbsp;&nbsp;<input type="radio" name="pref_adl_view" value="2" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_ADL_VIEW==2) { echo " checked "; }?>>
  </div>
</div><br>
</div>
<br>
<div class="container bg-light">
  <br>
<div class="row">
  <div class="col-md-4">
    <nobr><label>Auto Update Landlord when linked listing is updated:</label>
    <select  class="form-control"name="pref_auto_update_landlord">
  <OPTION VALUE="1" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_AUTO_UPDATE_LANDLORD=="1") { echo " selected "; }?>>Yes</OPTION>
  <OPTION VALUE="0" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_AUTO_UPDATE_LANDLORD=="0") { echo " selected "; }?>>No</OPTION>
</select></nobr>
  </div>
</div>
<br>
</div>
<br>
<div class="container bg-light">
  <br>
<div class="row">
  <div class="col-md-4">
    <nobr><label>Default View for Manage Clients:</label>
  &nbsp;&nbsp;  All Clients&nbsp;&nbsp;<input type="radio" name="pref_all_clients" value="0" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_ALL_CLIENTS==0) { echo " checked "; }?> >&nbsp;&nbsp; Only Active Clients&nbsp;&nbsp;<input type="radio" name="pref_all_clients" value="1" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_ALL_CLIENTS==1) { echo " checked "; }?>>
  </div>
</div><br>
<div class="row">
  <div class="col-md-4">
    <nobr><label>Show Client Notes on Manage Clients:</label>
      <select class="form-control" name="pref_client_notes">
      <OPTION VALUE="1" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_CLIENT_NOTES=="1") { echo " selected "; }?>>Yes</OPTION>
      <OPTION VALUE="2" <?php if (isset ($rowGetUser)) if ($rowGetUser->PREF_CLIENT_NOTES=="2") { echo " selected "; }?>>No</OPTION>
      </select>
  </div>
</div><br>
</div>
<br>
<div class="container bg-light">
  <br>
<div class="row">
  <div class="col-md-4">
      <A class="stretched-link"HREF="<?php echo "$PHP_SELF?op=editemailhfa";?>" TITLE="Edit User Email Template">Edit User Email Template</A>
  </div>
  <div class="col-md-4">
      <A class="stretched-link" HREF="<?php echo "$PHP_SELF?op=editColors";?>" TITLE="Click to Change the System Colors">Color Preferences - Click to Change</A>
  </div>
  <div class="col-md-4">
    <a class="stretched-link"href="<?php echo "$PHP_SELF?op=cl_settings_nowysiwyg_agent";?>">Craigslist Preferences &amp; Templates - Click to <br>Change</a>
  </div><br>
</div>
</div>
<br>
<div class="container bg-light">
  <br>
<div class="row">
  <div class="col-md-12">
    <label>Agent Biography (to be displayed optionally on the Meet The Agents Page)</label><br>
    <A HREF="<?php echo "$PHP_SELF?op=editPrefs-wysiwyg"; ?>">If you want to use a WYSIWYG HTML editor to control the bio, Click Here</A>
    <textarea class="form-control"name="bio" rows="10" cols="45"><?php if (isset ($rowGetUser)) echo htmlspecialchars($rowGetUser->BIO);?></textarea>
  </div><br>
</div><br>
</div>
<br>
<div class="container bg-light">
  <br>
<div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-8">
    <p class="text-danger"><I>(You have to log out an log back in for some of the changes to your preferences to take place after you save.)</I></p>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-4">
  </div>
  <div class="col-md-4">
    <input type="submit" class="btn btn-success text-white"value=" Save Agent Preferences ">
</div>
</div><br>
</div>
<br>
<div class="container bg-light">
  <form enctype="multipart/form-data" action="<?php echo "$PHP_SELF?op=uploadagentPreview";?>" method="POST">
  <input type="hidden" name="MAX_FILE_SIZE" value="10750000">
  <input type="hidden" name="uid" value="<?php echo $uid; ?>">
  <br>

  <h4 align="center">Upload Agent Picture for <?php echo $_SESSION["handle"];?></h4><br>

<div class="row">
  <div class="col-md-4">
  </div>
  <div class="col-md-4 form-group">
    <input name="userfile" type="file"class="form-control-file">
  </div>
</div>
<form enctype="multipart/form-data" action="<?php echo "$PHP_SELF?op=uploadagentPreview";?>" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="10750000">
<input type="hidden" name="uid" value="<?php echo $uid; ?>">
<div class="row">
  <div class="col-md-4">
  </div>
  <div class="col-md-4">
    <input type="submit" value="Upload / Update Agent Picture" class="btn btn-info">
  </div>
</div>
</form>
</form>
<?php  if (isset ($rowGetUser)) if ($rowGetUser->PICEXT != "") {?>

		<form action="<?php echo "$PHP_SELF?op=deleteagentPicDo"; ?>" method="POST">
		<input type="hidden" name="handle" value="<?php echo $handle;?>">
		<input type="hidden" name="uid" value="<?php echo $uid;?>">
		<input type="hidden" name="ext" value="<?php echo $rowGetUser->PICEXT;?>">
		<input type="submit" value="Delete Agent Picture" STYLE="Background-Color : #F5A9A9;">
		</FORM>

<?php }?>
<?php  if (isset ($rowGetUser)) if ($rowGetUser->PICEXT != "") {?>
<IMG SRC="https://www.BostonApartments.com/pics/<?php if (isset ($rowGetUser)) echo $rowGetUser->HANDLE;?>.<?php if (isset ($rowGetUser)) echo $rowGetUser->PICEXT;?>">
<?php }?><br>
</div><br>
</div>
