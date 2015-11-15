<?php

	require 'database.php';
	require 'haversine.php';

	$video = [];

	$report = $_POST['reportid'];

	$query = $db->query("SELECT videoURL FROM video WHERE reportID='$report'");
	foreach($query as $row) {
		die($row['videoURL']);
	}