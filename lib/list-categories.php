<?php

	require 'database.php';

	$reportCategories = [];

	$query = $db->query("SELECT ReportCategoryName FROM ReportCategory");
	foreach($query as $row) {
		array_push($reportCategories, $row["ReportCategoryName"]); 
	}

	echo json_encode($reportCategories);