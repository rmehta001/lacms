<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
if ($_SESSION['pref_pagebg']=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor=$_SESSION['pref_pagebg'];
}
$pagebgcolor="#e2effa";
?>
<CENTER>
<TABLE BGCOLOR="#FFFFFF" WIDTH="600" CELLPADDING=8><TR><TD>
<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:1200px;height:320px;">
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH CHAT</B></TD></TR>
</TABLE>
</CENTER>
    <BR>

    <ul>
<li>The Chat function is designed to allow agents to have live discussions. It can be used for scheduled public meetings with other participating agencies.<BR>
<P>
<li>When you click "Chat" on the Main Menu you will go to a page that asks you to enter a chat name. Enter a name and hit the "Go" button.<BR>
<P>
<li>You then enter the chat room.  You can enter a message where it says "Type your message here:" and hit the "Send" button. Anyone logged into the Chat will see your message.  To add "smiley" icons, just click them.<BR>
<P>
<li>If you click "Who's online?" a list of other people logged into chat will appear.<BR>
<P>
<li>You can click Logout or close the new tab or window chat appeared when you are finished chatting.<BR>
    </UL>
<BR>
<p>
<CENTER>
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
</CENTER>
<P>






</div>
</TD></TR></TABLE>
</CENTER>




