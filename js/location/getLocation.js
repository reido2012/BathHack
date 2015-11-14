
function getLocation() {
    
    if (navigator.geolocation) {
        var notification = createNotification("Finding Your Location");
        loadNotification(notification);
        navigator.geolocation.getCurrentPosition(showPosition);
        //terminateNotification(notification);
    }
}
function showPosition(position, notification) {
    
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    
    clientLocation.Latitude = lat;
    clientLocation.Longitude = lng;
    
    var LATLNG = new google.maps.LatLng(lat, lng);
    
    updateLocZoom(LATLNG, 14);
    createMarker(LATLNG);

    currentLat = lat;
    currentLon = lng;

    updateSubscriber();
    loadReportPoints();

}