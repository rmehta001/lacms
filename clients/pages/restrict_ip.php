<!--BEGIN restrict_ip -->
	<center>
  <table border="1" width="484" height="274" cellpadding="5">
    <tr>
      <td width="484" height="28">
        <p align="center">Please read before using this feature.</td>
    </tr>
    <tr>
      <td width="484" height="137">The &quot;Restrict Login&quot; feature is
        designed to deny access to the system to ALL agents unless they are in the
        office.&nbsp; This may or may not be the desire of your agency.&nbsp;
        The feature works by checking the IP address of the agent trying to
        login and comparing it to the one you set here.&nbsp; This feature
        may not work for your office's network configuration.&nbsp; If you are
        unsure, please consult your Network Administrator or other responsible
        staff.&nbsp; If your network has only one internet connection, and uses
        a <i>router </i>to share the connection, this feature should work
        fine without any other changes.&nbsp;&nbsp;
        <p>By default, when you activate this setting,&nbsp; all agents are
        affected.&nbsp; You may turn the feature on or off for individual agents
        on the &quot;Edit Agent&quot; screen.&nbsp; The administrator is
        never restricted from logging in for contingency purposes.&nbsp;
        <p>The address in the field below is the one detected right now for this browser. 
        You should be at the location you wish to authorize, in order to correctly set this value.&nbsp;
        <p>Once the feature is enabled,  you must re-login for it to take effect.</td>
    </tr>
    <tr>
      <td width="444" height="112">
        <form action="<?php echo "$PHP_SELF?op=restrict_ip_do";?>" method="POST">
        <p align="center">Enable Restricted Login<input type="checkbox" name="restrict_ip" value="1" <?php if ($rowGetGroup->RESTRICT_IP) { echo " checked "; } ?>>&nbsp;
        </p>
        <?php if ($rowGetGroup->IP_ADDRESS) {?>
        	<p align="center"><font size="-2" color="red">Previous IP address: <?php echo $rowGetGroup->IP_ADDRESS; ?></font></p>
        <?php } ?>
        <p align="center">Detected IP address:<input type="text" name="ip_address" size="13" value="<?php echo $_SERVER['REMOTE_ADDR'];?>"></p>
        <p align="center"><input type="submit" value="Submit"></form></p>
        <p align="center">&nbsp;</td>
    </tr>
  </table>
  </center>
	


<!--END restrict_ip --> 