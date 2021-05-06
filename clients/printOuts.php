<!--BEGIN printOuts -->
<br>

<div align="left" style="padding:0px;margin:px;border:1px solid black;width:585;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:15px;color:black;">
<!--Tabs-->
<?php include ("folderTabs2.php"); ?>
<!--/Tabs-->
<br>
<br>	

	<div align="center" class="menu"><a href="https://www.BostonApartments.com/homepage.php?cli=<?php echo $grid;?>&ad=<?php echo $cid;?>" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Client Printout with Agency Stationary</a><BR>

	<div align="center" class="menu">

<a href="https://www.BostonApartments.com/lacms/clients/assets/viewsource.php?u=hompage.php?cli=<?php echo $grid;?>%26ad=<?php echo $cid;?>" target="_NEW">View HTML Ad Source Code</A><BR>
</div>
<BR><P>



	<div align="center" class="menu"><a href="javascript:popUpPrintOut('./printout_agent.php?cid=<?php echo $cid;?>');"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Agent Show sheet</a>&nbsp;&nbsp; &nbsp;<a href="javascript:popUpPrintOut('./printout_client.php?cid=<?php echo $cid;?>');"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Client Show sheet</a></div>
	<?php if ($rowGetAd->PIC) { ?>
	<div align="center" class="menu"><a href="javascript:popUpPrintOutPic('./printout_agent_pic.php?cid=<?php echo $cid;?>');"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Agent Show sheet with Pictures</a>&nbsp;&nbsp; &nbsp;<a href="javascript:popUpPrintOutPic('./printout_client_pic.php?cid=<?php echo $cid;?>');"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Client Show sheet with Pictures</a></div>






	<?php } ?>
	<br>
	<br>
	<br>
	<br>
	<br>
</div>
<br>
<br><br>
<!--END printOuts -->