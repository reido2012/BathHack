function createWarning(location, type) {
    
    var iconURL = getIcon(type);
    
    var image = {
        url: iconURL,
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(25, 59)
    };
    
    var marker = new google.maps.Marker({
        position: location,
        title: "Your Location",
        icon: image
    });
    
    marker.setMap(map);
}