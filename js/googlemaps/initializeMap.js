function initializeMap() {
    
    var mapBox = document.getElementById('map-here');
    
    var mapOptions = {
        center: new google.maps.LatLng(clientLocation.Latitude, clientLocation.Longitude),
        zoom: 7
    };
    map = new google.maps.Map(mapBox, mapOptions);
}