chrome.extension.onMessage.addListener(function(request, sender, sendResponse) {
    switch(request.type) {
        case "testFunc":
		var action_url = "https://www.bostonapartments.com/plugin/";			
		chrome.tabs.create({ url: action_url });
		break;
	case "content":
		console.log(sender.url);
		console.log(document);
                console.log(doc);
		break;
	case "frame":
		cosole.log("HERE");
		break;
	default:
		var action_url = "http://wired.com";
//request.type;
		chrome.tabs.create({ url: action_url });
	        break;
    }
    return true;
});


      chrome.storage.onChanged.addListener(function(changes, namespace) {
		var keys_string="";
        for (key in changes) {
          var storageChange = changes[key];
          console.log('Storage key "%s" in namespace "%s" changed. ' +
                      'Old value was "%s", new value is "%s".',
                      key,
                      namespace,
                      storageChange.oldValue,
                      storageChange.newValue);
          console.log('After changing : "%s"');
		   //document.getElementsByName("cryptedStepCheck");
		   keys_string=keys_string+key+"<br>";
		   
        }
      });