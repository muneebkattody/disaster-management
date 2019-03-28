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
