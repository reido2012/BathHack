<?php

session_start();

require_once __DIR__ . '/facebook_sdk/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '904162293013934',
  'app_secret' => 'da51d8e851a7e3a35f68a110bc7d494e',
  'default_graph_version' => 'v2.4',
]);

?>
<!DOCTYPE html>
<html>

	<head>
		
		<title>Don't Panic!</title>
		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

		<link rel="stylesheet" href="css/bootstrap/bootstrap.less.css" />
		<link rel="stylesheet" href="css/styles.less.css" />
        <link rel="stylesheet" href="css/notification.css"/>
        <link rel="stylesheet" href="css/panic.css"/>
        <link rel="stylesheet" href="css/infoWindow.css">
		
		<script src="js/jquery/jquery-2.1.3.min.js"></script>
		<script src="js/bootstrap/bootstrap.min.js"></script>
		<script src="js/app.js"></script>
        
        <!-- Google Maps -->
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script src="js/googlemaps/initializeMap.js"></script>
        <script src="js/location/getLocation.js"></script>
        <script src="js/googlemaps/updateLocZoom.js"></script>
        <script src="js/googlemaps/createMarker.js"></script>
        <script src="js/googlemaps/createWarning.js"></script>
        <script src="js/googlemaps/getIcon.js"></script>
        <script src="js/googlemaps/createInfoWindow.js"></script>
        
        <!-- Notifications -->
        <script src="js/notifications/loadNotification.js"></script>
        <script src="js/notifications/createNotification.js"></script>
        <script src="js/notifications/terminateNotification.js"></script>
        
        <!-- FB -->
        <script src="js/facebook.js"></script>

	</head>
	
	<body onload="toggleSubscribeButton(); loadReportForm();">
        
<script>
  window.fbAsyncInit = function() {
    FB.init({
        appId      : '904162293013934',
        xfbml      : true,
        version    : 'v2.5',
        cookie:true
    });
      
      // Now that we've initialized the JavaScript SDK, we call 
      // FB.getLoginStatus().  This function gets the state of the
      // person visiting this page and can return one of three states to
      // the callback you provide.  They can be:
      //
      // 1. Logged into your app ('connected')
      // 2. Logged into Facebook, but not your app ('not_authorized')
      // 3. Not logged into Facebook and can't tell if they are logged into
      //    your app or not.
      //
      // These three cases are handled in the callback function.

      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
        
<div id="status"></div>
	
		<div class="navbar">
			<div class="container-fluid">

				<div class="navbar-header">
					<a class="navbar-brand" href="/">Don't Panic!</a>
                    <div
                      class="fb-like"
                      data-share="true"
                      data-width="450"
                      data-show-faces="true">
                    </div>
				</div>

			</div>
		</div>
		
		<div class="container-fluid">
			
            <!-- MAIN LIVE AREA 
                    MAIN LIVE AREA ************************************************
                        MAIN LIVE AREA -->
            
			<section id='display-area' class="jumbotron">
                <div id='notification-area'></div>
				<div id='map-here' style="height:300px;"></div>
			</section>

			<section class="row">

				<article class="col-sm-6">
					<div id="panicArea">
					   <button type="button" id="panicButton" data-toggle="modal" data-target="#report-modal">PANIC!</button>
                    </div>
					<button id="subscribe-btn" type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#subscribe-modal">Subscribe to Alerts</button>
					<button id="unsubscribe-btn" type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#unsubscribe-modal" onclick="unsubscribe();">Unsubscribe from Alerts</button>

				</article>

				<article class="col-sm-6">
				
					<table class="table table-striped">

						<thead>
							<tr>
								<th>Report</th>
								<th>Time Ago</th>
								<th>Distance</th>
							</tr>
						</thead>

						<tbody id="reports-list-body">

						</tbody>

					</table>

				</article>

			</section>

		</div>

		<div id="report-modal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Report</h4>
					</div>
				
					<div class="modal-body row">
						<div id="category-container" class="col-md-12">

															
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>

				</div>
			</div>
		</div>

		<div id="done-report-modal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Report</h4>
					</div>

					<div class="modal-body">

						<p>Your report has been made.</p>
						<p>Nearby users will be notified.</p>

						<a href="tel:999" class="btn btn-primary btn-md">Call Emergency Services</a>

						<form action = "uploadVideo.php" method = "POST" enctype = "multipart/form-data" >
							<input id="currentReportId" type="hidden" name="reportID" />
							<input type = "file" name = "fileToUpload" id = "fileToUpload">
							<input type = "submit" name = "submit" value = "Upload"/>
						</form>

					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>

				</div>
			</div>
		</div>
        
        <script type="text/javascript">
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
            
            var mapBox = document.getElementById('map-here');
            var defaltLATLNG = new google.maps.LatLng(51.5072, 0.1275);
            
            var infoWindow = new google.maps.InfoWindow({
                content: ""
            });
            
            var mapOptions = {
                center: defaltLATLNG,
                zoom: 7
            };
            
            var map = new google.maps.Map(mapBox, mapOptions);
            
            var notificationDisplay = document.getElementById('notification-area');
            
            // default London
            var clientLocation = {
                Latitude: 51.5072,
                Longitude: 0.1275
            };
            //google.maps.event.addDomListener(window, 'load', initializeMap);
            
            getLocation();
            
        </script>


		<div id="subscribe-modal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Subscribe to Alerts</h4>
					</div>

					<div class="modal-body">

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Email</label>
						    <div class="col-sm-8">
								<input name="emailinput" type="email" class="form-control" />
							</div>
						</div>

					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#done-submit-modal" onclick="submitSubscriber();">Subscribe to Alerts</button>
					</div>

				</div>
			</div>
		</div>


		<div id="done-subscribe-modal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Subscribe to Alerts</h4>
					</div>

					<div class="modal-body">

						<p>You have been subscribed to receive email notifications of nearby events.</p>

					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>

				</div>
			</div>
		</div>


		<div id="unsubscribe-modal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Unsubscribe</h4>
					</div>

					<div class="modal-body">

						<p>You have been unsubscribed from email notifications of nearby events.</p>

					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>

				</div>
			</div>
		</div>

		<div id="videos-modal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Uploaded Video</h4>
					</div>

					<div id="video-container" class="modal-body">

						
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>

				</div>
			</div>
		</div>


	</body>

</html>