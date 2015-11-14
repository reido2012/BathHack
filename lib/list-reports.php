<?php

	require 'database.php';
	require 'haversine.php';
	

	$centreLat = $_POST['lat'];
	$centreLon = $_POST['lon'];
	$radius = $_POST['radius'];

	$reports = [];

	$query = $db->query("SELECT ReportID, LocationLatitude, LocationLongitude, Time, ReportCategory FROM Report ORDER BY Time DESC LIMIT 15");
	foreach($query as $row) {
		
		$distance = haversineDistance($centreLat, $centreLon, $row["LocationLatitude"], $row["LocationLongitude"]);
		if($distance <= $radius){
			$row['Distance'] = $distance;
			array_push($reports, $row);
		}

	}

	echo json_encode($reports);