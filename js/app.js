var currentLat;
var currentLon;

function submitReport(category){

	$.ajax({
		url: "/lib/submit-report.php", 
		type: "POST",      
		data: "lat=" + currentLat + "&lon=" + currentLon + "&category=" + category,     
		cache: false     
	});       

}


function loadReportForm(){

	$.ajax({
		url: "/lib/list-categories.php", 
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
		url: "/lib/submit-subscriber.php", 
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
			url: "/lib/update-subscriber.php", 
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
			url: "/lib/delete-subscriber.php", 
			type: "POST",      
			data: "email=" + getCookie('email'),     
			cache: false     
		});

		document.cookie = "email=; expires=Thu, 01 Jan 1970 00:00:00 UTC";

	}

	toggleSubscribeButton();

}