<?php

	require 'database.php';

	$query = $db->prepare("UPDATE Subscriber SET LocationLatitude=:latitude WHERE PhoneNumber=:phoneNumber");
	$query->execute(array(
		":phoneNumber" => $_POST['phone-number'],
		":latitude" => $_POST['lat']
	));

	$query = $db->prepare("UPDATE Subscriber SET LocationLongitude=:longitude WHERE PhoneNumber=:phoneNumber");
	$query->execute(array(
		":phoneNumber" => $_POST['phone-number'],
		":longitude" => $_POST['lon']
	));

	echo "{ done: true }";