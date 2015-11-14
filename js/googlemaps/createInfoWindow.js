function createInfoWindow(type, targetMarker){
    var infoWindow = new google.maps.InfoWindow({
        content: type
    });
    
    google.maps.event.addListener(targetMarker, 'click', function() {
        if($('.gm-style-iw').length) {
            $('.gm-style-iw').parent().remove();
        }
        infoWindow.open(map, targetMarker);
    });
}