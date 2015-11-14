function createInfoWindow(type, targetMarker){
    var infoWindow = new google.maps.InfoWindow({
        content: type
    });
    
    google.maps.event.addListener(targetMarker, 'click', function() {
        infoWindow.open(map, targetMarker);
    });
}