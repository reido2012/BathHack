<?php

	require 'database.php';

	$query = $db->prepare("INSERT INTO Subscriber (Email, LocationLatitude, LocationLongitude) VALUES (:email, :latitude, :longitude)");
	$query->execute(array(
		":email" => $_POST['email'],
		":latitude" => $_POST['lat'],
		":longitude" => $_POST['lon']
	));

	echo "{ done: true }";