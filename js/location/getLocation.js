
function getLocation() {
    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
}
function showPosition(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    
    clientLocation.Latitude = lat;
    clientLocation.Longitude = lng;
    
    var LATLNG = new google.maps.LatLng(lat, lng);
    
    
    map.panTo(LATLNG);
    map.setZoom(14);
}