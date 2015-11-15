<?php

	require 'database.php';

	$query = $db->prepare("SELECT videoName, videoURL FROM videos WHERE reportID=:reportID LIMIT 1");
	$query->bindParam(":reportID", $_POST['ReportID']);
	list($videoName, $videoURL) = $query->fetch();

	echo $videoURL;