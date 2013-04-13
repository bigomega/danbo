<?php
	$mock = array("Chuck_Norris");
	$suggestion = $mock[rand()%sizeof($mock)];
	header('location: ./questions.php?key='.$suggestion);
	exit();
?>