<?php

    require 'database.php';

	$tablename = "videos";

	try {
    $stmt = $db->prepare("SELECT * FROM $tablename");
    $stmt->execute();
    

    // set the resulting array to associative
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    	
		$id=$result['videoId'];
		$name = $result['videoName'];
		echo "<a href='watch.php?id=$id'>$name</a><br/>";
    }
    
	}catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}