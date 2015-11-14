function createInfoWindow(type, marker){
    var infoWindow = new google.maps.InfoWindow({
        content: type
    });
    
    marker.addListener('click', function() {
        infoWindow.open(map, marker);
    });
}