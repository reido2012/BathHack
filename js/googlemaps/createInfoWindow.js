function createInfoWindow(report, marker){
    
    marker.addListener('click', function() {
        infoWindow.setContent(report);
        infoWindow.open(map, marker);
    });
}