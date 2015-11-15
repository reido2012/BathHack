<?php

	require 'database.php';
	require 'haversine.php';
	

	$centreLat = $_POST['lat'];
	$centreLon = $_POST['lon'];
	$radius = $_POST['radius'];

	$reports = [];

	$query = $db->query("SELECT ReportID, LocationLatitude, LocationLongitude, Time, ReportCategory, VideoURL, CURRENT_TIMESTAMP() AS CurrentTime FROM Report ORDER BY ReportID DESC LIMIT 15");
	foreach($query as $row) {
		
		$distance = haversineDistance($centreLat, $centreLon, $row["LocationLatitude"], $row["LocationLongitude"]);
		if($distance <= $radius){
			$row['Distance'] = $distance;			
			array_push($reports, $row);
		}

	}

	echo json_encode($reports);