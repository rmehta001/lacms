<?php
$pref_pagebg = $_SESSION['pref_pagebg'];
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
$group = $_SESSION['group'];
?>

<center>
<b>Applications for <?php echo $group;?></b>
</center>
<br/>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<div class="controltext" style="background-color:<?php echo $pagebgcolor;?>;border:1px solid black;width:700px;">
<div class="temp-link" style=""></div>
<table cellspacing="5" cellpadding="3">
<tbody>
<tr>
<td colspan="2">
<center>
<input type="button" style="background-color: #E0FFFF; text-decoration: none;" onclick="IntellirentSsoRequest()" value="Access Intellirent">
</center>
</td>
</tr>
<tr>
<td colspan="2" width="530">
<p>
Your BostonApartments.com listings will be automatically updated in Intellirent.
<br/>
Access Intellirent and visit the Knowledge Base to <a href="https://myintellirent.zendesk.com/hc/en-us/sections/115004133128-Rental-Marketing" target="_blank" style="text-decoration: underline; color: blue;">learn more</a>
</p>
<p>
You may also select which listings carry an Apply Now button and those that don't within the edit/create listing page.
</p>
<br/>

<center>
<p>
Contact Intellirent
<a href="https://myintellirent.zendesk.com/hc/en-us/requests/new" target="_blank" style="text-decoration: underline; color: blue;">technical support</a>&nbsp;or&nbsp;<a href="https://info.myintellirent.com/meetings/cjoachim/bostonapartments" target="_blank" style="text-decoration: underline; color: blue;">schedule a meeting</a>.
</p>
</center>
</td>
</tr>
</tbody>
</table>
</div>
<script>
var IntellirentSsoRequest = function() {
$.ajax({
    url: '<?php echo "/lacms/clients/intellirentSso.php"; ?>',
      type: 'POST',
   success: function(data){
       data = JSON.parse(data);
       if(data.session_url !== undefined && data.session_url !== null && data.session_url !== ''){
// var win = window.open(data.session_url, '_blank')
        // win.focus();
        $('.temp-link').html('<a href="' + data.session_url + '" id="temp-link-child" style="font-size:1px;opacity:0;">Access Intellirent</a>');

var userAgent = window.navigator.userAgent;

        var element = $(document).find('#temp-link-child')[0];
if(element.click)
{
if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)){
element.click();
}
else {
  var elem = $(document).find('#temp-link-child');
elem.attr('target', '_blank');
elem[0].click();
elem.remove();
}
}
else if(document.createEvent)
{
   var eventObj = document.createEvent('MouseEvents');
   var eventObj = new MouseEvent("click", {
   bubbles: true,
   cancelable: true
});
   element.dispatchEvent(eventObj);
}
element.remove();
       }else{
        console.log(data);
       }
       }
    });
}
</script>


<P><BR>
<!--END edit Intellirent applications Settings -->
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

