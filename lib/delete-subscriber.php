<?php

	require 'database.php';

	$query = $db->prepare("DELETE FROM Subscriber WHERE email=:email");
	$query->bindParam(":email", $_POST['email']);
	$query->execute();