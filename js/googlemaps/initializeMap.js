function initializeMap() {
    var mapBox = document.getElementById('map-here');
    var mapOptions = {
        center: new google.maps.LatLng(44.5403, -78.5463),
        zoom: 6
    };
    map = new google.maps.Map(mapBox, mapOptions);
}