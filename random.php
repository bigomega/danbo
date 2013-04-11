<?php
	$mock = array("monster", "dragon", "dongle", "null", "zero", "wizard", "gandalf", "snape", "oracle", "dexter", "Morgan Freeman", "scientist");
	$suggestion = $mock[rand()%sizeof($mock)];
	header('location: ./questions.php?key='.$suggestion);
	exit();
?>