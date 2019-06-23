function getLocation() {
  var loc = "";
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
    console.log(loc);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}
function showPosition(position) {
  loc = position.coords.latitude;
  loc = loc + "," + position.coords.longitude;
}

/********************* AJAX FUNCTIONS  *****************/

function ajaxFunction()	{
	var ajaxRequest;
	try{
		ajaxRequest = new XMLHttpRequest();
	}catch (e){
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			}catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				}catch (e){
					alert("Your browser broke!");
					return false;
				}
			}
		}
		
	return ajaxRequest;
	}
function ajaxReady()	{
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('ajaxDiv');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
}

function ajaxPost(query,source)	{
  ajaxRequest=ajaxFunction();
  ajaxRequest.onreadystatechange = function(){
    if(ajaxRequest.readyState == 4){
      var response=ajaxRequest.responseText;
      showToast(response);
    }
  }
  ajaxRequest.open("POST", source, true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(query);
}
function showToast(val)	{
    var box=document.getElementById('snackbar');
    box.innerHTML=val;
          box.className = "show";
          setTimeout(function(){ box.className = box.className.replace("show", ""); }, 3000);
}


// ADD MEDICINE BOX

// TO SET INPUT LABEL AND NAME
var mIndex = 0;

$(document).ready(function() {
  $("#addMedicine").click(function(){
    $('<label>Madicine '+ Number(mIndex+1) + '</label>').appendTo('#med-box'); 
    jQuery('<input/>', {
      type: 'text',
      "class": 'w3-input w3-border',
      name: 'med'+mIndex
  }).appendTo('#med-box'); 
  $('<label>Dosage of Madicine '+ Number(mIndex+1) + '</label>').appendTo('#med-box'); 
  jQuery('<input/>', {
    type: 'text',
    "class": 'w3-input w3-border',
    name: 'medDosage'+mIndex
}).appendTo('#med-box'); 
  mIndex++;
  }); 
});
