function createInfoWindow(report, marker){
    
    var tableStart = "<table><thead></thead><tbody>";
    var tableEnd = "</tbody></table>";
    
    var title = "<tr><td colspan='2'>" + report.title + "</td></tr>";
    var category = "<tr><td>Category:</td><td>" + report.category + "</td></tr>";
    var time = "<tr><td>Time:</td><td>" + report.time + "</td></tr>";
    var distance = "<tr><td>Distance:</td><td>" + report.distance + "</td></tr>";
    
    var infoWindowContent;
    
    if (report.title == "you are here") {
        infoWindowContent = tableStart + title + tableEnd;
    }
    else {
        infoWindowContent = tableStart + title + category + time + distance + tableEnd;
    }
    
    marker.addListener('click', function() {
        infoWindow.setContent(infoWindowContent);
        infoWindow.open(map, marker);
    });
}