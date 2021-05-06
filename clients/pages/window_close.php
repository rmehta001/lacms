<!--BEGIN window_close -->

	<script>
					
		
		var page_y = window.opener.document.body.scrollTop;
		var sURL = unescape(window.opener.location.pathname);
		<?php 
		if ($op=="editDo") {
			$js_op = "sel";
		}elseif ($op=="editListingDo") {
			$js_op = "listings";
		}
		?>
		sURL += "?op=<?php echo $js_op;?>";
		sURL += ("&scroll_return=" + page_y);
		
		window.opener.location.href = sURL;
		window.close();
		
		
	
	</script>
	<br>
	<br>
	<br>
	<br>
	<center><font color="#000000" size="4">Updating Database</font></center>

	



<!--END window_close -->