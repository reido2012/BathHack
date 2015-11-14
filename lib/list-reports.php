<?php

	require 'database.php';


	$centreLat = $_POST['lat'];
	$centreLon = $_POST['lon'];
	$radius = $_POST['radius'];

	$reports = [];

	$query = $db->prepare("SELECT ReportID, LocationLatitude, LocationLongitude, Time FROM Report");
	list($name, $email, $password) = $query->fetch();
	foreach($query as $row) {
		
		$distance = haversineDistance($centreLat, $centreLon, $row["LocationLatitude"], $row["LocationLongitude"]);
		if($distance <= $radius){
			array_push($reports, $row);
		}

	}

	echo json_encode($reports);