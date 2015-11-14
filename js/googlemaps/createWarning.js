function createWarning(location, report) {
    
    var iconURL = getIcon(report.category);
    
    var image = {
        url: iconURL,
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(25, 59)
    };
    
    var marker = new google.maps.Marker({
        position: location,
        title: report.category,
        icon: image
    });
    
    createInfoWindow(report, marker);
    marker.setMap(map);
}