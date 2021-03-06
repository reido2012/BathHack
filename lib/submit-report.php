<?php

	require 'database.php';
	require 'haversine.php';
	require 'email-send.php';


	$radius = 1000;

	
	$query = $db->prepare("INSERT INTO Report (LocationLatitude, LocationLongitude, ReportCategory) VALUES (:latitude, :longitude, :category)");
	$query->execute(array(
		":latitude" => $_POST['lat'],
		":longitude" => $_POST['lon'],
		":category" => $_POST['category']
	));

	echo $db->lastInsertId();

	$query = $db->query("SELECT Email, LocationLatitude, LocationLongitude FROM Subscriber");
	foreach($query as $row){
		
		$distance = haversineDistance($_POST['lat'], $row['LocationLatitude'], $_POST['lon'], $row['LocationLongitude'])/1000000;
	
		if($distance <= $radius){

			email_send($row["Email"], $_POST['category'], $distance);

		}

	}