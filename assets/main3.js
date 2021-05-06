<script Language="JavaScript">
<!--




		var type = '<?php echo $rowGetAd->TYPE;?>';
		var ServerOp = '<?php echo $op;?>';
		var ServerPage = '<?php echo $page;?>';
		var adlEditView = "simple";
		window.setTimeout("window.navigate('../logout.php')", 9900000000);
 		
 		function syncMeSelect (element1, element2) {
 			document.getElementById(element2).selectedIndex = document.getElementById(element1).selectedIndex;
 		}
 		

 		function syncMeSelect2 (element1, element2) {
 			document.getElementById(element2).value = document.getElementById(element1).value;
 		}





 		function validateAdlEdit (view) {
 			if (view=="simple") {
 				document.getElementById("fullTYPE").selectedIndex = document.getElementById("simpleTYPE").selectedIndex;

 				document.getElementById("fullTYPE").selectedIndex = document.getElementById("simpleTYPE").selectedIndex;

 				document.getElementById("fullSTATUS").checked = document.getElementById("simpleSTATUS").checked;
 				document.getElementById("fullSTATUS_ACTIVE").checked = document.getElementById("simpleSTATUS_ACTIVE").checked;

document.getElementById("fullSTATUS_ACTIVE").value = document.getElementById("simpleSTATUS_ACTIVE").value;

 				document.getElementById("fullLOC").selectedIndex = document.getElementById("simpleLOC").selectedIndex;

 				document.getElementById("fullROOMS").selectedIndex = document.getElementById("simpleROOMS").selectedIndex;
 				document.getElementById("fullBATH").selectedIndex = document.getElementById("simpleBATH").selectedIndex;
 				document.getElementById("fullBODY").value = document.getElementById("simpleBODY").value;
 				document.getElementById("fullAD_TITLE").value = document.getElementById("simpleAD_TITLE").value;
 				document.getElementById("fullPRICE").value = document.getElementById("simplePRICE").value;

				 				document.getElementById("fullFEE_COMMENTS").value = document.getElementById("simpleFEE_COMMENTS").value;
				
				
 				if (document.getElementById("simpleTYPE").selectedIndex == 1 || document.getElementById("simpleTYPE").selectedIndex == 2) {
 					foo = "bar";
 				}else {
 					document.getElementById("fullNOFEE").selectedIndex = document.getElementById("simpleNOFEE").selectedIndex;
 				}

 				document.getElementById("fullbbbMonth").selectedIndex = document.getElementById("simplebbbMonth").selectedIndex;
 				document.getElementById("fullbbbDay").selectedIndex = document.getElementById("simplebbbDay").selectedIndex;
 				document.getElementById("fullbbbYear").selectedIndex = document.getElementById("simplebbbYear").selectedIndex;
 				document.getElementById("fullPETSA").selectedIndex = document.getElementById("simplePETSA").selectedIndex;
 				document.getElementById("fullLANDLORD").selectedIndex = document.getElementById("simpleLANDLORD").selectedIndex;
				document.getElementById("fullSTATUS").checked = document.getElementById("simpleSTATUS").checked;
				document.getElementById("fullSTATUS_ACTIVE").checked = document.getElementById("simpleSTATUS_ACTIVE").checked;
				
				
			document.getElementById("fullSTATUS_ACTIVE").value = document.getElementById("simpleSTATUS_ACTIVE").value;
				
 				document.getElementById("fullBUILDING_NAME").value = document.getElementById("simpleBUILDING_NAME").value;
 				
 				document.getElementById("fullSTREET_NUM").value = document.getElementById("simpleSTREET_NUM").value;
 				document.getElementById("fullSTREET").value = document.getElementById("simpleSTREET").value;
 				document.getElementById("fullxstreet").value = document.getElementById("simplexstreet").value;
 				document.getElementById("fullAPT").value = document.getElementById("simpleAPT").value;
 				document.getElementById("fullFLOOR").value = document.getElementById("simpleFLOOR").value;
 				document.getElementById("fullZIP").value = document.getElementById("simpleZIP").value;
 				document.getElementById("fullPARKING_NUM").selectedIndex = document.getElementById("simplePARKING_NUM").selectedIndex;
 				document.getElementById("fullPARKING_TYPE").selectedIndex = document.getElementById("simplePARKING_TYPE").selectedIndex;
 				document.getElementById("fullPARKING_COST").value = document.getElementById("simplePARKING_COST").value;

 				document.getElementById("fullSTATUS_SALE").selectedIndex = document.getElementById("simpleSTATUS_SALE").selectedIndex;



 				price = document.getElementById("simplePRICE");
 				body = document.getElementById("simpleBODY");
 				loc = document.getElementById("simpleLOC");
 			}else {


 				document.getElementById("simpleBODY").value = document.getElementById("fullBODY").value;
 				document.getElementById("simpleAD_TITLE").value = document.getElementById("fullAD_TITLE").value;
 				document.getElementById("simplePRICE").value = document.getElementById("fullPRICE").value;

				
 				document.getElementById("simpleFEE_COMMENTS").value = document.getElementById("fullFEE_COMMENTS").value;
				
 				if (document.getElementById("fullTYPE").selectedIndex == 1 || document.getElementById("fullTYPE").selectedIndex == 2) {
 					foo = "bar";
 				}else {
 					document.getElementById("simpleNOFEE").selectedIndex = document.getElementById("fullNOFEE").selectedIndex;
 				}
 				document.getElementById("simplePETSA").selectedIndex = document.getElementById("fullPETSA").selectedIndex;
 				document.getElementById("simplexstreet").value = document.getElementById("fullxstreet").value;
 				document.getElementById("simpleAPT").value = document.getElementById("fullAPT").value;
 				document.getElementById("simpleZIP").value = document.getElementById("fullZIP").value;
				document.getElementById("simpleBUILDING_NAME").value = document.getElementById("fullBUILDING_NAME").value;
				
 				document.getElementById("simplePARKING_COST").value = document.getElementById("fullPARKING_COST").value;
 				document.getElementById("simpleSTATUS_SALE").selectedIndex = document.getElementById("fullSTATUS_SALE").selectedIndex;



 				body = document.getElementById("fullBODY");
 				price = document.getElementById("fullPRICE");
 				loc = document.getElementById("fullLOC");
 			}
 			
 			
 			adlEdit = document.forms.adlEditForm;
 			
 			

 			if (loc.selectedIndex == 0) {
 				alert ("Please choose a Location for the ad.");
 			}else{
 				body.value = body.value.replace("Type your ad here.", "");
 				price.value = price.value.replace(",", "");
 				price.value = price.value.replace("$", "");
 				adlEdit.submit();
 			}
 		}
 			




 		function tabNav (page, cid) {
 			//display name of page//
 			if (page=="adlEdit") {
 				pageName = "Ad/Listing";
 			}else if (page=="managePics") {
 				pageName = "Pictures";
 			}else if (page=="manageListingDeals") {
 				pageName = "Deal Sheets";
 			}else if (page=="printOuts") {
 				pageName = "Printouts";
 			}



 			if (ServerPage != "adlEdit") {
 				window.location = ("<?php echo $PHP_SELF;?>?op=" + page + "&cid=" + cid);
 			}else {
 				if (cid == 0) {
 					//ad has not been saved and needs to.//
 					if (confirm("Click ok to save your work and navigate to " + pageName + ".")) {
 						document.getElementById("adlEditFormNav").value = page;

validateAdlEdit(adlEditView);


 					}
 				}else {
 					if (confirm ("Would you like to save your changes?")) {
 						document.getElementById("adlEditFormNav").value = page;
 						validateAdlEdit(adlEditView);
 					}else {
 						window.location = ("<?php echo $PHP_SELF;?>?op=" + page + "&cid=" + cid);
 					}
 				}
 			}
 		}



 		function setFlagFee (this_type) {
 			if (this_type==2 || this_type==6 || this_type==12 || this_type==13) {

			document.getElementById("simpleSTATUS_SALEspan").style.display = "inline";
			document.getElementById("simpleNOFEEspan").style.display = "none";

			document.getElementById("saleSpec").style.display = "inline";
			document.getElementById("saleSpec2").style.display = "inline";
			document.getElementById("saleSpec3").style.display = "inline";
			document.getElementById("saleSpec4").style.display = "inline";
			document.getElementById("rentalSpec").style.display = "none";
			document.getElementById("rentalSpec2").style.display = "none";


			}else if (this_type==3) {

			document.getElementById("simpleSTATUS_SALEspan").style.display = "inline";
			document.getElementById("simpleNOFEEspan").style.display = "none";

			document.getElementById("saleSpec").style.display = "inline";
			document.getElementById("saleSpec2").style.display = "inline";
			document.getElementById("saleSpec3").style.display = "inline";
			document.getElementById("saleSpec4").style.display = "inline";
			document.getElementById("rentalSpec").style.display = "none";
			document.getElementById("rentalSpec2").style.display = "none";

			document.getElementById("rentalSpec3").style.display = "none";

			}else if (this_type==4) {

			document.getElementById("simpleSTATUS_SALEspan").style.display = "none";
			document.getElementById("simpleNOFEEspan").style.display = "inline";

			document.getElementById("saleSpec").style.display = "inline";
			document.getElementById("saleSpec2").style.display = "none";
			document.getElementById("saleSpec3").style.display = "inline";
			document.getElementById("saleSpec4").style.display = "inline";
			document.getElementById("rentalSpec").style.display = "inline";
			document.getElementById("rentalSpec2").style.display = "inline";

			document.getElementById("rentalSpec3").style.display = "none";

			}else if (this_type==9) {

			document.getElementById("simpleSTATUS_SALEspan").style.display = "none";
			document.getElementById("simpleNOFEEspan").style.display = "inline";

			document.getElementById("rentalSpec").style.display = "inline";
			document.getElementById("rentalSpec2").style.display = "inline";

			document.getElementById("saleSpec").style.display = "inline";
			document.getElementById("saleSpec2").style.display = "none";
			document.getElementById("saleSpec3").style.display = "inline";
			document.getElementById("saleSpec4").style.display = "inline";



			}else {

			document.getElementById("simpleSTATUS_SALEspan").style.display = "none";
			document.getElementById("simpleNOFEEspan").style.display = "inline";

			document.getElementById("saleSpec").style.display = "none";
			document.getElementById("saleSpec2").style.display = "none";
			document.getElementById("saleSpec3").style.display = "none";
			document.getElementById("saleSpec4").style.display = "none";

			document.getElementById("rentalSpec").style.display = "inline";
			document.getElementById("rentalSpec2").style.display = "inline";
			document.getElementById("rentalSpec3").style.display = "inline";
			}
			type = this_type;
		}




 		function selectView (view) {
 			//document.adlEditView = view;
 			if (view=="simple") {
 				document.getElementById("fullArea").style.display = "none";
 				document.getElementById("fullSel").src = "../assets/images/wht_spacer.gif";
 				document.getElementById("simpleSel").src = "../assets/images/select.gif";
 				document.getElementById("selTitle").src = "../assets/images/simple_t.gif";
 				document.getElementById("simpleTYPE").selectedIndex = document.getElementById("fullTYPE").selectedIndex;
 				document.getElementById("simpleLOC").selectedIndex = document.getElementById("fullLOC").selectedIndex;
 				document.getElementById("simpleROOMS").selectedIndex = document.getElementById("fullROOMS").selectedIndex;
 				document.getElementById("simpleBATH").selectedIndex = document.getElementById("fullBATH").selectedIndex;
 				document.getElementById("simpleLANDLORD").selectedIndex = document.getElementById("fullLANDLORD").selectedIndex;
 				document.getElementById("simplePARKING_NUM").selectedIndex = document.getElementById("fullPARKING_NUM").selectedIndex;
 				document.getElementById("simplePARKING_TYPE").selectedIndex = document.getElementById("fullPARKING_TYPE").selectedIndex;
 				document.getElementById("simplePARKING_COST").value = document.getElementById("fullPARKING_COST").value;
				
 				document.getElementById("simpleBODY").value = document.getElementById("fullBODY").value;

 				document.getElementById("simpleAD_TITLE").value = document.getElementById("fullAD_TITLE").value;
document.getElementById("simpleFEE_COMMENTS").value = document.getElementById("fullFEE_COMMENTS").value;
 				document.getElementById("simplePRICE").value = document.getElementById("fullPRICE").value;

 				document.getElementById("simpleSTATUS_SALE").selectedIndex = document.getElementById("fullSTATUS_SALE").selectedIndex;

 				if (type == 1 || !type){ 
 					document.getElementById("simpleNOFEE").selectedIndex = document.getElementById("fullNOFEE").selectedIndex;


 				}else if (type == 2 || type == 3 || type == 4 || type == 12 || type == 13 || !type) {

					foo = "bar";

 				}
 				document.getElementById("simpleSTATUS").checked = document.getElementById("fullSTATUS").checked;
 				document.getElementById("simpleSTATUS_ACTIVE").checked = document.getElementById("fullSTATUS_ACTIVE").checked;
				
				
				document.getElementById("simpleSTATUS_ACTIVE").value = document.getElementById("fullSTATUS_ACTIVE").value;
				
 				document.getElementById("simplebbbMonth").selectedIndex = document.getElementById("fullbbbMonth").selectedIndex;
 				document.getElementById("simplebbbDay").selectedIndex = document.getElementById("fullbbbDay").selectedIndex;
 				document.getElementById("simplebbbYear").selectedIndex = document.getElementById("fullbbbYear").selectedIndex;
				
				
				document.getElementById("simpleBUILDING_NAME").value = document.getElementById("fullBUILDING_NAME").value;
				
 				document.getElementById("simpleSTREET_NUM").value = document.getElementById("fullSTREET_NUM").value;
 				document.getElementById("simpleSTREET").value = document.getElementById("fullSTREET").value;
 				document.getElementById("simplexstreet").value = document.getElementById("fullxstreet").value;
 				document.getElementById("simpleAPT").value = document.getElementById("fullAPT").value;
 				document.getElementById("simpleFLOOR").value = document.getElementById("fullFLOOR").value;
 				document.getElementById("simpleZIP").value = document.getElementById("fullZIP").value;

 				document.getElementById("adlEditFormNav").value = "sel";
 				document.getElementById("simpleArea").style.display = "block";
				document.getElementById("simplePETSA").value=document.getElementById("fullPETSA").value;

 			}else if (view=="full") {
 
				document.getElementById("simpleArea").style.display = "none";
 				document.getElementById("simpleSel").src = "../assets/images/wht_spacer.gif";
 				document.getElementById("fullSel").src = "../assets/images/select.gif";
 				document.getElementById("selTitle").src = "../assets/images/full_t.gif";
 				document.getElementById("fullTYPE").selectedIndex = document.getElementById("simpleTYPE").selectedIndex;
 				document.getElementById("fullLOC").selectedIndex = document.getElementById("simpleLOC").selectedIndex;
 				document.getElementById("fullROOMS").selectedIndex = document.getElementById("simpleROOMS").selectedIndex;
 				document.getElementById("fullBATH").selectedIndex = document.getElementById("simpleBATH").selectedIndex;
 				document.getElementById("fullLANDLORD").selectedIndex = document.getElementById("simpleLANDLORD").selectedIndex;

 				


 				if (type == 1 || !type) {
 					document.getElementById("fullNOFEE").selectedIndex = document.getElementById("simpleNOFEE").selectedIndex;

 				}else if (type == 2 || type == 3 || type == 4 || type == 12 || type == 13 || !type) {

					foo = "bar";
 				}

 

				document.getElementById("fullSTATUS").checked = document.getElementById("simpleSTATUS").checked;
				document.getElementById("fullSTATUS_ACTIVE").checked = document.getElementById("simpleSTATUS_ACTIVE").checked;
				
				
								document.getElementById("fullSTATUS_ACTIVE").value = document.getElementById("simpleSTATUS_ACTIVE").value;
				
				
 				document.getElementById("fullbbbMonth").selectedIndex = document.getElementById("simplebbbMonth").selectedIndex;
 				document.getElementById("fullbbbDay").selectedIndex = document.getElementById("simplebbbDay").selectedIndex;
 				document.getElementById("fullbbbYear").selectedIndex = document.getElementById("simplebbbYear").selectedIndex;


 				document.getElementById("fullxstreet").value = document.getElementById("simplexstreet").value;
 				document.getElementById("fullAPT").value = document.getElementById("simpleAPT").value;
 				document.getElementById("fullFLOOR").value = document.getElementById("simpleFLOOR").value;
 				document.getElementById("fullZIP").value = document.getElementById("simpleZIP").value;
 				document.getElementById("fullPARKING_NUM").selectedIndex = document.getElementById("simplePARKING_NUM").selectedIndex;
 				document.getElementById("fullPARKING_TYPE").selectedIndex = document.getElementById("simplePARKING_TYPE").selectedIndex;
 				document.getElementById("fullPARKING_COST").value = document.getElementById("simplePARKING_COST").value;
 				document.getElementById("adlEditFormNav").value = "listings";
 				document.getElementById("fullArea").style.display = "block";
				document.getElementById("fullPETSA").value=document.getElementById("simplePETSA").value;

				document.getElementById("fullBODY").value=document.getElementById("simpleBODY").value;

				document.getElementById("fullAD_TITLE").value=document.getElementById("simpleAD_TITLE").value;
				document.getElementById("fullFEE_COMMENTS").value=document.getElementById("simpleFEE_COMMENTS").value;
 				document.getElementById("fullPRICE").value = document.getElementById("simplePRICE").value;

 				document.getElementById("fullSTATUS_SALE").selectedIndex = document.getElementById("simpleSTATUS_SALE").selectedIndex;




 			}
 		}
 		
 		function popUp(url) {
			window.open(url, 'subwin', 'width=1000,height=495,resizable,scrollbars');
			//name.moveTo(screen.width/2-250,screen.height/2-250);
			//name.focus;
		}


 		function popUpapp(url) {
			window.open(url, 'subwin', 'width=850,height=800,resizable,scrollbars');
			//name.moveTo(screen.width/2-250,screen.height/2-250);
			//name.focus;
		}


 		function popUpPicCode(url) {
			window.open(url, 'subwin', 'width=650,height=510,resizable,scrollbars');
			//name.moveTo(screen.width/2-250,screen.height/2-250);
			//name.focus;
		}


 		
 		function popUpPrintOut(url) {
			window.open(url, 'printOut', 'width=600,height=1200,resizable,scrollbars');
			//name.moveTo(screen.width/2-250,screen.height/2-250);
			//name.focus;
		}
		function popUpPrintOutPic(urld) {
			window.open(urld, 'printOut', 'width=600,height=1000,resizable,scrollbars');
			//name.moveTo(screen.width/2-250,screen.height/2-250);
			//name.focus;
		}
 		
 		function scrollIt (_y) {
 			window.scrollTo (0, _y);
 		}
 		
 		 		
 		function print_screen(){                                       
 			if (!window.print){                                      
 				alert("You need newer browser to use this print button!")
 				return                                                   
 			}                                                        	
                	window.print()                                           
		}                                                        
		function close_window() {
			window.close();
		}                                            
                function CheckAll() {                                                       
      			for (var i=0;i<document.moveform.elements.length;i++){                                                    
         			var e = document.moveform.elements[i];            		
         			if (e.name != "allbox"){
            				e.checked = document.moveform.allbox.checked;  
            			}
            		}
            	}   
            	function addClient() {
    			var s = window.document.addClientsToDeal.client_list;
    			var d = window.document.addClientsToDeal.elements['selected_clients[]'];
    			
    			if (s.selectedIndex < 0) {
    			    alert('You must select a client first.');
    			    return false;
    			} else {
    			    for (var i = 0; i < s.length; i++) {
    			        var item = s.options[i];
    			        if (item.value == "") { continue; }
    			        if (item.selected) {
    			            d.options[d.length] = new Option(item.text, item.value);
    			            s.options.remove(i);
    			        }
    			    }
    			}
    		}
    		function removeClient() {
    			var s = window.document.addClientsToDeal.client_list;     
			var d = window.document.addClientsToDeal.elements['selected_clients[]'];
			
			if (d.selectedIndex < 0) {
    			    alert('You must select a client to remove first.');
    			    return false;
    			}else {
    			    for (var i = 0; i < d.length; i++) {
    			        var item = d.options[i];
    			        if (item.value == "") { continue; }
    			        if (item.selected) {
    			            s.options[s.length] = new Option(item.text, item.value);
    			            d.options.remove(i);
    			        }
    			    }
    			}
    		}
    		function select_clients() {
    			var d = window.document.addClientsToDeal.elements['selected_clients[]'];
    			for (var i = 0; i < d.length; i++) {
    			        var item = d.options[i];
    			        item.selected = true;
    			}
    		}
    		function submit_selected_clients() {
    			select_clients();
    			var d = window.document.addClientsToDeal.elements['selected_clients[]'];
    			if (d.selectedIndex < 0) {
    			    alert('You must select at least on client to link to the deal.');
    			    return false;
    			}else {
    				window.document.addClientsToDeal.submit();
    			}
    		}
    		
    		function return_scroll (id) {    	
    			varname = "ad" + id + "k";
    			//alert (varname);
    			ad = document.getElementById(varname);
    			//alert(varname);
    			ad.focus();
    			
    			//alert(ad);
    			//st = ad.scrollHeight;
    			//alert (st);
    			//scrollIt (this_y);
    		}
    		function select_tab_sens (page) {
    			if (confirm("Are you sure you want to navigate here without saving changes?")) {
	 			window.location = page;
	 		}
	 	}
	 	function select_tab_insens (page) {
	 		window.location = page;
	 	}

function clear_textbox()
{
if (document.adlEditForm.simpleBODY.value == "Type your ad here.") {
document.adlEditForm.simpleBODY.value = ""; }

if (document.adlEditForm.fullBODY.value == "Type your ad here.") {
document.adlEditForm.fullBODY.value = ""; }

else if (document.adlEditForm.BODY_ALT.value == "Type your alternative ad here.") {
document.adlEditForm.BODY_ALT.value = ""; }

else if (document.adlEditForm.LOT_DESCRIPTION.value == "Type the Lot Description here.") {
document.adlEditForm.LOT_DESCRIPTION.value = ""; }

}



function ChangeAcres() {
	if (document.adlEditForm.LOT_SIZE.value != "") {
		Acre = 0;
		Acre = (parseInt(document.adlEditForm.LOT_SIZE.value.replace(",","")) / 43560);
		Acre = parseInt(Acre * 100)/100; // round to 2 decimal places
		document.adlEditForm.ACRES.value = Acre;
	}
}

function ChangeLot_Size() {
	if (document.adlEditForm.ACRES.value != "") {
		Lot_Size = 0;
		Lot_Size =  parseInt(parseFloat(document.adlEditForm.ACRES.value.replace(",","")) * 43560);
		document.adlEditForm.LOT_SIZE.value = Lot_Size;
	}
}






 		function SaveAd (page, cid) {
 			//display name of page//
			
			page=="adlEdit";
			pageName = "Ad/Listing";
 
 				if (cid == 0) {
 					//ad has not been saved and needs to.//
 					if (confirm("Click OK to save your work and continue.")) {
 						document.getElementById("adlEditFormNav").value = page;

validateAdlEdit(adlEditView);


 					}
 				}else {
 					if (confirm ("Would you like to save your changes?")) {
 						document.getElementById("adlEditFormNav").value = page;
 						validateAdlEdit(adlEditView);
 					}else {
 						window.location = ("<?php echo $PHP_SELF;?>?op=" + page + "&cid=" + cid);
 					}
 				}
 			}
 		





function checkshortname() {

           if (document.createLandlord.short_name.value == "") {
                        alert("Please enter a SHORT NAME for the landlord.");
                        document.createLandlord.short_name.focus();
                        return(false);
                }
                else {
                        return(true);
                }
        }

-->

</script>