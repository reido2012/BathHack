<?php

	$query = $db->prepare("SELECT CURRENT_TIMESTAMP()");
	list($timestamp) = $query->fetch();

	echo $timestamp;