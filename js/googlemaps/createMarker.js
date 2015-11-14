function createMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        title: "Your Location"
    });
    
    marker.setMap(map);
    createInfoWindow("you are here", marker);
}