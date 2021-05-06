<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change the Agency/Office associated with ALL<BR>
the listings for this landlord in ALL Buildings<BR><BR>
<P>
This effects which Office signature shows in ads.<BR>
<P>
	<form action="<?php echo "$PHP_SELF?op=global-Landlord-agentDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Pick the Agency/Office and click the button below.<BR>
<CENTER>
<?php
if (($isAdmin && $agcy>0) OR ($user_level >="4" && $agcy>0)){
$quStrGetAgencies = "SELECT * FROM AGENCIES WHERE GID=$grid";
$quGetAgencies = mysqli_query($dbh, $quStrGetAgencies) or die ($quStrGetAgencies);
$num_agencies=mysqli_num_rows($quGetAgencies);
if($num_agencies>0)
{
        while($rowAgency = mysqli_fetch_object($quGetAgencies))
        {
                $arrayAgency[$rowAgency->AGENCY_ID]=$rowAgency->AGENCY_NAME;
        }
        echo "<div class=ad align=center>Change Agency:<br><select name=AGENCY_HEADERS1 STYLE=Background-Color : #FFFFFF>";
?>
        <option value=0 <?php if ($key=0)
                {       echo " selected "; } ?>
                >Main Agency</option>
        <?php foreach($arrayAgency as $key => $value)
        { ?>
                <option value="<?php echo $key; ?>"
        <?php if ($key==$rowGetAd->AGENCY_HEADERS)
                { echo " selected ";}
        ?> >
                <?php echo $value; ?></option>
        <?php
//             echo "$key $value";
        }
        echo "</select></DIV>";
} } else {?>

<B><FONT COLOR="#FF0000">You do not have permission to use this option. Only the Admin may make this change.</FONT></B>
<?php }?>

<?php if ($isAdmin OR $user_level >="4") {?>
<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Office/Agency in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<?php } ?>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>
</CENTER>
<!--END global -->