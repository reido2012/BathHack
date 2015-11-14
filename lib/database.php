<?php

	$db = new PDO("mysql:host=localhost;dbname=panic-button", "bathhackapp", "fe2184fe2184");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);