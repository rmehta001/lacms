<?php
$PHP_SELF = $_SERVER['PHP_SELF'];
if ($_SESSION['pref_pagebg'] == "") {
    $pagebgcolor = "#F5F5DC";
} else {
    $pagebgcolor = $_SESSION['pref_pagebg'];
}
$pagebgcolor = "#e2effa";
?>

<CENTER>
    <TABLE BGCOLOR="#FFFFFF" WIDTH="600" CELLPADDING=8><TR><TD>

                <div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor; ?>;padding:15px;margin:10px;width:1200px;height:600px;">
                    <CENTER>
                        <TABLE style="text-align:center" WIDTH="500"><TR>
                                <TD><B style="color:#1296db;font-size:30px;">HELP WITH MEET THE AGENTS</B></TD></TR>
                        </TABLE>
                    </CENTER>
                    <BR>

                    <UL>
                        <li>This function creates a Meet the Agents/Staff page for your website and should make maintaining it a breeze. You may have a custom template for that page which may be entered in the "BostonApartments.com Templates" option on the Admin menu.<BR>
                            <P>
                        <li> The Admin may edit and agent Under the Admin menu -> Manage Agents and select whether an agent should appear on the page and in what order.<BR>
                            <P>
                        <li> To use the option on your website, a link needs to be added to your site:<NR>
                            <P>
                                https://www.BostonApartments.com/meettheagents.php?cli=<?php echo $grid; ?>
                            <P>
                            <li>      For a sample output click:
                                <P>
                                    <A HREF="https://www.BostonApartments.com/meettheagents.php?cli=392" target="_NEW">https://www.BostonApartments.com/meettheagents.php?cli=392</A><BR>
                                <P>
                            <li>   You may add to the URL the following:<BR><BR>
                                <P>
                                    <I>"&style=2"</I> - For a different style of output. Custom outputs can be added at your request.

                                <P>
                                    <I>"&htype=no"</I> - This will stop any templates (headers/footers) to display on the output page.
                                    <BR><BR>

                                    $picheight = $HTTP_GET_VARS['picheight'];
                                    $picwidth = $HTTP_GET_VARS['picwidth'];
                                    <BR><BR>
                                    <I>"&picborder=on"</I> - turns on a border around the agent photo.<BR>
                                <P>
                                    <I>"&picbordercolor=HEXCODE"</I> - e.g. (FFFFFF for white or acceptable HTML color names like red, white, blue green, etc.) - for the color of the border around the agent photo.<BR>
                                <P>
                                    <I>"&picheight=# of pixels"</I> - Controls the picture height.<BR>
                                <P>
                                    <I>"&picwidth=# of pixels"</I> - Controls the picture width.<BR>
                                    </ul>  
                                    <BR>
                            <CENTER>
                                <B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
                            </CENTER>
                            <P>
                                </DIV>
                                </TD></TR></TABLE>
                                </CENTER>




