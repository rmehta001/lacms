
<DIV class="class">
<table width="100%" border="1" cellpadding="0" cellspacing="0">

  <tr>
    <td align="center" valign="top"  class='menucl' >
        <FORM name="extractor">
          <TABLE bgcolor="#CCCCCC" cellpadding=1 cellspacing=0 border=0>
            <TR>
              <TD>
                <TABLE border=0 cellpadding=8 cellspacing=0 bordercolor="#000000" bgcolor="#CCCCCC">
                  <TR class="titlebarcolor">
                    <TD valign="TOP" colspan=2 ><h2 align="center"><FONT class="titlefont"><strong>Email
                            Extractor</strong></FONT></h2>
                    </TD>
                  </TR>
                  <TR>
                    <TD valign="TOP" align="CENTER" colspan=2>
                      <SCRIPT language="JAVASCRIPT">
var introtext = 'Copy text from any source and paste it into here. Then click extract button. You can select different separator (or enter your own), group a number of emails and sort extracted emails alphabetically.';
document.write('<TEXTAREA NAME="rawdata" rows=12 cols=50 onFocus="if (this.value == introtext) this.value = \'\';">' + introtext + '</TEXTAREA>');
            </SCRIPT>
                    </TD>
                  </TR>
                  <TR>
                    <TD valign="TOP" align="LEFT" colspan=2> Separator:
                        <SELECT name="sep">
                          <OPTION value=", ">Comma</OPTION>
                          <OPTION value="|">Pipe</OPTION>
                          <OPTION value=" : ">Colon</OPTION>
                          <OPTION value="new">New Line</OPTION>
                          <OPTION value="other">Other</OPTION>
                        </SELECT>
                        <INPUT type="TEXT" name="othersep" size=3 onBlur="checksep(this.value)">
&nbsp;&nbsp; Group:
                    <INPUT type="TEXT" size=3 name="groupby" onBlur="numonly(this.value)">
                    Emails &nbsp;&nbsp;
                    <LABEL for="sortbox">
                    <INPUT type="CHECKBOX" name="sort" id="sortbox">
                    Sort Alphabetically</LABEL>
                    </TD>
                  </TR>
                  <TR valign="TOP">
                    <TD align="LEFT">
                      <INPUT name="BUTTON" type="BUTTON" onClick="findEmail()" value="Extract">
                      <INPUT name="RESET" type="RESET" value="Reset">
                      <SCRIPT language="JavaScript" type="text/javascript">
<!--
if ((navigator.appName=="Microsoft Internet Explorer")&&(parseInt(navigator.appVersion)>=4)) {
   document.write('<INPUT TYPE="BUTTON" VALUE="Copy To Clipboard" onClick="copy();">');
} else {
   document.write('<INPUT TYPE="BUTTON" VALUE="Highlight All" onClick="highlight();">');
}
// -->
            </SCRIPT>
                    </TD>
                    <TD align="RIGHT" valign="BOTTOM" nowrap> Email count:
                        <INPUT name="count" size=5 readonly>
                    </TD>
                  </TR>
                </TABLE>
              </TD>
            </TR>
          </TABLE>
        </FORM>
        <SCRIPT language="JAVASCRIPT" type="text/javascript">
<!-- Begin

// Created and Copyrighted by Benjamin Leow
// Please go to http://www.surf7.net for latest version and more freeware

function copy() {
highlight();
textRange = document.extractor.rawdata.createTextRange();
textRange.execCommand("RemoveFormat");
textRange.execCommand("Copy");
window.alert("The content has been copied to your clipboard.");
}

function highlight(){
document.extractor.rawdata.focus()
document.extractor.rawdata.select()
}

function checksep(value){
if (value) document.extractor.sep.value = "other";
}

function numonly(value){
if (isNaN(value)) {
    window.alert("Please enter a number or else \nleave blank for no grouping.");
    document.extractor.groupby.focus();
}
}

function findEmail() {
var email = "No email address detected";
var a = 0;
var ingroup = 0;
var separator = document.extractor.sep.value;
var groupby = Math.round(document.extractor.groupby.value);

if (separator == "new") separator = "\n";
if (separator == "other") separator = document.extractor.othersep.value;
var rawemail = document.extractor.rawdata.value.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi);
var norepeat = new Array();
if (rawemail) {
	for (var i=0; i<rawemail.length; i++) {
		var repeat = 0;
		
		// Check for repeated emails routine
		for (var j=i+1; j<rawemail.length; j++) {
			if (rawemail[i] == rawemail[j]) {
				repeat++;
			}
		}
		
		// Create new array for non-repeated emails
		if (repeat == 0) {
			norepeat[a] = rawemail[i];
			a++;
		}
	}
	if (document.extractor.sort.checked) norepeat = norepeat.sort(); // Sort the array
	email = "";
	// Join emails together with separator
	for (var k = 0; k < norepeat.length; k++) {
		if (ingroup != 0) email += separator;
		email += norepeat[k];
		ingroup++;
		
		// Group emails if a number is specified in form. Each group will be separate by new line.
		if (groupby) {
		    if (ingroup == groupby) {
		        email += '\n\n';
		        ingroup = 0;
		    }
		}
	}
}

// Return array length
var count = norepeat.length;

// Print results
document.extractor.count.value = count;
document.extractor.rawdata.value = email;
}
//  End -->
  </SCRIPT>
    </td>
  </tr>
</table></DIV>