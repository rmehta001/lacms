//chrome.extension.sendMessage({type: "content"}, function(response) {
//  console.log(response.farewell);
//});

//chrome.extension.sendMessage({ type: "testFunc" });
//debugger;
//console.log("test");
//var cli = document.getElementById("cli");
//document.getElementById("clpost").textContent=cli.innerHTML;

var co = document.getElementById("co").innerHTML;
var ad = document.getElementById("ad").innerHTML;
var uid = document.getElementById("uid").innerHTML;
var cl_location = document.getElementById("cl_location").innerHTML;
var posting_body = document.getElementById("posting_body").innerHTML;
var adtitle = document.getElementById("adtitle").innerHTML;

var contact = document.getElementById("contact").value;
var rooms = document.getElementById("rooms").value;
var bath = document.getElementById("bath").value;

// var avail_month = document.getElementById("avail_month").value;
// var avail_day = document.getElementById("avail_day").value;

var available = document.getElementById("available").innerHTML;


var Laundry = document.getElementById("Laundry").value;
var Parking = document.getElementById("Parking").value;

var phone = document.getElementById("phone").value;

var email = document.getElementById("email").innerHTML;

var SQFT = document.getElementById("SQFT").value;

var zip = document.getElementById("zip").value;
var locname = document.getElementById("locname").value;


var mapstreet = document.getElementById("mapstreet").value;
var mapxstreet = document.getElementById("mapxstreet").value;
var mapstate = document.getElementById("mapstate").value;

// aa fix
 var rent = document.getElementById("rent").value;
var rent = document.getElementById("rent").innerHTML;
var postal = document.getElementById("postal").value;

// not working fields


var Cat = document.getElementById("Cat").value;

var Dog = document.getElementById("Dog").value;

// end not working fields

document.getElementById("clpost").textContent="<br>"+co+"<br>"+ad+"<br>"+uid+"<br>"+cl_location+"<br>";

var posting = $.post("https://post.craigslist.org", {});
posting.done(function(data) {
   var page = $( data ).find("form");
   var crypted_check = $(data).find('input[name="cryptedStepCheck"]').val();
   console.log(page.attr('action'));
   console.log(crypted_check);

   //var posting2 = $.post(page.attr('action'),{ cryptedStepCheck: crypted_check, id: "ho"});
   var posting2 = $.post(page.attr('action'),{ cryptedStepCheck: crypted_check, n: cl_location});
	posting2.done(function(data2) {
		// type of listing section , choose "housing offered"
		//console.log(data2);
		//document.getElementById("clpost").innerHTML=data2;
		var crypted_check = $(data2).find('input[name="cryptedStepCheck"]').val();
		var posting3 = $.post(page.attr('action'),{ cryptedStepCheck: crypted_check, id: "ho"});
		posting3.done(function(data3) {
			// type category "apts for rent"1, "office and commercial"3or4, "real estate - by broker"2
			//console.log(data3);
			//document.getElementById("clpost").innerHTML=data3;
			var crypted_check = $(data3).find('input[name="cryptedStepCheck"]').val();
			var posting4 = $.post(page.attr('action'),{ cryptedStepCheck: crypted_check, id: "0"});
			posting4.done(function(data4) {
			// fee category "apt broker fee"60 and "apts broker no fee"85
			console.log(data4);
			document.getElementById("clpost").innerHTML=data4;
			var crypted_check = $(data4).find('input[name="cryptedStepCheck"]').val();
			var posting5 = $.post(page.attr('action'),{ cryptedStepCheck: crypted_check, id: "60"});
			posting5.done(function(data5) {
				// "choose nearest area" eg boston north, south..etc
				//console.log(data5);
				console.log("LOCATION: "+cl_location);
				document.getElementById("clpost").innerHTML=data5;
				var crypted_check = $(data5).find('input[name="cryptedStepCheck"]').val();
				var posting6 = $.post(page.attr('action'),{ cryptedStepCheck: crypted_check, n: cl_location});
				posting6.done(function(data6) {
					console.log(data6);
                                        var x_testvar = $(data6).find();
					var crypted_check = $(data6).find('input[name="cryptedStepCheck"]').val();
					$(data6).find('input[name="postal"]').val("02151");
					json_data={"postal":02151};
					$(data6).loadJSON(json_data); 
					document.getElementById("clpost").innerHTML=data6;
					//$('form').loadJSON(json_data);

					$("#postal_code").val(zip);
					$("#GeographicArea").val(locname);
					$("#new-edit > div > fieldset.json-form-group-container.location-info > div > label.json-form-item.text.xstreet0.street0 > label > input").val(mapstreet);

					$("#new-edit > div > fieldset.json-form-group-container.location-info > div > label.json-form-item.text.xstreet1.street1 > label > input").val(mapxstreet);
					$("#new-edit > div > fieldset.json-form-group-container.location-info > div > label.json-form-item.text.city > label > input").val(locname);
					$("#region").val(mapstate);
					$('input[name="price"]').val(rent);
					$("#wantamap").prop('checked', true);
					$('input[name="postal"]').val(postal);
			

//					if (furnished == 1) {
//						$('input[name="is_furnished"]').prop("checked", true);
//						} 
						
						
					if (Dog == 1) {
						$('input[name="pets_dog"]').prop("checked", true);
					//						$("#pets_dog").prop("checked", true);
						}
					if (Cat == 1) {
//						$("#pets_cat").prop("checked", true);
						$('input[name="pets_cat"]').prop("checked", true);
						}
					$("#P").attr('checked','checked');
					
					
		//			$("#FromEMail").val(email);
		//			$("#ConfirmEMail").val(email);
		$('input[name="FromEMail"]').val(email);
		$('input[name="ConfirmEMail"]').val(email);



					$('input[name="postal"]').val(postal);
		
					
				//	$("#contact_phone").val(phone);
				//	$("#contact_phone_ok").prop("checked", true);

				$("#new-edit > div > fieldset.json-form-group-container.contact-info > div > fieldset > div > div.json-form-group.json-form-group-container.contact-form-text > label.json-form-item.text.contact_phone > label > input").val(phone);
				
				
				$("#new-edit > div > fieldset.json-form-group-container.contact-info > div > fieldset > div > div.json-form-group.json-form-group-container.contact-form-text > label.json-form-item.text.contact_name > label > input").val(contact);
				
				
				
				
				
					$("#PostingTitle").val(adtitle);
					$("#contact_name").val(contact);
					$("#PostingBody").val(posting_body);
//					$("#laundry").val(Laundry);
//					$("#parking").val(Parking);
					$("#Bedrooms").val(rooms);
	//				$("#bathrooms").val(bath);
		
            // New selector for baths 2018-12-29 alexander
            $("select[name='bathrooms']").val(bath);

			            $("select[name='laundry']").val(Laundry);
		            $("select[name='parking']").val(Parking);
						
				$("#Sqft").val(SQFT);
 //           $("select[name='Sqft']").val(SQFT);
					
					
					
					$("#new-edit > div > fieldset.json-form-group-container.contact-info > div > fieldset > div > div.json-form-group.json-form-group-container.contact-form-booleans > label.json-form-item.boolean.contact_phone_ok > input").prop("checked", true);

					
					
					$("#new-edit > div > fieldset.json-form-group-container.posting-attributes > div > div.json-form-group.json-form-group-container.posting-attributes-groups > label > label > input.json-form-input.datepicker.js-only.moveinDate").val(available);

	//					$('input[name=moveinDay]').val(avail_day);
					
//	window.scrollTo(0,document.body.scrollHeight);
//	console.log("HERE");
//$.scrollTo('a[href=bottom]');

//element_to_scroll_to = document.getElementById('bottom');
//element_to_scroll_to.scrollIntoView();

//window.scroll(100000, 100000);
var yourCustomJavaScriptCode = "element_to_scroll_to = document.getElementById('bottom');element_to_scroll_to.scrollIntoView();";
var script = document.createElement('script');
var code = document.createTextNode('(function() {' + yourCustomJavaScriptCode + '})();');
script.appendChild(code);
(document.body || document.head).appendChild(script);

				});
			});
		});
	  });
	  
	});
})
