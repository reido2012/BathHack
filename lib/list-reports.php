<?php

	require 'database.php';
	require 'haversine.php';
	

	$centreLat = $_POST['lat'];
	$centreLon = $_POST['lon'];
	$radius = $_POST['radius'];

	$reports = [];

	$query = $db->query("SELECT ReportID, LocationLatitude, LocationLongitude, Time, ReportCategory, CURRENT_TIMESTAMP() AS CurrentTime FROM Report ORDER BY Time DESC LIMIT 15");
	foreach($query as $row) {
		
		$distance = haversineDistance($centreLat, $centreLon, $row["LocationLatitude"], $row["LocationLongitude"]);
		if($distance <= $radius){

			try{
				$query = $db->prepare("SELECT videoURL FROM videos WHERE reportID=:reportID LIMIT 1");
				$query->bindParam(":reportID", $row['ReportID']);
				list($videoURL) = $query->fetch();
				$row['VideoURL'] = $videoURL;
			}catch(Exception $e){
  				$row['VideoURL'] = "";
			}

			$row['Distance'] = $distance;
			
			array_push($reports, $row);
		}

	}

	echo json_encode($reports);