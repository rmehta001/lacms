<?php
$quStrGetUser2 = "SELECT * FROM USERS WHERE UID=$uid";
$quGetUser2 = mysqli_query($dbh, $quStrGetUser2);
$rowGetUser2 = mysqli_fetch_object($quGetUser2);
$k = 0;
if (!isset($cid)) {
    $cid = "";
}
if (!isset($clid)) {
    $clid = "";
}
if (!isset($did)) {
    $did = "";
}
if (!isset($lid)) {
    $lid = "";
}
if (!isset($pid)) {
    $pid = "";
}
if (isset($rowGetAd)) {
    $adCid = $rowGetAd->CID;
} else {
    $adCid = "";
}

if (isset($_SESSION['show_hot_list'])) {
    $_showHot = "n";
    $icon = "minus.gif";
} else {
    $_showHot = 1;
    $icon = "plus.gif";
}?>

<div class="container">
<div class="row">

<div class="col-sm-12  p-2">
  <h3 class="w3l_header"><span>Hot List</span></h3>
</div>
</div>
</div>
<div class="row">
  <div class="col-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-home"></i> Appointments</a>
      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa fa-users"></i> Client Leads</a>
      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa fa-book"></i> Ads From Others</a>
      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-book"></i> Ads Marked Pending</a>
      <a class="nav-link" id="v-pills-settings2-tab" data-toggle="pill" href="#v-pills-settings2" role="tab" aria-controls="v-pills-settings2" aria-selected="false"><i class="fa fa-star"></i> Hot List Clients</a>
		<a class="nav-link" id="v-pills-settings3-tab" data-toggle="pill" href="#v-pills-settings3" role="tab" aria-controls="v-pills-settings3" aria-selected="false"><i class="fa fa-user"></i> Clients Need Attention</a>
		<a class="nav-link" id="v-pills-settings4-tab" data-toggle="pill" href="#v-pills-settings4" role="tab" aria-controls="v-pills-settings4" aria-selected="false"><i class="fa fa-building"></i> Landlords Need Attention</a>
		<a class="nav-link" id="v-pills-settings5-tab" data-toggle="pill" href="#v-pills-settings5" role="tab" aria-controls="v-pills-settings5" aria-selected="false"><i class="fa fa-phone"></i> Deals Hot List</a>
		<a class="nav-link" id="v-pills-settings6-tab" data-toggle="pill" href="#v-pills-settings6" role="tab" aria-controls="v-pills-settings6" aria-selected="false"><i class="fa fa-calendar"></i> Today's Listings</a>
    <a class="nav-link" id="contact-tabagentreport" href="<?php echo "$PHP_SELF?op=agentreport"; ?>"><i class="fa fa-file"></i> Agent Activity Report</a>
    <a class="nav-link" id="contact-tabshowingsAgent" href="<?php echo "$PHP_SELF?op=showingsAgent"; ?>"><i class="fa fa-file-alt"></i> Agent Showing History</a>

    </div>
  </div>
  <div class="col-9">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
		<div class="row">

		<?php
$quStrGetappoint = "SELECT * FROM `CLIENTS` WHERE `SHOW_DATE` >= '$now' AND `GRID`=\"$grid\" AND `UID`=\"$uid\" ORDER BY `SHOW_DATE` ASC, `SHOW_TIME` ASC";
$StrGetappoint = mysqli_query($dbh, $quStrGetappoint) or die(mysqli_error());
$num_clientappt = mysqli_num_rows($StrGetappoint);
?>
			<div class="col-lg-12">

				<h2>Upcoming Client Appointments</h2>
				<p>Total: <?php echo $num_clientappt; ?></p>
				<a class="btn btn-info" href="<?php echo $PHP_SELF . "?op=manageClients"; ?>" target="_creater" title="Create A New Client Appointment"><i class="fa fa-plus"></i> Create New Client Appointment</a>
				<a href="<?php echo "$PHP_SELF?op=pastReminder"; ?>" class="btn btn-info" title="All Past Appointments & Reminders"><i class="fa fa-eye"></i> Past Appointments &amp; Reminders</a>

			</div>
			<div class="col-lg-12">
				<?php while ($rowappointget = mysqli_fetch_object($StrGetappoint)) {

    if ($rowappointget->CLIENT_EMAIL != "") {$emailremind = "<a href=\"'$PHP_SELF?op=mail_reminder&clid=$rowappointget->CLID'><img border='0' src='../images/clock_email.gif' alt='Email A Reminder' title='Email A Reminder'></a>";} else { $emailremind = "";}

    echo "<NOBR>
&nbsp;<a href=\"$PHP_SELF?op=deleteAppointmentconf&clid=$rowappointget->CLID\" TITLE=\"Cancel Appointment\"><img border=\"0\" src=\"../images/clock_delete.gif\" alt=\"Delete\" title=\"Cancel Appointment\"></a>&nbsp;

<a href=\"$PHP_SELF?op=editClient&clid=$rowappointget->CLID#appointment\" target=\"_cled$rowappointget->CLID\" TITLE=\"Edit Appointment\"><img border=0 src=\"../images/clock_edit.gif\" alt=\"edit\" TITLE=\"h: $rowappointget->HOME_PHONE w: $rowappointget->WORK_PHONE c: $rowappointget->MOBILE_PHONE\"></a>";
    ?>
                                    &nbsp;

                                    <a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowappointget->CLID"; ?>#appointment" TITLE="Edit/View <?php echo $rowappointget->NAME_FIRST . $rowappointget->NAME_LAST; ?>" target="_sh<?php echo $rowappointget->CLID; ?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History for <?php echo "$rowappointget->NAME_FIRST $rowappointget->NAME_LAST"; ?>" ALT="Showing History for <?php echo "$rowappointget->NAME_FIRST $rowappointget->NAME_LAST"; ?>"></a>

                                    <?php echo "<a href=\"$PHP_SELF?op=editClient&clid=$rowappointget->CLID\" target=\"_cled$rowappointget->CLID\" TITLE=\"h: $rowappointget->HOME_PHONE w: $rowappointget->WORK_PHONE c: $rowappointget->MOBILE_PHONE\">&nbsp;" . fuzDate($rowappointget->SHOW_DATE) . " <FONT COLOR=\"#0099FF\">@</FONT> " . $rowappointget->SHOW_TIME . " <FONT COLOR=\"#0099FF\">for</FONT> " . $rowappointget->SHOW_LENGTH . " <FONT COLOR=\"#0099FF\">minutes with</FONT> " . $rowappointget->NAME_FIRST . " " . $rowappointget->NAME_LAST . "</A>&nbsp;&nbsp;$emailremind</NOBR><BR>";

}

?>

                        </div>
			<hr>
<?php
$quStrGetremind = "SELECT * FROM `REMINDERS` WHERE `REMIND_DATE` >= '$now' AND `CLI`=\"$grid\" AND `UID`=\"$uid\" ORDER BY `REMIND_DATE` ASC";
$StrGetremind = mysqli_query($dbh, $quStrGetremind) or die(mysqli_error($dbh));
$num_addappt = mysqli_num_rows($StrGetremind);
?>

			<div class="col-lg-12">
			<h2>Additional Appointments &amp; Reminders</h2>
				<p>Total: <?php echo $num_addappt; ?></p>

			<a href="<?php echo "$PHP_SELF?op=createReminder"; ?>" target="_creater" title="Create Reminder" class="btn btn-info"><i class="fa fa-plus"></i> Create New Additional Reminder</a>
			</div>

							<div class="col-lg-12">

                                <?php
while ($rowremindget = mysqli_fetch_object($StrGetremind)) {

    echo "<NOBR>&nbsp;<a href=\"$PHP_SELF?op=deleteReminderconf&rid=$rowremindget->RID\" TITLE=\"Delete This Reminder\"><img border=\"0\" src=\"../images/clock_delete.gif\" alt=\"Delete\" title=\"Delete Reminder\"></a>&nbsp;";

    echo "<a href=\"$PHP_SELF?op=editReminder&rid=$rowremindget->RID\" target=\"_ored$rowremindget->RID\" title=\"Edit Appointment\"><img border=0 src=\"../images/clock_edit.gif\" alt=\"edit\" TITLE=\"Edit Appointment\">&nbsp;" . fuzDate($rowremindget->REMIND_DATE) . " <font COLOR='#999999'>@</font> " . $rowremindget->REMIND_TIME . " <font COLOR='#999999'>for</font> " . $rowremindget->REMIND_LENGTH . " <font COLOR='#999999'>minutes</font></a><br><font COLOR=\"#0099FF\">" . $rowremindget->REMIND . "</font><BR>";

}

?>
                        </div>


 <?php

if ($_SESSION["isAdmin"] or ($user_level == 10)) {

    if ($rowGetUser2->PREF_SHOW_APPT_O == "0") {

        $quStrGetappoint = "SELECT * FROM CLIENTS WHERE  `SHOW_DATE` >= '$now' AND `GRID`=\"$grid\" AND CLIENTS.UID !=\"$uid\" ORDER BY `SHOW_DATE` ASC, `SHOW_TIME` ASC";
        $StrGetappoint = mysqli_query($dbh, $quStrGetappoint) or die(mysqli_error($dbh));
        $num_clientappt = mysqli_num_rows($StrGetappoint);
        ?>

			<div class="col-lg-12">
			<h2>Upcoming Client Appointments For Other Agents</h2>
				<p>Total: <?php echo $num_clientappt; ?></p>

			<a href="<?php echo "$PHP_SELF?op=manageClients"; ?>" target="_creater" title="Create A New Client Appointment" class="btn btn-info"><i class="fa fa-plus"></i> CCreate A New Client Appointment</a>
			</div>

							<div class="col-lg-12">

                        <?php
while ($rowappointget = mysqli_fetch_object($StrGetappoint)) {

            $quStrGetagent = "SELECT HANDLE FROM USERS WHERE  $rowappointget->UID=UID LIMIT 1";
            $StrGetagent = mysqli_query($dbh, $quStrGetagent) or die(mysqli_error($dbh));
            while ($rowagent = mysqli_fetch_object($StrGetagent)) {

                echo "<NOBR>
&nbsp;<a href=\"$PHP_SELF?op=deleteAppointmentconf&clid=$rowappointget->CLID\" TITLE=\"Cancel Appointment\"><img border=\"0\" src=\"../images/clock_delete.gif\" alt=\"Delete\" title=\"Cancel Appointment\"></A>&nbsp;

<a href=\"$PHP_SELF?op=editClient&clid=$rowappointget->CLID#appointment\" target=\"_cled$rowappointget->CLID\" TITLE=\"Edit Appointment\"><img border=0 src=\"../images/clock_edit.gif\" alt=\"edit\" TITLE=\"h: $rowappointget->HOME_PHONE w: $rowappointget->WORK_PHONE c: $rowappointget->MOBILE_PHONE\"></A>";
                ?>
                                &nbsp;

                                <a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowappointget->CLID"; ?>#appointment" TITLE="Edit/View <?php echo $rowappointget->NAME_FIRST . $rowappointget->NAME_LAST; ?>" target="_sh<?php echo $rowappointget->CLID; ?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History for <?php echo "$rowappointget->NAME_FIRST $rowappointget->NAME_LAST"; ?>" ALT="Showing History for <?php echo "$rowappointget->NAME_FIRST $rowappointget->NAME_LAST"; ?>"></A>

                                <?php echo "<a href=\"$PHP_SELF?op=editClient&clid=$rowappointget->CLID\" target=\"_cled$rowappointget->CLID\" TITLE=\"h: $rowappointget->HOME_PHONE w: $rowappointget->WORK_PHONE c: $rowappointget->MOBILE_PHONE\">&nbsp;" . fuzDate($rowappointget->SHOW_DATE) . " <FONT COLOR=\"#0099FF\">@</FONT> " . $rowappointget->SHOW_TIME . " <FONT COLOR=\"#0099FF\">

with </FONT>" . $rowagent->HANDLE . "


<FONT COLOR=\"#0099FF\">for</FONT> " . $rowappointget->SHOW_LENGTH . " <FONT COLOR=\"#0099FF\">minutes with</FONT> " . $rowappointget->NAME_FIRST . " " . $rowappointget->NAME_LAST . "</A>&nbsp;&nbsp;$emailremind</NOBR><BR>";

                ?>


		<?php }}?>

	</div>

			<?php
$quStrGetremind = "SELECT * FROM REMINDERS WHERE `REMIND_DATE` >= '$now' AND `CLI`=\"$grid\" AND REMINDERS.UID !=\"$uid\" ORDER BY `REMIND_DATE` ASC";
        $StrGetremind = mysqli_query($dbh, $quStrGetremind) or die(mysqli_error($dbh));
        $num_addappto = mysqli_num_rows($StrGetremind);
        ?>
			<div class="col-lg-12">
			<h2>Additional Appointments &amp; Reminders For Other Agents</h2>
				<p>Total: <?php echo $num_addappto; ?></p>

			</div>


                       <div class="col-lg-12">

                            <?php
while ($rowremindget = mysqli_fetch_object($StrGetremind)) {

            $quStrGetagent = "SELECT HANDLE FROM USERS WHERE  $rowremindget->UID=UID LIMIT 1";
            $StrGetagent = mysqli_query($dbh, $quStrGetagent) or die(mysqli_error($dbh));
            while ($rowagent = mysqli_fetch_object($StrGetagent)) {

                echo "<NOBR>&nbsp;<a href=\"$PHP_SELF?op=deleteReminderconf&rid=$rowremindget->RID\" TITLE=\"Delete This Reminder\"><img border=\"0\" src=\"../images/clock_delete.gif\" alt=\"Delete\" title=\"Delete Reminder\"></a>&nbsp;";

                echo "<a href=\"$PHP_SELF?op=editReminder&rid=$rowremindget->RID\" target=\"_ored$rowremindget->RID\" TITLE=\"Edit Appointment\"><img border=0 src=\"../images/clock_edit.gif\" alt=\"edit\" TITLE=\"Edit Appointment\">&nbsp;" . fuzDate($rowremindget->REMIND_DATE) . " <FONT COLOR='#999999'>@</FONT> " . $rowremindget->REMIND_TIME . " <FONT COLOR='#999999'>

with </FONT>" . $rowagent->HANDLE . "<FONT COLOR=\"#0099FF\">


for</FONT> " . $rowremindget->REMIND_LENGTH . " <FONT COLOR='#999999'>minutes</FONT></A><BR><FONT COLOR=\"#0099FF\">" . $rowremindget->REMIND . "</FONT><BR>";

            }

        }

        ?>
                            </div>
<?php
}
}?>

		</div>
		</div>
      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
		  <div class="row">
			  <?php
if (isset($_SESSION['show_hot_list'])) {
    $quStrGetHotList = "select * from HOTS where ITEM_TYPE='1' and UID='$uid' and GRID='$grid' ORDER BY ITEM_NAME";
    $quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die(mysqli_error($dbh));
    $num_HotAds = mysqli_num_rows($quGetHotList);
    ?>
			  <div class="col-lg-12">
			  <h2>New Client Leads</h2>
				  <p>Listings/Ads Hot List : <?php echo $num_HotAds; ?></p>
			  </div>

			  <div class="col-lg-12">
				  <table class="table table-borderers" id="cell-design">
					  <tr>
					  <?php while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {
        ?>

                                    <td width="750">
                                        <?php
$quStrGetHotListAd = "select * from CLASS where CID='$rowGetHotList->ITEM_ID' and CLI='$grid'";
        $quGetHotListAd = mysqli_query($dbh, $quStrGetHotListAd) or die(mysqli_error($dbh));
        while ($rowGetHotListAd = mysqli_fetch_object($quGetHotListAd)) {
            ?>
										<?php if ($rowGetHotListAd->STATUS == "ACT") {
                // echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetHotList->ITEM_ID&return_page=hotlist'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/act.gif'></a>";
                echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetHotList->ITEM_ID&return_page=hotlist'><i class='fa fa-check-circle small' aria-hidden='true'></i></a>";
            } else {
                // echo "<a href='$PHP_SELF?op=activate&cid=$rowGetHotList->ITEM_ID&return_page=hotlist'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/inact.jpg'></a>";
                echo "<a href='$PHP_SELF?op=activate&cid=$rowGetHotList->ITEM_ID&return_page=hotlist'><i class='fa fa-times-circle small' aria-hidden='true'></i></a>";
            }?>


                                            <?php if ($rowGetHotListAd->STATUS_ACTIVE == "1") {?>

                                                <?php if ($user_level > 0) {?>

                                                    <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=" . $rowGetHotList->ITEM_ID . "&turn=unavailable&return_page=hotlist&return_page_div=" . $k; ?>">
                                                <?php }?>
                                                <!-- <img src="../assets/images/icons/a.jpg" border=0 height=14 width=14> -->
                                                <i class='fa fa-font small' aria-hidden='true'></i>
                                                <?php if ($user_level > 0) {?>
                                                    </a>
                                                <?php }?>

                                            <?php } else {?>
                                                <?php if ($user_level > 0) {?>
                                                    <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=" . $rowGetHotList->ITEM_ID . "&turn=available&return_page=hotlist&return_page_div=" . $k; ?>">
                                                <?php }?>
                                                <!-- <img src="../assets/images/icons/u.jpg" border=0 height=14 width=14> -->
                                                <i class='fa fa-underline small' aria-hidden='true'></i>
                                                <?php if ($user_level > 0) {?>
                                                    </a>
                                                <?php }?>
                                            <?php }?>

                                            <a href="<?php echo "$PHP_SELF?op=showinghistoryunit&cid=$rowGetHotList->ITEM_ID"; ?>" TITLE="Showing History" target="_sh<?php echo $rowGetHotListAd->CID; ?>">
                                                <!-- <img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Unit Showing History" ALT="Showing History for Unit"> -->
                                                <i class='fa fa-calendar small' aria-hidden='true'></i>
                                            </A>

                                            <a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetHotList->ITEM_ID"; ?>">
                                                <i class='fa fa-pen small' aria-hidden='true'></i>
                                                <!-- <img border=0 src="../images/icons/edit.gif" alt="edit"> -->
                                                <?php echo $rowGetHotList->ITEM_NAME; ?> <FONT SIZE="-1" COLOR='black'><B>- mod: <?php echo $rowGetHotListAd->MODBY; ?> on <?php echo $rowGetHotListAd->MOD; ?></FONT></a></a>


                                        <?php }?>


                                    </td><td width="5">
                                        &nbsp;&nbsp;&nbsp;
                                    </td><td ALIGN=RIGHT width="25">

                                        <?php if ($rowGetHotList->PUBLIC != "0") {echo "<FONT COLOR='black'>Shared</FONT>";} else {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}?>

                                    </td><td width="5">
                                        &nbsp;&nbsp;&nbsp;
                                    </td><td width="25">

                                        <a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=$op&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid"; ?>">
                                            <!-- <img border=0 src="../assets/images/icons/hotlist-del.gif" alt="delete from hot list" TITLE="Delete from Hot List"> -->
                                            <i class='fa fa-window-close small' aria-hidden='true'></i>
                                        </a>

                                    </td><td width="16">

                                        <a href="<?php echo "https://www.BostonApartments.com/plugin/?ad=$rowGetHotList->ITEM_ID&cli=$grid&uid=$uid\" target=\"_CL" . $rowGetHotList->ITEM_ID . "\""; ?>"><img width="18" height="18" border="0" vspace="0" hspace="0" src="../images/icons/craig.png" TITLE="Post to CL"></A>


<!--                                        <a href="--><?php //echo "$PHP_SELF?op=cl_managePics&cid=".$rowGetHotList->ITEM_ID."\" target=_cl".$adCid."><img width=\"16\" height=\"16\" border=\"0\" vspace=\"0\" hspace=\"0\" src=\"../images/icons/cl.gif\" alt=\"Post to Craigslist\" title=\"Post to Craigslist\"></a>";?>

</td></tr><tr>

	<?php }?>

</tr></table>
			  </div>
<?php }?>


		  </div>
		  </div>
      <div class="tab-pane fade cell-design" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
		<div class="row">

			<div class="col-lg-12">
			<?php if ($rowGetUser2->LISTSHAREDL == "y") {
    ?>
<?php
if (isset($_SESSION['show_hot_list'])) {
        $quStrGetHotList = "select * from HOTS where ITEM_TYPE='1' and UID!='$uid' and GRID='$grid' and PUBLIC!='0' ORDER BY ITEM_NAME";
        $quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die(mysqli_error($dbh));
        $num_HotAdsO = mysqli_num_rows($quGetHotList);
        ?>
	<h3>Listings/Ads From Others in the office</h3>
	<p>Total: <?php echo $num_HotAdsO; ?></p>

<table class="table table-bordered" id="cell-design">
	<tr>

                                    <?php
while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {
            $quStrGetHotListAd = "select * from CLASS where CID='$rowGetHotList->ITEM_ID' and CLI='$grid'";
            $quGetHotListAd = mysqli_query($dbh, $quStrGetHotListAd) or die(mysqli_error($dbh));
            while ($rowGetHotListAd = mysqli_fetch_object($quGetHotListAd)) {
                ?>


                                    <td width="740">

                                        <?php if ($rowGetHotListAd->STATUS == "ACT") {
                    //echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetHotList->ITEM_ID&return_page=hotlist'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/act.gif'></a>";
                                             echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetHotList->ITEM_ID&return_page=hotlist'><i class='fa fa-check-circle small' aria-hidden='true'></i></a>";
                } else {
                    //echo "<a href='$PHP_SELF?op=activate&cid=$rowGetHotList->ITEM_ID&return_page=hotlist'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/inact.jpg'></a>";
                     echo "<a href='$PHP_SELF?op=activate&cid=$rowGetHotList->ITEM_ID&return_page=hotlist'><i class='fa fa-times-circle small' aria-hidden='true'></i></a>";
                }

                if ($rowGetHotListAd->STATUS_ACTIVE == "1") {
                    if ($user_level > 0) {?>

                                                <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=" . $rowGetHotList->ITEM_ID . "&turn=unavailable&return_page=hotlist&return_page_div=" . $k; ?>">
                                            <?php }?>
                                            <img src="../assets/images/icons/a.jpg" border=0 height=14 width=14>
                                            <?php if ($user_level > 0) {?>
                                                </a>
                                            <?php }?>

                                        <?php } else {?>
                                            <?php if ($user_level > 0) {?>
                                                <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=" . $rowGetHotList->ITEM_ID . "&turn=available&return_page=hotlist&return_page_div=" . $k; ?>">
                                            <?php }?>
                                            <!-- <img src="../assets/images/icons/u.jpg" border=0 height=14 width=14> -->
                                            <i class="fa fa-underline small" aria-hidden="true"></i>
                                            <?php if ($user_level > 0) {?>
                                                </a>
                                            <?php }}?>


                                        <a href="<?php echo "$PHP_SELF?op=showinghistoryunit&cid=$rowGetHotList->ITEM_ID"; ?>" TITLE="Showing History" target="_sh<?php echo $rowGetHotList->ITEM_ID; ?>">
                                            <!-- <img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Unit Showing History" ALT="Showing History for Unit">-->
                                            <i class="fa fa-calendar small" aria-hidden="true"></i>
                                            </A> 

                                        <a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetHotList->ITEM_ID"; ?>">
                                            <!-- <img border=0 src="../images/icons/edit.gif" alt="edit"> -->
                                            <i class="fa fa-pen small" aria-hidden="true"></i>
                                            <?php echo $rowGetHotList->ITEM_NAME; ?> <B><FONT SIZE="-1" COLOR='black'>- mod: <?php echo $rowGetHotListAd->MODBY; ?> on <?php echo $rowGetHotListAd->MOD; ?></FONT></B></A>
                                        <?php }?>
                                    </td><td width="5">
                                        &nbsp;&nbsp;&nbsp;
                                    </td><td ALIGN=RIGHT width="25">

                                        <?php if ($rowGetHotList->PUBLIC != "0") {echo "<FONT COLOR='black'>Shared</FONT>";} else {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}?>

                                        <?php if ($_SESSION["isAdmin"] or ($user_level == 10)) {?>
                                    </td><td width="5">
                                        &nbsp;&nbsp;&nbsp;
                                    </td><td width="25">
                                        <a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=$op&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid"; ?>"><img border=0 src="../assets/images/icons/hotlist-del.gif" alt="delete from hot list" TITLE="Delete from Hot List"></a>
                                        <?php }?>


                                    </td><td width="16">

                                        <a href="<?php echo "https://www.BostonApartments.com/plugin/?ad=$rowGetHotList->ITEM_ID&cli=$grid&uid=$uid\" target=\"_CL" . $rowGetHotList->ITEM_ID . "\""; ?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif"></A>

                                        <!-- <a href="<?php echo "$PHP_SELF?op=cl_managePics&cid=" . $rowGetHotList->ITEM_ID . "\" target=_cl" . $rowGetHotList->ITEM_ID . "><img width=\"16\" height=\"16\" border=\"0\" vspace=\"0\" hspace=\"0\" src=\"../images/icons/cl.gif\" alt=\"Post to Craigslist\" title=\"Post to Craigslist\"></a>"; ?> -->

                                    </td></tr><tr>

                                    <?php }?>
                                    <?php }?>

                                </tr></table>

	<?php } else {?>
	Not found !

                            <?php }?>
			</div>

		  </div>
		</div>
      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
		<?php

if ($rowGetUser2->PREF_SHOW_PENDING_HOTLIST == "0") {

    if (isset($_SESSION['show_hot_list'])) {
        $quStrGetListing = "select * from ((CLASS INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) where CLI='$grid' and STATUS_PENDING!='0'";
        $quGetListing = mysqli_query($dbh, $quStrGetListing) or die(mysqli_error($dbh));
        $num_Pending = mysqli_num_rows($quGetListing);
        ?>
		  <div class="row">

			  <div class="col-lg-12">
			  <h2>Listings/Ads Marked Pending 
                <!-- <img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="16" width="16" alt="Pending Status - Yes" title="Pending Status = YES - Check Status"></h2> -->
              <i class="fa fa-product-hunt" aria-hidden="true"></i></h2>
				  <p>Total : <?php echo $num_Pending; ?></p>

			  </div>
			  <div class="col-lg-12">
			  <table class="table table-bordered" id="cell-design">
                    <?php
while ($rowGetListing = mysqli_fetch_object($quGetListing)) {
            ?>
                        <tr>
                        <td width="700" ">
                        <nobr>
                            <?php if ($rowGetListing->STATUS_PENDING == "1") {?>
                                <?php if ($user_level > 0) {?>
                                <a href="<?php echo "$PHP_SELF?op=mark_status_pending&cid=" . $rowGetListing->CID . "&turn=pendingno&return_page=hotlist&return_page_div=" . $k; ?>">
                            <?php }?>
                                <img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="16" width="16" alt="Pending Status - Yes" TITLE="Pending Status Yes - Click to change Pending Status">
                                <?php if ($user_level > 0) {?>
                                </a>
                            <?php }?>
                            <?php }?>


                            <?php if ($rowGetListing->STATUS == "ACT") {
                echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetListing->CID&return_page=hotlist'>
              <img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/act.gif'>
                </a>";
            } else {
                echo "<a href='$PHP_SELF?op=activate&cid=$rowGetListing->CID&return_page=hotlist'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/inact.jpg'></a>";
            }?>


                            <?php if ($rowGetListing->STATUS_ACTIVE == "1") {?>

                                <?php if ($user_level > 0) {?>

                                    <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=" . $rowGetListing->CID . "&turn=unavailable&return_page=hotlist&return_page_div=" . $k; ?>">
                                <?php }?>
                                <img src="../assets/images/icons/a.jpg" border=0 height=14 width=14>
                                <?php if ($user_level > 0) {?>
                                    </a>
                                <?php }?>

                            <?php } else {?>
                                <?php if ($user_level > 0) {?>
                                    <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=" . $rowGetListing->CID . "&turn=available&return_page=hotlist&return_page_div=" . $k; ?>">
                                <?php }?>
                                <img src="../assets/images/icons/u.jpg" border=0 height=14 width=14>
                                <?php if ($user_level > 0) {?>
                                    </a>
                                <?php }?>
                            <?php }?>


                            <a href="<?php echo "$PHP_SELF?op=showinghistoryunit&cid=$rowGetListing->CID"; ?>" TITLE="Showing History" target="_sh<?php echo $rowGetListing->CID; ?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Unit Showing History" ALT="Showing History for Unit"></a>


                            <a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetListing->CID"; ?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetListing->TYPENAME; ?> - <?php echo $rowGetListing->LOCNAME; ?> - $<?php echo $rowGetListing->PRICE; ?> - <?php echo $rowGetListing->STREET_NUM; ?> <?php echo $rowGetListing->STREET; ?> #<?php echo $rowGetListing->APT; ?> - Listing #<?php echo $rowGetListing->CID; ?> - mod: <?php echo $rowGetListing->MODBY; ?> on <?php echo $rowGetListing->MOD; ?></a>
                        </nobr>

                    </td>
                    </tr>
                    <?php }?>
                </table>
			  </div>
			  </div>

                <?php }?>
		  <?php } else {?>
		  Not Found !
		  <?php }?>
		   </div>

      <div class="tab-pane fade" id="v-pills-settings2" role="tabpanel" aria-labelledby="v-pills-settings2-tab">
		<div class="row">

			 <?php if (isset($_SESSION['show_hot_list'])) {
    $quStrGetHotList = "select * from HOTS where ITEM_TYPE='3' and UID='$uid' and GRID='$grid'";
    $quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die(mysqli_error($dbh));
    $num_hot_clients = mysqli_num_rows($quGetHotList);
    ?>




			<div class="col-lg-12">
			 <h2>Hot List Clients</h2>
				<p>Total: <?php echo $num_hot_clients; ?></p>
			</div>
			<div class="col-lg-12">
			<table class="table table-bordered" id="cell-design">


                    <?php
$rowColor = isset($_SESSION["pref_row_color"]) ? $_SESSION["pref_row_color"] : "#F5F5DC";

    while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {

        $quStrGetClientH = "select * from CLIENTS where CLID='$rowGetHotList->ITEM_ID' and UID='$uid' and GRID='$grid' LIMIT 1";
        $quGetClientH = mysqli_query($dbh, $quStrGetClientH) or die(mysqli_error($dbh));

        while ($rowGetClientH = mysqli_fetch_object($quGetClientH)) {
            ?>
                            <tr bgcolor="<?php echo $rowColor; ?>">
                                <td width="400">

                                        <a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetHotList->ITEM_ID"; ?>">
                                            <!-- <img border=0 src="../images/icons/edit.gif" alt="edit"> -->
                                            <i class="fa fa-pen small" aria-hidden="true"></i>
                                            <?php echo $rowGetHotList->ITEM_NAME; ?></a>

                                </td>

                                <td  style="font-size:14px;" width="30">

                                        <?php echo $rowGetClientH->DATE_NEXT_CONTACT; ?><BR>
                                        <?php
foreach ($DEFINED_VALUE_SETS['CLIENT_STATUS2'] as $cskey => $csValue) {

                if ($rowGetClientH->CLIENT_STATUS2 == "$cskey") {
                    echo "<NOBR>$csValue</NOBR>";
                }
            }
            ?>

                                </td>


                                <td width="16" align="center">

                                        <?php
if ($rowGetClientH->CLIENT_EMAIL != "") {
                echo "<A HREF=\"$PHP_SELF?op=mail_client&clid=$rowGetHotList->ITEM_ID\" target=\"_email$rowGetHotList->ITEM_ID\"><IMG src=../images/icons/email.gif border=0 HEIGHT=15 width=22></A>";
            } else {
                echo "&nbsp;";
            }
            ;?>

                                    </td>

                                <td align="center"  width="16">
                                        <a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetHotList->ITEM_ID"; ?>#appointment" title="Make Appointment with <?php echo $rowGetHotList->ITEM_NAME; ?>"><img border="0" hspace="0" vspace="0" width="19" height="19" src="../images/clock.gif" title="Make an Appointment" ALT="Make an Appointment"></a>
                                </td>


                                <td align=center width="16">

                                        <a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowGetHotList->ITEM_ID"; ?>" title="Showing History for <?php echo $rowGetHotList->ITEM_NAME; ?>" target="_sh<?php echo $rowGetHotList->ITEM_NAME; ?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" title="Showing History" ALT="Showing History"></a>
                                </td>
                                <td alight="center" width="19"><div class="ad"><a href="<?php echo "$PHP_SELF?op=listings&client_id_filter=$rowGetHotList->ITEM_ID"; ?>"><img border="0" hspace="2" vspace="0" width="19" height="19" src="../assets/images/matchlistings.gif" title="Match Client to Listings" ALT="Match Client to Listings"></a></div></td>
                                <td alight="right" width="20">

                                    <?php if ($rowGetClientH->PUBLIC != "0") {echo "<div class=\"controltext\"><FONT COLOR='#999999'>Shared</FONT></div>";} else {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}?>

                                </td>


                                <td width="5">

                                    <?php if (($rowGetClientH->UID == "$uid") or (($_SESSION["isAdmin"] or ($user_level >= "4")) and ($rowGetClientH->UID != "$uid"))) {?><a href="<?php echo "$PHP_SELF?op=editClientReassign&clid=$rowGetClientH->CLID&fname=$rowGetClientH->NAME_FIRST&lname=$rowGetClientH->NAME_LAST"; ?>"><?php }?><img border="0" hspace="0" vspace="2" width="16" height="16" src="../assets/images/client-reassign.gif" title="Reassign Client" alt="Reassign Client"><?php if (($rowGetClientH->UID == "$uid") or (($_SESSION["isAdmin"] or ($user_level >= "4")) and ($rowGetClientH->UID != "$uid"))) {?></a><?php }?>

                                </td>


                                <td width="16">
                                    <a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=hotlist&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid"; ?>"><img border=0 src="../assets/images/icons/hotlist-del.gif" alt="delete from hot list"></a>


                                </td>
                            </tr>
                        <?php }?>


                        <?php
if ($rowColor == "#F5F5DC" or isset($_SESSION["pref_row_color"]) and $rowColor == $_SESSION["pref_row_color"]) {
            $rowColor = "#FFFFFF";
        } else {

            $rowColor = isset($_SESSION["pref_row_color"]) ? $_SESSION["pref_row_color"] : "#F5F5DC";
        }
    }?>

                </table>
			</div>
		<?php } else {?>
		Not Found !
            <?php }?>

		  </div>
		  </div>
      <div class="tab-pane fade" id="v-pills-settings3" role="tabpanel" aria-labelledby="v-pills-settings3-tab">
		<div class="row">
			<?php if (isset($_SESSION['show_hot_list'])) {
    ?>
			<div class="col-lg-12">
			 <?php
if ($_SESSION["isAdmin"] or ($user_level == 10)) {
        $quStrGetneedatt1 = "SELECT * FROM CLIENTS where STATUS_CLIENT='1' AND DATE_NEXT_CONTACT<='$now' and GRID='$grid' ORDER BY DATE_NEXT_CONTACT";
        $quGetneedatt1 = mysqli_query($dbh, $quStrGetneedatt1) or die(mysqli_error($dbh));
        $num_clients_needatt1 = mysqli_num_rows($quGetneedatt1);

        $quStrGetneedatt = "SELECT * FROM CLIENTS where STATUS_CLIENT='1' AND DATE_NEXT_CONTACT<='$now' and GRID='$grid' ORDER BY DATE_NEXT_CONTACT limit 50";
        $quGetneedatt = mysqli_query($dbh, $quStrGetneedatt) or die(mysqli_error($dbh));
        $num_clients_needatt = mysqli_num_rows($quGetneedatt);

    } else {

        $quStrGetneedatt1 = "SELECT * FROM CLIENTS where STATUS_CLIENT='1' AND DATE_NEXT_CONTACT<='$now' and GRID='$grid' AND UID='$uid' ORDER BY DATE_NEXT_CONTACT";
        $quGetneedatt1 = mysqli_query($dbh, $quStrGetneedatt1) or die(mysqli_error($dbh));
        $num_clients_needatt1 = mysqli_num_rows($quGetneedatt1);

        $quStrGetneedatt = "SELECT * FROM CLIENTS where STATUS_CLIENT='1' AND DATE_NEXT_CONTACT<='$now' and GRID='$grid' AND UID='$uid' ORDER BY DATE_NEXT_CONTACT LIMIT 50";
        $quGetneedatt = mysqli_query($dbh, $quStrGetneedatt) or die(mysqli_error($dbh));
        $num_clients_needatt = mysqli_num_rows($quGetneedatt);
    }

    ?>

            <h1>Active Clients Needing Attention</h1>
				<p>Total: <?php echo $num_clients_needatt1;
    if ($num_clients_needatt1 > 50) {echo " <i>1st 50 showing</i>";} ?></p>


            <table class="table table-bordered" id="cell-design">
                <?php
$rowColor = isset($_SESSION["pref_row_color"]) ? $_SESSION["pref_row_color"] : "#F5F5DC";

    while ($rowGetneedatt = mysqli_fetch_object($quGetneedatt)) {
        ?>

                <tr bgcolor="<?php echo $rowColor; ?>">
					<td width="400">

                            <a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetneedatt->CLID"; ?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo "$rowGetneedatt->NAME_FIRST $rowGetneedatt->NAME_LAST"; ?></a>


                            <?php
if (($_SESSION["isAdmin"] or ($user_level == 10)) and ($rowGetneedatt->UID != $uid)) {

            $quStrGetneedagent = "SELECT HANDLE, UID FROM USERS where USERS.UID='$rowGetneedatt->UID' LIMIT 1";
            $quGetneedagent = mysqli_query($dbh, $quStrGetneedagent) or die(mysqli_error($dbh));
            while ($rowGetneedagent = mysqli_fetch_object($quGetneedagent)) {
                ;

                echo " | <FONT size=-1><I> $rowGetneedagent->HANDLE</I></FONT>";
            }
        }
        ?>


                    </td>



                    <td  style="font-size:14px;" width="30">
                        <div class="controltext">
                            <NOBR><?php echo $rowGetneedatt->DATE_NEXT_CONTACT; ?></NOBR><BR>
                            <?php
foreach ($DEFINED_VALUE_SETS['CLIENT_STATUS2'] as $cskey => $csValue) {

            if ($rowGetneedatt->CLIENT_STATUS2 == "$cskey") {
                echo "<NOBR>$csValue</NOBR>";
            }
        }
        ?>
                        </div>
                    </td>

                    <td width="16" align="center">
                            <?php

        if ($rowGetneedatt->CLIENT_EMAIL) {

            echo "<A HREF=\"$PHP_SELF?op=mail_client&clid=$rowGetneedatt->CLID\" target=\"_email$rowGetneedatt->CLID\"><IMG src=../images/icons/email.gif border=0 HEIGHT=15 width=22></A>";
        } else {
            echo "&nbsp;";
        }

        ;?>

                         </td>

                    <td align="center" width="16">
                            <a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetneedatt->CLID"; ?>#appointment" TITLE="Make Appointment with <?php echo "$rowGetneedatt->NAME_FIRST  $rowGetneedatt->NAME_LAST"; ?>" target="appt<?php echo $rowGetneedatt->CLID; ?>"><img border="0" hspace="0" vspace="0" width="19" height="19" src="../images/clock.gif TITLE="Make an Appointment" ALT="Make an Appointment"></a>
                    </td>


                    <td align="center" width="16">

                            <a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowGetneedatt->CLID"; ?>" TITLE="Showing History for <?php echo "$rowGetneedatt->NAME_FIRST $rowGetneedatt->NAME_LAST"; ?>" target="_sh<?php echo $rowGetneedatt->CLID; ?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History" ALT="Showing History"></a>
                    </td>

                    <td align="center" width="19"><div class="ad">
						<a href="<?php echo "$PHP_SELF?op=listings&client_id_filter=$rowGetneedatt->CLID"; ?>" target="match<?php echo $rowGetneedatt->CLID; ?>"><img border="0" hspace="2" vspace="0" width="19" height="19" src="../assets/images/matchlistings.gif" TITLE="Match Client to Listings" ALT="Match Client to Listings"></a>
						</div>
					</td>

                    <td align="center" width="25">

                        <?php if ($rowGetneedatt->PUBLIC != "0") {echo "<div class=\"controltext\"><FONT COLOR='black'>Shared</FONT></div>";} else {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}?>

                    </td>
					<td width="5">

                        <?php if (($rowGetneedatt->UID == "$uid") or (($_SESSION["isAdmin"] or ($user_level >= "4")) and ($rowGetneedatt->UID != "$uid"))) {?><A HREF="<?php echo "$PHP_SELF?op=editClientReassign&clid=$rowGetneedatt->CLID&fname=$rowGetneedatt->NAME_FIRST&lname=$rowGetneedatt->NAME_LAST"; ?>"><?php }?><img border="0" hspace="0" vspace="2" width="16" height="16" src="../assets/images/client-reassign.gif" TITLE="Reassign Client" ALT="Reassign Client"><?php if (($rowGetneedatt->UID == "$uid") or (($_SESSION["isAdmin"] or ($user_level >= "4")) and ($rowGetneedatt->UID != "$uid"))) {?></A><?php }?>

                    </td>
					<td width="16">
                        <?php
if ($rowGetneedatt->STATUS_CLIENT == "2") {
            if ($user_level > "1") {?><a href="<?php echo "$PHP_SELF?op=client-active&clid=$rowGetneedatt->CLID&cluid=$rowGetneedatt->UID&return=hotlist"; ?>"><?php }?><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/client-inactive.jpg"><?php if ($user_level > "1") {?></a><?php }?><?php }
        if ($rowGetneedatt->STATUS_CLIENT != "2") {
            if ($user_level > "1") {?><a href="<?php echo "$PHP_SELF?op=client-inactive&clid=$rowGetneedatt->CLID&cluid=$rowGetneedatt->UID&return=hotlist"; ?>"><?php }?><img border="0" hspace="2" vspace="0" width="16" height="16" src="../assets/images/client-active.jpg"><?php if ($user_level > "1") {?></a><?php }?>
                        <?php }?>

                    </td>
				</tr>

                    <?php
if ($rowColor == "#F5F5DC" or isset($_SESSION["pref_row_color"]) and $rowColor == $_SESSION["pref_row_color"]) {
            $rowColor = "#FFFFFF";
        } else {

            $rowColor = isset($_SESSION["pref_row_color"]) ? $_SESSION["pref_row_color"] : "#F5F5DC";
        }
    }?>

				</table>

			</div>
                    <?php }?>

		  </div>
		</div>
      <div class="tab-pane fade" id="v-pills-settings4" role="tabpanel" aria-labelledby="v-pills-settings4-tab">
		<?php
if ($user_level >= 1) {
    if ($rowGetUser2->PREF_SHOW_LL_HL == "0") {

        ?>
		  <div class="row">
			  <?php $quStrGetllneedatt1 = "SELECT * FROM LANDLORD where NEXT_CONTACT<='$now' and GRID='$grid'";
        $quGetllneedatt1 = mysqli_query($dbh, $quStrGetllneedatt1) or die(mysqli_error($dbh));
        $num_ll_needatt1 = mysqli_num_rows($quGetllneedatt1);

        $quStrGetllneedatt = "SELECT * FROM LANDLORD where NEXT_CONTACT<='$now' and GRID='$grid' ORDER BY NEXT_CONTACT LIMIT 50";
        $quGetllneedatt = mysqli_query($dbh, $quStrGetllneedatt) or die(mysqli_error($dbh));
        $num_ll_needatt = mysqli_num_rows($quGetllneedatt);
        ?>
			  <div class="col-lg-12">
			  <h2>Landlords Needing Attention</h2>
				  <p>Total : <?php echo $num_ll_needatt1;
        if ($num_ll_needatt1 > 50) {echo " <i>1st 50 showing</i>";} ?></p>

			  </div>
			  <div class="col-lg-12">

			  </div>

		  </div>



<table class="table table-bordered" id="cell-design">
<?php

        $rowColor = isset($_SESSION["pref_row_color"]) ? $_SESSION["pref_row_color"] : "#F5F5DC";

        while ($rowGetllneedatt = mysqli_fetch_object($quGetllneedatt)) {
            ?>

    <tr bgcolor="<?php echo $rowColor; ?>">
		<td width="400">
            <div class="controltext">
                <a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowGetllneedatt->LID"; ?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo "$rowGetllneedatt->SHORT_NAME $rowGetllneedatt->HOME_NAME_FIRST $rowGetllneedatt->HOME_NAME_LAST"; ?></a>

            </div>
        </td>

        <td  style="font-size:14px;" width="30">
            <div class="controltext">

                <?php
foreach ($DEFINED_VALUE_SETS['LAST_CONTACT_ACTION'] as $lcakey => $lcaValue) {

                if ($rowGetllneedatt->LAST_CONTACT_ACTION == "$lcakey") {
                    echo "<NOBR>$lcaValue</NOBR><BR>";
                }
            }
            ?>
                <NOBR><?php echo $rowGetllneedatt->LAST_CONTACTED; ?></NOBR><BR>

            </div>
        </td>

        <td  style="font-size:14px;" width="30">
            <div class="controltext">
                <NOBR><?php echo $rowGetllneedatt->NEXT_CONTACT; ?></NOBR><BR>
            </div>
        </td>


        <td ALIGN=CENTER  width="16">
			<div class="ad">
                <?php

            if ($rowGetllneedatt->OFF_PHONE) {
                echo "<NOBR>O: $rowGetllneedatt->OFF_PHONE</NOBR>";}

            if (($rowGetllneedatt->OFF_PHONE) and ($rowGetllneedatt->HOME_PHONE)) {echo "<BR>";}

            if ($rowGetllneedatt->HOME_PHONE) {
                echo "<NOBR>H: $rowGetllneedatt->HOME_PHONE</NOBR>";
            }?>

            </div>
        </td>


        <td width="16"><div class="controltext"><CENTER>
                    <?php
echo "<NOBR>";

            if ($rowGetllneedatt->OFF_EMAIL) {
                echo "O: <A HREF=\"mailto:$rowGetllneedatt->OFF_EMAIL\"><IMG src=../images/icons/email.gif border=0 HEIGHT=10 width=16></A>";
            } else {
                echo "&nbsp;";
            }

            if (($rowGetllneedatt->OFF_EMAIL) and ($rowGetllneedatt->LL_EMAIL)) {echo "<BR>";}

            if ($rowGetllneedatt->LL_EMAIL) {
                echo "H: <A HREF=\"mailto:$rowGetllneedatt->LL_EMAIL\"><IMG src=../images/icons/email.gif border=0 HEIGHT=10 width=16></A>";
            } else {
                echo "&nbsp;";
            }

            echo "</NOBR>";

            if ($rowColor == "#F5F5DC" or isset($_SESSION["pref_row_color"]) and $rowColor == $_SESSION["pref_row_color"]) {
                $rowColor = "#FFFFFF";
            } else {

                $rowColor = isset($_SESSION["pref_row_color"]) ? $_SESSION["pref_row_color"] : "#F5F5DC";
            }

        }

        ?>

                </CENTER></div></td>




    </tr>

</table>

		  <?php
}
}
?>
		</div>
      <div class="tab-pane fade" id="v-pills-settings5" role="tabpanel" aria-labelledby="v-pills-settings5-tab">
		<div class="row">
		  <?php if (isset($_SESSION['show_hot_list'])) {
    ?>
			<?php

    $quStrGetHotList = "select * from HOTS where ITEM_TYPE='2' and UID='$uid' and GRID='$grid'";
    $quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die(mysqli_error($dbh));
    $num_DS = mysqli_num_rows($quGetHotList);
    ?>
			<div class="col-lg-12">
			<h2>Deals Hot List</h2>
				<p>Total: <?php echo $num_DS; ?></p>
			</div>
			<div class="col-lg-12">
			<table class="table table-bordred" id="cell-design">
					<?php
while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {?>

				<tr>
                        <td width="650">

                            <a href="<?php echo "$PHP_SELF?op=editDeal&did=$rowGetHotList->ITEM_ID&cid=$rowGetHotList->ITEM_ID2"; ?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME; ?></a>
                        </td><td width="5">
                            &nbsp;&nbsp;&nbsp;
                        </td>
					<td align="right" width="25">

                            <?php if ($rowGetHotList->PUBLIC != "0") {echo "<FONT COLOR='#999999'>Shared</FONT>";} else {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}?>

                        </td>
					<td width="5">
                            &nbsp;&nbsp;&nbsp;
                        </td>
					<td width="25">

                            <a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=hotlist&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid"; ?>"><img border=0 src="../assets/images/icons/hotlist-del.gif" alt="delete from hot list"><br>

                        </td>
				</tr>


                        <?php }?>

                   </table>
			</div>
			<?php
$quStrGetHotList = "select * from HOTS where ITEM_TYPE='2' and UID!='$uid' and GRID='$grid' and PUBLIC!='0'";
    $quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die(mysqli_error($dbh));
    $num_DSO = mysqli_num_rows($quGetHotList);
    ?>
			<div class="col-lg-12">
			<h2>Deal Sheets Shared From Others in the office</h2>
				<p>Total: <?php echo $num_DSO; ?></p>
			</div>
			<div class="col-lg-12">
			<?php
if (isset($_SESSION['show_hot_list'])) {

        ?>
                <BR>

                <table border=0 width="700">
					<tr>
                        <?php
while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {?>

                        <td width="650">

                            <a href="<?php echo "$PHP_SELF?op=editDeal&did=$rowGetHotList->ITEM_ID&cid=$rowGetHotList->ITEM_ID2"; ?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME; ?></a>
                        </td>
						<td width="5">
                            &nbsp;&nbsp;&nbsp;
                        </td>
						<td  align="right" width="25">
                            <?php if ($rowGetHotList->PUBLIC != "0") {echo "<FONT COLOR='#999999'>Shared</FONT>";} else {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}?>

                            <?php if ($_SESSION["isAdmin"] or ($user_level == 10)) {?>
                        </td>
						<td width="5">
                            &nbsp;&nbsp;&nbsp;
                        </td>
						<td width="16">
                            <a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=$op&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid"; ?>"><img border=0 src="../assets/images/icons/hotlist-del.gif" alt="delete from hot list"></a>
                            <?php } else {?>


                        </td><td width="5">
                            &nbsp;&nbsp;&nbsp;
                        </td><td width="5">
                            &nbsp;
                            <?php }?>


                        </td></tr><tr>
                        <?php }?>
                    </tr>
					</table>
                        <?php }?>
			</div>

		  <?php } else {?>
			Not Found !
			<?php }?>
		  </div>
		</div>
      <div class="tab-pane fade" id="v-pills-settings6" role="tabpanel" aria-labelledby="v-pills-settings6-tab">
		  <div class="row">
			  <?php if (isset($_SESSION['show_hot_list'])) {
    ?>
			  <div class="col-lg-12">

        <?php

    $quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where DATEIN='$now' and CLI='$grid' ORDER BY CLASS.TYPE, LANDLORD, LOC, StrEET, StrEET_NUM, APT LIMIT 100";
    $quGetTodays = mysqli_query($dbh, $quStrGetTodays) or die(mysqli_error($dbh));
    $num_TNL = mysqli_num_rows($quGetTodays);

    $quStrGetTodays1 = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where DATEIN='$now' and CLI='$grid' ORDER BY CLASS.TYPE, LANDLORD, LOC, StrEET, StrEET_NUM, APT";
    $quGetTodays1 = mysqli_query($dbh, $quStrGetTodays1) or die(mysqli_error($dbh));
    $num_TNL1 = mysqli_num_rows($quGetTodays1);

    ?>

				  <h2>TODAY'S LISTING ADDITIONS <img src="../assets/images/icons/a.jpg" border=0 height=12 width=12> &amp; <img src="../assets/images/icons/u.jpg" border=0 height=12 width=12></h2>
				  <p>Total: <?php echo $num_TNL1; ?> <i>1st 50 showing</i></p>
				  <p><a href="<?php echo "$PHP_SELF?op=hotlist-3days"; ?>">Last 3 Day's Listings (Click for list)</a></p>
				  <p><a href="<?php echo "$PHP_SELF?op=hotlist-1week"; ?>">Current Week's Listings (Click for list)</a></p>



                <table class="table table-bordered" id="cell-design">
					<tr>
                        <?php
while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {
        ?>
                        <td>
							<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID"; ?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
                                        <?php if ($rowGetTodays->STATUS == "ACT") {
            echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetTodays->CID&return_page=hotlist&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/act.gif'></a>";
        } else {
            echo "<a href='$PHP_SELF?op=activate&cid=$rowGetTodays->CID&return_page=hotlist&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/inact.jpg'></a>";
        }?>

                                        <?php if ($rowGetTodays->STATUS_ACTIVE == "1") {?>

                                            <?php if ($user_level > 0) {?>

                                                <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=" . $rowGetTodays->CID . "&turn=unavailable&return_page=hotlist&return_page_div=" . $k; ?>">
                                            <?php }?>
                                            <img src="../assets/images/icons/a.jpg" border=0 height=14 width=14>
                                            <?php if ($user_level > 0) {?>
                                                </a>
                                            <?php }?>

                                        <?php } else {?>
                                            <?php if ($user_level > 0) {?>
                                                <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=" . $rowGetTodays->CID . "&turn=available&return_page=hotlist&return_page_div=" . $k; ?>">
                                            <?php }?>
                                            <img src="../assets/images/icons/u.jpg" border=0 height=14 width=14>
                                            <?php if ($user_level > 0) {?>
                                                </a>
                                            <?php }?>
                                        <?php }?>

                                        <a href="<?php echo "https://www.BostonApartments.com/plugin/?ad=$rowGetTodays->CID&cli=$grid&uid=$uid\" target=\"_CL" . $rowGetHotList->ITEM_ID . "\""; ?>"><img width="12" height="12" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif"></a> &nbsp;
                                        <?php echo "$rowGetTodays->TYPENAME"; ?> - <?php echo $rowGetTodays->LOCNAME; ?>&nbsp;
                                        <?php echo $rowGetTodays->ROOMS; ?> Beds-<?php echo $rowGetTodays->BATH; ?> Bath - <?php echo $rowGetTodays->StrEET_NUM; ?> <?php echo $rowGetTodays->StrEET; ?> <?php echo $rowGetTodays->APT; ?> -
                                        $<?php echo $rowGetTodays->PRICE; ?> | <?php echo $rowGetTodays->SHORT_NAME; ?> | Mod:<?php echo $rowGetTodays->MODBY; ?></a>

                        </td>
					</tr>
					<tr>
                        <?php }?>
                    </tr>
					</table>
                <BR>


                <?php
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where CLASS.MOD='$now' and DATEIN!='$now' and CLI='$grid' AND STATUS_ACTIVE='1' ORDER BY CLASS.TYPE, LANDLORD, LOC, StrEET, StrEET_NUM, APT";
    $quGetTodays = mysqli_query($dbh, $quStrGetTodays) or die(mysqli_error($dbh));
    $num_TMAL = mysqli_num_rows($quGetTodays);
    ?>

                <h2>TODAY'S MODIFIED AVAILABLE <img src="../assets/images/icons/a.jpg" border=0 height=12 width=12> LISTINGS:</h2>
					<p>Total: <?php echo $num_TMAL; ?></p>
                <table border=0 width="100%"><tr>
                        <?php	while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {
        ?>
                        <td>

                                <a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID"; ?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
                                    <?php if ($rowGetTodays->STATUS == "ACT") {
            echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetTodays->CID&return_page=hotlist&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/act.gif'></a>";
        } else {
            echo "<a href='$PHP_SELF?op=activate&cid=$rowGetTodays->CID&return_page=hotlist&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/inact.jpg'></a>";
        }?>


                                    <a href="<?php echo "https://www.BostonApartments.com/plugin/?ad=$rowGetTodays->CID&cli=$grid&uid=$uid\" target=\"_CL" . $rowGetHotList->ITEM_ID . "\""; ?>"><img width="12" height="12" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif"></a>

                                    <!-- <a href="<?php echo "$PHP_SELF?op=cl_managePics&cid=" . $rowGetTodays->CID . "\" target=_cl" . $rowGetTodays->CID . "><img width=\"16\" height=\"16\" border=\"0\" vspace=\"0\" hspace=\"0\" src=\"../images/icons/cl.gif\" alt=\"Post to Craigslist\" title=\"Post to Craigslist\"></a>"; ?> -->

                                    &nbsp;
                                    <?php echo "$rowGetTodays->TYPENAME"; ?> -  <?php echo $rowGetTodays->LOCNAME; ?>&nbsp;
                                    <?php echo $rowGetTodays->ROOMS; ?> Beds-<?php echo $rowGetTodays->BATH; ?> Bath - <?php echo $rowGetTodays->StrEET_NUM; ?> <?php echo $rowGetTodays->StrEET; ?> <?php echo $rowGetTodays->APT; ?> -
                                    $<?php echo $rowGetTodays->PRICE; ?> | <?php echo $rowGetTodays->SHORT_NAME; ?> | Mod:<?php echo $rowGetTodays->MODBY; ?></a>

                        </td>
					</tr>
					<tr>
                        <?php }?>
                    </tr>
					</table>

                <BR>
                <?php
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where CLASS.MOD='$now' and DATEIN!='$now' and CLI='$grid' AND STATUS_ACTIVE!='1' ORDER BY CLASS.TYPE, LANDLORD, LOC, StrEET, StrEET_NUM, APT";
    $quGetTodays = mysqli_query($dbh, $quStrGetTodays) or die(mysqli_error($dbh));
    $num_TMUL = mysqli_num_rows($quGetTodays);
    ?>

					<h2>TODAY'S MODIFIED <FONT COLOR="RED">UN</FONT>AVAILABLE <img src="../assets/images/icons/u.jpg" border=0 height=12 width=12> LISTINGS:</h2>
					<p>Total: <?php echo $num_TMUL; ?></p>

                <table border=0 width="100%"><tr>
                        <?php while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {
        ?>
                        <td>

                                <a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID"; ?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
                                    <?php if ($rowGetTodays->STATUS == "ACT") {
            echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetTodays->CID&return_page=hotlist&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/act.gif'></a>";
        } else {
            echo "<a href='$PHP_SELF?op=activate&cid=$rowGetTodays->CID&return_page=hotlist&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='14' height='14' src='../assets/images/inact.jpg'></a>";
        }?>
                                    &nbsp;
                                    <?php echo "$rowGetTodays->TYPENAME"; ?> - <?php echo $rowGetTodays->LOCNAME; ?>&nbsp;
                                    <?php echo $rowGetTodays->ROOMS; ?> Beds-<?php echo $rowGetTodays->BATH; ?> Bath - <?php echo $rowGetTodays->StrEET_NUM; ?> <?php echo $rowGetTodays->StrEET; ?> <?php echo $rowGetTodays->APT; ?> -
                                    $<?php echo $rowGetTodays->PRICE; ?> | <?php echo $rowGetTodays->SHORT_NAME; ?> | Mod:<?php echo $rowGetTodays->MODBY; ?> | # <?php echo $rowGetTodays->CID; ?></a>

                        </td>
					</tr>
					<tr>

                        <?php }?>
                    </tr>
					</table>
			  </div>
			  <div class="col-lg-12"></div>
		  <?php }?>
		  </div>
		  </div>
    </div>
  </div>
</div>


<div class="container-fluid">
	<div class="row">



	</div>
</div>



<!--END Hotlist -->