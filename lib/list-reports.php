<?php

	require 'database.php';
	require 'haversine.php';
	

	$centreLat = $_POST['lat'];
	$centreLon = $_POST['lon'];
	$radius = $_POST['radius'];

	$reports = [];

	$query = $db->query("SELECT Report.ReportID, Report.LocationLatitude, Report.LocationLongitude, Report.Time, Report.ReportCategory, CURRENT_TIMESTAMP() AS CurrentTime, videos.videoURL AS VideoURL FROM Report INNER JOIN videos ON videos.reportID = Report.ReportID ORDER BY Time DESC LIMIT 15");
	foreach($query as $row) {
		
		$distance = haversineDistance($centreLat, $centreLon, $row["LocationLatitude"], $row["LocationLongitude"]);
		$reportid = $row['ReportID'];
		if($distance <= $radius){
			
			$row['Distance'] = $distance;
			
			array_push($reports, $row);
		}

	}

	echo json_encode($reports);