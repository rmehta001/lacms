<!-- BEGIN Intellirent settings -->
<?php
	if ($pref_pagebg=="") {
		$pagebgcolor="#F5F5DC";
	} else {
		$pagebgcolor="$pref_pagebg";
	}
?>

<center>
	<b>Edit Intellirent Settings for <?php echo $group;?></b>
</center>
<br/>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<div class="controltext" style="background-color:<?php echo $pagebgcolor;?>;border:1px solid black;width:700px;">
	<br/>
	<div class="temp-link" style=""></div>
	<table cellspacing="5" cellpadding="3">
		<tbody>
			<tr>
				<td colspan="2">
					<center>
						<input type="button" style="background-color: #E0FFFF; text-decoration: none;" onclick="IntellirentSsoRequestMA()" value="Access Intellirent" formtarget="_blank">
					</center>
				</td>
			</tr>
		</tbody>
	</table>
	<table>
		<tbody>
			<tr>
				
				<td align="center" colspan="2">
					<form action="<?php echo "$PHP_SELF?op=intellirentDo"; ?>" method="POST">
						<p>
							After connecting your account, your BostonApartments.com listings will be automatically updated in Intellirent, allowing you to access time saving tenant screening technology, plus additional syndication to sites at no extra cost to you!
							<br/><br/><br/>

							<div style="width: 475px;">
								<div style="display: inline-flex;">
									<div class="controltext">Enable the Intellirent System for Applications/Credit Checks & Additional Site Sydication:</div>
									<select style="background-color: white;" name="INTELLIRENT">
										<option value="0" <?php if ($rowGetGroup->INTELLIRENT=="0") { echo " selected "; }?>>No</option>
										<option value="1" <?php if ($rowGetGroup->INTELLIRENT=="1") { echo " selected "; }?>>Yes</option>
									</select>
								</div>
							</div>
							<br/><br/>

							<font size="-1">If this is set to "No", then the "Apply Now Button" will not show on any Listings/Ads.</font>
							<br/><br/>

							<input type="submit" value="Save Intellirent Settings" style="Background-Color : #E0FFFF">
							<hr noshade color="black" size="1">
							<br/><br/>
							
							<a href="https://info.myintellirent.com/ba-internet-listing-sites" target="blank" style="text-decoration: underline; color: blue;">Intellirent extended syndication list</a>
							<br/><br/>

							<tr>
								<td colspan="2" >
									<p>
										You may also select which listings carry an "Apply Now" button and those that don't within the edit/create listing page.
										<br/><br/>
										
										Each applicant pays a $30 fee which covers your costs, however, you may choose to <i>change</i> the <i>souce of payment</i> after you have connected your accounts.
										<br/><br/>
										
										Real Estate Brokers and Salespersons can follow a specific provision set aside for them to charge application fees (Massachusetts Regulations <a href="http://www.mass.gov/ocabr/licensee/dpl-boards/re/regulations/rules-and-regs/254-cmr-700.html" target="_blank" style="text-decoration: underline; color: blue;">Section 254 CMR 7.00</a>). *Only a third party borker can charge an application fee.

										<br/><br/><br/><br/>
									</p>
								</td>
							</tr>
						</p>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<script>
	var IntellirentSsoRequestMA = function() {
		$.ajax({
	    	url: '<?php echo "/lacms/clients/intellirentSsoMA.php"; ?>',
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