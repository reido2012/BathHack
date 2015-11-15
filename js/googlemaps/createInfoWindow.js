function createInfoWindow(report, marker){
    
    var tableStart = "<table class='reportInfoWindow'>";
    var tableHeadStart = "<thead>";
    var tableHeadEnd = "</thead><tbody>";
    var tableEnd = "</tbody></table>";
    
    var title = "<tr><td colspan='2'>" + report.title + "</td></tr>";
    var time = "<tr><td>Time:</td><td>" + report.time + "</td></tr>";
    var distance = "<tr><td>Distance:</td><td>" + report.distance + "</td></tr>";
    
    var infoWindowContent;
    
    if (report.title == "you are here") {
        infoWindowContent = tableStart + tableHeadStart + title + tableHeadEnd + tableEnd;
    }
    else {
        infoWindowContent = tableStart + tableHeadStart + title + tableHeadEnd + time + distance + tableEnd;
    }
    
    marker.addListener('click', function() {
        infoWindow.setContent(infoWindowContent);
        infoWindow.open(map, marker);
    });
}