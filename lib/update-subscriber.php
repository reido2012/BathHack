<?php

	require 'database.php';

	$query = $db->prepare("UPDATE Subscriber SET LocationLatitude=:latitude WHERE email=:email");
	$query->execute(array(
		":email" => $_POST['email'],
		":latitude" => $_POST['lat']
	));

	$query = $db->prepare("UPDATE Subscriber SET LocationLongitude=:longitude WHERE email=:email");
	$query->execute(array(
		":email" => $_POST['email'],
		":longitude" => $_POST['lon']
	));

	echo "{ done: true }";