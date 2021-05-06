<TABLE><TR><TD><img border="0" width="40" height="40" src="../assets/images/email-extractor.jpeg">
</TD><TD>
<CENTER><B><FONT SIZE="+2">Email Extractor</FONT></B></CENTER>
</TD></TR></TABLE>

<TABLE BGCOLOR="#FFFFFF" BORDER="1" BORDERCOLOR="#000000" CELLPADDING="5"><TR><TD>

<CENTER>
<FONT SIZE="-3"><BR></FONT>


<?php

###############################################################
# Email Extractor 1.0
###############################################################
# Visit http://www.zubrag.com/scripts/ for updates
############################################################### 


$the_url = isset($_REQUEST['url']) ? htmlspecialchars($_REQUEST['url']) : '';
?>



<form method="post">
  Please enter full URL of the page to parse (including http://):<br />
  <input type="text" name="url" size="65" value="<?php echo $the_url;  ?>"/><br />
  or enter text directly into textarea below:<br />
  <textarea name="text" cols="50" rows="15"></textarea>
  <br />
  <input type="submit" value="Parse Emails" />
</form>

<?php
if (isset($_REQUEST['url']) && !empty($_REQUEST['url'])) {
  // fetch data from specified url
  $text = file_get_contents($_REQUEST['url']);
}
elseif (isset($_REQUEST['text']) && !empty($_REQUEST['text'])) {
  // get text from text area
  $text = $_REQUEST['text'];
}

// parse emails
if (!empty($text)) {
  $res = preg_match_all(
    "/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i",
    $text,
    $matches
  );

  if ($res) {
    foreach(array_unique($matches[0]) as $email) {

if (($email !="webmaster@craigslist.org") or ($email !="webmaster@craigslist.org")) {
echo $email . "<br />";
}

}
  }
  else {
    echo "No emails found.";
  }
}

?>
<FONT SIZE="-2"><BR></FONT></CENTER>
</TD></TR></TABLE>
<FONT SIZE="-2"><BR>