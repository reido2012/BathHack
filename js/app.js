var currentLat;
var currentLon;

var viewRadius = 1000; // in meters

function submitReport(category){

	$.ajax({
		url: "lib/submit-report.php", 
		type: "POST",      
		data: "lat=" + currentLat + "&lon=" + currentLon + "&category=" + category,     
		cache: false,
		success: function(reportID){

			$("#currentReportId").val(reportID);

		}   
	});

}


function loadReportForm(){

	$.ajax({
		url: "lib/list-categories.php", 
		type: "POST",  
		cache: false,
		success: function(returnraw){                          
			
			var cats = JSON.parse(returnraw);
			for(var i=0; i<cats.length; i++){
				var category = cats[i];
				$("#category-container").append('<button type="button" class="btn btn-danger btn-md btn-block" data-dismiss="modal" data-toggle="modal" data-target="#done-report-modal" onclick="submitReport(\'' + category + '\');">' + category + '</button> ');
			}

		}
	});    

}


function toggleSubscribeButton(){

	if(document.cookie.indexOf('email=') >= 0){
		$("#subscribe-btn").hide();
		$("#unsubscribe-btn").show();
	}else{
		$("#subscribe-btn").show();
		$("#unsubscribe-btn").hide();
	}

}


function submitSubscriber(){

	var email = $("[name='emailinput']").val();

	$.ajax({
		url: "lib/submit-subscriber.php", 
		type: "POST",      
		data: "lat=" + currentLat + "&lon=" + currentLon + "&email=" + email,     
		cache: false     
	});

	document.cookie = "email=" + email;

	toggleSubscribeButton();

}

function updateSubscriber(){

	function getCookie(name) {
  		var value = "; " + document.cookie;
  		var parts = value.split("; " + name + "=");
  		if (parts.length == 2) return parts.pop().split(";").shift();
	}

	if(document.cookie.indexOf('email=') >= 0){
		$.ajax({
			url: "lib/update-subscriber.php", 
			type: "POST",      
			data: "lat=" + currentLat + "&lon=" + currentLon + "&email=" + getCookie('email'),     
			cache: false     
		});
	}

}


function unsubscribe(){

	function getCookie(name) {
  		var value = "; " + document.cookie;
  		var parts = value.split("; " + name + "=");
  		if (parts.length == 2) return parts.pop().split(";").shift();
	}

	if(document.cookie.indexOf('email=') >= 0){
		
		$.ajax({
			url: "lib/delete-subscriber.php", 
			type: "POST",      
			data: "email=" + getCookie('email'),     
			cache: false     
		});

		document.cookie = "email=; expires=Thu, 01 Jan 1970 00:00:00 UTC";

	}

	toggleSubscribeButton();

}


function loadReportPoints(){

	$.ajax({
		url: "lib/list-reports.php", 
		type: "POST",      
		data: "lat=" + currentLat + "&lon=" + currentLon + "&radius=" + viewRadius,     
		cache: false,
		success: function(rawdata){                          
		
			var reports = JSON.parse(rawdata);
    	

			for(var i=0; i<reports.length; i++){

				var reportid = reports[i]['ReportID'];
				var latitude = reports[i]['LocationLatitude'];
				var longitude = reports[i]['LocationLongitude'];
				var time = reports[i]['Time'];
				var distance = reports[i]['Distance'];
				var category = reports[i]['ReportCategory'];
				var currenttime = reports[i]['CurrentTime'];
				var videourl = reports[i]['VideoURL'];
                
                var timeDifferenceTable = getTimeDifferenceTable(time, currenttime);
                
				var report = {
                    title: "Panic! - " + category,
                    time: timeDifferenceTable,
                    distance: (Math.round(distance*100)/100) + "m away",
                    };
               

				$("#reports-list-body").append('<tr><td><a data-toggle="modal" data-target="#videos-modal" onclick="getVideo("' + videourl + '"");">' + category + '</a></td><td>' + getTimeDifferenceString(time, currenttime) + '</td><td>' + (Math.round(distance*100)/100) + 'm</td></tr>');

				createWarning(new google.maps.LatLng(latitude, longitude), report);

			}


		}           
	});

}

function getTimeDifferenceTable(time, now){

    var time = new Date(time).getTime();  
    var now = new Date(now).getTime();

    if(isNaN(time)) return "";

    var differenceMs = now - time;
   
    var days = Math.floor(differenceMs / 1000 / 60 / (60 * 24));
    var difference = new Date(differenceMs);

    var string = "";

    if(days > 0) string += days + " days ";
    if(difference.getHours() > 0) string += difference.getHours() + " hours ";
    if(difference.getMinutes() > 0) string += difference.getMinutes() + " mins ";

    return string += " ago";

}

function getVideo(videourl){

	if(videourl != "null"){              
		$("#video-url").attr("src", url);
		$("#video-url").parent().show();
	}else{
		$("#video-url").attr("src", "");
		$("#video-url").parent().hide();
	}           
	          

}

function getTimeDifferenceString(time, now){

    var time = new Date(time).getTime();  
    var now = new Date(now).getTime();

    if(isNaN(time)) return "";

    var differenceMs = now - time;
   
    var days = Math.floor(differenceMs / 1000 / 60 / (60 * 24));
    var difference = new Date(differenceMs);

    var string = "";

    if(days > 0) string += days + " days ";
    if(difference.getHours() > 0) string += difference.getHours() + " hours ";
    if(difference.getMinutes() > 0) string += difference.getMinutes() + " mins ";
    if(difference.getSeconds() > 0) string += difference.getSeconds() + " secs ";

    return string;

}