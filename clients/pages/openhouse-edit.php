
<?php
$ID = $_GET['ID'];
$query = "SELECT * FROM OPENHOUSE WHERE ID=$ID";
$res = mysqli_query($dbh, $query) or die(mysqli_error($dbh));
$r = mysqli_fetch_assoc($res);
if (isset($_POST['CID']))
    $cid = $_POST['CID'];
$cli = $grid;

$oh_year = substr($r['DATE'], 0, 4);
$oh_month = substr($r['DATE'], 5, 2);
$oh_day = substr($r['DATE'], 8, 2);

$START_HOUR = $r['START_HOUR'];
$START_MINS = $r['START_MINS'];
$START_MER = $r['START_MER'];

$END_HOUR = $r['END_HOUR'];
$END_MINS = $r['END_MINS'];
$END_MER = $r['END_MER'];
$comments = $r['COMMENTS'];
?>

<table style="text-align:center" height="70"class="table table-info">

    <tr>
        <td align="CENTER">
            <font size="5">  <B>EDIT AN OPEN HOUSE LISTING</B></font><br>
        </td>
    </tr>
</table>

<form action="<?php echo "$PHP_SELF?op=openhouse-editDo"; ?>" method="POST">

    <TABLE class="container bg-light text-lg-left"><TR><TD>


                Open House ID#

            </TD><TD>

                <INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo $r['ID']; ?>">

                <?php echo $r['ID']; ?>

            </TD></TR><tr><td><BR></td></tr><TR><TD>


                Listing ID#

            </TD><TD>


                <?php echo $r['CID']; ?>

            </TD></TR><tr><td><BR></td></tr><TR><TD>



                Open House Date:

            </TD><TD>

                <select name="oh_month" STYLE="Background-Color : #FFFFFF">
                    <option value="01" <?php
                    if ($oh_month == 1) {
                        echo "selected";
                    }
                    ?>>Jan</option>
                    <option value="02" <?php
                    if ($oh_month == 2) {
                        echo "selected";
                    }
                    ?>>Feb</option>
                    <option value="03" <?php
                    if ($oh_month == 3) {
                        echo "selected";
                    }
                    ?>>Mar</option>
                    <option value="04" <?php
                    if ($oh_month == 4) {
                        echo "selected";
                    }
                    ?>>April</option>
                    <option value="05" <?php
                    if ($oh_month == 5) {
                        echo "selected";
                    }
                    ?>>May</option>
                    <option value="06" <?php
                    if ($oh_month == 6) {
                        echo "selected";
                    }
                    ?>>Jun</option>
                    <option value="07" <?php
                    if ($oh_month == 7) {
                        echo "selected";
                    }
                    ?>>Jul</option>
                    <option value="08" <?php
                    if ($oh_month == 8) {
                        echo "selected";
                    }
                    ?>>Aug</option>
                    <option value="09" <?php
                    if ($oh_month == 9) {
                        echo "selected";
                    }
                    ?>>Sep</option>
                    <option value="10" <?php
                    if ($oh_month == 10) {
                        echo "selected";
                    }
                    ?>>Oct</option>
                    <option value="11" <?php
                    if ($oh_month == 11) {
                        echo "selected";
                    }
                    ?>>Nov</option>
                    <option value="12" <?php
                    if ($oh_month == 12) {
                        echo "selected";
                    }
                    ?>>Dec</option>
                </select> 
                <select name="oh_day" STYLE="Background-Color : #FFFFFF">
                    <?php for ($i = 1; $i <= 31; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php
                        if ($oh_day == $i) {
                            echo "selected";
                        }
                        ?>><?php echo $i; ?></option>
                            <?php } ?>
                </select>



                <select name="oh_year" STYLE="Background-Color : #FFFFFF">

                    <?php for ($i = (date("Y") - 0); $i <= date("Y"); $i++) { ?>

                        <option value="<?php echo $i + 1; ?>" <?php
                        if ($oh_year == $i) {
                            echo "selected";
                        }
                        ?>>
                                    <?php echo $i + 1; ?>
                        </option>

                        <option value="<?php echo $i; ?>" <?php
                        if ($oh_year == $i) {
                            echo "selected";
                        }
                        ?>>
                                    <?php echo $i; ?>
                        </option>

                    <?php } ?>
                </select>

            </TD></TR><tr><td><BR></td></tr><TR><TD>

                Start Time:
            </TD><TD>
                <select name="START_HOUR" STYLE="Background-Color : #FFFFFF">

                    <option value="1" <?php
                    if ($START_HOUR == '1') {
                        echo "selected";
                    }
                    ?>>1</option>
                    <option value="2" <?php
                    if ($START_HOUR == '2') {
                        echo "selected";
                    }
                    ?>>2</option>
                    <option value="3" <?php
                    if ($START_HOUR == '3') {
                        echo "selected";
                    }
                    ?>>3</option>
                    <option value="4" <?php
                    if ($START_HOUR == '4') {
                        echo "selected";
                    }
                    ?>>4</option>
                    <option value="5" <?php
                    if ($START_HOUR == '5') {
                        echo "selected";
                    }
                    ?>>5</option>
                    <option value="6" <?php
                    if ($START_HOUR == '6') {
                        echo "selected";
                    }
                    ?>>6</option>
                    <option value="7" <?php
                    if ($START_HOUR == '7') {
                        echo "selected";
                    }
                    ?>>7</option>
                    <option value="8" <?php
                    if ($START_HOUR == '8') {
                        echo "selected";
                    }
                    ?>>8</option>
                    <option value="9" <?php
                    if ($START_HOUR == '9') {
                        echo "selected";
                    }
                    ?>>9</option>
                    <option value="10" <?php
                    if ($START_HOUR == '10') {
                        echo "selected";
                    }
                    ?>>10</option>
                    <option value="11" <?php
                    if ($START_HOUR == '11') {
                        echo "selected";
                    }
                    ?>>11</option>
                    <option value="12" <?php
                    if ($START_HOUR == '12') {
                        echo "selected";
                    }
                    ?>>12</option>
                </SELECT>


                <select name="START_MINS" STYLE="Background-Color : #FFFFFF">

                    <option value="00" <?php
                    if ($START_MINS == '00') {
                        echo "selected";
                    }
                    ?>>00</option>
                    <option value="05" <?php
                    if ($START_MINS == '05') {
                        echo "selected";
                    }
                    ?>>05</option>
                    <option value="10" <?php
                    if ($START_MINS == '10') {
                        echo "selected";
                    }
                    ?>>10</option>
                    <option value="15" <?php
                    if ($START_MINS == '15') {
                        echo "selected";
                    }
                    ?>>15</option>
                    <option value="20" <?php
                    if ($START_MINS == '20') {
                        echo "selected";
                    }
                    ?>>20</option>
                    <option value="25" <?php
                    if ($START_MINS == '25') {
                        echo "selected";
                    }
                    ?>>25</option>
                    <option value="30" <?php
                    if ($START_MINS == '30') {
                        echo "selected";
                    }
                    ?>>30</option>
                    <option value="35" <?php
                    if ($START_MINS == '35') {
                        echo "selected";
                    }
                    ?>>35</option>
                    <option value="40" <?php
                    if ($START_MINS == '40') {
                        echo "selected";
                    }
                    ?>>40</option>
                    <option value="45" <?php
                    if ($START_MINS == '45') {
                        echo "selected";
                    }
                    ?>>45</option>
                    <option value="50" <?php
                    if ($START_MINS == '50') {
                        echo "selected";
                    }
                    ?>>50</option>
                    <option value="55" <?php
                    if ($START_MINS == '55') {
                        echo "selected";
                    }
                    ?>>55</option>
                </SELECT>

                <select name="START_MER" STYLE="Background-Color : #FFFFFF">
                    <option value="AM" <?php
                    if ($START_MER == 'AM') {
                        echo "selected";
                    }
                    ?>>AM</option>
                    <option value="PM" <?php
                    if ($START_MER == 'PM') {
                        echo "selected";
                    }
                    ?>>PM</option>


            </TD></TR><tr><td><BR></td></tr><TR><TD>

                End Time:
            </TD><TD>

                <select name="END_HOUR" STYLE="Background-Color : #FFFFFF">

                    <option value="1" <?php
                    if ($END_HOUR == '1') {
                        echo "selected";
                    }
                    ?>>1</option>
                    <option value="2" <?php
                    if ($END_HOUR == '2') {
                        echo "selected";
                    }
                    ?>>2</option>
                    <option value="3" <?php
                    if ($END_HOUR == '3') {
                        echo "selected";
                    }
                    ?>>3</option>
                    <option value="4" <?php
                    if ($END_HOUR == '4') {
                        echo "selected";
                    }
                    ?>>4</option>
                    <option value="5" <?php
                    if ($END_HOUR == '5') {
                        echo "selected";
                    }
                    ?>>5</option>
                    <option value="6" <?php
                    if ($END_HOUR == '6') {
                        echo "selected";
                    }
                    ?>>6</option>
                    <option value="7" <?php
                    if ($END_HOUR == '7') {
                        echo "selected";
                    }
                    ?>>7</option>
                    <option value="8" <?php
                    if ($END_HOUR == '8') {
                        echo "selected";
                    }
                    ?>>8</option>
                    <option value="9" <?php
                    if ($END_HOUR == '9') {
                        echo "selected";
                    }
                    ?>>9</option>
                    <option value="10" <?php
                    if ($END_HOUR == '10') {
                        echo "selected";
                    }
                    ?>>10</option>
                    <option value="11" <?php
                    if ($END_HOUR == '11') {
                        echo "selected";
                    }
                    ?>>11</option>
                    <option value="12" <?php
                    if ($END_HOUR == '12') {
                        echo "selected";
                    }
                    ?>>12</option>
                </SELECT>


                <select name="END_MINS" STYLE="Background-Color : #FFFFFF">

                    <option value="00" <?php
                    if ($END_MINS == '00') {
                        echo "selected";
                    }
                    ?>>00</option>
                    <option value="05" <?php
                    if ($END_MINS == '05') {
                        echo "selected";
                    }
                    ?>>05</option>
                    <option value="10" <?php
                    if ($END_MINS == '10') {
                        echo "selected";
                    }
                    ?>>10</option>
                    <option value="15" <?php
                    if ($END_MINS == '15') {
                        echo "selected";
                    }
                    ?>>15</option>
                    <option value="20" <?php
                    if ($END_MINS == '20') {
                        echo "selected";
                    }
                    ?>>20</option>
                    <option value="25" <?php
                    if ($END_MINS == '25') {
                        echo "selected";
                    }
                    ?>>25</option>
                    <option value="30" <?php
                    if ($END_MINS == '30') {
                        echo "selected";
                    }
                    ?>>30</option>
                    <option value="35" <?php
                    if ($END_MINS == '35') {
                        echo "selected";
                    }
                    ?>>35</option>
                    <option value="40" <?php
                    if ($END_MINS == '40') {
                        echo "selected";
                    }
                    ?>>40</option>
                    <option value="45" <?php
                    if ($END_MINS == '45') {
                        echo "selected";
                    }
                    ?>>45</option>
                    <option value="50" <?php
                    if ($END_MINS == '50') {
                        echo "selected";
                    }
                    ?>>50</option>
                    <option value="55" <?php
                    if ($END_MINS == '55') {
                        echo "selected";
                    }
                    ?>>55</option>
                </SELECT>

                <select name="END_MER" STYLE="Background-Color : #FFFFFF">
                    <option value="AM" <?php
                    if ($END_MER == 'AM') {
                        echo "selected";
                    }
                    ?>>AM</option>
                    <option value="PM" <?php
                    if ($END_MER == 'PM') {
                        echo "selected";
                    }
                    ?>>PM</option>

            </TD></TR><tr><td><BR></td></tr><TR><TD VALIGN=top>

                Comments:

            </TD><TD>


                <textarea cols="30" rows="10" name="COMMENTS"><?php echo $comments; ?></textarea>


            </TD></TR></TABLE>
    <table class="container bg-light text-lg-left"><tr><td><BR></td></tr></table>

    <TABLE class="container bg-light text-lg-left"><TR><TD VALIGN="MIDDLE" ALIGN="CENTER">    
                <input class="btn btn-primary" type="submit" value="Update Open House">

                <a class="btn btn-dark text-white" href="?op=openhouse">Back to the Open House Main Menu</a><BR><BR>
            </td></tr>
    </TABLE>
</form>
