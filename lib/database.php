<?php

    $servername = "localhost";
	$username = "bathhackapp";
	$password = "fe2184fe2184";
	$dbName = "panic-button";

	$db = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);