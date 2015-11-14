function createInfoWindow(report, marker){
    infoWindow.setContent(report);
    
    marker.addListener('click', function() {
        infoWindow.open(map, marker);
    });
}