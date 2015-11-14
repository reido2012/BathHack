<?php

	require 'database.php';

	$query = $db->prepare("INSERT INTO Subscriber (PhoneNumber, LocationLatitude, LocationLongitude) VALUES (:phoneNumber, :latitude, :longitude)");
	$query->execute(array(
		":phoneNumber" => $_POST['phone-number'],
		":latitude" => $_POST['lat'],
		":longitude" => $_POST['lon']
	));

	echo "{ done: true }";